<?php
    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=daily_cash.xls");
        header("Cache-Control: public");
    }

    $payment_method = get_items_from_cache('payment_method');
    $principal = get_items_from_cache('principal');
?>
<h3><?php echo $report_title;?></h3>

<?php if(dateformat($_POST['textStDate']) && dateformat($_POST['textEnDate'])):?>
    <strong>Payment Date: <?php echo dateformat($_POST['textStDate'], 5);?> to <?php echo dateformat($_POST['textEnDate'], 5);?></strong>
    <br>
<?php else:?>
    <strong>Payment Date: <?php echo dateformat("today", 5);?> to <?php echo dateformat("today", 5);?></strong>
    <br>
<?php endif;?>

<?php if($_POST['SelectPrincipal']<>''):?>
    <strong><?php echo strtoupper($principal[$_POST['SelectPrincipal']]);?></strong>
    <br>
<?php endif;?>

<?php if($_POST['SelectPayment']<>''):?>
    <strong>Payment Method: <?php echo strtoupper($payment_method[$_POST['SelectPayment']]);?></strong>
<?php endif;?>

<?php if(count($list_applicant) > 0):?>
    <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%" border="1">
        <thead>
            <tr class="title">
                <th width="10%" class="text-left"><strong>Name</strong></th>
                <?php foreach($list_particulars_by_payee['applicant'] as $p_desc):?>
                    <th width="5%" class="text-center"><small><strong><?php echo $p_desc;?></strong></small></th>
                <?php endforeach;?>
                <th width="5%" class="text-center"><strong>Total</strong></th>
            </tr>
        </thead>
        <tbody>
        <?php
            $g_total = 0;
            foreach($list_applicant as $applicant_id => $a){
        ?>
                <tr>
                    <td class="text-left"><?php echo $a['name'];?></td>
        <?php
                    $total_per_applicant = 0;
                        foreach($list_particulars_by_payee['applicant'] as $p_id => $p_desc){
        ?>
                            <td class="text-right">
        <?php
                                if(isset($list_applicant_particulars[$applicant_id][$p_id])){
                                    $total_per_applicant += floatval($list_applicant_particulars[$applicant_id][$p_id]['amount']);
                                    echo moneyformat($list_applicant_particulars[$applicant_id][$p_id]['amount']);
                                }else{
                                    echo moneyformat(0);
                                }
        ?>
                            </td>
        <?php
                        }
                    // }
        ?>
                    <td class="text-right"><strong><?php echo moneyformat($total_per_applicant);?></strong></td>
                </tr>
        <?php
                $g_total += $total_per_applicant;
            }
        ?>
            <tr class="title">
                <td colspan="<?php echo intval(count($list_particulars_by_payee['applicant'])+1);?>"><strong>Total</strong></td>
                <td class="text-right"><strong><?php echo moneyformat($g_total);?></strong></td>
            </tr>
        </tbody>
    </table>
<?php else:?>
    <p class="danger">No record found</p>
<?php endif;?>
<hr>