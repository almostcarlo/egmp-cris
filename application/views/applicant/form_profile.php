<div id="" class="">
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Applicant Info</h4>
                </div>
            </div>
            
            <div id="frm_profileErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                <strong>ERROR!</strong><br>
                <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
        	<div id="frm_profileSuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                <strong>SUCCESS!</strong><br>
                <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
            </div>
            
            <?php echo form_open_multipart('applicant/save_profile/personal', 'id="frm_profile"');?>
            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_data['personal']->id?>"/>

                <div class="row">
                    <div class="col-md-8 mt-sm">
                        <div class="form-group">
                            <label for="fileProfilePhoto">Profile Photo:</label>
                            <input type="file" class="form-control input-sm" id="fileUploadPhoto" name="fileImage">
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <!-- <button class="btn btn-block btn-default">Upload</button> -->
                            <input type="button" onclick="save_profile_pix();" class="btn btn-block btn-primary btn-sm" value="Upload">
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textFname">Firstname:</label>
                            <input type="text" id="textFname" name="textFirstName" class="form-control input-sm" value="<?php echo $applicant_data['personal']->fname;?>" />
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textFname">Middlename:</label>
                            <input type="text" id="textMname" name="textMiddleName" class="form-control input-sm" value="<?php echo $applicant_data['personal']->mname;?>" />
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textFname">Lastname:</label>
                            <input type="text" id="textLname" name="textLastName" class="form-control input-sm" value="<?php echo $applicant_data['personal']->lname;?>" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textDateOfBirth">Date of Birth:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="inputBirthDate" name="inputBirthDate" type="text" value="<?php echo dateformat($applicant_data['personal']->birthdate,2);?>" autocomplete="off" data-plugin-datepicker class="form-control input-sm">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textAge">Age:</label>
                            <input type="text" id="textAge" class="form-control input-sm" readonly="readonly" value="<?php echo getAge($applicant_data['personal']->birthdate);?>" />
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textGender">Gender:</label>
                            <select id="selectGender" name="selectGender" class="form-control input-sm">
                                <option value="M" <?php echo ($applicant_data['personal']->gender=='M')?"selected":""?>>Male</option>
                                <option value="F" <?php echo ($applicant_data['personal']->gender=='F')?"selected":""?>>Female</option>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textHeight">Height:</label>
                            <input type="text" id="textHeight" name="textHeight" class="form-control input-sm" value="<?php echo $applicant_data['personal']->height;?>" />
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textWeight">Weight</label>
                            <input type="text" id="textWeight" name="textWeight" class="form-control input-sm" value="<?php echo $applicant_data['personal']->weight;?>" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textReligion">Religion:</label>
                            <select id="selectReligion" name="selectReligion" class="form-control input-sm">
                                <option value="Muslim" <?php echo ($applicant_data['personal']->religion=='Muslim')?"selected":""?>>Muslim</option>
                                <option value="Non-Muslim" <?php echo ($applicant_data['personal']->religion=='Non-Muslim')?"selected":""?>>Non-Muslim</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textCivilStatus">Civil Status:</label>
                            <select id="selectCivilStatus" name="selectCivilStatus" class="form-control input-sm">
                                <option value="Single" <?php echo ($applicant_data['personal']->civil_stat=='Single')?"selected":""?>>Single</option>
                                <option value="Married" <?php echo ($applicant_data['personal']->civil_stat=='Married')?"selected":""?>>Married</option>
                                <option value="Separated" <?php echo ($applicant_data['personal']->civil_stat=='Separated')?"selected":""?>>Separated</option>
                                <option value="Widowed" <?php echo ($applicant_data['personal']->civil_stat=='Widowed')?"selected":""?>>Widowed</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="selectNationality">Nationality:</label>
                            <select id="selectNationality" name="selectNationality" class="form-control input-sm">
                            	<?php echo dropdown_options('nationality', $applicant_data['personal']->nationality_id)?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="textAddress">House/Bldg./Apt. No. / Street:</label>
                            <input type="text" id="textStreet" name="textStreet" value="<?php echo $applicant_data['personal']->address?>" class="form-control input-sm" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-7 mt-sm">
                        <div class="form-group">
                            <label for="">Region:</label>
                            <select id="selectRegion" name="selectRegion" class="form-control input-sm">
                                <?php echo dropdown_options('region', $applicant_data['personal']->address_region_id);?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-5 mt-sm">
                        <div class="form-group">
                            <label for="selectProvince">Province:</label>
                            <select id="selectProvince" name="selectProvince" class="form-control input-sm">
                                <?php echo dropdown_options('province', $applicant_data['personal']->address_province_id);?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-5 mt-sm">
                        <div class="form-group">
                            <label for="textCity">City / Municipality:</label>
                            <select id="selectCity" name="selectCity" class="form-control input-sm">
                                <?php echo dropdown_options('city', $applicant_data['personal']->address_city_id, '1', $applicant_data['personal']->address_province_id)?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-7 mt-sm">
                        <div class="form-group" id="divCity">
                            <label for="">Baranggay</label>
                            <select id="selectBrgy" name="selectBrgy" class="form-control input-sm">
                                <?php echo dropdown_options('brgy', $applicant_data['personal']->address_brgy_id, '1', $applicant_data['personal']->address_city_id)?>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- <div class="row">

                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="selectCountry">Country:</label>
                            <select id="selectCountry" name="selectCountry" class="form-control input-sm">
                                <?php echo dropdown_options('country', 174)?>
                            </select>
                        </div>
                    </div>
                </div> -->

                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textMobileNum">Mobile No.:</label>
                            <input type="text" id="textContactNumber" name="textContactNumber" value="<?php echo $applicant_data['personal']->mobile_no;?>" class="form-control input-sm" />
                        </div>
                    </div>
                    <!-- <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textOtherNum">Other No.:</label>
                            <input type="text" id="textOtherNum" class="form-control input-sm" />
                        </div>
                    </div> -->
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textTelNum">Tel. No.:</label>
                            <input type="text" id="textTelNum" name="textTelNum" value="<?php echo $applicant_data['personal']->landline_no;?>" class="form-control input-sm" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textEmail">Email:</label>
                            <input type="text" id="textEmail" name="textEmail" value="<?php echo $applicant_data['personal']->email;?>" readonly="readonly" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textSkype">Skype ID:</label>
                            <input type="text" id="textSkype" name="textSkype" value="<?php echo $applicant_data['personal']->skype;?>" class="form-control input-sm" />
                        </div>
                    </div>
                    <!-- <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textMethod">Method of Application:</label>
                            <input type="text" id="textMethod" class="form-control input-sm" />
                        </div>
                    </div> -->
                </div>

                <div class="row">

                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textMethod">Method of Application:</label>
                            <select id="selectMethod" name="selectMethod" class="form-control input-sm">
                                <?php echo dropdown_options('method', $applicant_data['personal']->application_method_id)?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="selectSource">Source of Application:</label>
                            <select id="selectSource" name="selectSource" class="form-control input-sm">
                                <?php echo dropdown_options('source', $applicant_data['personal']->application_source_id)?>
                            </select>
                        </div>
                    </div>

                    <div id="div_agent" class="col-md-4 mt-sm <?php echo ($applicant_data['personal']->agent_id <> 0)?"":"hidden";?>">
                        <div class="form-group">
                            <label for="selectAgent">Agent:</label>
                            <select id="selectAgent" name="selectAgent" class="form-control input-sm">
                                <?php echo dropdown_options('agent', $applicant_data['personal']->agent_id)?>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textSkype">Agent:</label>
                            <input type="text" id="textSkype" class="form-control input-sm" />
                        </div>
                    </div> -->
                    <!-- <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="textAgentMobile">Agent Mobile:</label>
                            <input type="text" id="textAgentMobile" class="form-control input-sm" />
                        </div>
                    </div> -->
                </div>

                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="selectBranch">Applied Branch</label>
                            <select id="selectBranch" name="selectBranch" class="form-control input-sm">\
                                <?php echo dropdown_options('branch', $applicant_data['personal']->branch_id);?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label for="selectBranchN">Nearest Branch</label>
                            <select id="selectBranchN" name="selectBranchN" class="form-control input-sm">\
                                <?php echo dropdown_options('branch', $applicant_data['personal']->near_branch_id);?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <hr />

                <div class="row">
                    <div class="col-sm-4">
                        <input type="button" onclick="save_profile();" class="btn btn-block btn-primary" value="Submit">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>