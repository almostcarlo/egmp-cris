<?php
    //var_dump($province_list);
?>
<section role="main" class="content-body">
    
    <header class="page-header">
        <h2>New Applicant</h2>
    </header>

    <!-- start: page -->

    <div class="row">
        <div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <h3 class="panel-title">New Applicant Form</h3>
                </header>
                <div class="panel-body">
                
                <div id="errorNotice" class="alert alert-danger alert-dismissible" role="alert">
                    <!-- <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button> -->
                    <strong>ERROR!</strong><br>
                    <div id="defaultNoticeCont"><strong><span id="inputRequired"></span></strong></div>
                </div>
                    
                    <?php echo form_open('applicant/create_profile', 'id="frm_create"');?>
                        
                        <div class="row">
                            <div class="col-md-6" style="padding-left:15px;padding-right:15px;">
                                
                                <h4>Account Information</h4>
                                
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div id="divEmail" class="form-group">
                                            <label for="textEmail">Email Address:</label>
                                            <input type="text" id="textEmail" name="textEmail" autocomplete="off" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />
                                
                                <h4>Applied Position</h4>
                                
                                <div class="row" id="divAppliedPos">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="textAppliedCat">Position #1:</label>
                                            <input type="text" id="textAppliedCat" name="textAppliedCat[]" autocomplete="off" class="form-control input-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="textAppliedCat2">Position #2:</label>
                                            <input type="text" id="textAppliedCat2" name="textAppliedCat[]" autocomplete="off" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />
                                
                                <h4>Personal Information</h4>
                                
                                <div class="row" id="divName">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textLastName">Applicant's Name:</label>
                                            <input type="text" id="textLastName" name="textLastName" class="form-control input-sm" placeholder="Last Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-5 mt-sm">
                                        <div class="form-group">
                                            <label for="textFirstName">&nbsp;</label>
                                            <input type="text" id="textFirstName" name="textFirstName" class="form-control input-sm" placeholder="First Name" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group">
                                            <label for="textMiddleName">&nbsp;</label>
                                            <input type="text" id="textMiddleName" name="textMiddleName" class="form-control input-sm" placeholder="Middle Name" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group" id="divBday">
                                            <label for="textDateOfBirth">Date of Birth:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textDateOfBirth" name="inputBirthDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="selectGender">Gender</label>
                                            <select id="selectGender" name="selectGender" class="form-control input-sm">
                                                <option value="M">Male</option>
                                                <option value="F">Female</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group" id="divMobNo">
                                            <label for="textContactNumber">Contact No.</label>
                                            <input type="text" id="textContactNumber" name="textContactNumber" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="selectCivilStatus">Civil Status</label>
                                            <select id="selectCivilStatus" name="selectCivilStatus" class="form-control input-sm">
                                                <option value="Single">Single</option>
                                                <option value="Married">Married</option>
                                                <option value="Widowed">Widowed</option>
                                                <option value="Separated">Separated</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="selectNationality">Nationality</label>
                                            <select id="selectNationality" name="selectNationality" class="form-control input-sm">
                                                <?php echo dropdown_options('nationality', '');?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="textContactNumber">Landline No.</label>
                                            <input type="text" id="textLandNumber" name="textLandNumber" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="selectCivilStatus">Method of Application</label>
                                            <select id="selectMethod" name="selectMethod" class="form-control input-sm">
                                                <?php echo dropdown_options('method', '1');?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group">
                                            <label for="selectNationality">Source of Application</label>
                                            <select id="selectSource" name="selectSource" class="form-control input-sm">
                                                <?php echo dropdown_options('source', '');?>
                                            </select>
                                        </div>
                                    </div>
                                    <div id="div_agent" class="col-md-4 mt-sm hidden">
                                        <div class="form-group">
                                            <label for="">Agent</label>
                                            <select id="selectAgent" name="selectAgent" class="form-control input-sm">
                                                <?php echo dropdown_options('agent', '');?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />
                                
                                <h4>Present Address</h4>
                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group" id="divAddr">
                                            <label for="textStreet">House/Bldg./Apt. No. / Street</label>
                                            <input type="text" id="textStreet" name="textAddr" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-5 mt-sm">
                                        <div class="form-group">
                                            <label for="">Region</label>
                                            <select id="selectRegion" name="selectRegion" class="form-control input-sm">
                                                <?php echo generate_dd($region_list, '');?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group">
                                            <label for="selectProvince">Province</label>
                                            <select id="selectProvince" name="selectProvince" class="form-control input-sm">
                                                <option value="">Please select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4 mt-sm">
                                        <div class="form-group" id="divCity">
                                            <label for="">City / Municipality</label>
                                            <select id="selectCity" name="selectCity" class="form-control input-sm">
                                                <option value="">Please select</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-7 mt-sm">
                                        <div class="form-group" id="divCity">
                                            <label for="">Barangay</label>
                                            <select id="selectBrgy" name="selectBrgy" class="form-control input-sm">
                                                <option value="">Please select</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-5 mt-sm">
                                        <div class="form-group">
                                            <label for="selectCountry">Country</label>
                                            <select id="selectCountry" class="form-control input-sm">
                                                <?php echo dropdown_options('country', 174);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            
                            <div class="col-md-6" style="padding-left:15px;padding-right:15px;">
                            
                                <hr />
                                
                                <h4>Educational Attainment</h4>

                                <div class="row">
                                    <div class="col-md-7 mt-sm">
                                        <div class="form-group">
                                            <label for="textWorkPosition">Highest Educational Attainment</label>
                                            <input type="text" class="form-control input-sm" id="" name="textSchool" placeholder="Name of School" style="margin-bottom:5px;">
                                        </div>
                                    </div>
                                    <div class="col-md-5 mt-sm">
                                        <div class="form-group">
                                            <label for="textCourse"></label>
                                            <input type="text" id="textCourse" name="textEducation" class="form-control input-sm" placeholder="Course" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select id="selectEducationalAttainment" name="selectEducation" class="form-control input-sm">
                                            <?php echo dropdown_options('education','',0);?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textEducFrom" name="inputEducFrom" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" placeholder="Start Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textEducTo" name="inputEducTo" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" placeholder="End Date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />
                                
                                <h4>Employment Details</h4>
                                
                                <label for="checkNoEmployment"><input type="checkbox" id="checkNoEmployment" name="checkNoEmployment" style="vertical-align:top"> Fresh graduate or no working experience yet.</label>
                                
                                <div class="form-group">
                                    <label for="textWorkPosition">Work Experience</label>
                                    <input type="text" class="form-control input-sm" id="textWorkPosition" name="textWorkPosition" placeholder="Enter your Latest Position" style="margin-bottom:5px;">
                                    <input type="text" class="form-control input-sm" id="textWorkEmployer" name="textWorkEmployer" placeholder="Enter your Latest Employer" style="margin-bottom:5px;">
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select class="form-control input-sm margin-b-5" id="selectWorkCountry" name="selectWorkCountry">
                                            <?php echo dropdown_options('country', 161);?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textEmployFrom" name="inputEmploymentFrom" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" placeholder="Start Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textEmployTo" name="inputEmploymentTo" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" placeholder="End Date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />
                                
                                <h4>Training and Seminars Attended</h4>
                                
                                <div class="form-group">
                                    <label for="textTitleTraining">Training / Seminar Attended</label>
                                    <input type="text" class="form-control input-sm" id="textTitleTraining" name="textTraining" placeholder="Title Training" style="margin-bottom:5px;">
                                    <input type="text" class="form-control input-sm" id="textTrainingCenter" name="textTrainingCenter" placeholder="Training Center" style="margin-bottom:5px;">
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <select class="form-control input-sm margin-b-5" id="selectTrainingCountry" name="selectTrainingCountry">
                                            <?php echo dropdown_options('country', 161);?>
                                        </select>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textTrainingFrom" name="textTrainingFrom" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" placeholder="Start Date">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textTrainingTo" name="textTrainingTo" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" placeholder="End Date">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />
                                
                                <h4>Skills</h4>
                                
                                <div class="form-group">
                                    <textarea class="form-control input-sm" id="textSkills" name="textSkills"></textarea>
                                </div>
                                
                                <hr />

                                <div class="row">
                                    <div class="col-sm-12">
                                        <!-- <a href="applicant-profile.php" class="btn btn-block btn-primary">Submit</a> -->
                                        <input type="button" value="Submit" class="btn btn-block btn-primary" id="btn_createApplicant">
                                    </div>
                                </div>
                                
                            
                            </div>
                            
                        </div>
                        
                    </form>
                    
                </div>
            </section>
            
        </div>
    </div>
    <!-- end: page -->
</section>
<script>
    var create_error = '<?php echo $create_error;?>';
</script>