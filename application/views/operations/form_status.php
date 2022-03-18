<?php
    get_items_from_cache('principal');
    get_items_from_cache('company');

    //if(isset($current_lineup)){
    if(isset($current_lineup) && is_array($current_lineup) && count($current_lineup) > 0){
        $id = $current_lineup[0]['lineup_id'];
        $mr_pos_id = $current_lineup[0]['mr_pos_id'];
        $position = $current_lineup[0]['position'];
        $btn = "Update";
        $is_renewable = $current_lineup[0]['is_renewable'];
        $salary_currency = $current_lineup[0]['salary_currency'];
        $salary_per = $current_lineup[0]['salary_per'];
        $salary_amount = $current_lineup[0]['salary_amount'];
        $interview_status = $current_lineup[0]['lineup_status'];
        $acceptance = $current_lineup[0]['lineup_acceptance'];
        $mr_id = $current_lineup[0]['manpower_id'];
        $contract_period = $current_lineup[0]['contract_period'];
        $food = $current_lineup[0]['food'];
        $select_date = $current_lineup[0]['select_date'];
        $approval_date = $current_lineup[0]['approval_date'];
        $selected_by = $current_lineup[0]['selected_by'];
        $app_status = $applicant_data['personal']->status;
        $is_dropped = $current_lineup[0]['is_dropped'];
        $dropped_date = $current_lineup[0]['dropped_date'];
    }else{
        $id = "";
        $mr_pos_id = "";
        $position = "";
        $btn = "Submit";
        $is_renewable = "N";
        $salary_currency = "";
        $salary_per = "";
        $salary_amount = "";
        $interview_status = "";
        $acceptance = "";
        $mr_id = 0;
        $contract_period = "";
        $food = "";
        $select_date = "";
        $approval_date = "";
        $selected_by = "";
        $app_status = $applicant_data['personal']->status;
        $is_dropped = "";
        $dropped_date = "";
    }
?>

<section role="main" class="content-body">
                  
	<header class="page-header">
		<h2>Status Changer</h2>
	</header>

	<div class="row">
		<!-- APPLICANT INFORMATION -->
		<?php include APPPATH.'views/parts/applicant_information.php';?>
		
		<?php if($lineup_history):?>
    		<div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">Lineup History</h2>
                    </header>
                    <div class="panel-body">
                        <table class="table table-striped table-condensed table-hover">
                            <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>Principal</th>
                                    <?php if(MR_REQUIRED):?><th>MR Ref.</th><?php endif;?>
                                    <th class="text-center">Selection Status</th>
                                    <th class="text-center">Acceptance</th>
                                    <th class="text-center">Select Date</th>
                                    <th class="text-center">Deployment Date</th>
                                    <th class="text-center">Add Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                        		<?php foreach ($lineup_history as $info):?>
                                    <tr <?php echo ($info['is_dropped']=='Y')?"style=\"color:red;\"":"";?>>
                                        <td><?php echo $info['position']?></td>
                                        <td><?php echo ($info['principal_id']<>'')?$_SESSION['settings']['principal'][$info['principal_id']]:"N/A"?></td>
                                        <?php if(MR_REQUIRED):?><td><?php echo $info['mr_ref']?></td><?php endif;?>
                                        <td class="text-center"><?php echo $info['lineup_status']?></td>
                                        <td class="text-center"><?php echo $info['lineup_acceptance']?></td>
                                        <td class="text-center"><?php echo dateformat($info['select_date'],5)?></td>
                                        <td class="text-center"><?php echo dateformat($info['deployment_date'],5)?></td>
                                        <td class="text-center"><?php echo dateformat($info['add_date'],5)?></td>
                                        <td class="text-center">
                                            <?php if(/*in_array($applicant_data['personal']->status, array('ACTIVE','RESERVED')) && */$info['is_deployed'] == 'N'):?>
                                                <a href="<?php echo BASE_URL;?>/operations/forms/status/<?php echo $applicant_data['personal']->id;?>?luid=<?php echo $info['id'];?>" onclick="" data-toggle="tooltip" data-placement="top" title="edit Lineup" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                        		<?php endforeach;?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        <?php endif;?>
		
		<?php if(isset($_SESSION['settings_notification_status']) && $_SESSION['settings_notification_status'] == 'Success'):?>
			<div class="col-md-12">
            	<div id="" class="alert alert-success alert-dismissible" role="alert">
                    <strong>SUCCESS!</strong><br>
                    <div id=""><strong><span id="inputRequired"></span></strong><?php echo $_SESSION['settings_notification'];?></div>
                </div>
            </div>
		<?php endif;?>
		
		<?php if(isset($_SESSION['settings_notification_status']) && $_SESSION['settings_notification_status'] == 'Error'):?>
    		<div class="col-md-12">
                <div id="" class="alert alert-danger alert-dismissible" role="alert">
                    <strong>ERROR!</strong><br>
                    <div id=""><strong><span id="inputRequired"></span></strong><?php echo $_SESSION['settings_notification'];?></div>
                </div>
            </div>
		<?php endif;?>

		<div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Status Changer</h2>
                </header>
                <div class="panel-body">
        
                    <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                        <strong>ERROR!</strong><br>
                        <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
                    </div>
                    
                	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                        <strong>SUCCESS!</strong><br>
                        <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
                    </div>
                
        			<?php echo form_open('operations/save/status_changer', 'id="frm_status"');?>
        				<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
                        <input type="hidden" id="textApplicantId" name="textApplicantId" value="<?php echo $applicant_data['personal']->id;?>">
                        <input type="hidden" id="textMrId" name="textMrId" value="<?php echo $mr_id;?>">
        			
        				<div class="row">
        					<div class="col-md-12" style="padding-left:15px;padding-right:15px;">

                                <?php if($id <> "" && $is_dropped != "Y"):?>
                                    <div class="row" id="">
                                        <div class="col-sm-3">
                                            <label style="font-weight:normal;"><input type="checkbox" style="margin:0;" id="chkDropped" name="chkDropped" value="1" /> <strong style="color:red;">Drop this lineup</strong></label><br/>
                                        </div>
                                    </div>
                                <?php endif;?>

        						<div class="row" id="">
                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group">
                                            <label for="">Position/Category:</label>
                                            <?php if($id != ""):?>
                                            	<input type="text" id="" name="" value="<?php echo $position;?>" readonly="readonly" class="form-control input-sm" />
                                            	<input type="hidden" id="SelectPosition" name="SelectPosition" value="<?php echo $mr_pos_id;?>" readonly="readonly" class="form-control input-sm" />
                                            <?php else:?>
                                                <select id="SelectPosition" name="SelectPosition" class="form-control input-sm">
                                                	<option value="">--Please select</option>
                                                	<?php foreach ($pos_options as $pos):?>
                                                		<option value="<?php echo $pos['id'];?>">
                                                			<?php echo $pos['position'];?> - <?php echo strtoupper($_SESSION['settings']['principal'][$pos['principal_id']]);?> <?php echo (array_key_exists($pos['company_id'],$_SESSION['settings']['company']))?" - {$_SESSION['settings']['company'][$pos['company_id']]}":"";?>
                                            			</option>
                                                	<?php endforeach;?>
                                                </select>
                                            <?php endif;?>
                                        </div>
                                    </div>

        							<?php if(MR_REQUIRED):?>
                                        <div class="col-md-3 mt-sm">
                                            <div class="form-group">
                                                <label for="">MR Ref:</label>
												<input type="text" id="textMRRef" name="" value="" readonly="readonly" class="form-control input-sm" />
                                            </div>
                                        </div>
                                    <?php endif;?>
                                    
                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group">
                                            <label for="">Principal:</label>
                                            <input type="text" id="textPrincipal" name="" value="" readonly="readonly" class="form-control input-sm" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group">
                                            <label for="">Company:</label>
                                            <input type="text" id="textCompany" name="" value="" readonly="readonly" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                
								<div class="row" id="">
                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group">
                                            <label for="">Selected By:</label>
                                            <select name="selectBy" id="selectBy" class="form-control input-sm">
                                            	<option value="">please select</option>
                                            </select>
                                            <input type="hidden" id="textCurrentSelectedBy" name="" value="<?php echo $selected_by;?>" />
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group" id="">
                                            <label for="textSelectDate">Select Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textSelectDate" name="textSelectDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($select_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group" id="">
                                            <label for="textApproveDate">Approval Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textApproveDate" name="textApproveDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($approval_date,2)?>">
                                            </div>
                                        </div>
                                    </div>
								</div>
								
								<hr class="col-sm-12">

                                <!-- IF DROPPED -->
                                <?php if($is_dropped == 'Y'):?>
                                    <div class="row" id="">
                                        <div class="col-md-3 mt-sm">
                                            <div class="form-group">
                                                <label for="" style="color:red;">Drop Lineup:</label>
                                                <select name="textIsDropped" id="textIsDropped" class="form-control input-sm">
                                                    <option value="Y">Yes</option>
                                                    <option value="N">No</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-3 mt-sm">
                                            <div class="form-group" id="">
                                                <label for="" style="color:red;">Date:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input id="textDroppedDate" name="textDroppedDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($dropped_date,2);?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <hr class="col-sm-12">
                                <?php endif;?>
                                <!-- END IF DROPPED -->
								
								<div class="row" id="">
                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group">
                                            <label for="">Contract Period:</label>
                                            <select name="selectContract" id="selectContract" class="form-control input-sm">
                                            	<option value="">please select</option>
                                                <option value="1 MONTH" <?php echo ($contract_period=='1 MONTH')?"selected=\"selected\"":"";?>>1 MONTHS</option>
                                                <option value="2 MONTHS" <?php echo ($contract_period=='2 MONTHS')?"selected=\"selected\"":"";?>>2 MONTHS</option>
                                                <option value="3 MONTHS" <?php echo ($contract_period=='3 MONTHS')?"selected=\"selected\"":"";?>>3 MONTHS</option>
                                                <option value="6 MONTHS" <?php echo ($contract_period=='6 MONTHS')?"selected=\"selected\"":"";?>>6 MONTHS</option>
                                                <option value="9 MONTHS" <?php echo ($contract_period=='9 MONTHS')?"selected=\"selected\"":"";?>>9 MONTHS</option>
                                                <option value="12 MONTHS" <?php echo ($contract_period=='12 MONTHS')?"selected=\"selected\"":"";?>>12 MONTHS</option>
                                                <option value="18 MONTHS" <?php echo ($contract_period=='18 MONTHS')?"selected=\"selected\"":"";?>>18 MONTHS</option>
                                                <option value="24 MONTHS" <?php echo ($contract_period=='24 MONTHS')?"selected=\"selected\"":"";?>>24 MONTHS</option>
                                                <option value="36 MONTHS" <?php echo ($contract_period=='36 MONTHS')?"selected=\"selected\"":"";?>>36 MONTHS</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-1 mt-sm">
                                        <div id="" class="form-group">
                                            <label for="">Salary:</label>
                                            <select id="SelectSalCurr" name="SelectSalCurr" class="form-control input-sm">
                                                <?php echo dropdown_options('currency', $salary_currency);?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1 mt-sm">
                                    	<label for="">&nbsp;</label>
                                        <div id="" class="form-group">
                                            <input type="text" id="textSalAmt" name="textSalAmt" value="<?php echo $salary_amount;?>" autocomplete="off" class="form-control input-sm" placeholder="0.00" />
                                        </div>
                                    </div>
                                    <div class="col-md-1 mt-sm">
                                        <div id="" class="form-group">
                                        	<label for="">&nbsp;</label>
                                            <select id="SelectSalPer" name="SelectSalPer" class="form-control input-sm">
                                                <option value="hour" <?php echo ($salary_per=='hour')?"selected=\"selected\"":""?>>/hour</option>
                                                <option value="month" <?php echo ($salary_per=='month')?"selected=\"selected\"":""?>>/month</option>
                                                <option value="year" <?php echo ($salary_per=='year')?"selected=\"selected\"":""?>>/year</option>
                                                <option value="day" <?php echo ($salary_per=='day')?"selected=\"selected\"":""?>>/day</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 mt-sm">
                                    	<label for="">Food</label>
                                        <div id="" class="form-group">
                                            <input type="text" id="textFood" name="textFood" autocomplete="off" value="<?php echo $food;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
								</div>
								<label for=""><input type="checkbox" id="checkIsRenewable" name="checkIsRenewable" <?php echo ($is_renewable=='Y')?"checked=\"checked\"":""?> style="vertical-align:top"> contract period is renewable.</label>
								
								<div class="row" id="">
                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group">
                                            <label for="">Interview Status:</label>
                                            <select name="selectStatus" id="selectStatus" class="form-control input-sm">
                                            	<option value="">--Please select</option>
                                                <option value="Selected" <?php echo ($interview_status=='Selected')?"selected=\"selected\"":""?>>Selected</option>
                                                <option value="Rejected" <?php echo ($interview_status=='Rejected')?"selected=\"selected\"":""?>>Rejected</option>
                                                <option value="Standby" <?php echo ($interview_status=='Standby')?"selected=\"selected\"":""?>>Standby</option>
                                                <option value="Not Interviewed" <?php echo ($interview_status=='Not Interviewed')?"selected=\"selected\"":""?>>Not Interviewed</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group">
                                            <label for="">Offer Acceptance:</label>
                                            <select name="selectAccept" id="selectAccept" class="form-control input-sm">
                                            	<option value="">--Please select</option>
                    							<option value="Accepted" <?php echo ($acceptance=='Accepted')?"selected=\"selected\"":""?>>Accepted</option>
                                                <option value="Declined" <?php echo ($acceptance=='Declined')?"selected=\"selected\"":""?>>Declined</option>
                                                <option value="Negotiate" <?php echo ($acceptance=='Negotiate')?"selected=\"selected\"":""?>>Negotiate</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group">
                                            <label for="">DB Status:</label>
                                            <select name="selectDBStat" id="selectDBStat" class="form-control input-sm" <?php //echo ($app_status=='DEPLOYED')?"disabled=\"disabled\"":""?>>
                                            	<option value="">please select</option>
                                            	<option value="ACTIVE" <?php echo ($app_status == 'ACTIVE')?"selected=\"selected\"":""?>>ACTIVE</option>
                                            	<!-- <option value="OPERATIONS" <?php echo ($app_status == 'OPERATIONS')?"selected=\"selected\"":""?>>OPERATIONS</option> -->
                                                <option value="MOBILIZATION" <?php echo ($app_status == 'MOBILIZATION')?"selected=\"selected\"":""?>>MOBILIZATION</option>
                                            	<option value="RESERVED" <?php echo ($app_status == 'RESERVED')?"selected=\"selected\"":""?>>RESERVED</option>
                                            	<option value="DEPLOYED" <?php echo ($app_status == 'DEPLOYED')?"selected=\"selected\"":""?>>DEPLOYED</option>
                                            	<option value="DEADFILE" <?php echo ($app_status == 'DEADFILE')?"selected=\"selected\"":""?>>DEADFILE</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div id="divDeployDate" class="col-md-3 mt-sm hidden">
                                        <div class="form-group" id="">
                                            <label for="inputDeployDate">Deployment Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="inputDeployDate" name="inputDeployDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="">
                                            </div>
                                        </div>
                                    </div>
								</div>
                                
                                <hr class="col-sm-12">
                                
                                <div class="row">
                                    <div class="col-sm-6">
                                    	<?php //if($app_status=='DEPLOYED'):?>
                                    		<!-- <input type="button" value="<?php echo $btn;?>" class="btn btn-block btn-primary disabled">
                                    		*applicant has been deployed in this lineup. editing function is disabled. -->
                                        <?php //if($submitted_req['POEA E-Registration'] == false || $submitted_req['PEOS Certificate'] == false):?>
                                        <?php if($submitted_req['PEOS'] == false || $submitted_req['E-REG'] == false):?>
                                            <input type="button" value="<?php echo $btn;?>" class="btn-default btn btn-block btn-primary disabled">
                                            <p class="required">*POEA E-Registration and PEOS Certificate are required.</p>
                                    	<?php else:?>
                                    		<input type="button" value="<?php echo $btn;?>" class="btn-default btn btn-block btn-primary" onclick="save_lineup();">
                                            <p class="required"></p>
                                    	<?php endif;?>

                                        <!-- DEADFILE -->
                                        <input type="button" id="btn_deadfile" value="<?php echo $btn;?>" class="btn btn-block btn-primary hidden" onclick="update_status();">
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="<?php echo BASE_URL;?>operations/forms/status/<?php echo $applicant_data['personal']->id;?>" class="btn btn-block btn-danger">Cancel</a>
                                    </div>
                                </div>
                                    
        					</div>
        				</div>
        			
        			</form>
                </div>
            </section>
		</div>
	</div>
</section>