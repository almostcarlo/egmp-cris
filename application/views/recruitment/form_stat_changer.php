<?php
    get_items_from_cache('company');

    if($lineup_info){
    	$applicant_id = $lineup_info[0]['applicant_id'];
        $id = $lineup_info[0]['id'];
        $mr_id = $lineup_info[0]['manpower_id'];
        $mr_pos_id = $lineup_info[0]['mr_pos_id'];
        $position = $lineup_info[0]['position'];
        $principal_name = $lineup_info[0]['principal'];
        $company_name = $lineup_info[0]['company'];
        $mr_ref = $lineup_info[0]['mr_ref'];
        $select_date = $lineup_info[0]['select_date'];
        $approval_date = $lineup_info[0]['approval_date'];
        $acceptance = $lineup_info[0]['lineup_acceptance'];
        $interview_status = $lineup_info[0]['lineup_status'];
        $remarks = $lineup_info[0]['remarks'];
        $mr_status = $lineup_info[0]['mr_status'];
        $jo_status = $lineup_info[0]['jo_status'];
        $deployment_date = $lineup_info[0]['deployment_date'];
        $contract_period = $lineup_info[0]['contract_period'];
        $is_deployed = $lineup_info[0]['is_deployed'];
    }else{
    	$applicant_id = "";
        $id = "";
        $mr_id = "";
        $mr_pos_id = "";
        $position = "";
        $principal_name = "";
        $company_name = "";
        $mr_ref = "";
        $select_date = "";
        $approval_date = "";
        $acceptance = "";
        $interview_status = "";
        $remarks = "";
        $mr_status = "1";
        $jo_status = "1";
        $deployment_date = "";
        $contract_period = "";
        $is_deployed = "";
    }
?>
<section class="panel">
    <div class="panel-body">
    
    	<?php if($show_attention):?>
    		<div id="" class="alert alert-warning" role="alert">
                <strong>Attention!</strong><br>
                <div id=""><strong><span id="inputRequired"></span></strong><?php echo $attention_msg?></div>
            </div>
    	<?php endif;?>
        
        <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
            <strong>ERROR!</strong><br>
            <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
        </div>
        
    	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
            <strong>SUCCESS!</strong><br>
            <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
        </div>
        
    	<?php echo form_open('applicant/add_lineup', 'id="frm_facebox_lineup"')?>
        	
        	<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
        	<input type="hidden" name="textApplicantId" value="<?php echo $applicant_id;?>">
        	<input type="hidden" id="textMrId" name="textMrId" value="<?php echo $mr_id;?>">

            <!-- <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="">Principal:</label>
                        <select id="SelectPrincipal" name="SelectPrincipal" class="form-control input-sm">
                        	<option value="">--Please select</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="">Company:</label>
                        <select id="SelectCompany" name="SelectCompany" class="form-control input-sm">
                        	<option value="">--Please select</option>
                        </select>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="SelectPosition">Position:</label>
                        <?php if(!$id):?>
                            <select id="SelectPosition" name="SelectPosition" class="form-control input-sm">
                            	<option value="">--Please select</option>
                            	<?php foreach ($pos_options as $pos):?>
                            		<option value="<?php echo $pos['id'];?>">
                            			<?php echo $pos['position'];?> - <?php echo strtoupper($_SESSION['settings']['principal'][$pos['principal_id']]);?> <?php echo (array_key_exists($pos['company_id'],$_SESSION['settings']['company']))?" - {$_SESSION['settings']['company'][$pos['company_id']]}":"";?>
                        			</option>
                            	<?php endforeach;?>
                            </select>
                        <?php else:?>
                        	<p><strong><?php echo $position;?></strong></p>
                        	<input type="hidden" value="<?php echo $mr_pos_id;?>" name="SelectPosition">
                        <?php endif;?>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="">Principal:</label>
                        <p id="p_principal_name"><strong><?php echo strtoupper($principal_name);?></strong></p>
                    </div>
                </div>
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="">Company:</label>
                        <p id="p_company_name"><strong><?php echo strtoupper($company_name);?></strong></p>
                    </div>
                </div>
            </div>
            <div class="row" style="display:<?php echo (MR_REQUIRED)?"block":"none"?>;">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="">MR:</label>
                        <p id="p_mr_ref"><strong><?php echo strtoupper($mr_ref);?></strong></p>
                    </div>
                </div>
            </div>
            <?php if($submitted_req['PEOS Certificate'] == true && $submitted_req['POEA E-Registration'] == true):?>
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="inputSelectDate">Date Selected:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="inputSelectDate" name="inputSelectDate" type="text" value="<?php echo dateformat($select_date,2);?>" autocomplete="off" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="inputApproveDate">Approval Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="inputApproveDate" name="inputApproveDate" type="text" value="<?php echo dateformat($approval_date,2);?>" autocomplete="off" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="selectIntStatus">Interview Status:</label>
                            <select id="selectIntStatus" name="selectIntStatus" class="form-control input-sm">
                            	<option value="">--Please select</option>
                                <option value="Selected" <?php echo ($interview_status=='Selected')?"selected=\"selected\"":""?>>Selected</option>
                                <option value="Rejected" <?php echo ($interview_status=='Rejected')?"selected=\"selected\"":""?>>Rejected</option>
                                <option value="Standby" <?php echo ($interview_status=='Standby')?"selected=\"selected\"":""?>>Standby</option>
                                <option value="Not Interviewed" <?php echo ($interview_status=='Not Interviewed')?"selected=\"selected\"":""?>>Not Interviewed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="selectAcceptance">Acceptance:</label>
                            <select id="selectAcceptance" name="selectAcceptance" class="form-control input-sm">
                            	<option value="">--Please select</option>
    							<option value="Accepted" <?php echo ($acceptance=='Accepted')?"selected=\"selected\"":""?>>Accepted</option>
                                <option value="Declined" <?php echo ($acceptance=='Declined')?"selected=\"selected\"":""?>>Declined</option>
                                <option value="Negotiate" <?php echo ($acceptance=='Negotiate')?"selected=\"selected\"":""?>>Negotiate</option>
                            </select>
                        </div>
                    </div>
                </div>
            <?php else:?>
                <input type="hidden" name="inputSelectDate" id="inputSelectDate" value="">
                <input type="hidden" name="inputApproveDate" id="inputApproveDate" value="">
                <input type="hidden" name="selectIntStatus" id="selectIntStatus" value="">
                <input type="hidden" name="selectAcceptance" id="selectAcceptance" value="">
            <?php endif;?>
            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="textJobDesc">Remarks:</label>
                        <textarea name="textRemarks" id="textRemarks" rows="5" cols="" class="form-control input-sm"><?php echo $remarks;?></textarea>
                    </div>
                </div>
            </div>
            
            <?php /*if($id):?>
                <hr />
                
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="modal-title">Deployment Changer</h4>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="selectIntStatus">Status:</label>
                            <select id="selectAppStatus" name="selectAppStatus" class="form-control input-sm">
                            	<option value="">--Please select</option>
                            	<option value="DEPLOYED" <?php echo ($is_deployed=='Y')?"selected=\"selected\"":"";?>>DEPLOYED</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="inputDeployDate">Deployment Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="inputDeployDate" name="inputDeployDate" type="text" value="<?php echo dateformat($deployment_date,2);?>" autocomplete="off" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="selectIntStatus">Contract Period:</label>
                            <select id="selectContractPeriod" name="selectContractPeriod" class="form-control input-sm">
                            	<option value="">--Please select</option>
                            	<option value="2 months" <?php echo ($contract_period=="2 months")?"selected=\"selected\"":"";?>>2 months</option>
                            	<option value="3 months" <?php echo ($contract_period=="3 months")?"selected=\"selected\"":"";?>>3 months</option>
								<option value="6 months" <?php echo ($contract_period=="6 months")?"selected=\"selected\"":"";?>>6 months</option>
								<option value="9 months" <?php echo ($contract_period=="9 months")?"selected=\"selected\"":"";?>>9 months</option>
								<option value="12 months" <?php echo ($contract_period=="12 months")?"selected=\"selected\"":"";?>>12 months</option>
								<option value="18 months" <?php echo ($contract_period=="18 months")?"selected=\"selected\"":"";?>>18 months</option>
								<option value="24 months" <?php echo ($contract_period=="24 months")?"selected=\"selected\"":"";?>>24 months</option>
								<option value="36 months" <?php echo ($contract_period=="36 months")?"selected=\"selected\"":"";?>>36 months</option>
                            </select>
                        </div>
                    </div>
                </div>
            <?php endif;*/?>
            
            <?php if($is_deployed == 'Y'):?>
            	<hr />
                <div class="row">
                    <div class="col-sm-12">
                        *applicant has been deployed in this lineup. editing function is disabled.
                    </div>
                </div>
            <?php else:?>
                <?php if(/*$mr_status == 1 &&*/ $jo_status == 1):?>
                    <hr />
        
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="button" onclick="save_lineup();" class="btn btn-block btn-primary" value="Submit">
                        </div>
                    </div>
                <?php endif;?>
            <?php endif;?>

        </form>
        
    </div>
</section>
<script>
	$(function(){
		$('#inputSelectDate, #inputApproveDate, #inputDeployDate').datepicker({dateFormat: 'YYYY-MM-DD'});

		$('#SelectPosition').change(function(){
			$('#p_principal_name').html('');
			$('#p_company_name').html('');
			$('#p_mr_ref').html('');
			var pos_id = $(this).val();

			$.get(base_url_js+'jobs/jobinfo', {mr_pos_id:pos_id}, function(data){
				if(data!=''){
					obj = JSON.parse(data);

					/* principal name */
					$('#p_principal_name').html('<strong>'+obj.principal.toUpperCase()+'</strong>');

					if(obj.mr_id == null){
						$('#textMrId').val(0);
					}else{
						$('#textMrId').val(obj.mr_id);
						$('#p_mr_ref').html('<strong>'+obj.mr_ref.toUpperCase()+'</strong>');
					}

					/* company name */
					if(obj.company != null || obj.company != ''){
						$('#p_company_name').html('<strong>'+obj.company.toUpperCase()+'</strong>');
					}
				}
			});
		});
	})
	
	function save_lineup(){
		$("#frm_ErrorNotice, #frm_SuccessNotice").addClass("hidden");

		if($('#textRecordId').val() == '' && $('#SelectPosition').val() == ''){
			$('#defaultNoticeContError').html('Position is required.');
			$("#frm_ErrorNotice").removeClass("hidden");
			$('#SelectPosition').focus();
		}else{
			$.post(base_url_js+'applicant/ajax_save_profile/lineup_status', $('#frm_facebox_lineup').serialize(), function(data){
				if(data == 1){
					$('#defaultNoticeContSuccess').html('Successfully updated lineup.');
					$("#frm_SuccessNotice").removeClass("hidden");

					setTimeout(function(){
						$.facebox.close();
					}, 3000);
				}else{
					$('#defaultNoticeContError').html('Unable to update lineup. Please try again.');
					$("#frm_ErrorNotice").removeClass("hidden");
				}
			});
		}
	}
</script>