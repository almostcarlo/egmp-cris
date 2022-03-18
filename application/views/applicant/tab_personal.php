<div id="personal" class="tab-pane active">

    <!-- EDUCATION -->
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/education/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Data</a>
            <h2 class="panel-title">Educational Attainment</h2>
        </header>
        <div class="panel-body">
			<?php if($applicant_data['education']):?>
    			<?php foreach ($applicant_data['education'] as $educ_info):?>
                    <div class="alert alert-default alert-nobg">
                        <button type="button" onclick="delete_record('education', '<?php echo $educ_info['id'];?>')" class="delete" data-dismiss="alert" aria-hidden="true"><i class="fa fa-trash-o"></i></button>
                        <a type="button" class="edit" href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/education/<?php echo $applicant_id;?>/<?php echo $educ_info['id'];?>'});"><i class="fa fa-pencil"></i></a>
                        <h5> <?php echo $educ_info['educ_level'];?></h5>
                        <div class="row">
                            <p class="col-md-4" style="margin-bottom:0;"><strong>School:</strong> <?php echo $educ_info['school_name'];?></p>
                            <p class="col-md-6" style="margin-bottom:0;"><strong>Address:</strong>  <?php echo $educ_info['location'];?></p>
                            <p class="col-md-2" style="margin-bottom:0;"><strong>School Year:</strong>  <?php echo dateformat($educ_info['start_date'],4);?> - <?php echo dateformat($educ_info['end_date'],4);?></p>
                        </div>
                    </div>
    			<?php endforeach;?>
            <?php else:?>
                <small class="required">no record found.</small>
			<?php endif;?>
            
        </div>
    </section>
    
    <!-- WORK HISTORY -->
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            
            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/work/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Data</a>
            <h2 class="panel-title">Work History</h2>
        </header>
        <div class="panel-body">
			<?php if($applicant_data['work']):?>
    			<?php foreach ($applicant_data['work'] as $emp_info):?>
                    <div class="alert alert-default alert-nobg">
                        <button type="button" onclick="delete_record('work', '<?php echo $emp_info['id'];?>')" class="delete" data-dismiss="alert" aria-hidden="true"><i class="fa fa-trash-o"></i></button>
                        <a type="button" class="edit" href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/work/<?php echo $applicant_id;?>/<?php echo $emp_info['id'];?>'});"><i class="fa fa-pencil"></i></a>
                        <h5><?php echo ucwords(strtolower($emp_info['position']));?></h5>
                        <div class="row">
                            <p class="col-md-6" style="margin-bottom:0;"><strong>Company:</strong> <?php echo $emp_info['company_name'];?></p>
                            <!-- <p class="col-md-3" style="margin-bottom:0;"><strong>Nature of Project Exp.:</strong> ...</p> -->
                            <p class="col-md-3" style="margin-bottom:0;"><strong>Country:</strong> <?php echo $emp_info['country'];?></p>
                            <p class="col-md-3" style="margin-bottom:0;"><strong>Date:</strong> <?php echo dateformat($emp_info['start_date'],4)?>
                            <?php
                                if(dateformat($emp_info['end_date'])){
                                    echo "- ".dateformat($emp_info['end_date'],4);
                                }else{
                                    if(dateformat($emp_info['start_date'])){
                                        echo "- Present";
                                    }
                                }
                            ?>
                            </p>
                        </div>
                        <div class="row">
                            <p class="col-md-12" style="margin-bottom:0;"><strong>Job Description:</strong><br /><?php echo nl2br($emp_info['job_desc']);?></p>
                        </div>
                    </div>
    			<?php endforeach;?>
            <?php elseif($applicant_data['personal']->is_freshgrad == 'Y'):?>
                <small class="">Fresh graduate or no working experience yet.</small>
            <?php else:?>
                <small class="required">no record found.</small>
			<?php endif;?>
            
        </div>
    </section>
    
    <!-- SKILLS -->
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            <?php if(!$applicant_data['skills']):?>
            	<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/skills/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Data</a>
            <?php endif;?>
            <h2 class="panel-title">Skills</h2>
        </header>
        <div class="panel-body">
            <?php if($applicant_data['skills']):?>
                <div class="alert alert-default alert-nobg">
                    <button type="button" onclick="delete_record('skills', '<?php echo $applicant_data['skills']->id;?>')" class="delete" data-dismiss="alert" aria-hidden="true"><i class="fa fa-trash-o"></i></button>
                    <a type="button" class="edit" href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/skills/<?php echo $applicant_id;?>/<?php echo $applicant_data['skills']->id;?>'});"><i class="fa fa-pencil"></i></a>
                    <div class="row">
                        <p class="col-md-12" style="margin-bottom:0;"><?php echo nl2br($applicant_data['skills']->skills);?></p>
                    </div>
                </div>
            <?php else:?>
                <small class="required">no record found.</small>
            <?php endif;?>
        </div>
    </section>
    
    <!-- REFERENCE -->
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            
            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/reference/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Data</a>
            <h2 class="panel-title">Reference</h2>
        </header>
        <div class="panel-body">
            <?php if($reference_data):?>
            	<?php foreach ($reference_data as $ref_info):?>
                    <div class="alert alert-default alert-nobg">
                        <button type="button" onclick="delete_record('reference', '<?php echo $ref_info['id'];?>')" class="delete" data-dismiss="alert" aria-hidden="true"><i class="fa fa-trash-o"></i></button>
                        <a type="button" class="edit" href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/reference/<?php echo $applicant_id;?>/<?php echo $ref_info['id'];?>'});"><i class="fa fa-pencil"></i></a>
                        <h5><?php echo ucwords(strtolower($ref_info['name']));?></h5>
                        <div class="row">
                            <p class="col-md-4" style="margin-bottom:0;"><strong>Position Title:</strong> <?php echo $ref_info['position'];?></p>
                            <p class="col-md-4" style="margin-bottom:0;"><strong>Company Name:</strong> <?php echo $ref_info['employer'];?></p>
                        </div>
                        <div class="row">
                            <p class="col-md-4" style="margin-bottom:0;"><strong>Contact No.:</strong> <?php echo $ref_info['contact_no'];?></p>
                            <p class="col-md-4" style="margin-bottom:0;"><strong>Email Address:</strong> <?php echo $ref_info['email'];?></p>
                            <p class="col-md-4" style="margin-bottom:0;"><strong>Relationship:</strong> <?php echo $ref_info['relationship'];?></p>
                        </div>
                    </div>
            	<?php endforeach;?>
            <?php else:?>
                <small class="required">no record found.</small>
            <?php endif;?>
        </div>
    </section>
    
</div>