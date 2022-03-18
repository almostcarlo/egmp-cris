<?php
class Processing_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();

            /* update timezone */
            dbsetdata("SET time_zone = '+8:00'");
        }
        
        public function save($what){
            $this->db->trans_start();
            
            switch($what){
                case 'visa':
                    $this->db->set('visa_no', $_POST['textVISANo']);
                    $this->db->set('sponsor_no', $_POST['textSponsorNo']);
                    $this->db->set('principal_id', $_POST['SelectPrincipal']);
                    $this->db->set('visa_date', dateformat($_POST['textVISADate'],0));
                    if($_POST['textArabDateYY']!='')$this->db->set('visa_date_arabic', $_POST['textArabDateYY']."-".$_POST['SelectArabDateMM']."-".$_POST['textArabDateDD']);
                    $this->db->set('expiry_date', dateformat($_POST['textExpDate'],0));
                    $this->db->set('closing_date', dateformat($_POST['textCloseDate'],0));
                    $this->db->set('remarks', $_POST['textRemarks']);
                    
                    $table_name = "manager_visa";
                    $desc = "VISA";
                    break;
                    
                case 'visa_pos':
                    $this->db->set('visa_id', $_POST['textVisaId']);
                    $this->db->set('position', strtoupper($_POST['textPos']));
                    $this->db->set('gender', $_POST['selectGender']);
                    $this->db->set('quantity', $_POST['textQty']);
                    $this->db->set('authority_no', $_POST['textAuthNo']);
                    $this->db->set('remarks', $_POST['textRemarks']);

                    $table_name = "manager_visa_pos";
                    $desc = "VISA Position";
                    break;
                    
                case 'poea':
                    $this->db->set('principal_id', $_POST['SelectPrincipal']);
                    $this->db->set('accre_no', $_POST['textAccreNo']);
                    $this->db->set('issue_date', dateformat($_POST['textIssueDate'],0));
                    $this->db->set('expiry_date', dateformat($_POST['textExpDate'],0));
                    $this->db->set('remarks', $_POST['textRemarks']);
                    
                    $table_name = "manager_poea";
                    $desc = "POEA Job Order";
                    break;
                    
                case 'poea_jo':
                    $this->db->set('poea_id', $_POST['textPOEAId']);
                    $this->db->set('jo_id', $_POST['textJOID']);
                    $this->db->set('jo_ref', $_POST['textJORef']);
                    $this->db->set('submit_date', dateformat($_POST['textSubmitDate'],0));
                    $this->db->set('approved_date', dateformat($_POST['textAppDate'],0));
                    $this->db->set('expiry_date', dateformat($_POST['textValidity'],0));
                    
                    $table_name = "manager_poea_jo";
                    $desc = "POEA Job Order";
                    break;
                    
                case 'jo_pos':
                    $this->db->set('jo_id', $_POST['textJOId']);
                    $this->db->set('position', strtoupper($_POST['textPos']));
                    $this->db->set('gender', $_POST['SelectGender']);
                    $this->db->set('quantity', $_POST['textQty']);
                    $this->db->set('employment_status', $_POST['SelectEmpStatus']);
                    $this->db->set('contract_period', $_POST['SelectContractPeriod']);
                    $this->db->set('hrs_work', $_POST['textHrsWork']);
                    $this->db->set('salary_currency', $_POST['SelectSalCurr']);
                    $this->db->set('salary_per', $_POST['SelectSalPer']);
                    $this->db->set('salary_amount', $_POST['textSalAmt']);
                    $this->db->set('accomodation', $_POST['textAccom']);
                    $this->db->set('transportation', $_POST['textTransport']);
                    $this->db->set('food', $_POST['textFood']);
                    $this->db->set('overtime', $_POST['textOT']);
                    $this->db->set('leave_provision', $_POST['textLeavePr']);
                    $this->db->set('leave_ent', $_POST['textLeaveEnt']);
                    $this->db->set('ticket_ent', $_POST['textTicket']);
                    $this->db->set('insurance', $_POST['textInsurance']);
                    $this->db->set('gratuity', $_POST['textGratuity']);
                    $this->db->set('bonus', $_POST['textBonus']);
                    $this->db->set('special_condition', $_POST['textSpCondition']);
					$this->db->set('remarks', $_POST['textRemarks']);
                    
                    $table_name = "manager_jo_pos";
                    $desc = "Job Order Category";
                    break;

                case 'lpt':
                case 'pta':
                    $this->db->set('principal_id', $_POST['SelectPrincipal']);
                    $this->db->set('company_id', $_POST['SelectCompany']);
                    $this->db->set('order_date', dateformat($_POST['textOrderDate'],0));
                    $this->db->set('confirmed_date', dateformat($_POST['textConfirmedDate'],0));
                    $this->db->set('ticket_no', $_POST['textTicketNo']);
                    $this->db->set('travel_agent_id', $_POST['SelectTrAgent']);
                    $this->db->set('route1', $_POST['textRoute1']);
                    $this->db->set('flight_date1', dateformat($_POST['textFDate1'],0));
                    $this->db->set('airline1', $_POST['SelectAirline1']);
                    $this->db->set('flight_no1', $_POST['textFlightNo1']);
                    $this->db->set('route2', $_POST['textRoute2']);
                    $this->db->set('flight_date2', dateformat($_POST['textFDate2'],0));
                    $this->db->set('airline2', $_POST['SelectAirline2']);
                    $this->db->set('flight_no2', $_POST['textFlightNo2']);
                    $this->db->set('route3', $_POST['textRoute3']);
                    $this->db->set('flight_date3', dateformat($_POST['textFDate3'],0));
                    $this->db->set('airline3', $_POST['SelectAirline3']);
                    $this->db->set('flight_no3', $_POST['textFlightNo3']);
                    $this->db->set('route4', $_POST['textRoute4']);
                    $this->db->set('flight_date4', dateformat($_POST['textFDate4'],0));
                    $this->db->set('airline4', $_POST['SelectAirline4']);
                    $this->db->set('flight_no4', $_POST['textFlightNo4']);
                    $this->db->set('signatory', $_POST['textSignatory']);
                    $this->db->set('sig_pos', $_POST['textSigPos']);
                    $this->db->set('noted_by', $_POST['textNotedBy']);
                    $this->db->set('not_pos', $_POST['textNotePos']);
                    $this->db->set('checked_by', $_POST['textCheckedBy']);
                    $this->db->set('chk_pos', $_POST['textChkPos']);
                    $this->db->set('remarks', $_POST['textRemarks']);
                    $table_name = "manager_".$what."_hdr";
                    $desc = strtoupper($what)." Manager";
                    break;

                case 'transmittal':
                    $this->db->set('visa_id', $_POST['textVisaId']);
                    $this->db->set('transmittal_no', $_POST['textTransNo']);
                    $this->db->set('transmittal_date', dateformat($_POST['textTransDate'],0));
                    $table_name = "manager_visa_transmittal";
                    $desc = "VISA Transmittal";
                    break;

                case 'trans_alloc':
                    $this->db->set('transmittal_no', $_POST['textTransNo']);
                    if(isset($_POST['ecode_'.$_POST['textRecordId']])) $this->db->set('transmittal_ecode', $_POST['ecode_'.$_POST['textRecordId']]);
                    $this->db->set('transmittal_submit_date', dateformat($_POST['textTransSubmit'],0));
                    $table_name = "applicant_processing";
                    $desc = "Transmittal Allocation";
                    break;

                case 'update_trans_alloc':
                    $this->db->set('transmittal_submit_date', dateformat($_POST['textTransSubmit'],0));
                    $this->db->set('transmittal_release_date', dateformat($_POST['textTransRel'],0));
                    $this->db->set('transmittal_ecode', $_POST['textEcode']);
                    $this->db->set('transmittal_auth', $_POST['textAuth']);
                    $table_name = "applicant_processing";
                    $desc = "Transmittal Allocation";
                    break;

                case 'booking_req':
                    $this->db->set('request_no', $_POST['textReqNo']);
                    $this->db->set('type', $_POST['textType']);
                    $this->db->set('principal_id', $_POST['selectPrincipal']);
                    $this->db->set('company_id', $_POST['selectCompany']);
                    $this->db->set('request_by', $_POST['textReqBy']);
                    $this->db->set('request_date', dateformat($_POST['textReqDate'],0));
                    $this->db->set('pr_book_date', dateformat($_POST['textPrDate'],0));

                    if($_POST['textType'] == 'LPT'){
                        $this->db->set('airline_id', $_POST['selectAirline']);
                        $this->db->set('route', $_POST['textRoute']);
                        $this->db->set('submit_date', dateformat($_POST['textSubDate'],0));
                    }else{
                        $this->db->set('to', $_POST['textTo']);
                        $this->db->set('subject', $_POST['textSubject']);
                        $this->db->set('message', $_POST['textMessage']);
                    }

                    $table_name = "manager_booking";
                    $desc = $_POST['textType']." Request";
                    break;

                case 'visa_nonksa':
                    if($_POST['textAppId'] <> ''){
                        $applicant_id = $_POST['textAppId'];
                    }else{
                        $app_info = explode("-", $_POST['selectApplicant']);
                        $applicant_id = trim($app_info[0]);

                        if(is_numeric($applicant_id)){
                            $app_record = getdata("select id from applicant_general_info where id = {$applicant_id}");

                            if(count($app_record) <= 0){
                                echo 404;
                                exit();
                            }
                        }else{
                            echo 404;
                            exit();
                        }
                    }

                    /*UPLOAD FILE*/
                    $file_path = "";
                    if($_FILES['textAttach']['name']<>''){
                        if(!$docs = upload_file('textAttach', "./uploads/applicant/{$applicant_id}/", "visa_entry_nonksa")){
                            echo 400;
                            exit();
                        }else{
                            $file_path = "./uploads/applicant/{$applicant_id}/".$docs['file_name'];
                        }
                    }

                    

                    $this->db->set('applicant_id', $applicant_id);
                    $this->db->set('visa_no', $_POST['textVisaNo']);
                    $this->db->set('status', $_POST['selectStatus']);
                    $this->db->set('principal_id', $_POST['selectEmployer']);
                    $this->db->set('country_id', $_POST['selectCountry']);
                    $this->db->set('visa_date', dateformat($_POST['textVisaDate'],0));
                    $this->db->set('visa_stamp', dateformat($_POST['textVisaStamp'],0));
                    $this->db->set('days_valid', $_POST['textDays']);
                    $this->db->set('expiry_date', dateformat($_POST['textExpiry'],0));
                    if($file_path<>'') $this->db->set('attachment', $file_path);

                    $table_name = "manager_visa_nonksa";
                    $desc = "VISA Entry (Non-KSA)";
                    break;

                case 'vfs_sched':
                    if($_POST['textAppId'] <> ''){
                        $applicant_id = $_POST['textAppId'];
                    }else{
                        $app_info = explode("-", $_POST['selectApplicant']);
                        $applicant_id = trim($app_info[0]);

                        if(is_numeric($applicant_id)){
                            $app_record = getdata("select id from applicant_general_info where id = {$applicant_id}");

                            if(count($app_record) <= 0){
                                echo 404;
                                exit();
                            }
                        }else{
                            echo 404;
                            exit();
                        }
                    }

                    $this->db->set('applicant_id', $applicant_id);
                    $this->db->set('proposed_sched', dateformat($_POST['textPropDate'],0));
                    $this->db->set('final_sched', dateformat($_POST['textFinalDate'],0));
                    $this->db->set('release_date', dateformat($_POST['textRelDate'],0));
                    $this->db->set('venue', $_POST['textVenue']);
                    $this->db->set('ref_no', $_POST['textRefNo']);

                    $table_name = "manager_vfs";
                    $desc = "VFS Schedule";
                    break;
            }

            if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                $this->db->set('edit_date', 'NOW()', FALSE);
                $this->db->where('id', $_POST['textRecordId']);
                $this->db->update($table_name);

                $action = $table_name." - edit";
                $id = $_POST['textRecordId'];
            }else{
                /*CODE HERE*/
                if($what == 'lpt' || $what == 'pta'){
                    $max = getMaxCount($table_name);
                    $lptpta_code = strtoupper($what).str_pad(($max+1), 4, 0, STR_PAD_LEFT);
                    $this->db->set('code', $lptpta_code);
                }

                $this->db->set('add_by', $_SESSION['rs_user']['username']);
                $this->db->set('add_date', 'NOW()', FALSE);
                $this->db->insert($table_name);

                $action = $table_name." - add";
                $id = $this->db->insert_id();
            }

            if($this->db->trans_complete()){
                create_log('user', '', $_SESSION['rs_user']['username'], $action, 'id#:'.$id);
                $this->session->set_flashdata('settings_notification', $desc.' has been updated');
                $this->session->set_flashdata('settings_notification_status', 'Success');
            }else{
                $this->session->set_flashdata('settings_notification', 'Unable to create record.');
                $this->session->set_flashdata('settings_notification_status', 'Error');
            }

            if($what == 'visa_pos' || $what == 'transmittal'){
                return $_POST['textVisaId'];
            }else if($what == 'poea_jo'){
                return $_POST['textPOEAId'];
            }else if($what == 'jo_pos'){
				return $_POST['textJOId'];
			}else{
                return $id;
            }
        }

        public function delete($what, $id){
            $this->db->trans_start();

            if($what== 'visa_pos'){
                $tbl = "manager_visa_pos";
                $log_info = $tbl." -  delete";
                $log_remarks = "id#:".$id;
                $notification = "VISA Position";
            }else if($what== 'visa'){
                $tbl = "manager_visa";
                $log_info = $tbl." -  delete";
                $log_remarks = "id#:".$id;
                $notification = "VISA";
                
                /* DELETE VISA POS */
                $this->db->where('visa_id', $id);
                $this->db->delete('manager_visa_pos');
                
                /* CLEAR VISA ALLOCATIONS */
                /* code here */
                
            }else if($what== 'poea_jo'){
                $tbl = "manager_poea_jo";
                $log_info = $tbl." -  delete";
                $log_remarks = "id#:".$id;
                $notification = "POEA Job Order";

				/*DELETE JO POS*/
				$this->db->where('jo_id', $id);
                $this->db->delete('manager_jo_pos');
            }else if($what== 'jo_pos'){
                $tbl = "manager_jo_pos";
                $log_info = $tbl." -  delete";
                $log_remarks = "id#:".$id;
                $notification = "Job Order Category";
            }else if($what== 'poea'){
                $tbl = "manager_poea";
                $log_info = $tbl." -  delete";
                $log_remarks = "id#:".$id;
                $notification = "POEA Accreditation";

                /*DELETE JO POS*/
                $this->db->select('id')->from('manager_poea_jo')->where('poea_id', $id);
                $subQuery =  $this->db->get_compiled_select();

                $this->db->where("jo_id IN ($subQuery)", NULL, FALSE);
                $this->db->delete('manager_jo_pos');

                /* DELETE JO */
                $this->db->where('poea_id', $id);
                $this->db->delete('manager_poea_jo');
                
                /* CLEAR POEA ALLOCATIONS */
                /* code here */
			}else if($what== 'transmittal'){
                $tbl = "manager_visa_transmittal";
                $log_info = $tbl." -  delete";
                $log_remarks = "id#:".$id;
                $notification = "VISA Transmittal";

                /*UPDATE PROCESS TBL, DELETE TRANS NO*/
            }else if($what == 'lpt_request'){
                $tbl = "manager_booking";
                $log_info = $tbl." -  delete";
                $log_remarks = "id#:".$id;
                $notification = "LPT Booking Request";

                //DELETE ALLOCATION

            }else if($what == 'booking_request'){
                /*APPLICANT'S BOOKING REQUEST*/
                $tbl = "applicant_booking";
                $log_info = $tbl." -  delete";
                $log_remarks = "id#:".$id;
                $notification = "Applicant's Booking Request";
            }else if($what == 'visa_nonksa'){
                /*VISA ENTRY - NONKSA*/
                $tbl = "manager_visa_nonksa";
                $log_info = $tbl." -  delete";
                $log_remarks = "id#:".$id;
                $notification = "VISA Entry (Non-KSA)";

                /*DELETE ATTACHMENT*/
                $file = getdata("select attachment from {$tbl} where id={$id}");
                if($file[0]['attachment']<>'') unlink($file[0]['attachment']);
                
            }else if($what == 'vfs_sched'){
                $tbl = "manager_vfs";
                $log_info = $tbl." -  delete";
                $log_remarks = "id#:".$id;
                $notification = "VFS Schedule";
            }
//             else if($tbl == 'manager_principal'){
//                 $this->db->where('id', $id);
//                 $q = $this->db->get($tbl);
//                 $log_info = "delete principal - ".$q->row()->code;
                
//                 /* DELETE CONTACTS */
//                 $this->db->where('principal_id', $id);
//                 $this->db->delete('manager_principal_contacts');
                
//                 /* DELETE MR */
//                 $this->db->where('principal_id', $id);
//                 $this->db->delete('manager_mr');
                
//                 /* DELETE JOB OPENINGS */
//                 $this->db->where('principal_id', $id);
//                 $this->db->delete('manager_jobs');
//             }else if($tbl == 'manager_mr'){
//                 $this->db->where('id', $id);
//                 $q = $this->db->get($tbl);
//                 $log_info = "delete mr - ".$q->row()->code;
                
//                 /* DELETE JOB OPENINGS */
//                 $this->db->where('mr_id', $id);
//                 $this->db->delete('manager_jobs');
//             }else if($tbl == 'manager_jobs'){
//                 $this->db->where('id', $id);
//                 $q = $this->db->get($tbl);
//                 $log_info = "delete jo - ".$q->row()->id;
                
//                 /* DELETE LINEUP */
//                 $this->db->where('mr_pos_id', $id);
//                 $this->db->delete('applicant_lineup');
//             }else if($tbl == 'settings_position'){
//                 $this->db->where('id', $id);
//                 $q = $this->db->get($tbl);
//                 $log_info = "delete position - ".$q->row()->desc;
                
//                 /* DELETE JOB OPENINGS */
//                 $this->db->where('pos_id', $id);
//                 $this->db->delete('manager_jobs');
//             }else if($tbl == 'manager_announcement'){
//                 $this->db->where('id', $id);
//                 $q = $this->db->get($tbl);
//                 $log_info = "delete announcement - ".$q->row()->title;
//             }else{
//                 $log_info = "delete principal contact";
//             }

            $this->db->where('id', $id);
            $this->db->delete($tbl);

            if($this->db->trans_complete()){
                create_log('user', '', $_SESSION['rs_user']['username'], $log_info, $log_remarks);
                $this->session->set_flashdata('settings_notification', $notification.' successfully deleted.');
                $this->session->set_flashdata('settings_notification_status', 'Success');
            }else{
                $this->session->set_flashdata('settings_notification', 'Unable to delete record.');
                $this->session->set_flashdata('settings_notification_status', 'Error');
            }
        }

        public function delete_file($what, $id, $ajax=FALSE){
            $this->db->trans_start();

            if($what == 'visa_nonksa_attachment'){
                /*VISA ENTRY ATTACHMENT*/
                $tbl = "manager_visa_nonksa";
                $log_info = $tbl." -  delete attachment";
                $log_remarks = "id#:".$id;
                $notification = "Attachment";

                $file = getdata("select * from {$tbl} where id={$id}");
                if($file[0]['attachment']<>'') unlink($file[0]['attachment']);

                $this->db->set('attachment', '');
            }

            $this->db->set('edit_by', $_SESSION['rs_user']['username']);
            $this->db->set('edit_date', 'NOW()', FALSE);
            $this->db->where('id', $id);
            $this->db->update($tbl);

            if($this->db->trans_complete()){
                create_log('user', '', $_SESSION['rs_user']['username'], $log_info, $log_remarks);

                if($ajax == TRUE){
                    return TRUE;
                }else{
                    $this->session->set_flashdata('settings_notification', $notification.' successfully deleted.');
                    $this->session->set_flashdata('settings_notification_status', 'Success');
                }
            }else{
                if($ajax == TRUE){
                    return FALSE;
                }else{
                    $this->session->set_flashdata('settings_notification', 'Unable to delete record.');
                    $this->session->set_flashdata('settings_notification_status', 'Error');
                }
            }
        }

        /* VISA MANAGER - ALLOCATE VISA TO APPLICANT */
        public function allocate_visa(){
            $this->db->trans_start();
            foreach($_POST['selected_app'] as $key => $applicant_id){
                $this->db->set('lineup_id', $_POST['lineup_ids'][$key]);
                $this->db->set('request_visa_id', $_POST['textVISAId']);
                $this->db->set('request_visa_cat', $_POST['textVISAPosId']);
                $this->db->set('request_approved_cat', $_POST['textVISAPosId']);
                $this->db->set('request_status', 'Accepted');
                $this->db->set('request_date', 'NOW()', FALSE);
                $this->db->set('request_updated', 'NOW()', FALSE);
                $this->db->set('request_by', $_SESSION['rs_user']['username']);

                if($_POST['processing_ids'][$key] == ''){
                    /* CREATE PROCESSING RECORD */
                    $this->db->set('applicant_id', $applicant_id);
                    $this->db->set('add_by', $_SESSION['rs_user']['username']);
                    $this->db->set('add_date', 'NOW()', FALSE);
                    $this->db->insert('applicant_processing');
                }else{
                    /* EDIT EXISTING RECORD */
                    $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                    $this->db->set('edit_date', 'NOW()', FALSE);
                    $this->db->where('id', $_POST['processing_ids'][$key]);
                    $this->db->update('applicant_processing');
                }

                /* LOG FILE */
                create_log('applicant_logs', $applicant_id, $_SESSION['rs_user']['username'], 'add visa allocation', '');
            }

            if($this->db->trans_complete()){
                $this->session->set_flashdata('settings_notification', 'VISA Allocation successfully updated.');
                $this->session->set_flashdata('settings_notification_status', 'Success');
            }else{
                $this->session->set_flashdata('settings_notification', 'Unable to update VISA Allocation.');
                $this->session->set_flashdata('settings_notification_status', 'Error');
            }
        }

        /* POEA MANAGER - ALLOCATE JO TO APPLICANT */
        public function allocate_jo(){
            $this->db->trans_start();
            foreach($_POST['selected_app'] as $key => $applicant_id){
                $this->db->set('lineup_id', $_POST['lineup_ids'][$key]);
                $this->db->set('poea_req_date', 'NOW()', FALSE);
                $this->db->set('poea_req_by', $_SESSION['rs_user']['username']);
                $this->db->set('poea_sent_date', 'NOW()', FALSE);
                $this->db->set('poea_approve_date', 'NOW()', FALSE);
                $this->db->set('poea_request_id', $_POST['textJOId']);
                $this->db->set('poea_request_cat', $_POST['textJOPosId']);
                $this->db->set('poea_approved_id', $_POST['textJOId']);
                $this->db->set('poea_approved_cat', $_POST['textJOPosId']);
                $this->db->set('poea_edit_date', 'NOW()', FALSE);
                $this->db->set('poea_edit_by', $_SESSION['rs_user']['username']);

                if($_POST['processing_ids'][$key] == ''){
                    /* CREATE PROCESSING RECORD */
                    $this->db->set('applicant_id', $applicant_id);
                    $this->db->set('add_by', $_SESSION['rs_user']['username']);
                    $this->db->set('add_date', 'NOW()', FALSE);
                    $this->db->insert('applicant_processing');
                }else{
                    /* EDIT EXISTING RECORD */
                    $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                    $this->db->set('edit_date', 'NOW()', FALSE);
                    $this->db->where('id', $_POST['processing_ids'][$key]);
                    $this->db->update('applicant_processing');
                }

                /* LOG FILE */
                create_log('applicant_logs', $applicant_id, $_SESSION['rs_user']['username'], 'add jo allocation', '');
            }

            if($this->db->trans_complete()){
                $this->session->set_flashdata('settings_notification', 'JO Allocation successfully updated.');
                $this->session->set_flashdata('settings_notification_status', 'Success');
            }else{
                $this->session->set_flashdata('settings_notification', 'Unable to update JO Allocation.');
                $this->session->set_flashdata('settings_notification_status', 'Error');
            }
        }
}