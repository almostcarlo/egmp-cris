<?php
    //var_dump($uploads);
?>
<div id="overview" class="tab-pane active">
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
        	<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/upload/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Upload File</a>
            <h2 class="panel-title">Documents</h2>
        </header>
        <div class="panel-body">
            
            <table class="table table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th width="20%">Document Name</th>
                        <th width="20%">Attachment</th>
                        <th class="text-center" width="10%">Received Date</th>
                        <th class="text-center" width="10%">Released Date</th>
                        <th class="text-center" width="10%">Expiry Date</th>
                        <th width="25%">Remarks</th>
                        <th class="text-center" width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if(isset($uploads) && count($uploads) > 0):?>
                    	<?php foreach ($uploads as $upload_info):?>
                            <?php if($upload_info['from_portal'] == 'Y'):

                                    if(file_exists($upload_info['filename'])){
                                        $show_file = "<a href=\"".BASE_URL."applicant/my_files/".base64_encode($upload_info['id'])."\" target=\"_blank\">{$upload_info['filename']}</a>";
                                        $show_download = "&nbsp;";
                                    }else{
                                        $show_file = $upload_info['filename'];
                                        $show_download = "<a href=\"".BASE_URL."download-file/".base64_encode($upload_info['id'])."\" data-toggle=\"tooltip\" data-placement=\"top\" title=\"Download File from Portal\" data-original-title=\"Download\"><i class=\"fa fa-download\"></i></a>";
                                    }
                            ?>
                                <!-- IF FILE IS UPLOADED THRU PORTAL -->
                                <tr>
                                    <td><?php echo $upload_info['description'];?></td>
                                    <td><?php echo $show_file?></td>
                                    <td class="text-center"><?php echo dateformat($upload_info['add_date']);?></td>
                                    <td class="text-center"><?php echo dateformat($upload_info['released_date']);?></td>
                                    <td class="text-center"><?php echo dateformat($upload_info['expiry_date']);?></td>
                                    <td><?php echo $upload_info['remarks'];?></td>
                                    <td class="text-center"><?php echo $show_download;?></td>
                                </tr>
                                <!-- END IF FILE IS UPLOADED THRU PORTAL -->
                            <?php else:?>

                                <?php if(!in_array($upload_info['description'], array('iprs picture','profile picture','profile cv'))):?>
                                    <tr>
                                        <td><?php echo $upload_info['description'];?></td>
                                        <td><a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($upload_info['id']);?>" target="_blank"><?php echo $upload_info['filename']?></a></td>
                                        <td class="text-center"><?php echo dateformat($upload_info['add_date']);?></td>
                                        <td class="text-center"><?php echo dateformat($upload_info['released_date']);?></td>
                                        <td class="text-center"><?php echo dateformat($upload_info['expiry_date']);?></td>
                                        <td><?php echo $upload_info['remarks'];?></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                <?php elseif(in_array($upload_info['description'], array('profile cv'))):?>
                                    <tr>
                                        <td>CV (uploaded from website)</td>
                                        <td><a href="<?php echo WEBSITE_URL.$upload_info['filename'];?>" target="_blank"><?php echo $upload_info['filename']?></a></td>
                                        <td class="text-center"><?php echo dateformat($upload_info['add_date']);?></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td>&nbsp;</td>
                                    </tr>
                                <?php endif;?>

                            <?php endif;?>
                    	<?php endforeach;?>
                    <?php else:?>
                        <tr>
                            <td colspan="10">
                                <small class="required">no record found.</small>
                            </td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
            
        </div>
    </section>
    
    <div class="row">
        <div class="col-md-6">
        
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/internal_adv/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Advisory</a>
                    <h2 class="panel-title">Internal Advisory</h2>
                </header>
                <div class="panel-body">
				<?php if(isset($advisory_list['internal'])):?>
				<?php $keys_i = array_keys($advisory_list['internal']);?>
					<?php //foreach ($advisory_list['internal'] as $int_adv_info):?>
                        <div class="alert alert-info">
                            <button type="button" onclick="delete_record('internal_adv', '<?php echo $advisory_list['internal'][$keys_i[0]]['id'];?>')" class="delete" data-dismiss="alert" aria-hidden="true"><i class="fa fa-trash-o"></i></button>
                            <p><strong><i class="fa fa-calendar"></i> Date: </strong><?php echo dateformat($advisory_list['internal'][$keys_i[0]]['add_date'],3);?></p>
                            <p><strong><i class="fa fa-user"></i> User: </strong><?php echo $advisory_list['internal'][$keys_i[0]]['add_by'];?></p>
                            <p><strong><i class="fa fa-comment"></i> Advisory: </strong><?php echo $advisory_list['internal'][$keys_i[0]]['message'];?></p>
                        </div>
					<?php //endforeach;?>
					<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/internal_adv_all/<?php echo $applicant_id;?>'});">View all Internal Advisory</a>
                <?php else:?>
                    <small class="required">no record found.</small>
				<?php endif;?>
                </div>
            </section>
        
        </div>
        <div class="col-md-6">
        
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/applicant_adv/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Advisory</a>
                    <h2 class="panel-title">Applicant Advisory</h2>
                </header>
                <div class="panel-body">
				<?php if(isset($advisory_list['applicant'])):?>
				<?php $keys_a = array_keys($advisory_list['applicant']);?>

                    <div class="alert alert-info">
                        <!-- DELETE (HIDE IF SMS INBOX/OUTBOX)-->
                        <?php if($advisory_list['applicant'][$keys_a[0]]['tbl'] == ''):?>
                            <button type="button" onclick="delete_record('applicant_adv', '<?php echo $advisory_list['applicant'][$keys_a[0]]['id'];?>')" class="delete" data-dismiss="alert" aria-hidden="true"><i class="fa fa-trash-o"></i></button>
                        <?php endif;?>
                        <p><strong><i class="fa fa-calendar"></i> Date: </strong><?php echo dateformat($advisory_list['applicant'][$keys_a[0]]['add_date'],3);?></p>
                        <?php if($advisory_list['applicant'][$keys_a[0]]['tbl'] == 'outbox' || $advisory_list['applicant'][$keys_a[0]]['tbl'] == ''):?>
                            <p><strong><i class="fa fa-user"></i> User: </strong><?php echo $advisory_list['applicant'][$keys_a[0]]['add_by'];?></p>
                        <?php endif;?>

                        <?php if($advisory_list['applicant'][$keys_a[0]]['tbl'] != ''):?>
                            <p><strong><i class="fa fa-comment"></i> Sms <?php echo $advisory_list['applicant'][$keys_a[0]]['tbl'];?>: </strong><?php echo $advisory_list['applicant'][$keys_a[0]]['message'];?></p>
                        <?php else:?>
                            <p><strong><i class="fa fa-comment"></i> Advisory: </strong><?php echo $advisory_list['applicant'][$keys_a[0]]['message'];?></p>
                        <?php endif;?>
                    </div>

					<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/applicant_adv_all/<?php echo $applicant_id;?>'});">View all Applicant Advisory</a>
                <?php else:?>
                    <small class="required">no record found.</small>
				<?php endif;?>
                </div>
            </section>
            
        </div>
    </div>
    
    <div class="row">
        <div class="col-md-6">
        
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/applied_pos/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> Edit Position</a>
                    <h2 class="panel-title">Applied Position</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <p class="col-md-6" style="margin-bottom:0;"><strong>Position #1:</strong></p>
                        <p class="col-md-6" style="margin-bottom:0;"><strong>Position #2:</strong></p>
                    </div>
                    <div class="row">
                        <p class="col-md-6" style="margin-bottom:0;"><?php echo (isset($applied_pos[0]))?$applied_pos[0]:"";?></p>
                        <p class="col-md-6" style="margin-bottom:0;"><?php echo (isset($applied_pos[1]))?$applied_pos[1]:"";?></p>
                    </div>
                </div>
            </section>
        
        </div>
    </div>

</div>