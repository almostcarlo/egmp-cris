<?php
    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=accounts_monitoring.xls");
        header("Cache-Control: public");
    }
?>
<h3><?php echo $report_title;?></h3>
<strong><?php echo strtoupper($principal);?></strong>
<br>
<?php if(dateformat($_POST['textStDate']) && dateformat($_POST['textEnDate'])):?>
    <strong>Endorsement Date: <?php echo dateformat($_POST['textStDate'], 5);?> to <?php echo dateformat($_POST['textEnDate'], 5);?></strong>
<?php else:?>
    <strong>as of: <?php echo dateformat("today", 1);?></strong>
<?php endif;?>

<?php foreach($list_mr as $mr_id => $mr_ref):?>
    <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%" border="1">
        <tbody>
            <thead>
                <tr class="title">
                    <th colspan="99">MR REF: <?php echo $mr_ref;?></th>
                </tr>
            </thead>
            <tr>
                <td width="10%" class="text-left" rowspan="2"><strong>Name</strong></td>
                <?php foreach($list_particulars_by_payee as $payee => $particulars):?>
                    <td class="text-center" style="background-color:<?php echo $list_color_by_payee[$payee];?>" colspan="<?php echo count($particulars);?>"><strong><?php echo ucwords(strtolower($payee));?></strong></td>
                <?php endforeach;?>
                <td width="5%" class="text-center" rowspan="2"><strong>Total</strong></td>
            </tr>
            <tr>
                <?php foreach($list_particulars_by_payee as $payee => $particulars):?>
                    <?php foreach($particulars as $p_desc):?>
                        <td width="5%" class="text-center" style="background-color:<?php echo $list_color_by_payee[$payee];?>"><small><strong><?php echo $p_desc;?></strong></small></td>
                    <?php endforeach;?>
                <?php endforeach;?>
            </tr>
            <?php
                foreach($list_applicant[$mr_id] as $applicant_id => $a){
            ?>
                    <tr>
                        <td class="text-left"><?php echo $a['name'];?></td>
            <?php
                        $total_per_applicant = 0;
                        foreach($list_particulars_by_payee as $payee => $particulars){
                            foreach($particulars as $p_id => $p_desc){
            ?>
                                <td class="text-right" style="background-color:<?php echo $list_color_by_payee[$payee];?>">
            <?php
                                    if(isset($list_applicant_particulars[$applicant_id][$p_id])){
                                        if($payee == 'agency'){
                                            //echo "(".moneyformat($list_applicant_particulars[$applicant_id][$p_id]['amount']).")";
                                            $total_per_applicant -= floatval($list_applicant_particulars[$applicant_id][$p_id]['amount']);
                                        }else{
                                            //echo moneyformat($list_applicant_particulars[$applicant_id][$p_id]['amount']);
                                            $total_per_applicant += floatval($list_applicant_particulars[$applicant_id][$p_id]['amount']);
                                        }

                                        echo moneyformat($list_applicant_particulars[$applicant_id][$p_id]['amount']);
                                    }else{
                                        echo moneyformat(0);
                                    }
            ?>
                                </td>
            <?php
                            }
                        }
            ?>
                        <td class="text-right"><strong><?php echo moneyformat($total_per_applicant);?></strong></td>
                    </tr>
            <?php
                }
            ?>

            <!-- <tr>
                <td width="10%"><strong>Name</strong></td>
                <?php foreach($list_particulars as $p):?>
                    <td class="text-center" width="5%"><small><strong><?php echo strtoupper($p['name']);?></strong></small></td>
                <?php endforeach;?>
                <td width="5%" class="text-center"><strong>Total</strong></td>
            </tr> -->
            <?php
                /*foreach($list_applicant[$mr_id] as $applicant_id => $a){
            ?>
                    <tr>
                        <td class="text-left"><?php echo $a['name'];?></td>
            <?php
                        $total_per_applicant = 0;
                        foreach($list_particulars as $p){
            ?>
                            <td class="text-right">
            <?php
                            if(isset($list_applicant_particulars[$applicant_id][$p['id']])){
                                if($list_applicant_particulars[$applicant_id][$p['id']]['charge_to'] == 'agency'){
                                    echo "(".moneyformat($list_applicant_particulars[$applicant_id][$p['id']]['amount']).")";
                                    $total_per_applicant -= floatval($list_applicant_particulars[$applicant_id][$p['id']]['amount']);
                                }else{
                                    echo moneyformat($list_applicant_particulars[$applicant_id][$p['id']]['amount']);
                                    $total_per_applicant += floatval($list_applicant_particulars[$applicant_id][$p['id']]['amount']);
                                }
                            }else{
                                echo moneyformat(0);
                            }
            ?>
                            </td>
            <?php
                        }
            ?>
                        <td class="text-right"><strong><?php echo moneyformat($total_per_applicant);?></strong></td>
                    </tr>
            <?php
                }*/
            ?>
        </tbody>
    </table>
    <hr>
<?php endforeach;?>