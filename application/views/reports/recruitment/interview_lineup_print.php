<?php
    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=interview_lineup_sheet.xls");
        header("Cache-Control: public");
    }

    $detailed_hdr = array('IL' => 'Initial Lineup', 'FL' => 'Final Lineup', 'CL' => 'Confirmed Lineup');
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
                    <th rowspan="2" width="80%" class="text-center">INTERVIEW LINE-UP SHEET<br><?php echo $mr_info[0]['mr_ref'];?> - <?php echo $mr_info[0]['principal'];?><br>as of <?php echo dateformat($mr_info[0]['rec_date']);?></th>
                    <th width="10%" class="text-center">Form No.</th>
                </tr>
                <tr>
                    <th class="text-center">R1007</th>
                </tr>
            </thead>
        </table>

        <br>

        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%">
            <thead>
                <tr class="title">
                    <td width="5%" class="text-left"><strong>No.</strong></td>
                    <td width="30%" class="text-left"><strong>Name</strong></td>
                    <td width="10%" class="text-center"><strong>Gender</strong></td>
                    <td width="25%" class="text-left"><strong>Position</strong></td>
                    <td width="10%" class="text-center"><strong>Line-up Date</strong></td>
                    <td width="10%" class="text-center"><strong>Location</strong></td>
                    <td width="10%" class="text-center"><strong>Sourced By</strong></td>
                </tr>
            </thead>
            <?php if($list_pos && count($list_pos)>0):?>
                <tbody>
                    <?php
                        $n = 0;
                        foreach($list_pos as $p):
                            
                    ?>
                        <?php if(array_key_exists($p['id'], $list_lineup) && count($list_lineup[$p['id']])>0):?>
                            <?php foreach($list_lineup[$p['id']] as $a):
                                $n += 1;
                            ?>
                                <tr>
                                    <td class="text-left"><?php echo $n;?>.</td>
                                    <td class="text-left"><?php echo nameformat($a['fname'], $a['mname'], $a['lname'],1);?></td>
                                    <td class="text-center"><?php echo ($a['gender']=='M')?"Male":"Female";?></td>
                                    <td class="text-left"><?php echo $p['position'];?></td>
                                    <td class="text-center"><?php echo dateformat($a['add_date']);?></td>
                                    <td class="text-center"><?php echo $a['venue'];?></td>
                                    <td class="text-center"><?php echo $a['add_by']?></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                    <?php endforeach;?>
                </tbody>
            <?php endif;?>
        </table>

        <table>
            <tr>
                <td colspan="3">MR Assigned to:<br><br><?php echo $mr_info[0]['rs'];?></td>
                <td>Prepared By:<br><br><?php echo $_SESSION['rs_user']['name'];?></td>
            </tr>
        </table>

    </body>
</html>