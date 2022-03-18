<?php
    $selected_row = explode(",", $_POST['h_rows']);

    function showCol($col){
        if($_POST['h_cols'] <> ''){
            $selected_col = explode(",", $_POST['h_cols']);
            if(!in_array($col, $selected_col)){
                echo "style=\"display:none\"";
            }
        }
    }
?>
<h3>Advance Status Report</h3>
<strong><?php echo strtoupper($mr_info['principal']);?> (<?php echo $mr_info['mr_ref'];?>)</strong>
<br>
<strong>as of: <?php echo dateformat("today", 1);?></strong>

<!-- REPORT SETTINGS -->
<!-- <button class="btn btn-default btn-sm btn-flat pull-right"><i class="fa fa-gear"></i> Report Settings</button> -->
<!-- <a href="../modals/modal-sending-status.php" rel="facebox" class="btn btn-default btn-sm btn-flat pull-right" style="text-decoration: none !important;"><i class="fa fa-gear"></i> Report Settings</a> -->

<?php
if($list_applicant){
    foreach($list_row as $row_name => $row_info){
        if(isset($list_applicant[$row_info[0]]) && (in_array($row_info[0], $selected_row) || $_POST['h_rows'] == '')){
?>
            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%">
                <thead>
                    <tr class="" style="background-color:<?php echo $row_info[1]?>; color:<?php echo $row_info[2]?>">
                        <th colspan="99"><?php echo $row_name;?> <small>(subtotal: <?php echo count($list_applicant[$row_info[0]]);?>)</small></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <?php foreach($list_col as $name => $attr):?>
                            <td <?php showCol($attr[0]);?> <?php echo ($attr[2]<>'')?$attr[2]:"";?>><strong><?php echo $name;?></strong></td>
                        <?php endforeach;?>
                    </tr>
<?php
                        foreach ($list_applicant[$row_info[0]] as $app_id => $info){
                            $int_adv = "";
                            $app_adv = "";
                            if(array_key_exists($info['applicant_id'],$all_adv)){
                                if(array_key_exists('internal',$all_adv[$info['applicant_id']])){
                                    $adv_i = reset($all_adv[$info['applicant_id']]['internal']);
                                    $int_adv = dateformat($adv_i['add_date'],1)." ".$adv_i['add_by'].": ".$adv_i['message'];
                                }
                            }
                            
                            if(array_key_exists($info['applicant_id'],$all_adv)){
                                if(array_key_exists('applicant',$all_adv[$info['applicant_id']])){
                                    $adv_a = reset($all_adv[$info['applicant_id']]['applicant']);
                                    $app_adv = dateformat($adv_a['add_date'],1)." ".$adv_a['add_by'].": ".$adv_a['message'];
                                }
                            }
?>
                    	<tr>
<?php
                            foreach($list_col as $name => $attr){
?>
                                <td <?php showCol($attr[0]);?> <?php echo ($attr[2]<>'')?$attr[2]:"";?>>
<?php
                                    switch($attr[0]){
                                        case 'col_name':
                                            echo "<a href=\"".BASE_URL."profile/".$info['applicant_id']."/overview\" target=\"_blank\">".nameformat($info['fname'], $info['mname'], $info['lname'],0)."</a>";
                                            break;
                                        case 'col_seldate':
                                            echo dateformat($info['select_date'],5);
                                            break;
                                        case 'col_appdate':
                                            echo dateformat($info['approval_date'],5);
                                            break;
                                        case 'col_nbistat':
                                            echo checkExpiry($info['nbi_expiry']);
                                            break;
                                        case 'col_nbiexp':
                                            echo dateformat($info['nbi_expiry'],5);
                                            break;
                                        case 'col_pptstat':
                                            echo checkExpiry($info['ppt_expiry']);
                                            break;
                                        case 'col_pptexp':
                                            echo dateformat($info['ppt_expiry'],5);
                                            break;
                                        // case 'col_medstat':
                                        //     echo checkExpiry($info['med_expiry']);
                                        //     break;
                                        case 'col_medexam':
                                            echo dateformat($info['exam_date'],5);
                                            break;
                                        case 'col_medexp':
                                            echo dateformat($info['med_expiry'],5);
                                            break;
                                        case 'col_intadv':
                                            echo $int_adv;
                                            break;
                                        case 'col_appadv':
                                            echo $app_adv;
                                            break;
                                        default:
                                            echo $info[$attr[3]];
                                    }
?>
                                </td>
<?php
                            }
?>
                    	</tr>
<?php
                        }
?>
                </tbody>
            </table>
            <hr>
<?php
        }
    }
}
?>

<!-- LEGEND -->
<table>
    <tr>
        <td width="50%">
            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%">
                <thead>
                    <tr>
                        <th>LEGEND</th>
                        <th>QTY</th>
                    </tr>
                </thead>
                <tbody>
<?php
                $lTotal = 0;
                foreach($list_row as $row_name => $row_info){
                    $this_count = (isset($list_applicant[$row_info[0]]))?count($list_applicant[$row_info[0]]):0;
?>
                    <tr style="background-color:<?php echo $row_info[1];?>; color:<?php echo $row_info[2];?>">
                        <td><?php echo ucwords(strtolower($row_name));?></td>
                        <td><?php echo $this_count;?></td>
                    </tr>
<?php
                    $lTotal += $this_count;
                }
?>
                    <tr class="">
                        <td>TOTAL</td>
                        <td><?php echo $lTotal;?></td>
                    </tr>
                </tbody>
            </table>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
<!-- END LEGEND -->