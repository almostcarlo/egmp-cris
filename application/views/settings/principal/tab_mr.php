<?php
    if(MR_REQUIRED):
        $company_list = get_items_from_cache('company');
?>
    <section class="panel">
        <header class="panel-heading">
            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/mr'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Manpower Requirements</a>
    		<h3 class="panel-title">Manpower Requirements</h3>
    	</header>
    	<div class="panel-body">
    	
            <div id="mr_tab_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                <strong>ERROR!</strong><br>
                <div id="mr_tabNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
            <table class="table table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th>mr Ref.</th>
                        <th>Company</th>
                        <th class="text-center">Activity</th>
                        <th class="text-center">Date Created</th>
                        <th class="text-center">Pooling MR</th>
                        <th class="text-center">Status</th>
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
                                <td><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/mr/<?php echo $info['id'];?>'});"><?php echo $info['code'];?></a></td>
                                <td><?php echo ($info['company_id'])?$company_list[$info['company_id']]:"";?></td>
                                <td class="text-center"><?php echo ltrim(rtrim($info['activity'], '/'),'/');?></td>
                                <td class="text-center"><?php echo dateformat($info['add_date']);?></td>
                                <td class="text-center"><?php echo ($info['is_pooling']=='Y')?"Yes":"No";?></td>
                                <td class="text-center"><?php echo $status;?></td>
                                <td class="actions text-center">
                                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/mr/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                    <a href="javascript:void(0);" onclick="settingsAjaxDelete('manager_mr', '<?php echo $info['id'];?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
<?php endif;?>