<?php
    header('Content-Type: text/html;charset=utf-8');
    // var_dump($applicant_data);
    // exit();
?>
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
        <tbody>
            <tr>
                <td colspan="2" class="text-right">Date　　　　　　年　　　　　月　　　　　日</td>
            </tr>
            <tr><td colspan="2">
            
            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                <thead>
                    <tr class="title">
                        <th colspan="50">履歴書 Resume</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-right">氏名<br>Name</td>
                        <td colspan="3"><?php echo nameformat($applicant_data['personal']->fname, $applicant_data['personal']->mname, $applicant_data['personal']->lname, 1);?></td>
                        <td class="text-right">男<br><input type="checkbox" <?php echo ($applicant_data['personal']->gender=='M')?"checked=\"checked\"":"";?>>Male</td>
                        <td class="text-right">女<br><input type="checkbox" <?php echo ($applicant_data['personal']->gender=='F')?"checked=\"checked\"":"";?>>Female</td>
                        <td class="text-right">未婚<br><input type="checkbox" <?php echo ($applicant_data['personal']->civil_stat=='Single')?"checked=\"checked\"":"";?>>Single</td>
                        <td class="text-right">既婚<br><input type="checkbox" <?php echo ($applicant_data['personal']->civil_stat=='Married')?"checked=\"checked\"":"";?>>Married</td>
                        <td class="text-right">同棲<br><input type="checkbox">Gathering</td>
                        <td rowspan="4" colspan="2" class="text-center">
                            <?php if(isset($applicant_data['profile_picture_web'])):?>
                                <img src="<?php echo WEBSITE_URL.$applicant_data['profile_picture_web']->filename;?>" style="width:250px; height:250px; border-radius:50%;" />
                            <?php elseif(isset($applicant_data['profile_picture'])):?>
                                <img src="<?php echo BASE_URL."applicant/my_files/".base64_encode($applicant_data['profile_picture']->id);?>" style="width:150px; height:150px; border-radius:50%;" />
                            <?php else:?>
                                <img src="<?php echo BASE_URL;?>public/images/!logged-user<?php echo ($applicant_data['personal']->gender == 'F')?"-female":""?>.jpg" style="width:150px; height:150px; border-radius:50%;" />
                            <?php endif;?>
                        </td>
                    </tr>
                    <tr>
                        <td width="15%" class="text-right">生年月日<br>Birthday</td>
                        <td>年<br><?php echo date("Y", strtotime($applicant_data['personal']->birthdate));?></td>
                        <td>月<br><?php echo date("F", strtotime($applicant_data['personal']->birthdate));?></td>
                        <td>日<br><?php echo date("d", strtotime($applicant_data['personal']->birthdate));?></td>
                        <td width="15%" class="text-right">年齢<br>Age</td>
                        <td><?php echo getAge($applicant_data['personal']->birthdate)?></td>
                        <td width="15%" class="text-right">国籍<br>Nationality</td>
                        <td colspan="2"><?php echo $applicant_data['personal']->nationality?></td>
                    </tr>
                    <tr>
                        <td class="text-right">現住所<br>Address</td>
                        <td colspan="5"><?php echo $applicant_data['personal']->address;?>, <?php echo $applicant_data['personal']->city;?>, <?php echo $applicant_data['personal']->province;?></td>
                        <td class="text-right">電話番号<br>Telephone</td>
                        <td colspan="2"><?php echo $applicant_data['personal']->mobile_no;?></td>
                    </tr>
                    <tr>
                        <td class="text-right">希望住居<br>desired res.</td>
                        <td class="text-right">単独<br><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['residency']=='Alone')?"checked=\"checked\"":"";?>>Alone</td>
                        <td class="text-right">相部屋<br><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['residency']=='Shared Room')?"checked=\"checked\"":"";?>>Shared Room</td>
                        <td class="text-left">備考</td>
                        <td class="text-left" colspan="5"><?php echo isset($jap_profile[0])?$jap_profile[0]['residency_addr']:"";?></td>
                    </tr>
                    <tr>
                        <td class="text-right">身長 Height</td>
                        <td class="text-right"><?php echo $applicant_data['personal']->height;?><!-- <small>cm</small> --></td>
                        <td class="text-right">体重 Weight</td>
                        <td class="text-right"><?php echo $applicant_data['personal']->weight;?><!-- <small>cm</small> --></td>
                        <td class="text-right" colspan="2">靴 Foot Size</td>
                        <td class="text-right"><?php echo isset($jap_profile[0])?$jap_profile[0]['foot_size']:"";?><small>cm</small></td>
                        <td class="text-right" colspan="2">ウエスト Waist</td>
                        <td class="text-right"><?php echo isset($jap_profile[0])?$jap_profile[0]['waist_size']:"";?><small>cm</small></td>
                    </tr>
                    <tr>
                        <td class="text-right">作業服 Uniform</td>
                        <td class="text-left" colspan="7">
                            <input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['uniform_size']=='S')?"checked=\"checked\"":"";?>>S
                            &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['uniform_size']=='M')?"checked=\"checked\"":"";?>>M
                            &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['uniform_size']=='L')?"checked=\"checked\"":"";?>>L
                            &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['uniform_size']=='LL')?"checked=\"checked\"":"";?>>LL
                            &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['uniform_size']=='3L')?"checked=\"checked\"":"";?>>3L
                            &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['uniform_size']=='4L')?"checked=\"checked\"":"";?>>4L
                            &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['uniform_size']=='5L')?"checked=\"checked\"":"";?>>5L
                        </td>
                        <td class="text-right"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['handedness']=='R')?"checked=\"checked\"":"";?>>右利き Right Handed</td>
                        <td class="text-right"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['handedness']=='L')?"checked=\"checked\"":"";?>>左利き Left Handed</td>
                    </tr>
                    <tr>
                        <td class="text-left" colspan="8">病気の治療中また薬のアレルギー Have ever a Bad Sick or Allergy by Medicine?</td>
                        <td class="text-right"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['med_allergy']=='Y')?"checked=\"checked\"":"";?>>有 Yes</td>
                        <td class="text-right"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['med_allergy']=='N')?"checked=\"checked\"":"";?>>無 No</td>
                    </tr>
                    <tr>
                        <td class="text-right">健康 Healthy</td>
                        <td class="text-right"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['healthy']=='Y')?"checked=\"checked\"":"";?>>良い Good</td>
                        <td class="text-right"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['healthy']=='N')?"checked=\"checked\"":"";?>>悪い Bad</td>
                        <td class="text-right" colspan="5">飲酒 vc Alcohol?</td>
                        <td class="text-right"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['alcohol']=='Y')?"checked=\"checked\"":"";?>>有 Yes</td>
                        <td class="text-right"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['alcohol']=='N')?"checked=\"checked\"":"";?>>無 No</td>
                    </tr>
                    <tr>
                        <td class="text-right">血液型 Blood Type</td>
                        <td class="text-right" colspan="2">
                            <input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['blood_type']=='A')?"checked=\"checked\"":"";?>>A
                            &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['blood_type']=='B')?"checked=\"checked\"":"";?>>B
                            &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['blood_type']=='O')?"checked=\"checked\"":"";?>>O
                            &nbsp;&nbsp;&nbsp;
                            <input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['blood_type']=='AB')?"checked=\"checked\"":"";?>>AB
                        </td>
                        <td class="text-right" colspan="5">喫煙 vc Smoking?</td>
                        <td class="text-right"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['smoking']=='Y')?"checked=\"checked\"":"";?>>有 Yes</td>
                        <td class="text-right"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['smoking']=='N')?"checked=\"checked\"":"";?>>無 No</td>
                    </tr>
                    <tr>
                        <td class="text-right">視力Sight</td>
                        <td class="text-right">左 Left (<?php echo (isset($jap_profile[0]) && $jap_profile[0]['sight_left']<>'')?$jap_profile[0]['sight_left']:"20";?>)</td>
                        <td class="text-right">右 Right (<?php echo (isset($jap_profile[0]) && $jap_profile[0]['sight_right']<>'')?$jap_profile[0]['sight_right']:"20";?>)</td>
                        <td class="text-right" colspan="6"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['glasses']=='Y')?"checked=\"checked\"":"";?>>眼鏡 Glasses</td>
                        <td class="text-right"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['contact_lens']=='Y')?"checked=\"checked\"":"";?>>コンタクト Contact lens</td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                <thead>
                    <tr class="title">
                        <th colspan="6">学歴 School History</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            $sc_h = array();
                            if(isset($jap_profile[0])){
                                $sc_h = explode("|", $jap_profile[0]['school_history']);
                            }
                        ?>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Elementary", $sc_h)?"checked=\"checked\"":"")?>>小学校<br>Elementary</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Highschool", $sc_h)?"checked=\"checked\"":"")?>>中学校<br>Highschool</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("College", $sc_h)?"checked=\"checked\"":"")?>>高校<br>College</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("University", $sc_h)?"checked=\"checked\"":"")?>>大学<br>University</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Not Graduate", $sc_h)?"checked=\"checked\"":"")?>>中退<br>Not Graduate</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Graduate", $sc_h)?"checked=\"checked\"":"")?>>卒業<br>Graduate</td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                <thead>
                    <tr class="title">
                        <th colspan="6">職歴 Work History in Japan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="20%" class="text-center">会社名<br>Name of Company</td>
                        <td width="20%" class="text-center">所在地<br>Address</td>
                        <td width="20%" class="text-center">仕事内容<br>Type of Work</td>
                        <td width="10%" class="text-center">入社日<br>Hire Date</td>
                        <td width="10%" class="text-center">退社日<br>Retire Date</td>
                        <td width="20%" class="text-center">辞めた理由<br>Reason of Retirement</td>
                    </tr>
                    <?php
                        if(count($applicant_data['work'])>0){
                            foreach($applicant_data['work'] as $i){
                                if($i['country'] == 'Japan'){
                    ?>
                                    <tr>
                                        <td><?php echo $i['company_name'];?></td>
                                        <td><?php echo $i['address'];?></td>
                                        <td><?php echo $i['job_desc'];?></td>
                                        <td class="text-center"><?php echo dateformat($i['start_date']);?></td>
                                        <td class="text-center"><?php echo dateformat($i['end_date']);?></td>
                                        <td><?php echo $i['reason_for_leaving'];?></td>
                                    </tr>
                    <?php
                                }
                            }
                        }else{
                            for($j=1; $j<=4; $j++){
                    ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                    <?php
                            }
                        }
                    ?>
                    <!-- <?php for($j=1; $j<=4; $j++):?>
                        <tr>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                    <?php endfor;?> -->
                    <tr>
                        <td class="text-center">作業内容<br>Type of Service</td>
                        <td class="text-left" colspan="5">
                            <strong>1</strong> 旋盤 Clamp&nbsp;&nbsp;
                            <strong>2</strong> NC旋盤 Clamp NC&nbsp;&nbsp;
                            <strong>3</strong> 電子部品組立 Electronic Setup parts&nbsp;&nbsp;
                            <strong>4</strong> PL成形・Molding バリ取り Deburring&nbsp;&nbsp;
                            <strong>5</strong> 溶接 Welding&nbsp;&nbsp;
                            <strong>6</strong> 塗装 Painting&nbsp;&nbsp;
                            <strong>7</strong> 鋳造 Foundry&nbsp;&nbsp;
                            <strong>8</strong> 梱包 Packing&nbsp;&nbsp;
                            <strong>9</strong> ハンダ Solder&nbsp;&nbsp;
                            <strong>10</strong> プレス Press&nbsp;&nbsp;
                            <strong>11</strong> 車部品組立 Car Parts Setup&nbsp;&nbsp;
                            <strong>12</strong> フォークリフト　Forklift&nbsp;&nbsp;
                            <strong>13</strong> 電子部品検査　Electronic Parts Checking&nbsp;&nbsp;
                            <strong>14</strong> 車部品検査 Car Parts Checking&nbsp;&nbsp;
                            <strong>15</strong> 電子部品ライン Electronic Line work&nbsp;&nbsp;
                            <strong>16</strong> 車部品ライン Car Parts Line Work
                        </td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                <thead>
                    <tr class="title">
                        <th colspan="7">残業・夜勤可能か？ Can you Work Overtime or NightShift?</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left">残業 Overtime</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['work_ot']=='N')?"checked=\"checked\"":"";?>>不可能 Cannot</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['work_ot']=='Y')?"checked=\"checked\"":"";?>>可能 Can</td>
                        <td class="text-left" width="10%">最低 Minimum</td>
                        <td class="text-left" width="10%">H/Hrs. <?php echo (isset($jap_profile[0]))?$jap_profile[0]['work_ot_min']:"";?></td>
                        <td class="text-left" width="10%">最高Max</td>
                        <td class="text-left" width="10%">H/Hrs. <?php echo (isset($jap_profile[0]))?$jap_profile[0]['work_ot_max']:"";?></td>
                    </tr>
                    <tr>
                        <td class="text-left">夜勤 Night Shift</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['work_night']=='N')?"checked=\"checked\"":"";?>>不可能 Cannot</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['work_night']=='Y')?"checked=\"checked\"":"";?>>可能 Can</td>
                        <td class="text-left" width="10%">最低 Minimum</td>
                        <td class="text-left" width="10%">H/Hrs. <?php echo (isset($jap_profile[0]))?$jap_profile[0]['work_night_min']:"";?></td>
                        <td class="text-left" width="10%">最高Max</td>
                        <td class="text-left" width="10%">H/Hrs. <?php echo (isset($jap_profile[0]))?$jap_profile[0]['work_night_max']:"";?></td>
                    </tr>
                    <tr>
                        <td class="text-left">交替 Shift</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['work_shift']=='N')?"checked=\"checked\"":"";?>>不可能 Cannot</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['work_shift']=='Y')?"checked=\"checked\"":"";?>>可能 Can</td>
                        <td class="text-left" width="10%">最低 Minimum</td>
                        <td class="text-left" width="10%">H/Hrs. <?php echo (isset($jap_profile[0]))?$jap_profile[0]['work_shift_min']:"";?></td>
                        <td class="text-left" width="10%">最高Max</td>
                        <td class="text-left" width="10%">H/Hrs. <?php echo (isset($jap_profile[0]))?$jap_profile[0]['work_shift_max']:"";?></td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                <thead>
                    <tr class="title">
                        <th colspan="6">日本語または他国語理解度 Average of speaking japanese language</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-left">会話 Speak</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['jap_speak']=='Good')?"checked=\"checked\"":"";?>>良い Good</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['jap_speak']=='Normal')?"checked=\"checked\"":"";?>>普通 Normal</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['jap_speak']=='Slight')?"checked=\"checked\"":"";?>>少々 Slight</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['jap_speak']=='Cannot')?"checked=\"checked\"":"";?>>不可 Cannot</td>
                        <td class="text-left">理解度 Understand (<?php echo (isset($jap_profile[0]))?$jap_profile[0]['jap_speak_rating']:"";?>)%</td>
                    </tr>
                    <tr>
                        <td class="text-left">理解 Understand</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['jap_understand']=='Good')?"checked=\"checked\"":"";?>>良い Good</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['jap_understand']=='Normal')?"checked=\"checked\"":"";?>>普通 Normal</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['jap_understand']=='Slight')?"checked=\"checked\"":"";?>>少々 Slight</td>
                        <td class="text-left"><input type="checkbox" <?php echo (isset($jap_profile[0]) && $jap_profile[0]['jap_understand']=='Cannot')?"checked=\"checked\"":"";?>>不可 Cannot</td>
                        <td class="text-left">理解度 Understand (<?php echo (isset($jap_profile[0]))?$jap_profile[0]['jap_understand_rating']:"";?>)%</td>
                    </tr>
                    <tr>
                        <?php
                            if(isset($jap_profile[0])){
                                $jap_r = explode("|", $jap_profile[0]['jap_read']);
                            }
                        ?>
                        <td class="text-left">読み Reading</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Katakana", $jap_r)?"checked=\"checked\"":"")?>>カタカナ Katakana</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Hiragana", $jap_r)?"checked=\"checked\"":"")?>>ひらがな Hiragana</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Kanji", $jap_r)?"checked=\"checked\"":"")?>>漢字 Kanji</td>
                        <td class="text-left" colspan="2">理解度 Understand (<?php echo (isset($jap_profile[0]))?$jap_profile[0]['jap_read_rating']:"";?>)%</td>
                    </tr>
                    <tr>
                        <?php
                            if(isset($jap_profile[0])){
                                $jap_w = explode("|", $jap_profile[0]['jap_write']);
                            }
                        ?>
                        <td class="text-left">書き Writing</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Katakana", $jap_w)?"checked=\"checked\"":"")?>>カタカナ Katakana</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Hiragana", $jap_w)?"checked=\"checked\"":"")?>>ひらがな Hiragana</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Kanji", $jap_w)?"checked=\"checked\"":"")?>>漢字 Kanji</td>
                        <td class="text-left" colspan="2">理解度 Understand (<?php echo (isset($jap_profile[0]))?$jap_profile[0]['jap_write_rating']:"";?>)%</td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                <thead>
                    <tr class="title">
                        <th colspan="10">運転免許証 Driver`s Liscense Information</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php
                            if(isset($jap_profile[0])){
                                $jap_lic = explode("|", $jap_profile[0]['license_res']);
                            }
                        ?>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("None", $jap_lic)?"checked=\"checked\"":"")?>>無し<br>None</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("(AT/MT)", $jap_lic)?"checked=\"checked\"":"")?>>普通<br>(AT/MT)</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Chugata", $jap_lic)?"checked=\"checked\"":"")?>>中型<br>Chugata</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Ogata", $jap_lic)?"checked=\"checked\"":"")?>>大型<br>Ogata</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Motor", $jap_lic)?"checked=\"checked\"":"")?>>二輪<br>Motor</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("50cc Motor", $jap_lic)?"checked=\"checked\"":"")?>>原付<br>50cc Motor</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Forklift", $jap_lic)?"checked=\"checked\"":"")?>>ﾌｫｰｸﾘﾌﾄ<br>Forklift</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Bicicleta", $jap_lic)?"checked=\"checked\"":"")?>>自転車<br>Bicicleta</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Can", $jap_lic)?"checked=\"checked\"":"")?>>可<br>-</td>
                        <td class="text-left"><input type="checkbox" <?php echo (in_array("Cannot", $jap_lic)?"checked=\"checked\"":"")?>>不可<br>Cannot</td>
                    </tr>
                </tbody>
            </table>

            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                <thead>
                    <tr class="title">
                        <th colspan="10">在日家族または親族 Member Of Family/Relatives in Japan</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="20%" class="text-left">氏名<br>Name</td>
                        <td width="10%" class="text-center">続柄<br>Relation</td>
                        <td width="10%" class="text-center">年齢<br>Age</td>
                        <td width="10%" class="text-center">職業<br>Status</td>
                        <td width="30%" class="text-left">所在地<br>Address</td>
                        <td width="20%" class="text-left">備考</td>
                    </tr>
                    <?php
                        if(count($jap_relatives)>0){
                            foreach($jap_relatives as $i){
                    ?>
                                <tr>
                                    <td><?php echo $i['name'];?></td>
                                    <td class="text-center"><?php echo $i['relationship'];?></td>
                                    <td class="text-center"><?php echo $i['age'];?></td>
                                    <td class="text-center"><?php echo $i['occupation'];?></td>
                                    <td><?php echo $i['address'];?></td>
                                    <td><?php echo $i['remarks'];?></td>
                                </tr>
                    <?php
                            }
                        }else{
                            for($j=1; $j<=4; $j++){
                    ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                    <?php
                            }
                        }
                    ?>
                </tbody>
            </table>

            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                <thead>
                    <tr class="title">
                        <th colspan="10">上記に記入したことに間違いありません。 I Affirm that all the information is true.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td width="90%" class="text-center">&nbsp;</td>
                        <td width="10%" class="text-center">担当者</td>
                    </tr>
                    <tr>
                        <td class="text-right"><br>署名 Signature:________________________________________</td>
                        <td></td>
                    </tr>
                </tbody>
            </table>

        </td></tr></tbody>

    </table>
    
</body>
</html>