<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

    function enable_profiler($enabled = true){
        if ( !$enabled ) return false;
        get_instance()->output->enable_profiler(ENVIRONMENT == 'development');
    }

    function getdata($sql_query){
        $CI =& get_instance();
        $CI->load->database();

        $query_result = $CI->db->query($sql_query);
        return $query_result->result_array();
    }

    function getdata_for_dd($sql_query){
        $data = getdata($sql_query);
        $return_value = array();
        if($data){
            foreach($data as $v){
                $return_value[$v['id']] = $v['value'];
            }
        }

        return $return_value;
    }

    function dbsetdata($sql_query){
        $CI =& get_instance();
        $CI->load->database();
        
        $query_result = $CI->db->query($sql_query);
        return $CI->db->affected_rows();
    }

    function dbsetdata_otherdb($sql_query, $db="default"){
        $CI =& get_instance();
        $otherdb = $CI->load->database($db, TRUE);
        
        $query_result = $otherdb->query($sql_query);
        return $otherdb->affected_rows();
    }
    
    function dropdown_options($what, $curent_val=0, $show_default=1, $parent_id=NULL){
        $CI =& get_instance();
        $CI->load->database();
        
        if($show_default==1){
            $option = "<option value=\"\">--Please select</option>";
        }else{
            $option = "";
        }
        $field_key = "id";
        $field_val = "name";
        
        if(isset($_SESSION['settings'][$what])){
            $result_array = $_SESSION['settings'][$what];
        }else{
            switch ($what){
                case 'nationality':
                    $query = $CI->db->order_by('name', 'ASC')->get('settings_nationality');
                    break;
                case 'country':
                    $query = $CI->db->order_by('name', 'ASC')->get('settings_country');
                    break;
                case 'education':
                    $query = $CI->db->order_by('desc', 'ASC')->get('settings_educ_level');
                    $field_val = "desc";
                    break;
                case 'city':
                    if(!is_null($parent_id)){
                        $query = $CI->db->select('id, name')->order_by('name', 'ASC')->where_in('province', array($parent_id))->get('settings_city');
                    }else{
                        $query = $CI->db->select('id, name')->order_by('name', 'ASC')->get('settings_city');
                    }
                    break;
                case 'brgy':
                    /* BRGY */
                    $query = $CI->db->select('id, name')->order_by('name', 'ASC')->where_in('city_id', array($parent_id))->get('settings_brgy');
                    break;
                case 'province':
                    /* PROVINCE */
                    $query = $CI->db->select('id, name')->order_by('name', 'ASC')->get('settings_province');
                    break;
                case 'region':
                    /* REGION */
                    $query = $CI->db->select('id, name')->order_by('name', 'ASC')->get('settings_region');
                    break;
                case 'source':
                    $query = $CI->db->order_by('desc', 'ASC')->where('is_active', 'Y')->get('settings_application_source');
                    $field_val = "desc";
                    break;
                case 'method':
                    $query = $CI->db->order_by('desc', 'ASC')->get('settings_application_method');
                    $field_val = "desc";
                    break;
                case 'nature':
                    $query = $CI->db->order_by('desc', 'ASC')->get('settings_nature_company');
                    $field_val = "desc";
                    break;
                case 'principal':
                    $query = $CI->db->order_by('name', 'ASC')->get('manager_principal');
                    break;
                case 'company':
                    $query = $CI->db->order_by('name', 'ASC')->get('manager_company');
                    break;
                case 'users':
                    $query = $CI->db->order_by('username', 'ASC')->where_not_in('id', array(1))->get('settings_users');
                    $field_val = "username";
                    break;
                case 'users_by_name':
                    $query = $CI->db->order_by('username', 'ASC')->where_not_in('id', array(1))->get('settings_users');
                    $field_key = "username";
                    $field_val = "username";
                    break;
                case 'currency':
                    $query = $CI->db->order_by('currency_code', 'ASC')->get('settings_currency');
                    $field_val = "currency_code";
                    break;
                case 'position':
                    $query = $CI->db->order_by('desc', 'ASC')->get('settings_position');
                    $field_val = "desc";
                    break;
                case 'jobspec':
                    $query = $CI->db->order_by('desc', 'ASC')->get('settings_jobspec');
                    $field_val = "desc";
                    break;
                case 'branch':
                    $query = $CI->db->order_by('id', 'ASC')->where('is_active', 'Y')->get('settings_branch');
                    $field_val = "desc";
                    break;
                case 'clinic':
                    $query = $CI->db->order_by('name', 'ASC')->get('settings_clinic');
                    $field_val = "name";
                    break;
                case 'particulars':
                    $query = $CI->db->order_by('name', 'ASC')->get('settings_particulars');
                    $field_val = "name";
                    break;
                case 'agent':
                    $query = $CI->db->select('id,concat(lname,", ",fname," ",mname) as name')->order_by('lname', 'ASC')->where('is_active', 'Y')->get('settings_agent');
                    $field_val = "name";
                    break;
                case 'travelagent':
                    $query = $CI->db->order_by('name', 'ASC')->get('settings_travelagent');
                    $field_val = "name";
                    break;
                case 'airline':
                    $query = $CI->db->order_by('name', 'ASC')->get('settings_airline');
                    $field_val = "name";
                    break;
                case 'payment_method':
                    $query = $CI->db->order_by('name', 'ASC')->get('settings_payment_method');
                    $field_val = "name";
                    break;
                default:
                    return FALSE;
            }
        
            foreach($query->result_array()as $this_data){
                $result_array[$this_data[$field_key]] = $this_data[$field_val];
            }
        }

        foreach($result_array as $key => $val){
            if($curent_val == $key){
                $selected = "selected=\"selected\"";
            }else{
                $selected = "";
            }
            
            $option .= "<option value=\"{$key}\" {$selected}>{$val}</option>";
        }

        return $option;
    }

    // function create_log($tbl, $id, $username="applicant", $action, $remarks=""){
    function create_log($tbl, $id, $username, $action, $remarks){
        $CI =& get_instance();
        $CI->load->database();

        if(empty($username)){
            $username = "applicant";
        }
        
        switch($tbl){
            case 'user':
                $insert_tbl = "user_logs";
                break;
            default:
                $insert_tbl = "applicant_logs";
                $CI->db->set('applicant_id', $id);
                
                break;
        }

        $CI->db->set('add_by', $username);
        $CI->db->set('action', $action);
        $CI->db->set('remarks', $remarks);
        $CI->db->set('add_date', 'NOW()', FALSE);
        $CI->db->insert($insert_tbl);
    }
    
    function nameformat($fname, $mname, $lname, $format=0){
        switch($format){
            case 1:
                return ucwords(strtolower($lname)).", ".ucwords(strtolower($fname))." ".ucwords(strtolower($mname));
                break;
            case 2:
                return ucwords(strtolower($fname))." ".ucwords(strtolower($mname))." ".ucwords(strtolower($lname));
                break;
            default:
                return ucwords(strtolower($lname)).", ".ucwords(strtolower($fname))." ".ucwords(strtolower(substr($mname,0,1))).".";
        }
    }
    
    function dateformat($date, $format=1){
        if($date<>'' && $date<>'0000-00-00 00:00:00' && $date<>'0000-00-00' && $date<>'1970-01-01'){
            switch($format){
                case 0:
                    $this_date = date("Y-m-d", strtotime($date));
                    break;
                case 1:
                    $this_date = date("F d, Y", strtotime($date));
                    break;
                case 2:
                    $this_date = date("m/d/Y", strtotime($date));
                    break;
                case 3:
                    $this_date = date("F d, Y h:ia", strtotime($date));
                    break;
                case 4:
                    $this_date = date("M Y", strtotime($date));
                    break;
                case 5:
                    $this_date = date("M d, Y", strtotime($date));
                    break;
                case 6:
                    $this_date = date("M d, Y h:ia", strtotime($date));
                    break;
            }
            
            return $this_date;
        }else{
            return false;
        }
    }

    function getAge($dob){
        $condate=date("Y-m-d");
        $birthdate = new DateTime(date("Y-m-d",  strtotime(implode('-', array_reverse(explode('/', $dob))))));
        $today= new DateTime(date("Y-m-d",  strtotime(implode('-', array_reverse(explode('/', $condate))))));
        $age = $birthdate->diff($today)->y;
        return $age;
    }
    
    function get_items_from_cache($what){
        $CI =& get_instance();
        $CI->load->database();
        //$CI->load->driver('cache');
        
        if (! isset($_SESSION['settings'][$what]) ) {
        //if (! $CI->cache->memcached->get($what)) {
            switch ($what){
                case 'country':
                    $query = $CI->db->order_by('name', 'ASC')->get('settings_country');
                    $field_key = "id";
                    $field_val = "name";
                    break;
                case 'education':
                    $query = $CI->db->order_by('desc', 'ASC')->get('settings_educ_level');
                    $field_key = "id";
                    $field_val = "desc";
                    break;
                case 'nature':
                    $query = $CI->db->order_by('desc', 'ASC')->get('settings_nature_company');
                    $field_key = "id";
                    $field_val = "desc";
                    break;
                case 'principal':
                    /* GET ALL PRINCIPAL */
                    $query = $CI->db->order_by('name', 'ASC')->get('manager_principal');
                    $field_key = "id";
                    $field_val = "name";
                    break;
                case 'company':
                    $query = $CI->db->order_by('name', 'ASC')->get('manager_company');
                    $field_key = "id";
                    $field_val = "name";
                    break;
                case 'mr':
                    $query = $CI->db->order_by('code', 'ASC')->get('manager_mr');
                    $field_key = "id";
                    $field_val = "code";
                    break;
                case 'position':
                    $query = $CI->db->order_by('desc', 'ASC')->get('settings_position');
                    $field_key = "id";
                    $field_val = "desc";
                    break;
                case 'currency':
                    $query = $CI->db->order_by('currency_code', 'ASC')->get('settings_currency');
                    $field_key = "id";
                    $field_val = "currency_code";
                    break;
                case 'active_principal':
                    /* GET PRINCIPALS WITH ACTIVE MR */
                    $field_key = "id";
                    $field_val = "name";
                    $query = $CI->db->select('manager_principal.id as id, manager_principal.name as name')
                                    ->from('manager_mr')
                                    ->join('manager_principal', 'manager_principal.id = manager_mr.principal_id', 'left')
                                    ->where('manager_mr.status', 1)
                                    ->group_by('manager_principal.id')
                                    ->order_by('manager_principal.name')
                                    ->get();
                    break;
                case 'mr_per_principal':
                    return thisFunction('mr_per_principal', 'manager_mr', 'code', 'principal_id', 'and status = 1');
                    break;
                case 'company_per_principal':
                    return thisFunction('company_per_principal', 'manager_company', 'name', 'principal_id');
                    break;
                case 'mr_per_company':
                    return thisFunction('mr_per_company', 'manager_mr', 'code', 'company_id', 'and status = 1');
                    break;
                case 'payment_method':
                    $query = $CI->db->order_by('name', 'ASC')->get('settings_payment_method');
                    $field_key = "id";
                    $field_val = "name";
                    break;
                case 'branch':
                    $query = $CI->db->order_by('desc', 'ASC')->get('settings_branch');
                    $field_key = "id";
                    $field_val = "desc";
                    break;
                case 'source':
                    $query = $CI->db->order_by('desc', 'ASC')->get('settings_application_source');
                    $field_key = "id";
                    $field_val = "desc";
                    break;
            }
            
            if($query->num_rows() > 0){
                foreach($query->result_array() as $this_key => $this_data){
                    if($what == 'city' || $what == 'agent'){
                        /* NAME - CODE */
                        $value = $this_data[$field_val]." - ".$this_data[$field_val2];
                    }else{
                        $value = $this_data[$field_val];
                    }
                    
                    $finalArray[$this_data[$field_key]] = $value;
                }
            }else{
                $finalArray = array();
            }

            //$CI->cache->memcached->save($what, $finalArray, 3600); /*keep in cache for 1hr*/
            $_SESSION['settings'][$what] = $finalArray;
        }

        //return $CI->cache->memcached->get($what);
        return $_SESSION['settings'][$what];
    }
    
    /**
     * create multidimensional array 
     */
    function thisFunction($sess_id, $table, $field, $key, $and=NULL){
        /* GET DATA */
        if(!isset($_SESSION['settings'][$sess_id])){
            $raw = getdata("select * from {$table} where 1 {$and} order by {$field} asc");
            if(count($raw) > 0){
                foreach ($raw as $val){
                    $list[$val[$key]][$val['id']] = $val[$field];
                }
            }else{
                return false;
            }
            
            /* CREATE SESSION */
            $_SESSION['settings'][$sess_id] = $list;
        }
        
        return $_SESSION['settings'][$sess_id];
    }
    
    function getMaxCount($table, $id=NULL){
        $CI =& get_instance();
        $CI->load->database();
        
        $total = 0;
        if($table == 'manager_mr'){
            $total = $CI->db->where('principal_id', $id)->count_all_results($table);
        }else if($table == 'applicant_work_history'){
            $total = $CI->db->where('applicant_id', $id)->count_all_results($table);
        }else{
            //$total = $CI->db->count_all_results($table);
            $CI->db->select_max('id');
            $CI->db->from($table);
            $query = $CI->db->get();
            $r = $query->result();
            $total = $r[0]->id;
        }
        
        return $total;
    }
    
    function get_Job_Info($mr_pos_id){
        $job_info = getdata("select j.id, p.id as position_id, p.`desc`, js.`desc` as specialization, j.status as jo_status, j.mr_id, m.code as mr_ref,
                                m.status as mr_status, j.principal_id, pr.name as principal, j.company_id, co.name as company, pr.country_id, c.name as country,
                                j.target, j.required, j.salary_curr, j.salary_amt, j.allowance_type, j.allowance_amt, j.gender, j.religion, j.location, j.`desc` as job_description, j.req  as job_requirements
                                from manager_jobs j
                                left join settings_position p
                                on j.pos_id = p.id
                                left join settings_jobspec js
                                on p.jobspec_id = js.id
                                left join manager_mr m
                                on j.mr_id = m.id
                                left join manager_principal pr
                                on j.principal_id = pr.id
                                left join manager_company co
                                on j.company_id = co.id
                                left join settings_country c
                                on pr.country_id = c.id
                                where 1
                                and j.id = {$mr_pos_id}");
        if($job_info){
            /* GET PRINCIPAL CONTACTS */
            $job_info[0]['contacts'] = getdata("select * from manager_principal_contacts where principal_id  = {$job_info[0]['principal_id']}");

            return $job_info[0];
        }
    }
    
    function getMobNetwork($mob_no){
        $mob_no = str_replace(' ','',$mob_no);

        if (preg_match("/(\+63)/", $mob_no)) {
            $mob_no = preg_replace("/(\+63)/", "0", $mob_no);
        }
        
        if(strlen($mob_no)<11){
            $mob_no = "0".$mob_no;
        }

        $mob_no = substr($mob_no,0,4);
        $network_info = getdata("select * from settings_network_prefix where number = '{$mob_no}'");
        if($network_info){
            return $network_info[0]['code'];
        }else{
            return false;
        }
    }
    
    function flashNotification(){
        $CI =& get_instance();
        $message = $CI->session->flashdata('settings_notification');
        $status = $CI->session->flashdata('settings_notification_status');
        $status_class = ($CI->session->flashdata('settings_notification_status')=='Success')?"success":"danger";
        if($CI->session->flashdata('settings_notification')){
            echo "<div class=\"alert alert-{$status_class}\">
                    <button type=\"button\" class=\"close\" data-dismiss=\"alert\" aria-hidden=\"true\">×</button>
                    <strong>{$status}!</strong> {$message}
                </div>";
        }
    }

    function checkDuplicate($tbl_name, $fld_name, $value){
        $duplicate = getdata("select * from {$tbl_name} where {$fld_name} = '{$value}'");
        return count($duplicate);
    }

    function checkExpiry($date){
        $status = "";
        if(dateformat($date)){
            if(strtotime("today") > strtotime($date)){
                $status = "Expired";
            }else{
                $status = "Valid";
            }
        }
        
        return $status;
    }

    function getDateDiff($thisDate, $what = "year"){
        $time_now = time();
        $thisDate = strtotime($thisDate);
        $age = ($thisDate < 0) ? ( $time_now + ($thisDate * -1) ) : $time_now - $thisDate;
        switch (strtolower($what)) {
            case "day":
                return floor($age / 86400);
                break;
            case "week":
                return floor($age / 604800);
                break;
            case "month":
                return floor($age / 2419200);
                break;
            case "year":
                return floor($age / 31536000);
                break;
            case "decade":
                return floor($age / 315360000);
                break;
            default:
                return "date not set.";
        }
    }

    function generateMRRef($principal_id){
        $max_mr = getdata("select COUNT(id) as total_mr from manager_mr where principal_id = {$principal_id}");
        $principal_info = getdata("select code from manager_principal where id = {$principal_id}");
        return $principal_info[0]['code']."-".str_pad((intval($max_mr[0]['total_mr'])+1), 4, "0", STR_PAD_LEFT);
    }

    /*IF PRINCIPAL CODE DOES NOT EXIST*/
    function generateMRCode(){
        $year = date("y");
        $max_mr = getdata("select MAX(SUBSTRING(code, 4, 4)) as last_code from manager_mr where SUBSTRING(code, 1, 2) = {$year}");
        return $year."-".str_pad((intval($max_mr[0]['last_code'])+1), 4, "0", STR_PAD_LEFT);
    }

    /**
     * get INTERNAL/APPLICANT advisory
     */
    function getAdvisory($ids){
        $all_adv = array();
        
        if(count($ids) > 0){
            $ids = array_unique($ids);
            $ids = implode(",",$ids);

            $q = "select * from applicant_comm
                where 1
                and type in ('internal','applicant')
                and applicant_id in ({$ids})
                order by add_date desc";
            $r = getdata($q);

            if($r){
                foreach ($r as $info){
                    $all_adv[$info['applicant_id']][$info['type']][$info['id']] = $info;
                }
            }
        }

        return $all_adv;
    }

    /**
     * check if user have access
     * @param $access access-config item
     * @param $redirect redirect to dashboard if true
     */
    function checkPageAccess($access=NULL, $redirect=FALSE){
        $CI =& get_instance();
        if($CI->config->item($access)){
            if(!in_array(strtolower($_SESSION['rs_user']['username']), $CI->config->item($access))){
                if($redirect){
                    redirect('home/dashboard', 'refresh');
                }else{
                    return false;
                }
            }else{
                return true;
            }
        }
    }

    /**
    *   generate options from array
    *   @param $options
    *   @param $selected selected value
    *   @param $use_default_key use array key as default value if true
    *   @param $show_default add empty option
    */
    function generate_dd($options=array(), $selected=NULL, $use_default_key=TRUE, $show_default=TRUE){
        $html = "";

        if($show_default){
            $html .= "<option value=\"\">Please select</option>";
        }

        if(count($options) > 0){
            foreach($options as $k => $v){
                $option_text = $v;

                if($use_default_key){
                    $option_value = $k;
                }else{
                    $option_value = $option_text;
                }

                if(!is_null($selected) && $selected == $option_value){
                    $is_selected = "selected=\"selected\"";
                }else{
                    $is_selected = "";
                }

                $html .= "<option value=\"{$option_value}\" {$is_selected}>{$option_text}</option>";
            }
        }

        echo $html;
    }

    function upload_file($file_input, $upload_path, $filename){
        if(isset($_FILES[$file_input]) && $_FILES[$file_input]['tmp_name']){
            $config['upload_path']         = $upload_path;
            $config['allowed_types']       = 'pdf|doc|PDF|docx|gif|jpg|png|jpeg|JPG|JPEG|PNG';
            $config['max_size']            = 20480; /* 20MB */
            $config['file_name']           = $filename;

            /* CHECK IF UPLOAD FOLDER EXIST */
            if(!is_dir($config['upload_path'])) mkdir($config['upload_path'], 0777, TRUE);

            $CI =& get_instance();
            $CI->load->library('upload', $config);
            $CI->upload->initialize($config);

            if($CI->upload->do_upload($file_input)){
                return $CI->upload->data();
            }else{
                return $CI->upload->display_errors();
            }
        }else{
            return false;
        }
    }

    function moneyformat($amount=0){
        return number_format((float)$amount, 2, '.', '');
    }

    function getInitialRequirements($applicant_id){
        $submittted = array('PEOS Certificate' => FALSE,
                            'PEOS' => FALSE,
                            'POEA E-Registration' => FALSE,
                            'E-REG' => FALSE,
                            'Passport' => FALSE,
                            /*'Resume/CV' => FALSE,*/
                            'NBI Clearance' => FALSE,
                            'Education' => FALSE,
                            'Employment' => FALSE);

        /*check applicant's uploaded file*/
        $uploads = getdata("select * from applicant_uploads where description in ('PEOS Certificate','PEOS','POEA E-Registration','E-REG','Passport','Resume/CV','NBI Clearance') and applicant_id = {$applicant_id}");
        if($uploads){
            foreach($uploads as $f){
                if(array_key_exists($f['description'], $submittted)){
                    if($f['filename'] <> '' || $f['serial_no'] <> ''){
                        $submittted[$f['description']] = TRUE;
                    }
                }
            }
        }
        
        /*get education info*/
        $educ = getdata("select * from applicant_education where applicant_id = {$applicant_id}");
        if($educ){
            foreach($educ as $e){
                if($e['school_name'] <> '' || $e['location'] <> ''){
                    $submittted['Education'] = TRUE;
                }
            }
        }

        $gen_info = getdata("select is_freshgrad from applicant_general_info where id = {$applicant_id}");
        if($gen_info[0]['is_freshgrad'] == 'Y'){
            $submittted['Employment'] = TRUE;
        }else{
            /*get employment info*/
            $work = getdata("select * from applicant_work_history where applicant_id = {$applicant_id}");
            if($work){
                foreach($work as $w){
                    if($w['company_name'] <> '' || $w['position'] <> ''){
                        $submittted['Employment'] = TRUE;
                    }
                }
            }
        }

        return $submittted;
    }

    function send_email($data){
        if($data['recipient'] <> ''){
            $CI =& get_instance();
            $CI->load->library('email');
            $CI->email->set_newline("\r\n");
            $CI->email->set_mailtype("html");
            $CI->email->from($data['from_email'], $data['from_name']);
            $CI->email->to($data['recipient']);
            $CI->email->subject($data['subject']);
            $CI->email->message($data['message']);

            if(!$CI->email->send()){
                // echo $CI->email->print_debugger();
                // exit();
                return 0;
            }else{
                return 1;
            }
        }else{
            return 0;
        }
    }

    function send_sms($msg_data = array()){
        switch(SMS_PROVIDER){
            case 'local':
                $recipient = $msg_data['mobile_no'];
                $message = urlencode($msg_data['message']);
                $url = "http://130.105.85.43:8585/sendsms?username={$this->sms_username}&password={$this->sms_password}&phonenumber={$recipient}&message={$message}";
                $result = file_get_contents($url);
                // var_dump($result);
                break;

            case 'globe':
                $url = SMS_SENDING_URL.$msg_data['token'];

                $data = array(
                    'address'  => $msg_data['mobile_no'],
                    'message'  => $msg_data['message'],
                );

                $options = array(
                    'http' => array(
                        'method'  => 'POST',
                        'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                        'content' => http_build_query($data),
                    )
                );

                $context  = stream_context_create( $options );
                if($result = file_get_contents( $url, false, $context )){
                    return 1; //SENT
                }else{
                    return 2; //RE-SEND
                }

                break;
        }
    }

    function save_sms_outbox($msg_data = array('status' => 0)){
        $return_status = "success";
        $return_message = "Your message will be sent shortly.";

        if(trim($msg_data['message']) <> ''){
            if(is_numeric($msg_data['mobile_no'])){
                dbsetdata("SET time_zone = '+8:00'");

                /*LIMIT STRING CHARACTERS*/
                $string =  str_split($msg_data['message'], SMS_CHAR_LIMIT);
                $applicant_id = $msg_data['applicant_id'];

                $n = 1;
                foreach($string as $v){
                    $part_no = $n."/".count($string);

                    if(dbsetdata("insert into applicant_sms_outbox (applicant_id, sender, recipient, message, status, part_no, add_date, add_by ) values ({$applicant_id}, '{$_SESSION['rs_user']['username']}', '{$msg_data['mobile_no']}', '".addslashes($v)."', '{$msg_data['status']}', '{$part_no}', NOW(), '{$_SESSION['rs_user']['username']}')")){
                        /*SUCCESS*/
                    }else{
                        /*ERROR*/
                        $return_message = "Unable to send message.";
                        $return_status = "error";
                        break;
                    }

                    $n++;
                }
            }else{
                $return_message = "Invalid mobile no.";
                $return_status = "error";
            }
        }else{
            $return_message = "Message cannot be empty.";
            $return_status = "error";
        }

        echo json_encode(array('status'=>$return_status, 'message'=>$return_message));
    }