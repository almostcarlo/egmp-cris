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

            
            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                <thead>
                    <tr class="title">
                        <th colspan="3">CASE DETAILS</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left"><strong>Details</strong></td>
                        <td width="20%" class="text-center"><strong>Attachment</strong></td>
                        <td width="15%" class="text-center"><strong>Date</strong></td>
                    </tr>
                    <tr>
                        <td class="text-left"><?php echo $welfare_data[0]['details'];?></td>
                        <td class="text-center"><a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($welfare_data[0]['id'])."/applicant_welfare/attachment";?>" target="_blank"><?php echo basename($welfare_data[0]['attachment']);?></a></td>
                        <td class="text-center"><?php echo dateformat($welfare_data[0]['add_date'],3);?></td>
                    </tr>
                </tbody>
            </table>

            <?php
                if(trim($welfare_data[0]['action']) <> ''){
            ?>

                <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                    <thead>
                        <tr class="title">
                            <th colspan="3">ACTION/REMARKS</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left"><strong>Details</strong></td>
                            <td width="20%" class="text-center"><strong>Attachment</strong></td>
                            <td width="15%" class="text-center"><strong>Date</strong></td>
                        </tr>
                        
                        <?php
                                $n = 1;
                                $actions = explode("&&&", $welfare_data[0]['action']);
                                foreach($actions as $i){
                                    $d = explode("[|]", $i);
                        ?>
                                    <tr>
                                        <td class="text-left"><?php echo $d[0];?></td>
                        <?php
                                        if($n == 1){
                        ?>
                                            <td rowspan="3" class="text-center"><a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($welfare_data[0]['id'])."/applicant_welfare/action_attachment";?>" target="_blank"><?php echo basename($welfare_data[0]['action_attachment']);?></a></td>
                        <?php
                                        }
                        ?>
                                        <td class="text-center"><?php echo dateformat($d[2],3);?></td>
                                    </tr>
                        <?php
                                    $n++;
                                }
                        ?>
                    </tbody>
                </table>
            <?php
                }
            ?>

            <?php if(trim($welfare_data[0]['final_action']) <> ''):?>
                <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                    <thead>
                        <tr class="title">
                            <th colspan="3">FINAL ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="text-left"><strong>Details</strong></td>
                            <td width="20%" class="text-center"><strong>Attachment</strong></td>
                            <td width="15%" class="text-center"><strong>Date</strong></td>
                        </tr>
                        <tr>
                            <td class="text-left"><?php echo $welfare_data[0]['final_action'];?></td>
                            <td class="text-center"><a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($welfare_data[0]['id'])."/applicant_welfare/final_attachment";?>" target="_blank"><?php echo basename($welfare_data[0]['final_attachment']);?></a></td>
                            <td class="text-center"><?php echo dateformat($welfare_data[0]['final_action_date'],3);?></td>
                        </tr>
                    </tbody>
                </table>
            <?php endif;?>

        </td></tr></tbody>

    </table>
    
</body>
</html>