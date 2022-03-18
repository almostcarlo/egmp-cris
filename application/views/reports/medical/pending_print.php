<?php
    $ttl = 0;
    if($list_principal){
        foreach ($list_principal as $p_id => $p_name){
            foreach ($list_mr[$p_id] as $mr_id => $mr_name){
                $ttl += count($list_medical[$mr_id]);
            }
        }
    }
?>
<h3>Pending Result - Summary</h3>

<?php if($_POST['SelectClinic'] && isset($clinics[$_POST['SelectClinic']])):?>
    <strong>Clinic: <?php echo $clinics[$_POST['SelectClinic']];?></strong>
    <br>
<?php endif;?>

<strong>Date Covered: <?php echo dateformat($_POST['textStDate'], 1);?> - <?php echo dateformat($_POST['textEnDate'], 1);?></strong>
<br>
<strong>Total No. of Applicants: <?php echo $ttl;?></strong>

<?php
if($list_principal){
    foreach ($list_principal as $p_id => $p_name){
?>
        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%">
            <tbody>
                <thead>
                    <tr class="title">
                        <th colspan="99"><?php echo $p_name;?></th>
                    </tr>
                </thead>
                <tr>
                    <td width="50%"><strong>MR Ref.</strong></td>
                    <td width="25%" class="text-center"><strong>Pending</strong></td>
                    <td width="25%" class="text-center"><strong>Awaiting Result</strong></td>
                </tr>
                <?php
                    $n_pending = 0;
                    $n_awaiting_result = 0;
                    foreach ($list_mr[$p_id] as $k_mr => $v_mr){
                ?>
                    <tr>
                        <td><?php echo $v_mr;?></td>
                        <td class="text-center"><?php echo (isset($list_per_result[$k_mr]['pending']))?count($list_per_result[$k_mr]['pending']):"0";?></td>
                        <td class="text-center"><?php echo (isset($list_per_result[$k_mr]['awaiting_result']))?count($list_per_result[$k_mr]['awaiting_result']):"0";?></td>
                    </tr>
                <?php
                        $n_pending += (isset($list_per_result[$k_mr]['pending']))?count($list_per_result[$k_mr]['pending']):"0";
                        $n_awaiting_result += (isset($list_per_result[$k_mr]['awaiting_result']))?count($list_per_result[$k_mr]['awaiting_result']):"0";;
                    }
                ?>
                <tr>
                    <td><strong>TOTAL</strong></td>
                    <td class="text-center"><strong><?php echo $n_pending;?></strong></td>
                    <td class="text-center"><strong><?php echo $n_awaiting_result;?></strong></td>
                </tr>
            </tbody>
        </table>
<?php
    }
}
?>