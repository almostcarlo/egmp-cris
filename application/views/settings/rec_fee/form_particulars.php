<?php
    if(isset($info[0])){
        $record_id = $info[0]['id'];
        $particular_id = $info[0]['particular'];
        $particular_amount = $info[0]['amount'];
        $remarks = $info[0]['remarks'];
        $particular_charge = $info[0]['charge_to'];
    }else{
        $record_id = "";
        $particular_id = "";
        $particular_amount = "";
        $remarks = "";
        $particular_charge = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Recruitment Fee Guide - Particulars</h4>
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

            <?php echo form_open('applicant/save_profile/accounts_card', 'id="frm_recfee_dtl"');?>
            
            	<input type="hidden" name="textRecordId" value="<?php echo $record_id;?>">
            	<input type="hidden" name="textRecFeeId" value="<?php echo $_GET['recfee_id'];?>">
                <input type="hidden" name="textLabelId" id="textLabelId" value="<?php echo $_GET['label_id'];?>">

                <div class="row">
                    <div class="col-md-8 mt-sm">
                        <div class="form-group">
                            <label for="selectParticular">Particulars:</label>
                            <select id="selectParticular" name="selectParticular" onchange="new_particular($(this).val());" class="form-control input-sm">
                                <option value="">Please select</option>
                                <option value="0">--Create new particular--</option>
                                <?php echo dropdown_options('particulars', $particular_id, 0)?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textAmount">Amount:</label>
                            <input type="text" id="textAmount" name="textAmount" value="<?php echo $particular_amount;?>" class="form-control input-sm" placeholder="0.00" />
                        </div>
                    </div>
                </div>

                <div class="row hidden" id="divNewParticular">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">New Particular:</label>
                            <input type="text" class="form-control input-sm" id="textNewParticular" name="textNewParticular" placeholder="description">
                        </div>
                    </div>
                    <div class="col-md-2 mt-sm">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <input type="button" class="btn btn-block btn-danger btn-sm" value="Cancel" onclick="$('#divNewParticular').addClass('hidden'); $('#selectParticular, #textNewParticular').val(''); $('#selectParticular').attr('disabled', false);">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label fo="">Charge to:</label>
                            <select id="selectChargeTo" name="selectChargeTo" class="form-control input-sm">
                                <option value="applicant" <?php echo ($particular_charge=='applicant')?"selected=\"selected\"":"";?>>Applicant</option>
                                <option value="client" <?php echo ($particular_charge=='client')?"selected=\"selected\"":"";?>>Client</option>
                                <option value="agency" <?php echo ($particular_charge=='agency')?"selected=\"selected\"":"";?>>Agency</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Remarks:</label>
                            <textarea name="textRemarks" class="form-control input-sm"><?php echo $remarks;?></textarea>
                        </div>
                    </div>
                </div>
                
                <hr />

                <div class="row">
                    <div class="col-sm-3">
                        <input type="button" onclick="save_accounts();" class="btn btn-block btn-primary" value="Submit">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>
<script type="text/javascript">
    function new_particular(p_id){
        if(p_id == 0){
            $('#selectParticular').attr('disabled', 'disabled');
            $('#divNewParticular').removeClass('hidden');
            $('#textNewParticular').focus();
        }else{
            $('#divNewParticular').addClass('hidden');
        }
    }

    function save_accounts(){
        $("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");
        if($('#selectParticular').val() == ''){
            $('#defaultNoticeContError').html('Particular is required.');
            $("#frm_ErrorNotice").removeClass("hidden");
            $('#selectParticular').focus()
        }else if($('#selectParticular').val() == 0 && $('#textNewParticular').val() == ''){
            $('#defaultNoticeContError').html('New Particular is required.');
            $("#frm_ErrorNotice").removeClass("hidden");
            $('#textNewParticular').focus()
        }else if($('#textAmount').val() == ''){
            $('#defaultNoticeContError').html('Amount is required.');
            $("#frm_ErrorNotice").removeClass("hidden");
            $('#textAmount').focus()
        }else{
            $.post(base_url_js+'settings/save/settings_recfee_dtl', $('#frm_recfee_dtl').serialize(), function(data) {
                if(data){
                    $('#defaultNoticeContSuccess').html('Successfully saved.');
                    $("#frm_SuccessNotice").removeClass("hidden");

                    setTimeout(function(){
                        $.facebox.close();
                        generate_recfeetab($('#textLabelId').val());
                    }, 1000);
                }else{
                    $('#defaultNoticeContError').html('Unable to save particulars.');
                    $("#frm_ErrorNotice").removeClass("hidden");
                }
            });
        }
    }
</script>