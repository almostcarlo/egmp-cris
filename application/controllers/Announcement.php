<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Announcement extends MY_Controller{

    public function __construct(){
        parent::__construct();
        
        $this->load->helper(array('text'));
    }
    
	public function index()
	{
	    //$this->template->set('file_javascript', array('javascripts/index.js', 'javascripts/validation/login.js'));

	    $data['list'] = getdata("select * from manager_announcement order by add_date desc");
		$this->template->view('announcement/index', $data);
	}
	
	public function create()
	{
	    $this->template->set('file_javascript', array('javascripts/validation/announcement.js'));
	    
	    $data = "";
	    $this->template->view('announcement/form_announcement', $data);
	}
	
	public function edit($id)
	{
	    $this->template->set('file_javascript', array('javascripts/validation/announcement.js'));

	    $data['info'] = getdata("select * from manager_announcement where id = {$id}");
	    $this->template->view('announcement/form_announcement', $data);
	}
	
	public function save()
	{
	    $this->load->model('settings_model');
	    $id = $this->settings_model->save('announcement');

// 	    if($_POST['textRecord_id']){
// 	        $result = dbsetdata("update manager_announcement
//                                 set title = '{$_POST['textTitle']}',
//                                 details = '{$_POST['textDetails']}',
//                                 edit_by = '{$_SESSION['rs_user']['username']}',
//                                 edit_date = NOW()
//                                 where id = {$_POST['textRecord_id']}");
// 	    }else{
// 	        $result = dbsetdata("insert into manager_announcement (title, details, add_by, add_date)
//                                 values ('{$_POST['textTitle']}', '{$_POST['textDetails']}', '{$_SESSION['rs_user']['username']}', NOW())");
// 	    }

// 	    var_dump($result);
// 	    exit();
// 	    $data['info'] = getdata("select * from manager_announcement where id = {$id}");
// 	    $this->template->view('announcement/form_announcement', $data);
	    redirect('announcement/edit/'.$id, 'refresh');
	}
	
	public function delete($id){
	    $this->load->model('settings_model');
	    $this->settings_model->delete('manager_announcement', $id);
	    
	    redirect('announcement', 'refresh');
	}
}
