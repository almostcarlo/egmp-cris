<?php
// if($process_data){
//     echo "MERON";
// }else{
//     echo "WALA";
// }
?>
<div id="personal" class="tab-pane active">
    
    <div class="row">
        <div class="col-md-4">
            <!-- VISA REQ -->
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <!-- <a href="<?php echo BASE_URL;?>operations/forms/doclib/<?php echo $applicant_id;?>/ppt" target="_blank" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> Document Library - Passport</a> -->
                    <h2 class="panel-title">VISA Request</h2>
                </header>
                <div class="panel-body">
                    <form method="POST" action="<?php echo BASE_URL;?>applicant/processing/request_visa/<?php echo $applicant_id;?>" id="form_visa_req">
                        <div class="row">
                            <div class="col-md-12 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Request Alloc. - VISA NO.:</label>
                                    <?php if(!$process_data || ($process_data && !$process_data[0]['request_visa_id'])):?>
                                        <select name="selectVisaNoReq" id="selectVisaNoReq" class="form-control input-sm" onchange="get_visa_pos()">
                                            <?php echo generate_dd($visa_list, '');?>
                                        </select>
                                    <?php else:?>
                                        <input type="text" id="" name="" value="<?php echo $process_data[0]['visa_no'];?>" autocomplete="off" readonly="readonly" class="form-control input-sm" />
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="col-md-12 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Request Category:</label>
                                    <?php if(!$process_data || ($process_data && !$process_data[0]['request_visa_id'])):?>
                                        <select name="selectVisaCatReq" id="selectVisaCatReq" class="form-control input-sm">
                                            <option value="">Please select</option>
                                        </select>
                                    <?php else:?>
                                        <input type="text" id="" name="" value="<?php echo $process_data[0]['visa_pos'];?>" autocomplete="off" readonly="readonly" class="form-control input-sm" />
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="col-md-12 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Approved VISA Category:</label>
                                    <input type="text" id="" name="" value="<?php echo ($process_data && $process_data[0]['request_status']=='Accepted')?$process_data[0]['approved_visa_pos']:"";?>" autocomplete="off" readonly="readonly" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        <?php if(!$process_data || ($process_data && !$process_data[0]['request_visa_id'])):?>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="button" value="Submit VISA Request" class="btn btn-block btn-primary" id="" onclick="save_visa_request();">
                                </div>
                            </div>
                        <?php endif;?>
                    </form>
                </div>
            </section>
            <!-- END VISA REQ -->

            <!-- TRANSMITTAL -->
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <!-- <a href="<?php echo BASE_URL;?>operations/forms/doclib/<?php echo $applicant_id;?>/nbi" target="_blank" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> Document Library - NBI</a> -->
                    <h2 class="panel-title">VISA Transmittal</h2>
                </header>
                <div class="panel-body">
                    <div class="alert alert-default alert-nobg">
                        <div class="row">
                            <p class="col-md-3" style="margin-bottom:1;"><strong>Submit Date:</strong></p> <p class="col-md-9" style="margin-bottom:1;">
                                <?php echo ($process_data)?dateformat($process_data[0]['transmittal_submit_date'], 1):"";?>&nbsp;
                            </p>
                            <br>
                            <p class="col-md-3" style="margin-bottom:1;"><strong>Release Date:</strong></p> <p class="col-md-9" style="margin-bottom:1;">
                                <?php echo ($process_data)?dateformat($process_data[0]['transmittal_release_date'], 1):"";?>&nbsp;
                            </p>
                        </div>
                    </div>
                    
                </div>
            </section>
            <!-- END TRANSMITTAL -->

            <!-- VISA DOC -->
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">VISA Documentation</h2>
                </header>
                <div class="panel-body">
                    <form method="POST" action="<?php echo BASE_URL;?>applicant/processing/visa_documentation/<?php echo $applicant_id;?>" id="form_visa_doc">
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Request Date:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textVisaDocReqDate" name="textVisaDocReqDate" value="<?php echo ($process_data)?dateformat($process_data[0]['visa_doc_req_date'], 2):"";?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Date Prepared:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textVisaDocPrepDate" name="textVisaDocPrepDate" value="<?php echo ($process_data)?dateformat($process_data[0]['visa_doc_prep_date'], 2):"";?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Send Date:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textVisaDocSendDate" name="textVisaDocSendDate" value="<?php echo ($process_data)?dateformat($process_data[0]['visa_doc_send_date'], 2):"";?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Received Date:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textVisaDocRecvDate" name="textVisaDocRecvDate" value="<?php echo ($process_data)?dateformat($process_data[0]['visa_doc_rec_date'], 2):"";?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Expiry Date:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textVisaDocExpDate" name="textVisaDocExpDate" value="<?php echo ($process_data)?dateformat($process_data[0]['visa_doc_exp_date'], 2):"";?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Date Verified:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textVisaDocVrfyDate" name="textVisaDocVrfyDate" value="<?php echo ($process_data)?dateformat($process_data[0]['visa_doc_verify_date'], 2):"";?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">VISA No.:</label>
                                    <input type="text" id="textVisaDocNo" name="textVisaDocNo" value="<?php echo ($process_data)?$process_data[0]['visa_doc_no']:"";?>" autocomplete="off" class="form-control input-sm" />
                                </div>
                            </div>
                            <div class="col-md-12 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">VISA Category:</label>
                                    <input type="text" id="textVisaDocCat" name="textVisaDocCat" value="<?php echo ($process_data)?$process_data[0]['visa_doc_category']:"";?>" autocomplete="off" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-12">
                                <input type="button" value="Submit VISA Documentation" class="btn btn-block btn-primary" id="" onclick="save_visa_documentation();">
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <!-- END VISA DOC -->
        </div>

        
        <div class="col-md-4">
            <!-- VISA ENDORSEMENT -->
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <!-- <a href="<?php echo BASE_URL;?>medical/forms/default/<?php echo $applicant_id;?>/ppt" target="_blank" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> Medical Form</a> -->
                    <h2 class="panel-title">VISA Endorsement</h2>
                </header>
                <div class="panel-body">
                    <p class="col-md-2" style="margin-bottom:1;"><strong>Date:</strong></p> <p class="col-md-10" style="margin-bottom:1;">
                        <?php echo ($process_data)?dateformat($process_data[0]['visa_endorsement_date'], 1):"";?>&nbsp;
                    </p>
                    <br>
                    <p class="col-md-2" style="margin-bottom:1;"><strong>By:</strong></p> <p class="col-md-10" style="margin-bottom:1;">
                        <?php echo ($process_data)?$process_data[0]['visa_endorsement_by']:"";?>&nbsp;
                    </p>
                    <?php if(!$process_data || ($process_data && $process_data[0]['visa_endorsement_date'] == '0000-00-00 00:00:00')):?>
                        <div class="row">
                            <div class="col-md-12 mt-sm">
                                <?php if((isset($med_status) && $med_status == 'Valid' && $med_result == 'fit') && (isset($ppt_status) && $ppt_status == 'Valid')):?>
                                    <input type="button" value="Endorse" class="btn btn-block btn-primary" id="" onclick="visa_endorsement('<?php echo $applicant_id;?>');">
                                <?php else:?>
                                    <p class="col-md-12" style="margin-bottom:1;"><small class="required">*valid medical and passport required.</small></p>
                                <?php endif;?>
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </section>

            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Accept VISA Endorsement</h2>
                </header>
                <div class="panel-body">
                    <p class="col-md-2" style="margin-bottom:1;"><strong>Status:</strong></p> <p class="col-md-10" style="margin-bottom:1;"><?php echo ($process_data)?$process_data[0]['request_status']:"";?>&nbsp;</p>
                    <br>
                    <p class="col-md-2" style="margin-bottom:1;"><strong>Date:</strong></p> <p class="col-md-10" style="margin-bottom:1;"><?php echo ($process_data)?dateformat($process_data[0]['request_updated'], 1):"";?>&nbsp;</p>
                    <br>
                    <p class="col-md-2" style="margin-bottom:1;"><strong>By:</strong></p> <p class="col-md-10" style="margin-bottom:1;"><?php echo ($process_data && $process_data[0]['request_status']<>'')?$process_data[0]['request_by']:"&nbsp;";?></p>
                    <br>
                    <p class="col-md-2" style="margin-bottom:1;"><strong>Remarks:</strong></p> <p class="col-md-10" style="margin-bottom:1;"><?php echo ($process_data)?$process_data[0]['request_remarks']:"";?>&nbsp;</p>
                </div>
            </section>
            <!-- END VISA ENDORSEMENT -->

            <!-- CONTRACT SIGNING -->
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Contract Signing</h2>
                </header>
                <div class="panel-body">
                    <form method="POST" action="<?php echo BASE_URL;?>applicant/processing/contract_signing/<?php echo $applicant_id;?>" id="form_contract_signing">
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Schedule:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textContractSched" name="textContractSched" value="<?php echo ($process_data)?dateformat($process_data[0]['contract_sched_date'], 2):"";?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Date Endorsed:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textContractEndorsed" name="textContractEndorsed" value="<?php echo ($process_data)?dateformat($process_data[0]['contract_endorse_date'], 2):"";?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Signed:</label>
                                    <input id="" name="" value="" type="text" readonly="readonly" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Sent to RSO:</label>
                                    <input id="" name="" value="" type="text" readonly="readonly" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Assisted By:</label>
                                    <input id="" name="" value="" type="text" readonly="readonly" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Date Checked:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textContractChk" name="textContractChk" value="<?php echo ($process_data)?dateformat($process_data[0]['contract_check_date'], 2):"";?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Checked By:</label>
                                    <input id="" name="" value="<?php echo ($process_data)?$process_data[0]['contract_check_by']:"";?>" type="text" readonly="readonly" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Date Released:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textContractRel" name="textContractRel" value="<?php echo ($process_data)?dateformat($process_data[0]['contract_rel_date'], 2):"";?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Released By:</label>
                                    <input id="" name="" value="<?php echo ($process_data)?$process_data[0]['contract_rel_by']:"";?>" type="text" readonly="readonly" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-12">
                                <input type="button" value="Submit Contract Information" class="btn btn-block btn-primary" id="" onclick="save_contract_signing();">
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <!-- END CONTRACT SIGNING -->

            <!-- PDOS -->
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">PDOS</h2>
                </header>
                <div class="panel-body">
                    <form method="POST" action="<?php echo BASE_URL;?>applicant/processing/pdos/<?php echo $applicant_id;?>" id="form_pdos">
                        <div class="row">
                            <div class="col-md-12 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Schedule:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textPdosSched" name="textPdosSched" value="<?php echo ($process_data)?dateformat($process_data[0]['pdos_sched_date'], 2):"";?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Certificate No.:</label>
                                    <input type="text" id="textPdosCert" name="textPdosCert" value="<?php echo ($process_data)?$process_data[0]['pdos_cert_no']:"";?>" autocomplete="off" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Date Taken:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textPdosTaken" name="textPdosTaken" value="<?php echo ($process_data)?dateformat($process_data[0]['pdos_taken'], 2):"";?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-12">
                                <input type="button" value="Submit PDOS Information" class="btn btn-block btn-primary" id="" onclick="submit_pdos();">
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <!-- END PDOS -->
        </div>

        <div class="col-md-4">
            <!-- RFP -->
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">RFP Endorsement</h2>
                </header>
                <div class="panel-body">
                    <p class="col-md-2" style="margin-bottom:1;"><strong>Date:</strong></p> <p class="col-md-10" style="margin-bottom:1;">
                        <?php echo ($process_data)?dateformat($process_data[0]['rfp_endorsement_date'], 1):"";?>&nbsp;
                    </p>
                    <br>
                    <p class="col-md-2" style="margin-bottom:1;"><strong>By:</strong></p> <p class="col-md-10" style="margin-bottom:1;">
                        <?php echo ($process_data)?$process_data[0]['rfp_endorsement_by']:"";?>&nbsp;
                    </p>
                    <?php if(!$process_data || ($process_data && $process_data[0]['rfp_endorsement_date'] == '0000-00-00 00:00:00')):?>
                        <div class="row">
                            <div class="col-md-12 mt-sm">
                                <input type="button" value="Endorse" class="btn btn-block btn-primary" id="" onclick="rfp_endorsement('<?php echo $applicant_id;?>');">
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </section>

            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Accept RFP</h2>
                </header>
                <div class="panel-body">
                    <p class="col-md-2" style="margin-bottom:1;"><strong>Status:</strong></p> <p class="col-md-10" style="margin-bottom:1;"><?php echo ($process_data)?$process_data[0]['rfp_status']:"";?>&nbsp;</p>
                    <br>
                    <p class="col-md-2" style="margin-bottom:1;"><strong>Date:</strong></p> <p class="col-md-10" style="margin-bottom:1;"><?php echo ($process_data)?dateformat($process_data[0]['rfp_updated'], 1):"";?>&nbsp;</p>
                    <br>
                    <p class="col-md-2" style="margin-bottom:1;"><strong>By:</strong></p> <p class="col-md-10" style="margin-bottom:1;"><?php echo ($process_data)?$process_data[0]['rfp_edit_by']:"";?>&nbsp;</p>
                    <br>
                    <p class="col-md-2" style="margin-bottom:1;"><strong>Remarks:</strong></p> <p class="col-md-10" style="margin-bottom:1;"><?php echo ($process_data)?$process_data[0]['rfp_remarks']:"";?>&nbsp;</p>
                </div>
            </section>
            <!-- END RFP -->

            <!-- POEA ALLOCATION -->
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <?php if($process_data && !dateformat($process_data[0]['poea_req_date'])):?>
                        <a href="<?php echo BASE_URL?>applicant/processing/poea_request/<?php echo $applicant_id;?>" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> Request JO</a>
                    <?php endif;?>
                    <h2 class="panel-title">POEA</h2>
                </header>
                <div class="panel-body">
                    <form method="POST" action="<?php echo BASE_URL;?>applicant/processing/request_jo/<?php echo $applicant_id;?>" id="form_poea_req">
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="">JO Request Date:</label>
                                    <input id="" name="" value="<?php echo ($process_data)?dateformat($process_data[0]['poea_req_date'],1):"";?>" type="text" readonly="readonly" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="">Request Sent to POEA:</label>
                                    <input id="" name="" value="<?php echo ($process_data)?dateformat($process_data[0]['poea_sent_date'],1):"";?>" type="text" readonly="readonly" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="">Approval Date:</label>
                                    <input id="" name="" value="<?php echo ($process_data)?dateformat($process_data[0]['poea_approve_date'],1):"";?>" type="text" readonly="readonly" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mt-sm">
                                <div id="" class="form-group">
                                    <label for="">JO ID:</label>
                                    <?php if(!$process_data || ($process_data && !$process_data[0]['poea_request_id'])):?>
                                        <select name="selectJOIDReq" id="selectJOIDReq" class="form-control input-sm" onchange="get_jo_pos()">
                                            <?php echo generate_dd($jo_id_list, '');?>
                                        </select>
                                    <?php else:?>
                                        <input type="text" name="" value="<?php echo $process_data[0]['jo_id'];?>" class="form-control input-sm" readonly="readonly">
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="col-md-8 mt-sm">
                                <div id="" class="form-group">
                                    <label for="">JO Category:</label>
                                    <?php if(!$process_data || ($process_data && !$process_data[0]['poea_request_id'])):?>
                                        <select name="selectJOCatReq" id="selectJOCatReq" class="form-control input-sm">
                                            <option value="">Please select</option>
                                        </select>
                                    <?php else:?>
                                        <input type="text" name="" value="<?php echo $process_data[0]['jo_pos'];?>" class="form-control input-sm" readonly="readonly">
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">OEC:</label>
                                    <input type="text" id="" name="" value="<?php echo ($process_data)?$process_data[0]['rfp_oec_no']:"";?>" readonly="readonly" class="form-control input-sm" />
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">CG No.:</label>
                                    <input type="text" id="" name="" value="<?php echo ($process_data)?$process_data[0]['rfp_cg_no']:"";?>" readonly="readonly" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="">Date Submitted:</label>
                                    <input id="" name="" value="<?php echo ($process_data)?dateformat($process_data[0]['rfp_submit_date'],1):"";?>" type="text" readonly="readonly" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="">Date Released:</label>
                                    <input id="" name="" value="<?php echo ($process_data)?dateformat($process_data[0]['rfp_release_date'],1):"";?>" type="text" readonly="readonly" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                        <hr />
                        <div class="row">
                            <div class="col-md-6">
                                <?php if($process_data && (dateformat($process_data[0]['poea_req_date']) && $process_data[0]['poea_request_id'] == '0')):?>
                                    <input type="button" value="Allocate" class="btn btn-block btn-primary" onclick="save_jo_request();">
                                <?php else:?>
                                    <input type="button" value="Allocate" class="btn btn-block btn-primary disabled">
                                <?php endif;?>
                            </div>
                            <div class="col-md-6">
                                <?php if($process_data && (!dateformat($process_data[0]['poea_sent_date']) && $process_data[0]['poea_request_id'] <> '0')):?>
                                    <input type="button" value="De-Allocate" class="btn btn-block btn-danger" onclick="deallocate_jo('<?php echo $applicant_id;?>');">
                                <?php else:?>
                                    <input type="button" value="De-Allocate" class="btn btn-block btn-danger disabled">
                                <?php endif;?>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            <!-- END POEA ALLOCATION -->
        </div>

    </div>
    
</div>