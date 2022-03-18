<div class="col-md-12">
    <div id="frm_photoshootErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
        <strong>ERROR!</strong><br>
        <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
    </div>
    
    <div id="frm_photoshootSuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
        <strong>SUCCESS!</strong><br>
        <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
    </div>
</div>

<div class="col-md-5">
    <div class="thumb-info">
        <?php if(isset($applicant_data['profile_picture_web'])):?>
        	<img src="<?php echo WEBSITE_URL.$applicant_data['profile_picture_web']->filename;?>" style="width:250px; height:250px; border-radius:50%;" />
    	<?php elseif(isset($applicant_data['profile_picture'])):?>
			<!-- <img src="<?php echo BASE_URL."applicant/my_files/".base64_encode($applicant_data['profile_picture']->id);?>" class="round img-responsive" alt="Profile Picture">-->
			<img src="<?php echo BASE_URL."applicant/my_files/".base64_encode($applicant_data['profile_picture']->id);?>" style="width:250px; height:250px; border-radius:50%;" />
    	<?php else:?>
    		<img src="<?php echo BASE_URL;?>public/images/!logged-user<?php echo ($applicant_data['personal']->gender == 'F')?"-female":""?>.jpg" class="round img-responsive" alt="John Doe">
    	<?php endif;?>
    </div>
</div>

<div class="col-md-7">
    <?php echo form_open_multipart('reception/save', 'id="frm_photoshoot" class="form-horizontal"');?>
    	<input type="hidden" name="textApplicant_id" id="textApplicant_id" value="<?php echo $applicant_data['personal']->id;?>">
    	<input type="hidden" name="selectDocType" value="iprs picture">
    	
        <div class="form-group">
            <label class="col-sm-5 control-label display">Applicant No.:</label>
            <div class="col-sm-7"><?php echo $applicant_data['personal']->id;?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label display">Name:</label>
            <div class="col-sm-7"><?php echo strtoupper(nameformat($applicant_data['personal']->fname, $applicant_data['personal']->mname, $applicant_data['personal']->lname,1));?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label display">Status:</label>
            <div class="col-sm-7"><?php echo $applicant_data['personal']->status;?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label display">Date Applied:</label>
            <div class="col-sm-7"><?php echo dateformat($applicant_data['personal']->add_date);?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label display">Source of Application:</label>
            <div class="col-sm-7"><?php echo $applicant_data['personal']->application_source;?></div>
        </div>
        <div class="form-group">
            <label class="col-sm-5 control-label display">Method of Application:</label>
            <div class="col-sm-7"><?php echo $applicant_data['personal']->application_method;?></div>
        </div>
        <div class="form-group">
            <div class="col-sm-7"><input type="file" class="form-control input-sm" id="fileUploadPhoto" name="fileImage"></div>
            <div class="col-sm-4"><input type="button" onclick="save_profile_pix();" class="btn btn-block btn-primary btn-sm" value="Upload"></div>
        </div>
    </form>
</div>