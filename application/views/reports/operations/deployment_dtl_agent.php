<?php
    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=deployment_detailed_report.xls");
        header("Cache-Control: public");
    }

    $ttl = 0;
    if($list_agents){
        foreach ($list_agents as $id => $name){
            $ttl += count($list_deployed_per_agent[$id]);
        }
    }
?>
<h3>Deployment Detailed per Agent</h3>
<strong>Date Covered: <?php echo dateformat($_POST['textStDate'], 1);?> - <?php echo dateformat($_POST['textEnDate'], 1);?></strong>
<br>
<strong>Total No. of Applicants Deployed: <?php echo $ttl;?></strong>

<?php
if($list_agents){
    foreach ($list_agents as $a_id => $a_name){
?>
        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%" border="1">
            <tbody>
                <thead>
                    <tr class="title">
                        <th colspan="99"><?php echo strtoupper($a_name);?> <small>(subtotal: <?php echo count($list_deployed_per_agent[$a_id]);?>)</small></th>
                    </tr>
                </thead>
                <tr>
                    <td ><strong>Name</strong></td>
                    <td ><strong>Position</strong></td>
                    <td class="text-center"><strong>MR Ref.</strong></td>
                    <td class="text-center"><strong>Deployment Date</strong></td>
                    <td width="10%" class="text-center"><strong>Agent Referral Amount</strong></td>
                </tr>
                <?php
                    $total_per_agent = 0;
                    foreach ($list_deployed_per_agent[$a_id] as $info){
                ?>
                	<tr>
                		<td><a href="<?php echo BASE_URL;?>profile/<?php echo $info['applicant_id'];?>/deployment" target="_blank"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'],0);?></a></td>
                		<td class=""><?php echo $info['position'];?></td>
                		<td class="text-center"><?php echo $info['mr_ref'];?></td>
                		<td class="text-center"><?php echo dateformat($info['deployment_date'],0);?></td>
                        <td class="text-right" style="padding-right: 30px !important;"><?php echo moneyformat($info['ref_amount'],2);?></td>
                	</tr>
                <?php
                        $total_per_agent += $info['ref_amount'];
                    }
                ?>
                <tr>
                    <td class="text-right" style="padding-right: 30px !important;" colspan="4">TOTAL</td>
                    <td class="text-right" style="padding-right: 30px !important;"><strong><?php echo moneyformat($total_per_agent,2);?></strong></td>
                </tr>
            </tbody>
        </table>
        <hr>
<?php
    }
}
?>