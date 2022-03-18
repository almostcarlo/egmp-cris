<?php
    if(isset($training_info[0])){
        $training_title = $training_info[0]['training_desc'];
        $training_center = $training_info[0]['training_center'];
        $training_from = $training_info[0]['start_date'];
        $training_to = $training_info[0]['end_date'];
        $training_country = $training_info[0]['country_id'];
    }else{
        $training_title = "";
        $training_center = "";
        $training_from = "";
        $training_to = "";
        $training_country = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Trainings / Seminars</h4>
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

            <?php echo form_open('applicant/save_profile/training', 'id="frm_training"');?>
            
            	<input type="hidden" name="hTrainingId" value="<?php echo $record_id;?>">
            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">

                <div class="row">
                    <div class="col-md-8 mt-sm">
                        <div class="form-group">
                            <label for="textTrainings">Trainings / Seminars Title:</label>
                            <input type="text" id="textTrainings" name="textTrainingTitle" value="<?php echo $training_title;?>" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textLicenseNum">Training Center / Venue:</label>
                            <input type="text" id="textLicenseNum" name="textTrainingCenter" value="<?php echo $training_center;?>" class="form-control input-sm" />
                        </div>
                    </div>
                </div>

                
                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label fo="textTrainingDateFrom">Training Date From:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textTrainingDateFrom" name="inputTrainingFrom" autocomplete="off" value="<?php echo $training_from;?>" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label fo="textTrainingDateTo">Training Date To:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textTrainingDateTo" name="inputTrainingTo" autocomplete="off" value="<?php echo $training_to;?>" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label fo="textDuration">Country:</label>
                            <select id="selectCountry" name="selectCountry" class="form-control input-sm">
                                <?php echo dropdown_options('country', $training_country)?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <hr />

                <div class="row">
                    <div class="col-sm-3">
                        <input type="button" onclick="save_training();" class="btn btn-block btn-primary" value="Submit">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>