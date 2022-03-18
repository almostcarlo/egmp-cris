<?php
	$applicant_id = $applicant_data['personal']->id;

	if(isset($jap_info[0])){
		$id = $jap_info[0]['id'];
		$residency = $jap_info[0]['residency'];
		$res_remarks = $jap_info[0]['residency_addr'];
		$foot_size = $jap_info[0]['foot_size'];
		$waist_size = $jap_info[0]['waist_size'];
		$uniform_size = $jap_info[0]['uniform_size'];
		$handedness = $jap_info[0]['handedness'];
		$med_allergy = $jap_info[0]['med_allergy'];
		$healthy = $jap_info[0]['healthy'];
		$blood_type = $jap_info[0]['blood_type'];
		$alcohol = $jap_info[0]['alcohol'];
		$smoking = $jap_info[0]['smoking'];
		$sight_left = $jap_info[0]['sight_left'];
		$sight_right = $jap_info[0]['sight_right'];
		$glasses = $jap_info[0]['glasses'];
		$contact_lens = $jap_info[0]['contact_lens'];
		$school_history = explode("|", $jap_info[0]['school_history']);
		$work_ot = $jap_info[0]['work_ot'];
		$work_ot_min = $jap_info[0]['work_ot_min'];
		$work_ot_max = $jap_info[0]['work_ot_max'];
		$work_night = $jap_info[0]['work_night'];
		$work_night_min = $jap_info[0]['work_night_min'];
		$work_night_max = $jap_info[0]['work_night_max'];
		$work_shift = $jap_info[0]['work_shift'];
		$work_shift_min = $jap_info[0]['work_shift_min'];
		$work_shift_max = $jap_info[0]['work_shift_max'];
		$jap_speak = $jap_info[0]['jap_speak'];
		$jap_speak_rating = $jap_info[0]['jap_speak_rating'];
		$jap_understand = $jap_info[0]['jap_understand'];
		$jap_understand_rating = $jap_info[0]['jap_understand_rating'];
		$jap_read = explode("|", $jap_info[0]['jap_read']);
		$jap_read_rating = $jap_info[0]['jap_read_rating'];
		$jap_write = explode("|", $jap_info[0]['jap_write']);
		$jap_write_rating = $jap_info[0]['jap_write_rating'];
		$license_res = explode("|", $jap_info[0]['license_res']);
	}else{
		$id = "";
		$residency = "";
		$res_remarks = "";
		$foot_size = "";
		$waist_size = "";
		$uniform_size = "";
		$handedness = "";
		$med_allergy = "";
		$healthy = "";
		$blood_type = "";
		$alcohol = "";
		$smoking = "";
		$sight_left = "";
		$sight_right = "";
		$glasses = "";
		$contact_lens = "";
		$school_history = array();
		$work_ot = "";
		$work_ot_min = "";
		$work_ot_max = "";
		$work_night = "";
		$work_night_min = "";
		$work_night_max = "";
		$work_shift = "";
		$work_shift_min = "";
		$work_shift_max = "";
		$jap_speak = "";
		$jap_speak_rating = "";
		$jap_understand = "";
		$jap_understand_rating = "";
		$jap_read = array();
		$jap_read_rating = "";
		$jap_write = array();
		$jap_write_rating = "";
		$license_res = array();
	}
?>
<div id="overview" class="tab-pane active">
    <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
        <strong>ERROR!</strong><br>
        <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
    </div>
    
	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
        <strong>SUCCESS!</strong><br>
        <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
    </div>

    <div class="row">
        <div class="col-md-6">
        
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Resume</h2>
                </header>
                <div class="panel-body">
                	<?php echo form_open('applicant/save_profile/jap_resume', 'id="frm_jap_resume"');?>

                		<input type="hidden" name="textRecordId" value="<?php echo $id;?>">
                		<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">

		                <div class="row">
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Desired Res:</label>
		                            <select id="selectRes" name="selectRes" class="form-control input-sm">
		                                <option value="Alone" <?php echo ($residency=='Alone')?"selected=\"selected\"":"";?>>Alone</option>
		                                <option value="Shared Room" <?php echo ($residency=='Shared Room')?"selected=\"selected\"":"";?>>Shared Room</option>
		                            </select>
		                        </div>
		                    </div>
							<div class="col-md-8 mt-sm">
							    <div class="form-group">
							        <label for="">Remarks:</label>
							        <textarea name="textResRemarks" class="form-control input-sm"><?php echo $res_remarks;?></textarea>
							    </div>
							</div>
		                </div>

		                <div class="row">
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">Foot Size (cm):</label>
		                            <input type="text" class="form-control input-sm" id="textFoot" name="textFoot" placeholder="" value="<?php echo $foot_size;?>">
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">Waist Size (cm):</label>
		                            <input type="text" class="form-control input-sm" id="textWaist" name="textWaist" placeholder="" value="<?php echo $waist_size;?>">
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">Uniform Size:</label>
		                            <select id="selectUniform" name="selectUniform" class="form-control input-sm">
		                                <option value="S" <?php echo ($uniform_size=='S')?"selected=\"selected\"":"";?>>Small</option>
		                                <option value="M" <?php echo ($uniform_size=='M')?"selected=\"selected\"":"";?>>Medium</option>
		                                <option value="L" <?php echo ($uniform_size=='L')?"selected=\"selected\"":"";?>>Large</option>
		                                <option value="LL" <?php echo ($uniform_size=='LL')?"selected=\"selected\"":"";?>>LL</option>
		                                <option value="3L" <?php echo ($uniform_size=='3L')?"selected=\"selected\"":"";?>>3L</option>
		                                <option value="4L" <?php echo ($uniform_size=='4L')?"selected=\"selected\"":"";?>>4L</option>
		                                <option value="5L" <?php echo ($uniform_size=='5L')?"selected=\"selected\"":"";?>>5L</option>
		                            </select>
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">Handedness:</label>
		                            <select id="selectHand" name="selectHand" class="form-control input-sm">
		                                <option value="R" <?php echo ($handedness=='R')?"selected=\"selected\"":"";?>>Right Handed</option>
		                                <option value="L" <?php echo ($handedness=='L')?"selected=\"selected\"":"";?>>Left Handed</option>
		                            </select>
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-6 mt-sm">
		                        <div class="form-group">
		                            <label for="">Have ever a Bad Sick or Allergy by Medicine?:</label>
		                            <select id="selectMedAllergy" name="selectMedAllergy" class="form-control input-sm">
		                            	<option value="N" <?php echo ($med_allergy=='N')?"selected=\"selected\"":"";?>>No</option>
		                                <option value="Y" <?php echo ($med_allergy=='Y')?"selected=\"selected\"":"";?>>Yes</option>
		                            </select>
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">Healthy:</label>
		                            <select id="selectHealthy" name="selectHealthy" class="form-control input-sm">
		                                <option value="Y" <?php echo ($healthy=='Y')?"selected=\"selected\"":"";?>>Yes</option>
		                                <option value="N" <?php echo ($healthy=='N')?"selected=\"selected\"":"";?>>No</option>
		                            </select>
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">Blood Type:</label>
		                            <select id="selectBlood" name="selectBlood" class="form-control input-sm">
		                            	<option value="">please select</option>
		                                <option value="A" <?php echo ($blood_type=='A')?"selected=\"selected\"":"";?>>A</option>
		                                <option value="B" <?php echo ($blood_type=='B')?"selected=\"selected\"":"";?>>B</option>
		                                <option value="AB" <?php echo ($blood_type=='AB')?"selected=\"selected\"":"";?>>AB</option>
		                                <option value="O" <?php echo ($blood_type=='O')?"selected=\"selected\"":"";?>>O</option>
		                            </select>
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Drinking Alcohol?:</label>
		                            <select id="selectAlcohol" name="selectAlcohol" class="form-control input-sm">
		                            	<option value="N" <?php echo ($alcohol=='N')?"selected=\"selected\"":"";?>>No</option>
		                                <option value="Y" <?php echo ($alcohol=='Y')?"selected=\"selected\"":"";?>>Yes</option>
		                            </select>
		                        </div>
		                    </div>
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Smoking?:</label>
		                            <select id="selectSmoking" name="selectSmoking" class="form-control input-sm">
		                            	<option value="N" <?php echo ($smoking=='N')?"selected=\"selected\"":"";?>>No</option>
		                                <option value="Y" <?php echo ($smoking=='Y')?"selected=\"selected\"":"";?>>Yes</option>
		                            </select>
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">Sight (Left):</label>
		                            <input type="text" class="form-control input-sm" id="textSightLeft" name="textSightLeft" value="<?php echo $sight_left;?>">
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">Sight (Right):</label>
		                            <input type="text" class="form-control input-sm" id="textSightRight" name="textSightRight" value="<?php echo $sight_right;?>">
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">Glasses:</label>
		                            <select id="selectGlasses" name="selectGlasses" class="form-control input-sm">
		                            	<option value="N" <?php echo ($glasses=='N')?"selected=\"selected\"":"";?>>No</option>
		                                <option value="Y" <?php echo ($glasses=='Y')?"selected=\"selected\"":"";?>>Yes</option>
		                            </select>
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">Contact Lens:</label>
		                            <select id="selectLens" name="selectLens" class="form-control input-sm">
		                            	<option value="N" <?php echo ($contact_lens=='N')?"selected=\"selected\"":"";?>>No</option>
		                                <option value="Y" <?php echo ($contact_lens=='Y')?"selected=\"selected\"":"";?>>Yes</option>
		                            </select>
		                        </div>
		                    </div>
		                </div>

		                <hr />

		                <div class="row">
		                    <div class="col-sm-12">
		                        <input type="button" onclick="jap_profile('resume', '#frm_jap_resume');" class="btn btn-block btn-primary" value="Submit">
		                    </div>
		                </div>

                	</form>
                </div>
            </section>        
        </div>

        <div class="col-md-6">
        
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">School History</h2>
                </header>
                <div class="panel-body">
                	<?php echo form_open('applicant/save_profile/jap_school', 'id="frm_jap_school"');?>
                		<input type="hidden" name="textRecordId" value="<?php echo $id;?>">
                		<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">
		                <div class="row">
		                    <div class="col-md-6 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkSchool[]" style="vertical-align:top" value="Elementary" <?php echo (in_array("Elementary", $school_history)?"checked=\"checked\"":"")?> /> Elementary
		                            </label>
		                        </div>
		                    </div>
		                    <div class="col-md-6 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkSchool[]" style="vertical-align:top" value="Highschool" <?php echo (in_array("Highschool", $school_history)?"checked=\"checked\"":"")?> /> Highschool
		                            </label>
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-6 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkSchool[]" style="vertical-align:top" value="College" <?php echo (in_array("College", $school_history)?"checked=\"checked\"":"")?> /> College
		                            </label>
		                        </div>
		                    </div>
		                    <div class="col-md-6 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkSchool[]" style="vertical-align:top" value="University" <?php echo (in_array("University", $school_history)?"checked=\"checked\"":"")?> /> University
		                            </label>
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-6 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkSchool[]" style="vertical-align:top" value="Not Graduate" <?php echo (in_array("Not Graduate", $school_history)?"checked=\"checked\"":"")?> /> Not Graduate
		                            </label>
		                        </div>
		                    </div>
		                    <div class="col-md-6 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkSchool[]" style="vertical-align:top" value="Graduate" <?php echo (in_array("Graduate", $school_history)?"checked=\"checked\"":"")?> /> Graduate
		                            </label>
		                        </div>
		                    </div>
		                </div>

		                <hr />

		                <div class="row">
		                    <div class="col-sm-12">
		                        <input type="button" onclick="jap_profile('school_history', '#frm_jap_school');" class="btn btn-block btn-primary" value="Submit">
		                    </div>
		                </div>
		            </form>
                </div>
            </section>

            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Can you Work Overtime or NightShift?</h2>
                </header>
                <div class="panel-body">
                	<?php echo form_open('applicant/save_profile/jap_ot', 'id="frm_jap_ot"');?>
                		<input type="hidden" name="textRecordId" value="<?php echo $id;?>">
                		<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">
		                <div class="row">
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Overtime:</label>
		                            <select id="selectOT" name="selectOT" class="form-control input-sm">
		                            	<option value="N" <?php echo ($work_ot=='N')?"selected=\"selected\"":"";?>>Cannot</option>
		                                <option value="Y" <?php echo ($work_ot=='Y')?"selected=\"selected\"":"";?>>Can</option>
		                            </select>
		                        </div>
		                    </div>
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Min Hours:</label>
		                            <input type="text" class="form-control input-sm" id="textOTMin" name="textOTMin" value="<?php echo $work_ot_min;?>">
		                        </div>
		                    </div>
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Max Hours:</label>
		                            <input type="text" class="form-control input-sm" id="textOTMax" name="textOTMax" value="<?php echo $work_ot_max;?>">
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Night Shift:</label>
		                            <select id="selectNight" name="selectNight" class="form-control input-sm">
		                            	<option value="N" <?php echo ($work_night=='N')?"selected=\"selected\"":"";?>>Cannot</option>
		                                <option value="Y" <?php echo ($work_night=='Y')?"selected=\"selected\"":"";?>>Can</option>
		                            </select>
		                        </div>
		                    </div>
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Min Hours:</label>
		                            <input type="text" class="form-control input-sm" id="textNightMin" name="textNightMin" value="<?php echo $work_night_min;?>">
		                        </div>
		                    </div>
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Max Hours:</label>
		                            <input type="text" class="form-control input-sm" id="textNightMax" name="textNightMax" value="<?php echo $work_night_max;?>">
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Shift:</label>
		                            <select id="selectShift" name="selectShift" class="form-control input-sm">
		                            	<option value="N" <?php echo ($work_shift=='N')?"selected=\"selected\"":"";?>>Cannot</option>
		                                <option value="Y" <?php echo ($work_shift=='Y')?"selected=\"selected\"":"";?>>Can</option>
		                            </select>
		                        </div>
		                    </div>
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Min Hours:</label>
		                            <input type="text" class="form-control input-sm" id="textShiftMin" name="textShiftMin" value="<?php echo $work_shift_min;?>">
		                        </div>
		                    </div>
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Max Hours:</label>
		                            <input type="text" class="form-control input-sm" id="textShiftMax" name="textShiftMax" value="<?php echo $work_shift_max;?>">
		                        </div>
		                    </div>
		                </div>

		                <hr />

		                <div class="row">
		                    <div class="col-sm-12">
		                        <input type="button" onclick="jap_profile('overtime', '#frm_jap_ot');" class="btn btn-block btn-primary" value="Submit">
		                    </div>
		                </div>
		            </form>
                </div>
            </section>
        
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
        
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Average of speaking japanese language</h2>
                </header>
                <div class="panel-body">
                	<?php echo form_open('applicant/save_profile/jap_speak', 'id="frm_jap_language"');?>
                		<input type="hidden" name="textRecordId" value="<?php echo $id;?>">
                		<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">
		                <div class="row">
		                    <div class="col-md-8 mt-sm">
		                        <div class="form-group">
		                            <label for="">Speak:</label>
		                            <select id="selectSpeak" name="selectSpeak" class="form-control input-sm">
		                            	<option value="Good" <?php echo ($jap_speak=='Good')?"selected=\"selected\"":"";?>>Good</option>
		                                <option value="Normal" <?php echo ($jap_speak=='Normal')?"selected=\"selected\"":"";?>>Normal</option>
		                                <option value="Slight" <?php echo ($jap_speak=='Slight')?"selected=\"selected\"":"";?>>Slight</option>
		                                <option value="Cannot" <?php echo ($jap_speak=='Cannot')?"selected=\"selected\"":"";?>>Cannot</option>
		                            </select>
		                        </div>
		                    </div>
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Understand (%):</label>
		                            <input type="text" class="form-control input-sm" id="textSpeakRate" name="textSpeakRate" value="<?php echo $jap_speak_rating;?>">
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-8 mt-sm">
		                        <div class="form-group">
		                            <label for="">Understand:</label>
		                            <select id="selectUnderstand" name="selectUnderstand" class="form-control input-sm">
		                            	<option value="Good" <?php echo ($jap_understand=='Good')?"selected=\"selected\"":"";?>>Good</option>
		                                <option value="Normal" <?php echo ($jap_understand=='Normal')?"selected=\"selected\"":"";?>>Normal</option>
		                                <option value="Slight" <?php echo ($jap_understand=='Slight')?"selected=\"selected\"":"";?>>Slight</option>
		                                <option value="Cannot" <?php echo ($jap_understand=='Cannot')?"selected=\"selected\"":"";?>>Cannot</option>
		                            </select>
		                        </div>
		                    </div>
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Understand (%):</label>
		                            <input type="text" class="form-control input-sm" id="textUnderstandRate" name="textUnderstandRate" value="<?php echo $jap_understand_rating;?>">
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-8 mt-sm">
		                        <div class="form-group">
		                            <label for="">Reading:</label>
		                            <br>
		                            <input type="checkbox" id="" name="checkRead[]" value="Katakana" style="vertical-align:top" <?php echo (in_array("Katakana", $jap_read)?"checked=\"checked\"":"")?> /> Katakana
		                            &nbsp;&nbsp;&nbsp;
		                            <input type="checkbox" id="" name="checkRead[]" value="Hiragana" style="vertical-align:top" <?php echo (in_array("Hiragana", $jap_read)?"checked=\"checked\"":"")?> /> Hiragana
		                            &nbsp;&nbsp;&nbsp;
		                            <input type="checkbox" id="" name="checkRead[]" value="Kanji" style="vertical-align:top" <?php echo (in_array("Kanji", $jap_read)?"checked=\"checked\"":"")?> /> Kanji
		                        </div>
		                    </div>
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Understand (%):</label>
		                            <input type="text" class="form-control input-sm" id="textReadRate" name="textReadRate" value="<?php echo $jap_read_rating;?>">
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-8 mt-sm">
		                        <div class="form-group">
		                            <label for="">Writing:</label>
		                            <br>
		                            <input type="checkbox" id="" name="checkWrite[]" value="Katakana" style="vertical-align:top" <?php echo (in_array("Katakana", $jap_write)?"checked=\"checked\"":"")?> /> Katakana
		                            &nbsp;&nbsp;&nbsp;
		                            <input type="checkbox" id="" name="checkWrite[]" value="Hiragana" style="vertical-align:top" <?php echo (in_array("Hiragana", $jap_write)?"checked=\"checked\"":"")?> /> Hiragana
		                            &nbsp;&nbsp;&nbsp;
		                            <input type="checkbox" id="" name="checkWrite[]" value="Kanji" style="vertical-align:top" <?php echo (in_array("Kanji", $jap_write)?"checked=\"checked\"":"")?> /> Kanji
		                        </div>
		                    </div>
		                    <div class="col-md-4 mt-sm">
		                        <div class="form-group">
		                            <label for="">Understand (%):</label>
		                            <input type="text" class="form-control input-sm" id="textWriteRate" name="textWriteRate" value="<?php echo $jap_write_rating;?>">
		                        </div>
		                    </div>
		                </div>

		                <hr />

		                <div class="row">
		                    <div class="col-sm-12">
		                        <input type="button" onclick="jap_profile('language', '#frm_jap_language');" class="btn btn-block btn-primary" value="Submit">
		                    </div>
		                </div>
		            </form>
                </div>
            </section>
        
        </div>
        <div class="col-md-6">
        
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Driver`s Liscense Information</h2>
                </header>
                <div class="panel-body">
                	<?php echo form_open('applicant/save_profile/jap_school', 'id="frm_jap_license"');?>
                		<input type="hidden" name="textRecordId" value="<?php echo $id;?>">
                		<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">
		                <div class="row">
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkLic[]" style="vertical-align:top" value="None" <?php echo (in_array("None", $license_res)?"checked=\"checked\"":"")?> /> None
		                            </label>
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkLic[]" style="vertical-align:top" value="(AT/MT)" <?php echo (in_array("(AT/MT)", $license_res)?"checked=\"checked\"":"")?> /> (AT/MT)
		                            </label>
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkLic[]" style="vertical-align:top" value="Chugata" <?php echo (in_array("Chugata", $license_res)?"checked=\"checked\"":"")?> /> Chugata
		                            </label>
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkLic[]" style="vertical-align:top" value="Ogata" <?php echo (in_array("Ogata", $license_res)?"checked=\"checked\"":"")?> /> Ogata
		                            </label>
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkLic[]" style="vertical-align:top" value="Motor" <?php echo (in_array("Motor", $license_res)?"checked=\"checked\"":"")?> /> Motor
		                            </label>
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkLic[]" style="vertical-align:top" value="50cc Motor" <?php echo (in_array("50cc Motor", $license_res)?"checked=\"checked\"":"")?> /> 50cc Motor
		                            </label>
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkLic[]" style="vertical-align:top" value="Forklift" <?php echo (in_array("Forklift", $license_res)?"checked=\"checked\"":"")?> /> Forklift
		                            </label>
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkLic[]" style="vertical-align:top" value="Bicicleta" <?php echo (in_array("Bicicleta", $license_res)?"checked=\"checked\"":"")?> /> Bicicleta
		                            </label>
		                        </div>
		                    </div>
		                </div>

		                <div class="row">
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkLic[]" style="vertical-align:top" value="Can" <?php echo (in_array("Can", $license_res)?"checked=\"checked\"":"")?> /> Can
		                            </label>
		                        </div>
		                    </div>
		                    <div class="col-md-3 mt-sm">
		                        <div class="form-group">
		                            <label for="">
		                                <input type="checkbox" id="" name="checkLic[]" style="vertical-align:top" value="Cannot" <?php echo (in_array("Cannot", $license_res)?"checked=\"checked\"":"")?> /> Cannot
		                            </label>
		                        </div>
		                    </div>
		                </div>

		                <hr />

		                <div class="row">
		                    <div class="col-sm-12">
		                        <input type="button" onclick="jap_profile('license', '#frm_jap_license');" class="btn btn-block btn-primary" value="Submit">
		                    </div>
		                </div>
		            </form>
                </div>
            </section>
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-12">
        
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/jap_relative/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> add relatives</a>
                    <h2 class="panel-title">Member Of Family/Relatives in Japan</h2>
                </header>
                <div class="panel-body">

		            <table class="table table-striped table-condensed table-hover">
		                <thead>
		                    <tr>
		                        <th width="18%">Name</th>
		                        <th width="10%">Relation</th>
		                        <th class="text-center" width="10%">Age</th>
		                        <th class="text-center" width="10%">Occupation</th>
		                        <th class="text-left" width="25%">Address</th>
		                        <th class="text-left" width="25%">Remarks</th>
		                        <th class="text-center" width="2%">Action</th>
		                    </tr>
		                </thead>
		                <tbody>
		                    <?php if(isset($relatives) && count($relatives) > 0):?>
		                    	<?php foreach ($relatives as $r_info):?>
	                                <tr>
	                                    <td><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/jap_relative/<?php echo $applicant_id;?>/<?php echo $r_info['id'];?>'});"><?php echo $r_info['name'];?></a></td>
	                                    <td><?php echo $r_info['relationship']?></td>
	                                    <td class="text-center"><?php echo $r_info['age'];?></td>
	                                    <td class="text-center"><?php echo $r_info['occupation'];?></td>
	                                    <td class="text-left"><?php echo $r_info['address'];?></td>
	                                    <td class="text-left"><?php echo $r_info['remarks'];?></td>
	                                    <td class="text-center">
	                                    	<!-- EDIT -->
	                                    	<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/jap_relative/<?php echo $applicant_id;?>/<?php echo $r_info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="edit" data-original-title="Edit"><i class="fa fa-pencil"></i></a>

	                                    	<!-- DELETE -->
	                                    	<a href="javascript:void(0);" onclick="delete_record('jap_relative', '<?php echo $r_info['id'];?>')" data-toggle="tooltip"  data-placement="top" title="delete Lineup" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
	                                    </td>
	                                </tr>
		                    	<?php endforeach;?>
		                    <?php else:?>
		                        <tr>
		                            <td colspan="10">
		                                <small class="required">no record found.</small>
		                            </td>
		                        </tr>
		                    <?php endif;?>
		                </tbody>
		            </table>

                </div>
            </section>
        
        </div>
    </div>

</div>