<?php
    $ppt = getdata("select serial_no From applicant_uploads where applicant_id={$applicant_data['personal']->id} and description='Passport'");
    $prc = getdata("select serial_no From applicant_uploads where applicant_id={$applicant_data['personal']->id} and description='PRC License Card'");
    $dr = getdata("select serial_no From applicant_uploads where applicant_id={$applicant_data['personal']->id} and description='Drivers License'");
    $umid = getdata("select serial_no From applicant_uploads where applicant_id={$applicant_data['personal']->id} and description='SSS ID Card'");
    $educ_hs = getdata("select * From applicant_education where applicant_id={$applicant_data['personal']->id} and level_id = 5");
    $educ_coll = getdata("select * From applicant_education where applicant_id={$applicant_data['personal']->id} and level_id = 1");
    $pos = "N/A";

    if($applicant_data['personal']->lineup_id == ''){
        $my_pos = getdata("select pos.`desc` as position
                            From applicant_lineup l
                            left join manager_jobs j
                            on l.mr_pos_id = j.id
                            left join settings_position pos
                            on j.pos_id = pos.id
                            where l.applicant_id={$applicant_data['personal']->id}
                            order by l.add_date desc
                            limit 1");

        if(isset($my_pos[0])){
            $pos = $my_pos[0]['position'];
        }
    }else{
        $my_pos = getdata("select pos.`desc` as position
                            From applicant_lineup l
                            left join manager_jobs j
                            on l.mr_pos_id = j.id
                            left join settings_position pos
                            on j.pos_id = pos.id
                            where l.id={$applicant_data['personal']->lineup_id}");
        $pos = $my_pos[0]['position'];
    }
?>
<!doctype html>
<html class="fixed">
<head>

<!-- Basic -->
<meta charset="UTF-8">

<title><?php echo PROGRAM_NAME;?></title>
<meta name="keywords" content="recruitment, system, recruitment system" />
<meta name="description" content="<?php echo PROGRAM_NAME;?>">
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
    
    <table class="table" cellspacing="0">
        <tbody>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td colspan="2"><?php echo strtoupper(nameformat($applicant_data['personal']->fname, $applicant_data['personal']->mname, $applicant_data['personal']->lname,2));?> - <?php echo strtoupper($pos);?></td>
                        </tr>
                    </table>

                    <table class="table table-bordered" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="20%" align="center" rowspan="5">
                                <?php if(isset($applicant_data['profile_picture_web']) && $applicant_data['profile_picture_web']->from_portal == 'Y'):?>
                                    <img src="<?php echo PORTAL_URL.$applicant_data['profile_picture_web']->filename;?>" style="width:250px; height:250px; border-radius:50%;" />
                                <?php elseif(isset($applicant_data['profile_picture_web'])):?>
                                    <img src="<?php echo WEBSITE_URL.$applicant_data['profile_picture_web']->filename;?>" style="width:250px; height:250px; border-radius:50%;" />
                                <?php elseif(isset($applicant_data['profile_picture'])):?>
                                    <img src="<?php echo BASE_URL."applicant/my_files/".base64_encode($applicant_data['profile_picture']->id);?>" style="width:250px; height:250px; border-radius:50%;" />
                                <?php else:?>
                                    <img src="<?php echo BASE_URL;?>public/images/!logged-user<?php echo ($applicant_data['personal']->gender == 'F')?"-female":""?>.jpg" style="width:150px; height:150px; border-radius:50%;" />
                                <?php endif;?>
                            </td>
                        </tr>
                        <tr>
                            <td width="40%" align="center"><strong>FIRST NAME</strong></td>
                            <td width="40%" align="center"><?php echo strtoupper($applicant_data['personal']->fname);?></td>
                        </tr>
                        <tr>
                            <td align="center"><strong>MIDDLE NAME</strong></td>
                            <td align="center"><?php echo strtoupper($applicant_data['personal']->mname);?></td>
                        </tr>
                        <tr>
                            <td align="center"><strong>SURNAME</strong></td>
                            <td align="center"><?php echo strtoupper($applicant_data['personal']->lname);?></td>
                        </tr>
                        <tr>
                            <td align="center" colspan="2"><strong><?php echo strtoupper($pos);?></strong><br>Position Applied For</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td width="20%"></td>
                <td width="80%">
                    <table class="table table-bordered" cellspacing="0">
                        <thead>
                            <tr class="title">
                                <th class="text-center">PERSONAL INFORMATION</th>
                            </tr>
                        </thead>
                    </table>
                </td>
            </tr>
            <tr>
                <td colspan="2">
                    <table class="table table-bordered" cellpadding="0" cellspacing="0">
                        <tr>
                            <td width="20%" align="center" rowspan="14"><img src="<?php echo BASE_URL;?>public/images/egmp-side-logo.jpg" /></td>
                        </tr>
                        <tr>
                            <td width="40%" style="padding-left:40px;"><strong>DATE OF BIRTH</strong></td>
                            <td width="40%"><?php echo dateformat($applicant_data['personal']->birthdate);?></td>
                        </tr>
                        <tr>
                            <td style="padding-left:40px;"><strong>AGE</strong></td>
                            <td><?php echo getAge($applicant_data['personal']->birthdate);?></td>
                        </tr>
                        <tr>
                            <td style="padding-left:40px;"><strong>HEIGHT</strong></td>
                            <td><?php echo $applicant_data['personal']->height;?></td>
                        </tr>
                        <tr>
                            <td style="padding-left:40px;"><strong>WEIGHT</strong></td>
                            <td><?php echo $applicant_data['personal']->weight;?></td>
                        </tr>
                        <tr>
                            <td style="padding-left:40px;"><strong>PLACE OF BIRTH</strong></td>
                            <td><?php echo $applicant_data['personal']->birthplace;?></td>
                        </tr>
                        <tr>
                            <td style="padding-left:40px;"><strong>RELIGION</strong></td>
                            <td><?php echo strtoupper($applicant_data['personal']->religion);?></td>
                        </tr>
                        <tr>
                            <td style="padding-left:40px;"><strong>GENDER</strong></td>
                            <td><?php echo ($applicant_data['personal']->gender=='M')?"MALE":"FEMALE";?></td>
                        </tr>
                        <tr>
                            <td style="padding-left:40px;"><strong>MARITAL STATUS</strong></td>
                            <td><?php echo strtoupper($applicant_data['personal']->civil_stat);?></td>
                        </tr>
                        <tr>
                            <td style="padding-left:40px;"><strong>PASSPORT NO.</strong></td>
                            <td><?php echo ($ppt)?$ppt[0]['serial_no']:"";?></td>
                        </tr>
                        <tr>
                            <td style="padding-left:40px;"><strong>PROFESSIONAL LICENSE NO.</strong></td>
                            <td><?php echo ($prc)?$prc[0]['serial_no']:"";?></td>
                        </tr>
                        <tr>
                            <td style="padding-left:40px;"><strong>DRIVER'S LICENSE NO.</strong></td>
                            <td><?php echo ($dr)?$dr[0]['serial_no']:"";?></td>
                        </tr>
                        <tr>
                            <td style="padding-left:40px;"><strong>UMID NO.</strong></td>
                            <td><?php echo ($umid)?$umid[0]['serial_no']:"";?></td>
                        </tr>
                        <tr>
                            <td align="right" colspan="2"><br>_______________________________________<br>SIGNATURE OVER PRINTED NAME</td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- PAGE 2 -->
    <table class="table" cellspacing="0">
        <tbody>
            <tr>
                <td colspan="2">
                    <table width="100%">
                        <tr>
                            <td colspan="2"><?php echo strtoupper(nameformat($applicant_data['personal']->fname, $applicant_data['personal']->mname, $applicant_data['personal']->lname,2));?> - <?php echo strtoupper($pos);?></td>
                        </tr>
                    </table>

                    <table class="table table-bordered" cellspacing="0">
                        <thead>
                            <tr class="title">
                                <th class="text-center">EDUCATION</th>
                            </tr>
                        </thead>
                    </table>
                </td>
            </tr>

            <tr>
                <td colspan="2">
                    <table class="table table-bordered" cellpadding="0" cellspacing="0">
                        <tr>
                            <td colspan="2" align="center"><strong>HIGH SCHOOL</strong></td>
                        </tr>
                        <tr>
                            <td width="30%"><strong>NAME OF SCHOOL</strong></td>
                            <td width="70%"><?php echo ($educ_hs)?$educ_hs[0]['school_name']:""?></td>
                        </tr>
                        <tr>
                            <td><strong>LOCATION</strong></td>
                            <td><?php echo ($educ_hs)?$educ_hs[0]['location']:""?></td>
                        </tr>
                        <tr>
                            <td><strong>PERIOD COVERED</strong></td>
                            <td><?php echo ($educ_hs)?dateformat($educ_hs[0]['start_date'],4)." - ".dateformat($educ_hs[0]['end_date'],4):""?></td>
                        </tr>
                        <tr>
                            <td><strong>ATTAINMENT</strong></td>
                            <td><?php echo ($educ_hs && $educ_hs[0]['graduated']=='Y')?"Graduated":""?></td>
                        </tr>
                        <tr>
                            <td colspan="2" align="center"><strong>COLLEGE / UNIVERSITY</strong></td>
                        </tr>
                        <tr>
                            <td><strong>NAME OF SCHOOL</strong></td>
                            <td><?php echo ($educ_coll)?$educ_coll[0]['school_name']:""?></td>
                        </tr>
                        <tr>
                            <td><strong>LOCATION</strong></td>
                            <td><?php echo ($educ_coll)?$educ_coll[0]['location']:""?></td>
                        </tr>
                        <tr>
                            <td><strong>PERIOD COVERED</strong></td>
                            <td><?php echo ($educ_coll)?dateformat($educ_coll[0]['start_date'],4)." - ".dateformat($educ_coll[0]['end_date'],4):""?></td>
                        </tr>
                        <tr>
                            <td><strong>ATTAINMENT</strong></td>
                            <td><?php echo ($educ_coll && $educ_coll[0]['graduated']=='Y')?"Graduated":""?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table class="table table-bordered" cellspacing="0">
                        <thead>
                            <tr class="title">
                                <th class="text-center">EMPLOYMENT HISTORY</th>
                            </tr>
                        </thead>
                    </table>
                </td>
            </tr>
<?php
            $cnt = 1;
            if($applicant_data['work']){
                foreach ($applicant_data['work'] as $work_info){
?>
                    <tr>
                        <td colspan="2">
                            <table class="table table-bordered" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td width="30%"><strong>PERIOD COVERED</strong></td>
                                    <td width="70%"><?php echo dateformat($work_info['start_date'],4)." - ".dateformat($work_info['end_date'],4);?></td>
                                </tr>
                                <tr>
                                    <td><strong>COMPANY</strong></td>
                                    <td><?php echo $work_info['company_name'];?></td>
                                </tr>
                                <tr>
                                    <td><strong>LOCATION</strong></td>
                                    <td><?php echo $work_info['address'];?><?php echo ($work_info['country']<>'')?", ".$work_info['country']:"";?></td>
                                </tr>
                                <tr>
                                    <td><strong>JOB TITLE</strong></td>
                                    <td><?php echo $work_info['position'];?></td>
                                </tr>
                                <tr>
                                    <td><strong>JOB DESCRIPTION</strong></td>
                                    <td><?php echo $work_info['job_desc'];?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
<?php
                }
            }
?>
            <tr>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td><i>I HEREBY CERTIFY THAT ALL INFORMATION CONTAINED HEREIN TO BE THE BEST OF MY KNOWLEDGE ARE TRUE AND CORRECT</i></td>
            </tr>
            <tr>
                <td align="right"><br>_______________________________________<br><strong>SIGNATURE OVER PRINTED NAME</strong></td>
            </tr>
        </tbody>
    </table>
    <!-- END PAGE 2 -->
</body>
</html>