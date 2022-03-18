<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_operations extends MY_Controller{

    public $stat_report_cols = array('Name'=>array('col_name','disabled','',''),
                                    'Status'=>array('col_stat','','','app_status'),
                                    'Position'=>array('col_pos','','','position'),
                                    'MR Ref.'=>array('col_mr','','class="text-center"','mr_ref'),
                                    'Interview Status'=>array('col_intstat','','class="text-center"','lineup_status'),
                                    'Acceptance'=>array('col_accept','','class="text-center"','lineup_acceptance'),
                                    'Select Date'=>array('col_seldate','','class="text-center"',''),
                                    'Approval Date'=>array('col_appdate','','class="text-center"',''),
                                    'NBI Status'=>array('col_nbistat','','class="text-center"',''),
                                    'NBI Expiry'=>array('col_nbiexp','','class="text-center"',''),
                                    'PPT Status'=>array('col_pptstat','','class="text-center"',''),
                                    'PPT Expiry'=>array('col_pptexp','','class="text-center"',''),
                                    'Medical Status'=>array('col_medstat','','class="text-center"','med_result'),
                                    'Med Exam Date'=>array('col_medexam','','class="text-center"',''),
                                    'Med Expiry'=>array('col_medexp','','class="text-center"',''),
                                    'Internal Advisory'=>array('col_intadv','','',''),
                                    'Applicant Advisory'=>array('col_appadv','','',''),);

    public $stat_report_rows = array('DEPLOYED' => array('row_deployed','#ff69b4','#ffdfef'),
                                    'FOR DEPLOYMENT' => array('row_fordep','#99cc00','#000'),
                                    'SELECTED' => array('row_selected','#1e90ff','#000'),
                                    'DROPPED' => array('row_dropped','#ffff66','#000'),
                                    'UNFIT' => array('row_unfit','#ff0000','#ffdfef'),);

    public function __construct(){
        parent::__construct();
        
        $this->load->helper(array('text'));
    }
    
	public function index($what)
	{
	    $data = $this->fetch_raw_data($what);

	    switch ($what){
	        case 'for_medical':
	            $data['print'] = FALSE;
	            break;

			case 'for_endorsement':
	            $data['print'] = FALSE;
	            break;

            case 'project_distribution':
                $this->template->set('file_javascript', array('javascripts/reports/operations_index.js?version=1'));
                $data['print'] = FALSE;
                break;
	            
	        default:
	    }

	    $this->template->view('reports/operations/'.$what.'_index', $data);
	}
	
	public function forms($what){
	    $data = array();
	    switch($what){
	        case 'deployment':
                $q = getdata("select j.principal_id, prin.name as principal, prin.country_id, c.name as country, j.pos_id, pos.`desc` as position, i.application_source, s.`desc` as source, i.add_by as encoder
                            from applicant_lineup l
                            left join manager_jobs j
                            on l.mr_pos_id = j.id
                            left join manager_principal prin
                            on j.principal_id = prin.id
                            left join settings_country c
                            on prin.country_id = c.id
                            left join settings_position pos
                            on j.pos_id = pos.id
                            left join applicant_general_info i
                            on l.applicant_id = i.id
                            left join settings_application_source s
                            on i.application_source = s.id
                            where l.is_deployed='Y'");

                $data['principals'] = array();
                $data['countries'] = array();
                $data['categories'] = array();
                $data['sources'] = array();
                $data['encoders'] = array();
                if($q && count($q) > 0){
                    foreach($q as $d){
                        $data['principals'][$d['principal_id']] = strtoupper($d['principal']);
                        $data['countries'][$d['country_id']] = strtoupper($d['country']);
                        $data['categories'][$d['pos_id']] = strtoupper($d['position']);
                        $data['sources'][$d['application_source']] = strtoupper($d['source']);
                        if($d['encoder'] <> ''){
                            $data['encoders'][$d['encoder']] = strtoupper($d['encoder']);
                        }
                    }
                }

                asort($data['principals']);
                asort($data['countries']);
                asort($data['categories']);
                asort($data['sources']);
                asort($data['encoders']);

	            $form_name = "deployment_index";
	            break;
	        case 'stat_monitor':
	            $form_name = "stat_monitor_index";
	            break;
            case 'adv_stat':
                $q = getdata("select l.manpower_id as id, concat(mr.code,' - ',pr.name) as `desc`
                                from applicant_lineup l
                                left join applicant_general_info i
                                on l.applicant_id = i.id
                                left join manager_jobs j
                                on l.mr_pos_id = j.id
                                left join manager_principal pr
                                on j.principal_id = pr.id
                                left join manager_mr mr
                                on j.mr_id = mr.id
                                where 1
                                and l.manpower_id <> 0
                                and mr.principal_id <> 0
                                and mr.expiry_date > '".date("Y-m-d")." 00:00:00'
                                group by l.manpower_id");

                foreach($q as $i){
                    $data['list_mr'][$i['id']] = $i['desc'];
                }

                $data['list_col'] = $this->stat_report_cols;
                $data['list_row'] = $this->stat_report_rows;

                $form_name = "adv_stat_report_index";
                break;
            case 'accounts':
                /*CHECK IF USER HAVE ACCESS IN ACCOUNTS*/
                if(!in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('accounts_card_view'))){
                    redirect('home/dashboard', 'refresh');
                }
                
                $q = getdata("select mr.code, l.manpower_id, mr.principal_id, p.name as principal
                            from applicant_accounts_card a
                            left join applicant_lineup l
                            on a.lineup_id = l.id
                            left join applicant_general_info i
                            on a.applicant_id = i.id
                            left join manager_mr mr
                            on l.manpower_id = mr.id
                            left join manager_principal p
                            on mr.principal_id = p.id
                            where 1
                            and l.manpower_id is not null
                            and mr.principal_id is not null
                            group by l.manpower_id
                            order by p.name asc");

                foreach($q as $i){
                    $data['list_mr'][$i['manpower_id']] = $i['code'];
                    $data['list_principal'][$i['principal_id']] = strtoupper($i['principal']);
                }

                $form_name = "accounts_index";
                break;
            case 'welfare':
                $form_name = "welfare_index";
                break;
            case 'daily_cash':
                /*CHECK IF USER HAVE ACCESS IN ACCOUNTS*/
                if(!in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('accounts_card_view'))){
                    redirect('home/dashboard', 'refresh');
                }
                
                // $q = getdata("select mr.code, l.manpower_id, mr.principal_id, p.name as principal
                //             from applicant_accounts_card a
                //             left join applicant_lineup l
                //             on a.lineup_id = l.id
                //             left join applicant_general_info i
                //             on a.applicant_id = i.id
                //             left join manager_mr mr
                //             on l.manpower_id = mr.id
                //             left join manager_principal p
                //             on mr.principal_id = p.id
                //             where 1
                //             and l.manpower_id is not null
                //             and mr.principal_id is not null
                //             group by l.manpower_id
                //             order by p.name asc");

                // foreach($q as $i){
                //     $data['list_mr'][$i['manpower_id']] = $i['code'];
                //     $data['list_principal'][$i['principal_id']] = strtoupper($i['principal']);
                // }
                $form_name = "daily_cash_index";
                break;

            case 'candidate_in_process':
                $form_name = "candidate_in_process_index";
                break;
	    }
	    
	    $this->template->view('reports/operations/'.$form_name, $data);
	}

	public function print_report($what){
	    $data = $this->fetch_raw_data($what);
	    switch($what){
	        case 'deployment':
	            if($_POST['SelectType'] == '1'){
	                $print_file = "deployment_sum_print";
	            }else if($_POST['SelectType'] == '2'){
	                $print_file = "deployment_dtl_print";
	            }else if($_POST['SelectType'] == '3'){
                    $print_file = "deployment_dtl_poea";
                }else if($_POST['SelectType'] == '4'){
                    $print_file = "deployment_dtl_fin";
                }else if($_POST['SelectType'] == '5'){
                    $this->load->view('reports/operations/deployment_dtl_pos', $data);
                    return true;
                }

	            break;
	            
	        case 'for_medical':
	            $print_file = "for_medical_index";
	            $data['print'] = TRUE;
	            break;

	        case 'for_endorsement':
	            $print_file = "for_endorsement_index";
	            $data['print'] = TRUE;
	            break;

            case 'candidate_in_process':
                $this->load->view('reports/operations/candidate_in_process_print', $data);
                return true;
                break;

	        default:
	            $print_file = $what."_print";
	    }

	    $this->template->set_template('template_print');
	    $this->template->view('reports/operations/'.$print_file, $data);
	}

	public function fetch_raw_data($what){
	    if($what == 'deployment'){
	        $qry_where = "";
            $qry_country = "";
            $qry_category = "";
            $qry_source = "";
            $qry_encoder = "";
            $q_join = "";
            $q_fields = "";
            $q_order_by = "order by pr.name, i.lname";

	        if($_POST['SelectPrincipal']){
	            $qry_where = " and j.principal_id = {$_POST['SelectPrincipal']}";
	        }

            if($_POST['SelectType'] == 4){
                $qry_where_date = " and (l.contract_fin_date >= '".dateformat($_POST['textStDate'],0)." 00:00:00' and l.contract_fin_date <= '".dateformat($_POST['textEnDate'],0)." 23:59:59')";
            }else{
                $qry_where_date = " and (l.deployment_date >= '".dateformat($_POST['textStDate'],0)." 00:00:00' and l.deployment_date <= '".dateformat($_POST['textEnDate'],0)." 23:59:59')";
            }

            if($_POST['SelectCountry']){
                $qry_country = " and pr.country_id = {$_POST['SelectCountry']}";
            }

            if($_POST['selectCategory']){
                $qry_category = " and j.pos_id = {$_POST['selectCategory']}";
            }

            if($_POST['selectSource']){
                $qry_source = " and i.application_source = {$_POST['selectSource']}";
            }

            if($_POST['selectUser']){
                $qry_encoder = " and i.add_by = '{$_POST['selectUser']}'";
            }

            if($_POST['SelectType'] == 5){
                $q_join = "left join applicant_employment_offer e
                            on l.id = e.lineup_id
                            left join settings_currency cu
                            on e.salary_currency = cu.id";

                $q_fields = ", concat(cu.currency_code,' ',e.salary_amount) as salary";
                $q_order_by = "order by pos.`desc`, pr.name, i.lname";
            }

	        $info = getdata("select l.applicant_id, l.select_date, l.deployment_date, l.contract_period, i.fname, i.mname, i.lname, pr.name as principal, j.principal_id, mr.code as mr_ref, j.mr_id, pos.`desc` as `position`, sc.name as country, l.contract_fin_date, j.pos_id {$q_fields}
                            from applicant_lineup l
                            left join applicant_general_info i
                            on l.applicant_id = i.id
                            left join manager_jobs j
                            on l.mr_pos_id = j.id
                            left join manager_principal pr
                            on j.principal_id = pr.id
                            left join manager_mr mr
                            on j.mr_id = mr.id
                            left join settings_position pos
                            on j.pos_id = pos.id
                            left join settings_country sc
                            on pr.country_id = sc.id
                            {$q_join}
                            where 1
                            and l.is_deployed='Y'
                            {$qry_where_date}
                            {$qry_where}
                            {$qry_country}
                            {$qry_category}
                            {$qry_source}
                            {$qry_encoder}
                            and j.principal_id is not null
                            {$q_order_by}");

	        $principals = array();
	        $deployed = array();
            $deployed_by_pos = array();
            $positions = array();

	        if($info){
	            foreach ($info as $i){
	                $principals[$i['principal_id']] = $i['principal'];
	                $deployed[$i['principal_id']][$i['applicant_id']] = $i;
                    $deployed_by_pos[$i['pos_id']][$i['applicant_id']] = $i;
                    $positions[$i['pos_id']] = $i['position'];
	            }
	        }

            if(isset($_POST['btn_excel'])){
                $excel = TRUE;
            }else{
                $excel = FALSE;
            }

	        return array('list_principal' => $principals, 'list_deployed' => $deployed, 'deployed_by_pos' => $deployed_by_pos, 'positions' => $positions, 'excel' => $excel);
	    }else if($what == 'stat_monitor'){
	        $qry_where = "";
	        if($_POST['SelectPrincipal']){
	            $qry_where = " and j.principal_id = {$_POST['SelectPrincipal']}";
	        }
	        
	        $info = getdata("select l.applicant_id, i.fname, i.mname, i.lname, pr.name as principal, j.principal_id, mr.code as mr_ref, j.mr_id, pos.`desc` as `position`, l.select_date, l.approval_date,
                            m.med_result, m.clinic_exam_date as exam_date, m.med_result_exp_date as med_expiry, ppt.expiry_date as ppt_expiry, nbi.expiry_date as nbi_expiry
                            from applicant_lineup l
                            left join applicant_general_info i
                            on l.applicant_id = i.id
                            left join manager_jobs j
                            on l.mr_pos_id = j.id
                            left join manager_principal pr
                            on j.principal_id = pr.id
                            left join manager_mr mr
                            on j.mr_id = mr.id
                            left join settings_position pos
                            on j.pos_id = pos.id
                            left join applicant_medical_info m
                            on l.applicant_id = m.applicant_id
                            left join applicant_uploads ppt
                            on l.applicant_id = ppt.applicant_id and ppt.description = 'Passport'
                            left join applicant_uploads nbi
                            on l.applicant_id = nbi.applicant_id and nbi.description = 'NBI Clearance'
                            where 1
                            and i.status = 'MOBILIZATION'
                            {$qry_where}
                            order by pr.name, i.lname");
                            
                            $principals = array();
                            $applicants = array();
                            $app_ids = array();
                            if($info){
                                foreach ($info as $i){
                                    $principals[$i['principal_id']] = $i['principal'];
                                    $applicants[$i['principal_id']][$i['applicant_id']] = $i;
                                    array_push($app_ids, $i['applicant_id']);
                                }
                            }
                            
                            return array('list_principal' => $principals, 'list_applicant' => $applicants, 'all_adv' => getAdvisory($app_ids));
	    }else if($what == 'for_medical'){
	        $info = getdata("select l.applicant_id, i.fname, i.mname, i.lname, i.email, i.status, mr.code as mr_ref, pr.name as principal, p.`desc` as position,
                                l.select_date, l.approval_date, m.id as med_id, nbi.add_date as nbi_rec_date, ppt.add_date as ppt_rec_date
                                from applicant_lineup l
                                left join applicant_general_info i
                                on l.id = i.lineup_id
                                left join manager_jobs j
                                on l.mr_pos_id = j.id
                                left join settings_position p
                                on j.pos_id = p.id
                                left join manager_principal pr
                                on j.principal_id = pr.id
                                left join manager_mr mr
                                on j.mr_id = mr.id
                                left join applicant_medical_info m
                                on i.id = m.applicant_id and m.is_archived = 'N'
                                left join applicant_uploads nbi
                                on l.applicant_id = nbi.applicant_id and nbi.description = 'NBI Clearance'
                                left join applicant_uploads ppt
                                on l.applicant_id = ppt.applicant_id and ppt.description = 'Passport'
                                where 1
                                and lineup_status='Selected'
                                and lineup_acceptance='Accepted'
                                and is_deployed='N'
                                and l.select_date <> '0000-00-00 00:00:00'
                                and l.approval_date <> '0000-00-00 00:00:00'
                                and i.status = 'MOBILIZATION'
                                and m.id is null
                                order by pr.name asc, i.lname asc");

            $applicants = array();
            $app_ids = array();
	        if($info){
	            foreach ($info as $i){
	                array_push($app_ids, $i['applicant_id']);
	                $applicants[$i['applicant_id']] = $i;
	            }
	        }

	        return array('list' => $applicants, 'all_adv' => getAdvisory($app_ids));
	    }else if($what == 'adv_stat_report'){
            /*ADVANCE STATUS REPORT*/
            $qry_where = "";
            if($_POST['SelectMR']){
                $qry_where = " and l.manpower_id = {$_POST['SelectMR']}";
            }else{
                redirect('reports/operations/forms/adv_stat', 'refresh');
            }
            
            $info = getdata("select l.applicant_id, i.status as app_status, i.fname, i.mname, i.lname, pr.name as principal, j.principal_id, mr.code as mr_ref, j.mr_id, pos.`desc` as `position`, l.select_date, l.approval_date, m.med_result, m.clinic_exam_date as exam_date, m.med_result_exp_date as med_expiry, ppt.expiry_date as ppt_expiry, nbi.expiry_date as nbi_expiry, l.lineup_status, l.lineup_acceptance, l.is_dropped, l.dropped_date
                            from applicant_lineup l
                            left join applicant_general_info i
                            on l.applicant_id = i.id
                            left join manager_jobs j
                            on l.mr_pos_id = j.id
                            left join manager_principal pr
                            on j.principal_id = pr.id
                            left join manager_mr mr
                            on j.mr_id = mr.id
                            left join settings_position pos
                            on j.pos_id = pos.id
                            left join applicant_medical_info m
                            on l.applicant_id = m.applicant_id
                            left join applicant_uploads ppt
                            on l.applicant_id = ppt.applicant_id and ppt.description = 'Passport'
                            left join applicant_uploads nbi
                            on l.applicant_id = nbi.applicant_id and nbi.description = 'NBI Clearance'
                            where 1
                            {$qry_where}
                            order by pr.name, i.lname");
                            
            $mr_info = array();
            $applicants = array();
            $app_ids = array();

            if($info){
                foreach ($info as $i){
                    $mr_info['principal'] = $i['principal'];
                    $mr_info['principal_id'] = $i['principal_id'];
                    $mr_info['mr_ref'] = $i['mr_ref'];
                    $mr_info['manpower_id'] = $_POST['SelectMR'];

                    if($i['app_status'] == 'DEPLOYED'){
                        /*DEPLOYED*/
                        $applicants['row_deployed'][$i['applicant_id']] = $i;
                    }else if($i['app_status'] == 'SELECTED - ACCEPTED' || $i['app_status'] == 'MOBILIZATION'){
                        if($i['is_dropped'] == 'Y' || $i['dropped_date'] <> '0000-00-00 00:00:00'){
                            /*DROPPED*/
                            $applicants['row_dropped'][$i['applicant_id']] = $i;
                        }else{
                            if(strtolower(trim($i['med_result'])) == 'unfit'){
                                /*UNFIT*/
                                $applicants['row_unfit'][$i['applicant_id']] = $i;
                            }else{
                                /*OPERATIONS*/
                                $applicants['row_selected'][$i['applicant_id']] = $i;
                            }
                        }
                    }

                    array_push($app_ids, $i['applicant_id']);
                }
            }

            return array('mr_info' => $mr_info, 'list_applicant' => $applicants, 'all_adv' => getAdvisory($app_ids), 'list_col' => $this->stat_report_cols, 'list_row' => $this->stat_report_rows);
        }else if($what == 'for_medical'){
            $info = getdata("select l.applicant_id, i.fname, i.mname, i.lname, i.email, i.status, mr.code as mr_ref, pr.name as principal, p.`desc` as position,
                                l.select_date, l.approval_date, m.id as med_id, nbi.add_date as nbi_rec_date, ppt.add_date as ppt_rec_date
                                from applicant_lineup l
                                left join applicant_general_info i
                                on l.id = i.lineup_id
                                left join manager_jobs j
                                on l.mr_pos_id = j.id
                                left join settings_position p
                                on j.pos_id = p.id
                                left join manager_principal pr
                                on j.principal_id = pr.id
                                left join manager_mr mr
                                on j.mr_id = mr.id
                                left join applicant_medical_info m
                                on i.id = m.applicant_id and m.is_archived = 'N'
                                left join applicant_uploads nbi
                                on l.applicant_id = nbi.applicant_id and nbi.description = 'NBI Clearance'
                                left join applicant_uploads ppt
                                on l.applicant_id = ppt.applicant_id and ppt.description = 'Passport'
                                where 1
                                and lineup_status='Selected'
                                and lineup_acceptance='Accepted'
                                and is_deployed='N'
                                and l.select_date <> '0000-00-00 00:00:00'
                                and l.approval_date <> '0000-00-00 00:00:00'
                                and i.status = 'MOBILIZATION'
                                and m.id is null
                                order by pr.name asc, i.lname asc");

            $applicants = array();
            $app_ids = array();
            if($info){
                foreach ($info as $i){
                    array_push($app_ids, $i['applicant_id']);
                    $applicants[$i['applicant_id']] = $i;
                }
            }

            return array('list' => $applicants, 'all_adv' => getAdvisory($app_ids));
        }else if($what == 'for_endorsement'){
	        $info = getdata("select l.applicant_id, i.fname, i.mname, i.lname, i.email, i.status, mr.code as mr_ref, pr.name as principal, p.`desc` as position,
                                l.select_date, l.approval_date, m.id as med_id, m.clinic_exam_date, m.med_result, nbi.add_date as nbi_rec_date, ppt.add_date as ppt_rec_date
                                from applicant_lineup l
                                left join applicant_general_info i
                                on l.id = i.lineup_id
                                left join manager_jobs j
                                on l.mr_pos_id = j.id
                                left join settings_position p
                                on j.pos_id = p.id
                                left join manager_principal pr
                                on j.principal_id = pr.id
                                left join manager_mr mr
                                on j.mr_id = mr.id
                                left join applicant_medical_info m
                                on i.id = m.applicant_id and m.is_archived = 'N'
                                left join applicant_uploads nbi
                                on l.applicant_id = nbi.applicant_id and nbi.description = 'NBI Clearance'
                                left join applicant_uploads ppt
                                on l.applicant_id = ppt.applicant_id and ppt.description = 'Passport'
                                left join applicant_for_endorsement fe
                                on l.applicant_id = fe.applicant_id
                                where 1
                                and lineup_status='Selected'
                                and lineup_acceptance='Accepted'
                                and is_deployed='N'
                                and l.select_date <> '0000-00-00 00:00:00'
                                and l.approval_date <> '0000-00-00 00:00:00'
                                and i.status = 'MOBILIZATION'
                                and fe.id is null
                                and (m.med_result='fit' and DATEDIFF(NOW(), m.med_result_exp_date) <= 0)
                                and (ppt.id is not null and DATEDIFF(NOW(), ppt.expiry_date) <= 0 and ppt.released_date = '0000-00-00 00:00:00')
                                and (nbi.id is not null and DATEDIFF(NOW(), nbi.expiry_date) <= 0 and nbi.released_date = '0000-00-00 00:00:00')
                                and (m.med_result='fit' and DATEDIFF(NOW(), m.med_result_exp_date) <= 0)
                                order by pr.name asc, i.lname asc");
            $applicants = array();
            $app_ids = array();
	        if($info){
	            foreach ($info as $i){
	                array_push($app_ids, $i['applicant_id']);
	                $applicants[$i['applicant_id']] = $i;
	            }
	        }

	        return array('list' => $applicants, 'all_adv' => getAdvisory($app_ids));
	    }else if($what == 'project_distribution'){
            $info = getdata("select m.id, m.code, m.activity, p.name as principal, c.name as company, u.username as rs_user, l.id as lineup_id, cn.name as country, m.add_date, m.weekly_sched, u_op.username as rso_user, l.lineup_status, l.lineup_acceptance
                            from manager_mr m
                            left join manager_principal p
                            on m.principal_id = p.id
                            left join manager_company c
                            on m.company_id = c.id
                            left join settings_users u
                            on m.rs = u.id
                            left join settings_users u_op
                            on m.rso = u_op.id
                            left join applicant_lineup l
                            on m.id = l.manpower_id
                            left join settings_country cn
                            on p.country_id = cn.id
                            where 1
                            and m.status = 1
                            #and l.lineup_status = 'Selected'
                            #and l.lineup_acceptance = 'Accepted'
                            order by u.username, p.name");
            $list_mr = array();
            $list_lineup = array();
            $sched_list = array('1'=>'Monday','2'=>'Tuesday','3'=>'Wednesday','4'=>'Thursday','5'=>'Friday','6'=>'Saturday');
            if($info){
                foreach ($info as $i){
                    $list_mr[$i['rso_user']][$i['id']] = array('mr_ref' => $i['code'],
                        'principal' => $i['principal'],
                        'company' => $i['company'],
                        'activity' => $i['activity'],
                        'country' => $i['country'],
                        'add_date' => $i['add_date'],
                        'rs_user' => $i['rs_user'],
                        'weekly_sched' => $i['weekly_sched'],
                    );

                    if($i['lineup_id'] != '' && ($i['lineup_status'] == 'Selected' && $i['lineup_acceptance'] == 'Accepted')){
                        $list_lineup[$i['id']][$i['lineup_id']] = $i['lineup_id'];
                    }
                }
            }
            
            return array('list_mr' => $list_mr, 'list_lineup' => $list_lineup, 'report_title' => 'Project Distribution Report', 'sched_list' => $sched_list);
        }else if($what == 'accounts'){
            $q_principal = "";
            $q_mr = "";
            $q_date = "";

            if($_POST['SelectPrincipal']){
                $q_principal = "and mr.principal_id = {$_POST['SelectPrincipal']}";
            }

            if($_POST['SelectMR']){
                $q_mr = "and l.manpower_id = {$_POST['SelectMR']}";
            }

            if(dateformat($_POST['textStDate']) && dateformat($_POST['textEnDate'])){
                $q_date = "and fe.add_date >= '".dateformat($_POST['textStDate'],0)." 00:00:00' and fe.add_date <= '".dateformat($_POST['textEnDate'],0)." 23:59:59'";
            }

            $info = getdata("select a.applicant_id, i.fname, i.mname, i.lname, a.particular_id, a.amount, a.charge_to, mr.code, l.manpower_id, mr.principal_id, p.name as principal, a.lineup_id, sp.name as particular_desc
                            from applicant_accounts_card a
                            left join applicant_lineup l
                            on a.lineup_id = l.id
                            left join applicant_general_info i
                            on a.applicant_id = i.id
                            left join manager_mr mr
                            on l.manpower_id = mr.id
                            left join manager_principal p
                            on mr.principal_id = p.id
                            left join settings_particulars sp
                            on a.particular_id = sp.id
                            left join applicant_for_endorsement fe
                            on a.lineup_id = fe.lineup_id
                            where 1
                            and l.manpower_id is not null
                            and mr.principal_id is not null
                            {$q_mr}
                            {$q_principal}
                            {$q_date}
                            order by i.lname asc");
            $list_applicant = array();
            $list_applicant_particulars = array();
            $list_particulars_by_payee = array();
            $list_color_by_payee = array('applicant' => '#00BFFF', 'client' => '#00FA9A', 'agency' => '#FFA500');
            $list_mr = array();
            $principal = "";
            if($info){
                foreach ($info as $i){
                    $list_applicant[$i['manpower_id']][$i['applicant_id']] = array('name' => nameformat($i['fname'], $i['mname'], $i['lname'],1));
                    $list_applicant_particulars[$i['applicant_id']][$i['particular_id']] = array('amount' => $i['amount'], 'charge_to' => $i['charge_to']);

                    $principal = $i['principal'];
                    $list_mr[$i['manpower_id']] = $i['code'];

                    $list_particulars_by_payee[$i['charge_to']][$i['particular_id']] = $i['particular_desc'];
                }
            }

            if(isset($_POST['btn_excel'])){
                $excel = TRUE;
            }else{
                $excel = FALSE;
            }

            return array('list_particulars_by_payee' => $list_particulars_by_payee, 'list_applicant' => $list_applicant, 'report_title' => 'Accounts Monitoring Report', 'list_applicant_particulars' => $list_applicant_particulars, 'principal' => $principal, 'list_mr' => $list_mr, 'list_color_by_payee' => $list_color_by_payee, 'excel' => $excel);
        }else if($what == 'welfare'){
            $qry_where = "";
            if($_POST['SelectPrincipal']){
                $qry_where = " and j.principal_id = {$_POST['SelectPrincipal']}";
            }

            $info = getdata("select l.applicant_id, l.deployment_date, l.contract_period, i.fname, i.mname, i.lname, pr.name as principal, j.principal_id, mr.code as mr_ref, j.mr_id, pos.`desc` as `position`, sc.name as country, w.status as case_status, w.final_action
                            from applicant_lineup l
                            left join applicant_general_info i
                            on l.applicant_id = i.id
                            left join manager_jobs j
                            on l.mr_pos_id = j.id
                            left join manager_principal pr
                            on j.principal_id = pr.id
                            left join manager_mr mr
                            on j.mr_id = mr.id
                            left join settings_position pos
                            on j.pos_id = pos.id
                            left join settings_country sc
                            on pr.country_id = sc.id
                            left join applicant_welfare w
                            on l.applicant_id = w.applicant_id
                            where 1
                            and l.is_deployed='Y'
                            and (l.deployment_date >= '".dateformat($_POST['textStDate'],0)." 00:00:00' and l.deployment_date <= '".dateformat($_POST['textEnDate'],0)." 23:59:59')
                            {$qry_where}
                            and j.principal_id is not null
                            and w.id is not null
                            order by pr.name, i.lname");

            $principals = array();
            $deployed = array();
            if($info){
                foreach ($info as $i){
                    $principals[$i['principal_id']] = $i['principal'];
                    $deployed[$i['principal_id']][$i['applicant_id']] = $i;
                }
            }

            if(isset($_POST['btn_excel'])){
                $excel = TRUE;
            }else{
                $excel = FALSE;
            }

            return array('list_principal' => $principals, 'list_deployed' => $deployed, 'excel' => $excel);
        }else if($what == 'daily_cash'){
            if($_POST['SelectPrincipal']){
                $q_principal = "and mr.principal_id = {$_POST['SelectPrincipal']}";
            }else{
                $q_principal = "";
            }

            if($_POST['SelectPayment']){
                $q_payment = "and a.payment_method_id = {$_POST['SelectPayment']}";
            }else{
                $q_payment = "";
            }

            if(dateformat($_POST['textStDate']) && dateformat($_POST['textEnDate'])){
                $q_date = "and a.add_date >= '".dateformat($_POST['textStDate'],0)." 00:00:00' and a.add_date <= '".dateformat($_POST['textEnDate'],0)." 23:59:59'";
            }else{
                $q_date = "and a.add_date >= '".dateformat("today",0)." 00:00:00' and a.add_date <= '".dateformat("today",0)." 23:59:59'";
            }

            $info = getdata("select a.applicant_id, i.fname, i.mname, i.lname, a.particular_id, a.amount, a.charge_to, mr.code, l.manpower_id, mr.principal_id, p.name as principal, a.lineup_id, sp.name as particular_desc, pm.name as payment_method
                            from applicant_accounts_card a
                            left join applicant_lineup l
                            on a.lineup_id = l.id
                            left join applicant_general_info i
                            on a.applicant_id = i.id
                            left join manager_mr mr
                            on l.manpower_id = mr.id
                            left join manager_principal p
                            on mr.principal_id = p.id
                            left join settings_particulars sp
                            on a.particular_id = sp.id
                            left join applicant_for_endorsement fe
                            on a.lineup_id = fe.lineup_id
                            left join settings_payment_method pm
                            on a.payment_method_id = pm.id
                            where 1
                            and l.manpower_id is not null
                            and mr.principal_id is not null
                            {$q_principal}
                            {$q_date}
                            {$q_payment}
                            and a.charge_to = 'applicant'
                            order by i.lname asc");
            $list_applicant = array();
            $list_applicant_particulars = array();
            $list_particulars_by_payee = array();
            $list_color_by_payee = array('applicant' => '#00BFFF', 'client' => '#00FA9A', 'agency' => '#FFA500');

            if($info){
                foreach ($info as $i){
                    $list_applicant[$i['applicant_id']] = array('name' => nameformat($i['fname'], $i['mname'], $i['lname'],1));
                    $list_applicant_particulars[$i['applicant_id']][$i['particular_id']] = array('amount' => $i['amount'], 'charge_to' => $i['charge_to']);
                    $list_particulars_by_payee[$i['charge_to']][$i['particular_id']] = $i['particular_desc'];
                }
            }

            if(isset($_POST['btn_excel'])){
                $excel = TRUE;
            }else{
                $excel = FALSE;
            }

            return array('list_particulars_by_payee' => $list_particulars_by_payee, 'list_applicant' => $list_applicant, 'report_title' => 'Daily Cash Collection Report', 'list_applicant_particulars' => $list_applicant_particulars, 'list_color_by_payee' => $list_color_by_payee, 'excel' => $excel,);
        }else if($what == 'candidate_in_process'){
            $q_prin = "";
            $q_mr = "";
            $q_source = "";
            if($_POST['SelectPrincipal'] <> ''){
                $q_prin = "and mr.principal_id = {$_POST['SelectPrincipal']}";
            }

            if($_POST['SelectMR'] <> ''){
                $q_mr = "and mr.id = {$_POST['SelectMR']}";
            }

            if($_POST['SelectSource'] <> ''){
                $q_source = "and i.application_source = {$_POST['SelectSource']}";
            }

            $info = getdata("select l.applicant_id, i.fname, i.mname, i.lname, pr.name as principal, mr.project, pos.`desc` as position, s.`desc` as source, o.salary_currency, o.salary_per, o.salary_amount
                            From applicant_lineup l
                            left join applicant_general_info i
                            on l.applicant_id = i.id
                            left join manager_jobs j
                            on l.mr_pos_id = j.id
                            left join manager_mr mr
                            on j.mr_id = mr.id
                            left join manager_principal pr
                            on mr.principal_id = pr.id
                            left join settings_position pos
                            on j.pos_id = pos.id
                            left join settings_application_source s
                            on i.application_source = s.id
                            left join applicant_employment_offer o
                            on l.id = o.lineup_id
                            where 1
                            and i.status = 'MOBILIZATION'
                            {$q_prin}
                            {$q_mr}
                            {$q_source}
                            order by i.lname asc");
            $applicants = array();
            $app_ids = array();
            if($info){
                foreach ($info as $i){
                    array_push($app_ids, $i['applicant_id']);
                    $applicants[$i['applicant_id']] = $i;
                }
            }

            if(isset($_POST['btn_excel'])){
                $excel = TRUE;
            }else{
                $excel = FALSE;
            }

            return array('excel' => $excel, 'list' => $applicants);
        }
	}

    public function ajax_functions($what=NULL){
        switch($what){
            case 'update_mr_sched':
                /*UPDATE DB*/
                dbsetdata("update manager_mr set weekly_sched = {$_GET['sched']} where id = {$_GET['id']}");

                /*LOGS*/
                create_log("user", "", $_SESSION['rs_user']['username'], "edit", "manager_mr sched:{$_GET['sched']} id:{$_GET['id']}");
                break;
        }
    }
}
