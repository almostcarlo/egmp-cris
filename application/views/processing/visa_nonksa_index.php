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
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/visa_nonksa'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> Add VISA Entry</a>
                    <h2 class="panel-title">VISA Entry Info</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_visa_entry">
                            <thead>
                                <tr>
                                    <th>VISA No.</th>
                                    <th class="text-left">Client/Employer</th>
                                    <th class="text-center">Country</th>
                                    <th class="text-center">VISA Date</th>
                                    <th class="text-center">VISA Stamp</th>
                                    <th class="text-center">No. of Days</th>
                                    <th class="text-center">VISA Expiry</th>
                                    <!-- <th class="text-left">Sponsor ID</th> -->
                                    <th class="text-left">Employee</th>
                                    <th class="text-left">Attachment</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $n = 1;
                                    foreach($list as $info){
                                ?>
                                        <tr>
                                            <td class="text-left"><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/visa_nonksa/<?php echo $info['id'];?>'});"><?php echo $info['visa_no'];?></a></td>
                                            <td class="text-left"><?php echo $info['principal'];?></td>
                                            <td class="text-center"><?php echo $info['country'];?></td>
                                            <td class="text-center"><?php echo dateformat($info['visa_date']);?></td>
                                            <td class="text-center"><?php echo dateformat($info['visa_stamp']);?></td>
                                            <td class="text-center"><?php echo $info['days_valid'];?></td>
                                            <td class="text-center"><?php echo dateformat($info['expiry_date']);?></td>
                                            <!-- <td class="text-left"></td> -->
                                            <td class="text-left"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'],1);?></td>
                                            <td class="text-left">
                                                <a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($info['id'])."/manager_visa_nonksa/attachment";?>" target="_blank"><?php echo $info['attachment'];?></a>
                                            </td>
                                            <td class="text-center">
                                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/visa_nonksa/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a href="javascript:void(0);" onclick="delete_processing('visa_nonksa','<?php echo $info['id'];?>','');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o" style="color:red"></i></a>
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