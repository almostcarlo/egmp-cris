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
<h3>Medical Exam Taken - Summary</h3>

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
                    <td width="70%"><strong>MR Ref.</strong></td>
                    <td width="30%" class="text-center"><strong>Total</strong></td>
                </tr>
                <?php
                    
                    foreach ($list_mr[$p_id] as $k_mr => $v_mr){
                ?>
                	<tr>
                		<td><?php echo $v_mr;?></td>
                		<td class="text-center"><?php echo count($list_medical[$k_mr]);?></td>
                	</tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
<?php
    }
}
?>