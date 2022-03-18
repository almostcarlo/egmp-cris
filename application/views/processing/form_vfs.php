<?php
    if(isset($visa_info[0])){
        $id = $visa_info[0]['id'];
        $applicant_id = $visa_info[0]['applicant_id'];
        $applicant = $visa_info[0]['applicant'];
        $prop_date = dateformat($visa_info[0]['proposed_sched'],2);
        $final_date = dateformat($visa_info[0]['final_sched'],2);
        $venue = $visa_info[0]['venue'];
        $ref_no = $visa_info[0]['ref_no'];;
        $rel_date = dateformat($visa_info[0]['release_date'],2);
    }else{
        $id = "";
        $applicant = "";
        $applicant_id = "";
        $prop_date = "";
        $final_date = "";
        $venue = "";
        $ref_no = "";
        $rel_date = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">VFS Schedule</h4>
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

            <?php echo form_open('processing/save/vfs_sched', 'id="frm_vfs_sched"');?>
            	
            	<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
                <input type="hidden" id="" name="textAppId" value="<?php echo $applicant_id;?>">

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Applicant Name:</label>
                            <input type="text" class="form-control" <?php echo ($id<>'')?"readonly=\"true\"":"";?> data-target="" list="app_list" name="selectApplicant" id="selectApplicant" autocomplete="off" value="<?php echo $applicant;?>">
                            <datalist id="app_list">
                                <?php echo generate_dd($applicant_list, $applicant, false);?>
                            </datalist>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Client/Employer:</label>
                            <select id="selectEmployer" name="selectEmployer" class="form-control input-sm">
                                <?php echo dropdown_options('principal', $principal);?>
                            </select>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Proposed Schedule:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textPropDate" name="textPropDate" value="<?php echo $prop_date;?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Final Schedule:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textFinalDate" name="textFinalDate" value="<?php echo $final_date;?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="selectPosition">Venue:</label>
                            <input type="text" name="textVenue" id="textVenue" value="<?php echo $venue;?>" class="form-control input-sm">
                        </div>
                    </div>

                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Reference No.:</label>
                            <input class="form-control input-sm" name="textRefNo" id="textRefNo" autocomplete="off" value="<?php echo $ref_no;?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Release Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textRelDate" name="textRelDate" value="<?php echo $rel_date;?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-sm-12">
                        <input type="button" class="btn btn-block btn-primary" value="Save" id="btn_save_visa" onclick="save_vfs();">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>