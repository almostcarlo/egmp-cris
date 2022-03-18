<?php
class Applicant_model extends CI_Model {

        public function __construct()
        {
            $this->load->database();

            /* update timezone */
            dbsetdata("SET time_zone = '+8:00'");
        }

        public function create_applicant()
        {
            /*PREVENT CREATING DUPLICATE RECORD IF REFRESHED HALFWAY THRU PROCESSING*/
            $q = getdata("select id from applicant_general_info where email = '{$this->input->post('textEmail', TRUE)}'");
            if($q){
                redirect('profile/'.$q[0]['id'], 'refresh');
            }

            $this->db->trans_start();

            /* GENERAL INFO */
            $this->db->set('fname', $this->input->post('textFirstName', TRUE));
            $this->db->set('mname', $this->input->post('textMiddleName', TRUE));
            $this->db->set('lname', $this->input->post('textLastName', TRUE));
            $this->db->set('email', $this->input->post('textEmail', TRUE));
            // $this->db->set('password', 'PASSWORD("'.EMAIL_VALIDATION_PASSWORD_DEFAULT.'")', FALSE);
            $password = password_hash(EMAIL_VALIDATION_PASSWORD_DEFAULT, PASSWORD_DEFAULT);
            $this->db->set('password', $password);
            $this->db->set('status', 'ON POOL');
            $this->db->set('birthdate', date("Y-m-d", strtotime($this->input->post('inputBirthDate'))));
            $this->db->set('gender', $this->input->post('selectGender', TRUE));
            $this->db->set('mobile_no', $this->input->post('textContactNumber', TRUE));
            $this->db->set('landline_no', $this->input->post('textLandNumber', TRUE));
            $this->db->set('civil_stat', $this->input->post('selectCivilStatus', TRUE));
            $this->db->set('nationality', $this->input->post('selectNationality', TRUE));
            $this->db->set('address', $this->input->post('textAddr', TRUE));
            $this->db->set('address_city_id', $this->input->post('selectCity', TRUE));
            $this->db->set('address_region_id', $this->input->post('selectRegion', TRUE));
            $this->db->set('address_brgy_id', $this->input->post('selectBrgy', TRUE));
            $this->db->set('address_province_id', $this->input->post('selectProvince', TRUE));
            $this->db->set('application_method', $this->input->post('selectMethod', TRUE));
            $this->db->set('application_source', $this->input->post('selectSource', TRUE));
            ($this->input->post('selectAgent'))?$this->db->set('agent_id', $this->input->post('selectAgent')):$this->db->set('agent_id', '0');
            ($this->input->post('checkNoEmployment')==TRUE)?$this->db->set('is_freshgrad', 'Y'):$this->db->set('is_freshgrad', 'N');
            $this->db->set('branch_id', $this->input->post('selectBranch', TRUE));
            $this->db->set('near_branch_id', $this->input->post('selectBranchN', TRUE));
            $this->db->set('add_by', $_SESSION['rs_user']['username']);
            $this->db->set('add_date', 'NOW()', FALSE);
            $this->db->insert('applicant_general_info');

            $applicant_id = $this->db->insert_id();
            
            /* APPLIED POSITION */
            if($_POST['textAppliedCat'][0] || $_POST['textAppliedCat'][1]){
                $applied_pos = implode('|', $_POST['textAppliedCat']);
                $this->db->set('applicant_id', $applicant_id);
                $this->db->set('position', $applied_pos);
                $this->db->set('add_by', $_SESSION['rs_user']['username']);
                $this->db->set('add_date', 'NOW()', FALSE);
                $this->db->insert('applicant_applied_pos');
            }
            
            /* EDUCATION */
            if($this->input->post('selectEducation')!='' && $this->input->post('textEducation')!=''){
                $this->db->set('applicant_id', $applicant_id);
                $this->db->set('school_name', $this->input->post('textSchool', TRUE));
                $this->db->set('level_id', $this->input->post('selectEducation', TRUE));
                $this->db->set('course', $this->input->post('textEducation', TRUE));
                $this->db->set('start_date', date("Y-m-d", strtotime($this->input->post('inputEducFrom'))));
                $this->db->set('end_date', date("Y-m-d", strtotime($this->input->post('inputEducTo'))));
                $this->db->set('add_by', $_SESSION['rs_user']['username']);
                $this->db->set('add_date', 'NOW()', FALSE);
                $this->db->insert('applicant_education');
            }
            
            /* WORK */
            if($this->input->post('textWorkEmployer')!='' && $this->input->post('textWorkPosition')!=''){
                $this->db->set('applicant_id', $applicant_id);
                $this->db->set('company_name', $this->input->post('textWorkEmployer', TRUE));
                $this->db->set('position', $this->input->post('textWorkPosition', TRUE));
                $this->db->set('country_id', $this->input->post('selectWorkCountry', TRUE));
                $this->db->set('start_date', date("Y-m-d", strtotime($this->input->post('inputEmploymentFrom'))));
                if($this->input->post('inputEmploymentTo')!=''){$this->db->set('end_date', date("Y-m-d", strtotime($this->input->post('inputEmploymentTo'))));}
                $this->db->set('add_by', $_SESSION['rs_user']['username']);
                $this->db->set('add_date', 'NOW()', FALSE);
                $this->db->insert('applicant_work_history');
            }
            
            /* TRAINING */
            if($this->input->post('textTraining')!=''){
                $this->db->set('applicant_id', $applicant_id);
                $this->db->set('training_desc', $this->input->post('textTraining', TRUE));
                $this->db->set('training_center', $this->input->post('textTrainingCenter', TRUE));
                $this->db->set('country_id', $this->input->post('selectTrainingCountry', TRUE));
                $this->db->set('start_date', date("Y-m-d", strtotime($this->input->post('textTrainingFrom'))));
                $this->db->set('end_date', date("Y-m-d", strtotime($this->input->post('textTrainingTo'))));
                $this->db->set('add_by', $_SESSION['rs_user']['username']);
                $this->db->set('add_date', 'NOW()', FALSE);
                $this->db->insert('applicant_training');
            }
            
            /* SKILLS */
            if($this->input->post('textSkills')!=''){
                $this->db->set('applicant_id', $applicant_id);
                $this->db->set('skills', $this->input->post('textSkills', TRUE));
                $this->db->set('add_by', $_SESSION['rs_user']['username']);
                $this->db->set('add_date', 'NOW()', FALSE);
                $this->db->insert('applicant_skills');
            }
            
            if($this->db->trans_complete()){
                create_log('applicant_logs', $applicant_id, $_SESSION['rs_user']['username'], 'create', '');
                return $applicant_id;
            }else{
                return 0;
            }
        }
        
        public function validate_email($id){
            $this->db->set('is_valid_email', 'Y');
            $this->db->where('id', $id);
            if($this->db->update('applicant_general_info')){
                create_log('applicant_logs', $id, 'validate', 'email validation');
                return 1;
            }else{
                return 0;
            }
        }

        public function auth(){
    	    $this->db->where('email', $_POST['textSignInEmail']);
    	    // $this->db->where('password', 'PASSWORD("'.$this->input->post('textSignInPassword', TRUE).'")', FALSE);
    	    $q=$this->db->get('applicant_general_info');
    	    if($q->num_rows() > 0){
                $password = trim($_POST['textSignInPassword']);
                if(password_verify($password, $q->row('password'))){
                    return $q->row();
                }else{
                    return 0;
                }
    	    }else{
    	        return 0;
    	    }
        }
        
        public function get_applicant_data($id){
            /* PERSONAL INFO */
            $this->db->select('applicant_general_info.id, applicant_general_info.email, applicant_general_info.is_valid_email, applicant_general_info.skype, applicant_general_info.fname, applicant_general_info.mname, applicant_general_info.lname,
                                applicant_general_info.birthdate,applicant_general_info.birthplace,applicant_general_info.gender, applicant_general_info.mobile_no, applicant_general_info.landline_no,applicant_general_info.civil_stat,
                                applicant_general_info.address, settings_brgy.name as brgy, settings_city.name as city, settings_province.name as province, settings_region.name as region, settings_nationality.name as nationality, settings_application_source.desc as application_source,
                                settings_application_method.desc as application_method, applicant_general_info.religion, applicant_general_info.add_date, applicant_general_info.last_reporting_date,
                                applicant_general_info.nationality as nationality_id, applicant_general_info.address_city_id, applicant_general_info.address_province_id, applicant_general_info.address_region_id, applicant_general_info.address_brgy_id, applicant_general_info.application_source as application_source_id,
                                applicant_general_info.application_method as application_method_id, applicant_general_info.status, applicant_general_info.lineup_id, applicant_general_info.height, applicant_general_info.weight, applicant_general_info.agent_id, settings_agent.fname as agent_fname, settings_agent.mname as agent_mname, settings_agent.lname as agent_lname, applicant_general_info.is_freshgrad, applicant_sms_subscription.token as sms_token, applicant_sms_subscription.mobile_no as sms_mobile_no, applicant_general_info.branch_id, applicant_general_info.near_branch_id');
            $this->db->from('applicant_general_info');
            $this->db->join('settings_nationality', 'settings_nationality.id = applicant_general_info.nationality', 'left');
            $this->db->join('settings_brgy', 'settings_brgy.id = applicant_general_info.address_brgy_id', 'left');
            $this->db->join('settings_city', 'settings_city.id = applicant_general_info.address_city_id', 'left');
            $this->db->join('settings_province', 'settings_province.id = applicant_general_info.address_province_id', 'left');
            $this->db->join('settings_region', 'settings_region.id = applicant_general_info.address_region_id', 'left');
            $this->db->join('settings_application_source', 'settings_application_source.id = applicant_general_info.application_source', 'left');
            $this->db->join('settings_application_method', 'settings_application_method.id = applicant_general_info.application_method', 'left');
            $this->db->join('settings_agent', 'settings_agent.id = applicant_general_info.agent_id', 'left');
            $this->db->join('applicant_sms_subscription', 'applicant_sms_subscription.applicant_id = applicant_general_info.id', 'left');
            $this->db->where('applicant_general_info.id', $id);
            $q = $this->db->get();

            if(!$q->row()){
                return false;
            }
            
            /* EDUCATION */
            $this->db->select('applicant_education.id, applicant_education.school_name, applicant_education.course, applicant_education.start_date, applicant_education.end_date, applicant_education.location, settings_educ_level.desc as educ_level, applicant_education.graduated');
            $this->db->from('applicant_education');
            $this->db->join('settings_educ_level', 'settings_educ_level.id = applicant_education.level_id', 'left');
            $this->db->where('applicant_education.applicant_id', $id);
            $this->db->order_by("start_date", "desc");
            $q_educ = $this->db->get('');

            /* WORK */
            $this->db->select('applicant_work_history.id, applicant_work_history.company_name, applicant_work_history.position, applicant_work_history.start_date, applicant_work_history.end_date, applicant_work_history.job_desc, applicant_work_history.reason_for_leaving, applicant_work_history.address, settings_country.name as country');
            $this->db->from('applicant_work_history');
            $this->db->join('settings_country', 'settings_country.id = applicant_work_history.country_id', 'left');
            $this->db->where('applicant_work_history.applicant_id', $id);
            $this->db->order_by("start_date", "desc");
            $q_work = $this->db->get();
            
            /* TRAINING */
            $this->db->select('applicant_training.id, applicant_training.training_desc, applicant_training.training_center, applicant_training.start_date, applicant_training.end_date, settings_country.name as country');
            $this->db->from('applicant_training');
            $this->db->join('settings_country', 'settings_country.id = applicant_training.country_id', 'left');
            $this->db->where('applicant_training.applicant_id', $id);
            $this->db->order_by("end_date", "desc");
            $q_training= $this->db->get();
            
            /* SKILLS */
            $this->db->where('applicant_id', $id);
            $q_skills= $this->db->get('applicant_skills');

            /* PROFILE PIC */
            $this->db->where('applicant_id', $id);
            // $this->db->where('description', 'iprs picture');
            $this->db->where('type_id', '22');
            $q_uploads = $this->db->get('applicant_uploads');
            
            /* PROFILE PIC - PORTAL */
            $this->db->where('applicant_id', $id);
            // $this->db->where('description', 'profile picture');
            $this->db->where('type_id', '35');
            $q_uploads_web = $this->db->get('applicant_uploads');
            
            /* CV */
            $this->db->where('applicant_id', $id);
            $this->db->where('description', 'Resume/CV');
            $q_uploads_cv = $this->db->get('applicant_uploads');
            
            /* ASSESSMENT */
            $this->db->where('applicant_id', $id);
            $this->db->order_by("add_date", "desc");
            $q_assess = $this->db->get('applicant_assessment');

            /*JAPANESE PROFILE*/
            $this->db->where('applicant_id', $id);
            $q_jap = $this->db->get('applicant_profile_jap');

            return array('personal'=>$q->row(),
                        'education'=>$q_educ->result_array(),
                        'work'=>$q_work->result_array(),
                        'training'=>$q_training->result_array(),
                        'skills'=>$q_skills->row(),
                        'profile_picture'=>$q_uploads->row(),
                        'profile_picture_web'=>$q_uploads_web->row(),
                        'profile_cv'=>$q_uploads_cv->row(),
                        'assessment'=>$q_assess->result_array(),
                        'jap_profile'=>$q_jap->result_array(),
            );
        }
        
        public function edit_profile($tab){
            $return_val = 0;
            switch($tab){
                case 'accounts':
                    // $this->db->set('password', 'PASSWORD("'.$this->input->post('textNewPassword', TRUE).'")', FALSE);
                    $password = password_hash(trim($this->input->post('textNewPassword', TRUE)), PASSWORD_DEFAULT);
                    $this->db->set('password', $password);
                    $this->db->set('edit_by', 'applicant');
                    $this->db->set('edit_date', 'NOW()', FALSE);
                    $this->db->where('id', $_SESSION['applicant']['id']);
                    
                    if($this->db->update('applicant_general_info')){
                        create_log('applicant_logs', $_SESSION['applicant']['id'], 'update', 'change password');
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                case 'personal':
                    $this->db->set('fname', $this->input->post('textFirstName', TRUE));
                    $this->db->set('mname', $this->input->post('textMiddleName', TRUE));
                    $this->db->set('lname', $this->input->post('textLastName', TRUE));
                    $this->db->set('birthdate', date("Y-m-d", strtotime($this->input->post('inputBirthDate'))));
                    $this->db->set('gender', $this->input->post('selectGender', TRUE));
                    $this->db->set('height', $this->input->post('textHeight', TRUE));
                    $this->db->set('weight', $this->input->post('textWeight', TRUE));
                    $this->db->set('religion', $this->input->post('selectReligion', TRUE));
                    $this->db->set('mobile_no', $this->input->post('textContactNumber', TRUE));
                    $this->db->set('landline_no', $this->input->post('textTelNum', TRUE));
                    $this->db->set('skype', $this->input->post('textSkype', TRUE));
                    $this->db->set('civil_stat', $this->input->post('selectCivilStatus', TRUE));
                    $this->db->set('nationality', $this->input->post('selectNationality', TRUE));
                    $this->db->set('address', $this->input->post('textStreet', TRUE));
                    $this->db->set('address_brgy_id', $this->input->post('selectBrgy', TRUE));
                    $this->db->set('address_city_id', $this->input->post('selectCity', TRUE));
                    $this->db->set('address_province_id', $this->input->post('selectProvince', TRUE));
                    $this->db->set('address_region_id', $this->input->post('selectRegion', TRUE));
                    $this->db->set('application_source', $this->input->post('selectSource', TRUE));
                    $this->db->set('application_method', $this->input->post('selectMethod', TRUE));
                    ($this->input->post('selectAgent') && $this->input->post('selectSource')=='999')?$this->db->set('agent_id', $this->input->post('selectAgent')):$this->db->set('agent_id', '0');
                    $this->db->set('branch_id', $this->input->post('selectBranch', TRUE));
                    $this->db->set('near_branch_id', $this->input->post('selectBranchN', TRUE));
                    $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                    $this->db->set('edit_date', 'NOW()', FALSE);
                    $this->db->where('id', $this->input->post('textApplicant_id', TRUE));

                    if($this->db->update('applicant_general_info')){
//                         echo $this->db->last_query();
//                         exit();
                        create_log('applicant_logs', $this->input->post('textApplicant_id', TRUE), $_SESSION['rs_user']['username'], 'update', 'edit general info');
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                    
                case 'skills':
                    //$ql = $this->db->select('id')->from('applicant_skills')->where('applicant_id',$_SESSION['applicant']['id'])->get();
                    
                    if($_POST['hSkillsId'] != '' && $_POST['hSkillsId'] > 0){
                        /* UPDATE */
                        $this->db->set('skills', $_POST['textSkills']);
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['hSkillsId']);

                        if($this->db->update('applicant_skills')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'update', 'edit skills info');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    } else {
                        /* INSERT */
                        $this->db->set('skills', $_POST['textSkills']);
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);

                        if($this->db->insert('applicant_skills')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'add', 'add skills info');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }
                    break;
                    
                case 'training':
                    $this->db->trans_start();
                    if($_POST['hTrainingId'] != '' && $_POST['hTrainingId'] > 0){
                        /* UPDATE */
                        $this->db->set('training_desc', $_POST['textTrainingTitle']);
                        $this->db->set('training_center', $_POST['textTrainingCenter']);
                        $this->db->set('country_id', $_POST['selectCountry']);
                        $this->db->set('start_date', dateformat($_POST['inputTrainingFrom'], 0));
                        $this->db->set('end_date', dateformat($_POST['inputTrainingTo'], 0));
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['hTrainingId']);
                        $this->db->update('applicant_training');
                    }else{
                        /* INSERT */
                        $this->db->set('training_desc', $_POST['textTrainingTitle']);
                        $this->db->set('training_center', $_POST['textTrainingCenter']);
                        $this->db->set('country_id', $_POST['selectCountry']);
                        $this->db->set('start_date', dateformat($_POST['inputTrainingFrom'], 0));
                        $this->db->set('end_date', dateformat($_POST['inputTrainingTo'], 0));
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('add_by', 'applicant');
                        $this->db->set('add_date', 'NOW()', FALSE);
                        $this->db->insert('applicant_training');
                    }
                    
                    if($this->db->trans_complete()){
                        create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'update', 'edit training info');
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                    
                case 'work':
                    

                    if($_POST['checkNoEmployment']){
                        /*FRESH GRAD*/
                        $this->db->set('is_freshgrad', 'Y');
                        $this->db->where('id', $_POST['textApplicant_id']);
                        $this->db->update('applicant_general_info');

                        create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'update', 'is_freshgrad');
                    }else{
                        $this->db->trans_start();
                        if($_POST['hEmpId'] != '' && $_POST['hEmpId'] > 0){
                            /* UPDATE */
                            $this->db->set('company_name', $_POST['textWorkEmployer']);
                            $this->db->set('position', $_POST['textWorkPosition']);
                            $this->db->set('job_desc', $_POST['textJobDesc']);
                            $this->db->set('reason_for_leaving', $_POST['textReason']);
                            $this->db->set('address', $_POST['textAddr']);
                            $this->db->set('country_id', $_POST['selectCountry']);
                            $this->db->set('salary', $_POST['textSalary']);
                            $this->db->set('start_date', dateformat($_POST['inputEmploymentFrom'], 0));
                            $this->db->set('end_date', dateformat($_POST['inputEmploymentTo'], 0));
                            $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                            $this->db->set('edit_date', 'NOW()', FALSE);
                            $this->db->where('id', $_POST['hEmpId']);
                            $this->db->update('applicant_work_history');
                        }else{
                            /* INSERT */
                            $this->db->set('company_name', $_POST['textWorkEmployer']);
                            $this->db->set('position', $_POST['textWorkPosition']);
                            $this->db->set('job_desc', $_POST['textJobDesc']);
                            $this->db->set('reason_for_leaving', $_POST['textReason']);
                            $this->db->set('address', $_POST['textAddr']);
                            $this->db->set('country_id', $_POST['selectCountry']);
                            $this->db->set('salary', $_POST['textSalary']);
                            $this->db->set('start_date', dateformat($_POST['inputEmploymentFrom'], 0));
                            $this->db->set('end_date', dateformat($_POST['inputEmploymentTo'], 0));
                            $this->db->set('applicant_id', $_POST['textApplicant_id']);
                            $this->db->set('add_by', $_SESSION['rs_user']['username']);
                            $this->db->set('add_date', 'NOW()', FALSE);
                            $this->db->insert('applicant_work_history');
                        }

                        /*NOT FRESH GRAD*/
                        $this->db->set('is_freshgrad', 'N');
                        $this->db->where('id', $_POST['textApplicant_id']);
                        $this->db->update('applicant_general_info');

                        if($this->db->trans_complete()){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'update', 'edit work history info');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }

                    break;
                    
                case 'education':
                    $this->db->trans_start();

                    if($_POST['hEducId'] != '' && $_POST['hEducId'] > 0){
                        /* UPDATE */
                        $this->db->set('school_name', $_POST['textSchool']);
                        $this->db->set('location', $_POST['textLoc']);
                        $this->db->set('course', $_POST['textCourse']);
                        $this->db->set('level_id', $_POST['selectEducation']);
                        $this->db->set('start_date', dateformat($_POST['inputEducFrom'], 0));
                        $this->db->set('end_date', dateformat($_POST['inputEducTo'], 0));
                        $this->db->set('graduated', $_POST['selectGraduated']);
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['hEducId']);
                        $this->db->update('applicant_education');
                    }else{
                        /* INSERT */
                        $this->db->set('school_name', $_POST['textSchool']);
                        $this->db->set('location', $_POST['textLoc']);
                        $this->db->set('course', $_POST['textCourse']);
                        $this->db->set('level_id', $_POST['selectEducation']);
                        $this->db->set('start_date', dateformat($_POST['inputEducFrom'], 0));
                        $this->db->set('end_date', dateformat($_POST['inputEducTo'], 0));
                        $this->db->set('graduated', $_POST['selectGraduated']);
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);
                        $this->db->insert('applicant_education');
                    }
                    
                    if($this->db->trans_complete()){
                        create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'update', 'edit education info');
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    
                    break;
                    
                case 'reference':
                    $this->db->trans_start();
                    
                    if($_POST['hRefId'] != '' && $_POST['hRefId'] > 0){
                        /* UPDATE */
                        $this->db->set('name', $_POST['textName']);
                        $this->db->set('employer', $_POST['textEmployer']);
                        $this->db->set('position', $_POST['textPosition']);
                        $this->db->set('contact_no', $_POST['textContactNo']);
                        $this->db->set('email', $_POST['textEmail']);
                        $this->db->set('relationship', $_POST['textRelationship']);
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['hRefId']);
                        $this->db->update('applicant_char_ref');
                    }else{
                        /* INSERT */
                        $this->db->set('name', $_POST['textName']);
                        $this->db->set('employer', $_POST['textEmployer']);
                        $this->db->set('position', $_POST['textPosition']);
                        $this->db->set('contact_no', $_POST['textContactNo']);
                        $this->db->set('email', $_POST['textEmail']);
                        $this->db->set('relationship', $_POST['textRelationship']);
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);
                        $this->db->insert('applicant_char_ref');
                    }
                    
                    if($this->db->trans_complete()){
                        create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'update', 'edit reference info');
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    
                    break;
                    
                /* APPLIED POSITION */
                case 'position':
                    $applied_pos = implode('|', $_POST['textAppliedCat']);
                    $this->db->trans_start();
                    
                    if($_POST['hRecId'] != '' && $_POST['hRecId'] > 0){
                        /* UPDATE */
                        $this->db->set('position', $applied_pos);
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['hRecId']);
                        $this->db->update('applicant_applied_pos');
                    }else{
                        /* INSERT */
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('position', $applied_pos);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);
                        $this->db->insert('applicant_applied_pos');
                    }
                    
                    
                    if($this->db->trans_complete()){
                        create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'update', 'applied position');
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                    
                case 'lineup':
                    $this->db->trans_start();
                    if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                        /* UPDATE */
                        if($_POST['selectAppStatus'] == 'DEPLOYED'){
                            $this->db->set('is_deployed', 'Y');
                            $this->db->set('deployment_date', dateformat($_POST['inputDeployDate'],0));
                            $this->db->set('contract_period', $_POST['selectContractPeriod']);
                            
                            if($_POST['selectContractPeriod'] != ''){
                                $this->db->set('contract_fin_date', date("Y-m-d", strtotime(dateformat($_POST['inputDeployDate'],0)." +{$_POST['selectContractPeriod']}")));
                            }
                        }

                        $this->db->set('lineup_status', $_POST['selectIntStatus']);
                        $this->db->set('lineup_acceptance', $_POST['selectAcceptance']);
                        $this->db->set('select_date', dateformat($_POST['inputSelectDate'],0));
                        $this->db->set('approval_date', dateformat($_POST['inputApproveDate'],0));
                        $this->db->set('remarks', $this->input->post('textRemarks', TRUE));
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textRecordId']);
                        $this->db->update('applicant_lineup');
                        $log_info = "edit lineup mr_pos_id:{$_POST['SelectPosition']}";
                        
                        /* UPDATE GENERAL INFO STATUS */
                        if($_POST['selectAppStatus'] == 'DEPLOYED'){
                            $this->db->set('status', 'DEPLOYED');
                            $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                            $this->db->set('edit_date', 'NOW()', FALSE);
                            $this->db->where('id', $_POST['textApplicantId']);
                            $this->db->update('applicant_general_info');
                            
                            create_log('applicant_logs', $_POST['textApplicantId'], $_SESSION['rs_user']['username'], 'deployment', 'lineup_id:'.$_POST['textRecordId']);
                        }
                        
                        $lineup_id = $_POST['textRecordId'];
                    }else{
                        /* INSERT */
                        $this->db->set('applicant_id', $_POST['textApplicantId']);
                        $this->db->set('manpower_id', $_POST['textMrId']);
                        $this->db->set('mr_pos_id', $_POST['SelectPosition']);
                        $this->db->set('lineup_status', $_POST['selectIntStatus']);
                        $this->db->set('lineup_acceptance', $_POST['selectAcceptance']);
                        $this->db->set('select_date', dateformat($_POST['inputSelectDate'],0));
                        $this->db->set('approval_date', dateformat($_POST['inputApproveDate'],0));
                        $this->db->set('remarks', $this->input->post('textRemarks', TRUE));
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);
                        $this->db->insert('applicant_lineup');
                        $log_info = "add lineup mr_pos_id:{$_POST['SelectPosition']}";

                        $lineup_id = $this->db->insert_id();
                    }
                    
                    /* SELECTED/ACCEPTED: UPDATE GENERAL INFO STATUS */
                    if($_POST['selectIntStatus'] == 'Selected' && $_POST['selectAcceptance'] == 'Accepted'){
                        $this->db->set('status', 'OPERATIONS');
                        $this->db->set('lineup_id', $lineup_id);
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textApplicantId']);
                        $this->db->update('applicant_general_info');
                    }

                    if($this->db->trans_complete()){
                        create_log('applicant_logs', $_POST['textApplicantId'], $_SESSION['rs_user']['username'], 'lineup', $log_info);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                    
                case 'assessment':
                    $this->db->trans_start();
                    if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                        /* UPDATE */
                        $this->db->set('details', $_POST['textDetails']);
                        $this->db->set('position', $_POST['inputRecPos']);
                        $this->db->set('nature_id', $_POST['selectNatureProjExp']);
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textRecordId']);
                        $this->db->update('applicant_assessment');
                        $log_info = "edit assessment";
                    }else{
                        /* INSERT */
                        $this->db->set('applicant_id', $_POST['textApplicantId']);
                        $this->db->set('details', $_POST['textDetails']);
                        $this->db->set('position', $_POST['inputRecPos']);
                        $this->db->set('nature_id', $_POST['selectNatureProjExp']);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);
                        $this->db->insert('applicant_assessment');
                        $log_info = "add assessment";

                        /*TRANSFER TO ACTIVE IF STATUS=ON POOL*/
                        $app_info = $this->get_applicant_data($_POST['textApplicantId']);
                        if($app_info['personal']->status == 'ON POOL'){
                            $this->db->set('status', 'ACTIVE');
                            $this->db->where('id', $_POST['textApplicantId']);
                            $this->db->update('applicant_general_info');
                        }
                    }
                    
                    if($this->db->trans_complete()){
                        create_log('applicant_logs', $_POST['textApplicantId'], $_SESSION['rs_user']['username'], 'assessment', $log_info);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;

                case 'assessment_lineup':
                    $this->db->trans_start();
                    if($_POST['textAction'] == 'edit'){
                        /* UPDATE */
                        $this->db->set('assess_detail', $_POST['textDetails']);
                        $this->db->set('assess_position', $_POST['inputRecPos']);
                        $this->db->set('assess_nature', $_POST['selectNatureProjExp']);
                        $this->db->set('assess_edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('assess_edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textRecordId']);
                        $this->db->update('applicant_lineup');
                        $log_info = "edit lineup assessment lineup id: ".$_POST['textRecordId'];
                    }else{
                        /* INSERT */
                        $this->db->set('assess_detail', $_POST['textDetails']);
                        $this->db->set('assess_position', $_POST['inputRecPos']);
                        $this->db->set('assess_nature', $_POST['selectNatureProjExp']);
                        $this->db->set('assess_by', $_SESSION['rs_user']['username']);
                        $this->db->set('assess_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textRecordId']);
                        $this->db->update('applicant_lineup');
                        $log_info = "add lineup assessment lineup id: ".$_POST['textRecordId'];
                    }
                    
                    if($this->db->trans_complete()){
                        create_log('applicant_logs', $_POST['textApplicantId'], $_SESSION['rs_user']['username'], 'lineup assessment', $log_info);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                    
                case 'emp_offer':
                    $this->db->trans_start();
                    
                    $this->db->set('probation', $_POST['textProbation']);
                    $this->db->set('contract_type', $_POST['TextContractType']);
                    $this->db->set('employment_status', $_POST['SelectEmpStatus']);
                    $this->db->set('contract_period', $_POST['SelectContractPeriod']);
                    $this->db->set('is_renewable', (isset($_POST['checkIsRenewable']))?"Y":"N");
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
                    
                    if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                        /* UPDATE */
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textRecordId']);
                        $this->db->update('applicant_employment_offer');
                        $log_info = "edit employment offer";
                    }else{
                        /* INSERT */
                        $this->db->set('applicant_id', $_POST['textApplicantId']);
                        $this->db->set('lineup_id', $_POST['textLineupId']);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);
                        $this->db->insert('applicant_employment_offer');
                        $log_info = "add employment offer";
                    }
                    
                    if($this->db->trans_complete()){
                        create_log('applicant_logs', $_POST['textApplicantId'], $_SESSION['rs_user']['username'], 'employment offer', $log_info);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;

                case 'accounts_card':
                    $this->db->trans_start();

                    if($_POST['textNewParticular'] != ''){
                        /*CREATE NEW PARTICULAR*/
                        $this->db->replace('settings_particulars', array('name' => $_POST['textNewParticular'], 'add_by' => $_SESSION['rs_user']['username'], 'add_date' => date("Y-m-d h:i:s")));
                        $particular_id = $this->db->insert_id();
                    }else{
                        $particular_id = $_POST['selectParticular'];
                    }

                    $this->db->set('particular_id', $particular_id);
                    $this->db->set('amount', $_POST['textAmount']);
                    $this->db->set('reference', $_POST['textReference']);
                    $this->db->set('charge_to', $_POST['selectChargeTo']);
                    $this->db->set('payment_method_id', $_POST['selectPayment']);

                    if($_POST['hParticularId'] != '' && $_POST['hParticularId'] > 0){
                        /* UPDATE */
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['hParticularId']);
                        $this->db->update('applicant_accounts_card');
                        $log_info = "edit";
                    }else{
                        /* INSERT */
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('lineup_id', $_POST['textLineup_id']);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);
                        $this->db->insert('applicant_accounts_card');
                        $log_info = "add";
                    }
                    
                    if($this->db->trans_complete()){
                        create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'accounts card', $log_info);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;

                case 'accounts_card_rmk':
                    $this->db->trans_start();

                    $this->db->set('remarks', $_POST['textRemarks']);

                    if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                        /* UPDATE */
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textRecordId']);
                        $this->db->update('applicant_accounts_card_hdr');
                        $log_info = "edit";
                    }else{
                        /* INSERT */
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('lineup_id', $_POST['textLineup_id']);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);
                        $this->db->insert('applicant_accounts_card_hdr');
                        $log_info = "add";
                    }

                    if($this->db->trans_complete()){
                        create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'accounts card remarks', $log_info);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;

                case 'interview_sched':
                    $this->db->set('mob_result', $_POST['selectMobResult']);
                    $this->db->set('interview_sched_id', $_POST['selectInterviewSched']);
                    $this->db->set('mob_remarks', $_POST['textMobRemarks']);
                    $this->db->set('interview_confirmed', $_POST['selectInterviewConfirmed']);
                    $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                    $this->db->set('edit_date', 'NOW()', FALSE);
                    $this->db->where('id', $_POST['textRecordId']);
                    if($this->db->update('applicant_lineup')){
                        create_log('applicant_logs', $_POST['textApplicantId'], $_SESSION['rs_user']['username'], 'interview schedule', 'id:'.$_POST['textRecordId'].', mob_result:'.$_POST['selectMobResult'].', sched_id:'.$_POST['selectInterviewSched']);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;

                case 'welfare':
                    $this->db->trans_start();

                    /*CASE DETAILS*/
                    if(isset($_POST['textDetails'])){
                        $this->db->set('details', $_POST['textDetails']);

                        if($_FILES['textAttach']){
                            $ext = pathinfo($_FILES['textAttach']['name'], PATHINFO_EXTENSION);
                            $path = "./uploads/applicant/".$_POST['textApplicant_id']."/welfare/";
                            $filename = "case_details.".$ext;
                            $docs = upload_file('textAttach', $path, $filename);

                            if(!is_array($docs)){
                                /*ERROR*/
                            }else{
                                $this->db->set('attachment', $path.$filename);
                            }
                        }
                    }

                    /*ACTION/REMARKS*/
                    if(isset($_POST['textAction'])){
                        if($_POST['textPrevAction']){
                            $prev_action = $_POST['textPrevAction']."&&&";
                        }else{
                            $prev_action = "";
                        }

                        $this->db->set('action', $prev_action.$_POST['textAction']."[|]".$_SESSION['rs_user']['username']."[|]".date("Y-m-d h:i:s"));
                        $this->db->set('action_date', 'NOW()', FALSE);
                        $this->db->set('action_by', $_SESSION['rs_user']['username']);

                        if($_FILES['textAttachAction']){
                            $ext_a = pathinfo($_FILES['textAttachAction']['name'], PATHINFO_EXTENSION);
                            $path_a = "./uploads/applicant/".$_POST['textApplicant_id']."/welfare/";
                            $filename_a = "action.".$ext_a;
                            $docs_a = upload_file('textAttachAction', $path_a, $filename_a);

                            if(!is_array($docs_a)){
                                /*ERROR*/
                            }else{
                                $this->db->set('action_attachment', $path_a.$filename_a);
                            }
                        }
                    }

                    /*FINAL ACTION*/
                    if(isset($_POST['textFinalAction'])){
                        $this->db->set('status', 'CLOSED');
                        $this->db->set('final_action', $_POST['textFinalAction']);
                        $this->db->set('final_action_date', 'NOW()', FALSE);
                        $this->db->set('final_action_by', $_SESSION['rs_user']['username']);

                        if($_FILES['textFinalAttach']){
                            $ext_f = pathinfo($_FILES['textFinalAttach']['name'], PATHINFO_EXTENSION);
                            $path_f = "./uploads/applicant/".$_POST['textApplicant_id']."/welfare/";
                            $filename_f = "final_action.".$ext_f;
                            $docs_f = upload_file('textFinalAttach', $path_f, $filename_f);

                            if(!is_array($docs_f)){
                                /*ERROR*/
                            }else{
                                $this->db->set('final_attachment', $path_f.$filename_f);
                            }
                        }
                    }

                    if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                        /* UPDATE */
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textRecordId']);
                        $this->db->update('applicant_welfare');
                        $log_info = "edit";
                    }else{
                        /* INSERT */
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);
                        $this->db->insert('applicant_welfare');
                        $log_info = "add";
                    }

                    if($this->db->trans_complete()){
                        create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'welfare', $log_info);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;

                case 'resume':
                    /*JAP PROFILE*/
                    if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                        /* UPDATE */
                        $this->db->set('residency', $_POST['selectRes']);
                        $this->db->set('residency_addr', $_POST['textResRemarks']);
                        $this->db->set('foot_size', $_POST['textFoot']);
                        $this->db->set('waist_size', $_POST['textWaist']);
                        $this->db->set('uniform_size', $_POST['selectUniform']);
                        $this->db->set('handedness', $_POST['selectHand']);
                        $this->db->set('med_allergy', $_POST['selectMedAllergy']);
                        $this->db->set('healthy', $_POST['selectHealthy']);
                        $this->db->set('blood_type', $_POST['selectBlood']);
                        $this->db->set('alcohol', $_POST['selectAlcohol']);
                        $this->db->set('smoking', $_POST['selectSmoking']);
                        $this->db->set('sight_left', $_POST['textSightLeft']);
                        $this->db->set('sight_right', $_POST['textSightRight']);
                        $this->db->set('glasses', $_POST['selectGlasses']);
                        $this->db->set('contact_lens', $_POST['selectLens']);
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textRecordId']);
                        // $this->db->update('applicant_profile_jap');
                        // $log_info = "edit";
                        if($this->db->update('applicant_profile_jap')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'update', 'edit jap profile - resume');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }else{
                        /* INSERT */
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('residency', $_POST['selectRes']);
                        $this->db->set('residency_addr', $_POST['textResRemarks']);
                        $this->db->set('foot_size', $_POST['textFoot']);
                        $this->db->set('waist_size', $_POST['textWaist']);
                        $this->db->set('uniform_size', $_POST['selectUniform']);
                        $this->db->set('handedness', $_POST['selectHand']);
                        $this->db->set('med_allergy', $_POST['selectMedAllergy']);
                        $this->db->set('healthy', $_POST['selectHealthy']);
                        $this->db->set('blood_type', $_POST['selectBlood']);
                        $this->db->set('alcohol', $_POST['selectAlcohol']);
                        $this->db->set('smoking', $_POST['selectSmoking']);
                        $this->db->set('sight_left', $_POST['textSightLeft']);
                        $this->db->set('sight_right', $_POST['textSightRight']);
                        $this->db->set('glasses', $_POST['selectGlasses']);
                        $this->db->set('contact_lens', $_POST['selectLens']);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);
                        // $this->db->insert('applicant_profile_jap');
                        // $log_info = "add";
                        if($this->db->insert('applicant_profile_jap')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'insert', 'add jap profile - resume');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }
                    break;

                case 'school_history':
                    $sh = implode("|", $_POST['checkSchool']);
                    if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                        /* UPDATE */
                        $this->db->set('school_history', $sh);
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textRecordId']);

                        if($this->db->update('applicant_profile_jap')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'update', 'edit jap profile - school');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }else{
                        /* INSERT */
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('school_history', $sh);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);

                        if($this->db->insert('applicant_profile_jap')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'add', 'add jap profile - school');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }
                    break;

                case 'overtime':
                    if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                        /* UPDATE */
                        $this->db->set('work_ot', $_POST['selectOT']);
                        $this->db->set('work_ot_min', $_POST['textOTMin']);
                        $this->db->set('work_ot_max', $_POST['textOTMax']);
                        $this->db->set('work_night', $_POST['selectNight']);
                        $this->db->set('work_night_min', $_POST['textNightMin']);
                        $this->db->set('work_night_max', $_POST['textNightMax']);
                        $this->db->set('work_shift', $_POST['selectShift']);
                        $this->db->set('work_shift_min', $_POST['textShiftMin']);
                        $this->db->set('work_shift_max', $_POST['textShiftMax']);
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textRecordId']);

                        if($this->db->update('applicant_profile_jap')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'update', 'edit jap profile - overtime');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }else{
                        /* INSERT */
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('work_ot', $_POST['selectOT']);
                        $this->db->set('work_ot_min', $_POST['textOTMin']);
                        $this->db->set('work_ot_max', $_POST['textOTMax']);
                        $this->db->set('work_night', $_POST['selectNight']);
                        $this->db->set('work_night_min', $_POST['textNightMin']);
                        $this->db->set('work_night_max', $_POST['textNightMax']);
                        $this->db->set('work_shift', $_POST['selectShift']);
                        $this->db->set('work_shift_min', $_POST['textShiftMin']);
                        $this->db->set('work_shift_max', $_POST['textShiftMax']);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);

                        if($this->db->insert('applicant_profile_jap')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'add', 'add jap profile - overtime');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }
                    break;

                case 'language':
                    $jap_read = implode("|", $_POST['checkRead']);
                    $jap_write = implode("|", $_POST['checkWrite']);
                    if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                        /* UPDATE */
                        $this->db->set('jap_speak', $_POST['selectSpeak']);
                        $this->db->set('jap_speak_rating', $_POST['textSpeakRate']);
                        $this->db->set('jap_understand', $_POST['selectUnderstand']);
                        $this->db->set('jap_understand_rating', $_POST['textUnderstandRate']);
                        $this->db->set('jap_read', $jap_read);
                        $this->db->set('jap_read_rating', $_POST['textReadRate']);
                        $this->db->set('jap_write', $jap_write);
                        $this->db->set('jap_write_rating', $_POST['textWriteRate']);
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textRecordId']);

                        if($this->db->update('applicant_profile_jap')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'update', 'edit jap profile - language');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }else{
                        /* INSERT */
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('jap_speak', $_POST['selectSpeak']);
                        $this->db->set('jap_speak_rating', $_POST['textSpeakRate']);
                        $this->db->set('jap_understand', $_POST['selectUnderstand']);
                        $this->db->set('jap_understand_rating', $_POST['textUnderstandRate']);
                        $this->db->set('jap_read', $jap_read);
                        $this->db->set('jap_read_rating', $_POST['textReadRate']);
                        $this->db->set('jap_write', $jap_write);
                        $this->db->set('jap_write_rating', $_POST['textWriteRate']);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);

                        if($this->db->insert('applicant_profile_jap')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'add', 'add jap profile - language');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }
                    break;

                case 'license':
                    $jap_lic = implode("|", $_POST['checkLic']);
                    if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                        /* UPDATE */
                        $this->db->set('license_res', $jap_lic);
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textRecordId']);

                        if($this->db->update('applicant_profile_jap')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'update', 'edit jap profile - license');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }else{
                        /* INSERT */
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('license_res', $jap_lic);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);

                        if($this->db->insert('applicant_profile_jap')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'add', 'add jap profile - license');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }
                    break;

                case 'jap_relative':
                    if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                        /* UPDATE */
                        $this->db->set('name', $_POST['textName']);
                        $this->db->set('relationship', $_POST['textRelationship']);
                        $this->db->set('age', $_POST['textAge']);
                        $this->db->set('occupation', $_POST['textOccupation']);
                        $this->db->set('address', $_POST['textAddress']);
                        $this->db->set('remarks', $_POST['textRemarks']);
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textRecordId']);

                        if($this->db->update('applicant_char_ref_jap')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'update', 'edit jap profile - relatives');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }else{
                        /* INSERT */
                        $this->db->set('applicant_id', $_POST['textApplicant_id']);
                        $this->db->set('name', $_POST['textName']);
                        $this->db->set('relationship', $_POST['textRelationship']);
                        $this->db->set('age', $_POST['textAge']);
                        $this->db->set('occupation', $_POST['textOccupation']);
                        $this->db->set('address', $_POST['textAddress']);
                        $this->db->set('remarks', $_POST['textRemarks']);
                        $this->db->set('add_by', $_SESSION['rs_user']['username']);
                        $this->db->set('add_date', 'NOW()', FALSE);

                        if($this->db->insert('applicant_char_ref_jap')){
                            create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'add', 'add jap profile - relatives');
                            $return_val = 1;
                        }else{
                            $return_val = 0;
                        }
                    }
                    break;

                /*FINAL LINEUP FOR EGMP*/
                case 'lineup_status':
                    $this->db->trans_start();
                    if($_POST['textRecordId'] != '' && $_POST['textRecordId'] > 0){
                        $this->db->set('lineup_status', $_POST['selectIntStatus']);
                        $this->db->set('lineup_acceptance', $_POST['selectAcceptance']);
                        $this->db->set('select_date', dateformat($_POST['inputSelectDate'],0));
                        $this->db->set('approval_date', dateformat($_POST['inputApproveDate'],0));
                        $this->db->set('remarks', $this->input->post('textRemarks', TRUE));
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);

                        if($_POST['selectIntStatus'] == 'Selected' && $_POST['selectAcceptance'] == 'Accepted'){
                            /*CONFIRM MOB RESULT*/
                            $this->db->set('mob_result', "CR");

                            /*SET AS CURRENT MR*/
                            $this->db->set('is_current', "Y");
                        }

                        $this->db->where('id', $_POST['textRecordId']);
                        $this->db->update('applicant_lineup');
                        $log_info = "edit lineup mr_pos_id:{$_POST['SelectPosition']}";
                        
                        $lineup_id = $_POST['textRecordId'];
                    }
                    
                    /* SELECTED/ACCEPTED: UPDATE GENERAL INFO STATUS */
                    if($_POST['selectIntStatus'] == 'Selected' && $_POST['selectAcceptance'] == 'Accepted'){
                        $this->db->set('status', 'OPERATIONS');
                        $this->db->set('lineup_id', $lineup_id);
                        $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                        $this->db->set('edit_date', 'NOW()', FALSE);
                        $this->db->where('id', $_POST['textApplicantId']);
                        $this->db->update('applicant_general_info');
                    }

                    if($this->db->trans_complete()){
                        create_log('applicant_logs', $_POST['textApplicantId'], $_SESSION['rs_user']['username'], 'lineup', $log_info);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
            }
            
            return $return_val;
        }
        
        public function delete($what, $id){
            switch ($what){
                case 'education':
                    $this->db->where('id', $id);
                    if($this->db->delete('applicant_education')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'delete', 'delete education info');
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                case 'work':
                    $this->db->where('id', $id);
                    if($this->db->delete('applicant_work_history')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'delete', 'delete work info');
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                case 'reference':
                    $this->db->where('id', $id);
                    if($this->db->delete('applicant_char_ref')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'delete', 'delete reference info');
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                case 'training':
                    $this->db->where('id', $id);
                    if($this->db->delete('applicant_training')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'delete', 'delete training info');
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                case 'skills':
                    $this->db->where('id', $id);
                    if($this->db->delete('applicant_skills')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'delete', 'delete skills info');
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                case 'internal_adv':
                case 'applicant_adv':
                    $this->db->where('id', $id);
                    if($this->db->delete('applicant_comm')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'delete', 'delete '.$what);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                case 'picture':
                case 'cv':
                    $this->db->where(array('id'=>$id));
                    if($this->db->delete('applicant_uploads')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'delete', 'delete '.$what);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                case 'lineup':
                    $this->db->where(array('id'=>$id));
                    if($this->db->delete('applicant_lineup')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'lineup', 'delete id:'.$id);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                case 'assessment':
                    $this->db->where(array('id'=>$id));
                    if($this->db->delete('applicant_assessment')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'assessment', 'delete id:'.$id);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                case 'accounts_card':
                    $this->db->where(array('id'=>$id));
                    if($this->db->delete('applicant_accounts_card')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'applicant_accounts_card', 'delete id:'.$id);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                case 'welfare':
                    $this->db->where(array('id'=>$id));
                    if($this->db->delete('applicant_welfare')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'applicant_welfare', 'delete id:'.$id);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                case 'welfare_doc':
                    $this->db->set($_GET['tbl_fld_name'], '');
                    $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                    $this->db->set('edit_date', 'NOW()', FALSE);
                    $this->db->where(array('id'=>$id));
                    if($this->db->update('applicant_welfare')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'applicant_welfare - '.$_GET['tbl_fld_name'], 'delete id:'.$id);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
                case 'jap_relative':
                    $this->db->where(array('id'=>$id));
                    if($this->db->delete('applicant_char_ref_jap')){
                        create_log('applicant_logs', $_GET['applicant_id'], $_SESSION['rs_user']['username'], 'applicant_char_ref_jap', 'delete id:'.$id);
                        $return_val = 1;
                    }else{
                        $return_val = 0;
                    }
                    break;
            }
            return $return_val;
        }
        
        public function save_uploads($filename, $desc, $type_id=NULL){
            $this->db->trans_start();
            $this->db->set('filename', $filename);
            $this->db->set('description', $desc);

            // $q = getdata("select id from applicant_uploads where applicant_id = {$_POST['textApplicant_id']} and description = '{$desc}'");

            // if($q){
            //     /*EDIT*/
            //     $this->db->set('edit_by', $_SESSION['rs_user']['username']);
            //     $this->db->set('edit_date', 'NOW()', FALSE);
            //     $this->db->where('id', $q[0]['id']);
            //     $this->db->update('applicant_uploads');
            // }else{
            //     /*ADD*/
            //     $this->db->set('applicant_id', $_POST['textApplicant_id']);
            //     $this->db->set('add_by', $_SESSION['rs_user']['username']);
            //     $this->db->set('add_date', 'NOW()', FALSE);
            //     $this->db->insert('applicant_uploads');
            // }

            if($type_id == 22 || $type_id == 28){
                /*CREATE/OVERWRITE PROFILE PIX\CV*/
                $q = getdata("select id from applicant_uploads where applicant_id = {$_POST['textApplicant_id']} and type_id = {$type_id}");

                if($q){
                    /*EDIT*/
                    $this->db->set('edit_by', $_SESSION['rs_user']['username']);
                    $this->db->set('edit_date', 'NOW()', FALSE);
                    $this->db->where('id', $q[0]['id']);
                    $this->db->update('applicant_uploads');
                }else{
                    /*ADD*/
                    $this->db->set('type_id', $type_id);
                    $this->db->set('applicant_id', $_POST['textApplicant_id']);
                    $this->db->set('add_by', $_SESSION['rs_user']['username']);
                    $this->db->set('add_date', 'NOW()', FALSE);
                    $this->db->insert('applicant_uploads');
                }
            }else{
                $this->db->set('type_id', $type_id);
                $this->db->set('applicant_id', $_POST['textApplicant_id']);
                $this->db->set('add_by', $_SESSION['rs_user']['username']);
                $this->db->set('add_date', 'NOW()', FALSE);
                $this->db->insert('applicant_uploads');
            }

            if($this->db->trans_complete()){
                create_log('applicant_logs', $_POST['textApplicant_id'], $_SESSION['rs_user']['username'], 'upload', $desc);
                return true;
            }else{
                return false;
            }
        }
        
        public function create_advisory($type){
            $this->db->set('applicant_id', $_POST['textApplicant_id']);
            $this->db->set('type', $type);
            $this->db->set('message', $_POST['textAdvisory']);
            $this->db->set('add_by', $_SESSION['rs_user']['username']);
            $this->db->set('add_date', 'NOW()', FALSE);
            if($this->db->insert('applicant_comm')){
                return 1;
            }else{
                return 0;
            }
        }
        
        public function delete_applicant_data($applicant_id){
            /* DELETE UPLOADED FILES */
            $uploads = getdata("select * from applicant_uploads where applicant_id = {$applicant_id}");
            $uploads_folder = "";
            if($uploads){
                foreach ($uploads as $upload_info){
                    if(is_file($upload_info['filename'])){
                        unlink($upload_info['filename']);
                        $uploads_folder = dirname($upload_info['filename']);
                    }
                }

                if($uploads_folder <> ''){
                    /* DELETE APPLICANT'S FOLDER */
                    rmdir($uploads_folder);
                }
            }

            $this->db->trans_start();

            /* DELETE GENERAL INFO */
            $this->db->where('id', $applicant_id);
            $this->db->delete('applicant_general_info');

            /* DELETE EDUCATION */
            $this->db->where('applicant_id', $applicant_id);
            $this->db->delete('applicant_education');
            
            /* DELETE WORK */
            $this->db->where('applicant_id', $applicant_id);
            $this->db->delete('applicant_work_history');
            
            /* DELETE CHAR REF */
            $this->db->where('applicant_id', $applicant_id);
            $this->db->delete('applicant_char_ref');
            
            /* DELETE TRAINING */
            $this->db->where('applicant_id', $applicant_id);
            $this->db->delete('applicant_training');
            
            /* DELETE SKILLS */
            $this->db->where('applicant_id', $applicant_id);
            $this->db->delete('applicant_skills');
            
            /* DELETE ADVISORY */
            $this->db->where('applicant_id', $applicant_id);
            $this->db->delete('applicant_comm');

            /* DELETE UPLOADS */
            $this->db->where('applicant_id', $applicant_id);
            $this->db->delete('applicant_uploads');

            /*DELETE SMS*/
            $this->db->where('applicant_id', $applicant_id);
            $this->db->delete('applicant_sms_subscription');

            $this->db->where('applicant_id', $applicant_id);
            $this->db->delete('applicant_sms_inbox');

            $this->db->where('applicant_id', $applicant_id);
            $this->db->delete('applicant_sms_outbox');

            /*DELETE ACCOUNTS CARD*/
            $this->db->where('applicant_id', $applicant_id);
            $this->db->delete('applicant_accounts_card_hdr');

            $this->db->where('applicant_id', $applicant_id);
            $this->db->delete('applicant_accounts_card');

            /*DELETE WELFARE*/
            $this->db->where('applicant_id', $applicant_id);
            $this->db->delete('applicant_welfare');

            if($this->db->trans_complete()){
                create_log('applicant_logs', $applicant_id, $_SESSION['rs_user']['username'], 'delete', 'delete record');
                return 1;
            }else{
                return 0;
            }
        }
        
        public function transfer_to_opdb($applicant_id, $lineup_id){
            
        }

        public function for_endorsement($applicant_id, $action="add"){
            if($action == 'add'){
                /*GET CURRENT LINEUP ID*/
                $q = getdata("select lineup_id from applicant_general_info where id = {$applicant_id}");

                /* INSERT */
                $this->db->set('applicant_id', $applicant_id);
                $this->db->set('lineup_id', $q[0]['lineup_id']);
                $this->db->set('add_by', $_SESSION['rs_user']['username']);
                $this->db->set('add_date', 'NOW()', FALSE);
                if($this->db->insert('applicant_for_endorsement')){
                    /*INTERNAL ADVISORY HERE*/
                    $this->db->set('applicant_id', $applicant_id);
                    $this->db->set('type', 'internal');
                    $this->db->set('message', 'FOR ENDORSEMENT');
                    $this->db->set('add_by', $_SESSION['rs_user']['username']);
                    $this->db->set('add_date', 'NOW()', FALSE);
                    $this->db->insert('applicant_comm');

                    /*SMS HERE*/

                    /*LOGS*/
                    create_log('applicant_logs', $applicant_id, $_SESSION['rs_user']['username'], 'for endorsement', $action);
                }
            }else if($action == 'remove'){
                $this->db->where('applicant_id', $applicant_id);
                if($this->db->delete('applicant_for_endorsement')){
                    /*INTERNAL ADVISORY HERE*/
                    $this->db->set('applicant_id', $applicant_id);
                    $this->db->set('type', 'internal');
                    $this->db->set('message', 'remove from FOR ENDORSEMENT');
                    $this->db->set('add_by', $_SESSION['rs_user']['username']);
                    $this->db->set('add_date', 'NOW()', FALSE);
                    $this->db->insert('applicant_comm');

                    /*LOGS*/
                    create_log('applicant_logs', $applicant_id, $_SESSION['rs_user']['username'], 'for endorsement', $action);
                }
            }
        }

        /*PROCESSING*/
        public function request_visa($applicant_id, $lineup_id){
            $this->db->where('applicant_id',$applicant_id);
            $this->db->where('lineup_id',$lineup_id);
            $q = $this->db->get('applicant_processing');

            if ( $q->num_rows() > 0 ){
                $this->db->set('request_visa_id', $_POST['selectVisaNoReq']);
                $this->db->set('request_visa_cat', $_POST['selectVisaCatReq']);
                $this->db->set('request_by', $_SESSION['rs_user']['username']);
                $this->db->set('request_date', 'NOW()', FALSE);
                $this->db->where('applicant_id',$applicant_id);
                $this->db->where('lineup_id',$lineup_id);
                $this->db->update('applicant_processing');
            }else{
                $this->db->set('applicant_id', $applicant_id);
                $this->db->set('lineup_id',$lineup_id);
                $this->db->set('request_visa_id', $_POST['selectVisaNoReq']);
                $this->db->set('request_visa_cat', $_POST['selectVisaCatReq']);
                $this->db->set('request_by', $_SESSION['rs_user']['username']);
                $this->db->set('request_date', 'NOW()', FALSE);
                $this->db->insert('applicant_processing');
            }

            create_log('applicant_logs', $applicant_id, $_SESSION['rs_user']['username'], 'request visa/category', '');
        }

        public function visa_endorsement($applicant_id, $lineup_id){
            $this->db->where('applicant_id',$applicant_id);
            $this->db->where('lineup_id',$lineup_id);
            $q = $this->db->get('applicant_processing');

            if ( $q->num_rows() > 0 ){
                $this->db->set('visa_endorsement_by', $_SESSION['rs_user']['username']);
                $this->db->set('visa_endorsement_date', 'NOW()', FALSE);
                $this->db->where('applicant_id',$applicant_id);
                $this->db->where('lineup_id',$lineup_id);
                $this->db->update('applicant_processing');
            }else{
                $this->db->set('applicant_id', $applicant_id);
                $this->db->set('lineup_id',$lineup_id);
                $this->db->set('visa_endorsement_by', $_SESSION['rs_user']['username']);
                $this->db->set('visa_endorsement_date', 'NOW()', FALSE);
                $this->db->insert('applicant_processing');
            }
        }

        public function rfp_endorsement($applicant_id, $lineup_id){
            $this->db->where('applicant_id',$applicant_id);
            $this->db->where('lineup_id',$lineup_id);
            $q = $this->db->get('applicant_processing');

            if ( $q->num_rows() > 0 ){
                $this->db->set('rfp_endorsement_by', $_SESSION['rs_user']['username']);
                $this->db->set('rfp_endorsement_date', 'NOW()', FALSE);
                $this->db->where('applicant_id',$applicant_id);
                $this->db->where('lineup_id',$lineup_id);
                $this->db->update('applicant_processing');
            }else{
                $this->db->set('applicant_id', $applicant_id);
                $this->db->set('lineup_id',$lineup_id);
                $this->db->set('rfp_endorsement_by', $_SESSION['rs_user']['username']);
                $this->db->set('rfp_endorsement_date', 'NOW()', FALSE);
                $this->db->insert('applicant_processing');
            }
        }

        public function visa_documentation($applicant_id, $lineup_id){
            $this->db->where('applicant_id',$applicant_id);
            $this->db->where('lineup_id',$lineup_id);
            $q = $this->db->get('applicant_processing');

            if ( $q->num_rows() > 0 ){
                $this->db->set('visa_doc_req_date', dateformat($_POST['textVisaDocReqDate'], 0));
                $this->db->set('visa_doc_prep_date', dateformat($_POST['textVisaDocPrepDate'], 0));
                $this->db->set('visa_doc_send_date', dateformat($_POST['textVisaDocSendDate'], 0));
                $this->db->set('visa_doc_rec_date', dateformat($_POST['textVisaDocRecvDate'], 0));
                $this->db->set('visa_doc_exp_date', dateformat($_POST['textVisaDocExpDate'], 0));
                $this->db->set('visa_doc_verify_date', dateformat($_POST['textVisaDocVrfyDate'], 0));
                $this->db->set('visa_doc_no', $_POST['textVisaDocNo']);
                $this->db->set('visa_doc_category', $_POST['textVisaDocCat']);
                $this->db->set('visa_doc_edit_date', 'NOW()', FALSE);
                $this->db->set('visa_doc_edit_by', $_SESSION['rs_user']['username']);
                $this->db->where('applicant_id',$applicant_id);
                $this->db->where('lineup_id',$lineup_id);
                $this->db->update('applicant_processing');
            }else{
                $this->db->set('applicant_id', $applicant_id);
                $this->db->set('lineup_id',$lineup_id);
                $this->db->set('visa_doc_req_date', dateformat($_POST['textVisaDocReqDate'], 0));
                $this->db->set('visa_doc_prep_date', dateformat($_POST['textVisaDocPrepDate'], 0));
                $this->db->set('visa_doc_send_date', dateformat($_POST['textVisaDocSendDate'], 0));
                $this->db->set('visa_doc_rec_date', dateformat($_POST['textVisaDocRecvDate'], 0));
                $this->db->set('visa_doc_exp_date', dateformat($_POST['textVisaDocExpDate'], 0));
                $this->db->set('visa_doc_verify_date', dateformat($_POST['textVisaDocVrfyDate'], 0));
                $this->db->set('visa_doc_no', $_POST['textVisaDocNo']);
                $this->db->set('visa_doc_category', $_POST['textVisaDocCat']);
                $this->db->set('visa_doc_edit_date', 'NOW()', FALSE);
                $this->db->set('visa_doc_edit_by', $_SESSION['rs_user']['username']);
                $this->db->insert('applicant_processing');
            }
        }

        public function contract_signing($applicant_id, $lineup_id){
            $this->db->where('applicant_id',$applicant_id);
            $this->db->where('lineup_id',$lineup_id);
            $q = $this->db->get('applicant_processing');

            if ( $q->num_rows() > 0 ){
                $this->db->set('contract_sched_date', dateformat($_POST['textContractSched'], 0));
                $this->db->set('contract_endorse_date', dateformat($_POST['textContractEndorsed'], 0));
                $this->db->set('contract_check_date', dateformat($_POST['textContractChk'], 0));
                (dateformat($_POST['textContractChk']))?$this->db->set('contract_check_by', $_SESSION['rs_user']['username']):"";
                $this->db->set('contract_rel_date', dateformat($_POST['textContractRel'], 0));
                (dateformat($_POST['textContractRel']))?$this->db->set('contract_rel_by', $_SESSION['rs_user']['username']):"";
                $this->db->set('contract_edit_date', 'NOW()', FALSE);
                $this->db->set('contract_edit_by', $_SESSION['rs_user']['username']);
                $this->db->where('applicant_id',$applicant_id);
                $this->db->where('lineup_id',$lineup_id);
                $this->db->update('applicant_processing');
            }else{
                $this->db->set('applicant_id', $applicant_id);
                $this->db->set('lineup_id',$lineup_id);
                $this->db->set('contract_sched_date', dateformat($_POST['textContractSched'], 0));
                $this->db->set('contract_endorse_date', dateformat($_POST['textContractEndorsed'], 0));
                $this->db->set('contract_check_date', dateformat($_POST['textContractChk'], 0));
                (dateformat($_POST['textContractChk']))?$this->db->set('contract_check_by', $_SESSION['rs_user']['username']):"";
                $this->db->set('contract_rel_date', dateformat($_POST['textContractRel'], 0));
                (dateformat($_POST['textContractRel']))?$this->db->set('contract_rel_by', $_SESSION['rs_user']['username']):"";
                $this->db->set('contract_edit_date', 'NOW()', FALSE);
                $this->db->set('contract_edit_by', $_SESSION['rs_user']['username']);
                $this->db->insert('applicant_processing');
            }
        }

        public function pdos($applicant_id, $lineup_id){
            $this->db->where('applicant_id',$applicant_id);
            $this->db->where('lineup_id',$lineup_id);
            $q = $this->db->get('applicant_processing');

            if ( $q->num_rows() > 0 ){
                $this->db->set('pdos_sched_date', dateformat($_POST['textPdosSched'], 0));
                $this->db->set('pdos_cert_no', $_POST['textPdosCert']);
                $this->db->set('pdos_taken', dateformat($_POST['textPdosTaken'], 0));
                $this->db->set('pdos_edit_date', 'NOW()', FALSE);
                $this->db->set('pdos_edit_by', $_SESSION['rs_user']['username']);
                $this->db->where('applicant_id',$applicant_id);
                $this->db->where('lineup_id',$lineup_id);
                $this->db->update('applicant_processing');
            }else{
                $this->db->set('applicant_id', $applicant_id);
                $this->db->set('lineup_id',$lineup_id);
                $this->db->set('pdos_sched_date', dateformat($_POST['textPdosSched'], 0));
                $this->db->set('pdos_cert_no', $_POST['textPdosCert']);
                $this->db->set('pdos_taken', dateformat($_POST['textPdosTaken'], 0));
                $this->db->set('pdos_edit_date', 'NOW()', FALSE);
                $this->db->set('pdos_edit_by', $_SESSION['rs_user']['username']);
                $this->db->insert('applicant_processing');
            }
        }

        public function visa_allocation(){
            $this->db->where('id',$_POST['textRecordId']);
            $q = $this->db->get('applicant_processing');

            if ( $q->num_rows() > 0 ){
                $this->db->set('request_visa_id', $_POST['selectVisaNoReq']);
                $this->db->set('request_visa_cat', $_POST['selectVisaCatReq']);
                $this->db->set('request_approved_cat', $_POST['selectApprovedCat']);
                $this->db->set('request_status', $_POST['selectVisaStat']);
                $this->db->set('request_updated', dateformat($_POST['textVisaReqDate'], 0));
                $this->db->set('request_remarks', $_POST['textRemarks']);
                $this->db->set('request_by', $_SESSION['rs_user']['username']);
                $this->db->set('request_date', 'NOW()', FALSE);
                $this->db->where('id',$_POST['textRecordId']);
                if($this->db->update('applicant_processing')){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function oec_request(){
            $this->db->where('id',$_POST['textRecordId']);
            $q = $this->db->get('applicant_processing');

            if ( $q->num_rows() > 0 ){
                $this->db->set('rfp_submit_date', dateformat($_POST['textRFPsubmit'], 0));
                $this->db->set('rfp_release_date', dateformat($_POST['textRFPrelease'], 0));
                $this->db->set('rfp_oec_no', $_POST['textRFPoec']);
                $this->db->set('rfp_cg_no', $_POST['textRFPcgno']);
                $this->db->set('rfp_status', $_POST['selectRFPStat']);
                $this->db->set('rfp_updated', dateformat($_POST['textRFPReqDate'], 0));
                $this->db->set('rfp_remarks', $_POST['textRemarks']);
                $this->db->set('rfp_edit_by', $_SESSION['rs_user']['username']);
                $this->db->set('rfp_edit_date', 'NOW()', FALSE);
                $this->db->where('id',$_POST['textRecordId']);
                if($this->db->update('applicant_processing')){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }
        }

        public function poea_request($applicant_id, $lineup_id){
            $this->db->where('applicant_id',$applicant_id);
            $this->db->where('lineup_id',$lineup_id);
            $q = $this->db->get('applicant_processing');

            if ( $q->num_rows() > 0 ){
                $this->db->set('poea_req_by', $_SESSION['rs_user']['username']);
                $this->db->set('poea_req_date', 'NOW()', FALSE);
                $this->db->where('applicant_id',$applicant_id);
                $this->db->where('lineup_id',$lineup_id);
                $this->db->update('applicant_processing');
            }else{
                $this->db->set('applicant_id', $applicant_id);
                $this->db->set('lineup_id',$lineup_id);
                $this->db->set('poea_req_by', $_SESSION['rs_user']['username']);
                $this->db->set('poea_req_date', 'NOW()', FALSE);
                $this->db->insert('applicant_processing');
            }

            create_log('applicant_logs', $applicant_id, $_SESSION['rs_user']['username'], 'request jo', '');
        }

        public function jo_request($applicant_id, $lineup_id){
            $this->db->set('poea_request_id', $_POST['selectJOIDReq']);
            $this->db->set('poea_request_cat', $_POST['selectJOCatReq']);
            $this->db->set('poea_edit_by', $_SESSION['rs_user']['username']);
            $this->db->set('poea_edit_date', 'NOW()', FALSE);
            $this->db->where('applicant_id',$applicant_id);
            $this->db->where('lineup_id',$lineup_id);
            $this->db->update('applicant_processing');

            create_log('applicant_logs', $applicant_id, $_SESSION['rs_user']['username'], 'request jo/category', '');
        }

        public function allocate_jo(){
            $this->db->set('poea_sent_date', dateformat($_POST['textPOEASentDate'], 0));
            $this->db->set('poea_approve_date', dateformat($_POST['textPOEAApproveDate'], 0));
            $this->db->set('poea_request_id', $_POST['selectJOIDReq']);
            $this->db->set('poea_request_cat', $_POST['selectJOCatReq']);
            $this->db->set('poea_request_cur_id', $_POST['selectPOEACurr']);
            $this->db->set('poea_request_sal_amt', $_POST['textPOEASalAmt']);
            $this->db->set('poea_request_sal_per', $_POST['selectPOEASalPer']);
            $this->db->set('poea_approved_id', $_POST['selectPOEAApprovedID']);
            $this->db->set('poea_approved_cat', $_POST['selectPOEAApprovedCat']);
            $this->db->set('poea_remarks', $_POST['textRemarks']);
            $this->db->set('poea_edit_by', $_SESSION['rs_user']['username']);
            $this->db->set('poea_edit_date', 'NOW()', FALSE);
            $this->db->where('id',$_POST['textRecordId']);
            if($this->db->update('applicant_processing')){
                return true;
            }else{
                return false;
            }

            /*LOG*/
        }

        public function deallocate_jo($applicant_id, $lineup_id){
            $this->db->set('poea_req_by', '');
            $this->db->set('poea_req_date', '0000-00-00 00:00:00');
            $this->db->set('poea_request_id', '0');
            $this->db->set('poea_request_cat', '0');
            $this->db->set('poea_request_cur_id', '');
            $this->db->set('poea_request_sal_amt', '');
            $this->db->set('poea_request_sal_per', '');
            $this->db->set('poea_approved_id', '0');
            $this->db->set('poea_approved_cat', '0');
            $this->db->set('poea_edit_by', $_SESSION['rs_user']['username']);
            $this->db->set('poea_edit_date', 'NOW()', FALSE);
            $this->db->where('applicant_id',$applicant_id);
            $this->db->where('lineup_id',$lineup_id);
            $this->db->update('applicant_processing');

            /*LOG*/
            create_log('applicant_logs', $applicant_id, $_SESSION['rs_user']['username'], 'deallocate jo', '');
        }

        public function booking_request($d){
            $this->db->set('booking_id', $d['booking_id']);
            $this->db->set('applicant_id', $d['app_id']);
            $this->db->set('request_date', dateformat($d['request_date'],0));
            $this->db->set('pr_book_date', dateformat($d['pr_book_date'],0));
            $this->db->set('add_by', $_SESSION['rs_user']['username']);
            $this->db->set('add_date', 'NOW()', FALSE);
            $this->db->insert('applicant_booking');

            /*LOG*/
            create_log('applicant_logs', $d['app_id'], $_SESSION['rs_user']['username'], 'booking request', '');
        }
        /*END PROCESSING*/
}