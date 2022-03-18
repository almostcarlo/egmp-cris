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
                    <h2 class="panel-title">OEC Request</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_oec_req">
                            <thead>
                                <tr>
                                    <th class="text-left">#</th>
                                    <th class="text-left">Name</th>
                                    <th class="text-left">Principal</th>
                                    <th class="text-center">MR Ref.</th>
                                    <th class="text-left">Lineup Category</th>
                                    <th class="text-center">Date Selected</th>
                                    <th class="text-center">Submit Date</th>
                                    <th class="text-center">OEC</th>
                                    <th class="text-center">CG No.</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $n = 1;
                                    foreach($list as $info){
                                ?>
                                        <tr>
                                            <td class="text-left"><?php echo $n;?>.</td>
                                            <td class="text-left"><a href="<?php echo BASE_URL;?>profile/<?php echo $info['applicant_id'];?>/processing" target="_blank"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'],1);?></a></td>
                                            <td class="text-left"><?php echo $info['principal'];?></td>
                                            <td class="text-center"><?php echo $info['mr_ref'];?></td>
                                            <td class="text-left"><?php echo $info['lineup_cat'];?></td>
                                            <td class="text-center"><?php echo dateformat($info['select_date'],1);?></td>
                                            <td class="text-center"><?php echo dateformat($info['rfp_submit_date'],1);?></td>
                                            <td class="text-center"><?php echo $info['rfp_oec_no'];?></td>
                                            <td class="text-center"><?php echo $info['rfp_cg_no'];?></td>
                                            <td class="text-center">
                                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/oec_request/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
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
            
		</div>
	</div>
	<!-- end: page -->
</section>