<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_admin extends MY_Controller{

    public function __construct(){
        parent::__construct();
        
        $this->load->helper(array('text'));
    }
    
	public function index(){
		//$data = $this->fetch_raw_data('users');
		$this->template->view('reports/admin/user_log_index', array());
	}
	
	public function print_report($what=NULL){
		switch ($what) {
			case 'users':
				$data = $this->fetch_raw_data($what);
				$print_file = "user_log_print";
				break;
		}

	    $this->template->set_template('template_print');
	    $this->template->view('reports/admin/'.$print_file, $data);
	}

	private function fetch_raw_data($what=NULL){
		switch ($what) {
			case 'users':
				if($_POST['SelectUser']){
					$q_user = "and u.id = '{$_POST['SelectUser']}'";
				}else{
					$q_user = "";
				}

				$info = getdata("select l.* from user_logs l
								left join settings_users u
								on l.add_by = u.username
								where l.action in ('login','logout')
								and l.add_by not in ('admin')
								and (l.add_date >= '".dateformat($_POST['textStDate'],0)." 00:00:00' and l.add_date <= '".dateformat($_POST['textEnDate'],0)." 23:59:59')
								{$q_user}
								order by l.add_date asc");

				$logs = array();
				if($info){
					foreach($info as $i){
						if($i['action'] == 'login' && $i['remarks'] == 'success'){
							$logs[$i['id']] = $i;
						}else{
							$logs[$i['id']] = $i;
						}
					}
				}
				
				return array('list' => $logs);
				break;
			
			default:
				# code...
				break;
		}
	}
}
