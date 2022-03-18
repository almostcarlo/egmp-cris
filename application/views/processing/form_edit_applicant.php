<!-- EDIT APPLICANT FOR VISA TRANSMITTAL ALLOCATION -->
<?php
// var_dump($processing_info);
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">VISA Transmittal - Edit Applicant</h4>
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

            <?php echo form_open('processing/update_allocate_trans', 'id="frm_alloc_trans"');?>
                
                <input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $processing_info[0]['id'];?>">
                <input type="hidden" id="textTransId" name="textTransId" value="<?php echo $transmittal_id;?>">

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Transmittal Submit Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textTransSubmit" name="textTransSubmit" value="<?php echo dateformat($processing_info[0]['transmittal_submit_date'],2);?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Transmittal Release Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textTransRel" name="textTransRel" value="<?php echo date("m/d/Y");?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">E-Code:</label>
                            <input id="textEcode" name="textEcode" value="<?php echo $processing_info[0]['transmittal_ecode'];?>" autocomplete="off" type="text" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Auth:</label>
                            <input id="textAuth" name="textAuth" value="<?php echo $processing_info[0]['transmittal_auth'];?>" autocomplete="off" type="text" class="form-control input-sm">
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-sm-12">
                        <input type="button" class="btn btn-block btn-primary" value="Save" id="" onclick="update_alloc_trans();">
                    </div>
                </div>

            </form>
        </div>
    </section>
</div>