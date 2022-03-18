<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Medical extends MY_Controller{

	public $covax_brand = array('Pfizer-BioNTech' => 'Pfizer-BioNTech', 'Oxford-AstraZeneca'=>'Oxford-AstraZeneca', 'CoronaVac (Sinovac)'=>'CoronaVac (Sinovac)', 'Gamaleya Sputnik V'=>'Gamaleya Sputnik V', 'J&J Janssen'=>'J&J Janssen', 'Bharat BioTech'=>'Bharat BioTech', 'Moderna'=>'Moderna', 'Novavax' => 'Novavax');

//     public function __construct(){
//         parent::__construct();

//         $this->load->helper(array('global_helper','form','url'));
        
//         if(!isset($_SESSION['rs_user'])){
//             redirect('login', 'refresh');
//         }
//     }
    
	public function index(){
	    $this->search();
	}

	public function search(){
	    $this->template->set('file_javascript', array('javascripts/medical/index.js',));

	    if(trim($this->input->post('textSearchApplicant')) != ''){
	    	$this->load->helper('email');

	        if(valid_email(trim($this->input->post('textSearchApplicant')))){
	            /* search email address */
	            $q_where = "and a.email = '".trim($this->input->post('textSearchApplicant'))."'";
	        }else if(is_numeric(trim($this->input->post('textSearchApplicant')))){
	            /* search by age */
	            //$q_where = "and (YEAR(CURDATE()) - YEAR(a.birthdate)) >= '".trim($this->input->post('textSearchApplicant'))."'";
	            $q_where = "";
	        }else{
	            if(strpos($this->input->post('textSearchApplicant'), ',')){
	                $fullName = explode(',',$this->input->post('textSearchApplicant'));
	                /* search last name */
	                $q_where = "and a.lname like '".trim($fullName[0])."%'";
	                
	                if(trim($fullName[1]) != ''){
	                    /* search first name */
	                    $q_where .= "and a.fname like '".trim($fullName[1])."%'";
	                }

	            }else{
	                /* search last OR first name */
	                $q_where = "and (a.lname like '".trim($this->input->post('textSearchApplicant'))."%' or a.fname like '".trim($this->input->post('textSearchApplicant'))."%')";
	                
	                /* search by applied position */
	                //$q_where .= "or (p.position like '%".trim($this->input->post('textSearchApplicant'))."%')";
	            }
	        }
	        
	        //$q_limit = "";
	    }else{
	        $q_where = "";
	        //$q_limit = "limit 100";
	    }
	    
	    /* limit to last 100 applicants */
	    $q_limit = "limit 100";

	    $list = getdata("select a.id, a.email, a.birthdate, a.fname, a.mname, a.lname, a.status, (YEAR(CURDATE()) - YEAR(a.birthdate)) as age, p.position
                        from applicant_general_info a
                        left join applicant_applied_pos p
                        on a.id = p.applicant_id
                        where 1
	                    {$q_where}
	                    order by a.add_date desc
                        {$q_limit}");
	    $this->template->view('medical/search', array('applicants'=>$list));
	}
	
	public function forms($what, $applicant_id){
	    $this->template->set('file_javascript', array('javascripts/medical/medical_form.js',));
	    $this->load->model('applicant_model');
	    $data = array('applicant_data'=>$this->applicant_model->get_applicant_data($applicant_id));

	    if(!$data['applicant_data']){
	        redirect('medical/search', 'refresh');
	    }

	    $data['cv_type']= "";
	    $data['med_info'] = getdata("select * from applicant_medical_info where applicant_id = {$applicant_id} and is_archived='N'");
	    $data['med_archive'] = getdata("select c.name as clinic, m.clinic_exam_date, m.med_result_exp_date, m.med_result, m.med_result_findings, m.med_result_clinic_remarks
                                        from applicant_medical_info m
                                        left join settings_clinic c
                                        on m.clinic_id = c.id
                                        where 1
                                        and m.applicant_id = {$applicant_id}
                                        and m.is_archived = 'Y'
                                        order by m.clinic_exam_date desc");
	    $data['pcr_history'] = getdata("select p.*, c.name as clinic
    									from applicant_pcrtest p
	    								left join settings_clinic c
                                        on p.clinic_id = c.id
	    								where 1
	    								and p.applicant_id = {$applicant_id}
	    								order by p.testing_date desc");
	    $data['current_page'] = 'medical_form';
	    $data['covax_brand'] = $this->covax_brand;
	    $data['vaccine_info'] = getdata("select * from applicant_vaccine_info where applicant_id = {$applicant_id}");
	    $data['vaccine_card_info'] = getdata("select id, filename from applicant_uploads where applicant_id = {$applicant_id} and description = 'Covid Vaccine'");
	    $this->template->view('medical/form_medical', $data);
	}
	
	public function save($what="med"){
	    $this->load->model('medical_model');

	    $applicant_id = $this->input->post('applicant_id');
	    if($what == 'pcr'){
	    	$this->medical_model->save($what);
	    }else if($what == 'vaccine'){
			$this->medical_model->save($what);
			$applicant_id = $this->input->post('textApplicant_id');
	    }else{
	    	$this->medical_model->save_medform();
	    }
	    
	    redirect('medical/forms/default/'.$applicant_id, 'refresh');
	}

	public function archive($id){
	    $id = base64_decode($id);
// 	    var_dump($id);
// 	    exit();
	    if($id!='' && is_numeric($id)){
	        $med_info = getdata("select * from applicant_medical_info where id = {$id} and is_archived='N'");
	        
	        if($med_info){
	            $this->load->model('medical_model');
	            $this->medical_model->archive_med($id, $med_info[0]['applicant_id']);
	            redirect('medical/forms/default/'.$med_info[0]['applicant_id'], 'refresh');
	        }else{
	            redirect('medical/search', 'refresh');
	        }
	    }else{
	        redirect('medical/search', 'refresh');
	    }
	}

	public function delete_vaccine_card($applicant_id, $doc_id=NULL, $vax_id){
		if(!is_null($doc_id)){
	        $current_file = getdata("select filename from applicant_uploads where id = {$doc_id}");

	        if($current_file){
	            /* DELETE FROM APPLICANTS FOLDER */
	            unlink($current_file[0]['filename']);
	            
				/*DELETE FILE IN DOC LIB*/
				$_GET['applicant_id'] = $applicant_id;
				$this->load->model('operations_model');
		        $this->operations_model->delete('doclib_record', $doc_id);

		        /*DELETE FILE IN COVAX INFO*/
				$this->load->model('medical_model');
		        $this->medical_model->delete_file('applicant_vaccine_info', 'vaccine_card', $vax_id);
	        }
		}

        redirect('medical/forms/default/'.$applicant_id, 'refresh');
	}
}