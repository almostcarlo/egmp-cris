<section role="main" class="content-body">
                    
	<header class="page-header">
		<h2>Reports - Operations</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-12">
            
			<section class="panel">
                <header class="panel-heading">
                	<a href="<?php echo BASE_URL;?>reports_operations/print_report/project_distribution" target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-file"></i> Print</a>
					<h3 class="panel-title">Project Distribution Per RSO</h3>
				</header>
				<div class="panel-body">
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
                                        <!-- <td width="10%" class="text-center"><strong>Date Created</strong></td> -->
                                        <!-- <td width="10%" class="text-center"><strong>Activity</strong></td> -->
                                        <td width="10%" class="text-center"><strong>RS</strong></td>
                                        <td width="10%" class="text-center"><strong>Active Qty</strong></td>
                                        <td width="10%" class="text-center"><strong>Weekly Schedule</strong></td>
                                    </tr>
                                    <?php foreach ($mr_info as $mr_id => $info):?>
                                    	<tr>
                                    		<td><?php echo strtoupper($info['principal']);?> <?php echo ($info['company']!='')?"- ".strtoupper($info['company']):"";?></td>
                                    		<td class="text-center"><a href="<?php echo BASE_URL;?>recruitment/forms/form_mr_manager/<?php echo $mr_id;?>/applicants" target="_blank"><?php echo $info['mr_ref'];?></a></td>
                                    		<td class="text-center"><?php echo $info['country'];?></td>
                                    		<!-- <td class="text-center"><?php echo dateformat($info['add_date'],0);?></td> -->
                                    		<td class="text-center"><?php echo $info['rs_user'];?></td>
                                    		<td class="text-center"><?php echo (array_key_exists($mr_id,$list_lineup))?count($list_lineup[$mr_id]):"0";?></td>
                                            <td class="text-center">
                                                <a href="javascript:void(0);" id="link_<?php echo $mr_id;?>" onclick="$('#selectSched_<?php echo $mr_id;?>').removeClass('hidden'); $(this).addClass('hidden');"><?php echo ($info['weekly_sched']<>0)?$sched_list[$info['weekly_sched']]:"N/A";?></a>
                                                <select name="selectSched" id="selectSched_<?php echo $mr_id;?>" onchange="update_mr_weekly_sched('<?php echo $mr_id;?>');" class="form-control input-sm hidden">
                                                    <option value="0">N/A</option>
                                                    <?php generate_dd($sched_list, $info['weekly_sched'], TRUE, FALSE)?>
                                                </select>
                                            </td>
                                    	</tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                            <hr>
						<?php endforeach;?>
					<?php endif;?>
                    
                </div>
            </section>
            
		</div>

	</div>
	<!-- end: page -->
</section>