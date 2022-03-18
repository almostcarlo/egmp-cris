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
<h3>Awaiting Result Applicants - Detailed</h3>

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
                    <td width="10%"><strong>MR Ref.</strong></td>
                    <td width="14%"><strong>Name</strong></td>
                    <td width="5%" class="text-center"><strong>Referral Date</strong></td>
                    <td width="5%" class="text-center"><strong>Exam Date</strong></td>
                    <td width="5%" class="text-center"><strong>Result</strong></td>
                    <td width="22%"><strong>Clinic</strong></td>
                    <td width="22%"><strong>Findings</strong></td>
                    <td width="22%"><strong>Clinic Remarks</strong></td>
                </tr>
                <?php
                    $n = 0;
                    foreach ($list_mr[$p_id] as $k_mr => $v_mr){
                        foreach ($list_medical[$k_mr] as $k_applicant => $v_applicant){
                ?>
                        	<tr>
                                <td><?php echo $v_mr;?></td>
                                <td><?php echo nameformat($v_applicant['fname'], $v_applicant['mname'], $v_applicant['lname']);?></td>
                                <td class="text-center"><?php echo dateformat($v_applicant['clinic_ref_taken_date'],1);?></td>
                                <td class="text-center"><?php echo dateformat($v_applicant['clinic_exam_date'],1);?></td>
                                <td class="text-center"><?php echo ($v_applicant['med_result']!='')?$v_applicant['med_result']:"awaiting result";?></td>
                        		<td><?php echo $v_applicant['clinic'];?></td>
                                <td><?php echo $v_applicant['med_result_findings'];?></td>
                                <td><?php echo $v_applicant['med_result_clinic_remarks'];?></td>
                        	</tr>
                <?php
                            $n++;
                        }
                    }
                ?>
                <tr>
                    <td><strong>TOTAL</strong></td>
                    <td colspan="10"><strong><?php echo $n;?></strong></td>
                </tr>
            </tbody>
        </table>
<?php
    }
}
?>