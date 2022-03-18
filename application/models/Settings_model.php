<?php
class Settings_model extends CI_Model {

    public function __construct()
    {
        $this->load->database();

        /* update timezone */
        dbsetdata("SET time_zone = '+8:00'");
    }

    public function save($what)
    {
        switch ($what){
            case 'user':
                // $password = $this->input->post('textPassword');
                $password = password_hash(trim($this->input->post('textPassword')), PASSWORD_DEFAULT);
                $this->db->set('username', $this->input->post('textUserName', TRUE));
                $this->db->set('name', $this->input->post('textName', TRUE));
                // if($password!='') $this->db->set('password', 'PASSWORD("'.$password.'")', FALSE);
                if($password!='') $this->db->set('password', $password);
                $this->db->set('is_active', $this->input->post('textUserStatus', TRUE));
                $this->db->set('position', $this->input->post('textPosition', TRUE));
                $this->db->set('department', $this->input->post('textDepartment', TRUE));
                $this->db->set('branch_id', $this->input->post('selectBranch', TRUE));
                $tbl_name = "settings_users";
                $logs = $this->input->post('textUserName')." - ";
                break;
            case 'principal':
                $this->db->set('code', strtoupper($this->input->post('textPrincipalCode', TRUE)));
                $this->db->set('name', $this->input->post('textPrincipalName', TRUE));
                $this->db->set('description', $this->input->post('textPrincipalDesc', TRUE));
                $this->db->set('address', $this->input->post('textAddress', TRUE));
                $this->db->set('city', $this->input->post('textCity', TRUE));
                $this->db->set('country_id', $this->input->post('selectCountry', TRUE));
                $this->db->set('nature_id', $this->input->post('selectNatureCompany', TRUE));
                $this->db->set('tel_no', $this->input->post('textTelephone', TRUE));
                $this->db->set('fax_no', $this->input->post('textFax', TRUE));
                $this->db->set('email', $this->input->post('textEmail', TRUE));
                $this->db->set('website', $this->input->post('textWebsite', TRUE));
                $this->db->set('facebook', $this->input->post('textFacebook', TRUE));
                $this->db->set('linkedin', $this->input->post('textLinkedIn', TRUE));
                $this->db->set('accre_no', $this->input->post('textAccreditationNumber', TRUE));
                $tbl_name = "manager_principal";
                $logs = $this->input->post('textPrincipalCode')." - ";
                break;
                
            case 'company':
                $this->db->set('principal_id', strtoupper($this->input->post('SelectPrincipal', TRUE)));
                $this->db->set('code', strtoupper($this->input->post('textCompanyCode', TRUE)));
                $this->db->set('name', $this->input->post('textCompanyName', TRUE));
                $this->db->set('address', $this->input->post('textAddress', TRUE));
                $this->db->set('city', $this->input->post('textCity', TRUE));
                $this->db->set('country_id', $this->input->post('selectCountry', TRUE));
                //$this->db->set('nature_id', $this->input->post('selectNatureCompany', TRUE));
                $this->db->set('tel_no', $this->input->post('textTelephone', TRUE));
                $this->db->set('fax_no', $this->input->post('textFax', TRUE));
                $this->db->set('email', $this->input->post('textEmail', TRUE));
                $this->db->set('website', $this->input->post('textWebsite', TRUE));
                $this->db->set('facebook', $this->input->post('textFacebook', TRUE));
                $this->db->set('linkedin', $this->input->post('textLinkedIn', TRUE));
                //$this->db->set('accre_no', $this->input->post('textAccreditationNumber', TRUE));
                $tbl_name = "manager_company";
                $logs = $this->input->post('textCompanyCode')." - ";

                /* CLEAR SESSION */
                unset($_SESSION['settings']['company_per_principal']);
                break;
                
            case 'contacts':
                /* PRINCIPAL CONTACTS */
                $this->db->set('principal_id', $this->input->post('textPrincipalId', TRUE));
                $this->db->set('name', $this->input->post('textFullName', TRUE));
                $this->db->set('designation', $this->input->post('textDesignation', TRUE));
                $this->db->set('tel_no', $this->input->post('textTelNum', TRUE));
                $this->db->set('mob_no', $this->input->post('textMobileNum', TRUE));
                $this->db->set('email', $this->input->post('textEmail', TRUE));
                $this->db->set('skype', $this->input->post('textSkypeID', TRUE));
                $this->db->set('facebook', $this->input->post('textFacebook', TRUE));
                $tbl_name = "manager_principal_contacts";
                $logs = "contacts pID:".$this->input->post('textPrincipalId', TRUE)." - ";
                break;
                
            case 'mr':
                $activity = implode('/', $_POST['chkActivity']);
                $is_pooling = ($this->input->post('chkPooling'))?"Y":"N";

                if(!$this->input->post('textRecordId')){
                    $rec_code = generateMRRef($this->input->post('textPrincipalId'));
                    $this->db->set('code', $rec_code);
                }

                $this->db->set('principal_id', $this->input->post('textPrincipalId', TRUE));
                $this->db->set('company_id', $this->input->post('selectCompany', TRUE));
                $this->db->set('status', $this->input->post('selectStatus', TRUE));
                $this->db->set('activity', $activity);
                $this->db->set('is_pooling', $is_pooling);
                $this->db->set('rs', $this->input->post('selectRS', TRUE));
                $this->db->set('rso', $this->input->post('selectRSO', TRUE));
                $this->db->set('fee_condition', $this->input->post('selectFeeCondition', TRUE));
                $tbl_name = "manager_mr";
                $logs = "mr pID:".$this->input->post('textPrincipalId', TRUE)." - mr - ";
                
                /* CLEAR SESSION */
                unset($_SESSION['settings']['mr'], $_SESSION['settings']['mr_per_principal'], $_SESSION['settings']['mr_per_company'], $_SESSION['settings']['active_principal']);
                break;
                
            case 'jo':
                $this->db->set('principal_id', $this->input->post('textPrincipalId', TRUE));
                if($this->input->post('selectCompany')) $this->db->set('company_id', $this->input->post('selectCompany', TRUE));
                if($this->input->post('selectMR')) $this->db->set('mr_id', $this->input->post('selectMR', TRUE));
                $this->db->set('pos_id', $this->input->post('textPosition', TRUE));
                $this->db->set('target', $this->input->post('textTarget', TRUE));
                $this->db->set('required', $this->input->post('textRequired', TRUE));
                $this->db->set('status', $this->input->post('selectStatus', TRUE));
                $this->db->set('salary_curr', $this->input->post('selectCurrency', TRUE));
                $this->db->set('salary_amt', $this->input->post('textSalary', TRUE));
                $this->db->set('allowance_type', $this->input->post('selectFood', TRUE));
                $this->db->set('allowance_amt', $this->input->post('textFoodAllowance', TRUE));
                $this->db->set('gender', $this->input->post('selectGender', TRUE));
                $this->db->set('religion', $this->input->post('selectReligion', TRUE));
                $this->db->set('location', $this->input->post('textLocation', TRUE));
                $this->db->set('desc', $this->input->post('textJobDesc', TRUE));
                $this->db->set('req', $this->input->post('textJobReq', TRUE));
                if($this->input->post('inputExpDate')){
                    $exp_date = dateformat($this->input->post('inputExpDate', TRUE),0);
                }else{
                    $exp_date = "0000-00-00 00:00:00";
                }
                $this->db->set('expiry_date', $exp_date);
                $tbl_name = "manager_jobs";
                $logs = "mr pID:".$this->input->post('textPrincipalId', TRUE)." - jobs - ";
                break;
                
            case 'position':
                $this->db->set('desc', strtoupper($this->input->post('textPos', TRUE)));
                $this->db->set('jobspec_id', $this->input->post('selectJobspec', TRUE));
                $tbl_name = "settings_position";
                $logs = "position - ";
                
                /* CLEAR SESSION */
                unset($_SESSION['settings']['position']);
                break;
                
            case 'announcement':
                $this->db->set('title', $this->input->post('textTitle', TRUE));
                $this->db->set('details', $this->input->post('textDetails', TRUE));
                $tbl_name = "manager_announcement";
                $logs = "announcement - ";
                break;
                
            case 'menu':
                $this->db->set('parent_id', $this->input->post('selectParent', TRUE));
                $this->db->set('title', $this->input->post('textTitle', TRUE));
                $this->db->set('url', $this->input->post('textURL', TRUE));
                $this->db->set('css_class', $this->input->post('textCSS', TRUE));
                $this->db->set('level', $this->input->post('selectLevel', TRUE));
                $this->db->set('order_no', $this->input->post('textOrder', TRUE));
                if(!$this->input->post('textRecordId')){
                    $this->db->set('user_id', '1');
                }
                $tbl_name = "settings_menu";
                $logs = "menu - ";
                break;
                
            case 'clinic':
                $this->db->set('name', $this->input->post('textName', TRUE));
                $this->db->set('code', $this->input->post('textCode', TRUE));
                $this->db->set('address', $this->input->post('textAddress', TRUE));
                $this->db->set('contact_person', $this->input->post('textContact', TRUE));
                $this->db->set('tel_no', $this->input->post('textTelNo', TRUE));
                $this->db->set('fax_no', $this->input->post('textFax', TRUE));
                $this->db->set('email', $this->input->post('textEmail', TRUE));
                $this->db->set('remarks', $this->input->post('textRemarks', TRUE));
                $tbl_name = "settings_clinic";
                $logs = "clinic - ";
                break;
                
            case 'city':
                $this->db->set('name', $this->input->post('textName', TRUE));
                $this->db->set('province', $this->input->post('textProvince', TRUE));
                $this->db->set('zipcode', $this->input->post('textZip', TRUE));
                $this->db->set('area_code', $this->input->post('textAreacode', TRUE));
                $this->db->set('region', $this->input->post('textRegion', TRUE));
                #$this->db->set('branch_id', $this->input->post('textBranch', TRUE));
                $tbl_name = "settings_city";
                $logs = "city - ";
                break;
                
            case 'province':
                $this->db->set('name', $this->input->post('textName', TRUE));
                $tbl_name = "settings_province";
                $logs = "province - ";
                break;

            case 'rec_fee_hdr':
                $this->db->set('principal_id', $this->input->post('SelectPrincipal', TRUE));
                $this->db->set('company_id', $this->input->post('SelectCompany', TRUE));
                $this->db->set('existing_agreement', $this->input->post('textExistAgree', TRUE));
                $this->db->set('remarks', $this->input->post('textRemarks', TRUE));
                $tbl_name = "settings_recfee_hdr";
                $logs = "rec fee hdr - ";
                break;

            case 'rec_fee_label':
                $this->db->set('recfee_id', $this->input->post('recfee_id', TRUE));
                $this->db->set('title', $this->input->post('textTitle', TRUE));
                $this->db->set('pos_id', $this->input->post('SelectPosition', TRUE));
                $this->db->set('service_fee', $this->input->post('textSvcFee', TRUE));
                $this->db->set('insurance_fee', $this->input->post('textInsuranceFee', TRUE));
                $this->db->set('placement_fee', $this->input->post('textPlacementFee', TRUE));
                $this->db->set('processing_fee', $this->input->post('textProcessFee', TRUE));
                $this->db->set('salary_deduction', $this->input->post('textSD', TRUE));
                $this->db->set('ticket_condition', $this->input->post('textTicket', TRUE));
                $this->db->set('terms', $this->input->post('textTerms', TRUE));
                $this->db->set('remarks', $this->input->post('textRemarks', TRUE));
                $tbl_name = "settings_recfee_label";
                $logs = "rec fee lbl - ";
                break;

            case 'settings_recfee_dtl':
                    if($_POST['textNewParticular'] != ''){
                        /*CREATE NEW PARTICULAR*/
                        $this->db->replace('settings_particulars', array('name' => $_POST['textNewParticular'],));
                        $particular_id = $this->db->insert_id();
                    }else{
                        $particular_id = $_POST['selectParticular'];
                    }

                    $this->db->set('recfee_id', $_POST['textRecFeeId']);
                    $this->db->set('label_id', $_POST['textLabelId']);
                    $this->db->set('particular', $particular_id);
                    $this->db->set('charge_to', $_POST['selectChargeTo']);
                    $this->db->set('amount', $_POST['textAmount']);
                    $this->db->set('remarks', $_POST['textRemarks']);
                    $tbl_name = "settings_recfee_dtl";
                    $logs = "rec fee detail - ";
                break;

            case 'source':
                $this->db->set('desc', $this->input->post('textDesc', TRUE));
                $this->db->set('is_active', $this->input->post('textStatus', TRUE));
                $tbl_name = "settings_application_source";
                $logs = "application source - ";
                break;

            case 'agent':
                $this->db->set('fname', $this->input->post('textFname', TRUE));
                $this->db->set('mname', $this->input->post('textMname', TRUE));
                $this->db->set('lname', $this->input->post('textLname', TRUE));
                $this->db->set('email', $this->input->post('textEmail', TRUE));
                $this->db->set('mobile_no', $this->input->post('textMobile', TRUE));
                $this->db->set('address', $this->input->post('textAddress', TRUE));
                $this->db->set('remarks', $this->input->post('textRemarks', TRUE));
                $this->db->set('is_active', $this->input->post('textStatus', TRUE));
                $tbl_name = "settings_agent";
                $logs = "agent - ";
                break;

            case 'particulars':
                $this->db->set('name', $this->input->post('textName', TRUE));
                $tbl_name = "settings_particulars";
                $logs = "particulars - ";
                break;

            case 'travel_agent':
                $this->db->set('name', $this->input->post('textName', TRUE));
                $this->db->set('code', $this->input->post('textCode', TRUE));
                $this->db->set('address', $this->input->post('textAddress', TRUE));
                $this->db->set('contact_no', $this->input->post('textContactN', TRUE));
                $this->db->set('contact_person', $this->input->post('textContactP', TRUE));
                $tbl_name = "settings_travelagent";
                $logs = "travel agent - ";
                break;

            case 'airline':
                $this->db->set('name', $this->input->post('textName', TRUE));
                $this->db->set('code', $this->input->post('textCode', TRUE));
                $this->db->set('address', $this->input->post('textAddress', TRUE));
                $tbl_name = "settings_airline";
                $logs = "airline - ";
                break;

            case 'payment':
                $this->db->set('name', $this->input->post('textName', TRUE));
                $tbl_name = "settings_payment_method";
                $logs = "payment method - ";
                break;

            case 'insurance':
                $this->db->set('name', $this->input->post('textName', TRUE));
                $this->db->set('address', $this->input->post('textAddr', TRUE));
                $this->db->set('contact_person', $this->input->post('textContactPerson', TRUE));
                $this->db->set('contact_no', $this->input->post('textContactNo', TRUE));
                $this->db->set('status', $this->input->post('selectStat', TRUE));
                $tbl_name = "settings_insurance_provider";
                $logs = "insurance provider - ";
                break;

            case 'lending':
                $this->db->set('name', $this->input->post('textName', TRUE));
                $this->db->set('address', $this->input->post('textAddr', TRUE));
                $this->db->set('contact_person', $this->input->post('textContactPerson', TRUE));
                $this->db->set('contact_no', $this->input->post('textContactNo', TRUE));
                $this->db->set('status', $this->input->post('selectStat', TRUE));
                $tbl_name = "settings_lending_provider";
                $logs = "lending provider - ";
                break;

            case 'branch':
                $this->db->set('desc', $this->input->post('textName', TRUE));
                $this->db->set('is_active', $this->input->post('selectStat', TRUE));
                $tbl_name = "settings_branch";
                $logs = "branch - ";
                break;
        }

        if($this->input->post('textRecordId')){
            $this->db->set('edit_by', $_SESSION['rs_user']['username']);
            $this->db->set('edit_date', 'NOW()', FALSE);
            $this->db->where('id', $this->input->post('textRecordId'));

            $return_val = $this->db->update($tbl_name);
            $id = $this->input->post('textRecordId');
            $logs .= "id:{$id} edit";
            $this->session->set_flashdata('settings_notification', 'Record successfully updated.');
        }else{
            $this->db->set('add_by', $_SESSION['rs_user']['username']);
            $this->db->set('add_date', 'NOW()', FALSE);
            
            $return_val = $this->db->insert($tbl_name);
            $id = $this->db->insert_id();
            $logs .= "id:{$id} create";
            $this->session->set_flashdata('settings_notification', 'Record successfully created.');
        }

        if($return_val){
            $this->session->set_flashdata('settings_notification_status', 'Success');
            create_log('user', '', $_SESSION['rs_user']['username'], $tbl_name, $logs);
            return $id;
        }else{
            $this->session->set_flashdata('settings_notification_status', 'Error');
            $this->session->set_flashdata('settings_notification', 'Unable to create record.');
            return false;
        }
    }
    
    public function delete($tbl, $id){
        $this->db->trans_start();

        if($tbl == 'settings_users'){
            $this->db->where('id', $id);
            $q = $this->db->get($tbl);
            $log_info = "delete user - ".$q->row()->username; 
        }else if($tbl == 'manager_principal'){
            $this->db->where('id', $id);
            $q = $this->db->get($tbl);
            $log_info = "delete principal - ".$q->row()->code;

            /* DELETE CONTACTS */
            $this->db->where('principal_id', $id);
            $this->db->delete('manager_principal_contacts');

            /* DELETE MR */
            $this->db->where('principal_id', $id);
            $this->db->delete('manager_mr');

            /* DELETE JOB OPENINGS */
            $this->db->where('principal_id', $id);
            $this->db->delete('manager_jobs');
        }else if($tbl == 'manager_mr'){
            $this->db->where('id', $id);
            $q = $this->db->get($tbl);
            $log_info = "delete mr - ".$q->row()->code;

            /* DELETE JOB OPENINGS */
            $this->db->where('mr_id', $id);
            $this->db->delete('manager_jobs');
        }else if($tbl == 'manager_jobs'){
            $this->db->where('id', $id);
            $q = $this->db->get($tbl);
            $log_info = "delete jo - ".$q->row()->id;
            
            /* DELETE LINEUP */
            $this->db->where('mr_pos_id', $id);
            $this->db->delete('applicant_lineup');
        }else if($tbl == 'settings_position'){
            $this->db->where('id', $id);
            $q = $this->db->get($tbl);
            $log_info = "delete position - ".$q->row()->desc;

            /* DELETE JOB OPENINGS */
            $this->db->where('pos_id', $id);
            $this->db->delete('manager_jobs');
        }else if($tbl == 'manager_announcement'){
            $this->db->where('id', $id);
            $q = $this->db->get($tbl);
            $log_info = "delete announcement - ".$q->row()->title;
        }else if($tbl == 'settings_recfee_hdr'){
            $log_info = "recruitment fee guide";

            //delete rec fee set
            $this->db->where('recfee_id', $id);
            $this->db->delete('settings_recfee_label');

            //delete rec fee particulars
            $this->db->where('recfee_id', $id);
            $this->db->delete('settings_recfee_dtl');
        }else if($tbl == 'settings_recfee_label'){
            $this->db->where('id', $id);
            $q = $this->db->get($tbl);
            $log_info = "delete recruitment fee set - ".$q->row()->title;

            //delete rec fee particulars
            $this->db->where('label_id', $id);
            $this->db->delete('settings_recfee_dtl');
        }else if($tbl == 'settings_recfee_dtl'){
            $this->db->where('id', $id);
            $q = $this->db->get($tbl);
            $log_info = "recruitment fee particular";
        }else if($tbl == 'settings_application_source'){
            $log_info = "delete source id:{$id}";
        }else if($tbl == 'settings_agent'){
            $log_info = "delete agent id:{$id}";
        }else if($tbl == 'settings_travelagent'){
            $log_info = "delete travel agent id:{$id}";
        }else if($tbl == 'settings_airline'){
            $log_info = "delete airline id:{$id}";
        }else if($tbl == 'settings_payment_method'){
            $log_info = "delete payment method id:{$id}";
        }else if($tbl == 'settings_insurance_provider'){
            $log_info = "delete insurance provider id:{$id}";
        }else if($tbl == 'settings_lending_provider'){
            $log_info = "delete lending provider id:{$id}";
        }else if($tbl == 'settings_branch'){
            $log_info = "delete branch id:{$id}";
        }else{
            $log_info = "delete principal contact";
        }

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
    
    public function update_user_access(){
        $this->db->trans_start();
        $q = $this->db->get("settings_menu");
        foreach ($q->result() as $row){
            $current_users = explode(",",$row->user_id);
            if(isset($_POST['checkMenu'])){
                if(in_array($row->id, $_POST['checkMenu'])){
                    if(!in_array($_POST['textRecordId'], $current_users)){
                        /* ADD ACCESS */
                        $this->db->set('user_id', $row->user_id.",".$_POST['textRecordId'], TRUE);
                        $this->db->where('id', $row->id);
                        $this->db->update('settings_menu');
                    }
                }else{
                    if(in_array($_POST['textRecordId'], $current_users)){
                        /* REMOVE ACCESS */
                        $new_str = preg_replace('/\b,'.$_POST['textRecordId'].'\b/', '', $row->user_id);
                        $this->db->set('user_id', $new_str, TRUE);
                        $this->db->where('id', $row->id);
                        $this->db->update('settings_menu');
                    }
                }
            }else{
                if(in_array($_POST['textRecordId'], $current_users)){
                    /* REMOVE ACCESS */
                    $new_str = preg_replace('/\b,'.$_POST['textRecordId'].'\b/', '', $row->user_id);
                    $this->db->set('user_id', $new_str, TRUE);
                    $this->db->where('id', $row->id);
                    $this->db->update('settings_menu');
                }
            }
        }

        if($this->db->trans_complete()){
            create_log('user', '', $_SESSION['rs_user']['username'], 'user access - edit', 'user_id: '.$_POST['textRecordId']);
            $this->session->set_flashdata('settings_notification', 'User access successfully updated.');
            $this->session->set_flashdata('settings_notification_status', 'Success');
        }else{
            $this->session->set_flashdata('settings_notification', 'Unable to update user access.');
            $this->session->set_flashdata('settings_notification_status', 'Error');
        }
    }
}