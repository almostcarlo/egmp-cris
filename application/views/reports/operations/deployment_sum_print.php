<?php
    if($excel){
        header("Content-type: application/octet-stream");
        header("Content-Disposition: attachment; filename=deployment_summary_report.xls");
        header("Cache-Control: public");
    }
?>
<h3>Deployment Summary per Principal Report</h3>
<strong>Date Covered: <?php echo dateformat($_POST['textStDate'], 1);?> - <?php echo dateformat($_POST['textEnDate'], 1);?></strong>

<table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;" width="50%" border="1">
    <tbody>
        <tr>
            <td width="60%" class="text-left"><strong>Principal</strong></td>
            <td width="40%" class="text-center"><strong>Qty</strong></td>
        </tr>
        <?php
            $ttl = 0;
            foreach ($list_principal as $p_id => $p_name){
        ?>
        	<tr>
        		<td><?php echo strtoupper($p_name);?></td>
        		<td class="text-center"><?php echo count($list_deployed[$p_id]);?></td>
        	</tr>
        <?php
                $ttl += count($list_deployed[$p_id]);
            }
        ?>
        	<tr>
        		<td><strong>TOTAL</strong></td>
        		<td class="text-center"><strong><?php echo $ttl;?></strong></td>
        	</tr>
    </tbody>
</table>