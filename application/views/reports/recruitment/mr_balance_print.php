<?php
    if(empty($mr_info)){
        echo "<script>alert('Please select MR');window.close();</script>";
    }

    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=mr_balance.xls");
        header("Cache-Control: public");
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
                    <th rowspan="2" width="80%" class="text-center">MAN POWER REQUEST BALANCE SHEET<br><?php echo $mr_info[0]['principal'];?><br>MR NO.: <?php echo $mr_info[0]['mr_ref'];?></th>
                    <th width="10%" class="text-center">Form No.</th>
                </tr>
                <tr>
                    <th class="text-center">R1005</th>
                </tr>
            </thead>
        </table>

        <br>

        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%">
        
            <thead>
                <tr>
                    <th width="10%">Date Received</th>
                    <th width="20%"><?php echo dateformat($mr_info[0]['rec_date']);?></th>
                    <th width="10%">Project Name</th>
                    <th width="60%"><?php echo $mr_info[0]['project'];?></th>
                </tr>
                <tr>
                    <th>Due Date</th>
                    <th><?php echo dateformat($mr_info[0]['expiry_date']);?></th>
                    <th>Country</th>
                    <th><?php echo $mr_info[0]['country'];?></th>
                </tr>
            </thead>
        </table>

        <br>

        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%">
            <thead>
                <tr class="title">
                    <td class="text-left"><strong>NO.</strong></td>
                    <td class="text-left"><strong>POSITION</strong></td>
                    <td class="text-center"><strong>REQUIREMENT</strong></td>
                    <td class="text-center"><strong>LINE-UP</strong></td>
                    <td class="text-center"><strong>SERVED</strong></td>
                    <td class="text-center"><strong>BALANCE</strong></td>
                    <td class="text-center"><strong>SALARY</strong></td>
                </tr>
            </thead>
            <?php if($pos_info && count($pos_info)>0):?>
                <tbody>
                    <?php
                        $n = 0;
                        foreach($pos_info as $mr_pos_id => $e):
                            $n += 1;
                            $bal = 0;
                            $nlineup = 0;
                            $ndeployed = 0;

                            if(array_key_exists($mr_pos_id, $lineup)){
                                $nlineup = count($lineup[$mr_pos_id]);
                            }

                            if(array_key_exists($mr_pos_id, $deployed)){
                                $ndeployed = count($deployed[$mr_pos_id]);
                            }

                            $bal = intval($e['required']) - intval($ndeployed);
                    ?>
                            <tr>
                                <td class="text-left"><?php echo $n;?>.</td>
                                <td class="text-left"><?php echo $e['position'];?></td>
                                <td class="text-center"><?php echo $e['required'];?></td>
                                <td class="text-center"><?php echo $nlineup;?></td>
                                <td class="text-center"><?php echo $ndeployed;?></td>
                                <td class="text-center"><?php echo $bal;?></td>
                                <td class="text-center"><?php echo $e['salary']?></td>
                            </tr>
                    <?php endforeach;?>
                </tbody>
            <?php endif;?>
        </table>

    </body>
</html>