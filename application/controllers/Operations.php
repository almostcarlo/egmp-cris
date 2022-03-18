<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/Applicant.php");

class Operations extends Applicant{

    public function __construct(){
        parent::__construct();

        $this->load->helper(array('global_helper','form','url'));
        
        if(!isset($_SESSION['rs_user'])){
            redirect('login', 'refresh');
        }
    }
    
	public function index(){
	    //$this->search();
	    redirect('operations/search?ref=stat', 'refresh');
	}

	public function search(){
	    if(!isset($_GET['ref'])){
	        redirect('operations/search?ref=stat', 'refresh');
	    }

	    $this->template->set('file_javascript', array('javascripts/operations/index.js',));

	    if(trim($this->input->post('textSearchApplicant')) != ''){
	    	$this->load->helper('email');
	    	
	        if(valid_email(trim($this->input->post('textSearchApplicant')))){
	            /* search email address */
	            $q_where = "and a.email = '".trim($this->input->post('textSearchApplicant'))."'";
	        }else if(is_numeric(trim($this->input->post('textSearchApplicant')))){
	            /* search by age */
	            //$q_where = "and (YEAR(CURDATE()) - YEAR(a.birthdate)) >= '".trim($this->input->post('textSearchApplicant'))."'";
	            $q_where = "";
	        }else{
	            if(strpos($this->input->post('textSearchApplicant'), ',')){
	                $fullName = explode(',',$this->input->post('textSearchApplicant'));
	                /* search last name */
	                $q_where = "and a.lname like '".trim($fullName[0])."%'";
	                
	                if(trim($fullName[1]) != ''){
	                    /* search first name */
	                    $q_where .= "and a.fname like '".trim($fullName[1])."%'";
	                }

	            }else{
	                /* search last OR first name */
	                $q_where = "and (a.lname like '".trim($this->input->post('textSearchApplicant'))."%' or a.fname like '".trim($this->input->post('textSearchApplicant'))."%')";
	                
	                /* search by applied position */
	                //$q_where .= "or (p.position like '%".trim($this->input->post('textSearchApplicant'))."%')";
	            }
	        }
	        
	        $q_limit = "";
	    }else{
	        $q_where = "";
	        $q_limit = "limit 100";
	    }
	    
	    /* limit to last 100 applicants */
	    $q_limit = "limit 100";

	    $list = getdata("select a.id, a.email, a.birthdate, a.fname, a.mname, a.lname, a.status, (YEAR(CURDATE()) - YEAR(a.birthdate)) as age, p.position
                        from applicant_general_info a
                        left join applicant_applied_pos p
                        on a.id = p.applicant_id
                        where 1
	                    {$q_where}
	                    order by a.add_date desc
                        {$q_limit}");

	    $href = BASE_URL."operations/forms/offer/";
	    if(isset($_GET['ref'])){
    	    switch ($_GET['ref']){
    	        case 'doclib':
    	            $href = BASE_URL."operations/forms/doclib/";
    	            break;
    	        case 'stat':
    	            $href = BASE_URL."operations/forms/status/";
    	            break;
    	    }
	    }
	    $this->template->view('operations/search', array('applicants'=>$list, 'href'=>$href));
	}
	
	public function forms($what, $applicant_id, $current_tab='ppt'){
	    //$this->template->set('file_javascript', array('javascripts/operations/doclib.js',));
	    $this->load->model('applicant_model');
	    $data = array('applicant_data'=>$this->applicant_model->get_applicant_data($applicant_id));

	    if(!$data['applicant_data']){
	        redirect('operations/search', 'refresh');
	    }

// 	    $data['cv_type']= "";
// 	    $data['med_info'] = getdata("select * from applicant_medical_info where applicant_id = {$applicant_id} and is_archived='N'");
// 	    $data['med_archive'] = getdata("select c.name as clinic, m.clinic_exam_date, m.med_result_exp_date, m.med_result, m.med_result_findings, m.med_result_clinic_remarks
//                                         from applicant_medical_info m
//                                         left join settings_clinic c
//                                         on m.clinic_id = c.id
//                                         where 1
//                                         and m.applicant_id = {$applicant_id}
//                                         and m.is_archived = 'Y'
//                                         order by m.clinic_exam_date desc");

	    switch ($what){
	        case 'doclib':
	            $this->template->set('file_javascript', array('javascripts/operations/doclib.js',));
	            $data['all_docs'] = getdata("select u.*, d.code as doc_type
											from applicant_uploads u
											left join settings_doc_type d
											on u.type_id = d.id
											where applicant_id = {$applicant_id}
											and u.description not in ('iprs picture')
											order by u.add_date desc");
	            $data['current_tab'] = $current_tab;
    	        $data['doc_type'] = $this->doc_type;
    	        $data['current_page'] = 'doclib';
    	        break;
	        case 'status':
	            $this->template->set('file_javascript', array('javascripts/operations/status_changer.js?version=1',));
	            $data['current_page'] = 'status_changer';

	            /* GET PREVIOUS LINEUP */
	            $data['lineup_history'] = getdata("select l.id, p.desc as position, j.principal_id, m.code as mr_ref, l.lineup_status, l.lineup_acceptance, l.select_date, l.add_date, l.deployment_date, l.contract_period, l.is_deployed, l.mr_pos_id, l.is_dropped, l.dropped_date
                                                    from applicant_lineup l
                                                    left join manager_jobs j
                                                    on l.mr_pos_id = j.id
                                                    left join settings_position p
                                                    on j.pos_id = p.id
                                                    left join manager_mr m
                                                    on j.mr_id = m.id
                                                    where 1
                                                    and l.applicant_id = {$applicant_id}
                                                    and m.id is not null
                                                   order by l.add_date desc");
	            //$lineup = getdata("select mr_pos_id from applicant_lineup where applicant_id = {$applicant_id}");

	            $mr_pos_id = array();
	            $q_not_in = "";
	            if($data['lineup_history']){
	                foreach ($data['lineup_history'] as $key => $l_info){
	                    $mr_pos_id[] = $l_info['mr_pos_id'];
	                }

	                $mr_pos_id = implode(",", $mr_pos_id);
	                $q_not_in = "and j.id not in ({$mr_pos_id})";
	            }

	            /* GET POSITIONS FOR DROPDOWN */
	            if(MR_REQUIRED){
	                $q_mr_status = "and m.status = 1";
	            }else{
	                $q_mr_status = "";
	            }
	            
	            $data['pos_options'] = getdata("select j.id, p.desc as position, j.principal_id, j.company_id
                            	                from manager_jobs j
                            	                left join manager_mr m
                            	                on j.mr_id = m.id
                            	                left join settings_position p
                            	                on j.pos_id = p.id
                            	                where 1
                            	                and j.status = 1
                            	                {$q_mr_status}
                            	                {$q_not_in}
                            	                order by p.desc asc");
                            	                
                /* GET CURRENT LINEUP OR EDIT LINEUP*/
                // if(($data['applicant_data']['personal']->status == 'OPERATIONS' && $data['applicant_data']['personal']->lineup_id) || (isset($_GET['luid']) && $_GET['luid'] <> '')){
                if(($data['applicant_data']['personal']->status == 'MOBILIZATION' && $data['applicant_data']['personal']->lineup_id) || (isset($_GET['luid']) && $_GET['luid'] <> '')){
                	if(isset($_GET['luid']) && $_GET['luid'] <> ''){
                		$this_lineup_id = $_GET['luid'];
                	}else{
                		$this_lineup_id = $data['applicant_data']['personal']->lineup_id;
                	}

                    $data['current_lineup'] = getdata("select l.id as lineup_id, l.mr_pos_id, l.manpower_id, l.selected_by, l.select_date, l.approval_date, l.lineup_status, l.lineup_acceptance, o.contract_period, o.salary_currency, o.salary_amount, o.salary_per, o.food, o.is_renewable, p.`desc` as position, l.is_dropped, l.dropped_date
                                                        from applicant_lineup l
                                                        left join applicant_employment_offer o
                                                        on l.id = o.lineup_id
                                                        left join manager_jobs j
                                                        on l.mr_pos_id = j.id
                                                        left join settings_position p
                                                        on j.pos_id = p.id
                                                        where l.id = {$this_lineup_id}");
                }

                $data['submitted_req'] = getInitialRequirements($applicant_id);

// 	            $this->template->set('file_javascript', array('javascripts/operations/doclib.js',));
// 	            $data['current_tab'] = $current_tab;
// 	            $data['doc_type'] = $this->doc_type;
	            break;
	    }

	    $this->template->view('operations/form_'.$what, $data);
	}
	
	public function ajax_tab(){
	    $data['doc_name'] = $this->doc_type[urldecode($_GET['tab'])]['desc'];
	    $data['type_id'] = $this->doc_type[urldecode($_GET['tab'])]['id'];

	    if(isset($_GET['doc_id']) && $_GET['doc_id'] <> ''){
			// $data['doc_info'] = getdata("select * from applicant_uploads where applicant_id = {$_GET['applicant_id']} and description = '{$data['doc_name']}'");
			$data['doc_info'] = getdata("select * from applicant_uploads where id = {$_GET['doc_id']}");
	    }

	    echo $this->load->view('operations/tab_doclib', $data, TRUE);
	}

	public function save_doclib(){
        $this->load->model('operations_model');
	    $filename = "";
	    $file_desc = $this->doc_type[$_POST['textDocType']]['desc'];

	    if($_FILES && $_FILES['fileAttached']['name']!=''){
	        /* CREATE FOLDER PER APPLICANT */
	        $config['upload_path'] = "./uploads/applicant/".$_POST['textApplicant_id']."/";
	        $file_input_name = "";
	        
	        /* CHECK IF UPLOAD FOLDER EXIST */
	        if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
	        
	        $config['allowed_types']       = 'pdf|doc|PDF|docx|gif|jpg|png|jpeg|JPG|JPEG|PNG';
	        $config['max_size']            = 20480; /* 20MB */
	        $config['file_name']           = $_POST['textDocType']."-".str_replace(" ", "-", pathinfo($_FILES['fileAttached']['name'], PATHINFO_FILENAME));
	        $file_input_name               = 'fileAttached';

	        if($file_input_name <> ''){
	            $this->load->library('upload', $config);
	            
	            if ( ! $this->upload->do_upload($file_input_name)){
	                /* ERROR */
	                $this->session->set_flashdata('settings_notification', $this->upload->display_errors());
	                $this->session->set_flashdata('settings_notification_status', 'Error');
	                redirect('operations/forms/doclib/'.$_POST['textApplicant_id']."/".$_POST['textDocType'], 'refresh');
	            }else{
	                $data = array('upload_data' => $this->upload->data());
	                $filename = $config['upload_path'].$data['upload_data']['file_name'];
	            }
	        }
	    }

	    /* SAVE TO DB */
	    $this->operations_model->save_doclib($filename, $file_desc);
	    redirect('operations/forms/doclib/'.$_POST['textApplicant_id']."/".$_POST['textDocType'], 'refresh');
	}
	
	public function delete_doclib($id){
	    $this->load->model('operations_model');

	    /* remove file from UPLOADS dir */
        $file = getdata("select * from applicant_uploads where id={$id}");
        unlink($file[0]['filename']);

        $return_validate = $this->operations_model->delete('doclib_'.$_GET['delete_what'], $id);
	    echo $return_validate;
	}

	public function save($what){
	    switch ($what){
	    	/*UPDATE STATUS WITH LINEUP*/
	        case 'status_changer':
                $this->load->model('operations_model');
                $this->operations_model->status_changer();
                redirect('operations/forms/status/'.$_POST['textApplicantId'], 'refresh');
                break;

            /*UPDATE STATUS WITHOUT LINEUP*/
            case 'no_lineup':
				$this->load->model('operations_model');
                $this->operations_model->no_lineup();
                redirect('operations/forms/status/'.$_POST['textApplicantId'], 'refresh');
                break;
	    }
	}

	public function lists($what){
		$data = array();
		switch ($what) {
			case 'doc_monitoring':
				$this->template->set('file_javascript', array('javascripts/operations/index.js',));

				$q_prin = "";
				$q_mr = "";
				if(isset($_POST['selectPrin']) && $_POST['selectPrin']<>''){
					$q_prin = " and mr.principal_id = {$_POST['selectPrin']}";
				}

				if(isset($_POST['selectMR']) && $_POST['selectMR']<>''){
					$q_mr = " and l.manpower_id = {$_POST['selectMR']}";
				}

				$list = getdata("select l.applicant_id, l.manpower_id, mr.code as mr_ref, mr.principal_id, prin.name as principal, i.fname, i.mname, i.lname, i.status, peos.serial_no as peos_serial, ereg.serial_no as ereg_serial, ppt.serial_no as ppt_serial, ppt.expiry_date as ppt_exp, nbi.expiry_date as nbi_exp, m.med_result, m.clinic_exam_date, pr.rfp_oec_no, pr.rfp_release_date, pr.visa_approved_date as visa_stamp, v.visa_stamp as nonksa_visa_stamp, pcr.testing_date as pcr_testing_date, hs.filename as hs_diploma, college.filename as college_diploma, oma.filename as oma_file, pro.filename as pro_file, data.filename as data_file
								from applicant_lineup l
								left join applicant_general_info i
								on l.applicant_id = i.id
								left join applicant_uploads peos
								on l.applicant_id = peos.applicant_id and peos.description = 'PEOS Certificate'
								left join applicant_uploads ereg
								on l.applicant_id = ereg.applicant_id and ereg.description = 'POEA E-Registration'
								left join applicant_uploads ppt
								on l.applicant_id = ppt.applicant_id and ppt.description = 'Passport'
								left join applicant_uploads nbi
								on l.applicant_id = nbi.applicant_id and nbi.description = 'NBI Clearance'
								left join applicant_medical_info m
								on l.applicant_id = m.applicant_id
								left join applicant_processing pr
								on l.applicant_id = pr.applicant_id
								left join manager_visa_nonksa v
								on l.applicant_id = v.applicant_id
								left join applicant_pcrtest pcr
								on l.applicant_id = pcr.applicant_id and pcr.is_archived = 'N'
								left join applicant_uploads college
								on l.applicant_id = college.applicant_id and college.description = 'College Diploma'
								left join applicant_uploads hs
								on l.applicant_id = hs.applicant_id and hs.description = 'High School Diploma'
								left join applicant_uploads oma
								on l.applicant_id = oma.applicant_id and oma.description = 'OMA'
								left join applicant_uploads pro
								on l.applicant_id = pro.applicant_id and pro.description = 'Prometric Certificate'
								left join applicant_uploads data
								on l.applicant_id = data.applicant_id and data.description = 'Data Flow'
								left join manager_mr mr
								on l.manpower_id = mr.id
								left join manager_principal prin
								on mr.principal_id = prin.id
								where 1
								and l.lineup_status='Selected'
								and l.lineup_acceptance='Accepted'
								and i.status in ('OPERATIONS','MOBILIZATION')
								{$q_prin}
								{$q_mr}
								order by i.lname asc");

				$pr_list = array();
				$mr_list = array();
				$app_list = array();
				if($list){
					foreach($list as $i){
						$pr_list[$i['principal_id']] = $i['principal'];
						$mr_list[$i['manpower_id']] = $i['mr_ref'];
						$app_list[$i['applicant_id']] = $i;
					}
				}

				$data = array('list'=>$app_list, 'pr_list' => $pr_list, 'mr_list' => $mr_list);
				break;
			
			default:
				// code...
				break;
		}

		$this->template->view('operations/form_'.$what, $data);
	}

// 	public function archive($id){
// 	    $id = base64_decode($id);
// // 	    var_dump($id);
// // 	    exit();
// 	    if($id!='' && is_numeric($id)){
// 	        $med_info = getdata("select * from applicant_medical_info where id = {$id} and is_archived='N'");
	        
// 	        if($med_info){
// 	            $this->load->model('medical_model');
// 	            $this->medical_model->archive_med($id, $med_info[0]['applicant_id']);
// 	            redirect('medical/forms/default/'.$med_info[0]['applicant_id'], 'refresh');
// 	        }else{
// 	            redirect('medical/search', 'refresh');
// 	        }
// 	    }else{
// 	        redirect('medical/search', 'refresh');
// 	    }
// 	}
	
	public function testing(){
	    $xxx = get_Job_Info(1040);
	    var_dump($xxx);
	}
}