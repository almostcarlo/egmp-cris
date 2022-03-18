<?php
defined('BASEPATH') OR exit('No direct script access allowed');

include_once (dirname(__FILE__) . "/Applicant.php");

class Migration extends Applicant{

    public function __construct(){
        parent::__construct();
    }

	public function start(){
		set_time_limit(0);
		echo "DB MIGRATION ONGOING - DO NOT CLOSE THIS PAGE.<br><br>";
		$otherdb = $this->load->database('v1', TRUE);

		$limit = "";
		$scripts = array(array('sql' => "select a.ApplicantId as id, ApplicantCode as code, LastName as lname, FirstName as fname, MiddleName as mname, s.StatusName as status, DateOfBirth as birthdate, BirthPlace as birthplace, CivilStatus as civil_stat, Height as height, Weight as weight, Religion as religion, MobileNo as mobile_no, TelNo as landline_no, Email as email, PermanentAddress as address, BranchId as branch_id, ApplicationSourceId as application_source, AgentId as agent_id, DateApplied as add_date, u.username as add_by, a.Modified as edit_date, '' as edit_by
from applicant a
left join users u
on a.SourceUserId = u.userid
left join applicantno n
on a.ApplicantId = n.ApplicantId
left join applicantstatus s
on n.isStatus = s.ApplicantStatusId {$limit}", 'tbl_name' => 'applicant_general_info'),
						array('sql' => "select ApplicantId as applicant_id, j.JobTitleDesc as position, NOW() as add_date, 'system' as add_by
from applicant a
left join jobtitle j
on a.PositionApply1 = j.JobTitleId {$limit}", 'tbl_name' => 'applicant_applied_pos'),
						array('sql' => "select ApplicantId as applicant_id, School as school_name, Address as location, CASE
    WHEN a.Education = \"College Bachelor's Graduate\" THEN 1
    WHEN a.Education = \"College Undegraduate\" THEN 2
    WHEN a.Education = \"High School\" THEN 5
    WHEN a.Education = \"Vocational\" THEN 9
    WHEN a.Education = \"College 2yr Graduate\" THEN 9
    WHEN a.Education = \"ELEMENTARY\" THEN 4
    ELSE 4
END as level_id, Degree as course, DateFrom as start_date, DateTo as end_date, NOW() as add_date, 'system' as add_by, Modified as edit_date, u.username as edit_by
From applicanteducational a
left join users u
on a.UserId = u.userid {$limit}", 'tbl_name' => 'applicant_education'),
						array('sql' => "select AgentName as code, AgentName as fname, AgentName as lname, Address as address, Contact1 as mobile_no, Email as email, NOW() as add_date, 'system' as add_by, Modified as edit_date, u.username as edit_by from agent a
left join users u
on a.UserId = u.userid {$limit}", 'tbl_name' => 'settings_agent'),
						array('sql' => "select ApplicantId as applicant_id, CompanyName as company_name, JobTitle as position, dateFrom as start_date, DateTo as end_date, Reason as reason_for_leaving, NOW() as add_date, 'system' as add_by, Modified as edit_date, u.username as edit_by from applicantemployment a
left join users u
on a.UserId = u.userid {$limit}", 'tbl_name' => 'applicant_work_history'),
						array('sql' => "select ApplicantTrainingId as applicant_id, ConductedBy as training_center, TrainingTitle as training_desc, DateConducted as start_date, NOW() as add_date, 'system' as add_by, Modified as edit_date, u.username as edit_by
from applincanttraining a
left join users u
on a.UserId = u.userid {$limit}", 'tbl_name' => 'applicant_training'),
						array('sql' => "select ClientId as id, ClientName as name, ClientAddress as address, CountryID as country_id, ContactNumber as tel_no, ContactEmail as email, ClientWebsite as website, NOW() as add_date, 'system' as add_by, u.username as edit_by, c.Modified as edit_date
from client c
left join users u
on c.UserId = u.userid {$limit}", 'tbl_name' => 'manager_principal'),
						array('sql' => "select ClientId as principal_id, ContactPerson as name, ContactPosition as designation, ContactNumber as tel_no, ContactEmail as email, NOW() as add_date, 'system' as add_by from client", 'tbl_name' => 'manager_principal_contacts'),
						array('sql' => "select ClinicId as id, ClinicName as name, Address as address, ContactPerson as contact_person, TelNo as tel_no, FaxNo as fax_no, NOW() as add_date, 'system' as add_by, Modified as edit_date, u.username as edit_by
From clinic c
left join users u
on c.UserId = u.userid {$limit}", 'tbl_name' => 'settings_clinic'),
						array('sql' => "select CountryID as id, CountryName as name, TwoCharCountryCode as country_code from countries", 'tbl_name' => 'settings_country'),
						array('sql' => "select InsuranceId as id, InsuranceName as name, Address as address, ContactPerson as contact_person, TelNo as contact_no, NOW() as add_date, 'system' as add_by, i.Modified as edit_date, u.username as edit_by
from insurance i
left join users u
on i.UserId = u.userid {$limit}", 'tbl_name' => 'settings_insurance_provider'),
						array('sql' => "select ClientId as principal_id, AccredidationNo as accre_no, DateSubmitted as submit_date, DateReceived as receive_date, DateExpired as expiry_date, Approved as issue_date, Status as status, Remarks as remarks, NOW() as add_date, 'system' as add_by, Modified as edit_date, u.username as edit_by
from accreditation a
left join users u
on a.UserId = u.userid {$limit}", 'tbl_name' => 'manager_poea'),
						array('sql' => "select JobOrderId as id, AccreditationId as poea_id, JobOrderNo as jo_id, DateSubmitted as submit_date, DateApproved as approved_date, DateExpired as expiry_date, NOW() as add_date, 'system' as add_by, Modified as edit_date, u.username as edit_by
from joborder j
left join users u
on j.UserId = u.userid {$limit}", 'tbl_name' => 'manager_poea_jo'),
						array('sql' => "select JobOrderDetailsId as id, JobOrderId as jo_id, p.JobTitleDesc as position, CASE WHEN Gender='MALE' THEN 'M' WHEN Gender='FEMALE' THEN 'F' ELSE 'ANY' END as gender, Requirement as quantity, Salary as salary_amount, Remarks as remarks, j.Modified as edit_date, u.username as edit_by, NOW() as add_date, 'system' as add_by
from joborderdetails j
left join users u
on j.UserId = u.userid
left join jobtitle p
on j.JobTitleId = p.JobTitleId {$limit}", 'tbl_name' => 'manager_jo_pos'),
						array('sql' => "select pr.ApplicantId as applicant_id, jd.JobOrderId as poea_request_id, pr.JobOrderDetailsId as poea_request_cat, pr.OECNO as rfp_oec_no, pr.DateApproved as poea_approve_date, pr.Modified as poea_edit_date,
vd.VisaBlockId as request_visa_id, v.VisaBlockDetailsId as request_visa_cat, v.VisaBlockDetailsId as request_approved_cat, v.DateApproved as visa_approved_date, v.ExpiryDate as visa_expiry_date, v.ECode as transmittal_ecode
, mr.ManpowerRequestProdId as lineup_id
from joborderproduction pr
left join joborderdetails jd
on pr.JobOrderDetailsId = jd.JobOrderDetailsId
left join visa_issuanceprod v
on pr.ApplicantId = v.ApplicantId
left join visablockdetails vd
on v.VisaBlockDetailsId = vd.VisaBlockDetailsId
left join manpowerrequestprod mr
on v.ManpowerRequestProdId = mr.ManpowerRequestProdId and pr.ApplicantId = mr.ApplicantId
group by pr.ApplicantId, pr.ManpowerRequestProdId {$limit}", 'tbl_name' => 'applicant_processing'),
						array('sql' => "select JobTitleId as id, UPPER(trim(JobTitledesc)) as `desc`, JobCategoryId as jobspec_id, j.Modified as edit_date, u.username as edit_by, NOW() as add_date, 'system' as add_by
from jobtitle j
left join users u
on j.UserId = u.userid
where 1
and j.JobTitleDesc<>'-' {$limit}", 'tbl_name' => 'settings_position'),
						array('sql' => "select JobCategoryId as id, UPPER(trim(JobCategoryDesc)) as `desc`, NOW() as add_date, 'system' as add_by, j.Modified as edit_date, u.username as edit_by
from jobcategory j
left join users u
on j.UserId = u.userid
where JobCategoryId <> 0
and j.JobCategoryDesc <> '-' {$limit}", 'tbl_name' => 'settings_jobspec'),
						array('sql' => "select ManPowerRequestId as id, PrincipalId as principal_id, ProjectName as project, RequestNo as code, RequestDate as rec_date, DueDate as expiry_date, Duration as contract_duration, FoodAllowance as food, WorkingHours as work_hrs, Transportation as transpo, Accomodation as accomodation, TickerTravel as ticket, m.Modified as edit_date, u.username as edit_by, NOW() as add_date, 'system' as add_by
from manpowerrequest m
left join users u
on m.UserId = u.userid {$limit}", 'tbl_name' => 'manager_mr'),
						array('sql' => "select ManPowerRequestDetailsId as id, d.ManPowerRequestId as mr_id, JobTitleId as pos_id, Requirement as required, d.Salary as salary_amt, m.PrincipalId as principal_id, m.DueDate as expiry_date, m.GenderRequired as gender, NOW() as add_date, 'system' as add_by, d.Modified as edit_date, u.username as edit_by
from manpowerrequestdetails d
left join manpowerrequest m
on d.ManPowerRequestId = m.ManPowerRequestId
left join users u
on d.UserId = u.userid {$limit}", 'tbl_name' => 'manager_jobs'),
						array('sql' => "select m.ManpowerRequestProdId as id, m.ApplicantId as applicant_id, ManPowerRequestId as manpower_id, ManPowerRequestDetailsId as mr_pos_id,
CASE WHEN StatusType = 2 THEN 'Selected' WHEN StatusType = 3 THEN 'Selected' WHEN StatusType = 4 THEN 'Selected' WHEN StatusType = 5 THEN 'Selected' END as lineup_status,
CASE WHEN StatusType = 3 THEN 'Accepted' WHEN StatusType = 4 THEN 'Negotiate' WHEN StatusType = 5 THEN 'Declined' END as lineup_acceptance, SelectionDate as select_date, Remarks as remarks,
m.Modified as edit_date, u.username as edit_by, NOW() as add_date, 'system' as add_by, IF(pd.Deployment=1,'Y','N') as is_deployed, pd.DateDeployed as deployment_date
from manpowerrequestprod m
left join processingdocs pd
on m.ManpowerRequestProdId = pd.ManpowerRequestProdId
left join users u
on m.UserId = u.userid
where 1
and m.ApplcaintNoId <> 0
group by m.ManpowerRequestProdId, m.ApplicantId {$limit}", 'tbl_name' => 'applicant_lineup'),
						array('sql' => "select r.MedicalResultId as id, ApplicantId as applicant_id, ClinicId as clinic_id, ReferralDate as clinic_ref_taken_date, MedicalDate as clinic_exam_date, MedicalStatus as med_result,
Remarks as med_result_clinic_remarks, GROUP_CONCAT(d.DetailsRemarks SEPARATOR '<br><br>') as med_result_findings, r.ExpiryDate as med_result_exp_date, NOW() as add_date, 'system' as add_by, r.Modified as edit_date, u.username as edit_by
From medicalresult r
left join medicalresultdetails d
on r.MedicalResultId = d.MedicalResultId
left join users u
on r.UserId = u.userid
group by r.ApplicantId {$limit}", 'tbl_name' => 'applicant_medical_info'),
						array('sql' => "select '13' as type_id, ApplicantId as applicant_id, PassportNo as serial_no, 'Passport' as description, PassPortIssueDate as issue_date, PassPortExpiryDate as expiry_date, PassPortIssuedAt as remarks, NOW() as add_date, 'system' as add_by
from processingdocs
where PassportNo <> '' {$limit}", 'tbl_name' => 'applicant_uploads'),
						/*array('sql' => "select '12' as type_id, ApplicantId as applicant_id, 'NBI Clearance' as description, NBIIssuedDate as issue_date, NBIExpiredDate as expiry_date, NOW() as add_date, 'system' as add_by
from processingdocs
where NBIIssuedDate <> '0000-00-00'
and NBIIssuedDate <> '' {$limit}", 'tbl_name' => 'applicant_uploads'),*/
						array('sql' => "select u.userid as id, u.username, password('delux789') as password, u.fullname as name, d.DepartmentName as department, 1 as branch_id, NOW() as add_date, 'system' as add_by
From users u
left join userdepartment d
on u.userdepartmentid = d.UserDepartmentId {$limit}", 'tbl_name' => 'settings_users'),
						array('sql' => "select ApplicantId as applicant_id, i.VisaNo as visa_no, i.SponsorId as sponsor_id, b.ClientId as principal_id, b.CountryID as country_id, i.VisaDate as visa_date, i.DateApproved as visa_stamp, i.NoDays as days_valid, i.VisaExpired as expiry_date, IF(i.VisaisActive=1,'Valid','Invalid') as Status, i.Modified as edit_date, u.username as edit_by, NOW() as add_date, 'system' as add_by
From visa_issuanceprod i
left join visablock b
on i.VisaBlockId = b.VisaBlockId
left join users u
on i.UserId = u.userid
where i.VisaType='Individual' {$limit}", 'tbl_name' => 'manager_visa_nonksa'),
						array('sql' => "select VisaBlockId as id, VisaNo as visa_no, SponsorId as sponsor_no, ClientId as principal_id, VisaDate as visa_date, VisaExpired as expiry_date, VisaType as type, NOW() as add_date, 'system' as add_by, b.Modified as edit_date, u.username as edit_by
from visablock b
left join users u
on b.UserId = u.userid {$limit}", 'tbl_name' => 'manager_visa'),
						array('sql' => "select VisaBlockDetailsId as id, VisaBlockId as visa_id, j.JobTitleDesc as position, v.Requirement as quantity, v.Remarks as remarks, NOW() as add_date, 'system' as add_by, v.Modified as edit_date, u.username as edit_by
from visablockdetails v
left join jobtitle j
on v.JobTitleId = j.JobTitleId
left join users u
on v.UserId = u.userid {$limit}", 'tbl_name' => 'manager_visa_pos'),
						array('sql' => "select i.ApplicantInsuranceId as id, ApplicantId as applicant_id, i.ManpowerRequestProdId as lineup_id, InsuranceId as provider_id, ReferralDate as referral_date, InsuranceDate as insurance_date, ExpiryDate as expiry_date, Remarks as remarks, i.Modified as edit_date, u.username as edit_by, NOW() as add_date, 'system' as add_by
from applicantinsurance i
left join users u
on i.UserId = u.userid {$limit}", 'tbl_name' => 'applicant_insurance'),
						array('sql' => "select AirlineTicketId as id, ApplcaintNoId as applicant_id, ManpowerRequestProdId as lineup_id, RequestDate as request_date, FlighDate as pr_book_date, FlighDate as book_date,
FlightTime as flight_time, ReceivedDate as received_date,
CASE WHEN a.AirlineCompany = 'ETIHAD' THEN 12 WHEN a.AirlineCompany = 'etihad airways' THEN 12 WHEN a.AirlineCompany = 'pal' THEN 21 WHEN a.AirlineCompany = 'PHILIPPINE AIRLINES' THEN 21 WHEN a.AirlineCompany = 'SAUDIA AIRLINES' THEN 25 WHEN a.AirlineCompany = 'SCOOT' THEN 43 END as airline_id,
TicketNo as ticket_no, PlaneNo as plane_no, TerminalNo as terminal_no, Remarks as remarks, NOW() as add_date, 'system' as add_by, Modified as edit_date, u.username as edit_by
From airlineticket a
left join users u
on a.UserId = u.userid {$limit}", 'tbl_name' => 'applicant_booking'));

		foreach($scripts as $s){
			if($s['sql'] <> ''){
				$sql_query = stripslashes($s['sql']);
				$tbl_name = $s['tbl_name'];
				$query_result = $otherdb->query($sql_query);
		        $data = $query_result->result_array();

		        if($data && count($data) > 0){
		        	$field_names = array();
		        	$field_values = "";

		        	foreach($data as $d){
		        		$aValues = array();
		        		foreach($d as $key => $val){
		        			$field_names[$key] = "`".$key."`";					/*GET DISTINCT FIELD NAME*/
		        			array_push($aValues, "'".addslashes($val)."'");		/*GET FIELD VALUES*/
		        		}

		        		$sValues = implode(',', $aValues);
		        		$field_values .= "({$sValues}),";
		        	}

		        	$field_names = implode(",", $field_names);
		        	$field_values = substr($field_values, 0, -1);	/*REMOVE TRAILING COMMA*/
		        	$insert_query = "insert into {$tbl_name} ({$field_names}) values {$field_values}";

		        	/*TRUNCATE TBL*/
		        	//$truncate = dbsetdata("truncate {$tbl_name}");

		        	/*INSERT DATA*/
		        	$insert = dbsetdata($insert_query);
		        	if($insert > 0){
		        		echo $tbl_name." update successful.<br>";
		        	}
		        }else{
		        	echo $tbl_name." no data found.<br>";
		        }
			}
		}

		echo "<br>DB MIGRATION HAS BEEN COMPLETED.";
	}

	public function get_docs(){
		if(isset($_GET['limit'])){
			$limit = $_GET['limit'];
		}else{
			$limit = 100;
		}

		$limit_start = 0;
		if(isset($_REQUEST['limit_start'])){
			$limit_start += ($limit + $_REQUEST['limit_start']);
		}else{
			$limit_start = 0;
		}

		set_time_limit(0);
		ini_set('memory_limit', '-1');
		echo date("F d, Y h:i:sa")."<br>";
		echo "UPLOADING DOCS FROM BLOB<br>######################<br>";

		// /*DELETE EXISTING NBI RECORD*/
		// dbsetdata("delete from applicant_uploads where description='NBI Clearance'");

		// /*UPDATE DESCRIPTIONS IN V1*/
		// dbsetdata_otherdb("update processingdocsfile set DocType='Open Account' where DocType='OpenAccount'", "v1");
		// dbsetdata_otherdb("update processingdocsfile set DocType='Other Docs' where DocType='OtherDocs'", "v1");
		// dbsetdata_otherdb("update processingdocsfile set DocType='Other ID' where DocType='OtherId'", "v1");
		// dbsetdata_otherdb("update processingdocsfile set DocType='Profile Pic' where DocType='Photo2x'", "v1");
		// dbsetdata_otherdb("update processingdocsfile set DocType='PRC License' where DocType='PRCLicense'", "v1");
		// dbsetdata_otherdb("update processingdocsfile set DocType='Red Ribbon' where DocType='RedRibbon'", "v1");
		// dbsetdata_otherdb("update processingdocsfile set DocType='Resume/CV' where DocType='Resume';", "v1");
		// dbsetdata_otherdb("update processingdocsfile set DocType='Saudi Council' where DocType='SaudiCouncil'", "v1");
		// dbsetdata_otherdb("update processingdocsfile set DocType='Voters ID' where DocType='VotersId'", "v1");
		// dbsetdata_otherdb("update processingdocsfile set DocType='Biometrics' where DocType='BioMetrics'", "v1");
		// dbsetdata_otherdb("update processingdocsfile set DocType='Philhealth' where DocType='PhilHealth'", "v1");
		// dbsetdata_otherdb("update processingdocsfile set DocType='Medical' where DocType='MEDICAL'", "v1");

		$otherdb = $this->load->database('v1', TRUE);
		$sql_query = "select p.ApplicantId, p.NBIIssuedDate, p.NBIExpiredDate, f.*
						from processingdocsfile f
						left join processingdocs p
						on f.ProcessingDocsId = p.ProcessingDocsId
						where 1
						and f.ImageFile <> ''
						and p.ApplicantId > 0
						limit {$limit_start},{$limit}";
		$query_result = $otherdb->query($sql_query);
        $data = $query_result->result_array();

        if($data && count($data) > 0){
        	foreach($data as $d){
    			$other_description = pathinfo($d['ImageFileName'], PATHINFO_FILENAME);
    			$description = $d['DocType'];

        		foreach($this->doc_type as $code => $doc){
        			if($doc['desc'] == $d['DocType']){
						$filename = $code."-".pathinfo($other_description, PATHINFO_FILENAME);
						$type_id = $doc['id'];
        			}
        		}

        		$filepath = "./uploads/applicant/{$d['ApplicantId']}/";

        		/* CHECK IF UPLOAD FOLDER EXIST */
	    		if(!is_dir($filepath)) mkdir($filepath, 0777, TRUE);

	    		$filename .= ".".pathinfo($d['ImageFileName'], PATHINFO_EXTENSION);

	    		if(file_put_contents($filepath.$filename, $d['ImageFile'])){
	    			$q_insert = "insert into applicant_uploads (type_id, applicant_id, filename, description, issue_date, expiry_date, add_by, add_date) values";
	    			$q_filename = addslashes($filepath.$filename);

	    			if($d['DocType'] == 'NBI'){
	    				$q_insert .= "({$type_id},{$d['ApplicantId']}, '{$q_filename}', '{$description}', '{$d['NBIIssuedDate']}', '{$d['NBIExpiredDate']}', 'system', '{$d['Modified']}'),";
	    			}else{
	    				$q_insert .= "({$type_id},{$d['ApplicantId']}, '{$q_filename}', '{$description}', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'system', '{$d['Modified']}'),";
	    			}

					/*REMOVE TRAILING COMMA*/
					$q_insert = substr($q_insert, 0, -1);

					/*INSERT DATA*/
					$insert = dbsetdata($q_insert);

				  	if($insert > 0){
				  		echo $q_filename." UPLOAD SUCCESSFUL.<br>";
				  	}else{
				  		echo $q_filename." <font color=\"red\">ERROR INSERTING INTO TBL.</font><br>";
				  	}
	    		}else{
	    			echo $filename." <font color=\"red\">ERROR UPLOADING FILE.</font><br>";
	    		}
        	}

	        echo "<br>";
	        echo date("F d, Y h:i:sa")."<br>";
	        echo "BATCH FINISHED.";

	        echo "<script type=\"text/javascript\">
	        	var time_to_reload = 5000;
				if(time_to_reload > 0){
					setTimeout(\"location.href = '".BASE_URL."migration/get_docs?limit_start=".$limit_start."&limit=".$limit."';\", time_to_reload);
				}
	        </script>";
        }else{
        	echo "DOCS MIGRATION FINISHED.";
        }
	}
}