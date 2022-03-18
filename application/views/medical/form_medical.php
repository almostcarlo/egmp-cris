<?php
// var_dump($med_archive);
// exit();
    if($med_info){
        $id = $med_info[0]['id'];
        $branch_id = $med_info[0]['branch_id'];
        $pre_med_status = $med_info[0]['pre_med_status'];
        $pre_med_date= $med_info[0]['pre_med_date'];
        $ppt_copy_date= $med_info[0]['ppt_copy_date'];
        $gamca_req_date= $med_info[0]['gamca_req_date'];
        $gamca_req_by= $med_info[0]['gamca_req_by'];
        $gamca_ref_date= $med_info[0]['gamca_ref_date'];
        $gamca_result= $med_info[0]['gamca_result'];
        $gamca_sn= $med_info[0]['gamca_sn'];
        $clinic_id= $med_info[0]['clinic_id'];
        $clinic_ref_taken_date= $med_info[0]['clinic_ref_taken_date'];
        $clinic_verify= $med_info[0]['clinic_verify'];
        $clinic_exam_date= $med_info[0]['clinic_exam_date'];
        $med_result= $med_info[0]['med_result'];
        $med_result_rec_date= $med_info[0]['med_result_rec_date'];
        $med_result_trans_date= $med_info[0]['med_result_trans_date'];
        $med_result_issue_date= $med_info[0]['med_result_issue_date'];
        $med_result_exp_date= $med_info[0]['med_result_exp_date'];
        $med_result_blood_type= $med_info[0]['med_result_blood_type'];
        $med_result_findings= $med_info[0]['med_result_findings'];
        $med_result_clinic_remarks= $med_info[0]['med_result_clinic_remarks'];
        $waiver_needed= $med_info[0]['waiver_needed'];
        $waiver_rel_date= $med_info[0]['waiver_rel_date'];
        $waiver_app_date= $med_info[0]['waiver_app_date'];
        $or_branch_rec_date= $med_info[0]['or_branch_rec_date'];
        $or_branch_rec_by= $med_info[0]['or_branch_rec_by'];
        $or_counter_rec_date= $med_info[0]['or_counter_rec_date'];
        $or_counter_rec_by= $med_info[0]['or_counter_rec_by'];
        $or_group_remarks= $med_info[0]['or_group_remarks'];
        //$ = $med_info[0][''];
        //$ = $med_info[0][''];
        //$ = $med_info[0][''];
    }else{
        $id = "";
        $branch_id = "";
        $pre_med_status = "";
        $pre_med_date = "";
        $ppt_copy_date = "";
        $gamca_req_date = "";
        $gamca_req_by = "";
        $gamca_ref_date = "";
        $gamca_result = "";
        $gamca_sn = "";
        $clinic_id= "";
        $clinic_ref_taken_date= "";
        $clinic_verify= "";
        $clinic_exam_date= "";
        $med_result= "";
        $med_result_rec_date= "";
        $med_result_trans_date= "";
        $med_result_issue_date= "";
        $med_result_exp_date= "";
        $med_result_blood_type= "";
        $med_result_findings= "";
        $med_result_clinic_remarks= "";
        $waiver_needed= "";
        $waiver_rel_date= "";
        $waiver_app_date= "";
        $or_branch_rec_date= "";
        $or_branch_rec_by= "";
        $or_counter_rec_date= "";
        $or_counter_rec_by= "";
        $or_group_remarks= "";
    }
?>
<section role="main" class="content-body">
                  
	<header class="page-header">
		<h2>Medical Form</h2>
	</header>

	<div class="row">
		<!-- APPLICANT INFORMATION -->
		<?php include APPPATH.'views/parts/applicant_information.php';?>
		
		<div class="col-md-12">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">Medical Information</h3>
				</header>
				<div class="panel-body">
				
				<?php if(isset($_SESSION['settings_notification_status']) && $_SESSION['settings_notification_status'] == 'Success'):?>
                	<div id="" class="alert alert-success alert-dismissible" role="alert">
                        <strong>SUCCESS!</strong><br>
                        <div id=""><strong><span id="inputRequired"></span></strong><?php echo $_SESSION['settings_notification'];?></div>
                    </div>
				<?php endif;?>
				
				<?php if(isset($_SESSION['settings_notification_status']) && $_SESSION['settings_notification_status'] == 'Error'):?>
                    <div id="" class="alert alert-danger alert-dismissible" role="alert">
                        <strong>ERROR!</strong><br>
                        <div id=""><strong><span id="inputRequired"></span></strong><?php echo $_SESSION['settings_notification'];?></div>
                    </div>
				<?php endif;?>
				
                <div id="errorNotice" class="alert alert-danger alert-dismissible" role="alert">
                    <strong>ERROR!</strong><br>
                    <div id="defaultNoticeCont"><strong><span id="inputRequired"></span></strong></div>
                </div>
                    
                    <?php echo form_open('medical/save', 'id="frm_medical"');?>
                    	
                    	<input type="hidden" value="<?php echo $applicant_data['personal']->id;?>" name="applicant_id" >
                    	<input type="hidden" value="<?php echo $id;?>" name="textRecordId" >
                        
                        <div class="row">
                            <div class="col-md-6" style="padding-left:15px;padding-right:15px;">
                                
                                <h4>Pre-Med Info</h4>
                                
                                <div class="row" id="divAppliedPos">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textAppliedCat">Branch:</label>
                                            <select name="selectBranch" id="selectBranch" class="form-control input-sm">
                                            	<?php echo dropdown_options('branch', $branch_id);?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textAppliedCat2">Pre-Med Result:</label>
                                            <select name="selectPreStat" id="selectPreStat" class="form-control input-sm">
                                            	<option value="">please select</option>
                                            	<option value="fit" <?php echo ($pre_med_status=='fit')?"selected=\"selected\"":"";?>>Fit</option>
                                            	<option value="unfit" <?php echo ($pre_med_status=='unfit')?"selected=\"selected\"":"";?>>Unfit</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group" id="">
                                            <label for="textPreMedDate">Pre-Med Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textPreMedDate" name="textPreMedDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($pre_med_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textPreMedDate">PPT Copy:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textPptCopy" name="textPptCopy" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($ppt_copy_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />
                                
                                <!-- <h4>GAMCA Referral</h4>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group" id="">
                                            <label for="textDeckReq">Decking Requested:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textDeckReq" name="textDeckReq" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($gamca_req_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="selectReqBy">Requested By:</label>
                                            <select name="selectReqBy" id="selectReqBy" class="form-control input-sm">
                                            	<?php echo dropdown_options('users', $gamca_req_by);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group" id="">
                                            <label for="textRefRec">Referral Received:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textRefRec" name="textRefRec" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($gamca_ref_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="selectGamcaRes">Result:</label>
                                            <select name="selectGamcaRes" id="selectGamcaRes" class="form-control input-sm">
                                            	<option value="">please select</option>
                                            	<option value="other agency application" <?php echo ($gamca_result=='other agency application')?"selected=\"selected\"":"";?>>Other agency application</option>
                                            	<option value="pending verification" <?php echo ($gamca_result=='pending verification')?"selected=\"selected\"":"";?>>Pending verification</option>
                                            	<option value="unfit from other agency" <?php echo ($gamca_result=='unfit from other agency')?"selected=\"selected\"":"";?>>Unfit from other agency</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row" id="">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textGamcaSN">SN:</label>
                                            <input type="text" id="textGamcaSN" name="textGamcaSN" class="form-control input-sm" placeholder="" value="<?php echo $gamca_sn;?>" />
                                        </div>
                                    </div>
                                </div> -->
                                
                                <hr />
                                
                                <h4>Clinic Info</h4>
                                
                                <div class="row" id="">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textLastName">Clinic:</label>
                                            <select name="selectClinic" id="selectClinic" class="form-control input-sm">
                                            	<?php echo dropdown_options('clinic', $clinic_id);?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-sm">
                                        <label for="textRefTaken">Referral Taken:</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                <i class="fa fa-calendar"></i>
                                            </span>
                                            <input id="textRefTaken" name="textRefTaken" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($clinic_ref_taken_date,2);?>">
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="selectVerify">Verify Date:</label>
                                            <select id="selectVerify" name="selectVerify" class="form-control input-sm">
                                            	<option value="">please select</option>
                                                <option value="verified" <?php echo ($clinic_verify=='verified')?"selected=\"selected\"":"";?>>Verified</option>
                                                <option value="for verification" <?php echo ($clinic_verify=='for verification')?"selected=\"selected\"":"";?>>For Verification</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group" id="divBday">
                                            <label for="textMedDate">Medical Exam Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textMedDate" name="textMedDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($clinic_exam_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-md-6" style="padding-left:15px;padding-right:15px;">
                            
                                <hr />
                                
                                <h4>Medical Result</h4>

                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textWorkPosition">Result:</label>
                                            <select name="selectResult" id="selectResult" class="form-control input-sm">
                                            	<option value="">please select</option>
                                            	<option value="pending" <?php echo ($med_result=='pending')?"selected=\"selected\"":""?>>Pending</option>
                                            	<option value="pending mmr" <?php echo ($med_result=='pending mmr')?"selected=\"selected\"":""?>>Pending MMR</option>
                                            	<option value="fit" <?php echo ($med_result=='fit')?"selected=\"selected\"":""?>>Fit</option>
                                            	<option value="not recommendable" <?php echo ($med_result=='not recommendable')?"selected=\"selected\"":""?>>Not Recommendable</option>
                                            	<option value="unfit" <?php echo ($med_result=='unfit')?"selected=\"selected\"":""?>>Unfit</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textResultDate">Result Received Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textResultDate" name="textResultDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($med_result_rec_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textTransDate">Transmittal Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textTransDate" name="textTransDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($med_result_trans_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textIssueDate">Issue Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textIssueDate" name="textIssueDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($med_result_issue_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textExpDate">Medical Expiry:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textExpDate" name="textExpDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($med_result_exp_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="selectBloodType">Blood Type:</label>
                                            <select name="selectBloodType" id="selectBloodType" class="form-control input-sm">
                                            	<option value="">please select</option>
                                            	<option value="A" <?php echo ($med_result_blood_type=='A')?"selected=\"selected\"":"";?>>A</option>
                                            	<option value="A+" <?php echo ($med_result_blood_type=='A+')?"selected=\"selected\"":"";?>>A+</option>
                                            	<option value="AB" <?php echo ($med_result_blood_type=='AB')?"selected=\"selected\"":"";?>>AB</option>
                                            	<option value="AB+" <?php echo ($med_result_blood_type=='AB+')?"selected=\"selected\"":"";?>>AB+</option>
                                            	<option value="B" <?php echo ($med_result_blood_type=='B')?"selected=\"selected\"":"";?>>B</option>
                                            	<option value="B+" <?php echo ($med_result_blood_type=='B+')?"selected=\"selected\"":"";?>>B+</option>
                                            	<option value="O" <?php echo ($med_result_blood_type=='O')?"selected=\"selected\"":"";?>>O</option>
                                            	<option value="O+" <?php echo ($med_result_blood_type=='O+')?"selected=\"selected\"":"";?>>O+</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-8 mt-sm">
                                        <div class="form-group">
                                            <label for="textFindings">Findings:</label>
                                            <textarea name="textFindings" id="textFindings" class="form-control input-sm"><?php echo $med_result_findings;?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-8 mt-sm">
                                        <div class="form-group">
                                            <label for="textRemarks">Clinic Remarks:</label>
                                            <textarea name="textRemarks" id="textRemarks" class="form-control input-sm"><?php echo $med_result_clinic_remarks;?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <br>
                                <label for="checkWaiver"><input type="checkbox" id="checkWaiver" name="checkWaiver" <?php echo ($waiver_needed=='Y')?"checked=\"checked\"":"";?> style="vertical-align:top"> Need waiver?</label>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textWaiverRel">Waiver Released Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textWaiverRel" name="textWaiverRel" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($waiver_rel_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textWaiverApp">Waiver Approved Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textWaiverApp" name="textWaiverApp" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($waiver_app_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />
                                
                                <h4>Receipt of Original Certificate</h4>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textCertRecBr">In Branch:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textCertRecBr" name="textCertRecBr" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($or_branch_rec_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="selectCertBrRecBy">Received By:</label>
                                            <select name="selectCertBrRecBy" id="selectCertBrRecBy" class="form-control input-sm">
                                            	<?php echo dropdown_options('users', $or_branch_rec_by);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textCertRecCounter">By Counter:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textCertRecCounter" name="textCertRecCounter" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($or_counter_rec_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="selectCertCounterRecBy">Received By:</label>
                                            <select name="selectCertCounterRecBy" id="selectCertCounterRecBy" class="form-control input-sm">
                                            	<?php echo dropdown_options('users', $or_counter_rec_by);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-8 mt-sm">
                                        <div class="form-group">
                                            <label for="textRemarks">Medical Group Remarks:</label>
                                            <textarea name="textGroupRemarks" id="textGroupRemarks" class="form-control input-sm"><?php echo $or_group_remarks;?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />

                                <div class="row">
                                    <div class="col-sm-6">
                                        <!-- <a href="applicant-profile.php" class="btn btn-block btn-primary">Submit</a> -->
                                        <input type="button" value="Submit" class="btn btn-block btn-primary" id="btn_savemedform">
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="<?php echo BASE_URL;?>medical/archive/<?php echo base64_encode($id);?>" class="btn btn-block btn-danger <?php echo ($id!='' && $med_result!='')?"":"disabled";?>" onclick="if(confirm('Medical Record will be sent to archives. Do you want to proceed?')){return true;}else{return false;}">Archive Current Medical Data</a>
                                    </div>
                                </div>
                                
                            
                            </div>
                            
                        </div>
                        
                    </form>
                    
                </div>
            </section>
            
            <?php if($med_archive):?>
                <section class="panel">
                    <header class="panel-heading">
    					<h3 class="panel-title">Medical History</h3>
    				</header>
    				<div class="panel-body">
                        <div class="">
    					
                            <table class="table table-striped table-condensed table-hover mb-none" id="datatable_SearchApplicant">
                                <thead>
                                    <tr>
                                        <th width="20%">Clinic</th>
                                        <th width="10%">Exam Date</th>
                                        <th width="10%">Expiry Date</th>
                                        <th width="10%">Status</th>
                                        <th width="25%">Findings</th>
                                        <th width="25%">Remarks</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($med_archive as $info):?>
                                	<tr>
                                		<td><?php echo $info['clinic'];?></td>
                                		<td><?php echo dateformat($info['clinic_exam_date'],1);?></td>
                                		<td><?php echo dateformat($info['med_result_exp_date'],1);?></td>
                                		<td><?php echo $info['med_result'];?></td>
                                		<td><?php echo $info['med_result_findings'];?></td>
                                		<td><?php echo $info['med_result_clinic_remarks'];?></td>
                                	</tr>
                                <?php endforeach;?>
                                </tbody>
                            </table>
                        
                        </div>
    				</div>
    			</section>
			<?php endif;?>

            <section class="panel">
                <header class="panel-heading">
                    <h3 class="panel-title">PCR Testing</h3>
                </header>
                <div class="panel-body">
                    <?php flashNotification();?>

                    <div class="">
                        <?php echo form_open('medical/save/pcr', 'id="frm_medical"');?>

                            <input type="hidden" value="<?php echo $applicant_data['personal']->id;?>" name="applicant_id" >
                            <input type="hidden" value="" name="textRecordId" >

                            <div class="row">
                                <div class="col-md-6" style="padding-left:15px;padding-right:15px;">
                                    
                                    <div class="row" id="">
                                        <div class="col-md-4 mt-sm">
                                            <div class="form-group">
                                                <label for="">Testing Date:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input id="textPCRdate" name="textPCRdate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-sm">
                                            <div class="form-group">
                                                <label for="">Result:</label>
                                                <input type="text" name="textPRCResult" class="form-control input-sm">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="">
                                        <div class="col-md-8 mt-sm">
                                            <div class="form-group">
                                                <label for="textLastName">Clinic:</label>
                                                <select name="selectPCRClinic" id="selectPCRClinic" class="form-control input-sm">
                                                    <?php echo dropdown_options('clinic');?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mt-sm">
                                            <div class="form-group">
                                                <label for="textLastName">Amount:</label>
                                                <input type="text" name="textPCRAmt" class="form-control input-sm" placeholder="0.00">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="submit" value="Submit" class="btn btn-block btn-primary" id="btn_savemepcr">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6" style="padding-left:15px;padding-right:15px;">

                                    <h4>PRC Testing History</h4>
                        
                                    <table class="table table-striped table-condensed table-hover mb-none" id="datatable_SearchApplicant">
                                        <thead>
                                            <tr>
                                                <th width="20%">Clinic</th>
                                                <th width="10%">Testing Date</th>
                                                <th width="10%">Result</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach ($pcr_history as $info):?>
                                            <tr>
                                                <td><?php echo $info['clinic'];?></td>
                                                <td><?php echo dateformat($info['testing_date'],1);?></td>
                                                <td><?php echo $info['result'];?></td>
                                            </tr>
                                        <?php endforeach;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </section>

            <!-- VACCINE FORM -->
            <section class="panel">
                <header class="panel-heading">
                    <h3 class="panel-title">COVID Vaccine</h3>
                </header>
                <div class="panel-body">
                    <?php flashNotification();?>

                    <div class="">
                        <?php echo form_open('medical/save/vaccine', 'id="frm_vacc" enctype="multipart/form-data"');?>

                            <input type="hidden" value="<?php echo $applicant_data['personal']->id;?>" name="textApplicant_id" >
                            <input type="hidden" name="textRecordId" value="<?php echo ($vaccine_info && $vaccine_info[0]['id']<>'')?$vaccine_info[0]['id']:"";?>">

                            <div class="row">
                                <div class="col-md-6" style="padding-left:15px;padding-right:15px;">

                                    <div class="row" id="">
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="textLastName">Vaccinated?:</label>
                                                <select name="selectVaccinated" id="selectVaccinated" class="form-control input-sm">
                                                    <option value="Y" <?php echo ($vaccine_info && $vaccine_info[0]['vaccinated']=='Y')?"selected=\"selected\"":"";?>>Yes</option>
                                                    <option value="N" <?php echo ($vaccine_info && $vaccine_info[0]['vaccinated']=='N')?"selected=\"selected\"":"";?>>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="textLastName">Brand:</label>
                                                <select name="selectBrand" id="selectBrand" class="form-control input-sm">
                                                    <?php echo generate_dd($covax_brand, $vaccine_info[0]['brand']);?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row" id="">
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Venue:</label>
                                                <input type="text" name="textVenue" id="textVenue" class="form-control input-sm" value="<?php echo ($vaccine_info && $vaccine_info[0]['venue']<>'')?$vaccine_info[0]['venue']:"";?>">
                                            </div>
                                        </div>
                                        <div class="col-md-3 mt-sm">
                                            <div class="form-group">
                                                <label for="">1st Dose:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input id="text1stDose" name="text1stDose" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo ($vaccine_info && $vaccine_info[0]['1st_dose']<>'')?dateformat($vaccine_info[0]['1st_dose'],2):"";?>">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3 mt-sm">
                                            <div class="form-group">
                                                <label for="">2nd Dose:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input id="text2ndDose" name="text2ndDose" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo ($vaccine_info && $vaccine_info[0]['2nd_dose']<>'')?dateformat($vaccine_info[0]['2nd_dose'],2):"";?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row" id="">
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="textLastName">Upload Vaccine Card:</label>
                                                <?php if(($vaccine_card_info && $vaccine_card_info[0]['filename']<>'')):?>
                                                    <!-- $this_url = BASE_URL."applicant/my_files/".base64_encode($doc_info['id']); -->
                                                    <p><a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($vaccine_card_info[0]['id'])?>" target="_blank"><?php echo $vaccine_card_info[0]['filename'];?></a> <a href="<?php echo BASE_URL."medical/delete_vaccine_card/".$applicant_data['personal']->id."/".$vaccine_card_info[0]['id']."/".$vaccine_info[0]['id'];?>" onclick="if(confirm('Vaccine Card will be deleted. Do you want to proceed?')){return true;}else{return false;}" style="color:red;">[delete file]</a></p>
                                                <?php else:?>
                                                    <input type="file" name="fileCovax" id="fileCovax" class="form-control input-sm">
                                                <?php endif;?>
                                            </div>
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <input type="submit" value="Submit" class="btn btn-block btn-primary" id="btn_savemepcr">
                                        </div>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </div>
                </div>
            </section>
            <!-- END VACCINE FORM -->
            
		</div>
	</div>
</section>