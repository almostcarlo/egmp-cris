<?php
    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=candidate_in_processing.xls");
        header("Cache-Control: public");
    }

    if($_POST['SelectSource'] <> ''){
        $this_source = "";
    }else{
        $this_source = "ALL SOURCES";
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
                    <th rowspan="2" width="80%" class="text-center">CANDIDATE IN PROCESS<br><?php echo $this_source;?><br>as of <?php echo date("F d, Y")?></th>
                    <th width="10%" class="text-center">Form No.</th>
                </tr>
                <tr>
                    <th class="text-center">R1009</th>
                </tr>
            </thead>
        </table>

        <br>

        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
            <thead>
                <tr>
                    <th>No.</th>
                    <th width="20%">Name</th>
                    <th width="20%">Client</th>
                    <th>Project Name</th>
                    <th width="15%">Position</th>
                    <th class="text-center">Salary</th>
                    <th class="text-center">Source From</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($list) > 0):?>
                    <?php
                        $n = 0;
                        foreach($list as $l):
                            $n+=1;
                    ?>
                        <tr>
                            <td><?php echo $n;?></td>
                            <td><?php echo nameformat($l['fname'], $l['mname'], $l['lname']);?></td>
                            <td><?php echo $l['principal'];?></td>
                            <td><?php echo $l['project'];?></td>
                            <td><?php echo $l['position'];?></td>
                            <td class="text-center"><?php echo "[SALARY]";?></td>
                            <td class="text-center"><?php echo $l['source'];?></td>
                            <td>&nbsp;</td>
                        </tr>
                    <?php endforeach;?>
                <?php endif;?>
            </tbody>
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