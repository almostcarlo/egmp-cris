<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_recruitment extends MY_Controller{

	public $fee_cond = array(1=>'No Placement Fee', 2=>'Salary Deduction', 3=>'Others');

    public function __construct(){
        parent::__construct();
        
        $this->load->helper(array('text'));
    }
    
	public function index($what){
		switch ($what) {
			default:
				$data = $this->fetch_raw_data('project_distribution');
				break;
		}

	    $this->template->view('reports/recruitment/'.$what.'_index', $data);
	}
	
	public function print_report($what){
		switch ($what) {
			case 'lineup_monitor':
				$data = $this->fetch_raw_data($what);
				break;
			case 'mr_summary':
				$data = $this->fetch_raw_data($what);
				break;
			case 'interview_lineup':
				$data = $this->fetch_raw_data($what);
				$this->load->view('reports/recruitment/'.$what.'_print', $data);
				return true;
				break;

			case 'encoded_applicants':
				$data = $this->fetch_raw_data($what);
				$this->load->view('reports/recruitment/'.$what.'_print', $data);
				return true;
				break;

			case 'mr_balance':
				$data = $this->fetch_raw_data($what);
				$this->load->view('reports/recruitment/'.$what.'_print', $data);
				return true;
				break;

			case 'mr_closing':
				$data = $this->fetch_raw_data($what);
				$this->load->view('reports/recruitment/'.$what.'_print', $data);
				return true;
				break;

			default:
				$data = $this->fetch_raw_data('project_distribution');
				break;
		}

	    $this->template->set_template('template_print');
	    $this->template->view('reports/recruitment/'.$what.'_print', $data);
	}

	public function fetch_raw_data($what){
	    if($what == 'project_distribution'){
	        $info = getdata("select m.id, m.code, m.activity, p.name as principal, c.name as company, u.username as rs_user, l.id as lineup_id, cn.name as country, m.add_date
                            from manager_mr m
                            left join manager_principal p
                            on m.principal_id = p.id
                            left join manager_company c
                            on m.company_id = c.id
                            left join settings_users u
                            on m.rs = u.id
                            left join applicant_lineup l
                            on m.id = l.manpower_id
                            left join settings_country cn
                            on p.country_id = cn.id
                            where 1
                            and m.status = 1");
	        $list_mr = array();
	        $list_lineup = array();
	        if($info){
	            foreach ($info as $i){
	                $list_mr[$i['rs_user']][$i['id']] = array('mr_ref' => $i['code'],
	                    'principal' => $i['principal'],
	                    'company' => $i['company'],
	                    'activity' => $i['activity'],
	                    'country' => $i['country'],
	                    'add_date' => $i['add_date'],
	                );
	                
	                if($i['lineup_id'] != ''){
	                    $list_lineup[$i['id']][$i['lineup_id']] = $i['lineup_id'];
	                }
	            }
	        }

	        return array('list_mr' => $list_mr, 'list_lineup' => $list_lineup, 'report_title' => 'Project Distribution Report');
	    }else if($what == 'lineup_monitor'){
	    	if($_POST['SelectStat'] == 1){
	    		$mr_id = $_POST['SelectMRC'];
	    	}else{
	    		$mr_id = $_POST['SelectMRT'];
	    	}

	    	if($_POST['selectSched'] <> ''){
				$q_sched = " and id = {$_POST['selectSched']}";
				$q_lineup_sched = " and (interview_sched_id = {$_POST['selectSched']} or interview_sched_id is null)";
	    	}else{
	    		//$q_sched = " and interview_date >= '".date("Y-m-d", strtotime("-3 days"))." 00:00:00'";
	    		$q_sched = "";
	    		$q_lineup_sched = "";
	    	}

	    	$mr_info = getdata("select mr.code as mr_ref, u.username as rs
								from manager_mr mr
								left join settings_users u
								on mr.rs = u.id
								where mr.id = {$mr_id}");

	    	$list_sched = getdata("select * from manager_interview_schedule
	    							where mr_id = {$mr_id}
	    							{$q_sched}");

	    	$list_pos = getdata("select j.id, j.required, pos.desc as position
								from manager_jobs j
								left join settings_position pos
								on j.pos_id = pos.id
								where 1
								and j.mr_id = {$mr_id}
								and j.status = 1");

	    	$list_lineup = array();
	    	$lineup = getdata("select l.id, l.applicant_id, i.fname, i.mname, i.lname, i.mobile_no, i.status, l.mr_pos_id, l.mob_result, l.interview_sched_id, l.interview_confirmed, i.last_reporting_date, s.interview_date, l.add_date
								from applicant_lineup l
								left join applicant_general_info i
								on l.applicant_id = i.id
								left join manager_interview_schedule s
								on l.interview_sched_id = s.id
								where l.manpower_id = {$mr_id}
								and (l.lineup_status is null OR l.lineup_status not in ('Selected','Rejected','Standby'))
								and i.status in ('ON POOL','ACTIVE','RESERVED')
								and l.mob_result in ('AV','CR')
								{$q_lineup_sched}");

	    	$app_ids = array();
	    	if($lineup){
	    		foreach($lineup as $l){
	    			if($l['interview_confirmed'] == 'Y' && $l['interview_sched_id'] <> ''){
	    				/*CONFIRMED LINEUP*/
	    				$list_lineup['CL'][$l['mr_pos_id']][$l['id']] = $l;
	    				array_push($app_ids, $l['applicant_id']);

	    				/*WALK-IN*/
	    				if(strtotime(dateformat($l['add_date'])) == strtotime(dateformat($l['interview_date']))){
		    				$list_lineup['WI'][$l['mr_pos_id']][$l['id']] = $l;
		    			}else{
			    			/*REPORTED CL*/
			    			if(strtotime(dateformat($l['last_reporting_date'])) == strtotime(dateformat($l['interview_date']))){
			    				$list_lineup['RP'][$l['mr_pos_id']][$l['id']] = $l;
			    			}
		    			}
	    			}else{
	    				if($l['mob_result'] == 'CR'){
	    					/*FINAL LINEUP*/
	    					$list_lineup['FL'][$l['mr_pos_id']][$l['id']] = $l;
	    					array_push($app_ids, $l['applicant_id']);
	    				}else if($l['mob_result'] == 'AV'){
	    					/*INITIAL LINEUP*/
	    					$list_lineup['IL'][$l['mr_pos_id']][$l['id']] = $l;
	    					array_push($app_ids, $l['applicant_id']);
	    				}
	    			}
	    		}
	    	}

			if(isset($_POST['btn_excel'])){
                $excel = TRUE;
            }else{
                $excel = FALSE;
            }

	        return array('mr_info' => $mr_info, 'list_sched' => $list_sched, 'list_pos' => $list_pos, 'list_lineup' => $list_lineup, 'excel' => $excel, 'all_adv' => getAdvisory($app_ids));
	    }else if($what == 'mr_summary'){
	    	$mr_info = getdata("select mr.code as mr_ref, u.username as rs, p.name as principal, c.name as country, mr.rec_date, mr.expiry_date, mr.contract_duration, mr.allowance, mr.food, mr.transpo, mr.accomodation, mr.work_hrs, mr.others, mr.ticket, mr.fee_condition, mr.add_by
								from manager_mr mr
								left join settings_users u
								on mr.rs = u.id
								left join manager_principal p
								on mr.principal_id = p.id
								left join settings_country c
								on p.country_id = c.id
								where mr.id = {$_POST['SelectMR']}");

	    	$list_pos = getdata("select j.id, j.required, pos.desc as position, j.desc as jobdesc, j.target as qty, c.currency_code, j.salary_amt
								from manager_jobs j
								left join settings_position pos
								on j.pos_id = pos.id
								left join settings_currency c
								on j.salary_curr = c.id
								where 1
								and j.mr_id = {$_POST['SelectMR']}
								and j.status = 1");

			if(isset($_POST['btn_excel'])){
                $excel = TRUE;
            }else{
                $excel = FALSE;
            }

	        return array('mr_info' => $mr_info, 'list_pos' => $list_pos, 'excel' => $excel);
	    }else if($what == 'interview_lineup'){
	    	if($_POST['selectSched'] <> ''){
				$q_sched = " and id = {$_POST['selectSched']}";
				$q_lineup_sched = " and (interview_sched_id = {$_POST['selectSched']} or interview_sched_id is null)";
	    	}else{
	    		//$q_sched = " and interview_date >= '".date("Y-m-d", strtotime("-3 days"))." 00:00:00'";
	    		$q_sched = "";
	    		$q_lineup_sched = "";
	    	}

	    	$mr_info = getdata("select mr.code as mr_ref, u.username as rs, p.name as principal, c.name as country, mr.rec_date, mr.expiry_date
								from manager_mr mr
								left join settings_users u
								on mr.rs = u.id
								left join manager_principal p
								on mr.principal_id = p.id
								left join settings_country c
								on p.country_id = c.id
								where mr.id = {$_POST['SelectMR']}");

	    	$list_sched = getdata("select * from manager_interview_schedule
	    							where mr_id = {$_POST['SelectMR']}
	    							{$q_sched}");

	    	$list_pos = getdata("select j.id, j.required, pos.desc as position, concat(c.currency_code,' ',j.salary_amt) as salary
								from manager_jobs j
								left join settings_position pos
								on j.pos_id = pos.id
								left join settings_currency c
								on j.salary_curr = c.id
								where 1
								and j.mr_id = {$_POST['SelectMR']}
								and j.status = 1");

	    	$list_lineup = array();
	    	$list_selected = array();

	    	$lineup = getdata("select l.id, l.applicant_id, i.fname, i.mname, i.lname, i.mobile_no, i.status, l.mr_pos_id, l.mob_result, l.interview_sched_id, l.interview_confirmed, i.last_reporting_date, s.interview_date, s.venue, l.add_date, l.add_by, l.lineup_status, l.mob_result, l.mob_remarks, i.gender
								from applicant_lineup l
								left join applicant_general_info i
								on l.applicant_id = i.id
								left join manager_interview_schedule s
								on l.interview_sched_id = s.id
								where 1
								and l.applicant_id <> 0
								and l.manpower_id = {$_POST['SelectMR']}
								{$q_lineup_sched}");

	    	$app_ids = array();
	    	if($lineup){
	    		foreach($lineup as $l){
	    			$list_lineup[$l['mr_pos_id']][$l['id']] = $l;

	    			if($l['lineup_status'] == 'Selected'){
	    				$list_selected[$l['mr_pos_id']][$l['id']] = $l['applicant_id'];
	    			}
	    		}
	    	}

			if(isset($_POST['btn_excel'])){
                $excel = TRUE;
            }else{
                $excel = FALSE;
            }

	        return array('mr_info' => $mr_info, 'list_sched' => $list_sched, 'list_pos' => $list_pos, 'list_lineup' => $list_lineup, 'list_selected' => $list_selected, 'excel' => $excel);
	    }else if($what == 'encoded_applicants'){
	    	if($_POST['textStDate'] == '' || $_POST['textEnDate'] == ''){
	    		$q_date = "and (i.add_date >= '".date("Y-m-01 00:00:00")."' and i.add_date <= '".date("Y-m-d 23:59:59")."')";
	    	}else{
	    		$q_date = "and (i.add_date >= '".date("Y-m-d 00:00:00", strtotime($_POST['textStDate']))."' and i.add_date <= '".date("Y-m-d 23:59:59", strtotime($_POST['textEnDate']))."')";
	    	}

	    	if($_POST['SelectSource'] <> ''){
	    		$q_source = "and i.application_source = {$_POST['SelectSource']}";
	    	}else{
	    		$q_source = "";
	    	}

	    	$list = getdata("select i.id, i.fname, i.mname, i.lname, i.gender, i.add_date, i.add_by, s.`desc` as source, b.`desc` as location, p.position
							from applicant_applied_pos p
							left join applicant_general_info i
							on p.applicant_id = i.id
							left join settings_application_source s
							on i.application_source = s.id
							left join settings_branch b
							on i.branch_id = b.id
							where 1
							and i.add_by <> 'applicant'
							{$q_date}
							{$q_source}
							order by i.lname asc");

			if(isset($_POST['btn_excel'])){
                $excel = TRUE;
            }else{
                $excel = FALSE;
            }

	        return array('excel' => $excel, 'list' => $list);
	    }else if($what == 'mr_balance'){
	    	$mr_info = array();
	    	$pos_info = array();
	    	$lineup = array();
	    	$deployed = array();

	    	if($_POST['SelectMR'] <> ''){
		    	$mr_info = getdata("select mr.id, pr.name as principal, mr.code as mr_ref, mr.rec_date, mr.expiry_date, mr.project, c.name as country
									from manager_mr mr
									left join manager_principal pr
									on mr.principal_id = pr.id
									left join settings_country c
									on pr.country_id = c.id
									where 1
									and mr.id = {$_POST['SelectMR']}");

		    	$lineup_info = getdata("select j.id, pos.`desc` as position, j.required, cu.currency_code, j.salary_amt, l.applicant_id, l.is_deployed
										from manager_jobs j
										left join settings_position pos
										on j.pos_id = pos.id
										left join settings_currency cu
										on j.salary_curr = cu.id
										left join applicant_lineup l
										on j.id = l.mr_pos_id
										where j.mr_id = {$_POST['SelectMR']}
										order by pos.desc asc");

		    	if($lineup_info && count($lineup_info) > 0){
		    		foreach($lineup_info as $l){
		    			$pos_info[$l['id']] = array('position' => $l['position'],
		    										'required' => $l['required'],
		    										'salary' => trim($l['currency_code']." ".$l['salary_amt']),);

		    			/*GET TOTAL LINEUP*/
		    			if($l['applicant_id'] <> 0){
		    				$lineup[$l['id']][$l['applicant_id']] = $l['applicant_id'];

			    			/*GET DEPLOYED*/
			    			if($l['is_deployed'] == 'Y'){
			    				$deployed[$l['id']][$l['applicant_id']] = $l['applicant_id'];
			    			}
		    			}
		    		}
		    	}
	    	}

			if(isset($_POST['btn_excel'])){
                $excel = TRUE;
            }else{
                $excel = FALSE;
            }

	        return array('excel' => $excel, 'mr_info' => $mr_info, 'pos_info' => $pos_info, 'lineup' => $lineup, 'deployed' => $deployed);
	    }else if($what == 'mr_closing'){
	    	$mr_info = array();
	    	$pos_info = array();
	    	$lineup = array();
	    	$lineup_per_stat = array();
	    	$deployed = array();

	    	if($_POST['SelectMR'] <> ''){
		    	$mr_info = getdata("select mr.id, pr.name as principal, mr.code as mr_ref, mr.rec_date, mr.expiry_date, mr.project, c.name as country
									from manager_mr mr
									left join manager_principal pr
									on mr.principal_id = pr.id
									left join settings_country c
									on pr.country_id = c.id
									where 1
									and mr.id = {$_POST['SelectMR']}");

		    	$lineup_info = getdata("select j.id, pos.`desc` as position, j.required, cu.currency_code, j.salary_amt, l.id as lineup_id, l.applicant_id, l.is_deployed, l.lineup_status, l.lineup_acceptance
										from manager_jobs j
										left join settings_position pos
										on j.pos_id = pos.id
										left join settings_currency cu
										on j.salary_curr = cu.id
										left join applicant_lineup l
										on j.id = l.mr_pos_id
										where j.mr_id = {$_POST['SelectMR']}
										order by pos.desc asc");

		    	if($lineup_info && count($lineup_info) > 0){
		    		foreach($lineup_info as $l){
		    			$pos_info[$l['id']] = array('position' => $l['position'],
		    										'required' => $l['required'],
		    										'salary' => trim($l['currency_code']." ".$l['salary_amt']),);

		    			/*GET TOTAL LINEUP*/
		    			if($l['applicant_id'] <> 0){
		    				$lineup[$l['lineup_id']] = $l['applicant_id'];

			    			/*GET DEPLOYED*/
			    			if($l['is_deployed'] == 'Y'){
			    				$deployed[$l['lineup_id']] = $l['applicant_id'];

			    				$lineup_per_stat['Deployed'][$l['lineup_id']] = $l['applicant_id'];
			    			}else{
				    			if($l['lineup_status'] == 'Selected' && $l['lineup_acceptance'] == 'Accepted'){
				    				/*ACCEPTED*/
				    				$lineup_per_stat['Accepted'][$l['aplineup_idplicant_id']] = $l['applicant_id'];
				    			}else if($l['lineup_acceptance'] == 'Declined'){
				    				/*DECLINED*/
				    				$lineup_per_stat['Decline'][$l['lineup_id']] = $l['applicant_id'];
				    			}else if($l['lineup_status'] == 'Rejected'){
				    				/*REJECTED*/
				    				$lineup_per_stat['Not Selected'][$l['lineup_id']] = $l['applicant_id'];
				    			}else if($l['lineup_status'] == 'Standby'){
				    				/*ON-HOLD*/
				    				$lineup_per_stat['On-hold'][$l['lineup_id']] = $l['applicant_id'];
				    			}else{
				    				$lineup_per_stat[$l['lineup_status']][$l['lineup_id']] = $l['applicant_id'];
				    			}
			    			}
		    			}
		    		}
		    	}
	    	}

			if(isset($_POST['btn_excel'])){
                $excel = TRUE;
            }else{
                $excel = FALSE;
            }

	        return array('excel' => $excel, 'mr_info' => $mr_info, 'pos_info' => $pos_info, 'lineup' => count($lineup), 'deployed' => count($deployed), 'lineup_per_stat' => $lineup_per_stat);
	    }
	}

	public function forms($what){
	    $data = array();

	    switch($what){
	        case 'lineup_monitor':
	            $form_name = "lineup_monitor_index";

				$mr_list = getdata("select i.mr_id, i.status, mr.code as mr_ref, pr.name as principal, i.interview_date
									from manager_interview_schedule i
									left join manager_mr mr
									on i.mr_id = mr.id
									left join manager_principal pr
									on mr.principal_id = pr.id
									where 1
									and i.interview_date >= '".date("Y-m-d", strtotime("-3 days"))." 00:00:00'
									order by i.interview_date asc");
				if($mr_list){
					foreach($mr_list as $i){
						$data['mr_list'][$i['status']][$i['mr_id']] = array('mr_ref'=>$i['mr_ref'], 'principal'=>$i['principal']);
					}
				}
	            break;

	        case 'interview_lineup':
	            $form_name = "interview_lineup_index";
				$mr_list = getdata("select i.mr_id, i.status, mr.code as mr_ref, pr.name as principal, i.interview_date
									from manager_interview_schedule i
									left join manager_mr mr
									on i.mr_id = mr.id
									left join manager_principal pr
									on mr.principal_id = pr.id
									where 1
									and i.interview_date >= '".date("Y-m-d", strtotime("-7 days"))." 00:00:00'
									order by i.interview_date asc");
				if($mr_list){
					foreach($mr_list as $i){
						$data['mr_list'][$i['mr_id']] = array('mr_ref'=>$i['mr_ref'], 'principal'=>$i['principal']);
					}
				}

	            break;

            case 'mr_summary':
            	$form_name = "mr_summary_index";

				$mr_list = getdata("select m.id, m.code as mr_ref, p.name as principal
									from manager_jobs j
									left join manager_mr m
									on j.mr_id = m.id
									left join manager_principal p
									on m.principal_id = p.id
									where 1
									and m.status = 1
									and j.status = 1
									order by p.name asc");
				if($mr_list){
					foreach($mr_list as $i){
						$data['mr_list'][$i['id']] = array('mr_ref'=>$i['mr_ref'], 'principal'=>$i['principal']);
					}
				}
	            break;

            case 'encoded_applicants':
            	$form_name = "encoded_applicants_index";
	            break;

            case 'mr_balance':
            	$form_name = "mr_balance_index";
				$data['mr_list'] = get_items_from_cache('mr');
	            break;

            case 'mr_closing':
            	$form_name = "mr_closing_index";
				$data['mr_list'] = get_items_from_cache('mr');
	            break;
	    }

	    $this->template->view('reports/recruitment/'.$form_name, $data);
	}

	public function ajax($action){
		$return_value = "";
		switch($action){
			case 'get_interview_sched':
				$return_value = "<option value=\"\">All</option>";
				$sched = getdata('select * from manager_interview_schedule where mr_id='.$_GET['id'].' order by interview_date asc');
				if(count($sched > 0)){
					foreach($sched as $i){
						$return_value .= "<option value=\"{$i['id']}\">".dateformat($i['interview_date'])." - ".$i['venue']."</option>";
					}
				}
				break;
		}

		echo $return_value;
		exit();
	}
}
