<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">JO Request</h4>
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

            <?php echo form_open('applicant/jo_request', 'id="frm_jo_request"');?>
                
                <input type="hidden" id="textRecordId_f" name="textRecordId" value="<?php echo $jo_alloc_info[0]['id'];?>">

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Request Date:</label>
                            <input id="" name="" value="<?php echo dateformat($jo_alloc_info[0]['poea_req_date'],2);?>" type="text" readonly="readonly" class="form-control input-sm">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Date Sent to POEA:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textPOEASentDate" name="textPOEASentDate" value="<?php echo dateformat($jo_alloc_info[0]['poea_sent_date'],2);?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">JO Approved Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textPOEAApproveDate" name="textPOEAApproveDate" value="<?php echo dateformat($jo_alloc_info[0]['poea_approve_date'],2);?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Applied JO ID:</label>
                            <select id="selectJOIDReq" name="selectJOIDReq" class="form-control input-sm" onchange="get_jo_pos()">
                                <?php echo generate_dd($jo_list, $jo_alloc_info[0]['poea_request_id']);?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Applied JO Category:</label>
                            <select id="selectJOCatReq" name="selectJOCatReq" class="form-control input-sm">
                                <?php echo generate_dd($jo_pos_list, $jo_alloc_info[0]['poea_request_cat']);?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Applied JO Salary:</label>
                            <select id="selectPOEACurr" name="selectPOEACurr" class="form-control input-sm">
                                <?php echo dropdown_options('currency', $jo_alloc_info[0]['poea_request_cur_id']);?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 mt-sm">
                        <div id="" class="form-group">
                            <label for="">&nbsp;</label>
                            <input id="textPOEASalAmt" name="textPOEASalAmt" value="<?php echo $jo_alloc_info[0]['poea_request_sal_amt'];?>" autocomplete="off" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="col-md-3 mt-sm">
                        <div id="" class="form-group">
                            <label for="">&nbsp;</label>
                            <select id="selectPOEASalPer" name="selectPOEASalPer" class="form-control input-sm">
                                <option value="hour" <?php echo ($jo_alloc_info[0]['poea_request_sal_per']=='hour')?"selected=\"selected\"":""?>>/hour</option>
                                <option value="month" <?php echo ($jo_alloc_info[0]['poea_request_sal_per']=='month')?"selected=\"selected\"":""?>>/month</option>
                                <option value="year" <?php echo ($jo_alloc_info[0]['poea_request_sal_per']=='year')?"selected=\"selected\"":""?>>/year</option>
                                <option value="day" <?php echo ($jo_alloc_info[0]['poea_request_sal_per']=='day')?"selected=\"selected\"":""?>>/day</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Approved JO ID:</label>
                            <select id="selectPOEAApprovedID" name="selectPOEAApprovedID" class="form-control input-sm" onchange="get_approved_jo_pos()">
                                <?php echo generate_dd($jo_list, $jo_alloc_info[0]['poea_approved_id']);?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-8 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Approved JO Category:</label>
                            <select id="selectPOEAApprovedCat" name="selectPOEAApprovedCat" class="form-control input-sm">
                                <?php echo ($jo_approved_pos_list)?generate_dd($jo_approved_pos_list, $jo_alloc_info[0]['poea_approved_cat']):"<option value=\"\">Please select</option>";?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Remarks:</label>
                            <textarea id="textRemarks" name="textRemarks" rows="4" class="form-control input-sm"><?php echo $jo_alloc_info[0]['poea_remarks'];?></textarea>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-sm-12">
                        <input type="button" class="btn btn-block btn-primary" value="Submit" id="" onclick="save_jo_request();">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>