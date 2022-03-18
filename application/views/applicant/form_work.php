<?php
    $work_history = getMaxCount('applicant_work_history', $applicant_id);

    if(isset($work_info[0])){
        $work_company = $work_info[0]['company_name'];
        $work_pos = $work_info[0]['position'];
        $work_desc = $work_info[0]['job_desc'];
        $work_country = $work_info[0]['country_id'];
        $work_salary = $work_info[0]['salary'];
        $work_from = dateformat($work_info[0]['start_date'], 2);
        $work_to = dateformat($work_info[0]['end_date'], 2);
        $work_reason = $work_info[0]['reason_for_leaving'];
        $work_addr = $work_info[0]['address'];
    }else{
        $work_company = "";
        $work_pos = "";
        $work_desc = "";
        $work_country = "";
        $work_salary = "";
        $work_from = "";
        $work_to = "";
        $work_reason = "";
        $work_addr = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Work History</h4>
                </div>
            </div>
            
            <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                <strong>ERROR!</strong><br>
                <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
        	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                <strong>SUCCESS!</strong><br>
                <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
            </div>

            <?php echo form_open('applicant/save_profile/work', 'id="frm_work"');?>
            
            	<input type="hidden" name="hEmpId" value="<?php echo $record_id;?>">
            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">

                <div class="row">
                    <div class="col-md-8 mt-sm">
                        <div class="form-group">
                            <label for="checkNoEmployment">
                                <input type="checkbox" id="checkNoEmployment" name="checkNoEmployment" <?php echo ($applicant_data['personal']->is_freshgrad=='Y')?"checked=\"checked\"":"";?> <?php echo ($work_history>0)?"disabled=\"disabled\"":"";?> style="vertical-align:top" />
                                Fresh graduate or no working experience yet.
                            </label>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-8 mt-sm">
                        <div class="form-group">
                            <label for="textCompany">Company:</label>
                            <input type="text" id="textCompany" name="textWorkEmployer" value="<?php echo $work_company;?>" class="form-control input-sm" <?php echo ($applicant_data['personal']->is_freshgrad=='Y')?"disabled=\"disabled\"":"";?> />
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textPosition">Position:</label>
                            <input type="text" id="textPosition" name="textWorkPosition" value="<?php echo $work_pos;?>" class="form-control input-sm" <?php echo ($applicant_data['personal']->is_freshgrad=='Y')?"disabled=\"disabled\"":"";?> />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Address:</label>
                            <input type="text" id="textAddr" name="textAddr" value="<?php echo $work_addr;?>" class="form-control input-sm" <?php echo ($applicant_data['personal']->is_freshgrad=='Y')?"disabled=\"disabled\"":"";?> />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textSalary">Salary:</label>
                            <input type="text" id="textSalary" name="textSalary" value="<?php echo $work_salary;?>" class="form-control input-sm" <?php echo ($applicant_data['personal']->is_freshgrad=='Y')?"disabled=\"disabled\"":"";?> />
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="selectCountry">Country:</label>
                            <select id="selectCountry" name="selectCountry" class="form-control input-sm" <?php echo ($applicant_data['personal']->is_freshgrad=='Y')?"disabled=\"disabled\"":"";?>>
                                <?php echo dropdown_options('country', $work_country)?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label fo="textWorkFrom">From:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textWorkFrom" name="inputEmploymentFrom" autocomplete="off" value="<?php echo $work_from;?>" type="text" data-plugin-datepicker class="form-control input-sm" <?php echo ($applicant_data['personal']->is_freshgrad=='Y')?"disabled=\"disabled\"":"";?>>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label fo="textWorkTo">To:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textWorkTo" name="inputEmploymentTo" autocomplete="off" value="<?php echo $work_to;?>" type="text" data-plugin-datepicker class="form-control input-sm" <?php echo ($applicant_data['personal']->is_freshgrad=='Y')?"disabled=\"disabled\"":"";?>>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Job Description:</label>
                            <textarea rows="4" cols="" id="textJobDesc" name="textJobDesc" class="form-control input-sm" <?php echo ($applicant_data['personal']->is_freshgrad=='Y')?"disabled=\"disabled\"":"";?>><?php echo $work_desc;?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Reason for Leaving:</label>
                            <textarea rows="4" cols="" id="textReason" name="textReason" class="form-control input-sm" <?php echo ($applicant_data['personal']->is_freshgrad=='Y')?"disabled=\"disabled\"":"";?>><?php echo $work_reason;?></textarea>
                        </div>
                    </div>
                </div>
                
                <hr />

                <div class="row">
                    <div class="col-sm-3">
                        <input type="button" onclick="save_work();" class="btn btn-block btn-primary" value="Submit">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>