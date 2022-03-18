<?php
class Medical_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();

        /* update timezone */
        dbsetdata("SET time_zone = '+8:00'");
    }

    public function save_medform(){
// 	    var_dump($_POST);
// 	    var_dump($_GET);
// 	    exit();
	    
	    $this->db->set('branch_id', $this->input->post('selectBranch', TRUE));
	    (dateformat($this->input->post('textPreMedDate'), 0))? $this->db->set('pre_med_date', dateformat($this->input->post('textPreMedDate'), 0)) :"";
	    //$this->db->set('pre_med_date', $this->input->post('textPreMedDate', TRUE));
	    $this->db->set('pre_med_status', $this->input->post('selectPreStat', TRUE));
	    (dateformat($this->input->post('textPptCopy'), 0))? $this->db->set('ppt_copy_date', dateformat($this->input->post('textPptCopy'), 0)) :"";
	    //$this->db->set('ppt_copy_date', $this->input->post('textPptCopy', TRUE));
	    (dateformat($this->input->post('textDeckReq'), 0))? $this->db->set('gamca_req_date', dateformat($this->input->post('textDeckReq'), 0)) :"";
	    //$this->db->set('gamca_req_date', $this->input->post('textDeckReq', TRUE));
	    $this->db->set('gamca_req_by', $this->input->post('selectReqBy', TRUE));
	    (dateformat($this->input->post('textRefRec'), 0))? $this->db->set('gamca_ref_date', dateformat($this->input->post('textRefRec'), 0)) :"";
	    //$this->db->set('gamca_ref_date', $this->input->post('textRefRec', TRUE));
	    $this->db->set('gamca_result', $this->input->post('selectGamcaRes', TRUE));
	    $this->db->set('gamca_sn', $this->input->post('textGamcaSN', TRUE));
	    $this->db->set('clinic_id', $this->input->post('selectClinic', TRUE));
	    (dateformat($this->input->post('textRefTaken'), 0))? $this->db->set('clinic_ref_taken_date', dateformat($this->input->post('textRefTaken'), 0)) :"";
	    //$this->db->set('clinic_ref_taken_date', $this->input->post('textRefTaken', TRUE));
	    $this->db->set('clinic_verify', $this->input->post('selectVerify', TRUE));
	    (dateformat($this->input->post('textMedDate'), 0))? $this->db->set('clinic_exam_date', dateformat($this->input->post('textMedDate'), 0)) :"";
	    //$this->db->set('clinic_exam_date', $this->input->post('textMedDate', TRUE));
	    $this->db->set('med_result', $this->input->post('selectResult', TRUE));
	    (dateformat($this->input->post('textResultDate'), 0))? $this->db->set('med_result_rec_date', dateformat($this->input->post('textResultDate'), 0)) :"";
	    //$this->db->set('med_result_rec_date', $this->input->post('textResultDate', TRUE));
	    (dateformat($this->input->post('textTransDate'), 0))? $this->db->set('med_result_trans_date', dateformat($this->input->post('textTransDate'), 0)) :"";
	    //$this->db->set('med_result_trans_date', $this->input->post('textTransDate', TRUE));
	    (dateformat($this->input->post('textIssueDate'), 0))? $this->db->set('med_result_issue_date', dateformat($this->input->post('textIssueDate'), 0)) :"";
	    //$this->db->set('med_result_issue_date', $this->input->post('textIssueDate', TRUE));
	    (dateformat($this->input->post('textExpDate'), 0))? $this->db->set('med_result_exp_date', dateformat($this->input->post('textExpDate'), 0)) :"";
	    //$this->db->set('med_result_exp_date', $this->input->post('textExpDate', TRUE));
	    $this->db->set('med_result_blood_type', $this->input->post('selectBloodType', TRUE));
	    $this->db->set('med_result_findings', $this->input->post('textFindings', TRUE));
	    $this->db->set('med_result_clinic_remarks', $this->input->post('textRemarks', TRUE));
	    if($this->input->post('checkWaiver')){
	       $this->db->set('waiver_needed', 'Y');
	    }else{
	        $this->db->set('waiver_needed', 'N');
	    }
	    (dateformat($this->input->post('textWaiverRel'), 0))? $this->db->set('waiver_rel_date', dateformat($this->input->post('textWaiverRel'), 0)) :"";
	    //$this->db->set('waiver_rel_date', $this->input->post('textWaiverRel', TRUE));
	    (dateformat($this->input->post('textWaiverApp'), 0))? $this->db->set('waiver_app_date', dateformat($this->input->post('textWaiverApp'), 0)) :"";
	    //$this->db->set('waiver_app_date', $this->input->post('textWaiverApp', TRUE));
	    (dateformat($this->input->post('textCertRecBr'), 0))? $this->db->set('or_branch_rec_date', dateformat($this->input->post('textCertRecBr'), 0)) :"";
	    //$this->db->set('or_branch_rec_date', $this->input->post('textCertRecBr', TRUE));
	    $this->db->set('or_branch_rec_by', $this->input->post('selectCertBrRecBy', TRUE));
	    (dateformat($this->input->post('textCertRecCounter'), 0))? $this->db->set('or_counter_rec_date', dateformat($this->input->post('textCertRecCounter'), 0)) :"";
	    //$this->db->set('or_counter_rec_date', $this->input->post('textCertRecCounter', TRUE));
	    $this->db->set('or_counter_rec_by', $this->input->post('selectCertCounterRecBy', TRUE));
	    $this->db->set('or_group_remarks', $this->input->post('textGroupRemarks', TRUE));
	    
	    if($this->input->post('textRecordId')){
	        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
	        $this->db->set('edit_date', 'NOW()', FALSE);
	        $this->db->where('id', $this->input->post('textRecordId'));
	        
	        $return_val = $this->db->update('applicant_medical_info');
	        $id = $this->input->post('textRecordId');
	        $logs = "edit medical info";
	        $this->session->set_flashdata('settings_notification', 'Record successfully updated.');
	    }else{
	        $this->db->set('applicant_id', $this->input->post('applicant_id', TRUE));
	        $this->db->set('add_by', $_SESSION['rs_user']['username']);
	        $this->db->set('add_date', 'NOW()', FALSE);
	        $return_val = $this->db->insert('applicant_medical_info');
	        $id = $this->db->insert_id();
	        $logs = "create medical info";
	        $this->session->set_flashdata('settings_notification', 'Record successfully created.');
	    }
	    
	    if($return_val){
	        $this->session->set_flashdata('settings_notification_status', 'Success');
	        create_log('applicant', $this->input->post('applicant_id'), $_SESSION['rs_user']['username'], 'applicant_medical_info', $logs);
	        return $id;
	    }else{
	        $this->session->set_flashdata('settings_notification_status', 'Error');
	        $this->session->set_flashdata('settings_notification', 'Unable to create record.');
	        return false;
	    }
    }
    
    public function archive_med($id, $applicant_id){
        $this->db->set('is_archived', 'Y');
        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
        $this->db->set('edit_date', 'NOW()', FALSE);
        $this->db->where('id', $id);
        $return_val = $this->db->update('applicant_medical_info');

        if($return_val){
            create_log('applicant', $applicant_id, $_SESSION['rs_user']['username'], 'applicant_medical_info', 'success - archive medical:id '.$id);
            $this->session->set_flashdata('settings_notification', 'Medical Record has been archived.');
            $this->session->set_flashdata('settings_notification_status', 'Success');
        }else{
            create_log('applicant', $applicant_id, $_SESSION['rs_user']['username'], 'applicant_medical_info', 'failed - archive medical:id '.$id);
            $this->session->set_flashdata('settings_notification_status', 'Error');
            $this->session->set_flashdata('settings_notification', 'Unable to archive medical record.');
        }
    }

    public function save($what)
    {
        $create_log_tbl = "user";
        $create_log_id = "";
        switch ($what){
        	case 'pcr':
                $this->db->set('applicant_id', $this->input->post('applicant_id', TRUE));
                $this->db->set('result', $this->input->post('textPRCResult', TRUE));
                $this->db->set('clinic_id', $this->input->post('selectPCRClinic', TRUE));
                $this->db->set('amount', $this->input->post('textPCRAmt', TRUE));
                if($this->input->post('textPCRdate')){
                    $testing_date = dateformat($this->input->post('textPCRdate', TRUE),0);
                }else{
                    $testing_date= "0000-00-00 00:00:00";
                }
                $this->db->set('testing_date', $testing_date);
                $tbl_name = "applicant_pcrtest";
                $logs = "pcr testing - ";
        		break;

            case 'vaccine':
            	$no_of_dose = 2;
            	if($_POST['selectBrand'] == 'J&J Janssen'){
            		$no_of_dose = 1;
            	}

            	/*VACCINE CARD*/
            	if($_FILES['fileCovax']){
                    $ext = pathinfo($_FILES['fileCovax']['name'], PATHINFO_EXTENSION);
                    $path = "./uploads/applicant/".$_POST['textApplicant_id']."/";
                    $filename = "vaccine_card.".$ext;
                    $docs = upload_file('fileCovax', $path, $filename);

                    if(!is_array($docs)){
                        /*ERROR*/
                    }else{
                    	/*save to doc library*/
                    	$this->load->model('applicant_model');
                    	$this->applicant_model->save_uploads($path.$filename, 'Covid Vaccine');

                        $this->db->set('vaccine_card', $path.$filename);
                    }
            	}

                $this->db->set('applicant_id', $this->input->post('textApplicant_id', TRUE));
                $this->db->set('vaccinated', $this->input->post('selectVaccinated', TRUE));
                $this->db->set('brand', $this->input->post('selectBrand', TRUE));
                $this->db->set('venue', $this->input->post('textVenue', TRUE));
                (dateformat($this->input->post('text1stDose'), 0))? $this->db->set('1st_dose', dateformat($this->input->post('text1stDose'), 0)) :"";
                (dateformat($this->input->post('text2ndDose'), 0))? $this->db->set('2nd_dose', dateformat($this->input->post('text2ndDose'), 0)) :"";
                $this->db->set('no_of_dose', $no_of_dose);
                

                $tbl_name = "applicant_vaccine_info";
                $logs = "covid vaccine - ";
                break;

            case 'cv_transmittal':
                if(!$this->input->post('textRecordId')){
                    $max_transno = $this->db->count_all_results('manager_cv_transmittal');
                    $transmittal_no = str_pad(($max_transno+1),6,0,STR_PAD_LEFT);
                    $this->db->set('transmittal_no', $transmittal_no);
                    
                    $this->db->set('principal_id', $this->input->post('textPrincipalId', TRUE));
                    $this->db->set('company_id', $this->input->post('selectCompany', TRUE));
                }

                $this->db->set('attention', $this->input->post('textAttention', TRUE));
                $this->db->set('from', $this->input->post('textFrom', TRUE));
                $this->db->set('subject', $this->input->post('textSubject', TRUE));
                $this->db->set('message', $this->input->post('textMsg', TRUE));
                if($this->input->post('textSentDate')){
                    $sent_date = dateformat($this->input->post('textSentDate', TRUE),0);
                }else{
                    $sent_date= "0000-00-00 00:00:00";
                }
                $this->db->set('sent_date', $sent_date);
                $tbl_name = "manager_cv_transmittal";
                $logs = "cv transmittal - ";
                break;
            case 'applicant_cv_status':
                $this->db->set('applicant_id', $this->input->get('applicant_id', TRUE));
                $this->db->set('status', $this->input->get('status', TRUE));
                $this->db->set('transmittal_id', $this->input->get('trans_id', TRUE));
                if($this->input->get('status')=='Sent'){
                    $this->db->set('sent_date', 'NOW()', FALSE);
                }else if($this->input->get('status')=='Reviewed'){
                    $this->db->set('reviewed_date', 'NOW()', FALSE);
                }else if($this->input->get('status')=='Selected'){
                    $this->db->set('select_date', 'NOW()', FALSE);
                }
                $tbl_name = "applicant_cv_status";
                $logs = "cv transmittal ({$this->input->get('status')}) - ";
                $create_log_tbl= "applicant";
                $create_log_id = $this->input->get('applicant_id');
                break;
            case 'multiple_cv_status':
                $this->db->set('status', $this->input->post('selectStat', TRUE));
                if($this->input->post('selectStat')=='sent'){
                    $this->db->set('sent_date', dateformat($this->input->post('textDate', TRUE),0));
                }else if($this->input->post('selectStat')=='reviewed'){
                    $this->db->set('reviewed_date', dateformat($this->input->post('textDate', TRUE),0));
                }else if($this->input->post('selectStat')=='selected'){
                    $this->db->set('select_date', dateformat($this->input->post('textDate', TRUE),0));
                }
                $tbl_name = "applicant_cv_status";
                $logs = "cv transmittal ({$this->input->post('selectStat')} {$this->input->post('textRecordId')}) - ";
                break;
//             case 'principal':
//                 $this->db->set('code', strtoupper($this->input->post('textPrincipalCode', TRUE)));
//                 $this->db->set('name', $this->input->post('textPrincipalName', TRUE));
//                 $this->db->set('description', $this->input->post('textPrincipalDesc', TRUE));
//                 $this->db->set('address', $this->input->post('textAddress', TRUE));
//                 $this->db->set('city', $this->input->post('textCity', TRUE));
//                 $this->db->set('country_id', $this->input->post('selectCountry', TRUE));
//                 $this->db->set('nature_id', $this->input->post('selectNatureCompany', TRUE));
//                 $this->db->set('tel_no', $this->input->post('textTelephone', TRUE));
//                 $this->db->set('fax_no', $this->input->post('textFax', TRUE));
//                 $this->db->set('email', $this->input->post('textEmail', TRUE));
//                 $this->db->set('website', $this->input->post('textWebsite', TRUE));
//                 $this->db->set('facebook', $this->input->post('textFacebook', TRUE));
//                 $this->db->set('linkedin', $this->input->post('textLinkedIn', TRUE));
//                 $this->db->set('accre_no', $this->input->post('textAccreditationNumber', TRUE));
//                 $tbl_name = "manager_principal";
//                 $logs = $this->input->post('textPrincipalCode')." - ";
//                 break;
                
//             case 'company':
//                 $this->db->set('principal_id', strtoupper($this->input->post('SelectPrincipal', TRUE)));
//                 $this->db->set('code', strtoupper($this->input->post('textCompanyCode', TRUE)));
//                 $this->db->set('name', $this->input->post('textCompanyName', TRUE));
//                 $this->db->set('address', $this->input->post('textAddress', TRUE));
//                 $this->db->set('city', $this->input->post('textCity', TRUE));
//                 $this->db->set('country_id', $this->input->post('selectCountry', TRUE));
//                 //$this->db->set('nature_id', $this->input->post('selectNatureCompany', TRUE));
//                 $this->db->set('tel_no', $this->input->post('textTelephone', TRUE));
//                 $this->db->set('fax_no', $this->input->post('textFax', TRUE));
//                 $this->db->set('email', $this->input->post('textEmail', TRUE));
//                 $this->db->set('website', $this->input->post('textWebsite', TRUE));
//                 $this->db->set('facebook', $this->input->post('textFacebook', TRUE));
//                 $this->db->set('linkedin', $this->input->post('textLinkedIn', TRUE));
//                 //$this->db->set('accre_no', $this->input->post('textAccreditationNumber', TRUE));
//                 $tbl_name = "manager_company";
//                 $logs = $this->input->post('textCompanyCode')." - ";

//                 /* CLEAR SESSION */
//                 unset($_SESSION['settings']['company_per_principal']);
//                 break;
                
//             case 'contacts':
//                 /* PRINCIPAL CONTACTS */
//                 $this->db->set('principal_id', $this->input->post('textPrincipalId', TRUE));
//                 $this->db->set('name', $this->input->post('textFullName', TRUE));
//                 $this->db->set('designation', $this->input->post('textDesignation', TRUE));
//                 $this->db->set('tel_no', $this->input->post('textTelNum', TRUE));
//                 $this->db->set('mob_no', $this->input->post('textMobileNum', TRUE));
//                 $this->db->set('email', $this->input->post('textEmail', TRUE));
//                 $this->db->set('skype', $this->input->post('textSkypeID', TRUE));
//                 $this->db->set('facebook', $this->input->post('textFacebook', TRUE));
//                 $tbl_name = "manager_principal_contacts";
//                 $logs = "contacts pID:".$this->input->post('textPrincipalId', TRUE)." - ";
//                 break;
                
//             case 'mr':
//                 $activity = implode('/', $_POST['chkActivity']);
//                 $is_pooling = ($this->input->post('chkPooling'))?"Y":"N";

//                 if(!$this->input->post('textRecordId')){
//                     $max_mr = $this->db->where('principal_id', $this->input->post('textPrincipalId'))->count_all_results('manager_mr');
//                     $principal_info = getdata("select code from manager_principal where id = {$this->input->post('textPrincipalId')}");
//                     $rec_code = $principal_info[0]['code']."-".str_pad(($max_mr+1), 4, "0", STR_PAD_LEFT);
//                     $this->db->set('code', $rec_code);
//                 }

//                 $this->db->set('principal_id', $this->input->post('textPrincipalId', TRUE));
//                 $this->db->set('company_id', $this->input->post('selectCompany', TRUE));
//                 $this->db->set('status', $this->input->post('selectStatus', TRUE));
//                 $this->db->set('activity', $activity);
//                 $this->db->set('is_pooling', $is_pooling);
//                 $this->db->set('rs', $this->input->post('selectRS', TRUE));
//                 $this->db->set('fee_condition', $this->input->post('selectFeeCondition', TRUE));
//                 $tbl_name = "manager_mr";
//                 $logs = "mr pID:".$this->input->post('textPrincipalId', TRUE)." - mr - ";
                
//                 /* CLEAR SESSION */
//                 unset($_SESSION['settings']['mr_per_principal'], $_SESSION['settings']['mr_per_company'], $_SESSION['settings']['active_principal']);
//                 break;
                
//             case 'jo':
//                 $this->db->set('principal_id', $this->input->post('textPrincipalId', TRUE));
//                 if($this->input->post('selectCompany')) $this->db->set('company_id', $this->input->post('selectCompany', TRUE));
//                 if($this->input->post('selectMR')) $this->db->set('mr_id', $this->input->post('selectMR', TRUE));
//                 $this->db->set('pos_id', $this->input->post('textPosition', TRUE));
//                 $this->db->set('target', $this->input->post('textTarget', TRUE));
//                 $this->db->set('required', $this->input->post('textRequired', TRUE));
//                 $this->db->set('status', $this->input->post('selectStatus', TRUE));
//                 $this->db->set('salary_curr', $this->input->post('selectCurrency', TRUE));
//                 $this->db->set('salary_amt', $this->input->post('textSalary', TRUE));
//                 $this->db->set('allowance_type', $this->input->post('selectFood', TRUE));
//                 $this->db->set('allowance_amt', $this->input->post('textFoodAllowance', TRUE));
//                 $this->db->set('gender', $this->input->post('selectGender', TRUE));
//                 $this->db->set('religion', $this->input->post('selectReligion', TRUE));
//                 $this->db->set('location', $this->input->post('textLocation', TRUE));
//                 $this->db->set('desc', $this->input->post('textJobDesc', TRUE));
//                 $this->db->set('req', $this->input->post('textJobReq', TRUE));
//                 if($this->input->post('inputExpDate')){
//                     $exp_date = dateformat($this->input->post('inputExpDate', TRUE),0);
//                 }else{
//                     $exp_date = "0000-00-00 00:00:00";
//                 }
//                 $this->db->set('expiry_date', $exp_date);
//                 $tbl_name = "manager_jobs";
//                 $logs = "mr pID:".$this->input->post('textPrincipalId', TRUE)." - jobs - ";
//                 break;
                
//             case 'position':
//                 $this->db->set('desc', strtoupper($this->input->post('textPos', TRUE)));
//                 $this->db->set('jobspec_id', $this->input->post('selectJobspec', TRUE));
//                 $tbl_name = "settings_position";
//                 $logs = "position - ";
                
//                 /* CLEAR SESSION */
//                 unset($_SESSION['settings']['position']);
//                 break;
                
//             case 'announcement':
//                 $this->db->set('title', $this->input->post('textTitle', TRUE));
//                 $this->db->set('details', $this->input->post('textDetails', TRUE));
//                 $tbl_name = "manager_announcement";
//                 $logs = "announcement - ";
//                 break;
                
//             case 'menu':
//                 $this->db->set('parent_id', $this->input->post('selectParent', TRUE));
//                 $this->db->set('title', $this->input->post('textTitle', TRUE));
//                 $this->db->set('url', $this->input->post('textURL', TRUE));
//                 $this->db->set('css_class', $this->input->post('textCSS', TRUE));
//                 $this->db->set('level', $this->input->post('selectLevel', TRUE));
//                 if(!$this->input->post('textRecordId')){
//                     $this->db->set('user_id', '1');
//                 }
//                 $tbl_name = "settings_menu";
//                 $logs = "menu - ";
//                 break;
        }

        if($this->input->post('textRecordId')){
            $this->db->set('edit_by', $_SESSION['rs_user']['username']);
            $this->db->set('edit_date', 'NOW()', FALSE);
            
            if($what=='multiple_cv_status'){
                $ids = explode(',',$this->input->post('textRecordId'));
                $this->db->where_in('id', $ids);
            }else{
                $this->db->where('id', $this->input->post('textRecordId'));
            }

            $return_val = $this->db->update($tbl_name);
            $id = $this->input->post('textRecordId');
            $logs .= "edit";
            $this->session->set_flashdata('settings_notification', 'Record successfully updated.');
        }else{
            $this->db->set('add_by', $_SESSION['rs_user']['username']);
            $this->db->set('add_date', 'NOW()', FALSE);
            
            $return_val = $this->db->insert($tbl_name);
            $id = $this->db->insert_id();
            $logs .= "create";
            $this->session->set_flashdata('settings_notification', 'Record successfully created.');
        }

        if($return_val){
            $this->session->set_flashdata('settings_notification_status', 'Success');
            create_log($create_log_tbl, $create_log_id, $_SESSION['rs_user']['username'], $tbl_name, $logs);
            return $id;
        }else{
            $this->session->set_flashdata('settings_notification_status', 'Error');
            $this->session->set_flashdata('settings_notification', 'Unable to create record.');
            return false;
        }
    }
    
    public function delete($tbl, $id){
        $this->db->trans_start();
        
        if($tbl == 'manager_cv_transmittal'){
            $this->db->where('id', $id);
            $q = $this->db->get($tbl);
            $log_info = "delete cv transmittal - ".$q->row()->transmittal_no;
        }

//         if($tbl == 'settings_users'){
//             $this->db->where('id', $id);
//             $q = $this->db->get($tbl);
//             $log_info = "delete user - ".$q->row()->username; 
//         }else if($tbl == 'manager_principal'){
//             $this->db->where('id', $id);
//             $q = $this->db->get($tbl);
//             $log_info = "delete principal - ".$q->row()->code;

//             /* DELETE CONTACTS */
//             $this->db->where('principal_id', $id);
//             $this->db->delete('manager_principal_contacts');

//             /* DELETE MR */
//             $this->db->where('principal_id', $id);
//             $this->db->delete('manager_mr');

//             /* DELETE JOB OPENINGS */
//             $this->db->where('principal_id', $id);
//             $this->db->delete('manager_jobs');
//         }else if($tbl == 'manager_mr'){
//             $this->db->where('id', $id);
//             $q = $this->db->get($tbl);
//             $log_info = "delete mr - ".$q->row()->code;

//             /* DELETE JOB OPENINGS */
//             $this->db->where('mr_id', $id);
//             $this->db->delete('manager_jobs');
//         }else if($tbl == 'manager_jobs'){
//             $this->db->where('id', $id);
//             $q = $this->db->get($tbl);
//             $log_info = "delete jo - ".$q->row()->id;
            
//             /* DELETE LINEUP */
//             $this->db->where('mr_pos_id', $id);
//             $this->db->delete('applicant_lineup');
//         }else if($tbl == 'settings_position'){
//             $this->db->where('id', $id);
//             $q = $this->db->get($tbl);
//             $log_info = "delete position - ".$q->row()->desc;

//             /* DELETE JOB OPENINGS */
//             $this->db->where('pos_id', $id);
//             $this->db->delete('manager_jobs');
//         }else if($tbl == 'manager_announcement'){
//             $this->db->where('id', $id);
//             $q = $this->db->get($tbl);
//             $log_info = "delete announcement - ".$q->row()->title;
//         }else{
//             $log_info = "delete principal contact";
//         }

        $this->db->where('id', $id);
        $this->db->delete($tbl);

        if($this->db->trans_complete()){
            create_log('user', '', $_SESSION['rs_user']['username'], 'delete', $log_info);
            $this->session->set_flashdata('settings_notification', 'Record successfully deleted.');
            $this->session->set_flashdata('settings_notification_status', 'Success');
        }else{
            $this->session->set_flashdata('settings_notification', 'Unable to delete record.');
            $this->session->set_flashdata('settings_notification_status', 'Error');
        }
    }
    
    public function delete_file($tbl_name, $fld_name, $id){
        $this->db->set($fld_name, '');
        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
        $this->db->set('edit_date', 'NOW()', FALSE);
        $this->db->where('id', $id);
        if($this->db->update($tbl_name)){
            create_log('user', '', $_SESSION['rs_user']['username'], 'delete', 'delete '.$fld_name);
            return true;
        }else{
            return false;
        }
    }
    
}