<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Settings extends MY_Controller{

    public $current_principal_id;
    
	public function index()
	{
	    //$this->search();
	    redirect('home/dashboard', 'refresh');
	}

	/* USER MANAGER */
	public function search_user(){
	    $this->template->set('file_javascript', array('javascripts/settings/index.js',));
	    
	    if(trim($this->input->post('textSearchUser')) != ''){
	        $q_where = "and name like '%".trim($this->input->post('textSearchUser'))."%' or username like '%".trim($this->input->post('textSearchUser'))."%'";
	    }else{
	        $q_where = "";
	    }

	    $list = getdata("select * from settings_users where 1 {$q_where} order by add_date desc");
	    $data = array('users'=>$list);
        $this->template->view('settings/user/index', $data);
	}
	
	public function add_user(){
	    $this->template->set('file_javascript', array('javascripts/settings/index.js',));
	    $data = array();
	    $this->template->view('settings/user/form', $data);
	}
	
	public function edit_user($user_id){
	    $this->template->set('file_javascript', array('javascripts/settings/index.js',));
	    $data = array('user_info' => getdata("select * from settings_users where id={$user_id}"));
	    
	    /* MENU ACCESS */
	    $menu = getdata("select * from settings_menu order by order_no asc");
	    foreach ($menu as $info){
	        $data['menu_list'][$info['level']][$info['parent_id']][$info['id']] = array('title'=>$info['title'], 'url'=>$info['url'], 'user_id'=>$info['user_id']);
	    }

	    $this->template->view('settings/user/form', $data);
	}
	
	public function update_user_access(){
	    $this->load->model('settings_model');
	    $this->settings_model->update_user_access();

	    redirect('settings/user/'.$_POST['textRecordId'], 'refresh');
	}
	/* END USER MANAGER */
	
	/* POSITION MANAGER */
	public function search_position(){
	    $this->template->set('file_javascript', array('javascripts/settings/index.js',));
	    
	    if(trim($this->input->post('textSearchInput')) != ''){
	        $q_where = "and pos.desc like '%".trim($this->input->post('textSearchInput'))."%'";
	    }else{
	        $q_where = "";
	    }

	    $data = array('list'=>getdata("select pos.id, pos.desc, js.desc as jobspec
                                        from settings_position pos
                                        left join settings_jobspec js
                                        on pos.jobspec_id = js.id
                                        where 1
                                        {$q_where}
                                        order by pos.add_date desc
                                        limit 100"));
	    $this->template->view('settings/position/index', $data);
	}
	/* END POSITION MANAGER */
	
	/* PRINCIPAL MANAGER */
	public function search_principal(){
	    $this->template->set('file_javascript', array('javascripts/settings/index.js',));

	    if(trim($this->input->post('textSearchInput')) != ''){
	        $q_where = "and code like '%".trim($this->input->post('textSearchInput'))."%' or name like '%".trim($this->input->post('textSearchInput'))."%'";
	    }else{
	        $q_where = "";
	    }

	    $data = array('list'=>getdata("select * from manager_principal where 1 {$q_where} order by add_date desc"),
	                   'country'=>get_items_from_cache('country'));
	    $this->template->view('settings/principal/index', $data);
	}
	
	/* OPEN NEW PRINCIPAL FORM */
	public function add_principal(){
	    $this->template->set('file_javascript', array('javascripts/settings/principal.js',));
	    $data = array();
	    $this->template->view('settings/principal/form', $data);
	}
	
	/* OPEN PRINCIPAL FORM */
	public function edit_principal($id){
	    $this->template->set('file_javascript', array('javascripts/settings/principal.js',));
	    $data = array('info' => getdata("select * from manager_principal where id={$id}"),);
	    $this->template->view('settings/principal/form', $data);
	}

	/* SHOW PRINCIPAL INFO */
	public function view_principal($id){
	    $this->template->set('file_javascript', array('javascripts/settings/principal.js',));
	    $data = array('info' => getdata("select * from manager_principal where id={$id}"),
	                   'country'=>get_items_from_cache('country'),
	                   'contacts' => getdata("select * from manager_principal_contacts where principal_id={$id}"),);
	    
	    /* CHECK IF PRINCIPAL EXISTS */
	    if(!$data['info']){
	        redirect('settings/principal', 'refresh');
	    }

	    $this->template->view('settings/principal/view', $data);
	}
	
	public function ajax_principal_tab(){
	    $id = $_GET['p_id'];
	    switch ($_GET['p_tab']){
	        case 'mr':
	            /* MANPOWER REQUEST */
	            $data = getdata("select * from manager_mr where principal_id={$id} order by add_date desc");
	            break;
	        case 'jo':
	            /* JOB OPENINGS */
	            $data = getdata("select * from manager_jobs where principal_id={$id} order by add_date desc");
	            break;
	        default:
	            $data = getdata("select * from manager_principal_contacts where principal_id={$id} order by add_date desc");
	            break;
	    }

	    echo $this->load->view('settings/principal/tab_'.$_GET['p_tab'], array('data'=>$data,), TRUE);
	}
	
	/* GENERATE POPUP MODAL */
	public function facebox($what, $id=NULL){
	    $data = array('principal_id' => '');
	    switch ($what){
	        case 'contacts':
	            $formname = "principal/form_contacts";
	            if($id) $data['info'] = getdata("select * from manager_principal_contacts where id = {$id}");
	            break;
	        case 'mr':
	            $formname = "principal/form_mr";
	            if($id) $data['info'] = getdata("select * from manager_mr where id = {$id}");
	            break;
	        case 'jo':
	            if(MR_REQUIRED){
	                $formname = "principal/form_jo";
	            }else{
	                $formname = "principal/form_jo_custom";
	            }

	            if($id) $data['info'] = getdata("select * from manager_jobs where id = {$id}");
	            break;
	        case 'position':
	            $formname = "position/form_position";
	            if($id) $data['info'] = getdata("select * from settings_position where id = {$id}");
	            break;
	        case 'city':
	            $formname = "city/form";
	            if($id) $data['info'] = getdata("select * from settings_city where id = {$id}");
	            break;
	        case 'province':
	            $formname = "province/form";
	            if($id) $data['info'] = getdata("select * from settings_province where id = {$id}");
	            break;
	        case 'rec_fee_label':
	            $formname = "rec_fee/form_label";
	            $data['recfee_id'] = $_GET['id'];

	            /*GET POSITIONS*/
	            $data['pos_list'] = getdata("select j.pos_id, pos.desc as position
											from settings_position pos
											left join manager_jobs j
											on pos.id = j.pos_id
											left join settings_recfee_hdr rh
											on j.principal_id = rh.principal_id
											where rh.id = {$_GET['id']}");

	            if($id) $data['info'] = getdata("select * from settings_recfee_label where id = {$id}");
	            break;
            case 'rec_fee_particulars':
            	$formname = "rec_fee/form_particulars";
            	$data['recfee_id'] = $_GET['recfee_id'];
            	$data['label_id'] = $_GET['label_id'];

            	if($id) $data['info'] = getdata("select * from settings_recfee_dtl where id = {$id}");
	            break;

	        case 'source':
	            $formname = "source/form";
	            if($id) $data['info'] = getdata("select * from settings_application_source where id = {$id}");
	            break;

	        case 'agent':
	            $formname = "agent/form";
	            if($id) $data['info'] = getdata("select * from settings_agent where id = {$id}");
	            break;

            case 'particulars':
	            $formname = "particulars/form";
	            if($id) $data['info'] = getdata("select * from settings_particulars where id = {$id}");
	            break;

            case 'travel_agent':
            	$formname = "travel_agent/form";
	            if($id) $data['info'] = getdata("select * from settings_travelagent where id = {$id}");
            	break;

            case 'airline':
            	$formname = "airline/form";
	            if($id) $data['info'] = getdata("select * from settings_airline where id = {$id}");
            	break;

            case 'payment':
	            $formname = "payment/form";
	            if($id) $data['info'] = getdata("select * from settings_payment_method where id = {$id}");
	            break;

            case 'insurance':
	            $formname = "insurance/form";
	            if($id) $data['info'] = getdata("select * from settings_insurance_provider where id = {$id}");
	            break;


            case 'lending':
	            $formname = "lending/form";
	            if($id) $data['info'] = getdata("select * from settings_lending_provider where id = {$id}");
	            break;

            case 'branch':
	            $formname = "branch/form";
	            if($id) $data['info'] = getdata("select * from settings_branch where id = {$id}");
	            break;
	    }

	    echo $this->load->view('settings/'.$formname, $data, TRUE);
	}
	
	
	public function ajax_dd(){
	   switch ($_GET['what']){
	        case 'mr':
	            $sess_id = "mr_per_principal";
	            thisFunction('mr_per_principal', 'manager_mr', 'code', 'principal_id');
	            break;
	        case 'company':
	            $sess_id = "company_per_principal";
	            thisFunction('company_per_principal', 'manager_company', 'name', 'principal_id');
	            break;
	    }

	    $html = "";
	    if(isset($_SESSION['settings'][$sess_id][$_GET['principal_id']])){
	        foreach ($_SESSION['settings'][$sess_id][$_GET['principal_id']] as $c_ID => $c_NAME){
	            if($_GET['selected_val'] == $c_ID){
	                $html .= "<option value=\"{$c_ID}\" selected=\"selected\">{$c_NAME}</option>";
	            }else{
	                $html .= "<option value=\"{$c_ID}\">{$c_NAME}</option>";
	            }
	        }
	    }
	    
	    echo $html;
	}
	/* END PRINCIPAL MANAGER */
	
	/* COMPANY MANAGER */
	public function search_company(){
	    $this->template->set('file_javascript', array('javascripts/settings/index.js',));
	    
	    if(trim($this->input->post('textSearchInput')) != ''){
	        $q_where = "and c.code like '%".trim($this->input->post('textSearchInput'))."%' or c.name like '%".trim($this->input->post('textSearchInput'))."%'";
	    }else{
	        $q_where = "";
	    }
	    
	    $data = array('list'=>getdata("select c.id, c.code, c.name, p.name as principal from manager_company c left join manager_principal p on c.principal_id = p.id where 1 {$q_where} order by c.add_date desc"),);
	    $this->template->view('settings/company/index', $data);
	}
	
	/* OPEN NEW FORM */
	public function add_company(){
	    $this->template->set('file_javascript', array('javascripts/settings/company.js',));
	    $data = array();
	    $this->template->view('settings/company/form', $data);
	}
	
	public function edit_company($id){
	    $this->template->set('file_javascript', array('javascripts/settings/company.js',));
	    $data = array('info' => getdata("select * from manager_company where id={$id}"),);
	    $this->template->view('settings/company/form', $data);
	}
	/* END COMPANY MANAGER */
	
	public function search($what){
	    $data = array();
	    $order_by_col = "add_date";
	    $order_by_dir = "desc";
	    $fetch_col = "*";
	    $join = "";

	    switch($what){
	        case 'menu':
	            $tbl_name = "settings_menu";
	            $search_fld1 = "title";
	            $search_fld2 = "";
	            $view_page = "menu/index";
	            $data['all_menu'] = getdata("select * from {$tbl_name} where 1");
	            break;
	            
	        case 'clinic':
	            $tbl_name = "settings_clinic";
	            $search_fld1 = "name";
	            $search_fld2 = "code";
	            $view_page = "clinic/index";
	            break;
	            
	        case 'city':
	            $tbl_name = "settings_city";
	            $search_fld1 = "name";
	            $search_fld2 = "";
	            $view_page = "city/index";
	            $order_by_col = "name";
	            $order_by_dir = "asc";
	            break;
	            
	        case 'province':
	            $tbl_name = "settings_province";
	            $search_fld1 = "name";
	            $search_fld2 = "";
	            $view_page = "province/index";
	            $order_by_col = "name";
	            $order_by_dir = "asc";
	            break;

	        case 'rec_fee':
	        	/*REMOVE ACCESS RESTRICTION 02/02/2022*/
	        	// checkPageAccess('rec_fee_access', TRUE);

	            $tbl_name = "settings_recfee_hdr";
	            $search_fld1 = "pr.name";
	            $search_fld2 = "co.name";
	            $view_page = "rec_fee/index";
	            $order_by_col = "add_date";
	            $order_by_dir = "desc";
	            $fetch_col = "settings_recfee_hdr.*, pr.name as principal, co.name as company, c.name as country";
	            $join = "left join manager_principal pr
						on settings_recfee_hdr.principal_id = pr.id
						left join manager_company co
						on settings_recfee_hdr.company_id = co.id
						left join settings_country c
						on pr.country_id = c.id";
	            break;

            case 'source':
	            $tbl_name = "settings_application_source";
	            $search_fld1 = "`desc`";
	            $search_fld2 = "";
	            $view_page = "source/index";
	            $order_by_col = "desc";
	            $order_by_dir = "asc";
	            break;

            case 'agent':
	            $tbl_name = "settings_agent";
	            $search_fld1 = "fname";
	            $search_fld2 = "lname";
	            $view_page = "agent/index";
	            $order_by_col = "lname";
	            $order_by_dir = "asc";
	            break;

            case 'particulars':
	            $tbl_name = "settings_particulars";
	            $search_fld1 = "name";
	            $search_fld2 = "";
	            $view_page = "particulars/index";
	            $order_by_col = "name";
	            $order_by_dir = "asc";
	            break;

            case 'travel_agent':
	            $tbl_name = "settings_travelagent";
	            $search_fld1 = "name";
	            $search_fld2 = "";
	            $view_page = "travel_agent/index";
	            $order_by_col = "name";
	            $order_by_dir = "asc";
	            break;

            case 'airline':
	            $tbl_name = "settings_airline";
	            $search_fld1 = "name";
	            $search_fld2 = "code";
	            $view_page = "airline/index";
	            $order_by_col = "name";
	            $order_by_dir = "asc";
	            break;

            case 'payment':
	            $tbl_name = "settings_payment_method";
	            $search_fld1 = "name";
	            $search_fld2 = "";
	            $view_page = "payment/index";
	            $order_by_col = "name";
	            $order_by_dir = "asc";
	            break;

            case 'insurance':
	            $tbl_name = "settings_insurance_provider";
	            $search_fld1 = "name";
	            $search_fld2 = "";
	            $view_page = "insurance/index";
	            $order_by_col = "name";
	            $order_by_dir = "asc";
	            break;


            case 'lending':
	            $tbl_name = "settings_lending_provider";
	            $search_fld1 = "name";
	            $search_fld2 = "";
	            $view_page = "lending/index";
	            $order_by_col = "name";
	            $order_by_dir = "asc";
	            break;

            case 'branch':
	            $tbl_name = "settings_branch";
	            $search_fld1 = "desc";
	            $search_fld2 = "";
	            $view_page = "branch/index";
	            $order_by_col = "desc";
	            $order_by_dir = "asc";
	            break;
	    }

	    $this->template->set('file_javascript', array('javascripts/settings/index.js',));
	    
	    if(trim($this->input->post('textSearchInput')) != ''){
	        $q_where = "and {$search_fld1} like '%".trim($this->input->post('textSearchInput'))."%'";
	        if($search_fld2!=''){
	            $q_where .= "or {$search_fld2} like '%".trim($this->input->post('textSearchInput'))."%'";
	        }
	    }else{
	        $q_where = "";
	    }

	    $data['list'] = getdata("select {$fetch_col} from {$tbl_name} {$join} where 1 {$q_where} order by {$tbl_name}.{$order_by_col} {$order_by_dir}");
	    $this->template->view('settings/'.$view_page, $data);
	}
	
	public function edit($what, $id){
	    $data = array();
	    switch($what){
	        case 'menu':
	            $menu = getdata("select* from settings_menu order by title");
	            $menu_per_level = array();
	            foreach ($menu as $m){
	                $menu_per_level[$m['level']][$m['id']] = array('title'=>$m['title'], 'parent_id'=>$m['parent_id']);
	            }
	            
	            $data['menu_per_level'] = $menu_per_level;
	            $tbl = "settings_menu";
	            $view_page= "menu/form";
	           break;
	           
	        case 'clinic':
	            $tbl = "settings_clinic";
	            $view_page= "clinic/form";
	            break;
	    }
// 	    $this->template->set('file_javascript', array('javascripts/settings/company.js',));
	    $data['info'] = getdata("select * from {$tbl} where id={$id}");
	    $this->template->view('settings/'.$view_page, $data);
	}
	
	public function add($what){
	    $data = array();
	    switch ($what){
	        case 'menu':
	            $menu = getdata("select* from settings_menu order by title");
	            $menu_per_level = array();
	            foreach ($menu as $m){
	                $menu_per_level[$m['level']][$m['id']] = array('title'=>$m['title'], 'parent_id'=>$m['parent_id']);
	            }

	            $data['menu_per_level'] = $menu_per_level;
	            $view_page= "menu/form";
	            break;
	            
	        case 'clinic':
	            $view_page= "clinic/form";
	            break;
	    }

	    //$this->template->set('file_javascript', array('javascripts/settings/company.js',));
	    $this->template->view('settings/'.$view_page, $data);
	}

	public function save($what){
	    $this->load->model('settings_model');
	    if($id = $this->settings_model->save($what)){
	        /* UPLOAD FILES */
	        if($what == 'principal'){
	            if($_FILES){
	                $config['upload_path']         = "./uploads/principal/".$id."/";
	                $config['allowed_types']       = 'pdf|doc|PDF|docx|gif|jpg|png|jpeg|JPG|JPEG|PNG';
	                $config['max_size']            = 20480; /* 20MB */
	                
	                /* CHECK IF UPLOAD FOLDER EXIST */
	                if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);
	                
	                $this->load->library('upload', $config);
	                
	                foreach ($_FILES as $key => $f_info){
	                    if($f_info['tmp_name']){
	                        if($key == 'fileLogo'){
	                            $fld_name = "doc_logo";
	                            $config['file_name'] = "logo";
	                        }else if($key == 'fileServiceAgreement'){
	                            $fld_name = "doc_svc_agree";
	                            $config['file_name'] = "service_agreement";
	                        }else{
	                            $fld_name = "doc_rec";
	                            $config['file_name'] = "recruitment_doc";
	                        }
	                        
	                        $file_input_name = $key;
	                        $this->upload->initialize($config);
	                        
	                        if ( ! $this->upload->do_upload($file_input_name)){
	                            /* ERROR */
	                            $this->session->set_flashdata('settings_notification_status', 'Error');
	                            $this->session->set_flashdata('settings_notification', $this->upload->display_errors());
	                            redirect('settings/principal/'.$id, 'refresh');
	                        }else{
	                            /* UPDATE DB */
	                            $uploaded_file = $this->upload->data();
	                            $fld_value = $config['upload_path'].$uploaded_file['file_name'];
	                            dbsetdata("update manager_principal set {$fld_name} = '{$fld_value}' where id = {$id}");
	                        }
	                    }
	                }
	            }

	            redirect('settings/principal/'.$id, 'refresh');
	        }else if($what == 'contacts' || $what == 'jo' || $what == 'position' || $what == 'city' || $what == 'province' || $what == 'rec_fee_label' || $what == 'settings_recfee_dtl' || $what == 'source' || $what == 'agent' || $what == 'particulars' || $what == 'travel_agent' || $what == 'airline' || $what == 'payment' || $what == 'insurance' || $what == 'lending' || $what == 'branch'){
	            /* AJAX - PRINCIPAL CONTACTS/JOB OPENINGS/CITY/PROVINCE/REC FEE/SOURCE/AGENT/PARTICULARS */
                unset($_SESSION['settings_notification']);
	            echo "1";
	            exit();
	        }else if($what == 'mr'){
                if($_FILES['fileJDQ']['tmp_name']){
                    $config['upload_path']         = "./uploads/principal/".$_POST['textPrincipalId']."/mr/".$id."/";
                    $config['allowed_types']       = 'pdf|doc|PDF|docx|gif|jpg|png|jpeg|JPG|JPEG|PNG';
                    $config['max_size']            = 20480; /* 20MB */
                    $config['file_name']           = "jdq";
                    
                    /* CHECK IF UPLOAD FOLDER EXIST */
                    if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

                    $this->load->library('upload', $config);
                    $this->upload->initialize($config);

                    if ( ! $this->upload->do_upload("fileJDQ")){
                        /* ERROR */
                        echo json_encode(array('status'=>'error', 'msg'=>$this->upload->display_errors()));
                        exit();
                    }else{
                        /* UPDATE DB */
                        $uploaded_file = $this->upload->data();
                        $fld_value = $config['upload_path'].$uploaded_file['file_name'];
                        dbsetdata("update manager_mr set doc_jdq = '{$fld_value}' where id = {$id}");
                    }
                }

    	        /* AJAX - PRINCIPAL MR */
    	        echo json_encode(array('status'=>'success', 'msg'=>$_SESSION['settings_notification']));
    	        unset($_SESSION['settings_notification']);
    	        exit();
	        }else if($what == 'company'){
	            redirect('settings/company/edit/'.$id, 'refresh');
	        }else if($what == 'rec_fee_hdr'){
	        	redirect('settings/forms/rec_fee/'.$id, 'refresh');
	        }else{
	            redirect('settings/'.$what.'/'.$id, 'refresh');
	        }
	    }else{
	        if($what == 'contacts' || $what == 'jo' || $what == 'position' || $what == 'city' || $what == 'province' || $what == 'source' || $what == 'source' || $what == 'particulars' || $what == 'travel_agent' || $what == 'airline' || $what == 'branch'){
	            /* AJAX - PRINCIPAL CONTACTS/JOB OPENINGS/CITY/PROVINCE/SOURCE/AGENT/PARTICULARS */
	            unset($_SESSION['settings_notification']);
	            return false;
	            exit();
	        }else if($what == 'mr'){
	            /* AJAX - PRINCIPAL MR */
	            echo json_encode(array('status'=>'error', 'msg'=>$_SESSION['settings_notification']));
	            unset($_SESSION['settings_notification']);
	            exit();
	        }

	        redirect('settings/user', 'refresh');
	    }
	}

	/* delete record */
	public function delete($tbl, $id, $main_id=NULL){
	    $this->load->model('settings_model');
	    $this->settings_model->delete($tbl, $id);

	    switch ($tbl){
	        case 'settings_users':
	            redirect('settings/user', 'refresh');
	            break;
	        case 'manager_principal':
	            if($this->session->userdata('settings_notification_status') == 'Success'){
    	            /* DELETE PRINCIPALS'S FOLDER */
    	            $path = "./uploads/principal/".$id."/";
    	            $this->load->helper("file");
    	            delete_files($path, true , false, 1);
	            }
	            
	            redirect('settings/principal', 'refresh');
	            break;
	        case 'manager_principal_contacts':
	            redirect('settings/principal/'.$main_id, 'refresh');
	            break;
	        case 'settings_position':
	            redirect('settings/position/'.$main_id, 'refresh');
	            break;
	        case 'manager_company':
	            redirect('settings/company', 'refresh');
	            break;
	        case 'settings_menu':
	            redirect('settings/search/menu', 'refresh');
	            break;
	        case 'settings_clinic':
	            redirect('settings/search/clinic', 'refresh');
	            break;
	        case 'settings_city':
	            redirect('settings/search/city', 'refresh');
	            break;
	        case 'settings_province':
	            redirect('settings/search/province', 'refresh');
	        case 'settings_recfee_hdr':
	            redirect('settings/search/rec_fee', 'refresh');
	            break;
	        case 'settings_application_source':
	            redirect('settings/search/source', 'refresh');
	            break;
	        case 'settings_agent':
	            redirect('settings/search/agent', 'refresh');
	            break;
	        case 'settings_particulars':
	            redirect('settings/search/particulars', 'refresh');
	            break;
	        case 'settings_travelagent':
	            redirect('settings/search/travel_agent', 'refresh');
	            break;
	        case 'settings_airline':
	            redirect('settings/search/airline', 'refresh');
	            break;
	        case 'settings_payment_method':
	            redirect('settings/search/payment', 'refresh');
	            break;
	        case 'settings_insurance_provider':
	            redirect('settings/search/insurance', 'refresh');
	            break;
	        case 'settings_lending_provider':
	            redirect('settings/search/lending', 'refresh');
	            break;
	        case 'settings_branch':
	            redirect('settings/search/branch', 'refresh');
	            break;
	    }
	}
	
	public function ajax_delete(){
	    $this->load->model('settings_model');
	    $this->settings_model->delete($_GET['table'], $_GET['rec_id']);
	    
	    if($this->session->userdata('settings_notification_status') == 'Success'){
	        switch ($_GET['table']){
	            case 'manager_mr':
                    /* DELETE MR FOLDER */
	                $path = "./uploads/principal/".$_GET['principal_id']."/mr/".$_GET['rec_id']."/";
                    $this->load->helper("file");
                    delete_files($path, true , false, 1);
	                break;
	        }

	        echo "1";
	    }else{
	        return false;
	    }

	    unset($_SESSION['settings_notification']);
	    unset($_SESSION['settings_notification_status']);
	    exit();
	}
	
	public function delete_file($what, $id){
	    $table = "manager_principal";
	    if($what == 'logo'){
	        $field_name = "doc_logo";
	    }else if($what == 'svc'){
	        $field_name = "doc_svc_agree";
	    }else if($what == 'rec'){
	        $field_name = "doc_rec";
	    }else if($what == 'mr'){
	        $field_name = "doc_jdq";
	        $table = "manager_mr";
	    }
	    
	    /* DELETE FILE FROM UPLOADS FOLDER */
	    $file = getdata("select {$field_name} as filename from {$table} where id={$id}");
	    unlink($file[0]['filename']);

	    /* UPDATE DB */
	    $this->load->model('settings_model');
	    if($this->settings_model->delete_file($table, $field_name, $id)){
	        if($what == 'mr'){
	            /* AJAX */
	            echo 1;
	            exit();
	        }

	       redirect('settings/principal/edit/'.$id, 'refresh');
	    }else{
	        if($what == 'mr'){
	            /* AJAX */
	            return false;
	            exit();
	        }
	        $this->session->set_flashdata('settings_notification', 'Unable to delete file.');
	        $this->session->set_flashdata('settings_notification_status', 'Error');
	        redirect('settings/principal/'.$id, 'refresh');
	    }
	}
	
	public function check_duplicate(){
	    $table = $_GET['table'];
	    $field = $_GET['field'];
	    $value = $_GET['value'];

	    if(getdata("select id from {$table} where {$field} = '{$value}'")){
	        echo 1;
	    }else{
	        echo 0;
	    }
	    exit();
	}
	
	/*link to view files in uploads folder*/
	public function files($what, $id){
	    if($id){
	        $id= base64_decode($id);
	        $table = "manager_principal";
	        
	        if(is_numeric($id)){
	            if($what == 'logo'){
	                $field = "doc_logo";
	            }else if($what == 'svc'){
	                $field = "doc_svc_agree";
	            }else if($what == 'mr'){
	                $field = "doc_jdq";
	                $table = "manager_mr";
	            }else{
	                $field = "doc_rec";
	            }

	            $files = getdata("select {$field} as filename from {$table} where id = {$id}");
	            
	            if($files){
	                $this->load->helper('file');
	                $path_to_file = $files[0]['filename'];
	                
	                if (file_exists($path_to_file)){
	                    header('Content-Type: '.get_mime_by_extension($path_to_file));
	                    readfile($path_to_file);
	                }
	            }else{
	                return false;
	            }
	        }else{
	            return false;
	        }
	    }else{
	        return false;
	    }
	}

	public function forms($what, $record_id=NULL){
		$data = array();
		switch ($what) {
			case 'rec_fee':
				$data['current_lbl_tab'] = "";

				if($record_id){
					$data['info'] = getdata("select rf.*, p.doc_svc_agree from settings_recfee_hdr rf left join manager_principal p on rf.principal_id = p.id where rf.id = {$record_id}");

					if(!isset($data['info'][0])){
						redirect('settings/search/rec_fee', 'refresh');
					}

					$data['label'] = getdata("select * from settings_recfee_label where recfee_id = {$record_id}");

					if(isset($data['label'][0])){
						$data['current_lbl_tab'] = $data['label'][0]['id'];
					}
				}

				$this->template->set('file_javascript', array('javascripts/settings/recfee.js',));
				$tbl_name = "rec_fee/form_rec_fee";
				break;
			
			default:
				# code...
				break;
		}


	    $this->template->view('settings/'.$tbl_name, $data);
	}

	function ajax_tab($what){
	    $id = $_GET['label_id'];
	    switch ($what){
	        case 'recfee':
	            $data = getdata("select rl.*, pos.desc as position
								from settings_recfee_label rl
								left join settings_position pos
								on rl.pos_id = pos.id
								where 1 and rl.id = {$id}");

	            $particulars = getdata("select d.id, d.particular, d.charge_to, d.amount, d.remarks, p.name as particular_desc, d.add_date, d.add_by
										from settings_recfee_dtl d
										left join settings_particulars p
										on d.particular = p.id
										where 1
										and label_id = {$id}");

	            $file = "rec_fee/tab_particulars";
	            break;
	    }

	    echo $this->load->view('settings/'.$file, array('data'=>$data, 'particulars' => $particulars), TRUE);
	}

	function getPlaces(){
		$csv = BASE_URL."migration_files/places.csv";

		$aPlaces = array();
		$region = "";
		$province = "";
		$city = "";
		$brgy = "";

		$handle = fopen($csv,"r");
		while (($row = fgetcsv($handle, 10000, ",")) != FALSE){
		  	if($row[2] == 'Reg'){
		  		$region = $row[1];

				$aPlaces[$region] = array();
		  	}

		  	if($row[2] == 'Prov'){
		  		$province = $row[1];
		  		$city = "";

		  		$aPlaces[$region][$province] = array();
		  	}

		  	if($row[2] == 'Mun' || $row[2] == 'City'){
		  		$city = $row[1];
		  		$brgy = "";

		  		if($region == 'National Capital Region (NCR)'){
		  			$province = "NCR";
		  		}

		  		$aPlaces[$region][$province][$city] = array();
		  	}

		  	if($row[2] == 'Bgy'){
		  		$brgy = $row[1];
		  		$aPlaces[$region][$province][$city][] = $brgy;
		  	}
		}

		echo "<pre>";
		print_r($aPlaces);

		$this->load->database();

		// clear settings
		$this->db->query("truncate settings_region");
		$this->db->query("truncate settings_province");
		$this->db->query("truncate settings_city");
		$this->db->query("truncate settings_brgy");

		foreach($aPlaces as $rName => $p){
			// insert region here
			$query_r = $this->db->query("insert into settings_region (name,add_date, add_by) values ('".addslashes(trim($rName))."',NOW(),'system')");
			$region_id = $this->db->insert_id();

			foreach($p as $prName => $c){
				// insert province here
				$query_p = $this->db->query("insert into settings_province (region_id,name,add_date, add_by) values ('{$region_id}','".addslashes(trim($prName))."',NOW(),'system')");
				$province_id = $this->db->insert_id();

				foreach($c as $cName => $b){
					// insert city here
					$cName = str_replace("City of", "", $cName);
					$query_c = $this->db->query("insert into settings_city (name,province,region,branch_id,add_date, add_by) values ('".addslashes(trim($cName))."','{$province_id}','{$region_id}','1',NOW(),'system')");
					$city_id = $this->db->insert_id();

					foreach($b as $bName){
						// insert brgy here
						$query_c = $this->db->query("insert into settings_brgy (city_id,name,add_date, add_by) values ('{$city_id}','".addslashes(trim($bName))."',NOW(),'system')");
					}
				}
			}
		}
	}
}
