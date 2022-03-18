<!doctype html>
<html class="fixed">
<head>

<!-- Basic -->
<meta charset="UTF-8">

<title><?php echo PROGRAM_NAME;?></title>
<meta name="keywords" content="ipeople, recruitment, system, recruitment system, ipeople system, ipeople recruitment system" />
<meta name="description" content="iPeople Recruitment System">
<meta name="author" content="Karl Gerald Saul | JSOFT.net">

<!-- Mobile Metas -->
<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />

<link rel="shortcut icon" href="<?php echo BASE_URL;?>public/images/<?php echo COMPANY_ICON;?>"/>

<!-- Web Fonts  -->
<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">

<!-- Vendor CSS -->
<link rel="stylesheet" href="<?php echo BASE_URL;?>public/stylesheets/print.css" />
</head>
<body class="print">
    
    <table class="table border-less" cellspacing="0">
        
        <thead>
            <tr>
                <th><img src="<?php echo BASE_URL;?>public/images/<?php echo COMPANY_LOGO;?>" /></th>
                <th class="text-right text-normal"><?php echo COMPANY_ADDRESS;?></th>
            </tr>
        </thead>
        <tbody><tr><td colspan="2">
            
            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                <thead>
                    <tr class="title">
                        <th colspan="5">PERSONAL DETAILS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td rowspan="6" class="text-center" width="30%">
							<?php if(isset($applicant_data['profile_picture_web'])):?>
                            	<img src="<?php echo WEBSITE_URL.$applicant_data['profile_picture_web']->filename;?>" style="width:250px; height:250px; border-radius:50%;" />
                        	<?php elseif(isset($applicant_data['profile_picture'])):?>
								<img src="<?php echo BASE_URL."applicant/my_files/".base64_encode($applicant_data['profile_picture']->id);?>" style="width:150px; height:150px; border-radius:50%;" />
                        	<?php else:?>
                        		<img src="<?php echo BASE_URL;?>public/images/!logged-user<?php echo ($applicant_data['personal']->gender == 'F')?"-female":""?>.jpg" style="width:150px; height:150px; border-radius:50%;" />
                        	<?php endif;?>
                        	<!-- <img src="<?php echo BASE_URL;?>public/images/!logged-user.jpg" style="width:150px; height:150px; border-radius:50%;" /> -->
                    	</td>
                        <td class="text-right"><strong>Full Name</strong></td>
                        <td colspan="3"><?php echo nameformat($applicant_data['personal']->fname, $applicant_data['personal']->mname, $applicant_data['personal']->lname, 1);?></td>
                    </tr>
                    <tr>
                        <td width="15%" class="text-right"><strong>Date of Birth</strong></td>
                        <td><?php echo dateformat($applicant_data['personal']->birthdate);?></td>
                        <td width="15%" class="text-right"><strong>Age</strong></td>
                        <td><?php echo getAge($applicant_data['personal']->birthdate)?></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong>Civil Status</strong></td>
                        <td><?php echo $applicant_data['personal']->civil_stat;?></td>
                        <td class="text-right"><strong>Religion</strong></td>
                        <td><?php echo $applicant_data['personal']->religion;?></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong>Gender</strong></td>
                        <td><?php echo ($applicant_data['personal']->gender=='F')?"Female":"Male";?></td>
                        <td class="text-right"><strong></strong></td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong>Height</strong></td>
                        <td><?php echo $applicant_data['personal']->height;?></td>
                        <td class="text-right"><strong>Weight</strong></td>
                        <td><?php echo $applicant_data['personal']->weight;?></td>
                    </tr>
                    <tr>
                        <td class="text-right"><strong>Nationality</strong></td>
                        <td><?php echo $applicant_data['personal']->nationality;?></td>
                        <td class="text-right"><strong></strong></td>
                        <td></td>
                    </tr>
                </tbody>
            </table>
            

<?php
            $cnt = 1;
            if($applicant_data['work']){
                foreach ($applicant_data['work'] as $work_info){
?>
                    <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                    	<?php if($cnt == 1):?>
                            <thead>
                                <tr class="title">
                                    <th colspan="5">JOB EXPERIENCE</th>
                                </tr>
                            </thead>
                        <?php endif;?>
                        <tbody>
                            <tr>
                                <td width="10%" class="text-center"><strong>From</strong></td>
                                <td width="10%" class="text-center"><strong>To</strong></td>
                                <td class="text-center"><strong>Employer</strong></td>
                                <td width="20%" class="text-center"><strong>Position</strong></td>
                                <td width="20%" class="text-center"><strong>Country</strong></td>
                            </tr>
                            <tr>
                                <td><?php echo dateformat($work_info['start_date'],4)?></td>
                                <td><?php echo ($work_info['end_date']!='0000-00-00')?dateformat($work_info['end_date'],4):"Present";?></td>
                                <td><?php echo $work_info['company_name']?></td>
                                <td><?php echo $work_info['position']?></td>
                                <td><?php echo $work_info['country']?></td>
                            </tr>
                            <tr>
                                <td colspan="5"><strong>Job Description / Duties & Responsibilities</strong></td>
                            </tr>
                            <tr>
                                <td colspan="5"><?php echo nl2br($work_info['job_desc'])?></td>
                            </tr>
                        </tbody>
                    </table>
<?php
                    $cnt++;
                }
            }
?>
            
            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                <thead>
                    <tr class="title">
                        <th colspan="6">EDUCATIONAL BACKGROUND</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="17%" class="text-center"><strong>Level</strong></td>
                        <td width="10%" class="text-center"><strong>From</strong></td>
                        <td width="10%" class="text-center"><strong>To</strong></td>
                        <td class="text-center"><strong>School</strong></td>
                        <td width="17%" class="text-center"><strong>Degree/Course</strong></td>
                        <td width="17%" class="text-center"><strong>Graduated</strong></td>
                    </tr>
                    <?php if($applicant_data['education']):?>
                    	<?php foreach ($applicant_data['education'] as $educ_info):?>
                            <tr>
                                <td><?php echo $educ_info['educ_level']?></td>
                                <td><?php echo dateformat($educ_info['start_date'],4)?></td>
                                <td><?php echo dateformat($educ_info['end_date'],4)?></td>
                                <td><?php echo $educ_info['school_name']?></td>
                                <td><?php echo $educ_info['course']?></td>
                                <td><?php echo ($educ_info['graduated']=='Y')?"Yes":"No";?></td>
                            </tr>
                    	<?php endforeach;?>
                	<?php endif;?>
                </tbody>
            </table>
            
            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                <thead>
                    <tr class="title">
                        <th colspan="3">TRAINING &amp; SEMINAR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="33.33%" class="text-center"><strong>Description</strong></td>
                        <td width="33.33%" class="text-center"><strong>Training School/Institution</strong></td>
                        <td width="33.33%" class="text-center"><strong>Duration</strong></td>
                    </tr>
                    <?php if($applicant_data['training']):?>
                    	<?php foreach ($applicant_data['training'] as $training_info):?>
                            <tr>
                                <td><?php echo $training_info['training_desc']?></td>
                                <td><?php echo $training_info['training_center']?></td>
                                <td><?php echo dateformat($training_info['start_date'],4)."-".dateformat($training_info['end_date'],4)?></td>
                            </tr>
                    	<?php endforeach;?>
                    <?php endif;?>
                </tbody>
            </table>
            
            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
            	<thead>
                	<tr class="title">
                		<th>SKILLS &amp; OTHER INFORMATION</th>
                	</tr>
            	</thead>
            	<tbody>
                	<tr>
                		<td><?php echo (isset($applicant_data['skills']->skills))?nl2br($applicant_data['skills']->skills):"";?></td>
                	</tr>
            	</tbody>
            </table>

            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
            	<thead>
                	<tr class="title">
                		<th colspan="5">LINEUP ASSESSMENT</th>
            		</tr>
        		</thead>
        		<tbody>
                    <tr>
                        <td width="40%" class="text-center"><strong>Description</strong></td>
                        <td width="20%" class="text-center"><strong>Lineup Category</strong></td>
                        <td width="20%" class="text-center"><strong>Recommended Position</strong></td>
                        <td width="10%" class="text-center"><strong>Assessed By</strong></td>
                        <td width="10%" class="text-center"><strong>Date</strong></td>
                    </tr>
                    <tr>
                    	<td><?php echo nl2br($assessment['assess_detail'])?></td>
                        <td align="center"><?php echo $assessment['position']?></td>
                    	<td align="center"><?php echo $assessment['assess_position']?></td>
                    	<td align="center"><?php echo $assessment['assess_by']?></td>
                    	<td align="center"><?php echo dateformat($assessment['assess_date'],3)?></td>
                    </tr>
        		</tbody>
            </table>

            
        </td></tr></tbody>

    </table>
    
</body>
</html>