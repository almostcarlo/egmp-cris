<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jobs extends MY_Controller{

    public function __construct(){
        parent::__construct();
        
        $this->load->helper(array('text'));
    }
    
	public function index()
	{
	    $this->template->set('file_javascript', array('javascripts/validation/jobs.js?version=1.01'));

	    if(trim($this->input->post('textSearchJob')) != ''){
            /* search last OR first name */
            $q_where = "and (p.desc like '%".trim($this->input->post('textSearchJob'))."%'
                        or pr.name like '%".trim($this->input->post('textSearchJob'))."%'
                        or c.name like '%".trim($this->input->post('textSearchJob'))."%'
                        or m.code like '%".trim($this->input->post('textSearchJob'))."%')";
	        
	        $q_limit = "";
	    }else{
	        $q_where = "";
	    }
	    
	    $q_limit = "limit 100";
	    
	    $data['job_list'] = getdata("select count(l.applicant_id) as total_lineup, j.id, p.`desc` as position, pr.name as principal, c.name as company, m.code as mr_ref, j.status, j.principal_id, j.expiry_date, j.web_views
                                    from manager_jobs j
                                    left join applicant_lineup l
                                    on j.id = l.mr_pos_id
                                    left join settings_position p
                                    on j.pos_id = p.id
                                    left join manager_principal pr
                                    on j.principal_id = pr.id
                                    left join manager_mr m
                                    on j.mr_id = m.id
                                    left join manager_company c
                                    on j.company_id = c.id
                                    where 1
                                    {$q_where}
                                    group by j.id
                                    order by j.add_date desc
                                    {$q_limit}");
		$this->template->view('jobs/index', $data);
	}

	/* GENERATE POPUP MODAL */
	public function facebox($id=NULL){
	    get_items_from_cache('active_principal');
	    get_items_from_cache('company');

	    if($id){
	        $data['info'] = getdata("select j.*, m.code as mr_ref
                                    from manager_jobs j
                                    left join manager_mr m
                                    on j.mr_id = m.id
                                    where j.id = {$id}");
	    }else{
	        $data = "";
	    }
	    
	    if(MR_REQUIRED){
	        $formname = "form_jo";
	    }else{
	        $formname = "form_jo_custom";
	    }
	    
	    echo $this->load->view('jobs/'.$formname, $data, TRUE);
	}

	/* GENERATE POPUP MODAL - LIST OF APPLICANTS */
	public function applicants($id=NULL){
	    if($id){
	    	$data['info'] = getdata("select p.name as principal, pos.desc as position, mr.code as mr_ref
									from manager_jobs j
									left join manager_principal p
									on j.principal_id = p.id
									left join settings_position pos
									on j.pos_id = pos.id
									left join manager_mr mr
									on j.mr_id = mr.id
									where j.id = {$id}");
	        $data['list'] = getdata("select i.id, i.fname, i.mname, i.lname, i.status, l.add_date
									from applicant_lineup l
									left join applicant_general_info i
									on l.applicant_id = i.id
									where l.mr_pos_id = {$id}
									order by l.add_date desc");
	    }else{
	        $data = "";
	    }

	    echo $this->load->view('jobs/applicant_list', $data, TRUE);
	}

	public function dropdown(){
	    $html = "";
	    switch($_GET['what']){
	        case 'company':
	            get_items_from_cache('company_per_principal');
	            if(isset($_SESSION['settings']['company_per_principal'][$_GET['id']])){
	                foreach ($_SESSION['settings']['company_per_principal'][$_GET['id']] as $id => $desc){
	                    $html .= "<option value=\"{$id}\">{$desc}</option>";
	                }
	            }
	            break;
	            
	        case 'mr':
	            if($_GET['per']=='principal'){
	                /* get all mr of principal */
	                get_items_from_cache('mr_per_principal');
	                if(isset($_SESSION['settings']['mr_per_principal'][$_GET['id']])) $data = $_SESSION['settings']['mr_per_principal'][$_GET['id']];
	            }else if($_GET['per']=='company'){
	                if($_GET['id']<>''){
	                    /* get all mr of company */
	                    get_items_from_cache('mr_per_company');
	                    if(isset($_SESSION['settings']['mr_per_company'][$_GET['id']])) $data = $_SESSION['settings']['mr_per_company'][$_GET['id']];
	                }
	            }

	            if(isset($data)){
	                foreach ($data as $id => $desc){
	                    $html .= "<option value=\"{$id}\">{$desc}</option>";
	                }
	            }
	            break;
	    }
	    
	    echo $html;
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
	    $id = $this->settings_model->save('jo');

	    redirect('jobs', 'refresh');
	}
	
	public function delete($id){
	    $this->load->model('settings_model');
	    $this->settings_model->delete('manager_jobs', $id);
	    
	    redirect('jobs', 'refresh');
	}

	public function jobinfo(){
	    $job_info = get_Job_Info($_GET['mr_pos_id']);
	    if($job_info){
	        echo json_encode($job_info);
	    }
	}

	public function check_duplicate(){
	    if(isset($_GET['pos_id']) && isset($_GET['mr_id']) && isset($_GET['p_id'])){
	        if(MR_REQUIRED || $_GET['mr_id']!=0){
	            $q_where_mr = "and mr_id={$_GET['mr_id']}";
	        }else{
	            $q_where_mr = "and principal_id={$_GET['p_id']}";
	        }

	        if($_GET['job_id'] <> ''){
	        	$q_where_jobid = "and id <> {$_GET['job_id']}";
	        }else{
	        	$q_where_jobid = "";
	        }

	        $result = getdata("select * from manager_jobs where pos_id={$_GET['pos_id']} {$q_where_mr} {$q_where_jobid}");
	        if($result){
	            echo 1;
	        }else{
	            echo 0;
	        }
	    }else{
	        return 0;
	    }
	}
}
