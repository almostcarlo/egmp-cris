<?php
    if(isset($educ_info[0])){
        $educ_level = $educ_info[0]['level_id'];
        $educ_school = $educ_info[0]['school_name'];
        $educ_course = $educ_info[0]['course'];
        $educ_location = $educ_info[0]['location'];
        $educ_from = dateformat($educ_info[0]['start_date'], 2);
        $educ_to = dateformat($educ_info[0]['end_date'], 2);
        $graduated = $educ_info[0]['graduated'];
    }else{
        $educ_level = "";
        $educ_school = "";
        $educ_course = "";
        $educ_location = "";
        $educ_from = "";
        $educ_to = "";
        $graduated = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Educational Attainment</h4>
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

            <?php echo form_open('applicant/save_profile/education', 'id="frm_education"');?>
            	
            	<input type="hidden" name="hEducId" value="<?php echo $record_id;?>">
            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">
                
                <!-- <label class="mt-sm"><input type="checkbox" style="vertical-align:middle;margin:0;" /> License/Certificate:</label> -->

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="selectEducation">Education:</label>
                            <select id="selectEducation" name="selectEducation" class="form-control input-sm">
                            	<?php echo dropdown_options('education', $educ_level)?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3 mt-sm">
                        <div class="form-group">
                            <label fo="textEducFrom">From:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textEducFrom" name="inputEducFrom" autocomplete="off" type="text" value="<?php echo $educ_from;?>" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mt-sm">
                        <div class="form-group">
                            <label fo="textEducTo">To:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textEducTo" name="inputEducTo" autocomplete="off" type="text" value="<?php echo $educ_to;?>" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="textSchool">School:</label>
                            <input type="text" id="textSchool" name="textSchool" value="<?php echo $educ_school;?>" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="textCourse">Course:</label>
                            <input type="text" id="textCourse" name="textCourse" value="<?php echo $educ_course;?>" class="form-control input-sm" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="selectFieldOfStudy">Location:</label>
                            <input type="text" id="textCourse" name="textLoc" value="<?php echo $educ_location;?>" class="form-control input-sm" />
                        </div>
                    </div>
					<div class="col-md-3 mt-sm">
                        <div class="form-group">
                            <label for="selectGraduated">Graduated:</label>
                            <select id="selectGraduated" name="selectGraduated" class="form-control input-sm">
                                <option value="Y" <?php echo ($graduated=='Y')?"selected=\"selected\"":""?>>Yes</option>
                                <option value="N" <?php echo ($graduated=='N')?"selected=\"selected\"":""?>>No</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="selectFieldOfStudy">Field of Study:</label>
                            <select id="selectFieldOfStudy" class="form-control input-sm">
                                <option>-- Please select --</option>
                            </select>
                        </div>
                    </div> -->
                </div>
                
                <hr />

                <div class="row">
                    <div class="col-sm-3">
                        <input type="button" onclick="save_education();" class="btn btn-block btn-primary" value="Submit">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>