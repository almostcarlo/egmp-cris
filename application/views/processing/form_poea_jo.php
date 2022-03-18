<?php
    if(isset($jo_info[0])){
        $id = $jo_info[0]['id'];
        $jo_id = $jo_info[0]['jo_id'];
        $jo_ref = $jo_info[0]['jo_ref'];
        $approved_date= $jo_info[0]['approved_date'];
        $submit_date= $jo_info[0]['submit_date'];
        $exp_date = $jo_info[0]['expiry_date'];
    }else{
        $id = "";
        $jo_id = "";
        $jo_ref = "";
        $approved_date = "";
        $submit_date = "";
        $exp_date = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Job Order</h4>
                </div>
            </div>
            
            
            <div id="frm_ErrorNotice_f" class="alert alert-danger alert-dismissible hidden" role="alert">
                <strong>ERROR!</strong><br>
                <div id="defaultNoticeContError_f"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
        	<div id="frm_SuccessNotice_f" class="alert alert-success alert-dismissible hidden" role="alert">
                <strong>SUCCESS!</strong><br>
                <div id="defaultNoticeContSuccess_f"><strong><span id="inputRequired"></span></strong>[success message here]</div>
            </div>

            <?php echo form_open('processing/save/poea_jo', 'id="frm_poea_jo"');?>
            	
            	<input type="hidden" id="textRecordId_f" name="textRecordId" value="<?php echo $id;?>">
            	<input type="hidden" id="textPOEAId" name="textPOEAId" value="<?php echo $poea_id;?>">
            	
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Job Order ID:</label>
                            <input type="text" id="textJOID" name="textJOID" value="<?php echo $jo_id;?>" class="form-control input-sm" maxlength="8" />
                        </div>
                    </div>
                    
					<div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">E.C No.:</label>
                            <input type="text" id="textJORef" name="textJORef" value="<?php echo $jo_ref;?>" class="form-control input-sm" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Date Submitted:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textSubmitDate" name="textSubmitDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($submit_date,2);?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Date Approved:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textAppDate" name="textAppDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($approved_date,2);?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Validity Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textValidity" name="textValidity" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($exp_date,2);?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr />

                <div class="row">
                    <div class="col-sm-12">
                        <input type="button" class="btn btn-block btn-primary" value="Submit" id="btn_save_pos" onclick="save_poea_jo();">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>