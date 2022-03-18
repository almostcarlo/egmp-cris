<?php
//var_dump($previous_allocation);
//var_dump($visa_pos_list);
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Accept VISA Endorsement</h4>
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

            <?php echo form_open('applicant/visa_allocation', 'id="frm_visa_alloc"');?>
                
                <input type="hidden" id="textRecordId_f" name="textRecordId" value="<?php echo $visa_alloc_info[0]['id'];?>">

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Request Allocation - VISA No.:</label>
                            <select id="selectVisaNoReq" name="selectVisaNoReq" class="form-control input-sm" onchange="get_visa_pos();">
                                <?php echo generate_dd($visa_list, $visa_alloc_info[0]['request_visa_id']);?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Request Category:</label>
                            <select id="selectVisaCatReq" name="selectVisaCatReq" class="form-control input-sm">
                                <?php echo generate_dd($visa_pos_list, $visa_alloc_info[0]['request_visa_cat']);?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Approved Category:</label>
                            <select id="selectApprovedCat" name="selectApprovedCat" class="form-control input-sm">
                                <option value="">Please select</option>
                                <?php
                                    foreach($visa_pos_list as $id => $desc){
                                        $remarks = "";
                                        $disabled = "";

                                        if(isset($previous_allocation[$id])){
                                            if($previous_allocation[$id]['quantity'] <= count($previous_allocation[$id]['applicants'])){
                                                $remarks = " (no available balance)";
                                                $disabled = "disabled=\"disabled\"";
                                            }
                                        }
                                ?>
                                        <option value="<?php echo $id;?>" <?php echo $disabled;?>><?php echo $desc.$remarks;?></option>
                                <?php
                                    }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Status:</label>
                            <select id="selectVisaStat" name="selectVisaStat" class="form-control input-sm">
                                <option value="">please select</option>
                                <option value="Accepted">Accepted</option>
                                <option value="Denied">Denied</option>
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
                                <input id="textVisaReqDate" name="textVisaReqDate" value="" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Remarks:</label>
                            <textarea id="textRemarks" name="textRemarks" rows="4" class="form-control input-sm"></textarea>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-sm-12">
                        <input type="button" class="btn btn-block btn-primary" value="Submit" id="" onclick="save_visa_alloc();">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>