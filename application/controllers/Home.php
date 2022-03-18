<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller{

    public function __construct(){
        parent::__construct();
        
        $this->load->helper(array('form','url'));

		/* CHECK IF USER IS LOGGED IN */
        if(!isset($_SESSION['rs_user']) && !in_array($this->router->fetch_method(), array('index','ajax_auth'))){
            redirect('login', 'refresh');
        }
    }
    
	public function index()
	{
	    if(isset($_SESSION['rs_user'])){
	        redirect('home/dashboard', 'refresh');
	    }

	    $this->template->set('file_javascript', array('javascripts/index.js', 'javascripts/validation/login.js'));

	    $data = "";
	    $this->template->set_template('template_login');
		$this->template->view('login', $data);
	}

	public function ajax_auth(){
	    $status = "";
	    $msg = "";

	    /* check if username exist */
	    $data = getdata("select *
                        from settings_users
                        where username = '{$_POST['textUser']}'");
	    if(count($data) > 0){
	    	/* check if password is correct */
	        $my_password = trim($_POST['textPassword']);
	        if(password_verify($my_password, $data[0]['password'])){
	            /* check if account is still active */
	            if($data[0]['is_active'] == 'N'){
    	            $status = "error";
    	            $msg = "User account is already inactive.";
    	            create_log('user', '', $_POST['textUser'], 'login', 'inactive account');
    	        }else{
        	        $status = "";
        	        $msg = "Good";
        	        
        	        if(in_array($data[0]['access'], array('admin','manager'))){
        	            $del_access = array(1,2,3,4,5,6,7,8,9,10);
        	        }else{
        	            $del_access = array();
        	        }
        	        
        	        /* create session */
        	        $_SESSION['rs_user'] = array('id' => $data[0]['id'],
        	                                       'username' => $data[0]['username'],
        	                                       'name' => $data[0]['name'],
        	                                       'position' => $data[0]['position'],
        	                                       'access_level' => $data[0]['access'],
        	                                       'delete_access' => $del_access,
        	                                       'picture' => $data[0]['picture'],
        	        );
        	        
        	        /* get menu items */
        	        $this->generate_menu();

        	        /* update timezone */
        	        dbsetdata("SET time_zone = '+8:00'");
        	        
        	        dbsetdata("update settings_users set last_login = NOW() where id = {$data[0]['id']}");
        	        create_log('user', '', $_POST['textUser'], 'login', 'success');
    	        }
	        }else{
	            $status = "error";
	            $msg = "Wrong password.";
	            create_log('user', '', $_POST['textUser'], 'login', 'wrong password');
	        }
	    }else{
	        $status = "error";
	        $msg = "User does not exist.";
	        create_log('user', '', $_POST['textUser'], 'login', 'user not found');
	    }
	    
	    echo json_encode(array('status'=>$status, 'msg'=>$msg));
	}

	public function dashboard(){
	    if(!isset($_SESSION['rs_user'])){
	        redirect('login', 'refresh');
	    }

	    $this->load->helper('text');

	    /* get total no. of applicants */
	    if(!isset($_SESSION['rs_dashboard']['total_applicant'])){
	        $total_applicants = getdata('select count(*) as total from applicant_general_info');
	        $_SESSION['rs_dashboard']['total_applicant'] = $total_applicants[0]['total'];
	    }

	    /* get total no. of deployed applicants */
	    if(!isset($_SESSION['rs_dashboard']['total_deployed'])){
	        $total_deployed = getdata("select count(*) as total from applicant_general_info where status = 'DEPLOYED'");
	        $_SESSION['rs_dashboard']['total_deployed'] = $total_deployed[0]['total'];
	    }

	    /* get total no. of active jo */
	    if(!isset($_SESSION['rs_dashboard']['total_jobs'])){
	        $total_jobs = getdata('select count(*) as total from manager_jobs where status = 1');
	        $_SESSION['rs_dashboard']['total_jobs'] = $total_jobs[0]['total'];
	    }

	    $data['latest_applicants'] = getdata("select a.id, a.fname, a.mname, a.lname, a.birthdate, p.position, c.name as city, c.province
                                                from applicant_applied_pos p
                                                left join applicant_general_info a
                                                on p.applicant_id = a.id
                                                left join settings_city c
                                                on a.address_city_id = c.id
                                                where 1
                                                order by a.add_date desc
                                                limit 5");
	    
	    $data['latest_jobs'] = getdata("select p.`desc` as position, pr.name as principal, c.name as country
                                        from manager_jobs j
                                        left join settings_position p
                                        on j.pos_id = p.id
                                        left join manager_principal pr
                                        on j.principal_id = pr.id
                                        left join settings_country c
                                        on pr.country_id = c.id
                                        where 1
                                        and j.status = 1
                                        order by j.add_date desc
                                        limit 5");

	    if(MR_REQUIRED){
			$data['sched_today'] = getdata("select s.*, mr.code as mr_ref, pr.name as principal
											from manager_interview_schedule s
											left join manager_mr mr
											on s.mr_id = mr.id
											left join manager_principal pr
											on mr.principal_id = pr.id
											where 1
											and s.interview_date >= '".date("Y-m-d")." 00:00:00'
											and s.interview_date <= '".date("Y-m-d")." 23:59:59'
											and mr.status = 1");
		}else{
		    $data['latest_logs'] = getdata("select * from applicant_logs
	                                        where add_by not in ('validate')
	                                        order by add_date desc
	                                        limit 10");
		}

	    $this->load->view('dashboard', $data);
	}

	public function logout(){
	    if(isset($_SESSION['rs_user'])){
	        create_log('user', '', $_SESSION['rs_user']['username'], 'logout', '');
	        unset($_SESSION['rs_user'], $_SESSION['rs_dashboard']);
	    }

	    redirect('home/index', 'refresh');
	}
	
	public function clear(){
	    unset($_SESSION['rs_dashboard'], $_SESSION['settings']);
	    redirect('home/dashboard', 'refresh');
	}
	
	public function generate_menu(){
	    $user_id = $_SESSION['rs_user']['id'];

	    $list = getdata("select * from settings_menu order by order_no asc");
	    $my_menu = array();
	    foreach ($list as $info){
	        $access = explode(',',$info['user_id']);
	        if(in_array($user_id, $access)){
	            $my_menu[$info['level']][$info['parent_id']][$info['id']] = array('title'=>$info['title'], 'url'=>$info['url'], 'css_class'=>$info['css_class']);
	        }
	    }

	    $_SESSION['rs_user']['menu'] = $my_menu;
	}

	/*EMAIL VALIDATION IF NO WEBSITE*/
	public function validate_email($id=NULL){
// echo base64_encode("20190203-14");
// exit();
	    $id = explode("-",base64_decode($id));

	    if(count($id)<2){
	        /* ERROR - INVALID ID */
	        echo "INVALID ID";
	    }else{
    	    $applicant_id = $id[1];
    	    $apply_date = date("Y-m-d", strtotime($id[0]));
    	    $app_data = getdata("select id, fname, mname, lname, add_date, is_valid_email
                                from applicant_general_info
                                where 1
                                and id={$applicant_id}
    	                        and left(add_date,10)='{$apply_date}'");

    	    if($app_data){
    	        if($app_data[0]['is_valid_email'] == 'Y'){
    	            echo "EMAIL HAS BEEN ALREADY VERIFIED";
    	        }else{
    	            $this->load->model('applicant_model');
    	            $return_validate = $this->applicant_model->validate_email($applicant_id);

    	            if($return_validate == 0){
    	                /* ERROR */
    	                echo "UNABLE TO VERIFY EMAIL";
    	            }else{
    	            	/* SUCCESS - VALIDATE RECORD */
    	                echo "EMAIL HAS BEEN SUCCESSFULLY VERIFIED";
    	            }
    	        }
    	    }else{
    	        /* ERROR - RECORD NOT FOUND */
    	        echo "NO RECORD FOUND.";
    	    }
	    }

	    /*REDIRECT*/
		header('Refresh: 5; URL='.WEBSITE_URL);
	}

	public function change_pass_form(){
		$this->template->set_template('template_default');
		$this->template->view('settings/user/change-pass', array('picture' => $_SESSION['rs_user']['picture']));
	}

	public function change_pass(){
		/*CHECK IF CURRENT PASSWORD IS NOT NULL*/
		if(isset($_POST['textCurrPass']) && trim($_POST['textCurrPass']) <> ''){
			/*CHECK IF NEW PASSWORD IS NOT NULL*/
			if((isset($_POST['textPassword']) && trim($_POST['textPassword']) <> '') && (isset($_POST['textConfirmPassword']) && trim($_POST['textConfirmPassword']) <> '')){
				/*CHECK IF NEW PASSWORD IS LONG ENOUGH*/
				if(strlen($_POST['textPassword']) >= 6){
					/*CHECK IF NEW PASSWORD MATCH*/
					if(trim($_POST['textPassword']) == trim($_POST['textConfirmPassword'])){
				        // /* check if current password is correct */
				        // $chk_pass = getdata("select id, username, password, is_active, name, position, access
				        //            from settings_users
				        //             where username = '{$_SESSION['rs_user']['username']}'
				        //             and password = password('{$_POST['textCurrPass']}')");

				        // if(count($chk_pass) > 0){
				        // 	/*UPDATE PASSWORD*/
				        // 	dbsetdata("update settings_users set password = password('{$_POST['textPassword']}') where id = {$_SESSION['rs_user']['id']}");
				        /* get current password */
				        $chk_pass = getdata("select password from settings_users
				                    			where username = '{$_SESSION['rs_user']['username']}'");

				        /* check if entered password is correct */
				        $curr_password = trim($_POST['textCurrPass']);

				        if(password_verify($curr_password, $chk_pass[0]['password'])){
				        	/*UPDATE PASSWORD*/
				        	$pw_hash = password_hash(trim($_POST['textPassword']), PASSWORD_DEFAULT);
				        	dbsetdata("update settings_users set password = '{$pw_hash}' where id = {$_SESSION['rs_user']['id']}");

							$this->session->set_flashdata('settings_notification_status', 'Success');
					        $this->session->set_flashdata('settings_notification', 'Password has been updated.');
				        }else{
							$this->session->set_flashdata('settings_notification_status', 'Error');
					        $this->session->set_flashdata('settings_notification', 'Please enter your current password.');
				        }
					}else{
						$this->session->set_flashdata('settings_notification_status', 'Error');
						$this->session->set_flashdata('settings_notification', 'New Password does not match.');
					}
				}else{
					$this->session->set_flashdata('settings_notification_status', 'Error');
					$this->session->set_flashdata('settings_notification', 'New Password is too short.');
				}
			}else{
				$this->session->set_flashdata('settings_notification_status', 'Error');
				$this->session->set_flashdata('settings_notification', 'New Password is required.');
			}
		}else{
			$this->session->set_flashdata('settings_notification_status', 'Error');
			$this->session->set_flashdata('settings_notification', 'Current Password is required.');
		}

		$this->template->set_template('template_default');
		$this->template->view('settings/user/change-pass', array());
	}

	public function change_photo(){
		if($_FILES['fileUploadPhoto'] && $_FILES['fileUploadPhoto']['size'] > 0){
			/* CREATE FOLDER FOR USERS */
			$config['upload_path'] = "./uploads/users/photo/";

		    /* CHECK IF UPLOAD FOLDER EXIST */
		    if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

	        /* UPLOAD FILE */
	        $config['allowed_types']       = 'gif|jpg|png|jpeg|JPG|JPEG|PNG';
	        $config['max_size']            = MAX_FILE_UPLOAD;
	        $config['file_name']           = $_FILES['fileUploadPhoto']['name'];

	        $this->load->library('upload', $config);
	        
	        if ( ! $this->upload->do_upload('fileUploadPhoto')){
	            /* ERROR */
				$this->session->set_flashdata('settings_notification_status', 'Error');
		        $this->session->set_flashdata('settings_notification', $this->upload->display_errors());
	        }else{
	            /* SAVE TO DB */
	            dbsetdata("update settings_users set picture = '{$config['upload_path']}{$config['file_name']}' where id = {$_SESSION['rs_user']['id']}");

	            $_SESSION['rs_user']['picture'] = $config['upload_path'].$config['file_name'];

				$this->session->set_flashdata('settings_notification_status', 'Success');
		        $this->session->set_flashdata('settings_notification', 'Profile Photo has been updated.');
	        }
		}

		redirect('change-password', 'refresh');
	}

	public function my_profile_pic(){
	    if($_SESSION['rs_user']['picture'] <> ''){
			$this->load->helper('file');
			$path_to_file = $_SESSION['rs_user']['picture'];

			if (file_exists($path_to_file)){
				header('Content-Type: '.get_mime_by_extension($path_to_file));
				readfile($path_to_file);
			}
	    }
	}
}
