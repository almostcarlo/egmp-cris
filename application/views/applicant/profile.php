<?php
    // var_dump(PORTAL_URL.$applicant_data['profile_picture_web']->filename);
    // exit();
?>
<section role="main" class="content-body">
                  
	<header class="page-header">
		<h2>Applicant Profile</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-12">
            <?php flashNotification();?>
			<section class="panel">
                <header class="panel-heading">
                    <!-- CREATE -->
                    <a href="<?php echo BASE_URL;?>applicant/create" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create New Applicant</a>

                    <!-- SEARCH -->
                    <a href="<?php echo BASE_URL;?>applicant" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px; margin-right: 5px;"><i class="fa fa-search"></i> Search Applicant</a>

                    <!-- NEW MESSAGE -->
                    <?php if($new_sms[0]['total'] > 0):?>
                        <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/applicant_adv_all/<?php echo $applicant_data['personal']->id;?>'}); $(this).addClass('hidden');" class="btn btn-danger btn-sm pull-right" style="margin-top:-5px;margin-right: 5px;"><i class="fa fa-envelope-o"></i> <?php echo $new_sms[0]['total'];?> New Message Recieved</a>
                    <?php endif;?>

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
                                    <div class="col-sm-6"><?php echo dateformat($applicant_data['personal']->add_date);?></div>
                                    <label class="col-sm-2 control-label display">Last Reported:</label>
                                    <div class="col-sm-2"><?php echo dateformat($applicant_data['personal']->last_reporting_date);?></div>
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
                                    <div class="col-sm-2">

                                        <span <?php echo ($applicant_data['personal']->sms_token<>'')?"style=\"color:green;\"":"";?>>
                                            <?php if($applicant_data['personal']->sms_token<>''):?>
                                                <i class="fa fa-check-circle"></i>
                                            <?php endif;?>
                                            <?php echo $applicant_data['personal']->mobile_no;?> <?php echo (getMobNetwork($applicant_data['personal']->mobile_no))?"(".getMobNetwork($applicant_data['personal']->mobile_no).")":"";?>
                                            
                                        </span>
                                    </div>
                                    <!-- <label class="col-sm-2 control-label display">Other No.:</label>
                                    <div class="col-sm-2">+63928.280.9951</div> -->
                                    <label class="col-sm-2 control-label display">Tel. No.:</label>
                                    <div class="col-sm-2"><?php echo $applicant_data['personal']->landline_no;?></div>
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label display">Email:</label>
                                    <div class="col-sm-2">
                                        <span style="color: <?php echo ($applicant_data['personal']->is_valid_email=='N')?"red":"green";?>;">
                                            <?php if($applicant_data['personal']->is_valid_email<>'N'):?>
                                                <i class="fa fa-check-circle"></i>
                                            <?php endif;?>
                                            <?php echo $applicant_data['personal']->email;?>
                                        </span>
                                    </div>
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
                                </div>
                                <div class="form-group">
                                    <label class="col-sm-2 control-label display">Applied Branch:</label>
                                    <div class="col-sm-2"><?php echo ($applicant_data['personal']->branch_id<>'' && isset($branch_list[$applicant_data['personal']->branch_id]))?$branch_list[$applicant_data['personal']->branch_id]:"";?></div>
                                    <?php if($applicant_data['personal']->near_branch_id <> 0):?>
                                        <label class="col-sm-2 control-label display">Nearest Branch:</label>
                                        <div class="col-sm-2"><?php echo $branch_list[$applicant_data['personal']->near_branch_id];?></div>
                                    <?php endif;?>
                                </div>
                            </form>
                            
                            <br />
                            
                            <div class="row">
                                <?php if(count($applicant_data['jap_profile']) <= 0):?>
                                    <div class="col-md-2">
                                        &nbsp;
                                    </div>
                                <?php endif;?>
                                <div class="col-md-2">
                                	<?php if(isset($applicant_data['profile_cv']) && $applicant_data['profile_cv']->filename <> ''):?>
                                		<!-- VIEW BUTTON -->
                                		<a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($applicant_data['profile_cv']->id);?>" target="_blank" class="btn btn-block btn-sm btn-info"><i class="fa fa-file-text-o"></i> View Applicant CV <?php echo ($cv_type!='')?"(".$cv_type.")":"";?></a>
                                	<?php else:?>
                                		<!-- UPLOAD BUTTON -->
                                		<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/upload_cv/<?php echo $applicant_data['personal']->id;?>'});" class="btn btn-block btn-sm btn-danger"><i class="fa fa-file-text-o"></i> Upload Applicant CV</a>
                                	<?php endif;?>
                                </div>
                                
                                <?php /*if(isset($applicant_data['profile_cv']) && $applicant_data['profile_cv']->filename <> ''):?>
                                	<!-- DELETE CV -->
                                    <div class="col-md-2">
                                        <button type="button" onclick="delete_record('cv', '<?php echo $applicant_data['profile_cv']->id;?>')" class="btn btn-sm btn-danger" ><i class="fa fa-trash-o"></i> Delete CV</button>
                                    </div>
                                <?php endif;*/?>

                                <!-- PQD -->
                                <div class="col-md-2">
                                    <a href="<?php echo BASE_URL;?>pqd/default/<?php echo $applicant_data['personal']->id;?>" target="_blank" class="btn btn-sm btn-block btn-success"><i class="fa fa-print"></i> Print PQD</a>
                                </div>

                                <!-- JAPANESE PQD -->
                                <?php if(count($applicant_data['jap_profile']) > 0):?>
                                    <div class="col-md-2">
                                        <a href="<?php echo BASE_URL;?>pqd/jap/<?php echo $applicant_data['personal']->id;?>" target="_blank" class="btn btn-sm btn-block btn-success"><i class="fa fa-print"></i> Print PQD JAP</a>
                                    </div>
                                <?php endif;?>

                                <!-- SMS -->
                                <div class="col-md-2">
                                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/applicant_adv/<?php echo $applicant_data['personal']->id;?>'});" class="btn btn-block btn-sm btn-primary"><i class="fa fa-comment"></i> Message</a>
                                </div>

                                <!-- EDIT INFO -->
                                <div class="col-md-2">
                                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/personal/<?php echo $applicant_data['personal']->id;?>'});" class="btn btn-block btn-sm btn-warning"><i class="fa fa-pencil"></i> Edit Applicant Info</a>
                                </div>

                                <!-- REPORTED TODAY -->
                                <div class="col-md-2">
                                    <a href="<?php echo BASE_URL;?>applicant/reported_today/<?php echo $applicant_data['personal']->id;?>" class="btn btn-block btn-sm btn-success" title="update last reporting date"><i class="fa fa-calendar"></i> Reported Today</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                </div>
            </section>
            
		</div>
        
        
		<div class="col-md-12">

			<div class="tabs">
				<ul class="nav nav-tabs tabs-primary">
					<!-- <li class="profile_tab" aria-controls="reported_today"><a href="#reportedtoday" data-toggle="tab">Reported Today</a></li> -->
					<li class="profile_tab <?php echo ($current_tab=='overview')?"active":"";?>"  aria-controls="overview"><a href="#overview" data-toggle="tab">Overview</a></li>
					<li class="profile_tab <?php echo ($current_tab=='personal')?"active":"";?>" aria-controls="personal"><a href="#personal" data-toggle="tab">Personal Info</a></li>
					<li class="profile_tab <?php echo ($current_tab=='licenses')?"active":"";?>" aria-controls="licenses"><a href="#licenses" data-toggle="tab">Licenses &amp; Certificates</a></li>

                    <?php if(ENABLE_JAP_PROFILE):?>
                        <li class="profile_tab <?php echo ($current_tab=='jap')?"active":"";?>" aria-controls="jap"><a href="#jap" data-toggle="tab">Japan Resume</a></li>
                    <?php endif;?>
					<li class="profile_tab <?php echo ($current_tab=='lineup')?"active":"";?>" aria-controls="lineup"><a href="#lineup" data-toggle="tab">Lineup</a></li>
					<li class="profile_tab <?php echo ($current_tab=='assessment')?"active":"";?>" aria-controls="assessment"><a href="#assessment" data-toggle="tab">Assessment</a></li>
                    <?php if(!in_array('emp_offer', $this->config->item('restricted_tabs')) && in_array($applicant_data['personal']->status, array('MOBILIZATION','OPERATIONS','DEPLOYED','RESERVED','SELECTED - ACCEPTED'))):?>
					   <li class="profile_tab <?php echo ($current_tab=='emp_offer')?"active":"";?>" aria-controls="emp_offer"><a href="#emp_offer" data-toggle="tab">Employment Offer</a></li>
                        <li class="profile_tab <?php echo ($current_tab=='documents')?"active":"";?>" aria-controls="documents"><a href="#documents" data-toggle="tab">Documents</a></li>
                    <?php endif;?>
                    <?php if(/*$_SESSION['rs_user']['username'] == 'admin' &&*/ in_array($applicant_data['personal']->status, array('MOBILIZATION','OPERATIONS','DEPLOYED','RESERVED','SELECTED - ACCEPTED'))):?>
                        <li class="profile_tab <?php echo ($current_tab=='processing')?"active":"";?>" aria-controls="processing"><a href="#processing" data-toggle="tab">Processing</a></li>
                    <?php endif;?>
					<li class="profile_tab <?php echo ($current_tab=='deployment')?"active":"";?>" aria-controls="deployment"><a href="#deployment" data-toggle="tab">Deployment History</a></li>
                    <?php if((in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('accounts_card_access')) || in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('accounts_card_view'))) && in_array($applicant_data['personal']->status, array('MOBILIZATION','OPERATIONS','DEPLOYED','RESERVED','SELECTED - ACCEPTED'))):?>
                        <li class="profile_tab <?php echo ($current_tab=='accounts_card')?"active":"";?>" aria-controls="accounts_card"><a href="#accounts_card" data-toggle="tab">Accounts Card</a></li>
                    <?php endif;?>
                    <li class="profile_tab <?php echo ($current_tab=='welfare')?"active":"";?>" aria-controls="welfare"><a href="#welfare" data-toggle="tab">Welfare</a></li>
					<!-- <li class="profile_tab <?php echo ($current_tab=='references')?"active":"";?>" aria-controls="references"><a href="#references" data-toggle="tab">References</a></li>
					<li class="profile_tab <?php echo ($current_tab=='training')?"active":"";?>" aria-controls="training"><a href="#training" data-toggle="tab">Training</a></li>
					<li class="profile_tab <?php echo ($current_tab=='trade')?"active":"";?>" aria-controls="trade"><a href="#tradetest" data-toggle="tab">Trade Test</a></li>
					<li class="profile_tab <?php echo ($current_tab=='cv')?"active":"";?>" aria-controls="cv"><a href="#cv" data-toggle="tab">CV</a></li>
					<li class="profile_tab <?php echo ($current_tab=='position')?"active":"";?>" aria-controls="position"><a href="#positionapplied" data-toggle="tab">Position Applied</a></li>
					
					
					<li class="profile_tab <?php echo ($current_tab=='selections')?"active":"";?>" aria-controls="selections"><a href="#selections" data-toggle="tab">Selections</a></li>
					<li class="profile_tab <?php echo ($current_tab=='history')?"active":"";?>" aria-controls="history"><a href="#history" data-toggle="tab">History</a></li> -->
				</ul>
				<div class="tab-content">
                    
                </div>
            </div>
            
		</div>

	</div>
	<!-- end: page -->
</section>

<script>
	var applicant_id = '<?php echo $applicant_data['personal']->id;?>';
	var current_tab = '<?php echo $current_tab;?>';
	//alert(applicant_id);
</script>