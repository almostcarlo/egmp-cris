<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Processing extends MY_Controller{

    public $arabic_date = array('01'=>'Muharram (01)','02'=>'Safar (02)','03'=>"Rabi' I (03)",'04'=>"Rabi' II (04)",'05'=>'Jumada I (05)','06'=>'Jumada II (06)','07'=>'Rajab (07)','08'=>"Sha'aban (08)",
                                '09'=>'Ramadan (09)','10'=>'Shawwal (10)','11'=>"Dhu al-Qi'dah (11)",'12'=>'Dhu al-Hijjah (12)');

	public function index(){
	    //$this->search();
	    redirect('home/dashboard', 'refresh');
	}

	public function search($what=NULL, $id=NULL){
	    $this->template->set('file_javascript', array('javascripts/processing/index.js',));
	    $data = array();

	    if(trim($this->input->post('textSearch')) != ''){
	        if($what == 'visa'){
	            $q_where = "and (v.visa_no like '%".trim($this->input->post('textSearch'))."%' or p.name like '%".trim($this->input->post('textSearch'))."%')";
	        }else if($what == 'poea'){
	            $q_where = "and (po.accre_no like '".trim($this->input->post('textSearch'))."%' or p.name like '".trim($this->input->post('textSearch'))."%')";
	        }else if($what == 'lpt' || $what == 'pta'){
	        	$q_where = "and l.code like '".trim($this->input->post('textSearch'))."%'";
	        }

	        $q_limit = "";
	    }else{
	        $q_where = "";
	        /* limit to last 100 record */
	        $q_limit = "limit 100";
	    }

	    switch($what){
	        case 'visa':
	            $data['arabic_date'] = $this->arabic_date;
	            $data['list'] = getdata("select p.name as principal, v.id, v.visa_no, v.visa_date, v.visa_date_arabic, v.expiry_date
	                from manager_visa v
	                left join manager_principal p
	                on v.principal_id = p.id
	                where 1
	                {$q_where}
	                order by v.add_date desc
	                {$q_limit}");
	            $form_name = "visa_index";
	            break;

            case 'transmittal':
	            $data['list'] = getdata("select  * from manager_visa_transmittal where visa_id = {$id}");
	            $data['visa_info'] = getdata("select * from manager_visa where id = {$id}");
	            $form_name = "visa_transmittal_index";

	            if(!$data['visa_info']){
	            	redirect('processing/search/visa', 'refresh');
	            }

	            break;

            case 'transmittal_alloc':
            	$data['visa_info'] = getdata("select vt.id as transmittal_id, vt.transmittal_no, vt.transmittal_date, vt.visa_id, v.*, p.name as principal, c.name as country
											from manager_visa_transmittal vt
											left join manager_visa v
											on vt.visa_id = v.id
											left join manager_principal p
											on v.principal_id = p.id
											left join settings_country c
											on p.country_id = c.id
											where vt.id = {$id}");

            	$data['alloc_info'] = getdata("select ap.id as applicant_processing_id, ap.applicant_id, i.fname, i.mname, i.lname, l.manpower_id, mr.code as mr_ref, vp.position as approved_cat, ap.transmittal_ecode, ap.transmittal_auth, ap.transmittal_submit_date, ap.transmittal_release_date
											from applicant_processing ap
											left join applicant_general_info i
											on ap.applicant_id = i.id
											left join applicant_lineup l
											on i.lineup_id = l.id
											left join manager_mr mr
											on l.manpower_id = mr.id
											left join manager_visa_pos vp
											on ap.request_approved_cat = vp.id
											where 1
											and ap.transmittal_no='{$data['visa_info'][0]['transmittal_no']}'");

            	$data['arabic_date'] = $this->arabic_date;
            	$form_name = "visa_trans_alloc_index";
	            break;
	            
	        case 'poea':
	            $data['list'] = getdata("select p.name as principal, po.id, po.accre_no, po.issue_date, po.expiry_date
                        	            from manager_poea po
                        	            left join manager_principal p
                        	            on po.principal_id = p.id
                        	            where 1
                        	            {$q_where}
                        	            order by po.add_date desc
                        	            {$q_limit}");
	            $form_name = "poea_index";
	            break;
	            
	        case 'jo_pos':
	            $this->template->set('file_javascript', array('javascripts/processing/index.js','javascripts/processing/jo_pos.js'));
	            $data['hdr_info'] = getdata("select mp.id as poea_id, jo.id as poea_jo_id, p.name as principal, mp.accre_no, mp.issue_date, mp.expiry_date, jo.jo_id, jo.jo_ref, jo.approved_date, jo.submit_date
                                            from manager_poea mp
                                            left join manager_poea_jo jo
                                            on mp.id = jo.poea_id
                                            left join manager_principal p
                                            on mp.principal_id = p.id
                                            where 1
                                            and jo.id = {$id}");

	            /*GET JO POSITION/ALLOCATIONS*/
	            $pos_list = getdata("select jpos.id, jpos.position, jpos.jo_id, jpos.quantity, jpos.remarks, ap.applicant_id
									from manager_jo_pos jpos
									left join applicant_processing ap
									on jpos.id = ap.poea_approved_cat
									where 1
									and jpos.jo_id = {$id}");
	            $data['pos_list'] = array();
	            $data['pos_allocation'] = array();
	            if($pos_list){
	            	foreach($pos_list as $p){
	            		$data['pos_list'][$p['id']] = array('id' => $p['id'], 'position' => $p['position'], 'quantity' => $p['quantity'], 'remarks' => $p['remarks']);

	            		if($p['applicant_id']){
	            			$data['pos_allocation'][$p['id']][$p['applicant_id']] = $p['applicant_id'];
	            		}
	            	}
	            }

	            $form_name = "jo_pos_index";
	            
	            if(!$data['hdr_info']){
	                redirect('processing/search/poea', 'refresh');
	            }
	            break;

            case 'lpt':
            	$data['list'] = getdata("select l.id, l.principal_id, mp.name as principal, l.company_id, mc.name as company, l.code, l.order_date, l.confirmed_date, l.ticket_no
										from manager_lpt_hdr l
										left join manager_principal mp
										on l.principal_id = mp.id
										left join manager_company mc
										on l.company_id = mc.id
										where 1
										{$q_where}
										order by l.order_date desc
										{$q_limit}");
            	$form_name = "lpt_index";
	            break;

            case 'pta':
            	$data['list'] = getdata("select l.id, l.principal_id, mp.name as principal, l.company_id, mc.name as company, l.code, l.order_date, l.confirmed_date, l.ticket_no
										from manager_pta_hdr l
										left join manager_principal mp
										on l.principal_id = mp.id
										left join manager_company mc
										on l.company_id = mc.id
										where 1
										{$q_where}
										order by l.order_date desc
										{$q_limit}");
            	$form_name = "pta_index";
	            break;

            case 'booking':
            	$form_name = "booking_index";
            	$data['info'] = getdata("select b.id, b.type, b.request_no, p.name as principal, c.name as company, b.request_date, b.pr_book_date, b.submit_date, b.route, a.name as airline, u.name as request_by
										from manager_booking b
										left join manager_principal p
										on b.principal_id = p.id
										left join manager_company c
										on b.company_id = c.id
										left join settings_airline a
										on b.airline_id = a.id
										left join settings_users u
										on b.request_by = u.username
										where 1
										and b.id = {$id}");

            	$data['list'] = getdata("select b.id, b.applicant_id, i.fname, i.mname, i.lname, b.pr_book_date, b.book_date, b.status, ppt.serial_no as ppt_no
										from applicant_booking b
										left join applicant_general_info i
										on b.applicant_id = i.id
										left join applicant_uploads ppt
										on b.applicant_id = ppt.applicant_id and ppt.description = 'Passport'
										where 1
										and b.booking_id = {$id}
										order by b.add_date desc, i.lname asc");
	            break;
	    }

	    $this->template->view('processing/'.$form_name, $data);
	}

	public function activity($what){
	    $this->template->set('file_javascript', array('javascripts/processing/index.js',));
	    $data = array();

	    switch($what){
	        case 'visa_allocation':
	            $data['list'] = getdata("select ap.id, ap.applicant_id, ap.lineup_id, i.fname, i.mname, i.lname, mr.code as mr_ref, p.name as principal, v.visa_no, vp.position as visa_cat, pos.desc as lineup_cat
										from applicant_processing ap
										left join applicant_general_info i
										on ap.applicant_id = i.id
										left join applicant_lineup l
										on ap.lineup_id = l.id
										left join manager_visa v
										on ap.request_visa_id = v.id
										left join manager_visa_pos vp
										on ap.request_visa_cat = vp.id
										left join manager_jobs j
										on l.mr_pos_id = j.id
										left join settings_position pos
										on j.pos_id = pos.id
										left join manager_mr mr
										on j.mr_id = mr.id
										left join manager_principal p
										on j.principal_id = p.id
										where 1
										and ap.request_visa_id <> ''
										and (ap.request_approved_cat is null or ap.request_approved_cat = '')
										order by ap.request_date desc, i.lname asc");
	            $form_name = "visa_allocation_index";
	            break;

	        case 'oec_request':
	            $data['list'] = getdata("select ap.id, ap.applicant_id, ap.lineup_id, i.fname, i.mname, i.lname, mr.code as mr_ref, p.name as principal, pos.desc as lineup_cat, l.select_date, ap.rfp_oec_no, ap.rfp_cg_no, ap.rfp_submit_date
										from applicant_processing ap
										left join applicant_general_info i
										on ap.applicant_id = i.id
										left join applicant_lineup l
										on ap.lineup_id = l.id
										left join manager_jobs j
										on l.mr_pos_id = j.id
										left join settings_position pos
										on j.pos_id = pos.id
										left join manager_mr mr
										on j.mr_id = mr.id
										left join manager_principal p
										on j.principal_id = p.id
										where 1
										and ap.rfp_endorsement_date <> '0000-00-00 00:00:00'
										and ((ap.rfp_status is null or ap.rfp_status = '') or (ap.rfp_status = 'Accepted' and (ap.rfp_submit_date = '0000-00-00 00:00:00' or ap.rfp_release_date = '0000-00-00 00:00:00')))
										order by ap.request_date desc, i.lname asc");
	            $form_name = "oec_request_index";
	            break;

            case 'jo_request':
        		$data['list'] = getdata("select ap.id, ap.applicant_id, ap.lineup_id, i.fname, i.mname, i.lname, mr.code as mr_ref, p.name as principal, pos.desc as lineup_cat, ap.poea_req_date, ap.poea_sent_date, ap.poea_approve_date, ap.poea_request_id, ap.poea_request_cat, jpos.position as request_cat, cu.currency_code, ap.poea_request_sal_amt, ap.poea_request_sal_per
										from applicant_processing ap
										left join applicant_general_info i
										on ap.applicant_id = i.id
										left join applicant_lineup l
										on ap.lineup_id = l.id
										left join manager_jobs j
										on l.mr_pos_id = j.id
										left join settings_position pos
										on j.pos_id = pos.id
										left join manager_mr mr
										on j.mr_id = mr.id
										left join manager_principal p
										on j.principal_id = p.id
										left join manager_jo_pos jpos
										on ap.poea_request_cat = jpos.id
										left join settings_currency cu
										on ap.poea_request_cur_id = cu.id
										where 1
										and ap.poea_req_date <> '0000-00-00 00:00:00'
										and (ap.poea_approve_date = '0000-00-00 00:00:00' || (ap.poea_approve_date != '0000-00-00 00:00:00' && (ap.poea_approved_id is null || ap.poea_approved_cat is null)))
										order by ap.request_date desc, i.lname asc");
            	$form_name = "jo_request_index";
            	break;

        	case 'lpt_request':
        		$data['list'] = getdata("select b.id, b.request_no, p.name as principal, c.name as company, b.request_by, b.request_date, b.pr_book_date
										from manager_booking b
										left join manager_principal p
										on b.principal_id = p.id
										left join manager_company c
										on b.company_id = c.id
										where 1
										and b.type = 'LPT'
										and b.pr_book_date >= '".date("Y-m-d", strtotime("last week"))." 00:00:00"."'
										order by b.add_date desc");
        		$form_name = "lpt_request_index";
            	break;

        	case 'visa_entry':
        		$data['list'] = getdata("select v.id, v.visa_no, v.applicant_id, i.fname, i.mname, i.lname, p.name as principal, c.name as country, v.visa_date, v.visa_stamp, v.days_valid, v.expiry_date, v.status, v.attachment
										from manager_visa_nonksa v
										left join applicant_general_info i
										on v.applicant_id = i.id
										left join manager_principal p
										on v.principal_id = p.id
										left join settings_country c
										on v.country_id = c.id
										where 1");
        		$form_name = "visa_nonksa_index";
            	break;

        	case 'vfs_sched':
        		$list = getdata("select vfs.id, i.id as applicant_id, i.fname, i.mname, i.lname, p.name as principal, pos.desc as position, vfs.proposed_sched, vfs.final_sched, vfs.venue, vfs.ref_no, vfs.release_date
										from manager_vfs vfs
										left join applicant_general_info i
										on vfs.applicant_id = i.id
										left join applicant_lineup l
										on i.lineup_id = l.id
										left join manager_jobs j
										on l.mr_pos_id = j.id
										left join manager_principal p
										on j.principal_id = p.id
										left join settings_position pos
										on j.pos_id = pos.id
										where 1
										and i.status in ('MOBILIZATION')");

        		$data = array();
        		if($list && count($list) > 0){
        			foreach($list as $l){
        				if($l['proposed_sched'] <> '0000-00-00 00:00:00' && $l['final_sched'] <> '0000-00-00 00:00:00' && $l['release_date'] == '0000-00-00 00:00:00'){
        					$data['list_final'][$l['id']] = $l;
        				}else if($l['release_date'] <> '0000-00-00 00:00:00'){
        					$data['list_released'][$l['id']] = $l;
        				}else{
        					$data['list_proposed'][$l['id']] = $l;
        				}
        			}
        		}

        		$form_name = "vfs_sched_index";
            	break;
	    }

	    $this->template->view('processing/'.$form_name, $data);
	}

	public function forms($what, $id=NULL){
	    $data = array();
	    switch($what){
	        case 'visa':
	            $this->template->set('file_javascript', array('javascripts/processing/index.js','javascripts/processing/visa.js'));
	            $form_name = "form_visa";
 
	            if($id){
	                $data['info'] = getdata("select * from manager_visa where id = {$id}");
	                if($data['info']){
		                $data['pos_list'] = getdata("select * from manager_visa_pos where visa_id = {$id} order by add_date desc");

		                /*GET ALLOCATIONS*/
		                $alloc = getdata("select pr.applicant_id, request_visa_cat, request_approved_cat, request_status, l.is_deployed
											from applicant_processing pr
											left join applicant_lineup l
											on pr.lineup_id = l.id
											where pr.request_visa_id = {$id}");

		                if($alloc){
		                	foreach($alloc as $a){
		                		if($a['request_status'] == 'Accepted'){
		                			$data['allocation']['approved'][$a['request_approved_cat']][$a['applicant_id']] = $a['applicant_id'];
		                		}else{
		                			if($a['is_deployed'] != 'Y'){
			                			if($a['request_status'] != 'Denied'){
			                				$data['allocation']['pending'][$a['request_visa_cat']][$a['applicant_id']] = $a['applicant_id'];
			                			}
		                			}
		                		}
		                	}
		                }
	                }else{
	                	redirect('processing/search/visa', 'refresh');
	                }
	            }
	            break;
	            
	        case 'poea':
	            $this->template->set('file_javascript', array('javascripts/processing/index.js','javascripts/processing/poea.js'));
	            $form_name = "form_poea";

	            if($id){
	                $data['info'] = getdata("select * from manager_poea where id = {$id}");

	                if(!$data['info']){
	                	redirect('processing/search/poea', 'refresh');
	                }

	                $data['jo_list'] = array();
	                $data['jo_pos_list'] = array();
	                $data['jo_allocation'] = array();

	                $jo = getdata("select pj.id, pj.jo_id as jo_serial, pj.approved_date, pj.submit_date, jpos.id jo_pos_id, ap.applicant_id, pj.expiry_date
									from manager_poea_jo pj
									left join manager_jo_pos jpos
									on pj.id = jpos.jo_id
									left join applicant_processing ap
									on jpos.id = ap.poea_approved_cat
									where 1
									and pj.poea_id = {$id}");
	                if($jo){
	                    foreach ($jo as $j){
	                    	$data['jo_list'][$j['id']] = array('id' => $j['id'], 'jo_id' => $j['jo_serial'], 'approved_date' => $j['approved_date'], 'submit_date' => $j['submit_date'], 'expiry_date' => $j['expiry_date']);

					        if($j['jo_pos_id']){
					           $data['jo_pos_list'][$j['id']][$j['jo_pos_id']] = $j['jo_pos_id'];
					        }

					        if($j['applicant_id']){
					           $data['jo_allocation'][$j['id']][$j['applicant_id']] = $j['applicant_id'];
					        }
                    	}
                    }
	            }
	            break;

            case 'lpt':
            	$this->template->set('file_javascript', array('javascripts/processing/lpt.js'));
            	$form_name = "form_lpt";

            	if($id){
	                $data['info'] = getdata("select * from manager_lpt_hdr where id = {$id}");
	            }
	            break;

            case 'pta':
            	$this->template->set('file_javascript', array('javascripts/processing/pta.js'));
            	$form_name = "form_pta";

            	if($id){
	                $data['info'] = getdata("select * from manager_pta_hdr where id = {$id}");
	            }
	            break;

	        default:
	           redirect('home/dashboard', 'refresh');
	    }

	    $this->template->view('processing/'.$form_name, $data);
	}
	
	public function save($what){
	    $this->load->model('processing_model');
	    $return_id = $this->processing_model->save($what);
	    
	    switch($what){
	        case 'visa':
	        case 'visa_pos':
	            redirect('processing/forms/visa/'.$return_id, 'refresh');
	            break;
	            
	        case 'poea':
	        case 'poea_jo':
	            redirect('processing/forms/poea/'.$return_id, 'refresh');
	            break;
	            
	        case 'jo_pos':
	            redirect('processing/search/jo_pos/'.$return_id, 'refresh');
	            break;

	        case 'lpt':
	        case 'pta':
	            redirect('processing/forms/'.$what.'/'.$return_id, 'refresh');
	            break;

            case 'booking_req':
            	if($_POST['textType'] == 'LPT'){
            		redirect('processing/activity/lpt_request', 'refresh');
            	}else{
            		redirect('processing/activity/pta_request', 'refresh');
            	}
	            break;

	        /*AJAX*/
            case 'visa_nonksa':
	            echo TRUE;
	            break;

	        /*AJAX*/
            case 'vfs_sched':
            	echo TRUE;
	            break;

            default:
            	redirect('processing/search/'.$what.'/'.$return_id, 'refresh');
            	break;
	    }
	}

	public function save_app_booking_req(){
		$booking_info = getdata("select * from manager_booking where id = {$_POST['textReqId']}");

		foreach($_POST['selected_app'] as $app_id){
			$data = array('app_id' => $app_id,
				'booking_id' => $booking_info[0]['id'],
				'request_date' => $booking_info[0]['request_date'],
				'pr_book_date' => $booking_info[0]['pr_book_date']);

			$this->load->model('applicant_model');
	    	$this->applicant_model->booking_request($data);
		}

		redirect('processing/search/booking/'.$booking_info[0]['id'], 'refresh');
	}

	public function save_allocate_trans(){
		$trans_info = getdata("select * from manager_visa_transmittal where id = {$_POST['textTransId']}");
		$_POST['textTransNo'] = $trans_info[0]['transmittal_no'];

		foreach($_POST['selected_app'] as $app_proc_id){
			$_POST['textRecordId'] = $app_proc_id;

			$this->load->model('processing_model');
	    	$return_id = $this->processing_model->save('trans_alloc');
		}

		redirect('processing/search/transmittal_alloc/'.$_POST['textTransId'], 'refresh');
	}

	public function save_visa_allocation(){
		$this->load->model('processing_model');
		$return_id = $this->processing_model->allocate_visa();

		redirect('processing/forms/visa/'.$_POST['textVISAId'], 'refresh');
	}

	public function save_jo_allocation(){
		$this->load->model('processing_model');
		$return_id = $this->processing_model->allocate_jo();

		redirect('processing/search/jo_pos/'.$_POST['textJOId'], 'refresh');
	}

	public function update_allocate_trans(){
		$this->load->model('processing_model');
    	$return_id = $this->processing_model->save('update_trans_alloc');

    	redirect('processing/search/transmittal_alloc/'.$_POST['textTransId'], 'refresh');
	}
	
	public function facebox($what, $hdr_id=NULL, $dtl_id=NULL){
	    $data = array();
	    switch($what){
	        case 'visa':
	            $formname = "form_visa_position";
	            $data['visa_id'] = $hdr_id;
	            $data['visa_pos_id'] = $dtl_id;
	            
	            if($dtl_id){
	                $data['pos_info'] = getdata("select * from manager_visa_pos where id = {$dtl_id}");
	            }
	            break;

	        case 'transmittal':
	            $formname = "form_visa_transmittal";
	            $data['visa_id'] = $hdr_id;
	            // $data['visa_pos_id'] = $dtl_id;
	            
	            // if($dtl_id){
	            //     $data['pos_info'] = getdata("select * from manager_visa_pos where id = {$dtl_id}");
	            // }
	            break;

			case 'visa_alloc':
				$applicants = getdata("select l.id as lineup_id, l.applicant_id, i.fname, i.mname, i.lname, pos.`desc` as `position`, l.manpower_id, mr.code as mr_ref, ap.id as processing_id
										from applicant_lineup l
										left join applicant_general_info i
										on l.applicant_id = i.id
										left join manager_jobs j
										on l.mr_pos_id = j.id
										left join manager_visa v
										on j.principal_id = v.principal_id
										left join applicant_processing ap
										on l.applicant_id = ap.applicant_id
										left join settings_position pos
										on j.pos_id = pos.id
										left join manager_mr mr
										on l.manpower_id = mr.id
										where 1
										and v.id={$hdr_id}
										and i.status in ('MOBILIZATION','SELECTED - ACCEPTED')
										and (ap.request_approved_cat is null or ap.request_approved_cat = 0)");
				if($applicants){
					foreach($applicants as $i){
						$data['mr_list'][$i['manpower_id']] = $i['mr_ref'];
						$data['app_list'][$i['manpower_id']][$i['applicant_id']] = $i;
					}
				}

				$data['visa_id'] = $hdr_id;
				// $data['visa_pos_id'] = $dtl_id;
				if($dtl_id){
					$data['visa_pos_info'] = getdata("select * from manager_visa_pos where id = {$dtl_id}");
					$data['visa_pos_id'] = $dtl_id;
				}

				$formname = "form_alloc_applicant";
				break;

            case 'add_applicant':
            	$applicants = getdata("select ap.id as applicant_processing_id, ap.applicant_id, i.fname, i.mname, i.lname, l.manpower_id, mr.code as mr_ref, vp.position as approved_cat
										from applicant_processing ap
										left join applicant_general_info i
										on ap.applicant_id = i.id
										left join applicant_lineup l
										on i.lineup_id = l.id
										left join manager_mr mr
										on l.manpower_id = mr.id
										left join manager_visa_pos vp
										on ap.request_approved_cat = vp.id
										where 1
										and i.status = 'MOBILIZATION'
										and (ap.transmittal_no is null or ap.transmittal_no='')
										and ap.transmittal_submit_date='0000-00-00 00:00:00'
										and ap.request_visa_id = {$hdr_id}");
            	if($applicants){
            		foreach($applicants as $i){
            			$data['mr_list'][$i['manpower_id']] = $i['mr_ref'];
            			$data['app_list'][$i['manpower_id']][$i['applicant_id']] = $i;
            		}
            	}

            	$data['visa_id'] = $hdr_id;
            	$data['transmittal_id'] = $dtl_id;
            	$formname = "form_add_applicant";
	            break;

            case 'edit_applicant':
            	$data['processing_info'] = getdata("select * from applicant_processing where id = {$hdr_id}");
            	$data['transmittal_id'] = $dtl_id;
            	$formname = "form_edit_applicant";
	            break;
	            
	        case 'poea_jo':
	            $formname = "form_poea_jo";
	            $data['poea_id'] = $hdr_id;
	            $data['jo_id'] = $dtl_id;
	            
	            if($dtl_id){
	                $data['jo_info'] = getdata("select * from manager_poea_jo where id = {$dtl_id}");
	            }
	            break;

	        case 'jo_pos':
	            $formname = "form_jo_pos";
	            $data['jo_id'] = $hdr_id;

	            if($dtl_id){
	                $data['pos_info'] = getdata("select * from manager_jo_pos where id = {$dtl_id}");
	            }
	            break;

			/* POEA MANAGER - JO ALLOCATION */
			case 'jo_alloc':
				$applicants = getdata("select l.id as lineup_id, l.applicant_id, i.fname, i.mname, i.lname, pos.`desc` as `position`, l.manpower_id, mr.code as mr_ref, ap.id as processing_id
									from applicant_lineup l
									left join applicant_general_info i
									on l.applicant_id = i.id
									left join manager_jobs j
									on l.mr_pos_id = j.id
									left join manager_poea poea
									on j.principal_id = poea.principal_id
									left join manager_poea_jo jo
									on poea.id = jo.poea_id
									left join applicant_processing ap
									on l.applicant_id = ap.applicant_id
									left join settings_position pos
									on j.pos_id = pos.id
									left join manager_mr mr
									on l.manpower_id = mr.id
									where 1
									and jo.id={$hdr_id}
									and i.status in ('MOBILIZATION','SELECTED - ACCEPTED')
									and (ap.poea_approved_id is null or ap.poea_approved_id = 0)");
				if($applicants){
					foreach($applicants as $i){
						$data['mr_list'][$i['manpower_id']] = $i['mr_ref'];
						$data['app_list'][$i['manpower_id']][$i['applicant_id']] = $i;
					}
				}

				$formname = "form_jo_alloc_applicant";
				$data['jo_id'] = $hdr_id;
				$data['jo_pos_id'] = $dtl_id;

				if($dtl_id){
					$data['pos_info'] = getdata("select * from manager_jo_pos where id = {$dtl_id}");
				}
				break;

            case 'visa_allocation':
            	$data['visa_alloc_info'] = getdata("select ap.id, ap.applicant_id, ap.lineup_id, ap.request_visa_id, ap.request_visa_cat, j.principal_id
													from applicant_processing ap
													left join applicant_lineup l
													on ap.lineup_id = l.id
													left join manager_jobs j
													on l.mr_pos_id = j.id
													where ap.id = {$hdr_id}");
				$data['visa_list'] = getdata_for_dd("select id,visa_no as value from manager_visa where principal_id = {$data['visa_alloc_info'][0]['principal_id']} and expiry_date > '".date("Y-m-d",strtotime("today"))."'");
				$data['visa_pos_list'] = getdata_for_dd("select id,position as value from manager_visa_pos where visa_id = {$data['visa_alloc_info'][0]['request_visa_id']} order by position asc");

				/*GET PREVIOUS ALLOCATION*/
				$data['previous_allocation'] = array();
				$all_alloc = getdata("select ap.id, ap.request_visa_cat, vp.quantity from applicant_processing ap left join manager_visa_pos vp on ap.request_visa_cat = vp.id where ap.request_visa_id = {$data['visa_alloc_info'][0]['request_visa_id']} and ap.request_status='Accepted';");
				if($all_alloc){
					foreach($all_alloc as $a){
						$data['previous_allocation'][$a['request_visa_cat']]['quantity'] = $a['quantity'];
						$data['previous_allocation'][$a['request_visa_cat']]['applicants'][$a['id']] = $a['id'];
					}
				}
				/*END GET PREVIOUS ALLOCATION*/

            	$formname = "form_visa_allocation";
	            break;

	        case 'oec_request':
	            $formname = "form_oec_request";
	            $data['processing_info'] = getdata("select * from applicant_processing where id = {$hdr_id}");
	            break;

	        case 'view_allocation':
	            $formname = "form_view_allocation";
	            if($dtl_id == 1){
	            	/*APPROVED*/
	            	$q_status = "and ap.request_approved_cat = {$hdr_id} and ap.request_status = 'Accepted'";
	            	$data['visa_status'] = "Accepted";
	            }else{
	            	/*PENDING*/
	            	$q_status = "and ap.request_visa_cat = {$hdr_id} and (ap.request_status = '' or ap.request_status is null)";
	            	$data['visa_status'] = "Pending";
	            }

	            $data['list'] = getdata("select ap.applicant_id, i.fname, i.mname, i.lname, i.status
											from applicant_processing ap
											left join applicant_general_info i
											on ap.applicant_id = i.id
											where 1
											{$q_status}");
	            break;

	        case 'jo_request':
	            $formname = "form_jo_request";
	            //$data['processing_info'] = getdata("select * from applicant_processing where id = {$hdr_id}");
				$data['jo_alloc_info'] = getdata("select ap.*, j.principal_id
													from applicant_processing ap
													left join applicant_lineup l
													on ap.lineup_id = l.id
													left join manager_jobs j
													on l.mr_pos_id = j.id
													where ap.id = {$hdr_id}");

				$data['jo_list'] = getdata_for_dd("select pj.id, pj.jo_id as value
													from manager_poea mp
													left join manager_poea_jo pj
													on mp.id = pj.poea_id
													where mp.principal_id = {$data['jo_alloc_info'][0]['principal_id']}
													and mp.expiry_date > '".date("Y-m-d",strtotime("today"))."'");

				if($data['jo_alloc_info'][0]['poea_request_id']){
					$data['jo_pos_list'] = getdata_for_dd("select id,position as value from manager_jo_pos where jo_id = {$data['jo_alloc_info'][0]['poea_request_id']} order by position asc");
				}

				if($data['jo_alloc_info'][0]['poea_approved_id']){
					$data['jo_approved_pos_list'] = getdata_for_dd("select id,position as value from manager_jo_pos where jo_id = {$data['jo_alloc_info'][0]['poea_approved_id']} order by position asc");
				}
	            break;

            case 'view_jo_allocation':
            	$formname = "form_view_jo_allocation";

            	if(isset($_GET['all'])){
		            $data['list'] = getdata("select ap.applicant_id, i.fname, i.mname, i.lname, i.status
											from applicant_processing ap
											left join applicant_general_info i
											on ap.applicant_id = i.id
											where 1
											and ap.poea_approved_id = {$hdr_id}
											order by i.lname asc");
            	}else{
		            $data['list'] = getdata("select ap.applicant_id, i.fname, i.mname, i.lname, i.status
											from applicant_processing ap
											left join applicant_general_info i
											on ap.applicant_id = i.id
											where 1
											and ap.poea_approved_cat = {$hdr_id}
											order by i.lname asc");
            	}
	            break;

            case 'lpt_request':
            	$formname = "form_booking_req";
            	$data['type'] = "LPT";
            	if($hdr_id){
            		$data['booking_info'] = getdata("select * from manager_booking where id = {$hdr_id}");
            	}

	            break;

            case 'add_booking_applicant':
	            $lpt_req_info = getdata("select * from manager_booking where id = {$hdr_id}");
	            if($lpt_req_info[0]['company_id'] <> 0){
	            	$q_company = " and mr.company_id = ".$lpt_req_info[0]['company_id'];
	            }else{
	            	$q_company = "";
	            }

            	$applicants = getdata("select l.applicant_id, i.fname, i.mname, i.lname, l.manpower_id, mr.code as mr_ref, pos.`desc` as position, ppt.expiry_date as ppt_exp_date, m.med_result_exp_date
									from applicant_general_info i
									left join applicant_lineup l
									on i.lineup_id = l.id
									left join manager_mr mr
									on l.manpower_id = mr.id
									left join manager_jobs j
									on l.mr_pos_id = j.id
									left join settings_position pos
									on j.pos_id = pos.id
									left join applicant_booking ab
									on l.applicant_id = ab.applicant_id
									left join applicant_uploads ppt
									on l.applicant_id = ppt.applicant_id and ppt.description = 'Passport'
									left join applicant_medical_info m
									on l.applicant_id = m.applicant_id and m.is_archived = 'N'
									where 1
									and i.status = 'MOBILIZATION'
									and l.lineup_status = 'Selected'
									and l.lineup_acceptance = 'Accepted'
									#CHECK VISA
									and ab.id is null
									and ppt.serial_no <> ''
									and m.med_result = 'fit'
									and mr.principal_id = ".$lpt_req_info[0]['principal_id'].$q_company);

            	$n = 0;
            	if($applicants){
            		foreach($applicants as $i){
            			$ppt_status = checkExpiry($i['ppt_exp_date']);
            			$med_status = checkExpiry($i['med_result_exp_date']);

            			if($ppt_status == 'Valid' && $med_status == 'Valid'){
	            			$data['mr_list'][$i['manpower_id']] = $i['mr_ref'];
	            			$data['app_list'][$i['manpower_id']][$i['applicant_id']] = $i;
	            			$n++;
            			}
            		}
            	}

            	if($n > 15){
            		/*SHOW SCROLL ON POPUP*/
            		$data['scroll'] = TRUE;
            	}

            	$data['lpt_req_id'] = $hdr_id;
            	$formname = "form_add_booking_applicant";
	            break;

            case 'visa_nonksa':
            	$formname = "form_visa_entry";

            	if($hdr_id){
            		$data['visa_info'] = getdata("select v.*, concat(i.id,' - ',i.fname,' ',i.mname,' ',i.lname) as applicant
													from manager_visa_nonksa v
													left join applicant_general_info i
													on v.applicant_id = i.id
													where 1
													and v.id = {$hdr_id}");
            	}

            	$data['applicant_list'] = getdata_for_dd("select i.id, concat(i.id,' - ',i.fname,' ',i.mname,' ',i.lname) as value
													from applicant_general_info i
													left join manager_visa_nonksa v
													on i.id = v.applicant_id
													where 1
													and v.id is null");
	            break;

            case 'vfs':
            	$formname = "form_vfs";

            	if($hdr_id){
            		$data['visa_info'] = getdata("select v.*, concat(i.id,' - ',i.fname,' ',i.mname,' ',i.lname) as applicant
													from manager_vfs v
													left join applicant_general_info i
													on v.applicant_id = i.id
													where 1
													and v.id = {$hdr_id}");
            	}

            	$data['applicant_list'] = getdata_for_dd("select i.id, concat(i.id,' - ',i.fname,' ',i.mname,' ',i.lname) as value
													from applicant_general_info i
													left join manager_vfs v
													on i.id = v.applicant_id
													where 1
													and v.id is null
													and i.status in ('MOBILIZATION')");
	            break;
	    }

	    echo $this->load->view('processing/'.$formname, $data, TRUE);
	}
	
	public function delete($what, $hdr_id, $dtl_id=NULL){
	    $this->load->model('processing_model');

	    switch($what){
	        case 'visa':
	            $this->processing_model->delete($what, $hdr_id);
	            redirect('processing/search/visa', 'refresh');
	            break;
	        case 'visa_pos':
	            $this->processing_model->delete($what, $dtl_id);
	            redirect('processing/forms/visa/'.$hdr_id, 'refresh');
	            break;
	        case 'poea_jo':
	            $this->processing_model->delete($what, $dtl_id);
	            redirect('processing/forms/poea/'.$hdr_id, 'refresh');
	            break;
	        case 'jo_pos':
	            $this->processing_model->delete($what, $dtl_id);
	            redirect('processing/search/jo_pos/'.$hdr_id, 'refresh');
	            break;
	        case 'poea':
	            $this->processing_model->delete($what, $hdr_id);
	            redirect('processing/search/poea', 'refresh');
	            break;
	        case 'transmittal':
	            $this->processing_model->delete($what, $dtl_id);
	            redirect('processing/search/transmittal/'.$hdr_id, 'refresh');
	            break;
            case 'lpt_request':
            	$this->processing_model->delete($what, $hdr_id);
	            redirect('processing/activity/lpt_request', 'refresh');
	            break;
            case 'booking_request':
            	$this->processing_model->delete($what, $hdr_id);
	            redirect('processing/search/booking/'.$dtl_id, 'refresh');
	            break;
            case 'visa_nonksa':
            	$this->processing_model->delete($what, $hdr_id);
	            redirect('processing/activity/visa_entry', 'refresh');
	            break;
            case 'visa_nonksa_attachment':
            	/*AJAX*/
            	$return_val = $this->processing_model->delete_file($what, $hdr_id, TRUE);
            	echo $return_val;
            	exit();
	            //redirect('processing/search/booking/'.$dtl_id, 'refresh');
	            break;

            case 'vfs_sched':
            	$this->processing_model->delete($what, $hdr_id);
	            redirect('processing/activity/vfs_sched', 'refresh');
	            break;
	    }
	}
	
	public function duplicate($tbl_name, $fld_name, $value){
	    echo checkDuplicate($tbl_name, $fld_name, $value);
	}

	public function get_visa_pos(){
		if($_GET['visa_id'] <> ''){
			/*GET PREVIOUS ALLOCATION*/
			$previous_allocation = array();
			$all_alloc = getdata("select ap.id, ap.request_visa_cat, vp.quantity from applicant_processing ap left join manager_visa_pos vp on ap.request_visa_cat = vp.id where ap.request_visa_id = {$_GET['visa_id']} and ap.request_status='Accepted';");
			if($all_alloc){
				foreach($all_alloc as $a){
					$previous_allocation[$a['request_visa_cat']]['quantity'] = $a['quantity'];
					$previous_allocation[$a['request_visa_cat']]['applicants'][$a['id']] = $a['id'];
				}
			}
			/*END GET PREVIOUS ALLOCATION*/

			$visa_pos = getdata("select id, position from manager_visa_pos where visa_id = {$_GET['visa_id']} order by position asc");
			$dd_request_cat = "";
			$dd_approved_cat = "";

			if($visa_pos){
				foreach($visa_pos as $v){
					$dd_request_cat .= "<option value=\"{$v['id']}\">{$v['position']}</option>";

					/*CHECK IF QTY LIMIT IS REACHED*/
					if(isset($previous_allocation[$v['id']]) && count($previous_allocation[$v['id']]['applicants']) >= $previous_allocation[$v['id']]['quantity']){
						$dd_approved_cat .= "<option value=\"{$v['id']}\" disabled=\"disabled\">{$v['position']}  (no available balance)</option>";
					}else{
						$dd_approved_cat .= "<option value=\"{$v['id']}\">{$v['position']}</option>";
					}
					
				}
			}

			echo json_encode(array('request_category' => $dd_request_cat, 'approved_category' => $dd_approved_cat,));
		}
	}

	public function get_jo_pos(){
		if($_GET['jo_id'] <> ''){
			$jo_pos = getdata("select id, position from manager_jo_pos where jo_id = {$_GET['jo_id']} order by position asc");
			$dd_jo_cat = "";

			if(isset($_GET['approved'])){
				/*GET PREVIOUS ALLOCATION*/
				$previous_allocation = array();
				$all_alloc = getdata("select ap.id, ap.poea_approved_cat, jpos.quantity from applicant_processing ap left join manager_jo_pos jpos on ap.poea_approved_cat = jpos.id where ap.poea_approved_id = {$_GET['jo_id']}");
				if($all_alloc){
					foreach($all_alloc as $a){
						$previous_allocation[$a['poea_approved_cat']]['quantity'] = $a['quantity'];
						$previous_allocation[$a['poea_approved_cat']]['applicants'][$a['id']] = $a['id'];
					}
				}
				/*END GET PREVIOUS ALLOCATION*/

				if($jo_pos){
					foreach($jo_pos as $j){
						/*CHECK IF QTY LIMIT IS REACHED*/
						if(isset($previous_allocation[$j['id']]) && count($previous_allocation[$j['id']]['applicants']) >= $previous_allocation[$j['id']]['quantity']){
							$dd_jo_cat .= "<option value=\"{$j['id']}\" disabled=\"disabled\">{$j['position']}  (no available balance)</option>";
						}else{
							$dd_jo_cat .= "<option value=\"{$j['id']}\">{$j['position']}</option>";
						}
					}
				}
			}else{
				if($jo_pos){
					foreach($jo_pos as $j){
						$dd_jo_cat .= "<option value=\"{$j['id']}\">{$j['position']}</option>";
					}
				}
			}

			echo json_encode(array('jo_category' => $dd_jo_cat,));
		}
	}

	public function print_page($what, $id){
		$data['info'] = getdata("select ap.applicant_id, ap.request_visa_id, v.visa_no, v.sponsor_no, ap.transmittal_auth, i.fname, i.mname, i.lname, vp.position as visa_cat, ppt.serial_no as ppt_no, cl.name as clinic, i.religion, ap.transmittal_ecode, p.name as principal, ap.transmittal_no
								from applicant_processing ap
								left join manager_visa v
								on ap.request_visa_id = v.id
								left join applicant_general_info i
								on ap.applicant_id = i.id
								left join manager_visa_pos vp
								on ap.request_visa_cat = vp.id
								left join applicant_uploads ppt
								on ap.applicant_id = ppt.applicant_id and description = 'Passport'
								left join applicant_medical_info m
								on ap.applicant_id = m.applicant_id
								left join settings_clinic cl
								on m.clinic_id = cl.id
								left join applicant_lineup l
								on i.lineup_id = l.id
								left join manager_mr mr
								on l.manpower_id = mr.id
								left join manager_principal p
								on mr.principal_id = p.id
								where ap.id = {$id}");
		if($data['info']){
			$this->load->view('processing/'.$what.'_print', $data);
		}else{
			redirect('processing/search/visa', 'refresh');
		}
		//$this->template->set_template('template_print');
	    //$this->template->view('processing/'.$what.'_print', $data);
	}
}