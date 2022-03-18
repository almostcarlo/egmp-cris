<?php
    if(isset($applied_pos[0])){
        $pos_info = explode('|', $applied_pos[0]['position']);
        $pos1 = $pos_info[0];
        $pos2 = (isset($pos_info[1]))?$pos_info[1]:"";
        $record_id = $applied_pos[0]['id'];
    }else{
        $pos1 = "";
        $pos2 = "";
        $record_id = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Applied Position</h4>
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

            <?php echo form_open('applicant/save_profile/applied_pos', 'id="frm_position"');?>
            
            	<input type="hidden" name="hRecId" value="<?php echo $record_id;?>">
            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">
                
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="textRefPosition">Position #1:</label>
                            <input type="text" id="textAppliedCat1" name="textAppliedCat[]" value="<?php echo $pos1;?>" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="textRefCompany">Position #2:</label>
                            <input type="text" id="textAppliedCat2" name="textAppliedCat[]" value="<?php echo $pos2;?>" class="form-control input-sm" />
                        </div>
                    </div>
                </div>
                
                <hr />

                <div class="row">
                    <div class="col-sm-3">
                        <input type="button" onclick="save_position();" class="btn btn-block btn-primary" value="Submit">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>