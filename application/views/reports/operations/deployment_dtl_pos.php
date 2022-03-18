<?php
    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=candidate_in_processing.xls");
        header("Cache-Control: public");
    }

    $ttl = 0;
    if(is_array($positions)){
        foreach ($positions as $p_id => $p){
            $ttl += count($deployed_by_pos[$p_id]);
        }
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
                    <th rowspan="2" width="70%" class="text-center">DEPLOYED APPLICANTS<br>BY POSITION<br>as of <?php echo date("M d, Y", strtotime($_POST['textStDate']))?>-<?php echo date("M d, Y", strtotime($_POST['textEnDate']))?></th>
                    <th rowspan="2" width="10%" class="text-center">TOTAL DEPLOYMENT<br><?php echo $ttl;?></th>
                    <th width="10%" class="text-center">Form No.</th>
                </tr>
                <tr>
                    <th class="text-center">M1001-1</th>
                </tr>
            </thead>
        </table>

        <br>

        <?php if(is_array($positions) && count($positions) > 0):?>
            <?php foreach($positions as $p_id => $p):?>
                <p><strong><?php echo $p;?></strong></p>
                <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th width="20%">Name</th>
                            <th class="text-center">MR No.</th>
                            <th class="text-center">Date Selected</th>
                            <th class="text-center">Date Deployed</th>
                            <th class="text-center">Actual Salary</th>
                            <th width="20%">Employer</th>
                            <th width="15%">Position</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if($deployed_by_pos[$p_id] && count($deployed_by_pos[$p_id]) > 0):?>
                            <?php
                                $n = 0;
                                foreach($deployed_by_pos[$p_id] as $l):
                                    $n+=1;
                            ?>
                                <tr>
                                    <td><?php echo $n;?></td>
                                    <td><?php echo nameformat($l['fname'], $l['mname'], $l['lname']);?></td>
                                    <td class="text-center"><?php echo $l['mr_ref'];?></td>
                                    <td class="text-center"><?php echo dateformat($l['select_date'],2);?></td>
                                    <td class="text-center"><?php echo dateformat($l['deployment_date'],2);?></td>
                                    <td class="text-center"><?php echo $l['salary'];?></td>
                                    <td><?php echo strtoupper($l['principal']);?></td>
                                    <td><?php echo strtoupper($l['position']);?></td>
                                </tr>
                            <?php endforeach;?>
                        <?php endif;?>
                        <tr>
                            <td class="text-center" colspan="8"><strong>TOTAL: <?php echo $n;?></strong></td>
                        </tr>
                    </tbody>
                </table>
                <hr>
            <?php endforeach;?>
        <?php endif;?>

        <!-- <table>
            <tr valign="top">
                <td width="20%">Prepared By:<br><br><?php echo $_SESSION['rs_user']['name'];?></td>
                <td width="20%">Approved By:</td>
                <td width="20%">Checked By:</td>
                <td width="40%">&nbsp;</td>
            </tr>
        </table> -->

    </body>
</html>