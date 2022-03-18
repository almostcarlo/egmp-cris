<section class="panel">
    <header class="panel-heading">
    	<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'recruitment/facebox/form_mr_pos?mr_id=<?php echo $mr_id;?>'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create New Job</a>
		<h3 class="panel-title">&nbsp;</h3>
	</header>
    <div class="panel-body">
        <div class="">
    	
            <table class="table table-striped table-condensed table-hover mb-none" id="">
                <thead>
                    <tr>
                        <th width="30%">Position</th>
                        <th width="10%">Required</th>
                        <th width="10%">Target</th>
                        <th width="10%">Gender</th>
                        <th width="10%">Religion</th>
                        <th width="10%">Expiry Date</th>
                        <th width="10%">Status</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($info as $k => $v):?>
                        <tr>
                            <td><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'recruitment/facebox/form_mr_pos?mr_id=<?php echo $mr_id;?>&id=<?php echo $v['id'];?>'});"><?php echo $v['position'];?></a></td>
                            <td><?php echo $v['required']?></td>
                            <td><?php echo $v['target']?></td>
                            <td><?php echo $v['gender']?></td>
                            <td><?php echo $v['religion']?></td>
                            <td><?php echo dateformat($v['expiry_date'],1)?></td>
                            <td><?php if($v['status']==0){echo "Closed";}else if($v['status']==1){echo "Active";}else{echo "On-Hold";}?></td>
                            <td class="actions text-center">
                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'recruitment/facebox/form_mr_pos?mr_id=<?php echo $mr_id;?>&id=<?php echo $v['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>

                                <!-- DISABLE DELETE IF ALLOCATION > 0 -->
                                <?php if(in_array(8, $_SESSION['rs_user']['delete_access'])):?>
                                	<a href="javascript:void(0);" onclick="delete_mr('jo','<?php echo $v['id'];?>');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                <?php endif;?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        
        </div>
    </div>
</section>