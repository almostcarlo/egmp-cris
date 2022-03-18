<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reception extends MY_Controller{

    public function __construct(){
        parent::__construct();
        
        $this->load->helper(array('text'));
    }
    
	public function index()
	{
	    redirect('home/dashboard', 'refresh');
	}

	public function photo_shoot(){
	    $this->template->set('file_javascript', array('javascripts/reception/photoshoot.js','vendor/webcam/webcam.js'));
	    $this->load->helper('email');
	    
	    if(trim($this->input->post('textSearch')) != ''){
	        if(valid_email(trim($this->input->post('textSearch')))){
	            /* search email address */
	            $q_where = "and email = '".trim($this->input->post('textSearch'))."'";
	        }else{
	            if(strpos($this->input->post('textSearch'), ',')){
	                $fullName = explode(',',$this->input->post('textSearch'));
	                /* search last name */
	                $q_where = "and lname like '".trim($fullName[0])."%'";
	                
	                if(trim($fullName[1]) != ''){
	                    /* search first name */
	                    $q_where .= "and fname like '".trim($fullName[1])."%'";
	                }
	                
	            }else{
	                /* search last OR first name */
	                $q_where = "and (lname like '".trim($this->input->post('textSearch'))."%' or fname like '".trim($this->input->post('textSearch'))."%')";
	            }
	        }
	    }else{
	        $q_where = "and id not in (select applicant_id from applicant_uploads where description in ('iprs picture','profile picture')) and status not in ('DEADFILE', 'BACKOUT', 'BLACKLISTED', 'DEPLOYED', 'SELECTED', 'SELECTED - ACCEPTED', 'SELECTED - DECLINE', 'SELECTED - THINKING')";
	    }

	    $list = getdata("select id, fname, mname, lname, email, status, add_date
	    				from applicant_general_info
                        where 1
                        {$q_where}");
	    $this->template->view('reception/photo_shoot', array('applicants'=>$list));
	}

	public function ajax(){
	    switch($_GET['action']){
	        case 'photoshoot':
	            $this->load->model('applicant_model');
	            $data = array('applicant_data'=>$this->applicant_model->get_applicant_data($_GET['applicant_id']));
	            echo $this->load->view('reception/tab_upload', $data, TRUE);
	            break;
	    }
	}
	
	public function for_assessment(){
	    $q = "select i.id, i.fname, i.mname, i.lname, i.birthdate, u.filename as cv_file, u.id as cv_file_id, ap.position as applied_pos, al.id as lineup_id, pos.`desc` as lineup_pos, mr.code as mr_ref, mp.name as principal,
                appm.desc as application_method, apps.desc as application_source, i.status, i.add_date
                from applicant_general_info i
                left join applicant_assessment aa
                on i.id = aa.applicant_id
                left join applicant_uploads u
                on i.id = u.applicant_id and u.description = 'Resume/CV'
                left join applicant_applied_pos ap
                on i.id = ap.applicant_id
                left join applicant_lineup al
                on i.id = al.applicant_id
                left join manager_jobs mj
                on al.mr_pos_id = mj.id
                left join settings_position pos
                on mj.pos_id = pos.id
                left join manager_mr mr
                on al.manpower_id = mr.id
                left join manager_principal mp
                on mr.principal_id = mp.id
                left join settings_application_method appm
                on i.application_method = appm.id
                left join settings_application_source apps
                on i.application_source = apps.id
                where 1
                and aa.id is null
                and i.status not in ('DEPLOYED','OPERATIONS','DEADFILE','RESERVED')
                order by i.lname asc";
	    $r = getdata($q);

	    $ids = array();
	    foreach ($r as $i){
	        array_push($ids, $i['id']);
	        $data['list'][$i['id']] = $i;
	        $data['list_lineup'][$i['id']][$i['lineup_id']] = array('pos' => $i['lineup_pos'], 'mr' => $i['mr_ref'], 'principal' => $i['principal']);
	    }
	    
	    $word_educ = $this->getWorkEducInfo($ids);
	    $data['educ_info'] = $word_educ['educ'];
	    $data['work_info'] = $word_educ['work'];

	    $this->template->view('reception/for_assessment', $data);
	}
	
	public function for_encoding(){
	    $q = "select i.id, i.fname, i.mname, i.lname, i.birthdate, ap.position as applied_pos,
                appm.desc as application_method, apps.desc as application_source,
                al.id as lineup_id, pos.`desc` as lineup_pos, mr.code as mr_ref, mp.name as principal, i.status, i.add_date
                from applicant_general_info i
                left join applicant_work_history w
                on i.id = w.applicant_id
                left join applicant_education e
                on i.id = e.applicant_id
                left join applicant_applied_pos ap
                on i.id = ap.applicant_id
                left join applicant_lineup al
                on i.id = al.applicant_id
                left join manager_jobs mj
                on al.mr_pos_id = mj.id
                left join settings_position pos
                on mj.pos_id = pos.id
                left join manager_mr mr
                on al.manpower_id = mr.id
                left join manager_principal mp
                on mr.principal_id = mp.id
                left join settings_application_method appm
                on i.application_method = appm.id
                left join settings_application_source apps
                on i.application_source = apps.id
                where 1
                and (w.id is null OR e.id is null)
                and i.status not in ('DEPLOYED','DEADFILE')
                order by i.lname asc";
	    $r = getdata($q);
	    
	    foreach ($r as $i){
	        $data['list'][$i['id']] = $i;
	        $data['list_lineup'][$i['id']][$i['lineup_id']] = array('pos' => $i['lineup_pos'], 'mr' => $i['mr_ref'], 'principal' => $i['principal']);
	    }

	    $this->template->view('reception/for_encoding', $data);
	}
	
	function printReport($what){
	    switch($what){
	        case 'for_assessment':
	            $q = "select i.id, i.fname, i.mname, i.lname, i.birthdate, u.filename as cv_file, u.id as cv_file_id, ap.position as applied_pos, al.id as lineup_id, pos.`desc` as lineup_pos, mr.code as mr_ref, mp.name as principal,
                appm.desc as application_method, apps.desc as application_source, i.status, i.add_date
                from applicant_general_info i
                left join applicant_assessment aa
                on i.id = aa.applicant_id
                left join applicant_uploads u
                on i.id = u.applicant_id and u.description = 'Resume/CV'
                left join applicant_applied_pos ap
                on i.id = ap.applicant_id
                left join applicant_lineup al
                on i.id = al.applicant_id
                left join manager_jobs mj
                on al.mr_pos_id = mj.id
                left join settings_position pos
                on mj.pos_id = pos.id
                left join manager_mr mr
                on al.manpower_id = mr.id
                left join manager_principal mp
                on mr.principal_id = mp.id
                left join settings_application_method appm
                on i.application_method = appm.id
                left join settings_application_source apps
                on i.application_source = apps.id
                where 1
                and aa.id is null
                and i.status not in ('DEPLOYED','OPERATIONS','DEADFILE','RESERVED')
                order by i.lname asc";
	            $r = getdata($q);
	            
	            $ids = array();
	            foreach ($r as $i){
	                array_push($ids, $i['id']);
	                $data['list'][$i['id']] = $i;
	                $data['list_lineup'][$i['id']][$i['lineup_id']] = array('pos' => $i['lineup_pos'], 'mr' => $i['mr_ref'], 'principal' => $i['principal']);
	            }
	            
	            $word_educ = $this->getWorkEducInfo($ids);
	            $data['educ_info'] = $word_educ['educ'];
	            $data['work_info'] = $word_educ['work'];
	            break;
	            
	        case 'for_encoding':
	            $q = "select i.id, i.fname, i.mname, i.lname, i.birthdate, ap.position as applied_pos,
                        appm.desc as application_method, apps.desc as application_source,
                        al.id as lineup_id, pos.`desc` as lineup_pos, mr.code as mr_ref, mp.name as principal, i.status, i.add_date
                        from applicant_general_info i
                        left join applicant_work_history w
                        on i.id = w.applicant_id
                        left join applicant_education e
                        on i.id = e.applicant_id
                        left join applicant_applied_pos ap
                        on i.id = ap.applicant_id
                        left join applicant_lineup al
                        on i.id = al.applicant_id
                        left join manager_jobs mj
                        on al.mr_pos_id = mj.id
                        left join settings_position pos
                        on mj.pos_id = pos.id
                        left join manager_mr mr
                        on al.manpower_id = mr.id
                        left join manager_principal mp
                        on mr.principal_id = mp.id
                        left join settings_application_method appm
                        on i.application_method = appm.id
                        left join settings_application_source apps
                        on i.application_source = apps.id
                        where 1
                        and (w.id is null OR e.id is null)
                        and i.status not in ('DEPLOYED','DEADFILE')
                        order by i.lname asc";
	            $r = getdata($q);
	            
	            foreach ($r as $i){
	                $data['list'][$i['id']] = $i;
	                $data['list_lineup'][$i['id']][$i['lineup_id']] = array('pos' => $i['lineup_pos'], 'mr' => $i['mr_ref'], 'principal' => $i['principal']);
	            }
	            break;
	    }

	    $this->template->set_template('template_print');
	    $this->template->view('reception/'.$what, $data);
	}

	private function getWorkEducInfo($ids){
	    
	    $educ_info = array();
	    $work_info = array();

	    if(count($ids) > 0){
	        $ids = array_unique($ids);
	        $ids = implode(",",$ids);
	        
	        /* GET EDUCATION */
	        $qeduc = "select ed.*, el.`desc`
            	        from applicant_education ed
            	        left join settings_educ_level el
            	        on ed.level_id = el.id
            	        where 1
            	        and ed.applicant_id in ({$ids})";
	        $reduc = getdata($qeduc);
	        
	        if($reduc){
	            foreach ($reduc as $e_info){
	                $educ_info[$e_info['applicant_id']][$e_info['id']] = $e_info;
	            }
	        }
	        
	        /* GET WORK EXP */
	        $qwork = "select * from applicant_work_history where applicant_id in ({$ids})";
	        $rwork = getdata($qwork);
	        if($rwork){
	            foreach ($rwork as $w_info){
	                $work_info[$w_info['applicant_id']][$w_info['id']] = $w_info;
	            }
	        }
	    }

	    return array('educ' => $educ_info, 'work' => $work_info);
	}

	public function saveWebpic(){
		if(isset($_FILES['webcam']) && $_FILES['webcam']['size'] > 0){
		    $this->load->model('applicant_model');
		    
		    /* CREATE FOLDER PER APPLICANT */
		    $config['upload_path'] = "./uploads/applicant/".$_GET['applicant_id']."/";
		    $file_input_name = "";
		    
		    /* CHECK IF UPLOAD FOLDER EXIST */
		    if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

	        /* UPLOAD FILE */
	        $config['allowed_types']       = 'gif|jpg|png|jpeg|JPG|JPEG|PNG';
	        $config['max_size']            = 5120;
	        $config['file_name']           = "profile_pic";
	        $file_input_name = 'webcam';
	        $file_desc = 'iprs picture';

	        /* CHECK IF FILE ALREADY EXIST */
	        $current_picture = getdata("select * from applicant_uploads where applicant_id = {$_GET['applicant_id']} and description='iprs picture'");

	        if($current_picture){
	            /* DELETE FROM APPLICANTS FOLDER */
                unlink($current_picture[0]['filename']);

                /* DELETE RECORD FROM DB */
                $this->applicant_model->delete('picture', $current_picture[0]['id']);
	        }

		    if($file_input_name <> ''){
		        $this->load->library('upload', $config);
		        
		        if ( ! $this->upload->do_upload($file_input_name)){
		            /* ERROR */
		        }else{
		            $data = array('upload_data' => $this->upload->data());

		            /* SAVE TO DB */
		            $_POST['textApplicant_id'] = $_GET['applicant_id'];
		            if($this->applicant_model->save_uploads($config['upload_path'].$data['upload_data']['file_name'], $file_desc)){
		                /*SUCCESS*/
		            }else{
		                /* ERROR */
		            }
		        }
		    }
		}

	    return http_response_code(200);
	}

	public function utilities($what=NULL){
		switch ($what) {
			default:
				/*DELETE FOR ENCODING IF DAYS DELAY >= 150*/
				echo "DELETING APPLICANT IN FOR ENCODING IF DAYS DELAYED >= 150<br><br>";
			    $q = "select i.id
						from applicant_general_info i
						left join applicant_work_history w
						on i.id = w.applicant_id
						left join applicant_education e
						on i.id = e.applicant_id
						where 1
						and (w.id is null OR e.id is null)
						and i.status not in ('DEPLOYED','DEADFILE')
						and DATEDIFF(NOW(), i.add_date) >= 150
						group by i.id
						limit 10";
			    $r = getdata($q);
			    
			    if($r && count($r) > 0){
			    	$this->load->model('applicant_model');
				    foreach ($r as $i){
						if($this->applicant_model->delete_applicant_data($i['id'])){
			            	echo $i['id']." - deleted<br>";
			    	    }else{
			    	    	echo $i['id']." - ERROR<br>";
			    	    }
				    }

				    redirect('reception/utilities', 'refresh');
			    }else{
			    	echo "No record found.";
			    }
				break;
		}
	}
}