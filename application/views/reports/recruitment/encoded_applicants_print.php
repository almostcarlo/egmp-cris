<?php
    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=encoded_applicants.xls");
        header("Cache-Control: public");
    }

    if($_POST['textStDate'] == '' || $_POST['textEnDate'] == ''){
        $title_date = date("F 01, Y")." - ".date("F d, Y");
    }else{
        $title_date = date("F d, Y", strtotime($_POST['textStDate']))." - ".date("F d, Y", strtotime($_POST['textEnDate']));
    }

    if($_POST['SelectSource'] <> ''){
        $sources = get_items_from_cache('source');
        $title_source = $sources[$_POST['SelectSource']];
    }else{
        $title_source = "ALL SOURCES";
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
    
        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%">
        
            <thead>
                <tr>
                    <th rowspan="2" width="10%"><img src="<?php echo BASE_URL;?>public/images/<?php echo COMPANY_LOGO;?>" /></th>
                    <th rowspan="2" width="80%" class="text-center">ENCODED APPLICANTS<br><?php echo $title_source;?><br>as of <?php echo $title_date;?></th>
                    <th width="10%" class="text-center">Form No.</th>
                </tr>
                <tr>
                    <th class="text-center">R1008-1</th>
                </tr>
            </thead>
        </table>

        <br>

        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%">
            <thead>
                <tr class="title">
                    <td width="5%" class="text-left"><strong>No.</strong></td>
                    <td width="40%" class="text-left"><strong>Name</strong></td>
                    <td width="5%" class="text-center"><strong>Gender</strong></td>
                    <td width="30%" class="text-left"><strong>Position</strong></td>
                    <td width="5%" class="text-center"><strong>Date Encoded</strong></td>
                    <td width="5%" class="text-center"><strong>Location</strong></td>
                    <td width="5%" class="text-center"><strong>Encoded By</strong></td>
                    <td width="5%" class="text-center"><strong>Source From</strong></td>
                </tr>
            </thead>
            <?php if($list && count($list)>0):?>
                <tbody>
                    <?php
                        $n = 0;
                        foreach($list as $e):
                            $n += 1;
                            $pos = explode("|", $e['position']);
                            $my_pos = $pos[0];

                            if(array_key_exists(1,$pos) && $pos[1] <> '-' && $pos[1] <> ''){
                                $my_pos .= ", ".$pos[1];
                            }
                    ?>
                            <tr>
                                <td class="text-left"><?php echo $n;?>.</td>
                                <td class="text-left"><?php echo nameformat($e['fname'], $e['mname'], $e['lname'],1);?></td>
                                <td class="text-center"><?php echo ($e['gender']=='M')?"Male":"Female";?></td>
                                <td class="text-left"><?php echo strtoupper($my_pos);?></td>
                                <td class="text-center"><?php echo dateformat($e['add_date']);?></td>
                                <td class="text-center"><?php echo $e['location'];?></td>
                                <td class="text-center"><?php echo $e['add_by']?></td>
                                <td class="text-center"><?php echo $e['source']?></td>
                            </tr>
                    <?php endforeach;?>
                </tbody>
            <?php endif;?>
        </table>

        <table>
            <tr valign="top">
                <td width="20%">Prepared By:<br><br><?php echo $_SESSION['rs_user']['name'];?></td>
                <td width="20%">Approved By:</td>
                <td width="20%">Checked By:</td>
                <td width="40%">&nbsp;</td>
            </tr>
        </table>

    </body>
</html>