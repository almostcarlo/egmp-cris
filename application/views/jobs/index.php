<?php //var_dump($job_list)?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Job Posting</h2>
	</header>

	<!-- start: page -->

	<?php echo form_open('jobs', 'id="frm_search_jobs"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearchJob" class="form-control input-lg" placeholder="Search Job (Position/Principal/Company)" autocomplete="off" value="<?php echo $this->input->post('textSearchJob');?>">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-blue-theme btn-lg" type="submit">Search</button>
            </span>
        </div>
	</form>
	
	<?php if(isset($_SESSION['settings_notification_status']) && $_SESSION['settings_notification_status'] == 'Success'):?>
    	<div id="" class="alert alert-success alert-dismissible" role="alert">
            <strong>SUCCESS!</strong><br>
            <div id=""><strong><span id="inputRequired"></span></strong><?php echo $_SESSION['settings_notification'];?></div>
        </div>
	<?php endif;?>
	
	<?php if(isset($_SESSION['settings_notification_status']) && $_SESSION['settings_notification_status'] == 'Error'):?>
        <div id="" class="alert alert-danger alert-dismissible" role="alert">
            <strong>ERROR!</strong><br>
            <div id=""><strong><span id="inputRequired"></span></strong><?php echo $_SESSION['settings_notification'];?></div>
        </div>
	<?php endif;?>
	
	<div class="row">
		<div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'jobs/facebox'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create New Job</a>
                    <h2 class="panel-title">Job List</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_SearchJobs">
                            <thead>
                                <tr>
                                    <th width="20%">Position/Category</th>
                                    <th width="30%">Principal/Company</th>
                                    <?php if(MR_REQUIRED):?><th>MR Ref</th><?php endif;?>
                                    <th width="8%" class="text-center">Status</th>
                                    <th width="8%" class="text-center">total no. of<br>applications</th>
                                    <th width="8%" class="text-center">total no. of<br>website views</th>
                                    <th width="8%" class="text-center">Expiry Date</th>
                                    <th width="8%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($job_list):?>
                                    <?php foreach ($job_list as $info):?>
                                    <?php
                                        if($info['status'] == 1){
                                            $status = "Active";
                                        }else if($info['status'] == 2){
                                            $status = "On-Hold";
                                        }else{
                                            $status = "Closed";
                                        }
                                    ?>
                                        <tr>
                                            <td><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'jobs/facebox/<?php echo $info['id'];?>'});"><?php echo $info['position'];?></a></td>
                                            <td><?php echo $info['principal'];?> <?php echo ($info['company']<>'')?"- ".$info['company']:"";?></td>
                                            <?php if(MR_REQUIRED):?><td><?php echo $info['mr_ref'];?></td><?php endif;?>
                                            <td class="text-center"><?php echo $status;?></td>
                                            <td class="text-center"><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'jobs/applicants/<?php echo $info['id'];?>'});"><?php echo $info['total_lineup'];?></a></td>
                                            <td class="text-center"><?php echo $info['web_views'];?></td>
                                            <td class="text-center"><?php echo dateformat($info['expiry_date'],1);?></td>
                                            <td class="actions text-center">
                                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'jobs/facebox/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'jobs/applicants/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="List of Applicants"><i class="fa fa-list"></i></a>
                                                <?php if($_SESSION['rs_user']['access_level'] == 'admin'):?>
                                                	<a href="<?php echo BASE_URL;?>settings/principal/<?php echo $info['principal_id'];?>" target="_blank" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Go to Principal Manager"><i class="fa fa-file"></i></a>
                                                <?php endif;?>
                                                <?php if(in_array(2, $_SESSION['rs_user']['delete_access'])):?>
                                                	<a href="<?php echo BASE_URL;?>jobs/delete/<?php echo $info['id'];?>" onclick="if(confirm('Deleting Job Posting. Do you want to proceed?')){return true;}else{return false;}" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                                <?php endif;?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                <?php endif;?>
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </section>
            
		</div>
	</div>
	
	<!-- end: page -->
</section>
<script>
	var is_mr_required = '<?php echo MR_REQUIRED;?>';
</script>