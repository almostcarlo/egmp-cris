<?php
if(isset($info)){
    $id = $info[0]['id'];
    $title = $info[0]['title'];
    $pos_id = $info[0]['pos_id'];
    $remarks = $info[0]['remarks'];
    $service_fee = $info[0]['service_fee'];
    $insurance_fee = $info[0]['insurance_fee'];
    $placement_fee = $info[0]['placement_fee'];
    $processing_fee = $info[0]['processing_fee'];
    $salary_deduction = $info[0]['salary_deduction'];
    $ticket_condition = $info[0]['ticket_condition'];
    $terms = $info[0]['terms'];
}else{
    $id = "";
    $title = "";
    $pos_id = "";
    $remarks = "";
    $service_fee = "";
    $insurance_fee = "";
    $placement_fee = "";
    $processing_fee = "";
    $salary_deduction = "";
    $ticket_condition = "";
    $terms = "";
}
?>
<section class="panel">
    <div class="panel-body">
    
            <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                <strong>ERROR!</strong><br>
                <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
        	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                <strong>SUCCESS!</strong><br>
                <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
            </div>
        
        <?php echo form_open(BASE_URL.'settings/save/rec_fee_label', 'id="frm_facebox_recfee_lbl"')?>
        	
        	<input type="hidden" name="textRecordId" value="<?php echo $id;?>">
            <input type="hidden" name="recfee_id" id="recfee_id" value="<?php echo $recfee_id;?>">

            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for=""> Title</label>
                        <input type="text" id="textTitle" name="textTitle" value="<?php echo $title;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="">Category/Position:</label>
                        <select id="SelectPosition" name="SelectPosition" class="form-control input-sm">
                            <option value="">--All Category--</option>
                            <?php if(isset($pos_list) && count($pos_list) > 0):?>
                                <?php foreach($pos_list as $pos_info):?>
                                    <option value="<?php echo $pos_info['pos_id'];?>" <?php echo ($pos_id==$pos_info['pos_id'])?"selected=\"selected\"":"";?>><?php echo $pos_info['position'];?></option>
                                <?php endforeach;?>
                            <?php endif;?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="">Service Fee:</label>
                        <input type="text" id="textSvcFee" name="textSvcFee" value="<?php echo $service_fee;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="">Insurance Fee:</label>
                        <input type="text" id="textInsuranceFee" name="textInsuranceFee" value="<?php echo $insurance_fee;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="">Placement Fee:</label>
                        <input type="text" id="textPlacementFee" name="textPlacementFee" value="<?php echo $placement_fee;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="">Processing Fee:</label>
                        <input type="text" id="textProcessFee" name="textProcessFee" value="<?php echo $processing_fee;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="">Salary Deduction:</label>
                        <input type="text" id="textSD" name="textSD" value="<?php echo $salary_deduction;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="">Ticket Condition:</label>
                        <input type="text" id="textTicket" name="textTicket" value="<?php echo $ticket_condition;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="">Term of Payment for the Service:</label>
                        <textarea class="form-control input-sm" name="textTerms" rows="4"><?php echo $terms?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="textRemarks">Remarks:</label>
                        <textarea class="form-control input-sm" name="textRemarks" rows="4"><?php echo $remarks?></textarea>
                    </div>
                </div>
            </div>
            
            <hr />

            <div class="row">
                <div class="col-sm-3">
                    <input type="button" onclick="save_this();" class="btn btn-block btn-primary" value="Submit">
                </div>
                <div class="col-sm-3">
                    <input type="button" onclick="delete_label();" class="btn btn-block btn-danger" value="Delete this Set">
                </div>
            </div>

        </form>
        
    </div>
</section>
<script>
    function save_this(){
    	$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");

    	if($('#textTitle').val() == ''){
    		$('#defaultNoticeContError').html('Title is required.');
    		$("#frm_ErrorNotice").removeClass("hidden");
    		$('#textPos').focus();
    	}else{
    		$.post(base_url_js+'settings/save/rec_fee_label', $('#frm_facebox_recfee_lbl').serialize(), function(data) {
    			if(data){
    				$('#defaultNoticeContSuccess').html('Successfully saved.');
    				$("#frm_SuccessNotice").removeClass("hidden");

    				setTimeout(function(){
    					$.facebox.close();
    					window.location.replace(base_url_js+'settings/forms/rec_fee/'+$('#recfee_id').val());
    				}, 1000);
    			}else{
    				$('#defaultNoticeContError').html('Unable to save set.');
    				$("#frm_ErrorNotice").removeClass("hidden");
    			}
    		});
    	}
    }

    function delete_label(){
        if(confirm('This set will be deleted, together with the particulars. Do you want to proceed?')){
            $.get(base_url_js+'settings/ajax_delete?table=settings_recfee_label&rec_id=<?php echo $id;?>', function(data) {
                if(data){
                    $('#defaultNoticeContSuccess').html('Successfully deleted.');
                    $("#frm_SuccessNotice").removeClass("hidden");

                    setTimeout(function(){
                        $.facebox.close();
                        window.location.replace(base_url_js+'settings/forms/rec_fee/'+$('#recfee_id').val());
                    }, 1000);
                }else{
                    $('#defaultNoticeContError').html('Unable to delete set.');
                    $("#frm_ErrorNotice").removeClass("hidden");
                }
            });
        }
    }
</script>