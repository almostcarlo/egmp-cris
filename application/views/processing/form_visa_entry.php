<?php
    if(isset($visa_info[0])){
        $id = $visa_info[0]['id'];
        $status = $visa_info[0]['status'];
        $visa_no = $visa_info[0]['visa_no'];
        $country = $visa_info[0]['country_id'];
        $days_valid = $visa_info[0]['days_valid'];
        $visa_date = dateformat($visa_info[0]['visa_date'],2);
        $visa_stamp = dateformat($visa_info[0]['visa_stamp'],2);
        $expiry_date = dateformat($visa_info[0]['expiry_date'],2);
        $sponsor = $visa_info[0]['sponsor_id'];
        $applicant = $visa_info[0]['applicant'];
        $applicant_id = $visa_info[0]['applicant_id'];
        $principal = $visa_info[0]['principal_id'];
        $attachment = $visa_info[0]['attachment'];
    }else{
        $id = "";
        $status = "";
        $visa_no = "";
        $country = "";
        $days_valid = "";
        $expiry_date = "";
        $visa_date = "";
        $visa_stamp = "";
        $sponsor = "";
        $applicant = "";
        $applicant_id = "";
        $principal = "";
        $attachment = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Individual VISA Entry</h4>
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

            <?php echo form_open('processing/save/visa_nonksa', 'id="frm_visa_entry" enctype="multipart/form-data"');?>
            	
            	<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
                <input type="hidden" id="" name="textAppId" value="<?php echo $applicant_id;?>">

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="selectPosition">VISA Status:</label>
                            <select id="selectStatus" name="selectStatus" class="form-control input-sm">
                                <!-- <option value="">Please select</option> -->
                                <option value="Valid" <?php echo ($status=='Valid')?"selected=\"selected\"":"";?>>Valid</option>
                                <option value="Expired" <?php echo ($status=='Expired')?"selected=\"selected\"":"";?>>Expired</option>
                            </select>
                        </div>
                    </div>
                <!-- </div>

                <div class="row"> -->
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">VISA No.:</label>
                            <input class="form-control input-sm" name="textVisaNo" id="textVisaNo" autocomplete="off" value="<?php echo $visa_no;?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Country:</label>
                            <select id="selectCountry" name="selectCountry" class="form-control input-sm">
                                <?php echo dropdown_options('country', $country);?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Client/Employer:</label>
                            <select id="selectEmployer" name="selectEmployer" class="form-control input-sm">
                                <?php echo dropdown_options('principal', $principal);?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div id="" class="form-group">
                            <label for="">VISA Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textVisaDate" name="textVisaDate" value="<?php echo $visa_date;?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                <!-- </div>

                <div class="row"> -->
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="">No. of Days to expired:</label>
                            <input class="form-control input-sm" name="textDays" id="textDays" autocomplete="off" value="<?php echo $days_valid;?>" onkeyup="compute_end_date($('#textVisaDate').val(), $(this).val(), '#textExpiry')">
                        </div>
                    </div>
                <!-- </div>

                <div class="row"> -->
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="">Expiry Date:</label>
                            <input class="form-control input-sm" name="textExpiry" id="textExpiry" readonly="true" autocomplete="off" value="<?php echo $expiry_date;?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div id="" class="form-group">
                            <label for="">VISA Stamp:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textVisaStamp" name="textVisaStamp" value="<?php echo $visa_stamp;?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Sponsor Name:</label>
                            <input class="form-control input-sm" name="textSponsor" id="textSponsor" autocomplete="off" value="<?php echo $sponsor;?>">
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Applicant Name:</label>
                            <input type="text" class="form-control" <?php echo ($id<>'')?"readonly=\"true\"":"";?> data-target="#PublicationName" list="app_list" name="selectApplicant" id="selectApplicant" autocomplete="off" value="<?php echo $applicant;?>">
                            <datalist id="app_list">
                                <?php echo generate_dd($applicant_list, $applicant, false);?>
                            </datalist>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Attach Document (max size 3mb):</label>
                            <?php if($attachment<>''):?>
                                <br class="file_elements">
                                <a class="file_elements" href="<?php echo BASE_URL."applicant/my_files/".base64_encode($id)."/manager_visa_nonksa/attachment";?>" target="_blank"><?php echo $attachment;?></a> <a class="file_elements" style="color:red;" href="javascript:void(0);" onclick="delete_file('<?php echo $id;?>');">[delete]</a>
                                <input type="file" class="form-control input-sm input_elements hidden" name="textAttach" id="textAttach" >
                            <?php else:?>
                                <input type="file" class="form-control input-sm" name="textAttach" id="textAttach" >
                            <?php endif;?>
                        </div>
                    </div>
                </div>

                
                <hr />

                <div class="row">
                    <div class="col-sm-12">
                        <input type="button" class="btn btn-block btn-primary" value="Save" id="btn_save_visa" onclick="save_visa_nonksa();">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>