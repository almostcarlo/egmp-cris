<?php
    if(isset($accounts_info[0])){
        $particular_id = $accounts_info[0]['particular_id'];
        $particular_amount = $accounts_info[0]['amount'];
        $particular_ref = $accounts_info[0]['reference'];
        $particular_charge = $accounts_info[0]['charge_to'];
        $payment_method_id = $accounts_info[0]['payment_method_id'];
    }else{
        $particular_id = "";
        $particular_amount = "";
        $particular_ref = "";
        $particular_charge = "";
        $payment_method_id = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Accounts Card - Particulars</h4>
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

            <?php echo form_open('applicant/save_profile/accounts_card', 'id="frm_accounts"');?>
            
            	<input type="hidden" name="hParticularId" value="<?php echo $record_id;?>">
            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">
                <input type="hidden" name="textLineup_id" value="<?php echo $lineup_id;?>">

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
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="textReference">Reference:</label>
                            <textarea name="textReference" class="form-control input-sm"><?php echo $particular_ref;?></textarea>
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

                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label fo="">Payment Method:</label>
                            <select id="selectPayment" name="selectPayment" class="form-control input-sm">
                                <option value="">Please select</option>
                                <?php echo dropdown_options('payment_method', $payment_method_id, 0)?>
                            </select>
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