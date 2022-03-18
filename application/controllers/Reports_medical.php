<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reports_medical extends MY_Controller{

    public function __construct(){
        parent::__construct();
        
        $this->load->helper(array('text'));
    }
    
	public function index(){
		$this->template->view('reports/medical/medical_index', array());
	}
	
	public function print_report(){
		switch ($_POST['SelectType']) {
			case '2':
				$data = $this->fetch_raw_data();
				$print_file = "exam_taken_detailed_print";
				break;

			case '3':
				$data = $this->fetch_raw_data("fit_unfit");
				$print_file = "fit_unfit_print";
				break;

			case '4':
				$data = $this->fetch_raw_data("pending");
				$print_file = "pending_print";
				break;

			case '5':
				$data = $this->fetch_raw_data("pending");
				$print_file = "pending_detailed_print";
				break;

			case '6':
				$data = $this->fetch_raw_data("fit");
				$print_file = "fit_detailed_print";
				break;

			case '7':
				$data = $this->fetch_raw_data("unfit");
				$print_file = "unfit_detailed_print";
				break;

			case '8':
				$data = $this->fetch_raw_data("awaiting_result");
				$print_file = "awaiting_result_detailed_print";
				break;

			default:
				$data = $this->fetch_raw_data();
				$print_file = "exam_taken_print";
				break;
		}

	    $this->template->set_template('template_print');
	    $this->template->view('reports/medical/'.$print_file, $data);
	}

	private function fetch_raw_data($what=NULL){
        $qry_where = "";
        if($_POST['SelectPrincipal']){
            $qry_where = " and mr.principal_id = {$_POST['SelectPrincipal']}";
        }

		$qry_where_clinic = "";
        if($_POST['SelectClinic']){
            $qry_where_clinic = " and m.clinic_id = {$_POST['SelectClinic']}";
        }

		$qry_where_status = "";
        if($what == 'fit_unfit'){
			$qry_where_status = "and m.med_result in ('fit','unfit')";
        }else if($what == 'pending'){
			$qry_where_status = "and m.med_result in ('pending','')";
        }else if($what == 'fit'){
			$qry_where_status = "and m.med_result in ('fit')";
        }else if($what == 'unfit'){
			$qry_where_status = "and m.med_result in ('unfit')";
        }else if($what == 'awaiting_result'){
			$qry_where_status = "and m.med_result in ('')";
        }

        $info = getdata("select m.applicant_id, m.clinic_ref_taken_date, m.clinic_exam_date, m.med_result, m.med_result_rec_date, mr.principal_id, pr.name as principal, l.manpower_id, mr.code as mr_ref, i.fname, i.mname, i.lname, m.clinic_id, cl.name as clinic, m.med_result_findings, m.med_result_clinic_remarks, m.med_result_exp_date
			from applicant_medical_info m
			left join applicant_general_info i
			on m.applicant_id = i.id
			left join applicant_lineup l
			on i.lineup_id = l.id
			left join manager_mr mr
			on l.manpower_id = mr.id
			left join manager_principal pr
			on mr.principal_id = pr.id
			left join settings_clinic cl
			on m.clinic_id = cl.id
			where 1
			and m.is_archived = 'N'
			and (m.clinic_exam_date >= '".dateformat($_POST['textStDate'],0)." 00:00:00' and m.clinic_exam_date <= '".dateformat($_POST['textEnDate'],0)." 23:59:59')
			{$qry_where}
			{$qry_where_clinic}
			{$qry_where_status}");

        $principals = array();
        $mr_ref = array();
        $medical = array();
        $stat_per_mr = array();
        $clinics = array();
        if($info){
            foreach ($info as $i){
                $principals[$i['principal_id']] = $i['principal'];
                $mr_ref[$i['principal_id']][$i['manpower_id']] = $i['mr_ref'];
                $medical[$i['manpower_id']][$i['applicant_id']] = $i;

                $med_result = ($i['med_result']!='')?$i['med_result']:"awaiting_result";
                $stat_per_mr[$i['manpower_id']][$med_result][$i['applicant_id']] = $i;
                $clinics[$i['clinic_id']] = $i['clinic'];
            }
        }

        return array('list_principal' => $principals, 'list_mr' => $mr_ref, 'list_medical' => $medical, 'list_per_result' => $stat_per_mr, 'clinics' => $clinics);
	}
}
