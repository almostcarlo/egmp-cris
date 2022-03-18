<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Recruitment extends MY_Controller{

    public $fee_cond = array(1=>'No Placement Fee', 2=>'Salary Deduction', 3=>'Others');

    public function lists($what=NULL){
        $data = array();
        switch ($what){
            case 'cv_transmittal':
                if(trim($this->input->post('textSearchCV')) != ''){
                    $q_where = "and (cv.transmittal_no like '%".trim($this->input->post('textSearchCV'))."%' or cv.subject like '%".trim($this->input->post('textSearchCV'))."%' or p.name like '%".trim($this->input->post('textSearchCV'))."%')";
                    $q_limit = "";
                }else{
                    $q_where = "";
                    $q_limit = "limit 100";
                }

                $this->template->set('file_javascript', array('javascripts/recruitment/cvtransmittal.js','javascripts/recruitment/index.js'));
                get_items_from_cache('principal');
                $data['list'] = getdata("select cv.*, p.name as principal
                                        from manager_cv_transmittal cv
                                        left join manager_principal p
                                        on cv.principal_id = p.id
                                        where 1
                                        {$q_where}
                                        order by add_date desc {$q_limit}");
            break;

            case 'mr_manager':
                if(trim($this->input->post('textSearch')) != ''){
                    $q_where = "and (mr.code like '%".trim($this->input->post('textSearch'))."%' or pr.name like '%".trim($this->input->post('textSearch'))."%')";
                    $q_limit = "";
                }else{
                    $q_where = "";
                    $q_limit = "limit 100";
                }

                $this->template->set('file_javascript', array('javascripts/recruitment/index.js'));

                $all_mr = getdata("select mr.id, mr.code as mr_ref, mr.activity, mr.add_date, pr.name as principal, co.name as company, j.id as mr_pos_id, j.status as mr_pos_stat
                                    from manager_mr mr
                                    left join manager_jobs j
                                    on mr.id = j.mr_id
                                    left join manager_principal pr
                                    on mr.principal_id = pr.id
                                    left join manager_company co
                                    on mr.company_id = co.id
                                    where 1
                                    and mr.status = 1
                                    {$q_where}
                                    order by mr.add_date desc
                                    {$q_limit}");

                $data['mr_active'] = array();
                $data['mr_for_update'] = array();
                if($all_mr){
                    foreach ($all_mr as $i){
                        if($i['mr_pos_id'] <> '' && $i['mr_pos_stat'] == 1){
                            $data['mr_active'][$i['id']] = $i;
                            unset($data['mr_for_update'][$i['id']]);
                        }else{
                            $data['mr_for_update'][$i['id']] = $i;
                            unset($data['mr_active'][$i['id']]);
                        }
                    }
                }
                break;

            case 'cv_for_sending':
                $this->template->set('file_javascript', array('javascripts/recruitment/index.js?version=1'));
                
                $data['list'] = getdata("select l.applicant_id, g.fname, g.mname, g.lname, g.status, pos.`desc` as position, cv.status as cv_stat, cv.id as cv_stat_id, cv.add_date as cv_date, cv.sent_date, cv.reviewed_date, cv.select_date, mr.code as mr_ref, l.manpower_id, j.pos_id
                    from applicant_cv_status cv
                    left join applicant_lineup l
                    on cv.lineup_id = l.id
                    left join applicant_general_info g
                    on l.applicant_id = g.id
                    left join manager_mr mr
                    on l.manpower_id = mr.id
                    left join manager_jobs j
                    on l.mr_pos_id = j.id
                    left join settings_position pos
                    on j.pos_id = pos.id
                    where 1
                    and g.status in ('ACTIVE','RESERVED')
                    and cv.status = 'reviewed'
                    order by cv.reviewed_date asc, g.lname asc");
                break;

            case 'cv_for_followup':
                $this->template->set('file_javascript', array('javascripts/recruitment/index.js?version=1'));
                
                $data['list'] = getdata("select l.applicant_id, g.fname, g.mname, g.lname, g.status, pos.`desc` as position, cv.status as cv_stat, cv.id as cv_stat_id, cv.add_date as cv_date, cv.sent_date, cv.reviewed_date, cv.select_date, mr.code as mr_ref, l.manpower_id, j.pos_id
                    from applicant_cv_status cv
                    left join applicant_lineup l
                    on cv.lineup_id = l.id
                    left join applicant_general_info g
                    on l.applicant_id = g.id
                    left join manager_mr mr
                    on l.manpower_id = mr.id
                    left join manager_jobs j
                    on l.mr_pos_id = j.id
                    left join settings_position pos
                    on j.pos_id = pos.id
                    where 1
                    and g.status in ('ACTIVE','RESERVED')
                    and cv.status = 'sent'
                    order by cv.reviewed_date asc, g.lname asc");
                break;

            case 'final_lineup':
            case 'confirmed_lineup':
                $this->template->set('file_javascript', array('javascripts/recruitment/index.js?version=1'));

                if($what=='confirmed_lineup'){
                    $is_confirmed = 'Y';
                }else{
                    $is_confirmed = 'N';
                }

                $q_mr = "";
                $q_sched = "";

                if(isset($_POST['selectMR']) && $_POST['selectMR'] <> ''){
                    $q_mr = "and l.manpower_id = {$_POST['selectMR']}";
                }

                if(isset($_POST['selectSched']) && $_POST['selectSched'] <> ''){
                    $q_sched = "and l.interview_sched_id = {$_POST['selectSched']}";
                }

                $list = getdata("select l.id, l.applicant_id, i.status as app_status, i.fname, i.mname, i.lname, i.mobile_no, l.manpower_id, mr.code as mr_ref, l.mr_pos_id, j.pos_id, pos.`desc` as position, s.interview_date, l.interview_sched_id
                    from applicant_lineup l
                    left join applicant_general_info i
                    on l.applicant_id = i.id
                    left join manager_mr mr
                    on l.manpower_id = mr.id
                    left join manager_jobs j
                    on l.mr_pos_id = j.id
                    left join settings_position pos
                    on j.pos_id = pos.id
                    left join manager_interview_schedule s
                    on l.interview_sched_id = s.id
                    where 1
                    and l.interview_confirmed = '{$is_confirmed}'
                    and (l.lineup_status is null OR l.lineup_status not in ('Selected','Rejected','Standby'))
                    and i.status in ('ACTIVE','RESERVED')
                    and mr.status = 1
                    and l.mob_result in ('CR')
                    and j.pos_id is not null
                    {$q_mr}
                    {$q_sched}
                    order by s.interview_date asc, pos.desc asc, mr.code asc, i.lname asc");

                    $applicants = array();
                    $app_ids = array();
                    $mr_list = array();

                    if($list){
                        foreach ($list as $i){
                            $applicants[$i['id']] = $i;
                            array_push($app_ids, $i['applicant_id']);
                            $mr_list[$i['manpower_id']] = $i['mr_ref'];
                        }
                    }

                    $data = array('list' => $applicants, 'all_adv' => getAdvisory($app_ids), 'mr_list' => $mr_list);
                break;

            case 'lineup':
                $this->template->set('file_javascript', array('javascripts/recruitment/index.js?version=1'));

                $q_mr = "";
                $q_prin = "";

                if(isset($_POST['selectMR']) && $_POST['selectMR'] <> ''){
                    $q_mr = "and l.manpower_id = {$_POST['selectMR']}";
                }

                if(isset($_POST['selectPrincipal']) && $_POST['selectPrincipal'] <> ''){
                    $q_prin = "and m.principal_id = {$_POST['selectPrincipal']}";
                }

                $list = getdata("select l.id, l.applicant_id, i.fname, i.mname, i.lname, i.status as app_status, i.mobile_no, l.lineup_status, l.lineup_acceptance, i.status, j.pos_id, p.desc as position, l.manpower_id, m.code as mr_ref, m.principal_id, pr.name as principal, s.interview_date, l.interview_sched_id, i.application_source
                                from applicant_lineup l
                                left join applicant_general_info i
                                on l.applicant_id = i.id
                                left join manager_jobs j
                                on l.mr_pos_id = j.id
                                left join settings_position p
                                on j.pos_id = p.id
                                left join manager_mr m
                                on l.manpower_id = m.id
                                left join manager_principal pr
                                on m.principal_id = pr.id
                                left join manager_interview_schedule s
                                on l.interview_sched_id = s.id
                                where 1
                                and (l.lineup_status is null OR l.lineup_status not in ('Selected','Rejected'))
                                and (l.lineup_acceptance is null OR l.lineup_acceptance not in ('Accepted'))
                                and l.deployment_date = '0000-00-00 00:00:00'
                                and i.status not in ('BACKOUT', 'BLACKLISTED', 'DEPLOYED', 'SELECTED - ACCEPTED')
                                and l.manpower_id is not null
                                {$q_mr}
                                {$q_prin}
                                order by pr.name asc, i.lname asc");

                    $applicants = array();
                    $online_applicants = array();
                    $app_ids = array();
                    $mr_list = array();
                    $principal_list = array();

                    if($list){
                        foreach ($list as $i){
                            if($i['application_source'] == 3){
                                /*WEBSITE*/
                                $online_applicants[$i['id']] = $i;
                            }else{
                                $applicants[$i['id']] = $i;
                            }

                            array_push($app_ids, $i['applicant_id']);
                            $mr_list[$i['manpower_id']] = $i['mr_ref'];
                            $principal_list[$i['principal_id']] = strtoupper($i['principal']);
                        }
                    }

                    $data = array('list' => $applicants, 'list_online' => $online_applicants, /*'all_adv' => getAdvisory($app_ids),*/ 'mr_list' => $mr_list, 'principal_list' => $principal_list);
                break;

            case 'web_lineup':
                $this->template->set('file_javascript', array('javascripts/recruitment/index.js?version=1'));

                $q_mr = "";
                $q_prin = "";

                if(isset($_POST['selectMR']) && $_POST['selectMR'] <> ''){
                    $q_mr = "and l.manpower_id = {$_POST['selectMR']}";
                }

                if(isset($_POST['selectPrincipal']) && $_POST['selectPrincipal'] <> ''){
                    $q_prin = "and m.principal_id = {$_POST['selectPrincipal']}";
                }

                $list = getdata("select l.id, l.applicant_id, i.fname, i.mname, i.lname, i.status as app_status, i.mobile_no, l.lineup_status, l.lineup_acceptance, i.status, j.pos_id, p.desc as position, l.manpower_id, m.code as mr_ref, m.principal_id, pr.name as principal, s.interview_date, l.interview_sched_id, i.application_source
                                from applicant_web_lineup l
                                left join applicant_general_info i
                                on l.applicant_id = i.id
                                left join manager_jobs j
                                on l.mr_pos_id = j.id
                                left join settings_position p
                                on j.pos_id = p.id
                                left join manager_mr m
                                on l.manpower_id = m.id
                                left join manager_principal pr
                                on m.principal_id = pr.id
                                left join manager_interview_schedule s
                                on l.interview_sched_id = s.id
                                where 1
                                and l.re_evaluation = 'N'
                                and (l.lineup_status is null OR l.lineup_status not in ('Selected','Rejected'))
                                and (l.lineup_acceptance is null OR l.lineup_acceptance not in ('Accepted'))
                                and l.deployment_date = '0000-00-00 00:00:00'
                                and i.status not in ('BACKOUT', 'BLACKLISTED', 'DEPLOYED', 'SELECTED - ACCEPTED')
                                and l.manpower_id is not null
                                {$q_mr}
                                {$q_prin}
                                order by pr.name asc, i.lname asc");

                    $applicants = array();
                    $online_applicants = array();
                    $app_ids = array();
                    $mr_list = array();
                    $principal_list = array();

                    if($list){
                        foreach ($list as $i){
                            $applicants[$i['id']] = $i;

                            array_push($app_ids, $i['applicant_id']);
                            $mr_list[$i['manpower_id']] = $i['mr_ref'];
                            $principal_list[$i['principal_id']] = strtoupper($i['principal']);
                        }
                    }

                    $data = array('list' => $applicants, 'mr_list' => $mr_list, 'principal_list' => $principal_list);
                break;

            case 'reevaluation':
                $this->template->set('file_javascript', array('javascripts/recruitment/index.js?version=1'));

                $q_mr = "";
                $q_prin = "";

                if(isset($_POST['selectMR']) && $_POST['selectMR'] <> ''){
                    $q_mr = "and l.manpower_id = {$_POST['selectMR']}";
                }

                if(isset($_POST['selectPrincipal']) && $_POST['selectPrincipal'] <> ''){
                    $q_prin = "and m.principal_id = {$_POST['selectPrincipal']}";
                }

                $list = getdata("select l.id, l.applicant_id, i.fname, i.mname, i.lname, i.status as app_status, i.mobile_no, l.lineup_status, l.lineup_acceptance, i.status, j.pos_id, p.desc as position, l.manpower_id, m.code as mr_ref, m.principal_id, pr.name as principal, s.interview_date, l.interview_sched_id, i.application_source
                                from applicant_web_lineup l
                                left join applicant_general_info i
                                on l.applicant_id = i.id
                                left join manager_jobs j
                                on l.mr_pos_id = j.id
                                left join settings_position p
                                on j.pos_id = p.id
                                left join manager_mr m
                                on l.manpower_id = m.id
                                left join manager_principal pr
                                on m.principal_id = pr.id
                                left join manager_interview_schedule s
                                on l.interview_sched_id = s.id
                                where 1
                                and l.re_evaluation = 'Y'
                                and (l.lineup_status is null OR l.lineup_status not in ('Selected','Rejected'))
                                and (l.lineup_acceptance is null OR l.lineup_acceptance not in ('Accepted'))
                                and l.deployment_date = '0000-00-00 00:00:00'
                                and i.status not in ('BACKOUT', 'BLACKLISTED', 'DEPLOYED', 'SELECTED - ACCEPTED')
                                and l.manpower_id is not null
                                {$q_mr}
                                {$q_prin}
                                order by pr.name asc, i.lname asc");

                    $applicants = array();
                    $online_applicants = array();
                    $app_ids = array();
                    $mr_list = array();
                    $principal_list = array();

                    if($list){
                        foreach ($list as $i){
                            $applicants[$i['id']] = $i;

                            array_push($app_ids, $i['applicant_id']);
                            $mr_list[$i['manpower_id']] = $i['mr_ref'];
                            $principal_list[$i['principal_id']] = strtoupper($i['principal']);
                        }
                    }

                    $data = array('list' => $applicants, 'mr_list' => $mr_list, 'principal_list' => $principal_list);
                break;

            case 'client_interview':
                $this->template->set('file_javascript', array('javascripts/recruitment/index.js?version=1'));

                $today = date("Y-m-d");
                $list = getdata("select l.id, l.applicant_id, i.status as app_status, i.fname, i.mname, i.lname, i.mobile_no, l.manpower_id, mr.code as mr_ref, l.mr_pos_id, j.pos_id, pos.`desc` as position, s.interview_date, l.interview_sched_id, pr.name as principal
                                from manager_interview_schedule s
                                left join applicant_lineup l
                                on s.id = l.interview_sched_id
                                left join applicant_general_info i
                                on l.applicant_id = i.id
                                left join manager_mr mr
                                on l.manpower_id = mr.id
                                left join manager_jobs j
                                on l.mr_pos_id = j.id
                                left join settings_position pos
                                on j.pos_id = pos.id
                                left join manager_principal pr
                                on mr.principal_id = pr.id
                                where 1
                                and s.interview_date>='{$today} 00:00:00'
                                and s.interview_date<='{$today} 23:59:59'
                                and i.last_reporting_date >= '{$today} 00:00:00'
                                and l.interview_confirmed = 'Y'
                                and (l.lineup_status is null OR l.lineup_status not in ('Selected','Rejected','Standby'))
                                and i.status in ('ACTIVE','RESERVED')
                                and mr.status = 1
                                and j.pos_id is not null
                                order by pr.name asc, i.lname asc");

                    $applicants = array();
                    $mr_list = array();
                    if($list){
                        foreach ($list as $i){
                            $mr_list[$i['manpower_id']] = $i['mr_ref']." - ".$i['principal'];
                            if(isset($_POST['SelectMR']) && $_POST['SelectMR'] <> ''){
                                if($_POST['SelectMR'] == $i['manpower_id']){
                                    $applicants[$i['id']] = $i;
                                }
                            }else{
                                $applicants[$i['id']] = $i;
                            }
                        }
                    }

                    $data = array('list' => $applicants, 'mr_list' => $mr_list);
                break;

            case 'pra':
                $this->template->set('file_javascript', array('javascripts/recruitment/pra.js?version=1'));
                $list = getdata("select p.*, pr.name as principal, u.name
                                from manager_pra p
                                left join manager_principal pr
                                on p.principal_id = pr.id
                                left join settings_users u
                                on p.user_id = u.id
                                where 1
                                order by p.add_date desc");
                $req_list = array();
                $signed_list = array();
                $rel_list = array();
                $arc_list = array();
                if($list){
                    foreach ($list as $i){
                        if($i['status']=='Requested'){
                            $req_list[$i['id']] = $i;
                        }else if($i['status']=='Signed'){
                            $signed_list[$i['id']] = $i;
                        }else if($i['status']=='Released'){
                            $rel_list[$i['id']] = $i;
                        }else{
                            $arc_list[$i['id']] = $i;
                        }
                    }
                }

                $data = array('req_list' => $req_list, 'signed_list' => $signed_list, 'rel_list' => $rel_list, 'arc_list' => $arc_list);
                break;
            
            default:
                //$this->template->set('file_javascript', array('javascripts/recruitment/index.js',));
                redirect('home/dashboard', 'refresh');
                break;
        }
        
        $this->template->view('recruitment/'.$what.'_index', $data);
    }

    public function forms($what, $id=NULL, $tab="jobs"){
        //$this->template->set('file_javascript', array('javascripts/recruitment/index.js',));
        $data = array();

        switch ($what){
            case 'cv_transmittal':
                $this->template->set('file_javascript', array('javascripts/recruitment/cvtransmittal.js','javascripts/recruitment/index.js'));
                
                if($id){
                    get_items_from_cache('principal');
                    $tbl_name = "manager_cv_transmittal";
                    $data['info'] = getdata("select * from {$tbl_name} where id = {$id}");
                    
                    $data['app_list']= getdata("select l.applicant_id, g.fname, g.mname, g.lname, g.status, pos.`desc` as position, l.id as lineup_id
                                                from applicant_lineup l
                                                left join applicant_general_info g
                                                on l.applicant_id = g.id
                                                left join manager_mr mr
                                                on l.manpower_id = mr.id
                                                left join manager_jobs j
                                                on l.mr_pos_id = j.id
                                                left join settings_position pos
                                                on j.pos_id = pos.id
                                                left join applicant_cv_status cv
                                                on (l.applicant_id = cv.applicant_id and cv.transmittal_id={$id})
                                                where 1
                                                and mr.principal_id = {$data['info'][0]['principal_id']}
                                                and g.status in ('ACTIVE')
                                                and cv.id is null");
                }
                break;
                
            case 'form_mr_manager':
                $this->template->set('file_javascript', array('javascripts/recruitment/index.js','javascripts/recruitment/mr_manager.js'));
                $data['current_tab'] = $tab;
                
                if($id){
                    get_items_from_cache('principal');
                    $tbl_name = "manager_mr";
                    $data['info'] = getdata("select * from {$tbl_name} where id = {$id}");

                    if(!$data['info']){
                        redirect('recruitment/lists/mr_manager', 'refresh');
                    }
                }
                break;
        }

        $this->template->view('recruitment/'.$what, $data);
    }

    public function create($what){
        $this->load->model('recruitment_model');
        $id = $this->recruitment_model->save($what);

        if($id){
            /* UPLOAD FILE */
            if($what == 'form_mr_manager'){
                if($_FILES['fileJDQ']['tmp_name']){
                    $config['upload_path']         = "./uploads/principal/".$_POST['selectPrincipal']."/mr/".$id."/";
                    $config['allowed_types']       = 'pdf|doc|PDF|docx|gif|jpg|png|jpeg|JPG|JPEG|PNG';
                    $config['max_size']            = 20480; /* 20MB */
                    $config['file_name']           = "jdq";
                    
                    /* CHECK IF UPLOAD FOLDER EXIST */
                    if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
                    
                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);
                    
                    if ( ! $this->upload->do_upload("fileJDQ")){
                        /* ERROR */
                        $this->session->set_flashdata('settings_notification_status', 'Error');
                        $this->session->set_flashdata('settings_notification', $this->upload->display_errors());
                    }else{
                        /* UPDATE DB */
                        $uploaded_file = $this->upload->data();
                        $fld_value = $config['upload_path'].$uploaded_file['file_name'];
                        dbsetdata("update manager_mr set doc_jdq = '{$fld_value}' where id = {$id}");
                    }
                }
            }

            redirect('recruitment/forms/'.$what.'/'.$id, 'refresh');
        }else{
            redirect('recruitment/forms/'.$what, 'refresh');
        }
//         var_dump($what);
//         var_dump($_POST);
    }
    
    public function delete($what=NULL, $id=NULL){
        if($what && $id){
            switch ($what){
                case 'cv_transmittal':
                    $tbl = "manager_cv_transmittal";
                    break;
                    
                case 'mr_manager':
                    $tbl = "manager_mr";
                    
                    /* DELETE JDQ */
                    $jdq_file = getdata("select principal_id,doc_jdq from manager_mr where id = {$id}");
                    if($jdq_file[0]['doc_jdq']){
                        $this->load->helper("file");
                        delete_files("./uploads/principal/{$jdq_file[0]['principal_id']}/mr/{$id}", true , false, 1);
                    }
                    break;
                    
                case 'jo':
                    $jo_info = getdata("select mr_id from manager_jobs where id = {$id}");
                    $mr_id = $jo_info[0]['mr_id'];
                    $tbl = "manager_jobs";
                    break;
                    
                case 'mr_sched':
                    $sched_info = getdata("select mr_id from manager_interview_schedule where id = {$id}");
                    $mr_id = $sched_info[0]['mr_id'];
                    $tbl = "manager_interview_schedule";
                    break;
            }

            $this->load->model('recruitment_model');
            $this->recruitment_model->delete($tbl, $id);

            if($what == 'jo'){
                redirect('recruitment/forms/form_mr_manager/'.$mr_id.'/jobs', 'refresh');
            }else if($what == 'mr_sched'){
                redirect('recruitment/forms/form_mr_manager/'.$mr_id.'/sched', 'refresh');
            }else{
                redirect('recruitment/lists/'.$what, 'refresh');
            }
        }else{
            redirect('home/dashboard', 'refresh');
        }
    }

    public function ajax_cv_selected(){
        $html = "";
        $cvinfo = getdata("select * from manager_cv_transmittal where id = {$_GET['id']}");

        if($cvinfo){
            $data['app_list'] = getdata("select l.applicant_id, g.fname, g.mname, g.lname, g.status, pos.`desc` as position, cv.status as cv_stat, cv.id as cv_stat_id,             cv.add_date as cv_date, cv.sent_date, cv.reviewed_date, cv.select_date, mr.code as mr_ref
                                        from applicant_cv_status cv
                                        left join applicant_lineup l
                                        on cv.lineup_id = l.id
                                        left join applicant_general_info g
                                        on l.applicant_id = g.id
                                        left join manager_mr mr
                                        on l.manpower_id = mr.id
                                        left join manager_jobs j
                                        on l.mr_pos_id = j.id
                                        left join settings_position pos
                                        on j.pos_id = pos.id
                                        where 1
                                        and cv.transmittal_id = {$_GET['id']}
                                        and g.status in ('ACTIVE','RESERVED')
                                        order by cv.status asc, g.lname asc");
            $html = $this->load->view('recruitment/ajax_cv_transmittal_selected', $data, true);
        }
        
        echo $html;
    }
    
    public function ajax_cv_status(){
        $this->load->model('recruitment_model');
        $id = $this->recruitment_model->save('applicant_cv_status');
    }
    
    public function ajax_multiple_cv_status(){
        $this->load->model('recruitment_model');
        $id = $this->recruitment_model->save('multiple_cv_status');
        echo $id;
    }
    
    public function facebox($form_name){
        switch ($form_name){
            case 'form_mr_pos':
                $data['mr_id'] = $_GET['mr_id'];
                $mr_info = getdata("select * from manager_mr where id = {$_GET['mr_id']}");
                $data['principal_id'] = $mr_info[0]['principal_id'];
                $data['company_id'] = $mr_info[0]['company_id'];

                if(isset($_GET['id'])){
                    $data['info'] = getdata("select j.*, m.code as mr_ref
                                            from manager_jobs j
                                            left join manager_mr m
                                            on j.mr_id = m.id
                                            where j.id = {$_GET['id']}");
                }

                echo $this->load->view('recruitment/'.$form_name, $data, TRUE);
                break;
                
            case 'form_mr_sched':
                $data['mr_id'] = $_GET['mr_id'];

                if(isset($_GET['id'])){
                    $data['info'] = getdata("select * from manager_interview_schedule where id = {$_GET['id']}");
                }
                
                echo $this->load->view('recruitment/'.$form_name, $data, TRUE);
                break;

            case 'form_pra':
                $data = array();
                if(isset($_GET['id'])){
                    $data['info'] = getdata("select * from manager_pra where id = {$_GET['id']}");
                }
                
                echo $this->load->view('recruitment/'.$form_name, $data, TRUE);
                break;

            case 'form_stat_changer':
                $data['show_attention'] = FALSE;
                $data['submitted_req']['PEOS Certificate'] = FALSE;
                $data['submitted_req']['POEA E-Registration'] = FALSE;

                if(isset($_GET['lineup_id'])){
                    $data['lineup_info'] = getdata("select l.id, l.applicant_id, i.fname, i.mname, i.lname, i.status as app_status, i.mobile_no, l.lineup_status, l.lineup_acceptance, i.status, j.pos_id, p.desc as position, l.manpower_id, m.code as mr_ref, m.principal_id, pr.name as principal, s.interview_date, l.interview_sched_id, l.mr_pos_id, '' as company, l.select_date, l.approval_date, l.remarks, l.contract_period, l.deployment_date, l.is_deployed, '' as mr_status, '1' as jo_status
                                                    from applicant_lineup l
                                                    left join applicant_general_info i
                                                    on l.applicant_id = i.id
                                                    left join manager_jobs j
                                                    on l.mr_pos_id = j.id
                                                    left join settings_position p
                                                    on j.pos_id = p.id
                                                    left join manager_mr m
                                                    on l.manpower_id = m.id
                                                    left join manager_principal pr
                                                    on m.principal_id = pr.id
                                                    left join manager_interview_schedule s
                                                    on l.interview_sched_id = s.id
                                                    where 1
                                                    and l.id = {$_GET['lineup_id']}");

                    /*CHECK IF PEOS/EREG IS UPLOADED*/
                    $q_uploads = getdata("select * from applicant_uploads where 1 and applicant_id={$data['lineup_info'][0]['applicant_id']} and description in ('PEOS Certificate','POEA E-Registration')");
                    if($q_uploads && count($q_uploads) > 1){
                        foreach($q_uploads as $u){
                            if($u['filename'] <> ''){
                                $data['submitted_req'][$u['description']] = TRUE;
                            }
                        }
                    }else{
                        $data['show_attention'] = TRUE;
                        $data['attention_msg'] = "PEOS Certificate and POEA E-Registration required.";
                    }
                }

                echo $this->load->view('recruitment/'.$form_name, $data, TRUE);
                break;
                
            default:
                $data['ids'] = $_GET['ids'];
                $this->load->view('recruitment/'.$form_name, $data);
                break;
        }
    }

    public function save($what){
        $this->load->model('recruitment_model');
        $id = $this->recruitment_model->save($what);

        if($what == 'jo'){
            redirect('recruitment/forms/form_mr_manager/'.$_POST['textMrId'], 'refresh');
        }else if($what == 'mr_sched'){
            redirect('recruitment/forms/form_mr_manager/'.$_POST['textMrId'].'/sched', 'refresh');
        }else if($what == 'pra'){
            /*UPLOAD ATTACHED DOCS*/
            $docs = upload_file('textFile', "./uploads/principal/".$_POST['selectPrincipal']."/pra/", $_POST['selectType'].'_doc_'.$_POST['textRecordId']);
            if(!is_array($docs)){
                $this->session->set_flashdata('settings_notification_status', 'Error');
                $this->session->set_flashdata('settings_notification', $docs);
            }else{
                $file_path = "./uploads/principal/".$_POST['selectPrincipal']."/pra/".$docs['file_name'];
                dbsetdata("update manager_pra set file = '{$file_path}' where id = {$_POST['textRecordId']}");
            }

            /*UPLOAD RECIEVING COPY*/
            $rcv_copy = upload_file('textRcvCopy', "./uploads/principal/".$_POST['selectPrincipal']."/pra/", $_POST['selectType'].'_rcvcopy_'.$_POST['textRecordId']);
            if(!is_array($rcv_copy)){
                $this->session->set_flashdata('settings_notification_status', 'Error');
                $this->session->set_flashdata('settings_notification', $rcv_copy);
            }else{
                $file_path = "./uploads/principal/".$_POST['selectPrincipal']."/pra/".$rcv_copy['file_name'];
                dbsetdata("update manager_pra set rcv_copy = '{$file_path}' where id = {$_POST['textRecordId']}");
            }

            redirect('recruitment/lists/pra', 'refresh');
        }
    }

    public function ajax_functions($what){
        switch($what){
            case 'get_mr_code':
                //echo generateMRRef($_GET['p_id']);
                echo generateMRCode();
                break;

            case 'get_calendar_sched':
                $bg_color = array('#f56954','#f39c12','#0073b7','#00c0ef','#00a65a','#3c8dbc');
                $all_sched = getdata("select mr.code as mr_ref, pr.name as principal, s.*
                                    from manager_interview_schedule s
                                    left join manager_mr mr
                                    on s.mr_id = mr.id
                                    left join manager_principal pr
                                    on mr.principal_id = pr.id
                                    where 1
                                    and mr.status = 1");
                $sched_data = array();
                if($all_sched){
                    foreach($all_sched as $v){
                        $this_bg_color = $bg_color[array_rand($bg_color)];
                        $status = ($v['status']==1)?"confirmed":"tentative";
                        $sched_data[] = array('title' => $v['mr_ref']." ({$status})",
                                                'description' => strtoupper($v['principal'])."<br>".strtolower($v['venue']),
                                                'start' => date('r', strtotime($v['interview_date'])),
                                                'allDay' => true,
                                                'backgroundColor' => $this_bg_color,
                                                'borderColor' => $this_bg_color,
                                                'url'=>BASE_URL.'recruitment/forms/form_mr_manager/'.$v['mr_id']);
                    }
                }

                echo json_encode(array('sched_data'=>$sched_data));
                break;

            case 'delete_attachment':
                if($_GET['what'] == 'file' || $_GET['what'] == 'rcv_copy'){
                    $fileinfo = getdata("select {$_GET['what']} from manager_pra where id = {$_GET['id']}");

                    /*DELETE FROM DB*/
                    if(dbsetdata("update manager_pra set {$_GET['what']} = '' where id = {$_GET['id']}")){

                        /* DELETE FROM UPLOADS FOLDER */
                        unlink($fileinfo[0][$_GET['what']]);

                        /*LOGS*/
                        create_log("user", "", $_SESSION['rs_user']['username'], "delete", "manager_pra delete {$_GET['what']} id:{$_GET['id']}");
                    }else{
                        echo "error";
                    }
                }
                break;
        }
        
        exit();
    }
    
    public function ajax_tab(){
        switch($_GET['tab']){
            case 'jobs':
                $data['mr_id'] = $_GET['mr_id'];
                $data['info'] = getdata("select pos.desc as position, j.id, j.target, j.required, j.status, j.gender, j.religion, j.expiry_date
                                        from manager_jobs j
                                        left join settings_position pos
                                        on j.pos_id = pos.id
                                        where 1
                                        and mr_id = {$_GET['mr_id']}
                                        order by pos.desc asc");
                break;

            case 'sched':
                $data['mr_id'] = $_GET['mr_id'];
                $data['info'] = getdata("select * from manager_interview_schedule
                                        where 1
                                        and mr_id = {$_GET['mr_id']}
                                        order by add_date asc");
                break;
                
            case 'applicants':
                $data['mr_id'] = $_GET['mr_id'];
                $data['info'] = getdata("select l.id as lineup_id, i.id as applicant_id, i.fname, i.mname, i.lname, i.status, pos.desc as position, l.lineup_status, l.lineup_acceptance, l.add_date
                                        from applicant_lineup l
                                        left join applicant_general_info i
                                        on l.applicant_id = i.id
                                        left join manager_jobs j
                                        on l.mr_pos_id = j.id
                                        left join settings_position pos
                                        on j.pos_id = pos.id
                                        where 1
                                        and l.manpower_id = {$_GET['mr_id']}
                                        and i.id is not null
                                        order by i.lname asc");
                break;

            default:
                $data = array();
                break;
        }

        echo $this->load->view('recruitment/tab_'.$_GET['tab'], $data, TRUE);
    }

    public function calendar(){
        $this->template->set('file_javascript', array('vendor/fullcalendar/moment.min.js', 'vendor/fullcalendar/fullcalendar.min.js', 'javascripts/recruitment/calendar.js',));
        $data = array();
        $this->template->view('recruitment/calendar_index', $data);
    }

    /*link to view files in uploads folder*/
    public function files($what, $id){
        if($id){
            $id= base64_decode($id);
            $table = "manager_principal";

            if(is_numeric($id)){
                if($what == 'logo'){
                    $field = "doc_logo";
                }else if($what == 'svc'){
                    $field = "doc_svc_agree";
                }else if($what == 'mr'){
                    $field = "doc_jdq";
                    $table = "manager_mr";
                }else if($what == 'pra_file'){
                    $field = "file";
                    $table = "manager_pra";
                }else if($what == 'pra_rcv_copy'){
                    $field = "rcv_copy";
                    $table = "manager_pra";
                }else{
                    $field = "doc_rec";
                }

                $files = getdata("select {$field} as filename from {$table} where id = {$id}");
                
                if($files){
                    $this->load->helper('file');
                    $path_to_file = $files[0]['filename'];
                    
                    if (file_exists($path_to_file)){
                        header('Content-Type: '.get_mime_by_extension($path_to_file));
                        readfile($path_to_file);
                    }
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }else{
            return false;
        }
    }

    public function ajax_web_lineup(){
        $lineup_info = getdata("select * from applicant_web_lineup where id = {$_GET['id']}");
        $return = "success";

        switch ($_GET['action']) {
            case 'del':
                /*DELETE FROM DB*/
                if(dbsetdata("delete from applicant_web_lineup where id = {$_GET['id']}")){
                    /*LOGS*/
                    create_log("user", $lineup_info[0]['applicant_id'], $_SESSION['rs_user']['username'], "delete", "web lineup");
                }else{
                    $return = "error";
                }
                break;

            case 'add':
                /*MOVE TO LINEUP TBL*/
                if(dbsetdata("insert into applicant_lineup (applicant_id,manpower_id, mr_pos_id, add_date, add_by, edit_date, edit_by)
                                select applicant_id, manpower_id, mr_pos_id, add_date, add_by, NOW() as edit_date, '{$_SESSION['rs_user']['username']}' as edit_by
                                from applicant_web_lineup
                                where id = {$_GET['id']}")){

                    /*LOGS*/
                    create_log("user", $lineup_info[0]['applicant_id'], $_SESSION['rs_user']['username'], "add", "confirm web lineup");

                    /*DELETE FROM WEB LINEUP TBL*/
                    dbsetdata("delete from applicant_web_lineup where id = {$_GET['id']}");
                }else{
                    $return = "error";
                }
                break;

            default:
                /*RE-EVALUATE*/
                if(dbsetdata("update applicant_web_lineup set re_evaluation='Y', edit_date=NOW(), edit_by = '{$_SESSION['rs_user']['username']}' where id = {$_GET['id']}")){
                    /*LOGS*/
                    create_log("user", $lineup_info[0]['applicant_id'], $_SESSION['rs_user']['username'], "re-evaluate", "web lineup");
                }else{
                    $return = "error";
                }
                break;
        }

        echo $return;
        exit();
    }

    public function test(){
        // print(date_default_timezone_get());
        // echo "<br>";
        // echo date("Y-m-d h:i:sa");
        upload_file(1,2,3);
    }
}