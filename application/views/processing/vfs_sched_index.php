<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Processing - Activity</h2>
	</header>

	<!-- start: page -->
	<?php flashNotification();?>

	<div class="row">
		<div class="col-md-12">

            <section class="panel">
                <header class="panel-heading">
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/vfs'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> Add Applicant for VFS</a>
                    <h2 class="panel-title">VFS Schedule</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_6col_search">
                            <thead>
                                <tr>
                                    <th class="text-left">Applicant Name</th>
                                    <th class="text-left">Client/Employer</th>
                                    <th class="text-left">Position</th>
                                    <th class="text-center">Proposed Schedule</th>
                                    <th class="text-center">VFS Venue</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <?php if(isset($list_proposed)):?>
                                <tbody>
                                    <?php
                                        $n = 1;
                                        foreach($list_proposed as $info){
                                    ?>
                                            <tr>
                                                <td class="text-left"><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/vfs/<?php echo $info['id'];?>'});"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'],1);?></a></td>
                                                <td class="text-left"><?php echo $info['principal'];?></td>
                                                <td class="text-left"><?php echo $info['position'];?></td>
                                                <td class="text-center"><?php echo dateformat($info['proposed_sched']);?></td>
                                                <td class="text-center"><?php echo $info['venue'];?></td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/vfs/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0);" onclick="delete_processing('vfs_sched','<?php echo $info['id'];?>','');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o" style="color:red"></i></a>
                                                </td>
                                            </tr>
                                    <?php
                                            $n++;
                                        }
                                    ?>
                                </tbody>
                            <?php endif;?>
                        </table>
                    
                    </div>
                </div>
            </section>

            <?php if(isset($list_final)):?>
                <!-- FINAL SCHED -->
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">VFS Schedule (Final)</h2>
                    </header>
                    <div class="panel-body" style="display: block;">
                        <div class="">
                        
                            <table class="table table-striped table-condensed table-hover mb-none" id="dttbl_vfs_final">
                                <thead>
                                    <tr>
                                        <th class="text-left">Applicant Name</th>
                                        <th class="text-left">Client/Employer</th>
                                        <th class="text-left">Position</th>
                                        <th class="text-center">Final Schedule</th>
                                        <th class="text-center">VFS Venue</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $n = 1;
                                        foreach($list_final as $info){
                                    ?>
                                            <tr>
                                                <td class="text-left"><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/vfs/<?php echo $info['id'];?>'});"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'],1);?></a></td>
                                                <td class="text-left"><?php echo $info['principal'];?></td>
                                                <td class="text-left"><?php echo $info['position'];?></td>
                                                <td class="text-center"><?php echo dateformat($info['final_sched']);?></td>
                                                <td class="text-center"><?php echo $info['venue'];?></td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/vfs/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                    <a href="javascript:void(0);" onclick="delete_processing('vfs_sched','<?php echo $info['id'];?>','');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o" style="color:red"></i></a>
                                                </td>
                                            </tr>
                                    <?php
                                            $n++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        
                        </div>
                    </div>
                </section>
            <?php endif;?>

            <?php if(isset($list_released)):?>
                <!-- RELEASED -->
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">VFS Schedule (Released)</h2>
                    </header>
                    <div class="panel-body" style="display: block;">
                        <div class="">
                        
                            <table class="table table-striped table-condensed table-hover mb-none" id="dttbl_vfs_rel">
                                <thead>
                                    <tr>
                                        <th class="text-left">Applicant Name</th>
                                        <th class="text-left">Client/Employer</th>
                                        <th class="text-left">Position</th>
                                        <th class="text-center">Final Schedule</th>
                                        <th class="text-center">VFS Venue</th>
                                        <th class="text-center">Reference No.</th>
                                        <th class="text-center">Release Date</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $n = 1;
                                        foreach($list_released as $info){
                                    ?>
                                            <tr>
                                                <td class="text-left"><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/vfs/<?php echo $info['id'];?>'});"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'],1);?></a></td>
                                                <td class="text-left"><?php echo $info['principal'];?></td>
                                                <td class="text-left"><?php echo $info['position'];?></td>
                                                <td class="text-center"><?php echo dateformat($info['final_sched']);?></td>
                                                <td class="text-center"><?php echo $info['venue'];?></td>
                                                <td class="text-center"><?php echo $info['ref_no'];?></td>
                                                <td class="text-center"><?php echo dateformat($info['release_date']);?></td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/vfs/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                </td>
                                            </tr>
                                    <?php
                                            $n++;
                                        }
                                    ?>
                                </tbody>
                            </table>
                        
                        </div>
                    </div>
                </section>
            <?php endif;?>
            
		</div>
	</div>
	<!-- end: page -->
</section>