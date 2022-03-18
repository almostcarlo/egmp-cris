<?php
if(isset($info)){
    $id = $info[0]['id'];
    $principal_id = $info[0]['principal_id'];
    $code = $info[0]['code'];
    $activity = explode('/',$info[0]['activity']);
    $doc_jdq = $info[0]['doc_jdq'];
    $rs = $info[0]['rs'];
    $rso = $info[0]['rso'];
    $fee = $info[0]['fee_condition'];
    $company_id = $info[0]['company_id'];
    $is_pooling = $info[0]['is_pooling'];
    $status = $info[0]['status'];
    $exp_date = $info[0]['expiry_date'];
    $rec_date = $info[0]['rec_date'];
    $contract_duration = $info[0]['contract_duration'];
    $allowance = $info[0]['allowance'];
    $food = $info[0]['food'];
    $work_hrs = $info[0]['work_hrs'];
    $transpo = $info[0]['transpo'];
    $accomodation = $info[0]['accomodation'];
    $ticket = $info[0]['ticket'];
    $others = $info[0]['others'];
    $project = $info[0]['project'];
    $header = $code;
}else{
    $id = "";
    $principal_id = "";
    $code = "";
    $activity = array('0'=>'LU');
    $doc_jdq = "";
    $company_id = "";
    $rs = "";
    $rso = "";
    $fee = "";
    $is_pooling = "N";
    $status = "1";
    $exp_date = "";
    $rec_date = "";
    $contract_duration = "";
    $allowance = "";
    $food = "";
    $work_hrs = "";
    $transpo = "";
    $accomodation = "";
    $ticket = "";
    $others = "";
    $project = "";
    $header = "Create New MR";
}
?>

<section role="main" class="content-body">
                    
	<header class="page-header">
		<h2>MR Manager</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-8">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title"><?php echo $header;?></h2>
                </header>
                <div class="panel-body">
                
					<?php flashNotification();?>
                    
                        <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                            <strong>ERROR!</strong><br>
                            <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
                        </div>
                        
                    	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                            <strong>SUCCESS!</strong><br>
                            <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
                        </div>
                    
                    <?php echo form_open_multipart('recruitment/create/form_mr_manager', 'id="frm_mr"')?>
                    	
                    	<input type="hidden" name="textRecordId" id="textRecordId" value="<?php echo $id;?>">
                    	<input type="hidden" name="textCurrentTab" id="textCurrentTab" value="<?php echo $current_tab;?>">
                    	<!-- <input type="hidden" name="textPrincipalId" id="textPrincipalId" value="<?php echo $principal_id;?>"> -->

                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <label for="">Principal:</label>
                                    <select id="selectPrincipal" name="selectPrincipal" onchange="generateMRRef(); populatedd('company', 'principal', '#selectPrincipal');" class="form-control input-sm">
                                        <?php echo dropdown_options('principal', $principal_id, 1);?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <!-- <div class="form-group">
                                    <label for="textCompany">Company:</label>
                                    <select id="selectCompany" name="selectCompany" class="form-control input-sm">
                                        <?php echo dropdown_options('company', $company_id, 1);?>
                                    </select>
                                </div> -->
                                <div class="form-group">
                                    <label for="textCompany">Project:</label>
                                    <input type="text" class="form-control input-sm" name="textProject" id="textProject" value="<?php echo $project;?>">
                                    <input type="hidden" name="selectCompany" value="">
                                </div>
                            </div>
                        </div>
            
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <label for="">Reference No.:</label>
                                    <input type="text" id="textRefCode" name="textRefCode" value="<?php echo $code;?>" readonly="readonly" class="form-control input-sm" />
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <label for="selectStatus">Status:</label>
                                    <select id="selectStatus" name="selectStatus" class="form-control input-sm">
                                        <option value="1" <?php echo ($status==1)?"selected=\"selected\"":""?>>Active</option>
                                        <option value="2" <?php echo ($status==2)?"selected=\"selected\"":""?>>On-Hold</option>
                                        <option value="0" <?php echo ($status==0)?"selected=\"selected\"":""?>>Closed</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="">Activity:</label><br />
                                    <label style="font-weight:normal;"><input class="chkAct" name="chkActivity[]" type="checkbox" value="LU" style="margin:0;vertical-align:middle;" style="margin:0;vertical-align:middle;" <?php echo (in_array('LU', $activity))?"checked=\"checked\"":"";?> /> LU</label>&nbsp;&nbsp;&nbsp;
                                    <label style="font-weight:normal;"><input class="chkAct" name="chkActivity[]" type="checkbox" value="CV" style="margin:0;vertical-align:middle;" <?php echo (in_array('CV', $activity))?"checked=\"checked\"":"";?> /> CV</label>&nbsp;&nbsp;&nbsp;
                                    <label style="font-weight:normal;margin-top:6px;"><input class="chkAct" name="chkActivity[]" type="checkbox" value="FR" style="margin:0;vertical-align:middle;" <?php echo (in_array('FR', $activity))?"checked=\"checked\"":"";?>/> FR</label>
                                </div>
                            </div>
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                	<label for="">Pooling MR:</label><br />
                                    <select id="selectPooling" name="selectPooling" class="form-control input-sm">
                                        <option value="Y" <?php echo ($is_pooling=='Y')?"selected=\"selected\"":""?>>Yes</option>
                                        <option value="N" <?php echo ($is_pooling=='N')?"selected=\"selected\"":""?>>No</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <label for="selectFeeCondition">Fee Condition:</label>
                                    <select id="selectFeeCondition" name="selectFeeCondition" class="form-control input-sm">
                                        <?php echo generate_dd($this->fee_cond, $fee);?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="selectRA">Assigned RS:</label>
                                    <select id="selectRS" name="selectRS" class="form-control input-sm">
                                        <?php echo dropdown_options('users', $rs);?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="">RSO:</label>
                                    <select id="selectRSO" name="selectRSO" class="form-control input-sm">
                                        <?php echo dropdown_options('users', $rso);?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <label for="fileJDQ">JDQ:</label>
                                    <?php if($doc_jdq):?>
                                    	<br>
                                    	<a class="mr_current_file" href="<?php echo BASE_URL."settings/files/mr/".base64_encode($id);?>" target="_blank"><?php echo $doc_jdq;?></a>
                                    	<a class="mr_current_file" href="javascript:void(0);" onclick="AjaxDeleteFile('mr', '<?php echo $id;?>');" style="color:red;">[delete]</a>
                                    <?php endif;?>
                                    <input type="file" id="fileJDQ" name="fileJDQ" class="form-control input-sm <?php echo ($doc_jdq)?"hidden":""?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="selectRA">Date Recieved:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textRecDate" name="textRecDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($rec_date,2);?>">
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="selectRA">Expiry Date:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textExpiryDate" name="textExpiryDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($exp_date,2);?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <hr />

                        <div class="row">
                            <div class="col-sm-12">
                                <h4 class="modal-title">Employment Terms and Conditions</h4>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textContract">Contract Duration:</label>
                                    <input type="text" name="textContract" id="textContract" value="<?php echo $contract_duration;?>" class="form-control input-sm" />
                                </div>
                            </div>
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textAllowance">Allowance:</label>
                                    <input type="text" name="textAllowance" id="textAllowance" value="<?php echo $allowance;?>" class="form-control input-sm" />
                                </div>
                            </div>
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textFood">Food:</label>
                                    <input type="text" name="textFood" id="textFood" value="<?php echo $food;?>" class="form-control input-sm" />
                                </div>
                            </div>
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textWorkHrs">Working Hrs/OT:</label>
                                    <input type="text" name="textWorkHrs" id="textWorkHrs" value="<?php echo $work_hrs;?>" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textContract">Transportation:</label>
                                    <input type="text" name="textTranspo" id="textTranspo" value="<?php echo $transpo;?>" class="form-control input-sm" />
                                </div>
                            </div>
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textAccomodation">Accomodation:</label>
                                    <input type="text" name="textAccomodation" id="textAccomodation" value="<?php echo $accomodation;?>" class="form-control input-sm" />
                                </div>
                            </div>
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textTicket">Ticket:</label>
                                    <input type="text" name="textTicket" id="textTicket" value="<?php echo $ticket;?>" class="form-control input-sm" />
                                </div>
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <label for="textOthers">Others:</label>
                                    <!-- <input type="text" name="textOthers" id="textOthers" value="<?php echo $others;?>" class="form-control input-sm" /> -->
                                    <textarea class="form-control input-sm" name="textOthers" id="textOthers"><?php echo $others;?></textarea>
                                </div>
                            </div>
                        </div>

                        <hr />
            
                        <div class="row">
                            <div class="col-sm-6">
            					<input type="button" onclick="save_mr();" class="btn btn-block btn-primary" value="Submit">
                            </div>
                            <div class="col-sm-6">
            					<a href="<?php echo BASE_URL;?>recruitment/lists/mr_manager" class="btn btn-block btn-danger">Cancel</a>
                            </div>
                        </div>
            
                    </form>
                    
                </div>
            </section>
        </div>
        
        <?php if(isset($info)):?>
    		<div class="col-md-12">
    
    			<div class="tabs">
    				<ul class="nav nav-tabs tabs-primary">
    					<li class="mr_tab <?php echo ($current_tab=='jobs')?"active":"";?>"  aria-controls="jobs"><a href="" data-toggle="tab">Job Openings</a></li>
    					<li class="mr_tab <?php echo ($current_tab=='sched')?"active":"";?>" aria-controls="sched"><a href="" data-toggle="tab">Interview Schedule</a></li>
    					<li class="mr_tab <?php echo ($current_tab=='applicants')?"active":"";?>" aria-controls="applicants"><a href="" data-toggle="tab">Applicants Applied</a></li>
    				</ul>
    				<div class="tab-content">
                        
                    </div>
                </div>
                
    		</div>
		<?php endif;?>
    </div>
</section>