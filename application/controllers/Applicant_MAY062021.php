<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Applicant extends MY_Controller{

    //private $applicant_id = null;
    public $doc_type = array('iprs picture'=>'Profile Picture','iprs cv'=>'Resume/CV', 'ppt'=>'Passport','nbi'=>'NBI Clearance', 'peos' => 'PEOS Certificate', 'ereg' => 'POEA E-Registration', 'coe'=>'Certificate of Employment','diploma_c'=>'College Diploma','diploma_h'=>'High School Diploma',
                            'tor'=>'Transcript of Record / RLE','prc'=>'PRC License Card','prc_rating'=>'PRC Board Rating','prc_cert'=>'PRC Board Certificate','no_obj'=>'Letter of No Objection Certificate',
                            'saudi'=>'Saudi Council Certificate/ID','prometric'=>'Prometric Certificate','exit_visa'=>'Final Exit Visa','tesda'=>'Seminar / TESDA Certificate','auth_doc'=>'Authenticated Documents',
                            'pagibig'=>'Pag-ibig Application & Certificate','philhealth'=>'Philhealth Application & MDR','sss'=>'SSS ID Card','tin_card'=>'Tax Identification Card',
                            'dr_lic'=>'Drivers License','others'=>'Other Documents',);

    public $mob_result = array('AV','CR','NA','NI');

	public function index()
	{
	    $this->search();
	}

	public function search(){
	    $this->template->set('file_javascript', array('javascripts/applicant.js',));
	    $this->load->helper('email');

	    if(trim($this->input->post('textSearchApplicant')) != ''){
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
	                $q_where = "and trim(a.lname) like '".trim($fullName[0])."%'";
	                
	                if(trim($fullName[1]) != ''){
	                    /* search first name */
	                    $q_where .= "and trim(a.fname) like '".trim($fullName[1])."%'";
	                }

	            }else{
	                /* search last OR first name */
	                $q_where = "and (trim(a.lname) like '".trim($this->input->post('textSearchApplicant'))."%' or trim(a.fname) like '".trim($this->input->post('textSearchApplicant'))."%')";
	                
	                /* search by applied position */
	                //$q_where .= "or (p.position like '%".trim($this->input->post('textSearchApplicant'))."%')";
	            }
	        }
	        
	        // $q_limit = "";
	    }else{
	        $q_where = "";
	        // $q_limit = "limit 100";
	    }
	    
	    /* limit to last 100 applicants */
	    $q_limit = "limit 100";

	    $list = getdata("select a.id, a.email, a.birthdate, a.fname, a.mname, a.lname, a.status, (YEAR(CURDATE()) - YEAR(a.birthdate)) as age
                        from applicant_general_info a
                        left join applicant_applied_pos p
                        on a.id = p.applicant_id
                        where 1
	                    {$q_where}
	                    order by a.add_date desc
                        {$q_limit}");
	    $this->template->view('applicant/search', array('applicants'=>$list));
	}
	
	public function profile($id, $tab="personal"){
	    $this->template->set('file_javascript', array('javascripts/applicant.js?version=1',));
	    $this->load->model('applicant_model');
	    $data = array('applicant_data'=>$this->applicant_model->get_applicant_data($id));

	    if(!$data['applicant_data']){
	        redirect('applicant', 'refresh');
	    }
	    
	    $data['current_tab'] = $tab;
	    $data['cv_type']= "";

	    if($data['applicant_data']['profile_cv'] && $data['applicant_data']['profile_cv']->filename <> ''){
	        $cv = pathinfo($data['applicant_data']['profile_cv']->filename);

	        if(in_array($cv['extension'], array('doc','docx'))){
	            $data['cv_type'] = "Word";
	        }else if(in_array($cv['extension'], array('pdf'))){
	            $data['cv_type']= "PDF";
	        }
	    }

	    /*GET NEW SMS*/
	    $data['new_sms'] = getdata("select count(*) as total from applicant_sms_inbox where applicant_id = {$id} and seen = 'N'");

	    /*GET BRANCHES*/
	    $data['branch_list'] = get_items_from_cache('branch');

	    $this->template->view('applicant/profile', $data);
	}
	
	public function ajax_tab(){
		$this->load->model('applicant_model');
		$data['applicant_data'] = $this->applicant_model->get_applicant_data($_GET['applicant_id']);
		$my_lineup_id = $data['applicant_data']['personal']->lineup_id;

	    switch($_GET['tab']){
	        case 'personal':
	        	$data['reference_data'] = getdata("select * from applicant_char_ref where applicant_id={$_GET['applicant_id']} order by add_date desc");
	            break;
	        case 'overview':
	            $applied_pos = getdata("select * from applicant_applied_pos where applicant_id={$_GET['applicant_id']}");
	            $applied_pos = ($applied_pos)?explode('|', $applied_pos[0]['position']):"";
	            $uploads = getdata("select * from applicant_uploads where applicant_id={$_GET['applicant_id']} order by add_date desc");
	            $advisory = getdata("select id, message, add_date, add_by, type, '' as tbl
	            					from applicant_comm
									where applicant_id = {$_GET['applicant_id']} 
						        	union all
						        	select id, message, add_date, add_by, 'applicant' as type, 'inbox' as tbl
						        	from applicant_sms_inbox
						        	where applicant_id={$_GET['applicant_id']}
						        	union all
						        	select id, message, add_date, add_by, 'applicant' as type, 'outbox' as tbl
						        	from applicant_sms_outbox
						        	where applicant_id={$_GET['applicant_id']}
						        	order by add_date desc");

	            $advisory_list = array();
	            foreach ($advisory as $adv_info) {
	                $advisory_list[$adv_info['type']][$adv_info['id']] = $adv_info;
	            }

	            $data = array('advisory_list' => $advisory_list, 'uploads'=>$uploads, 'doc_type'=>$this->doc_type, 'applied_pos'=>$applied_pos);
	            break;
	        case 'licenses':
	            /*Trainings / Seminar*/
	            break;
	        case 'lineup':
	            get_items_from_cache('principal');

               $data['lineup_data'] = getdata("select l.id, p.desc as position, j.principal_id, m.code as mr_ref, l.lineup_status, l.lineup_acceptance, l.select_date, l.approval_date, l.add_date, l.deployment_date, l.contract_period, l.is_deployed, l.assess_detail, m.activity, l.mob_result, l.interview_sched_id, i.interview_date, i.venue
						                    from applicant_lineup l
						                    left join manager_jobs j
						                    on l.mr_pos_id = j.id
						                    left join settings_position p
						                    on j.pos_id = p.id
						                    left join manager_mr m
						                    on j.mr_id = m.id
						                    left join manager_interview_schedule i
						                    on l.interview_sched_id = i.id
						                    where 1
						                    and l.applicant_id={$_GET['applicant_id']}
						                   order by l.add_date desc");
	            $assessment_data = getdata("select * from applicant_assessment where applicant_id = {$_GET['applicant_id']} order by add_date desc");
	            if($assessment_data){
					$data['allow_lineup'] = TRUE;
	            }else{
	            	$data['allow_lineup'] = FALSE;
	            }
	            break;
	        case 'assessment':
	        	$data['nature_list'] = get_items_from_cache('nature');
	            break;
	        case 'deployment':
	            get_items_from_cache('principal');
	            $data = array('lineup_data' => getdata("select l.id, p.desc as position, j.principal_id, m.code as mr_ref, l.lineup_status, l.lineup_acceptance, l.select_date, l.add_date,
                                    	                l.deployment_date, l.contract_period, l.is_deployed, l.contract_fin_date
                                    	                from applicant_lineup l
                                    	                left join manager_jobs j
                                    	                on l.mr_pos_id = j.id
                                    	                left join settings_position p
                                    	                on j.pos_id = p.id
                                    	                left join manager_mr m
                                    	                on j.mr_id = m.id
                                    	                where 1
                                    	                and l.applicant_id={$_GET['applicant_id']}
                                    	                and l.is_deployed = 'Y'
                                    	                order by l.deployment_date desc"),);
	            break;
	            
	        case 'emp_offer':
	            if($my_lineup_id <> 0){
	            	$data['lineup_id'] = $my_lineup_id;
	                $data['current_lineup_info'] = getdata("select l.id, pos.`desc` as position, prin.name as principal, co.name as company, mr.code as ref_no, cn.name 									as country, l.select_date,
                                                            l.approval_date, l.lineup_status, l.lineup_acceptance, o.id as emp_offer_id, o.*, fe.id as for_endorsement_id
                                                            from applicant_lineup l
                                                            left join manager_jobs j
                                                            on l.mr_pos_id = j.id
                                                            left join settings_position pos
                                                            on j.pos_id = pos.id
                                                            left join manager_principal prin
                                                            on j.principal_id = prin.id
                                                            left join manager_company co
                                                            on j.company_id = co.id
                                                            left join manager_mr mr
                                                            on j.mr_id = mr.id
                                                            left join settings_country cn
                                                            on prin.country_id = cn.id
                                                            left join applicant_employment_offer o
                                                            on l.id = o.lineup_id
                                                            left join applicant_for_endorsement fe
                                                            on l.applicant_id = fe.applicant_id
                                                            where l.id = {$my_lineup_id}");
	            }

	            break;

	        case 'accounts_card':
	        	if($data['applicant_data']['personal']->status != 'OPERATIONS'){
	        		$join = "on i.id = acc.applicant_id";
	        	}else{
	        		$join = "on i.lineup_id = acc.lineup_id";
	        	}

				$data['accounts_hdr'] = getdata("select acc.* from applicant_general_info i
													left join applicant_accounts_card_hdr acc
													{$join}
													where i.id = {$_GET['applicant_id']}");

	        	$data['accounts_data'] = getdata("select acc.*, sp.name as particular, pm.name as payment_method
												from applicant_general_info i
												left join applicant_accounts_card acc
												{$join}
												left join settings_particulars sp
												on acc.particular_id = sp.id
												left join settings_payment_method pm
												on acc.payment_method_id = pm.id
												where i.id = {$_GET['applicant_id']}");
	        	break;

        	case 'documents':
        		$data = array('ppt_info' => getdata("select * from applicant_uploads where description='Passport' and applicant_id = {$_GET['applicant_id']}"),
    						'nbi_info' => getdata("select * from applicant_uploads where description='NBI Clearance' and applicant_id = {$_GET['applicant_id']}"),
    						'med_info' => getdata("select m.*, c.name as clinic from applicant_medical_info m left join settings_clinic c on m.clinic_id = c.id where 						m.applicant_id = {$_GET['applicant_id']} and m.is_archived = 'N'"),
    						'fe_info' => getdata("select * from applicant_for_endorsement where applicant_id = {$_GET['applicant_id']}"),);

        		if(!$data['fe_info']){
        			/*CHECK EMPLOYMENT OFFER*/
		            if($my_lineup_id <> 0){
		                $data['emp_offer_info'] = getdata("select o.*,l.lineup_status, l.lineup_acceptance, l.select_date, l.approval_date
		                									from applicant_lineup l
                                                            left join applicant_employment_offer o
                                                            on l.id = o.lineup_id
                                                            where l.id = {$my_lineup_id}");
		            }
        		}else{
        			$data['emp_offer_info'] = array();
        		}
	        	break;

        	case 'processing':
	        	$my_lineup_info = $this->get_current_lineup($_GET['applicant_id']);

	        	if($my_lineup_info[0]['principal_id'] <> ''){
	        		$principal_id = $my_lineup_info[0]['principal_id'];
	        	}else{
	        		$principal_id = $my_lineup_info[0]['j_principal_id'];
	        	}

	        	/*VISA*/
	        	$data['visa_list'] = getdata_for_dd("select id,visa_no as value from manager_visa where principal_id = {$principal_id} and expiry_date > '".date("Y-m-d",strtotime("today"))."'");
	        	$data['process_data'] = getdata("select ap.*, v.visa_no, vp.position as visa_pos, pj.jo_id, jpos.position as jo_pos
												from applicant_processing ap
												left join manager_visa v
												on ap.request_visa_id = v.id
												left join manager_visa_pos vp
												on ap.request_visa_cat = vp.id
												left join manager_poea_jo pj
												on ap.poea_request_id = pj.id
												left join manager_jo_pos jpos
												on ap.poea_request_cat = jpos.id
												where 1
												and ap.applicant_id = {$_GET['applicant_id']}
												and ap.lineup_id = {$my_lineup_info[0]['lineup_id']}");

	        	/*GET APPROVED CATEGORY*/
	        	if($data['process_data'] && $data['process_data'][0]['request_approved_cat'] <> 0){
	        		$approved_visa_pos = getdata("select * from manager_visa_pos where id = {$data['process_data'][0]['request_approved_cat']}");
	        		$data['process_data'][0]['approved_visa_pos'] = $approved_visa_pos[0]['position'];
	        	}

	        	/*PPT*/
	        	$ppt_info = getdata("select * from applicant_uploads where description='Passport' and applicant_id = {$_GET['applicant_id']}");
	        	if($ppt_info){
					$data['ppt_status'] = checkExpiry($ppt_info[0]['expiry_date']);
	        	}

	        	/*MEDICAL*/
	        	$med_info = getdata("select m.*, c.name as clinic from applicant_medical_info m left join settings_clinic c on m.clinic_id = c.id where 						m.applicant_id = {$_GET['applicant_id']} and m.is_archived = 'N'");
	        	if($med_info){
	        		$data['med_result'] = $med_info[0]['med_result'];
					$data['med_status'] = checkExpiry($med_info[0]['med_result_exp_date']);
	        	}

	        	/*POEA*/
				$data['jo_id_list'] = getdata_for_dd("select pj.id, pj.jo_id as value
														from manager_poea mp
														left join manager_poea_jo pj
														on mp.id = pj.poea_id
														where mp.principal_id = {$principal_id}
														and mp.expiry_date > '".date("Y-m-d",strtotime("today"))."'");

	        	break;
			case 'jap':
				$data['jap_info'] = getdata("select * from applicant_profile_jap where applicant_id = {$_GET['applicant_id']}");
	        	$data['relatives'] = getdata("select * from applicant_char_ref_jap where applicant_id = {$_GET['applicant_id']}");
	            break;
	        default:
	            $data['welfare_info'] = getdata("select * from applicant_welfare where applicant_id = {$_GET['applicant_id']}");
	            break;
	    }

	    $data['applicant_id'] = $_GET['applicant_id'];
	    echo $this->load->view('applicant/tab_'.$_GET['tab'], $data, TRUE);
	}

	public function create_applicant(){
	    $this->template->set('file_javascript', array('javascripts/validation/create_applicant.js?version=1',));
	    $this->template->view('applicant/create', array('create_error'=>false));
	}
	
	public function create_profile(){
	    $this->load->model('applicant_model');
	    $applicant_id = $this->applicant_model->create_applicant();
	    
	    if($applicant_id <> 0){
	        /* SEND EMAIL */
	        $this->send_validation_email($applicant_id);
	        
	        /* check duplicate record, delete if found */
	        $this->check_duplicate_record($applicant_id);

	        redirect('profile/'.$applicant_id, 'refresh');
	    }else{
	        $this->template->view('applicant/create', array('create_error'=>true));
	    }
	}
	
	public function ajax_duplicate_email(){
	    $duplicate = getdata("select * from applicant_general_info where email = '{$_GET['email']}'");
	    if(count($duplicate)>0){
	        echo 1;
	    }else{
	        echo 0;
	    }
	}
	
	public function send_validation_email($applicant_id){
	    $this->load->helper(array('email'));
	    
	    /* get email address of applicant */
	    $app_info = getdata("select email, add_date from applicant_general_info where id = {$applicant_id}");

	    if($app_info && valid_email($app_info[0]['email'])){
	        $recipient = $app_info[0]['email'];

	        $this->load->library('email');
	        $this->email->set_newline("\r\n");
	        $this->email->set_mailtype("html");
	        $this->email->from(SUPPORT_EMAIL, SUPPORT_NAME);
	        $this->email->to($recipient);
	        
	        if(VALIDATE_EMAIL_IN_RMS){
	        	$url = EXTERNAL_IP."/rs/home/validate_email/".base64_encode(date("Ymd", strtotime($app_info[0]['add_date'])).'-'.$applicant_id);
	        }else{
	        	$url = WEBSITE_URL."validate/email/".base64_encode(date("Ymd", strtotime($app_info[0]['add_date'])).'-'.$applicant_id);
	        }
	        
	        $sms_subscription_url = SMS_WEB_SUB_URL;
	        $company_name = COMPANY_LONG_NAME;
	        $default_password = EMAIL_VALIDATION_PASSWORD_DEFAULT;
	        $message = "Thank you for registering at {$company_name} You may now login by clicking this <a href=\"{$url}\">link</a> or copying and pasting it to your browser:<br><br>{$url}<br><br>";
	        $message .= "<br><br>You can login to our website by providing your username and password<br><br>username: {$recipient}<br>password: {$default_password}<br><br>";

	        /*SMS SUBSCRIPTION MESSAGE*/
	        if(SMS_PROVIDER == 'globe' && SMS_APP_ID <> ''){
	        	$message .= "<br><br>To receive updates and other important messages on your cellphone, please subscribe to our SMS Services by clicking this <a href=\"{$sms_subscription_url}\">link</a> or just text INFO and send to ".SMS_SHORT_CODE." (for globe/tm) or ".SMS_SHORT_CODE_ALL." (for smart/tnt/sun)<br><br>";
	        }

	        $message .= "--".SUPPORT_NAME;

	        $this->email->subject(COMPANY_SHORT_NAME.' Account Validation');
	        $this->email->message($message);
	        
	        if(!$this->email->send()){
// 	            echo $this->email->print_debugger();
// 	            exit();
	            create_log('applicant_logs', $applicant_id, 'validate', 'email sender failed');
	            
	            /* ERROR */
	            return 0;
	        }else{
	            return 1;
	        }
	    }
	}

	public function ajax_save_profile($what){

// echo "<pre>";
// print_r($_POST);
// print_r($_GET);
// var_dump($what);
// //print_r($_FILES);
// $ext = pathinfo($_FILES['textAttach']['name'], PATHINFO_EXTENSION);
// var_dump($ext);
// // print_r($_POST);
// exit();
	    $this->load->model('applicant_model');
	    echo $return_validate = $this->applicant_model->edit_profile($what);
	    //redirect('profile/'.$_POST['textApplicant_id'], 'refresh');
// 	    var_dump($_FILES);
// 	    var_dump($_POST);
	    //echo date("F d, Y", strtotime($_POST['inputBirthDate']));
// 	    exit();
	}

	public function upload($what=NULL){
	    if(!$_FILES || !$_POST){
	        /* ERROR */
	        echo json_encode(array('status'=>'error', 'msg'=>'Unable to process file. Please check if the filetype you are trying to upload is correct.'));
	        exit();
	    }

	    $this->load->model('applicant_model');
	    
	    /* CREATE FOLDER PER APPLICANT */
	    $config['upload_path'] = "./uploads/applicant/".$_POST['textApplicant_id']."/";
	    $file_input_name = "";
	    
	    /* CHECK IF UPLOAD FOLDER EXIST */
	    if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
	    
	    if($what== 'profile_pix' && isset($_FILES['fileImage']) && $_FILES['fileImage']['size'] > 0){
	        /* UPLOAD FILE */
	        $config['allowed_types']       = 'gif|jpg|png|jpeg|JPG|JPEG|PNG';
	        $config['max_size']            = 5120;
	        $config['file_name']           = "profile_pic";
	        $file_input_name = 'fileImage';
	        $file_desc = 'iprs picture';

	        /* CHECK IF FILE ALREADY EXIST */
	        $current_picture = getdata("select * from applicant_uploads where applicant_id = {$_POST['textApplicant_id']} and description='iprs picture'");

	        if($current_picture){
	            $_GET['applicant_id'] = $_POST['textApplicant_id'];

	            /* DELETE FROM APPLICANTS FOLDER */
                unlink($current_picture[0]['filename']);
                
                /* DELETE RECORD FROM DB */
                $this->applicant_model->delete('picture', $current_picture[0]['id']);
	        }
	    }else{
	        $config['allowed_types']       = 'pdf|doc|PDF|docx|gif|jpg|png|jpeg|JPG|JPEG|PNG';
	        $config['max_size']            = 20480; /* 20MB */
	        $config['file_name']           = $_POST['selectDocType'];
	        $file_input_name               = 'fileUpload';
	        $file_desc                     = $this->doc_type[$_POST['selectDocType']];
	    }

	    if($file_input_name <> ''){
	        $this->load->library('upload', $config);
	        
	        if ( ! $this->upload->do_upload($file_input_name))
	        {
	            /* ERROR */
	            echo json_encode(array('status'=>'error', 'msg'=>$this->upload->display_errors()));
	            exit();
	        }
	        else
	        {
	            $data = array('upload_data' => $this->upload->data());

	            /* SAVE TO DB */
	            if($this->applicant_model->save_uploads($config['upload_path'].$data['upload_data']['file_name'], $file_desc)){
	                echo json_encode(array('status'=>'success', 'msg'=>''));
	                exit();
	            }else{
	                /* ERROR */
	                echo json_encode(array('status'=>'error', 'msg'=>'Unable to upload file.'));
	                exit();
	            }
	        }
	    }
	}

	public function ajax_save_adv($what){
		if($what == 'applicant'){
			if($_POST['textSendTo'] == 'sms'){
				/*ADD FOOTER AT END OF MESSAGE*/
				if(isset($_SESSION['rs_user']['username'])){
                    $footer = "\r\n\r\n".str_replace("{username}", $_SESSION['rs_user']['username'], SMS_FOOTER);
                }else{
                	$footer = "";
                }

				/*SEND SMS*/
				$data = array(
		    		'token' => $_POST['textToken'],
		    		'mobile_no' => $_POST['textMobNo'],
		    		'message' => $_POST['textAdvisory'].$footer,
		    	);

				send_sms($data);

				/*SAVE TO OUTBOX*/
				$data['applicant_id'] = $_POST['textApplicant_id'];
				$data['status'] = 1;
				save_sms_outbox($data);

				/*EXIT NOW TO SKIP SAVING TO APPLICANT ADVISORY*/
				echo 1;
				exit();
			}else{
				/*SEND EMAIL*/
				$email_info = array('from_email' => SUPPORT_EMAIL,
									'from_name' => SUPPORT_NAME,
									'recipient' => $_POST['textEmail'],
									'subject' => COMPANY_SHORT_NAME.' - Applicant Advisory',
									'message' => $_POST['textAdvisory']);
				send_email($email_info);
			}
		}

	    $this->load->model('applicant_model');
	    echo $return_validate = $this->applicant_model->create_advisory($what);
	}
	
	public function delete($what, $id){
	    $this->load->model('applicant_model');

	    if($what == 'picture' || $what == 'cv'){
	    	/* remove file from UPLOADS dir */
	        $file = getdata("select * from applicant_uploads where id={$id}");
	        unlink($file[0]['filename']);
	    }else if($what == 'welfare'){
            /*DELETE WELFARE FILES/FOLDER*/
            $file = getdata("select * from applicant_welfare where id={$id}");
            if($file[0]['attachment']<>'') unlink($file[0]['attachment']);
            if($file[0]['action_attachment']<>'') unlink($file[0]['action_attachment']);
            if($file[0]['final_attachment']<>'') unlink($file[0]['final_attachment']);
            rmdir("./uploads/applicant/".$_GET['applicant_id']."/welfare");
	    }else if($what == 'welfare_doc'){
	    	$file = getdata("select * from applicant_welfare where id={$id}");
	    	unlink($file[0][$_GET['tbl_fld_name']]);
	    }

	    $return_validate = $this->applicant_model->delete($what, $id);
	    echo $return_validate;
	}

	public function facebox($what, $applicant_id=0, $record_id=0){
	    if($what == 'personal'){
	        $this->load->model('applicant_model');
	        $data = array('applicant_data'=>$this->applicant_model->get_applicant_data($applicant_id));
	        $form = "form_profile";
	    }else if($what == 'education'){
	        $form = "form_education";
	        if($record_id <> 0){
	            $educ_info = getdata("select * from applicant_education where id = {$record_id}");
	        }else{
	            $educ_info = "";
	        }
	        $data = array('applicant_id' => $applicant_id, 'record_id' => $record_id, 'educ_info' => $educ_info);
	    }else if($what == 'work'){
	    	$this->load->model('applicant_model');

	        if($record_id <> 0){
	            $work_info = getdata("select * from applicant_work_history where id = {$record_id}");
	        }else{
	            $work_info= "";
	        }
	        $form = "form_work";
	        $data = array('applicant_id' => $applicant_id, 'record_id' => $record_id, 'work_info' => $work_info, 'applicant_data' => $this->applicant_model->get_applicant_data($applicant_id));
	    }else if($what == 'reference'){
	        if($record_id <> 0){
	            $reference_info= getdata("select * from applicant_char_ref where id = {$record_id}");
	        }else{
	            $reference_info= "";
	        }
	        $form = "form_reference";
	        $data = array('applicant_id' => $applicant_id, 'record_id' => $record_id, 'ref_info' => $reference_info);
	    }else if($what == 'training'){
	        if($record_id <> 0){
	            $training_info= getdata("select * from applicant_training where id = {$record_id}");
	        }else{
	            $training_info= "";
	        }
	        $form = "form_training";
	        $data = array('applicant_id' => $applicant_id, 'record_id' => $record_id, 'training_info' => $training_info);
	    }else if($what == 'internal_adv'){
	        $form = "form_internal_advisory";
	        $data = array('applicant_id' => $applicant_id);
	    }else if($what == 'applicant_adv'){
	    	$this->load->model('applicant_model');
	        $data['applicant_data'] = $this->applicant_model->get_applicant_data($applicant_id);
	        $data['applicant_id'] = $applicant_id;
	        $form = "form_applicant_advisory";
	    }else if($what == 'skills'){
	        if($record_id <> 0){
	            $skills_info= getdata("select * from applicant_skills where id = {$record_id}");
	        }else{
	            $skills_info= "";
	        }
	        $form = "form_skills";
	        $data = array('applicant_id' => $applicant_id, 'record_id' => $record_id, 'skills_info' => $skills_info);
	    }else if($what == 'internal_adv_all'){
	        $form = "form_internal_adv_all";
	        $data = array('applicant_id' => $applicant_id, 'list' => getdata("select * from applicant_comm where applicant_id = {$applicant_id} and type = 'internal' order by add_date desc"));
	    }else if($what == 'applicant_adv_all'){
	        $form = "form_applicant_adv_all";
	        $data = array('applicant_id' => $applicant_id, 'list' => getdata("select id, message, add_date, add_by, type, 'Y' as seen, '' as tbl from applicant_comm
	        																where applicant_id = {$applicant_id} 
																        	and type = 'applicant'
																        	union all
																        	select id, message, add_date, add_by, 'sms' as type, seen, 'inbox' as tbl from applicant_sms_inbox
																        	where applicant_id={$applicant_id}
																        	union all
																        	select id, message, add_date, add_by, 'sms' as type, 'Y' as seen, 'outbox' as tbl from applicant_sms_outbox
																        	where applicant_id={$applicant_id}
																        	order by add_date desc"));
	        /*UPDATE INBOX AS SEEN*/
	        dbsetdata("update applicant_sms_inbox set seen = 'Y' where applicant_id = {$applicant_id} and seen = 'N'");
	    }else if($what == 'upload_cv'){
	        $form = "form_upload";
	        $data = array('applicant_id' => $applicant_id, 'upload_what'=>'CV', 'doc_type'=>$this->doc_type);
	    }else if($what == 'upload'){
	        /* check if cv is already uploaded */
	        $cv_info = getdata("select * from applicant_uploads where applicant_id = {$applicant_id} and description = 'Resume/CV'");
	        if($cv_info){
	            /* remove from dropdown options */
	            unset($this->doc_type['iprs cv']);
	        }

	        $form = "form_upload";
	        $data = array('applicant_id' => $applicant_id, 'upload_what'=>'', 'doc_type'=>$this->doc_type);
	    }else if($what == 'applied_pos'){
	        $form = "form_position";
	        $data = array('applicant_id' => $applicant_id, 'applied_pos' => getdata("select * from applicant_applied_pos where applicant_id = {$applicant_id}"));
	    }else if($what == 'lineup'){
	        $form = "form_lineup";
	        $show_attention = FALSE;
	        $attention_msg = "";
	        
	        if($record_id <> 0){
	            $lineup_info = getdata("select * from applicant_lineup where id = {$record_id}");
	            
	            $job_info = get_Job_Info($lineup_info[0]['mr_pos_id']);
	            $lineup_info['position'] = $job_info['desc'];
	            $lineup_info['principal_name'] = $job_info['principal'];
	            $lineup_info['company_name'] = $job_info['company'];
	            $lineup_info['mr_ref'] = $job_info['mr_ref'];
	            $lineup_info['mr_status'] = $job_info['mr_status'];
	            $lineup_info['jo_status'] = $job_info['jo_status'];

	            $pos_options = "";

	            if($job_info['jo_status'] != 1){
	                $show_attention = TRUE;
	                $attention_msg = "<strong>{$job_info['desc']}</strong> is alreay INACTIVE. Editing functions for this lineup will be disabled.";
	            }else if($job_info['jo_status'] != 1){
	                $show_attention = TRUE;
	                $attention_msg = "This position is alreay INACTIVE. Editing functions for this lineup will be disabled.";
	            }
	        }else{
	            $lineup_info = "";
	            
	            /* GET PREVIOUS LINEUP */
	            $lineup = getdata("select mr_pos_id from applicant_lineup where applicant_id = {$applicant_id}");
	            $mr_pos_id = "";
	            $q_not_in = "";
	            if($lineup){
	                foreach ($lineup as $l_info){
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

	            $pos_options = getdata("select j.id, p.desc as position, j.principal_id, j.company_id
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
                                        
                if(!$pos_options){
                    $show_attention = TRUE;
                    $attention_msg = "No Available Job Posting.";
                }
	        }

	        $data = array('applicant_id' => $applicant_id, 'record_id' => $record_id, 'lineup_info' => $lineup_info, 'pos_options'=>$pos_options, 'show_attention' => $show_attention, 'attention_msg' => $attention_msg, 'submitted_req' => getInitialRequirements($applicant_id));
	    }else if($what == 'assessment'){
	        $form = "form_assessment";
	        $data = array('applicant_id' => $applicant_id, 'assessment_info' => getdata("select * from applicant_assessment where id = {$record_id}"),);
	    }else if($what == 'assessment_l'){
	        $form = "form_assessment_lineup";
	        $data = array('applicant_id' => $applicant_id, 'assessment_info' => getdata("select * from applicant_lineup where id = {$record_id}"),);
	    }else if($what == 'accounts_card'){
	    	$lineup_info = getdata("select lineup_id from applicant_general_info where id = {$applicant_id}");
	        $form = "form_accounts_card";

	        if($record_id <> 0){
	        	$particular_info = getdata("select * from applicant_accounts_card where id = {$record_id}");
	        }else{
	        	$particular_info = "";
	        }

	        $data = array('applicant_id' => $applicant_id, 'record_id' => $record_id, 'lineup_id' => $lineup_info[0]['lineup_id'], 'accounts_info' => $particular_info,);
	    }else if($what == 'accounts_card_rmk'){
	    	$form = "form_accounts_card_remarks";
	    	$lineup_info = getdata("select lineup_id from applicant_general_info where id = {$applicant_id}");
	        $acc_info = getdata("select * from applicant_accounts_card_hdr where applicant_id = {$applicant_id} and lineup_id = {$lineup_info[0]['lineup_id']}");
	        $data = array('applicant_id' => $applicant_id, 'lineup_id' => $lineup_info[0]['lineup_id'], 'accounts_info' => $acc_info,);
	    }else if($what == 'interview_sched'){
	    	$form = "form_interview_sched";
	    	$data = array('applicant_id' => $applicant_id, 'record_id' => $record_id, 'select_mob_result' => $this->mob_result );
	    	$data['lineup_info'] = getdata("select l.id, l.manpower_id, mr.code as mr_ref, pr.name as principal, pos.`desc` as position, l.mob_result, l.interview_confirmed, l.interview_sched_id, l.mob_remarks
											from applicant_lineup l
											left join manager_mr mr
											on l.manpower_id = mr.id
											left join manager_principal pr
											on mr.principal_id = pr.id
											left join manager_jobs j
											on l.mr_pos_id = j.id
											left join settings_position pos
											on j.pos_id = pos.id
											where l.id = {$record_id}");
	    	$data['select_sched'] = array();
	    	$sched = getdata("select id, interview_date, venue
	    					from manager_interview_schedule
	    					where mr_id = {$data['lineup_info'][0]['manpower_id']}
	    					order by interview_date asc");

	    	if($sched){
	    		foreach ($sched as $key => $value) {
	    			$data['select_sched'][$value['id']] = dateformat($value['interview_date'],5)." - ".$value['venue'];
	    		}
	    	}
	    }else if($what == 'welfare'){
	    	$form = "form_welfare";
	    	$data = array('applicant_id' => $applicant_id, 'record_id' => $record_id);
	    	$data['welfare_info'] = getdata("select * from applicant_welfare where id = {$record_id}");
	    }else if($what == 'jap_relative'){
			$form = "form_jap_relatives";
	    	$data = array('applicant_id' => $applicant_id, 'record_id' => $record_id);
	    	$data['relative_info'] = getdata("select * from applicant_char_ref_jap where id = {$record_id}");
	    }

	    echo $this->load->view('applicant/'.$form, $data, TRUE);
	}
	
	public function delete_applicant(){
	    $this->load->model('applicant_model');
	    if($this->applicant_model->delete_applicant_data($_GET['applicant_id'])){
	        echo "success";
	    }else{
	        echo "error";
	    }
	}
	
	public function my_files($file_id=null, $tbl_name="applicant_uploads", $fld_name="filename"){
	    if($file_id){
	        $file_id = base64_decode($file_id);
	        
	        if(is_numeric($file_id)){
	            $files = getdata("select * from {$tbl_name} where id = {$file_id}");
	            
	            if($files){
	            	if(isset($files[0][$fld_name])){
		                $this->load->helper('file');
		                $path_to_file = $files[0][$fld_name];
		                
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
	    }else{
	        return false;
	    }
	}
	
	public function pqd($format="default", $id){
	    $form_name = "pqd";
	    if($format == 'assessment'){
	        $assessment_info = getdata("select * from applicant_assessment where id = {$id}");
	        $id = $assessment_info[0]['applicant_id'];
	        $form_name = "pqd_assessment";
	        $data['assessment'] = $assessment_info[0];
	    }else if($format == 'assessment_lineup'){
	        $assessment_info = getdata("select l.id, l.applicant_id, pos.desc as position, l.assess_detail, l.assess_position, l.assess_nature, l.assess_date, l.assess_by
										from applicant_lineup l
										left join manager_jobs j
										on l.mr_pos_id = j.id
										left join settings_position pos
										on j.pos_id = pos.id
										where l.id= {$id}");
	        $id = $assessment_info[0]['applicant_id'];
	        $form_name = "pqd_assessment_lineup";
	        $data['assessment'] = $assessment_info[0];
	    }else if($format=='jap'){
	    	$data['jap_profile'] = getdata("select * from applicant_profile_jap where applicant_id = {$id}");
	    	$data['jap_relatives'] = getdata("select * from applicant_char_ref_jap where applicant_id = {$id}");
	        $form_name = "pqd_jap";
	    }

	    $this->load->model('applicant_model');
	    $data['applicant_data'] = $this->applicant_model->get_applicant_data($id);

	    if(!$data['applicant_data']){
	        redirect('applicant', 'refresh');
	    }

	    $this->load->view('applicant/'.$form_name, $data);
	}

	public function print_accounts_card($applicant_id){
		if($applicant_id = base64_decode($applicant_id)){
		    $this->load->model('applicant_model');
		    $data['applicant_data'] = $this->applicant_model->get_applicant_data($applicant_id);

		    if(!$data['applicant_data']){
		        redirect('applicant', 'refresh');
		    }

		    $data['current_lineup'] = $this->get_current_lineup($applicant_id);
			$data['medical'] = getdata("select * from applicant_medical_info where applicant_id = {$applicant_id} and is_archived = 'N'");

			if($data['current_lineup'][0]['lineup_id']){
				$data['acc_hdr'] = getdata("select * from applicant_accounts_card_hdr where applicant_id = {$applicant_id} and lineup_id = {$data['current_lineup'][0]['lineup_id']}");

				$data['particulars'] = getdata("select acc.*, sp.name as particular, pm.name as payment_method
												from applicant_general_info i
												left join applicant_accounts_card acc
												on i.lineup_id = acc.lineup_id
												left join settings_particulars sp
												on acc.particular_id = sp.id
												left join settings_payment_method pm
												on acc.payment_method_id = pm.id
												where i.id={$applicant_id}");
			}else{
				/*IF RESERVED*/
				$data['acc_hdr'] = getdata("select * from applicant_accounts_card_hdr where applicant_id = {$applicant_id}");
				$data['particulars'] = getdata("select acc.*, sp.name as particular, pm.name as payment_method
												from applicant_general_info i
												left join applicant_accounts_card acc
												on i.id = acc.applicant_id
												left join settings_particulars sp
												on acc.particular_id = sp.id
												left join settings_payment_method pm
												on acc.payment_method_id = pm.id
												where i.id={$applicant_id}");
			}

			$this->load->view('applicant/accounts_card_print', $data);
		}else{
			redirect('applicant', 'refresh');
		}
	}

	public function print_welfare($id){
	    $this->load->model('applicant_model');
	    $data['applicant_data'] = $this->applicant_model->get_applicant_data($id);

	    if(!$data['applicant_data']){
	        redirect('applicant', 'refresh');
	    }

		$data['welfare_data'] = getdata("select * from applicant_welfare where applicant_id = {$id}");
	    $this->load->view('applicant/print_welfare', $data);
	}

	private function get_current_lineup($applicant_id){
		return getdata("select l.id as lineup_id, mr.code as mr_ref, mr.principal_id, j.principal_id as j_principal_id, pr.name as principal, j.pos_id, pos.`desc` as position, cu.currency_code, emp.salary_amount, emp.salary_per, l.is_deployed, l.deployment_date
						from applicant_general_info i
						left join applicant_lineup l
						on i.lineup_id = l.id
						left join manager_mr mr
						on l.manpower_id = mr.id
						left join manager_principal pr
						on mr.principal_id = pr.id
						left join manager_jobs j
						on l.mr_pos_id = j.id
						left join settings_position pos
						on j.pos_id = pos.id
						left join applicant_employment_offer emp
						on i.lineup_id = emp.lineup_id
						left join settings_currency cu
						on emp.salary_currency = cu.id
						where 1
						and i.id = {$applicant_id}");
	}

	public function deletenullEmail(){
	    $q = "select * from applicant_general_info where (email is null or email = '')";
	    $r = getdata($q);

	    if($r){
	        $this->load->model('applicant_model');
	        foreach ($r as $i){
	            if($this->applicant_model->delete_applicant_data($i['id'])){
	                echo $i['id']." - deleted<br>";
        	    }else{
        	        echo $i['id']." - ERROR<br>";
        	    }
	        }
	    }else{
	        echo "no record found.";
	    }
	}

	public function fetch($id){
		$email_info = array('from_email' => SUPPORT_EMAIL,
							'from_name' => SUPPORT_NAME,
							'recipient' => 'almostcarlo@gmail.com',
							'subject' => 'testing',
							'message' => 'Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.');
		$xxx = send_email($email_info);

		// $data = array(
  //   		'token' => 'GFd-zeMfxVXXvkPnzNpgEgpmgjr67JTCs40MmrIkvSs',
  //   		'mobile_no' => '9151913096',
  //   		'message' => 'testing sms only '.date("Y-m-d h:i:s")
  //   	);
		// send_sms($data);
		// echo "FETCH";
		// $data['applicant_id'] = 11;
		// save_sms_outbox($data);
		// exit();
		//var_dump($xxx);
// 	    $this->load->model('applicant_model');
// 	    if($this->applicant_model->delete_applicant_data($id)){
// 	        echo "success";
// 	    }else{
// 	        echo "error";
// 	    }
// 	    exit();
	    
// 	    $this->load->helper('date');
// 	    $strtime = now();
// 	    echo date("Ymd h:i:sa", $strtime);
     //    $xxx = getdata("SELECT NOW();");
     //    var_dump($xxx);
	    // exit();
	    //$this->load->model('applicant_model');
	    //$path = $this->applicant_model->delete_applicant_data(16);
// 	    $path = "./uploads/2019/Feb/19";
	    //var_dump($path);
// 	    rmdir($path);
	    
// 	    $xxsdsd         = './uploads/profile_pic/'.date("Y")."/".date("M")."/3_IPRS.png";
// 	    echo is_file($xxsdsd);
// 	    $xxx = get_items_from_cache('education');
// 	    var_dump($_SESSION);
// 	    $this->load->driver('cache');
// 	    $this->cache->apc->get('this_cachce');
// 	    $xxx = get_items_from_cache('country');
// 	    var_dump($xxx);
	}

	private function check_duplicate_record($id){
	    $q_email = getdata("select email from applicant_general_info where id={$id}");
	    if(isset($q_email[0]['email'])){
	        $q = getdata("select id from applicant_general_info where email = '{$q_email[0]['email']}' and id != {$id}");

	        if($q){
	            $this->load->model('applicant_model');

	            foreach ($q as $x){
	                $this->applicant_model->delete_applicant_data($x['id']);
	            }
	        }
	    }
	}

	public function for_endorsement($applicant_id, $action="add"){
		$this->load->model('applicant_model');
		$this->applicant_model->for_endorsement($applicant_id, $action);
		redirect('profile/'.$applicant_id.'/documents', 'refresh');
	}

	public function reported_today($applicant_id=NULL){
		if($applicant_id){
			$this->session->set_flashdata('settings_notification_status', 'Success');
			$this->session->set_flashdata('settings_notification', 'Last Reporting Date has been updated.');

			dbsetdata("update applicant_general_info set last_reporting_date = NOW() where id = {$applicant_id}");
			redirect('profile/'.$applicant_id, 'refresh');
		}else{
			redirect('applicant', 'refresh');
		}
	}

	/*ACCOUNTS CARD CLEARANCE*/
	public function update_clearance($applicant_id){
		$current_lineup = $this->get_current_lineup($applicant_id);

		$q = getdata("select * from applicant_accounts_card_hdr where applicant_id = '{$applicant_id}' and lineup_id = {$current_lineup[0]['lineup_id']}");
		if($q){
			/*UPDATE*/
			dbsetdata("update applicant_accounts_card_hdr set clearance_date = NOW(), clearance_by = '{$_SESSION['rs_user']['username']}', edit_date = NOW(), edit_by = '{$_SESSION['rs_user']['username']}' where id = {$q[0]['id']}");
		}else{
			/*CREATE RECORD*/
			dbsetdata("insert into applicant_accounts_card_hdr (applicant_id, lineup_id, clearance_date, clearance_by, add_date, add_by) values ('{$applicant_id}','{$current_lineup[0]['lineup_id']}',NOW(),'{$_SESSION['rs_user']['username']}',NOW(),'{$_SESSION['rs_user']['username']}')");
		}

		create_log('applicant_logs', $applicant_id, $_SESSION['rs_user']['username'], 'accounts card clearance', '');
		redirect('profile/'.$applicant_id.'/accounts_card', 'refresh');
	}

	/*PROCESSING*/
	public function processing($action, $applicant_id){
		$lineup_data = $this->get_current_lineup($applicant_id);
		if($lineup_data[0]['lineup_id']){
			$process_data = getdata("select * from applicant_processing where applicant_id = {$applicant_id} and lineup_id = '{$lineup_data[0]['lineup_id']}'");
			$this->load->model('applicant_model');

			switch ($action) {
				case 'request_visa':
					if(!$process_data || !$process_data[0]['request_visa_id']){
						$this->applicant_model->request_visa($applicant_id, $lineup_data[0]['lineup_id']);
					}
					break;

				case 'visa_endorsement':
					if(!$process_data || $process_data[0]['visa_endorsement_date']=='0000-00-00 00:00:00'){
						$this->applicant_model->visa_endorsement($applicant_id, $lineup_data[0]['lineup_id']);
					}
					break;

				case 'rfp_endorsement':
					if(!$process_data || $process_data[0]['rfp_endorsement_date']=='0000-00-00 00:00:00'){
						$this->applicant_model->rfp_endorsement($applicant_id, $lineup_data[0]['lineup_id']);
					}
					break;

				case 'visa_documentation':
					$this->applicant_model->visa_documentation($applicant_id, $lineup_data[0]['lineup_id']);
					break;

				case 'contract_signing':
					$this->applicant_model->contract_signing($applicant_id, $lineup_data[0]['lineup_id']);
					break;

				case 'pdos':
					$this->applicant_model->pdos($applicant_id, $lineup_data[0]['lineup_id']);
					break;

				/*UPDATE ONLY THE POEA REQUEST DATE*/
				case 'poea_request':
					$this->applicant_model->poea_request($applicant_id, $lineup_data[0]['lineup_id']);
					break;

				/*UPDATE JO ID AND JO CAT*/
				case 'request_jo':
					$this->applicant_model->jo_request($applicant_id, $lineup_data[0]['lineup_id']);
					break;

				case 'deallocate_jo':
					$this->applicant_model->deallocate_jo($applicant_id, $lineup_data[0]['lineup_id']);
					break;
			}
		}

		redirect('profile/'.$applicant_id."/processing", 'refresh');
	}

	public function visa_allocation(){
		/*AJAX*/
		$this->load->model('applicant_model');
		echo $this->applicant_model->visa_allocation();
		// echo "<pre>";
		// print_r($_POST);
		// print_r($_GET);
		exit();
	}

	public function oec_request(){
		// echo "<pre>";
		// print_r($_POST);
		// print_r($_GET);
		/*AJAX*/
		$this->load->model('applicant_model');
		echo $this->applicant_model->oec_request();
		exit();
	}

	public function jo_request(){
		// echo "<pre>";
		// print_r($_POST);
		// print_r($_GET);
		// exit();
		$this->load->model('applicant_model');
		echo $this->applicant_model->allocate_jo();
	}
	/*END PROCESSING*/
}
