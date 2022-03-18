<?php
    $position_list = get_items_from_cache('position');
    $currency_list = get_items_from_cache('currency');
    $mr_list = get_items_from_cache('mr');
?>
<section class="panel">
    <header class="panel-heading">
        <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/jo'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Job Openings</a>
		<h3 class="panel-title">Job Openings</h3>
	</header>
	<div class="panel-body">

        <div id="jobs_tab_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
            <strong>ERROR!</strong><br>
            <div id="jobs_tabNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
        </div>
        
        <table class="table table-striped table-condensed table-hover">
            <thead>
                <tr>
                    <th>Position</th>
                    <?php if(MR_REQUIRED):?><th>MR REF.</th><?php endif;?>
                    <th class="text-center">Required</th>
                    <?php if(MR_REQUIRED):?><th class="text-center">Target</th><?php endif;?>
                    <th class="text-center">Status</th>
                    <th class="text-center">Gender</th>
                    <th class="text-center">Salary</th>
                    <?php if(MR_REQUIRED):?><th class="text-center">Food</th><?php endif;?>
                    <th class="text-center">Religion</th>
                    <th class="text-center">Expiry Date</th>
					<th width="150" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            	<?php if($data):?>
            		<?php foreach ($data as $info):?>
            			<?php
            			     if($info['status']==1){
            			         $status = 'Active';
            			     }else if($info['status']==2){
            			         $status = 'On Hold';
            			     }else{
            			         $status = 'Closed';
            			     }
            			?>
                        <tr>
                            <td><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/jo/<?php echo $info['id'];?>'});"><?php echo $position_list[$info['pos_id']];?></a></td>
                            <?php if(MR_REQUIRED):?><td><?php echo (isset($mr_list[$info['mr_id']]))?$mr_list[$info['mr_id']]:"";?></td><?php endif;?>
                            <td class="text-center"><?php echo $info['required'];?></td>
                            <?php if(MR_REQUIRED):?><td class="text-center"><?php echo $info['target'];?></td><?php endif;?>
                            <td class="text-center"><?php echo $status;?></td>
                            <td class="text-center"><?php echo $info['gender'];?></td>
                            <td class="text-center"><?php echo ($info['salary_curr']<>0)?$currency_list[$info['salary_curr']]." ".$info['salary_amt']:"";?></td>
                            <?php if(MR_REQUIRED):?><td class="text-center"><?php echo $info['allowance_type'];?> <?php echo $info['allowance_amt'];?></td><?php endif;?>
                            <td class="text-center"><?php echo $info['religion'];?></td>
                            <td class="text-center"><?php echo dateformat($info['expiry_date'],1);?></td>
                            <td class="actions text-center">
                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/jo/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="javascript:void(0);" onclick="settingsAjaxDelete('manager_jobs', '<?php echo $info['id'];?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
                    <?php endforeach;?>
				<?php else:?>
					<tr>
						<td>no record found.</td>
					</tr>
                <?php endif;?>
            </tbody>
        </table>
        
    </div>
</section>