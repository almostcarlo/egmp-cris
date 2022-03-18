<?php
    $show_buttons = false;
    if(in_array($current_page, array('profile_page'))){
        $show_buttons = true;
    }
?>
<div class="col-md-12">
    
	<section class="panel">
        <header class="panel-heading">
            <a href="<?php echo BASE_URL;?>applicant/create" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create New Applicant</a>
			<h3 class="panel-title">Applicant Information</h3>
		</header>
		<div class="panel-body">
			
            <div class="row">
                <div class="col-md-2">
                    
                    <div class="thumb-info">
                        <?php if(isset($applicant_data['profile_picture'])):?>
                            <!-- PIC FROM RMS -->
                            <img src="<?php echo BASE_URL."applicant/my_files/".base64_encode($applicant_data['profile_picture']->id);?>" style="width:250px; height:250px; border-radius:50%;" />
                        <?php elseif(isset($applicant_data['profile_picture_web']) && $applicant_data['profile_picture_web']->from_portal == 'Y'):?>
                            <!-- PIC FROM PORTAL -->
                            <img src="<?php echo PORTAL_URL.$applicant_data['profile_picture_web']->filename;?>" style="width:250px; height:250px; border-radius:50%;" />
                    	<?php else:?>
                            <!-- DEFAULT PIC -->
                    		<img src="<?php echo BASE_URL;?>public/images/!logged-user<?php echo ($applicant_data['personal']->gender == 'F')?"-female":""?>.jpg" class="round img-responsive" alt="John Doe">
                    	<?php endif;?>
                        <div class="thumb-info-title">
                            <div class="thumb-info-inner"><?php echo nameformat($applicant_data['personal']->fname, $applicant_data['personal']->mname, $applicant_data['personal']->lname,1);?></div>
                            <!-- <div class="thumb-info-type">Applicant No.: 2019-0001</div> -->
                            <div class="thumb-info-type">Status: <?php echo $applicant_data['personal']->status;?></div>
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-10">
                
                    <form class="form-horizontal">
                        <div class="form-group">
                            <label class="col-sm-2 control-label display">Date Applied:</label>
                            <div class="col-sm-4"><?php echo dateformat($applicant_data['personal']->add_date);?></div>
                            <label class="col-sm-2 control-label display">Last Reported:</label>
                            <div class="col-sm-4"><?php echo dateformat($applicant_data['personal']->last_reporting_date);?></div>
                        </div>
                        <!-- <div class="form-group">
                            <label class="col-sm-2 control-label display">RM:</label>
                            <div class="col-sm-4">RSO/TE Nick Fury</div>
                            <label class="col-sm-2 control-label display">Replacement:</label>
                            <div class="col-sm-4">Agent Coulson</div>
                        </div> -->
                        <div class="form-group">
                            <label class="col-sm-2 control-label display">Birth Date:</label>
                            <div class="col-sm-2"><?php echo dateformat($applicant_data['personal']->birthdate);?></div>
                            <label class="col-sm-2 control-label display">Age:</label>
                            <div class="col-sm-2"><?php echo getAge($applicant_data['personal']->birthdate);?></div>
                            <label class="col-sm-2 control-label display">Gender:</label>
                            <div class="col-sm-2"><?php echo ($applicant_data['personal']->gender=='M')?"Male":"Female";?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label display">Religion:</label>
                            <div class="col-sm-2"><?php echo $applicant_data['personal']->religion;?></div>
                            <label class="col-sm-2 control-label display">Civil Status:</label>
                            <div class="col-sm-2"><?php echo $applicant_data['personal']->civil_stat;?></div>
                            <label class="col-sm-2 control-label display">Nationality:</label>
                            <div class="col-sm-2"><?php echo $applicant_data['personal']->nationality;?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label display">Address:</label>
                            <div class="col-sm-10"><?php echo $applicant_data['personal']->address;?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label display">City / Town:</label>
                            <div class="col-sm-2"><?php echo $applicant_data['personal']->city;?></div>
                            <label class="col-sm-2 control-label display">State / Province:</label>
                            <div class="col-sm-2"><?php echo $applicant_data['personal']->province;?></div>
                            <label class="col-sm-2 control-label display">Country:</label>
                            <div class="col-sm-2">Philippines</div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label display">Mobile No.:</label>
                            <div class="col-sm-2"><?php echo $applicant_data['personal']->mobile_no;?> <?php echo (getMobNetwork($applicant_data['personal']->mobile_no))?"(".getMobNetwork($applicant_data['personal']->mobile_no).")":"";?></div>
                            <!-- <label class="col-sm-2 control-label display">Other No.:</label>
                            <div class="col-sm-2">+63928.280.9951</div> -->
                            <label class="col-sm-2 control-label display">Tel. No.:</label>
                            <div class="col-sm-2"><?php echo $applicant_data['personal']->landline_no;?></div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label display">Email:</label>
                            <div class="col-sm-2"><?php echo $applicant_data['personal']->email;?></div>
                            <label class="col-sm-2 control-label display">Skype:</label>
                            <div class="col-sm-2"><?php echo $applicant_data['personal']->skype;?></div>

                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label display">Method of Application:</label>
                            <div class="col-sm-2"><?php echo $applicant_data['personal']->application_method;?></div>
                            <label class="col-sm-2 control-label display">Source of Application:</label>
                            <div class="col-sm-2"><?php echo $applicant_data['personal']->application_source;?></div>
                            <?php if($applicant_data['personal']->agent_id <> 0):?>
                                <label class="col-sm-2 control-label display">Agent:</label>
                                <div class="col-sm-2"><?php echo nameformat($applicant_data['personal']->agent_fname, $applicant_data['personal']->agent_mname, $applicant_data['personal']->agent_lname,1);?></div>
                            <?php endif;?>
                            <!-- <label class="col-sm-2 control-label display">Agent:</label>
                            <div class="col-sm-2">Agent 13 - Sharon Carter</div>
                            <label class="col-sm-2 control-label display">Agent Mobile:</label>
                            <div class="col-sm-2"></div> -->
                        </div>
                    </form>
                    
                    <?php if($show_buttons):?>
                        <br />
                        
                        <div class="row">
                            <div class="col-md-2">
                            	<?php if(isset($applicant_data['profile_cv'])):?>
                            		<!-- VIEW BUTTON -->
                            		<a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($applicant_data['profile_cv']->id);?>" target="_blank" class="btn btn-block btn-sm btn-info"><i class="fa fa-file-text-o"></i> View Applicant CV <?php echo ($cv_type!='')?"(".$cv_type.")":"";?></a>
                            	<?php else:?>
                            		<!-- UPLOAD BUTTON -->
                            		<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/upload_cv/<?php echo $applicant_data['personal']->id;?>'});" class="btn btn-block btn-sm btn-danger"><i class="fa fa-file-text-o"></i> Upload Applicant CV</a>
                            	<?php endif;?>
                            </div>
                            <?php if(isset($applicant_data['profile_cv'])):?>
                            	<!-- DELETE BUTTON -->
                                <div class="col-md-2">
                                    <button type="button" onclick="delete_record('cv', '<?php echo $applicant_data['profile_cv']->id;?>')" class="btn btn-sm btn-danger" ><i class="fa fa-trash-o"></i> Delete CV</button>
                                </div>
                            <?php endif;?>
                            <div class="col-md-2 <?php echo (!isset($applicant_data['profile_cv']))?"col-md-offset-4":"col-md-offset-2"?>">
                                <a href="<?php echo BASE_URL;?>pqd/default/<?php echo $applicant_data['personal']->id;?>" target="_blank" class="btn btn-sm btn-block btn-success"><i class="fa fa-print"></i> Print PQD</a>
                            </div>
                            <div class="col-md-2">
                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/applicant_adv/<?php echo $applicant_data['personal']->id;?>'});" class="btn btn-block btn-sm btn-primary"><i class="fa fa-comment"></i> Message</a>
                            </div>
                            <div class="col-md-2">
                                <!-- <a href="#modalEditApplicantInfo" rel="facebox" class="btn btn-block btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit Applicant Info</a> -->
                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/personal/<?php echo $applicant_data['personal']->id;?>'});" class="btn btn-block btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit Applicant Info</a>
                            </div>
                        </div>
                    <?php endif;?>
                    
                </div>
            </div>
            
        </div>
    </section>
    
</div>