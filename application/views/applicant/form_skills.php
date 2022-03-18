<?php
    if(isset($skills_info[0])){
        $skills_desc = $skills_info[0]['skills'];
    }else{
        $skills_desc = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Skills</h4>
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

            <?php echo form_open('applicant/save_profile/skills', 'id="frm_skills"');?>
            
            	<input type="hidden" name="hSkillsId" value="<?php echo $record_id;?>">
            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="textTrainings">Description:</label>
                            <textarea rows="10" name="textSkills" id="textSkills" class="form-control input-sm"><?php echo $skills_desc;?></textarea>
                        </div>
                    </div>
                </div>

                
                <hr />

                <div class="row">
                    <div class="col-sm-3">
                        <input type="button" onclick="save_skills();" class="btn btn-block btn-primary" value="Submit">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>