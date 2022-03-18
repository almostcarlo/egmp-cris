<section role="main" class="content-body">
                    
	<header class="page-header">
		<h2>Reports - Recruitment</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-12">
            
			<section class="panel">
                <header class="panel-heading">
                	<a href="<?php echo BASE_URL;?>print/reports/recruitment/project_distribution" target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-file"></i> Print</a>
					<h3 class="panel-title">Project Distribution Report</h3>
				</header>
				<div class="panel-body">
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
                                    		<td class="text-center"><a href="<?php echo BASE_URL;?>recruitment/forms/form_mr_manager/<?php echo $mr_id;?>" target="_blank"><?php echo $info['mr_ref'];?></a></td>
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
                    
                </div>
            </section>
            
		</div>

	</div>
	<!-- end: page -->
</section>