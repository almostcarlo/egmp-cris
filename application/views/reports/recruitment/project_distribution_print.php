<h3><?php echo $report_title;?></h3>
<?php if($list_mr):?>
	<?php foreach ($list_mr as $rs => $mr_info):?>
	
        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
            <thead>
                <tr class="title">
                    <th colspan="99"><?php echo $rs;?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="35%" class="text-center"><strong>Company</strong></td>
                    <td width="35%" class="text-center"><strong>MR</strong></td>
                    <td width="10%" class="text-center"><strong>Country</strong></td>
                    <td width="10%" class="text-center"><strong>Date Created</strong></td>
                    <td width="10%" class="text-center"><strong>Activity</strong></td>
                    <!-- <td width="10%" class="text-center"><strong>Total Lineup</strong></td> -->
                </tr>
                <?php foreach ($mr_info as $mr_id => $info):?>
                	<tr>
                		<td><?php echo strtoupper($info['principal']);?> <?php echo ($info['company']!='')?"- ".strtoupper($info['company']):"";?></td>
                		<td class="text-center"><?php echo $info['mr_ref'];?></td>
                		<td class="text-center"><?php echo $info['country'];?></td>
                		<td class="text-center"><?php echo dateformat($info['add_date'],0);?></td>
                		<td class="text-center"><?php echo $info['activity'];?></td>
                		<!-- <td class="text-center"><?php //echo (array_key_exists($mr_id,$list_lineup))?count($list_lineup[$mr_id]):"0";?></td> -->
                	</tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <hr>
	<?php endforeach;?>
<?php endif;?>