<?php
    if(isset($pos_info[0])){
        $id = $pos_info[0]['id'];
        $trans_no = $pos_info[0]['transmittal_no'];
        $trans_date = $pos_info[0]['transmittal_date'];
    }else{
        $id = "";
        $trans_no = str_pad(getMaxCount("manager_visa_transmittal")+1, 5, 0, STR_PAD_LEFT);
        $trans_date = date("m/d/Y");
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">VISA Transmittal</h4>
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

            <?php echo form_open('processing/save/transmittal', 'id="frm_visa_trans"');?>
            	
            	<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
            	<input type="hidden" id="textVisaId" name="textVisaId" value="<?php echo $visa_id;?>">

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Transmittal No.:</label>
                            <input class="form-control input-sm" name="textTransNo" id="textTransNo" readonly="readonly" value="<?php echo $trans_no;?>">
                        </div>
                    </div>

                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Transmittal Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textTransDate" name="textTransDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($trans_date,2);?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <hr />

                <div class="row">
                    <div class="col-sm-12">
                        <input type="button" class="btn btn-block btn-primary" value="Submit" id="" onclick="save_visa_trans();">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>