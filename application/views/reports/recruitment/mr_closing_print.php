<?php
    if(empty($mr_info)){
        echo "<script>alert('Please select MR');window.close();</script>";
    }

    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=mr_closing_summary.xls");
        header("Cache-Control: public");
    }

    $total_req = 0;
    foreach($pos_info as $p){
        $total_req += intval($p['required']);
    }

    $interview_status = array('Show-up' => 'Show-up',
                                'Selected' => 'Selected',
                                'Thinking' => 'Thinking',
                                'Decline' => 'Decline',
                                'On-hold' => 'On-hold',
                                'Backup' => 'Backup',
                                'Accepted' => 'Accepted',
                                'Deployed' => 'Deployed',
                                'Not Selected' => 'Not Selected',
                                'Back-out' => 'Back-out',
                                'Blacklisted' => 'Blacklisted');
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
                    <th rowspan="2" width="80%" class="text-center">MR CLOSING SUMMARY<br><?php echo $mr_info[0]['principal'];?></th>
                    <th width="10%" class="text-center">Form No.</th>
                </tr>
                <tr>
                    <th class="text-center">R1006</th>
                </tr>
            </thead>
        </table>

        <br>

        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%">
        
            <thead>
                <tr>
                    <th>Project Name:</th>
                    <th><?php echo $mr_info[0]['project'];?></th>
                    <th>MR No.:</th>
                    <th><?php echo $mr_info[0]['mr_ref'];?></th>
                    <th>MR Issued Date:</th>
                    <th><?php echo dateformat($mr_info[0]['rec_date']);?></th>
                    <th>MR Date Closed:</th>
                    <th><?php echo dateformat($mr_info[0]['expiry_date']);?></th>
                    <th>Total Req.:</th>
                    <th><?php echo $total_req;?></th>
                </tr>
            </thead>
        </table>

        <br>

        <table cellpadding="0" cellspacing="0">
            <tr valign="top">
                <td width="50%">
                    <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                        <thead>
                            <tr>
                                <th width="33%" class="text-center">Total Requirements</th>
                                <th width="33%" class="text-center">Total Served</th>
                                <th width="34%" class="text-center">Total Unserved</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center"><?php echo $total_req;?></td>
                                <td class="text-center"><?php echo $deployed;?></td>
                                <td class="text-center"><?php echo $total_req-$deployed;?></td>
                            </tr>
                        </tbody>
                    </table>

                    <br>

                    <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                        <thead>
                            <tr>
                                <th class="text-center" width="33%">Total Line-up</th>
                                <th class="text-center" width="33%"><?php echo $lineup;?></th>
                                <th class="text-center" width="34%">100%</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach($interview_status as $i):
                                    $this_stat_total = 0;
                                    $this_percentage = 0;
                                    if(array_key_exists($i, $lineup_per_stat)){
                                        $this_stat_total = count($lineup_per_stat[$i]);
                                        $this_percentage = intval(count($lineup_per_stat[$i]))/$lineup*100;
                                        $this_percentage = number_format($this_percentage,2);
                                    }
                            ?>
                                <tr>
                                    <td class="text-center"><?php echo $i;?></td>
                                    <td class="text-center"><?php echo $this_stat_total;?></td>
                                    <td class="text-center"><?php echo $this_percentage;?>%</td>
                                </tr>
                            <?php endforeach;?>
                        </tbody>
                    </table>
                </td>
                <td><strong>COMMENTS</strong></td>
            </tr>
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