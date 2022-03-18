<?php
$ttl = 0;
if($list_principal){
    foreach ($list_principal as $id => $name){
        $ttl += count($list_applicant[$id]);
    }
}
?>
<h3>Status Monitoring Report</h3>
<strong>as of: <?php echo dateformat("today", 1);?></strong>
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
                        <th colspan="99"><?php echo strtoupper($p_name);?> <small>(subtotal: <?php echo count($list_applicant[$p_id]);?>)</small></th>
                    </tr>
                </thead>
                <tr>
                    <td width="10%"><strong>Name</strong></td>
                    <td width="10%"><strong>Position</strong></td>
                    <td class="text-center"><strong>MR Ref.</strong></td>
                    <td class="text-center"><strong>Select Date</strong></td>
                    <td class="text-center"><strong>Approval Date</strong></td>
                    <td class="text-center"><strong>NBI Status</strong></td>
                    <td class="text-center"><strong>NBI Expiry Date</strong></td>
                    <td class="text-center"><strong>PPT Status</strong></td>
                    <td class="text-center"><strong>PPT Expiry Date</strong></td>
                    <td class="text-center"><strong>Medical Status</strong></td>
                    <td class="text-center"><strong>Med Exam Date</strong></td>
                    <td class="text-center"><strong>Med Expiry Date</strong></td>
                    <td width="10%"><strong>Internal Advisory</strong></td>
                    <td width="10%"><strong>Applicant Advisory</strong></td>
                </tr>
                <?php
                    foreach ($list_applicant[$p_id] as $info){
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
                		<td><a href="<?php echo BASE_URL;?>profile/<?php echo $info['applicant_id'];?>/overview" target="_blank"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'],0);?></a></td>
                		<td class=""><?php echo $info['position'];?></td>
                		<td class="text-center"><?php echo $info['mr_ref'];?></td>
                		<td class="text-center"><?php echo dateformat($info['select_date'],1);?></td>
                		<td class="text-center"><?php echo dateformat($info['approval_date'],1);?></td>
                		<td class="text-center"><?php echo checkExpiry($info['nbi_expiry']);?></td>
                		<td class="text-center"><?php echo dateformat($info['nbi_expiry'],1);?></td>
                		<td class="text-center"><?php echo checkExpiry($info['ppt_expiry']);?></td>
                		<td class="text-center"><?php echo dateformat($info['ppt_expiry'],1);?></td>
                		<td class="text-center"><?php echo checkExpiry($info['med_expiry']);?></td>
                		<td class="text-center"><?php echo dateformat($info['exam_date'],1);?></td>
                		<td class="text-center"><?php echo dateformat($info['med_expiry'],1);?></td>
                        <td class=""><?php echo $int_adv;?></td>
                        <td class=""><?php echo $app_adv;?></td>
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
?>