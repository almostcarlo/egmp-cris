<h3>Project Distribution - Operations</h3>

<?php if($list_mr):?>
	<?php foreach ($list_mr as $rs => $mr_info):?>
		
	
        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
            <thead>
                <tr class="title">
                    <th colspan="99"><?php echo ($rs<>'')?$rs:"N/A";?></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td width="30%" class="text-center"><strong>Company</strong></td>
                    <td width="30%" class="text-center"><strong>MR</strong></td>
                    <td width="10%" class="text-center"><strong>Country</strong></td>
                    <td width="10%" class="text-center"><strong>RS</strong></td>
                    <td width="10%" class="text-center"><strong>Active Qty</strong></td>
                    <td width="10%" class="text-center"><strong>Weekly Schedule</strong></td>
                </tr>
                <?php foreach ($mr_info as $mr_id => $info):?>
                	<tr>
                		<td><?php echo strtoupper($info['principal']);?> <?php echo ($info['company']!='')?"- ".strtoupper($info['company']):"";?></td>
                		<td class="text-center"><?php echo $info['mr_ref'];?></td>
                		<td class="text-center"><?php echo $info['country'];?></td>
                        <td class="text-center"><?php echo $info['rs_user'];?></td>
                		<td class="text-center"><?php echo (array_key_exists($mr_id,$list_lineup))?count($list_lineup[$mr_id]):"0";?></td>
                        <td class="text-center"><?php echo ($info['weekly_sched']<>0)?$sched_list[$info['weekly_sched']]:"N/A";?></td>
                	</tr>
                <?php endforeach;?>
            </tbody>
        </table>
        <hr>
	<?php endforeach;?>
<?php endif;?>