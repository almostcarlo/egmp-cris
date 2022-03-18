<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>PRA/SRA/JFA Request</h2>
	</header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            
            <?php flashNotification();?>

			<?php if(isset($_GET['archived'])):?>
				<!-- ARCHIVED -->
	            <section class="panel">
	                <header class="panel-heading">
            			<a href="<?php echo BASE_URL;?>recruitment/lists/pra" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-list"></i> Active Request</a>

	                    <h3 class="panel-title">Archived</h3>
	                </header>
	                <div class="panel-body">
	                    <table class="table table-striped table-condensed table-hover mb-none" id="">
	                        <thead>
	                            <tr>
	                                <td width="5%" class="text-center"><strong>Type</strong></td>
	                                <td width="21%" class="text-left"><strong>Principal</strong></td>
	                                <td width="16%" class="text-left"><strong>Venue</strong></td>
	                                <td width="10%" class="text-center"><strong>Date</strong></td>
	                                <td width="11%" class="text-center"><strong>Atached File</strong></td>
	                                <td width="11%" class="text-center"><strong>Receiving Copy</strong></td>
	                                <td width="6%" class="text-center"><strong>Status</strong></td>
	                                <td width="20%" class="text-left"><strong>Remarks</strong></td>
	                            </tr>
	                        </thead>
	                        <tbody>
	<?php
	                            if($arc_list){
	                                $n = 1;
	                                foreach($arc_list as $v){
	?>
	                                    <tr>
	                                        <td class="text-center"><?php echo $v['type'];?></td>
	                                        <td class="text-left"><?php echo $v['principal'];?></td>
	                                        <td class="text-left"><?php echo $v['venue'];?></td>
	                                        <td class="text-center"><?php echo dateformat($v['start_date'],5);?> - <?php echo dateformat($v['end_date'],5);?></td>
											<td class="text-center"><a href="<?php echo BASE_URL;?>recruitment/files/pra_file/<?php echo base64_encode($v['id']);?>" target="_blank"><?php echo basename($v['file']);?></a></td>
                                        	<td class="text-center"><a href="<?php echo BASE_URL;?>recruitment/files/pra_rcv_copy/<?php echo base64_encode($v['id']);?>" target="_blank"><?php echo basename($v['rcv_copy']);?></a></td>
	                                        <td class="text-center"><?php echo ($v['status']=='Disapproved')?"Disapproved":"Approved";?></td>
	                                        <td class="text-left"><?php echo $v['remarks'];?></td>
	                                    </tr>
	<?php
	                                    $n++;
	                                }
	                            }else{
	?>
									<tr>
										<td colspan="10" style="height: 60px;" class="text-center">No data available in table</td>
									</tr>
	<?php
	                            }
	?>
	                        </tbody>
	                    </table>
	                </div>
	            </section>
			<?php else:?>
				<!-- REQUESTED -->
	            <section class="panel">
	                <header class="panel-heading">
            			<a href="<?php echo BASE_URL;?>recruitment/lists/pra?archived=1" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-list"></i> Archived Request</a>

	                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'recruitment/facebox/form_pra'});" target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;margin-right: 5px;"><i class="fa fa-plus"></i> Request Form</a>

	                    <h3 class="panel-title">Requested</h3>
	                </header>
	                <div class="panel-body">
	                    <table class="table table-striped table-condensed table-hover mb-none" id="">
	                        <thead>
	                            <tr>
	                                <td width="10%" class="text-center"><strong>Type</strong></td>
	                                <td width="25%" class="text-left"><strong>Principal</strong></td>
	                                <td width="35%" class="text-left"><strong>Venue</strong></td>
	                                <td width="20%" class="text-center"><strong>Date</strong></td>
	                                <td width="10%" class="text-center"><strong>Action</strong></td>
	                            </tr>
	                        </thead>
	                        <tbody>
	<?php
	                            if($req_list){
	                                $n = 1;
	                                foreach($req_list as $v){
	?>
	                                    <tr>
	                                        <td class="text-center"><?php echo $v['type'];?></td>
	                                        <td class="text-left"><?php echo $v['principal'];?></td>
	                                        <td class="text-left"><?php echo $v['venue'];?></td>
	                                        <td class="text-center"><?php echo dateformat($v['start_date'],5);?> - <?php echo dateformat($v['end_date'],5);?></td>
	                                        <td class="text-center">
	                                            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'recruitment/facebox/form_pra?id=<?php echo $v['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title=""><i class="fa fa-pencil"></i></a>
	                                        </td>
	                                    </tr>
	<?php
	                                    $n++;
	                                }
	                            }else{
	?>
									<tr>
										<td colspan="10" style="height: 60px;" class="text-center">No data available in table</td>
									</tr>
	<?php
	                            }
	?>
	                        </tbody>
	                    </table>
	                </div>
	            </section>

	            <!-- SIGNED -->
	            <?php if($signed_list):?>
		            <section class="panel">
		                <header class="panel-heading">
		                	<h3 class="panel-title">Signed</h3>
		                </header>
		                <div class="panel-body">
		                    <table class="table table-striped table-condensed table-hover mb-none" id="">
		                        <thead>
		                            <tr>
		                                <td width="10%" class="text-center"><strong>Type</strong></td>
		                                <td width="25%" class="text-left"><strong>Principal</strong></td>
		                                <td width="35%" class="text-left"><strong>Venue</strong></td>
		                                <td width="20%" class="text-center"><strong>Date</strong></td>
		                                <td width="10%" class="text-center"><strong>Action</strong></td>
		                            </tr>
		                        </thead>
		                        <tbody>
		<?php
		                                $n = 1;
		                                foreach($signed_list as $v){
		?>
		                                    <tr>
		                                        <td class="text-center"><?php echo $v['type'];?></td>
		                                        <td class="text-left"><?php echo $v['principal'];?></td>
		                                        <td class="text-left"><?php echo $v['venue'];?></td>
		                                        <td class="text-center"><?php echo dateformat($v['start_date'],5);?> - <?php echo dateformat($v['end_date'],5);?></td>
		                                        <td class="text-center">
		                                            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'recruitment/facebox/form_pra?id=<?php echo $v['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title=""><i class="fa fa-pencil"></i></a>
		                                        </td>
		                                    </tr>
		<?php
		                                    $n++;
		                                }
		?>
		                        </tbody>
		                    </table>
		                </div>
		            </section>
		        <?php endif;?>

	            <!-- RELEASED -->
	            <?php if($rel_list):?>
		            <section class="panel">
		                <header class="panel-heading">
		                	<h3 class="panel-title">Released</h3>
		                </header>
		                <div class="panel-body">
		                    <table class="table table-striped table-condensed table-hover mb-none" id="">
		                        <thead>
		                            <tr>
		                                <td width="10%" class="text-center"><strong>Type</strong></td>
		                                <td width="25%" class="text-left"><strong>Principal</strong></td>
		                                <td width="20%" class="text-left"><strong>Venue</strong></td>
		                                <td width="13%" class="text-center"><strong>Date</strong></td>
	                                	<td width="13%" class="text-center"><strong>Atached File</strong></td>
	                                	<td width="15%" class="text-center"><strong>Receiving Copy</strong></td>
		                                <td width="8%" class="text-center"><strong>Action</strong></td>
		                            </tr>
		                        </thead>
		                        <tbody>
		<?php
		                                $n = 1;
		                                foreach($rel_list as $v){
		?>
		                                    <tr>
		                                        <td class="text-center"><?php echo $v['type'];?></td>
		                                        <td class="text-left"><?php echo $v['principal'];?></td>
		                                        <td class="text-left"><?php echo $v['venue'];?></td>
		                                        <td class="text-center"><?php echo dateformat($v['start_date'],5);?> - <?php echo dateformat($v['end_date'],5);?></td>
												<td class="text-center"><a href="<?php echo BASE_URL;?>recruitment/files/pra_file/<?php echo base64_encode($v['id']);?>" target="_blank"><?php echo basename($v['file']);?></a></td>
	                                        	<td class="text-center"><a href="<?php echo BASE_URL;?>recruitment/files/pra_rcv_copy/<?php echo base64_encode($v['id']);?>" target="_blank"><?php echo basename($v['rcv_copy']);?></a></td>
		                                        <td class="text-center">
		                                            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'recruitment/facebox/form_pra?id=<?php echo $v['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title=""><i class="fa fa-pencil"></i></a>
		                                        </td>
		                                    </tr>
		<?php
		                                    $n++;
		                                }
		?>
		                        </tbody>
		                    </table>
		                </div>
		            </section>
	        	<?php endif;?>
        	<?php endif;?>
        </div>
    </div>
	<!-- end: page -->
</section>