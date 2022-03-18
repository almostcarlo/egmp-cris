<?php
    if(isset($accounts_info[0])){
        $remarks = $accounts_info[0]['remarks'];
        $record_id = $accounts_info[0]['id'];
    }else{
        $remarks = "";
        $record_id = 0;
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Accounts Card - Remarks</h4>
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

            <?php echo form_open('applicant/save_profile/accounts_card', 'id="frm_accounts_remarks"');?>
            
            	<input type="hidden" name="textRecordId" value="<?php echo $record_id;?>">
            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">
                <input type="hidden" name="textLineup_id" value="<?php echo $lineup_id;?>">

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="textReference">Remarks:</label>
                            <textarea name="textRemarks" id="textRemarks" class="form-control input-sm" rows="5"><?php echo $remarks;?></textarea>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-sm-3">
                        <input type="button" onclick="save_accounts_rmk();" class="btn btn-block btn-primary" value="Submit">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>