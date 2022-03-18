<div>
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

            <?php echo form_open('applicant/save_advisory/internal', 'id="frm_int_adv" class="form-horizontal"');?>
            
            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">

                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="modal-title">Internal Advisory</h4>
                    </div>
                </div>
                
                <br />
                
                <textarea rows="6" id="textAdvisory" name="textAdvisory" class="form-control input-sm"></textarea>
                
                <br />
                
                <div class="row">
                    <div class="col-sm-3">
                        <input type="button" onclick="save_int_adv();" class="btn btn-block btn-primary" value="Submit">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>