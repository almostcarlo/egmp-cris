<?php
	$id = $assessment_info[0]['id'];
    if($assessment_info[0]['assess_detail'] != ''){
        
        $details = $assessment_info[0]['assess_detail'];
        $position = $assessment_info[0]['assess_position'];
        $nature_id = $assessment_info[0]['assess_nature'];
        $action = "edit";
   }else{
       $details = "";
       $position = "";
       $nature_id = "";
       $action = "add";
    }
?>
<section class="panel">
    <div class="panel-body">
        
        <div class="row">
            <div class="col-sm-12">
                <h4 class="modal-title">Lineup Assessment</h4>
            </div>
        </div>
        
        <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
            <strong>ERROR!</strong><br>
            <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
        </div>
        
    	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
            <strong>SUCCESS!</strong><br>
            <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
        </div>
        
    	<?php echo form_open('applicant/add_lineup', 'id="frm_facebox_assess"')?>
    	
			<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
        	<input type="hidden" name="textApplicantId" value="<?php echo $applicant_id;?>">
        	<input type="hidden" name="textAction" value="<?php echo $action;?>">

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="textDetails">Assessment Detail:</label>
                        <textarea id="textDetails" name="textDetails" class="form-control input-sm" rows="5"><?php echo $details;?></textarea>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="inputRecomPosition">Recommended Position:</label>
                        <input type="text" name="inputRecPos" id="inputRecPos" value="<?php echo $position;?>" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="selectNatureProjExp">Nature of Project Experience:</label>
                        <select id="selectNatureProjExp" name="selectNatureProjExp" class="form-control input-sm">
                            <?php echo dropdown_options('nature', $nature_id);?>
                        </select>
                    </div>
                </div>
            </div>
            
            <hr />

            <div class="row">
                <div class="col-sm-3">
                    <input type="button" onclick="save_assessment();" class="btn btn-block btn-primary" value="Submit">
                </div>
            </div>

        </form>
        
    </div>
</section>
<script>
	function save_assessment(){
		$("#frm_ErrorNotice, #frm_SuccessNotice").addClass("hidden");

		if($('#textDetails').val() == ''){
			$('#defaultNoticeContError').html('Details is required.');
			$("#frm_ErrorNotice").removeClass("hidden");
			$('#textDetails').focus();
		}else if($('#inputRecPos').val() == ''){
			$('#defaultNoticeContError').html('Recommended Position is required.');
			$("#frm_ErrorNotice").removeClass("hidden");
			$('#inputRecPos').focus();
		}else{
			$.post(base_url_js+'applicant/ajax_save_profile/assessment_lineup', $('#frm_facebox_assess').serialize(), function(data){
				if(data){
					if($('#textRecordId').val() == ''){
						$('#defaultNoticeContSuccess').html('Successfully added lineup assessment.');
					}else{
						$('#defaultNoticeContSuccess').html('Successfully updated lineup assessment.');
					}

					$("#frm_SuccessNotice").removeClass("hidden");

					setTimeout(function(){
						$.facebox.close();
						generate_tab(current_tab);
					}, 1000);
				}else{
					$('#defaultNoticeContError').html('Unable to save lineup assessment.');
					$("#frm_ErrorNotice").removeClass("hidden");
				}
			});
		}
	}
</script>