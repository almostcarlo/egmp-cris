<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Accept RFP</h4>
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

            <?php echo form_open('applicant/oec_request', 'id="frm_oec_request"');?>
                
                <input type="hidden" id="textRecordId_f" name="textRecordId" value="<?php echo $processing_info[0]['id'];?>">

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Submitted:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textRFPsubmit" name="textRFPsubmit" value="<?php echo dateformat($processing_info[0]['rfp_submit_date'],2);?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Released:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textRFPrelease" name="textRFPrelease" value="" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">OEC:</label>
                            <input id="textRFPoec" name="textRFPoec" value="<?php echo $processing_info[0]['rfp_oec_no'];?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">CG No.:</label>
                            <input id="textRFPcgno" name="textRFPcgno" value="<?php echo $processing_info[0]['rfp_cg_no'];?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Status:</label>
                            <select id="selectRFPStat" name="selectRFPStat" class="form-control input-sm">
                                <option value="">please select</option>
                                <option value="Accepted" <?php echo ($processing_info[0]['rfp_status']=='Accepted')?"selected=\"selected\"":"";?>>Accepted</option>
                                <option value="Denied" <?php echo ($processing_info[0]['rfp_status']=='Denied')?"selected=\"selected\"":"";?>>Denied</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textRFPReqDate" name="textRFPReqDate" value="<?php echo dateformat($processing_info[0]['rfp_updated'],2);?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Remarks:</label>
                            <textarea id="textRemarks" name="textRemarks" rows="4" class="form-control input-sm"><?php echo $processing_info[0]['rfp_remarks'];?></textarea>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-sm-12">
                        <input type="button" class="btn btn-block btn-primary" value="Submit" id="" onclick="save_rfp_request();">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>