<section class="panel">
    <header class="panel-heading">
    	<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'recruitment/facebox/form_mr_sched?mr_id=<?php echo $mr_id;?>'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create New Schedule</a>
		<h3 class="panel-title">&nbsp;</h3>
	</header>
    <div class="panel-body">
        <div class="">
    	
            <table class="table table-striped table-condensed table-hover mb-none" id="">
                <thead>
                    <tr>
                        <th width="30%">Venue</th>
                        <th width="10%">Interview Date</th>
                        <th width="10%">Status</th>
                        <th width="40%">Remarks</th>
                        <th width="10%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($info as $k => $v):?>
                        <tr>
                            <td><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'recruitment/facebox/form_mr_sched?mr_id=<?php echo $mr_id;?>&id=<?php echo $v['id'];?>'});"><?php echo $v['venue'];?></a></td>
                            <td><?php echo dateformat($v['interview_date'],1)?> <?php echo $v['interview_time'];?></td>
                            <td><?php if($v['status']==0){echo "Tentative";}else{echo "Confirmed";}?></td>
                            <td><?php echo $v['remarks']?></td>
                            <td class="actions text-center">
                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'recruitment/facebox/form_mr_sched?mr_id=<?php echo $mr_id;?>&id=<?php echo $v['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>

                                <!-- DISABLE DELETE IF ALLOCATION > 0 -->
                                <?php if(in_array(8, $_SESSION['rs_user']['delete_access'])):?>
                                	<a href="javascript:void(0);" onclick="delete_mr('mr_sched','<?php echo $v['id'];?>');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                <?php endif;?>
                            </td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        
        </div>
    </div>
</section>