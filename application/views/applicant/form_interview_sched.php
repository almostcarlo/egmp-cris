<?php
    if(isset($lineup_info)){
        $id = $lineup_info[0]['id'];
        $mob_result = $lineup_info[0]['mob_result'];
        $interview_confirmed = $lineup_info[0]['interview_confirmed'];
        $remarks = $lineup_info[0]['mob_remarks'];
        $position = $lineup_info[0]['position'];
        $principal = strtoupper($lineup_info[0]['principal']);
        $mr_ref = $lineup_info[0]['mr_ref'];
        $sched_id = $lineup_info[0]['interview_sched_id'];

        if($mob_result == 'CR'){
            $disable_sched = "";
        }else{
            $disable_sched = "disabled=\"disabled\"";
        }
    }else{
        $mob_result = "";
        $interview_confirmed = "N";
        $remarks = "";
        $position = "";
        $principal = "";
        $mr_ref = "";
        $sched_id = "";
    }
?>
<section class="panel">
    <div class="panel-body">
        
        <div class="row">
            <div class="col-sm-12">
                <h4 class="modal-title">Interview Schedule</h4>
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
        
    	<?php echo form_open('applicant/add_lineup', 'id="frm_facebox_sched"')?>
    	
			<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
        	<input type="hidden" name="textApplicantId" value="<?php echo $applicant_id;?>">

            <div class="row">
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="">Position:</label>
                        <p><?php echo $position;?></p>
                    </div>
                </div>
                <div class="col-md-5 mt-sm">
                    <div class="form-group">
                        <label for="">Principal:</label>
                        <p><?php echo $principal;?></p>
                    </div>
                </div>
                <div class="col-md-3 mt-sm">
                    <div class="form-group">
                        <label for="">MR Reference:</label>
                        <p><?php echo $mr_ref;?></p>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="">Mobilization Result:</label>
                        <select id="selectMobResult" name="selectMobResult" onchange="if($(this).val()=='CR'){$('#selectInterviewSched').attr('disabled',false);}else{$('#selectInterviewSched').attr('disabled',true); $('#selectInterviewSched').val('');};" class="form-control input-sm">
                            <?php generate_dd($select_mob_result, $mob_result, FALSE, FALSE);?>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 mt-sm">
                    <div class="form-group">
                        <label for="">Interview Date:</label>
                        <select id="selectInterviewSched" name="selectInterviewSched" class="form-control input-sm" <?php echo $disable_sched;?>>
                            <?php generate_dd($select_sched, $sched_id, TRUE, TRUE);?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="">Applicant Confirmation:</label><br><small class="required">*if applicant agreed with schedule</small>
                        <select id="selectInterviewConfirmed" name="selectInterviewConfirmed" class="form-control input-sm">
                            <?php generate_dd(array('Y'=>'Yes', 'N'=>'No'), $interview_confirmed, TRUE, FALSE);?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="">Remarks:</label>
                        <textarea id="textMobRemarks" name="textMobRemarks" class="form-control input-sm" rows="5"><?php echo $remarks;?></textarea>
                    </div>
                </div>
            </div>
            
            <hr />

            <div class="row">
                <div class="col-sm-3">
                    <input type="button" onclick="save_sched();" class="btn btn-block btn-primary" value="Submit">
                </div>
            </div>

        </form>
        
    </div>
</section>
<script>
	function save_sched(){
		$("#frm_ErrorNotice, #frm_SuccessNotice").addClass("hidden");

		if($('#selectMobResult').val() == 'CR' && $('#selectInterviewSched').val() == ''){
			$('#defaultNoticeContError').html('Interview Schedule is required.');
			$("#frm_ErrorNotice").removeClass("hidden");
			$('#selectInterviewSched').focus();
		}else{
			$.post(base_url_js+'applicant/ajax_save_profile/interview_sched', $('#frm_facebox_sched').serialize(), function(data){
				if(data){
					$('#defaultNoticeContSuccess').html('Successfully updated Interview Schedule.');

					$("#frm_SuccessNotice").removeClass("hidden");

                    if(typeof current_tab === 'undefined' || current_tab === null){
                        setTimeout(function(){
                            $.facebox.close();
                        }, 1000);
                    }else{
                        setTimeout(function(){
                            $.facebox.close();
                            generate_tab(current_tab);
                        }, 1000);
                    };
				}else{
					$('#defaultNoticeContError').html('Unable to save Interview Schedule.');
					$("#frm_ErrorNotice").removeClass("hidden");
				}
			});
		}
	}
</script>