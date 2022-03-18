<?php
    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=welfare_report.xls");
        header("Cache-Control: public");
    }

    $ttl = 0;
    if($list_principal){
        foreach ($list_principal as $id => $name){
            $ttl += count($list_deployed[$id]);
        }
    }
?>
<h3>Welfare Report</h3>
<strong>Date Covered: <?php echo dateformat($_POST['textStDate'], 1);?> - <?php echo dateformat($_POST['textEnDate'], 1);?></strong>
<br>
<strong>Total No. of Applicants: <?php echo $ttl;?></strong>

<?php
if($list_principal){
    foreach ($list_principal as $p_id => $p_name){
?>
        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%" border="1">
            <tbody>
                <thead>
                    <tr class="title">
                        <th colspan="99"><?php echo strtoupper($p_name);?> <small>(subtotal: <?php echo count($list_deployed[$p_id]);?>)</small></th>
                    </tr>
                </thead>
                <tr>
                    <td width="5%" class="text-center"><strong>Status</strong></td>
                    <td width="15%"><strong>Name</strong></td>
                    <td width="17%"><strong>Principal</strong></td>
                    <td width="17%"><strong>Position</strong></td>
                    <td width="10%" class="text-center"><strong>Deployment Date</strong></td>
                    <td width="6%" class="text-center"><strong>Contract Duration</strong></td>
                    <td width="10%" class="text-center"><strong>Country</strong></td>
                    <td width="20%"><strong>Final Action/Remarks</strong></td>
                </tr>
                <?php
                    
                    foreach ($list_deployed[$p_id] as $info){
                ?>
                	<tr>
                        <td class="text-center"><?php echo $info['case_status'];?></td>
                		<td><?php echo nameformat($info['fname'], $info['mname'], $info['lname'],0);?></td>
                        <td class=""><?php echo $info['principal'];?></td>
                		<td class=""><?php echo $info['position'];?></td>
                		<td class="text-center"><?php echo dateformat($info['deployment_date'],0);?></td>
                        <td class="text-center"><?php echo $info['contract_period'];?></td>
                        <td class="text-center"><?php echo $info['country'];?></td>
                        <td class=""><?php echo $info['final_action'];?></td>
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