<?php
    if(isset($acc_hdr[0]) && $acc_hdr[0]['clearance_by'] <> '' && $acc_hdr[0]['clearance_date'] <> '0000-00-00 00:00:00'){
        $user_info = getdata("select * from settings_users where username = '{$acc_hdr[0]['clearance_by']}'");
        $clearance_by = $user_info[0]['name'];
    }else{
        $clearance_by = "";
    }
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
        <thead>
            <tr>
                <th><img src="<?php echo BASE_URL;?>public/images/<?php echo COMPANY_LOGO;?>" /></th>
                <th class="text-right text-normal"><?php echo COMPANY_ADDRESS;?></th>
            </tr>
        </thead>
        <tbody>
        	<tr>
        		<td width="50%"><strong>APPLICANT'S ACCOUNTS RECORD FORM</strong></td>
        		<td width="50%" class="text-right"><strong>CONTROL NO.</strong> <?php echo str_pad($applicant_data['personal']->id, 10, 0, STR_PAD_LEFT);?></td>
        	</tr>
        	<tr>
        		<td colspan="2">
		            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
		                <thead>
		                    <tr class="title">
		                        <th colspan="8">APPLICANT DETAILS</th>
		                    </tr>
		                </thead>
		                <tbody>
		                    <tr>
		                        <td width="5%"><strong>NAME</strong></td>
		                        <td width="25%"><?php echo strtoupper(nameformat($applicant_data['personal']->fname, $applicant_data['personal']->mname, $applicant_data['personal']->lname, 1));?></td>
		                        <td width="5%"><strong>EMPLOYER</strong></td>
		                        <td width="50%" colspan="3"><?php echo $current_lineup[0]['principal'];?></td>
		                        <td width="5%"><strong>SALARY</strong></td>
		                        <td width="10%"><?php echo $current_lineup[0]['currency_code']." ".$current_lineup[0]['salary_amount']."/".$current_lineup[0]['salary_per'];?></td>
		                    </tr>
		                    <tr>
		                        <td><strong>POSITION</strong></td>
		                        <td><?php echo $current_lineup[0]['position'];?></td>
		                        <td><strong>CONTACT NO.</strong></td>
		                        <td><?php echo $applicant_data['personal']->mobile_no;?></td>
		                        <td width="10%"><strong>EXCHANGE RATE</strong></td>
		                        <td width="10%"></td>
		                        <td><strong>SOURCED</strong></td>
		                        <td>
		                        	<?php
		                        		if(strtolower($applicant_data['personal']->application_source) == 'agent'){
		                        			echo nameformat($applicant_data['personal']->agent_fname,$applicant_data['personal']->agent_mname,$applicant_data['personal']->agent_lname,1);
		                        		}else{
		                        			echo ucwords($applicant_data['personal']->application_source);
		                        		}
		                        	?>
	                        	</td>
		                    </tr>
		                </tbody>
		            </table>
        		</td>
    		</tr>
		</tbody>
    </table>

    <table class="table table-less" cellspacing="0">
        <tbody>
            <tr>
                <td width="50%" valign="top">
                    <table class="table table-bordered" width="50%" cellspacing="0" style="margin-bottom: 10px;">
                        <thead>
                            <tr class="title">
                                <th colspan="6">MEDICAL EXAMINATION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="25%" class="text-center"><strong>DESCRIPTION</strong></td>
                                <td width="25%" class="text-center"><strong>DATE</strong></td>
                                <td width="50%" class="text-center"><strong>REMARKS</strong></td>
                            </tr>
                            <tr>
                                <td class="text-center">get referral</td>
                                <td class="text-center"><?php echo (isset($medical[0]))?dateformat($medical[0]['clinic_ref_taken_date'],1):"&nbsp;";?></td>
                                <td class="text-center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="text-center">went to medical</td>
                                <td class="text-center"><?php echo (isset($medical[0]))?dateformat($medical[0]['clinic_exam_date'],1):"&nbsp;";?></td>
                                <td class="text-center">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered" width="50%" cellspacing="0" style="margin-bottom: 10px;">
                        <thead>
                            <tr class="title">
                                <th colspan="6">PLACEMENT FEE/DOCUMENTATION FEE</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="50%" class="text-center">One (1) month salary</td>
                                <td width="50%" class="text-center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="text-center">12% VAT</td>
                                <td class="text-center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="text-center">Documentation Fee</td>
                                <td class="text-center">&nbsp;</td>
                            </tr>
                            <tr>
                                <td class="text-center">Total</td>
                                <td class="text-center">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
                <td width="50%" valign="top">
                    <table class="table table-bordered" width="50%" cellspacing="0" style="margin-bottom: 10px;">
                        <thead>
                            <tr class="title">
                                <th colspan="6">OTHER REMARKS/NOTES</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td height="220px;" valign="top"><?php echo (isset($acc_hdr[0]['remarks']))?nl2br($acc_hdr[0]['remarks']):"";?></td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>

    <table class="table table-less" cellspacing="0">
        <tbody>
            <tr>
                <td>
                    <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                        <thead>
                            <tr class="title">
                                <th colspan="10">PAYMENT DETAILS</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td width="15%" class="text-center" rowspan="2"><strong>DATE</strong></td>
                                <td width="25%" class="text-left" rowspan="2"><strong>PARTICULARS</strong></td>
                                <td width="15%" class="text-right" colspan="3" style="padding-right:5%;"><strong>AMOUNT</strong></td>
                                <td width="15%" class="text-center" rowspan="2"><strong>PAYMENT METHOD</strong></td>
                                <td width="30%" class="text-left" rowspan="2"><strong>REFERENCE</strong></td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>Applicant</strong></td>
                                <td class="text-center"><strong>Client</strong></td>
                                <td class="text-center"><strong>Agency</strong></td>
                            </tr>
                            <?php
                                if($particulars){
                                    $total = 0;
                                    foreach($particulars as $p_k => $p_v){
                                        if($p_v['charge_to'] == 'agency'){
                                            $amount = "(".moneyformat($p_v['amount']).")";
                                            $total -= floatval($p_v['amount']);
                                        }else{
                                            $amount = moneyformat($p_v['amount']);
                                            $total += floatval($p_v['amount']);
                                        }
                            ?>
                                    <tr>
                                        <td class="text-center"><?php echo dateformat($p_v['add_date'], 5);?></td>
                                        <td><?php echo $p_v['particular'];?></td>
                                        <td class="text-right"><?php echo ($p_v['charge_to'] == 'applicant')?moneyformat($p_v['amount']):"";?></td>
                                        <td class="text-right"><?php echo ($p_v['charge_to'] == 'client')?moneyformat($p_v['amount']):"";?></td>
                                        <td class="text-right"><?php echo ($p_v['charge_to'] == 'agency')?"(".moneyformat($p_v['amount']).")":"";?></td>
                                        <td class="text-center"><?php echo $p_v['payment_method'];?></td>
                                        <td><?php echo $p_v['reference'];?></td>
                                    </tr>
                            <?php
                                    }
                                }
                            ?>
                            <tr>
                                <td colspan="2" class="text-right"><strong>TOTAL AMOUNT PAID</strong></td>
                                <td class="text-center" colspan="3"><strong><?php echo moneyformat($total);?></strong></td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                        <tbody>
                            <tr>
                                <td colspan="4"><strong>STATUS</strong></td>
                            </tr>
                            <tr>
                                <td width="10%"><strong>DEPLOYMENT DATE</strong></td>
                                <td width="40%"><?php echo dateformat($current_lineup[0]['deployment_date']);?></td>
                                <td width="10%"><strong>DATE ISSUED</strong></td>
                                <td width="40%"><?php echo dateformat("today", 1)?></td>
                            </tr>
                            <tr>
                                <td colspan="2">&nbsp;</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="2" class="text-center">CLEARED BY<br><?php echo $clearance_by;?></td>
                                <td colspan="2" class="text-center">APPROVED FOR DEPLOYMENT<br>General Manager</td>
                            </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
    
</body>
</html>