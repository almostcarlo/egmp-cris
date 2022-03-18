<?php
class Operations_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();

            /* update timezone */
            dbsetdata("SET time_zone = '+8:00'");
        }

        public function delete($what, $id){
            switch ($what){
                case 'doclib_file':
                    $this->db->set('filename', '');
                    $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                    $this->db->set('edit_date', 'NOW()', FALSE);
                    $this->db->where(array('id'=>$id));
                    if($this->db->update('applicant_uploads')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'doc lib', 'delete file id:'.$id);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                    
                case 'doclib_record':
                    $this->db->where(array('id'=>$id));
                    if($this->db->delete('applicant_uploads')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'doc lib', 'delete record id:'.$id);
                        $return_val = 1;
                        $this->session->set_flashdata('settings_notification', 'Document has been deleted');
                        $this->session->set_flashdata('settings_notification_status', 'Success');
                    }else{
                        $return_val = 0;
                        $this->session->set_flashdata('settings_notification', 'Unable to delete document');
                        $this->session->set_flashdata('settings_notification_status', 'Error');
                    }
                    break;
            }
            return $return_val;
        }
        
        public function save_doclib($filename="", $desc=""){
            $this->db->trans_start();
            if($filename!=''){
                $this->db->set('filename', $filename);
            }

            $this->db->set('serial_no', $_POST['textSerialNo']);
            $this->db->set('issue_date', dateformat($_POST['textIssueDate'],0));
            $this->db->set('expiry_date', dateformat($_POST['textValidity'],0));
            $this->db->set('released_date', dateformat($_POST['textRelDate'],0));
            $this->db->set('released_by', $_POST['selectRelBy']);
            $this->db->set('is_auth', $_POST['selectAuth']);
            $this->db->set('is_201', $_POST['select201']);
            $this->db->set('remarks', $_POST['textRemarks']);

            if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                $this->db->set('edit_date', 'NOW()', FALSE);
                $this->db->where('id', $_POST['textRecordId']);
                $this->db->update('applicant_uploads');
                $action = "edit ".$desc;
            }else{
                $this->db->set('type_id', $_POST['textDocTypeID']);
                $this->db->set('description', $desc);
                $this->db->set('applicant_id', $_POST['textApplicant_id']);
                $this->db->set('add_by', $_POST['selectRecBy']);
                $this->db->set('add_date', dateformat($_POST['textRecDate'],0)." ".date("h:i:s"));
                $this->db->insert('applicant_uploads');
                $action = "add ".$desc;
            }
            
            if($this->db->trans_complete()){
                create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'doc lib', $action);
                $this->session->set_flashdata('settings_notification', $desc.' has been updated');
                $this->session->set_flashdata('settings_notification_status', 'Success');
            }else{
                $this->session->set_flashdata('settings_notification', 'Unable to upload file.');
                $this->session->set_flashdata('settings_notification_status', 'Error');
            }
        }
        
        public function status_changer(){
            $this->db->trans_start();
            
            /* IF DEPLOYED */
            if($_POST['selectDBStat'] == 'DEPLOYED'){
                $this->db->set('is_deployed', 'Y');
                $this->db->set('deployment_date', dateformat($_POST['inputDeployDate'],0));
                $this->db->set('contract_period', $_POST['selectContract']);
                
                if($_POST['selectContract'] != ''){
                    $this->db->set('contract_fin_date', date("Y-m-d", strtotime(dateformat($_POST['inputDeployDate'],0)." +{$_POST['selectContract']}")));
                }
            }

            /* IF RESERVED, DROP LINEUP */
            if($_POST['selectDBStat'] == 'RESERVED'){
                $this->db->set('is_dropped', 'Y');
                $this->db->set('dropped_date', 'NOW()', FALSE);
            }

            /* IF OPERATIONS */
            // if($_POST['selectDBStat'] == 'OPERATIONS' || (isset($_POST['textIsDropped']) && $_POST['textIsDropped'] == 'N')){
            if($_POST['selectDBStat'] == 'MOBILIZATION' || (isset($_POST['textIsDropped']) && $_POST['textIsDropped'] == 'N')){
                $this->db->set('is_dropped', 'N');
                $this->db->set('dropped_date', '0000-00-00 00:00:00');
            }

            $this->db->set('lineup_status', $_POST['selectStatus']);
            $this->db->set('lineup_acceptance', $_POST['selectAccept']);
            $this->db->set('select_date', dateformat($_POST['textSelectDate'],0));
            $this->db->set('approval_date', dateformat($_POST['textApproveDate'],0));
            ($this->input->post('selectBy'))?$this->db->set('selected_by', $this->input->post('selectBy')):$this->db->set('selected_by', '0');
            $this->db->set('contract_period', $_POST['selectContract']);
            
            if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                $this->db->set('edit_date', 'NOW()', FALSE);
                $this->db->where('id', $_POST['textRecordId']);
                $this->db->update('applicant_lineup');
                $log_info = "edit lineup mr_pos_id:{$_POST['SelectPosition']}";

                $lineup_id = $_POST['textRecordId'];
                
                /* EMPLOYMENT OFFER */
                $this->db->set('contract_period', $_POST['selectContract']);
                $this->db->set('salary_currency', $_POST['SelectSalCurr']);
                $this->db->set('salary_amount', $_POST['textSalAmt']);
                $this->db->set('salary_per', $_POST['SelectSalPer']);
                $this->db->set('food', $_POST['textFood']);
                $this->db->set('is_renewable', (isset($_POST['checkIsRenewable']))?"Y":"N");
                $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                $this->db->set('edit_date', 'NOW()', FALSE);
                $this->db->where('lineup_id', $lineup_id);
                $this->db->update('applicant_employment_offer');
            }else{
                /* INSERT */
                $this->db->set('applicant_id', $_POST['textApplicantId']);
                $this->db->set('manpower_id', $_POST['textMrId']);
                $this->db->set('mr_pos_id', $_POST['SelectPosition']);
                $this->db->set('add_by', $_SESSION['rs_user']['username']);
                $this->db->set('add_date', 'NOW()', FALSE);
                $this->db->insert('applicant_lineup');
                $log_info = "add lineup mr_pos_id:{$_POST['SelectPosition']}";
                
                $lineup_id = $this->db->insert_id();
                
                /* EMPLOYMENT OFFER */
                $this->db->set('lineup_id', $lineup_id);
                $this->db->set('applicant_id', $_POST['textApplicantId']);
                $this->db->set('contract_period', $_POST['selectContract']);
                $this->db->set('salary_currency', $_POST['SelectSalCurr']);
                $this->db->set('salary_amount', $_POST['textSalAmt']);
                $this->db->set('salary_per', $_POST['SelectSalPer']);
                $this->db->set('food', $_POST['textFood']);
                $this->db->set('is_renewable', (isset($_POST['checkIsRenewable']))?"Y":"N");
                $this->db->set('add_by', $_SESSION['rs_user']['username']);
                $this->db->set('add_date', 'NOW()', FALSE);
                $this->db->insert('applicant_employment_offer');
            }
            
            /* SELECTED/ACCEPTED: UPDATE GENERAL INFO STATUS */
            if($_POST['selectStatus'] == 'Selected' && $_POST['selectAccept'] == 'Accepted'){
                /* OPERATIONS */
                // if($_POST['selectDBStat'] == 'OPERATIONS'){
                //     $this->db->set('status', 'OPERATIONS');
                // }
                if($_POST['selectDBStat'] == 'MOBILIZATION'){
                    $this->db->set('status', 'MOBILIZATION');
                }
                
                /* DEPLOYED */
                if($_POST['selectDBStat'] == 'DEPLOYED'){
                    create_log('applicant_logs', $_POST['textApplicantId'], $_SESSION['rs_user']['username'], 'deployment', 'lineup_id:'.$lineup_id);
                    $this->db->set('status', 'DEPLOYED');
                }

                /* RESERVED */
                if($_POST['selectDBStat'] == 'RESERVED'){
                    $this->db->set('status', 'RESERVED');
                }

                $this->db->set('lineup_id', $lineup_id);
            }else{
                $this->db->set('status', $_POST['selectDBStat']);
                $this->db->set('lineup_id', 0);
            }
            
            $this->db->set('edit_by', $_SESSION['rs_user']['username']);
            $this->db->set('edit_date', 'NOW()', FALSE);
            $this->db->where('id', $_POST['textApplicantId']);
            $this->db->update('applicant_general_info');
            /* END UPDATE GENERAL INFO STATUS */
            
            if($this->db->trans_complete()){
                create_log('applicant_logs', $_POST['textApplicantId'], $_SESSION['rs_user']['username'], 'lineup-status changer', $log_info);
                $this->session->set_flashdata('settings_notification', 'Lineup has been updated');
                $this->session->set_flashdata('settings_notification_status', 'Success');
            }else{
                $this->session->set_flashdata('settings_notification', 'Unable to edit lineup');
                $this->session->set_flashdata('settings_notification_status', 'Error');
            }
        }

        public function no_lineup(){
            $this->db->set('lineup_id', 0);
            $this->db->set('status', $_POST['selectDBStat']);
            $this->db->set('edit_by', $_SESSION['rs_user']['username']);
            $this->db->set('edit_date', 'NOW()', FALSE);
            $this->db->where('id', $_POST['textApplicantId']);

            if($this->db->update('applicant_general_info')){
                create_log('applicant_logs', $_POST['textApplicantId'], $_SESSION['rs_user']['username'], 'status changer', $_POST['selectDBStat']);
                $this->session->set_flashdata('settings_notification', 'Applicant\'s status has been updated');
                $this->session->set_flashdata('settings_notification_status', 'Success');
            }else{
                $this->session->set_flashdata('settings_notification', 'Unable to transfer to DEADFILE');
                $this->session->set_flashdata('settings_notification_status', 'Error');
            }
        }
}
