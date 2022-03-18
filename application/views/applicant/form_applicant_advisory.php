<?php
    if($applicant_data['personal']->sms_token){
        $send_to = "sms";
    }else{
        $send_to = "email";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">

            <div id="frm_InfoNotice" class="alert alert-info alert-dismissible hidden" role="alert">
                <strong>SENDING MESSAGE</strong><br>
                <div id="defaultNoticeContInfo"><strong><span id="inputRequired"></span></strong>Please wait...</div>
            </div>
            
            <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                <strong>ERROR!</strong><br>
                <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
        	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                <strong>SUCCESS!</strong><br>
                <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
            </div>

            <?php echo form_open('applicant/save_advisory/applicant', 'id="frm_app_adv" class="form-horizontal"');?>
            
            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">
                <input type="hidden" name="textSendTo" value="<?php echo $send_to;?>">
                <input type="hidden" name="textMobNo" value="<?php echo $applicant_data['personal']->sms_mobile_no;?>">
                <input type="hidden" name="textToken" value="<?php echo $applicant_data['personal']->sms_token;?>">
                <input type="hidden" name="textEmail" value="<?php echo $applicant_data['personal']->email;?>">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="modal-title">Applicant Advisory</h4>
                    </div>
                </div>
                
                <br />
                
                <textarea rows="6" id="textAdvisory" name="textAdvisory" class="form-control input-sm"></textarea>
                <i><small>this message will be sent to <strong><?php echo ($send_to=='sms')?$applicant_data['personal']->sms_mobile_no:$applicant_data['personal']->email;?></strong></small></i>
                <br /><br />
                
                <div class="row">
                    <div class="col-sm-3">
                        <input type="button" id="btn_send" onclick="save_app_adv();" class="btn btn-block btn-primary" value="Send">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>