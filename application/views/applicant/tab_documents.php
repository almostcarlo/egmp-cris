<?php
    $clinic_remarks = "Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.";
    $counter_remarks = "Lorem ipsum is placeholder text commonly used in the graphic, print, and publishing industries for previewing layouts and visual mockups.";
    $nbi_status = "";
    $ppt_status = "";
    $med_status = "";
    $med_result = "&nbsp;";

    if($ppt_info){
        if(dateformat($ppt_info[0]['released_date']) || $ppt_info[0]['released_by'] <> ''){
            $ppt_status = "Released";
        }else{
            $ppt_status = checkExpiry($ppt_info[0]['expiry_date']);
        }
    }

    if($nbi_info){
        if(dateformat($nbi_info[0]['released_date']) || $nbi_info[0]['released_by'] <> ''){
            $nbi_status = "Released";
        }else{
            $nbi_status = checkExpiry($nbi_info[0]['expiry_date']);
        }
    }

    if($med_info){
        $med_status = checkExpiry($med_info[0]['med_result_exp_date']);

        if($med_info[0]['med_result'] <> ''){
            $med_result = $med_info[0]['med_result'];
        }else{
            $med_result = "awaiting result";
        }
    }

    if($nbi_status == 'Valid' && $ppt_status == 'Valid' && ($med_status == 'Valid' && $med_result == 'fit') && ($emp_offer_info && ($emp_offer_info[0]['probation'] <> '' && $emp_offer_info[0]['contract_type'] <> '' && $emp_offer_info[0]['employment_status'] <> '' && $emp_offer_info[0]['contract_period'] <> '' && $emp_offer_info[0]['hrs_work'] <> '' && $emp_offer_info[0]['salary_currency'] <> '' && $emp_offer_info[0]['salary_per'] <> '' && $emp_offer_info[0]['salary_amount'] <> '' && $emp_offer_info[0]['accomodation'] <> '' && $emp_offer_info[0]['transportation'] <> '' && $emp_offer_info[0]['food'] <> '' && $emp_offer_info[0]['overtime'] <> '' && $emp_offer_info[0]['leave_provision'] <> '' && $emp_offer_info[0]['leave_ent'] <> '' && $emp_offer_info[0]['ticket_ent'] <> '' && $emp_offer_info[0]['insurance'] <> '' && $emp_offer_info[0]['gratuity'] <> '' && $emp_offer_info[0]['bonus'] <> '' && $emp_offer_info[0]['special_condition'] <> '' && $emp_offer_info[0]['approval_date'] <> '0000-00-00 00:00:00' && $emp_offer_info[0]['select_date'] <> '0000-00-00 00:00:00' && $emp_offer_info[0]['lineup_status'] == 'Selected' && $emp_offer_info[0]['lineup_acceptance'] == 'Accepted'))){
        $allow_endorsement = TRUE;
    }else{
        $allow_endorsement = FALSE;
    }
?>
<div id="personal" class="tab-pane active">
    
    <div class="row">
        <div class="col-md-4">
            <!-- PPT -->
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <a href="<?php echo BASE_URL;?>operations/forms/doclib/<?php echo $applicant_id;?>/ppt" target="_blank" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> Document Library - Passport</a>
                    <h2 class="panel-title">Passport</h2>
                </header>
                <div class="panel-body">
                    <div class="alert alert-default alert-nobg">
                        <div class="row">
                            <p class="col-md-3" style="margin-bottom:1;"><strong>Passport No.:</strong></p> <p class="col-md-9" style="margin-bottom:1;"><?php echo ($ppt_info)?$ppt_info[0]['serial_no']."&nbsp;":"&nbsp;";?></p>
                            <p class="col-md-3" style="margin-bottom:1;"><strong>Date Issued:</strong></p> <p class="col-md-9" style="margin-bottom:1;"><?php echo ($ppt_info)?dateformat($ppt_info[0]['issue_date'])."&nbsp;":"&nbsp;";?></p>
                            <p class="col-md-3" style="margin-bottom:1;"><strong>Received Date:</strong></p> <p class="col-md-9" style="margin-bottom:1;"><?php echo ($ppt_info)?dateformat($ppt_info[0]['add_date'])."&nbsp;":"&nbsp;";?></p>
                            <p class="col-md-3" style="margin-bottom:1;"><strong>Expiry Date:</strong></p> <p class="col-md-9" style="margin-bottom:1;"><?php echo ($ppt_info)?dateformat($ppt_info[0]['expiry_date'])."&nbsp;":"&nbsp;";?></p>
                            <p class="col-md-3" style="margin-bottom:1;"><strong>Release Date:</strong></p> <p class="col-md-9" style="margin-bottom:1;"><?php echo ($ppt_info)?dateformat($ppt_info[0]['released_date'])."&nbsp;":"&nbsp;";?></p>
                            <p class="col-md-3" style="margin-bottom:1;"><strong>Status:</strong></p> <p class="col-md-9" style="margin-bottom:1;"><?php echo $ppt_status;?></p>
                        </div>
                    </div>
                    
                </div>
            </section>
            <!-- END PPT -->

            <!-- NBI -->
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <a href="<?php echo BASE_URL;?>operations/forms/doclib/<?php echo $applicant_id;?>/nbi" target="_blank" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> Document Library - NBI</a>
                    <h2 class="panel-title">NBI</h2>
                </header>
                <div class="panel-body">
                    <div class="alert alert-default alert-nobg">
                        <div class="row">
                            <p class="col-md-3" style="margin-bottom:1;"><strong>Date Issued:</strong></p> <p class="col-md-9" style="margin-bottom:1;"><?php echo ($nbi_info)?dateformat($nbi_info[0]['issue_date']):"&nbsp;";?></p>
                            <p class="col-md-3" style="margin-bottom:1;"><strong>Received Date:</strong></p> <p class="col-md-9" style="margin-bottom:1;"><?php echo ($nbi_info)?dateformat($nbi_info[0]['add_date']):"&nbsp;";?></p>
                            <p class="col-md-3" style="margin-bottom:1;"><strong>Expiry Date:</strong></p> <p class="col-md-9" style="margin-bottom:1;"><?php echo ($nbi_info)?dateformat($nbi_info[0]['expiry_date']):"&nbsp;";?></p>
                            <p class="col-md-3" style="margin-bottom:1;"><strong>Release Date:</strong></p> <p class="col-md-9" style="margin-bottom:1;"><?php echo ($nbi_info)?dateformat($nbi_info[0]['released_date'])."&nbsp;":"&nbsp;";?></p>
                            <p class="col-md-3" style="margin-bottom:1;"><strong>Status:</strong></p> <p class="col-md-9" style="margin-bottom:1;"><?php echo $nbi_status;?></p>
                        </div>
                    </div>
                    
                </div>
            </section>
            <!-- END NBI -->
        </div>

        <!-- MEDICAL -->
        <div class="col-md-4">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <a href="<?php echo BASE_URL;?>medical/forms/default/<?php echo $applicant_id;?>/ppt" target="_blank" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> Medical Form</a>
                    <h2 class="panel-title">Medical Exam</h2>
                </header>
                <div class="panel-body">
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Blood Type:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo ($med_info)?$med_info[0]['med_result_blood_type']."&nbsp;":"&nbsp;";?></p>
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Decking Requested:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo ($med_info)?dateformat($med_info[0]['gamca_req_date'])."&nbsp;":"&nbsp;";?></p>
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Referral Taken:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo ($med_info)?dateformat($med_info[0]['clinic_ref_taken_date']):"&nbsp;";?></p>
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Exam Date:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo ($med_info)?dateformat($med_info[0]['clinic_exam_date']):"&nbsp;";?></p>
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Certificate Receive Date:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo ($med_info)?dateformat($med_info[0]['or_counter_rec_date']):"&nbsp;";?></p>
                </div>
                <div class="panel-body">
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Clinic:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo ($med_info)?$med_info[0]['clinic']:"&nbsp;";?></p>
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Result:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo $med_result;?></p>
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Result Receive Date:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo ($med_info)?dateformat($med_info[0]['med_result_rec_date'])."&nbsp;":"&nbsp;";?></p>
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Transmittal Date:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo ($med_info)?dateformat($med_info[0]['med_result_trans_date'])."&nbsp;":"&nbsp;";?></p>
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Waiver Release Date:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo ($med_info)?dateformat($med_info[0]['waiver_rel_date'])."&nbsp;":"&nbsp;";?></p>
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Clinic Remarks:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo ($med_info)?$med_info[0]['med_result_clinic_remarks']."&nbsp;":"&nbsp;";?></p>
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Medical Group Remarks:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo ($med_info)?$med_info[0]['or_group_remarks']."&nbsp;":"&nbsp;";?></p>
                </div>
                <div class="panel-body">
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Expiry Date:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo ($med_info)?dateformat($med_info[0]['med_result_exp_date'])."&nbsp;":"&nbsp;";?></p>
                    <p class="col-md-4" style="margin-bottom:1;"><strong>Status:</strong></p> <p class="col-md-8" style="margin-bottom:1;"><?php echo $med_status;?></p>
                </div>
            </section>
        </div>
        <!-- END MEDICAL -->

        <!-- FOR ENDORSEMENT -->
        <div class="col-md-4">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <?php if(!$fe_info):?>
                        <a href="javascript:void(0);" onclick="for_endorsement('<?php echo $applicant_id;?>', '<?php echo $allow_endorsement;?>');" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add to list</a>
                    <?php endif;?>
                    <h2 class="panel-title">For Endorsement</h2>
                </header>
                <div class="panel-body">
                    <p class="col-md-3" style="margin-bottom:1;"><strong>Date Added:</strong></p> <p class="col-md-9" style="margin-bottom:1;"><?php echo ($fe_info)?dateformat($fe_info[0]['add_date'])."&nbsp;":"&nbsp;";?></p>
                    <p class="col-md-3" style="margin-bottom:1;"><strong>Added By:</strong></p> <p class="col-md-9" style="margin-bottom:1;"><?php echo ($fe_info)?$fe_info[0]['add_by']."&nbsp;":"&nbsp;";?></p>

                    <?php if($fe_info):?>
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="button" value="remove from FOR ENDORSEMENT list" class="btn btn-block btn-danger" id="" onclick="remove_for_endorsement('<?php echo $applicant_id;?>');">
                            </div>
                        </div>
                    <?php endif;?>
                </div>
            </section>
        </div>
        <!-- END FOR ENDORSEMENT -->
    </div>
    
</div>