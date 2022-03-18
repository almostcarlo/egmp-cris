<?php
    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=deployment_detailed_report.xls");
        header("Cache-Control: public");
    }

    $ttl = 0;
    if($list_principal){
        foreach ($list_principal as $id => $name){
            $ttl += count($list_deployed[$id]);
        }
    }
?>
<h3>Deployment Detailed per Principal Report</h3>
<strong>Date Covered: <?php echo dateformat($_POST['textStDate'], 1);?> - <?php echo dateformat($_POST['textEnDate'], 1);?></strong>
<br>
<strong>Total No. of Applicants Deployed: <?php echo $ttl;?></strong>

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
                    <td width="25%"><strong>Name</strong></td>
                    <td width="25%"><strong>Position</strong></td>
                    <td width="25%" class="text-center"><strong>MR Ref.</strong></td>
                    <td width="25%" class="text-center"><strong>Deployment Date</strong></td>
                </tr>
                <?php
                    
                    foreach ($list_deployed[$p_id] as $info){
                ?>
                	<tr>
                		<td><a href="<?php echo BASE_URL;?>profile/<?php echo $info['applicant_id'];?>/deployment" target="_blank"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'],0);?></a></td>
                		<td class=""><?php echo $info['position'];?></td>
                		<td class="text-center"><?php echo $info['mr_ref'];?></td>
                		<td class="text-center"><?php echo dateformat($info['deployment_date'],0);?></td>
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