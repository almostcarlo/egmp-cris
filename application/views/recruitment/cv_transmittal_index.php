<?php //var_dump($list); exit();?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>CV Transmittal Search</h2>
	</header>

	<!-- start: page -->

	<?php echo form_open('recruitment/lists/cv_transmittal', 'id="frm_search_cv"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearchCV" class="form-control input-lg" placeholder="Search CV Transmittal (Transmittal No./Subject/Principal)" autocomplete="off" value="<?php echo $this->input->post('textSearchCV');?>">
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

	<?php /*if(!$list):?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Error!</strong> No record found.
        </div>
    <?php endif;*/?>

	<div class="row">
		<div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <!-- <div class="panel-actions">
                        <a href="#" class="fa fa-caret-down"></a>
                    </div> -->
                    <a href="<?php echo BASE_URL;?>recruitment/forms/cv_transmittal" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create New Transmittal</a>
                    <h2 class="panel-title">CV Transmittal List</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_cvtrans">
                            <thead>
                                <tr>
                                    <th width="10%">Transmittal No.</th>
                                    <th width="10%">Date Sent</th>
                                    <th width="30%">To</th>
                                    <th width="40%">Subject</th>
                                    <th width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <?php if($list):?>
                                <tbody>
                                    <?php foreach ($list as $info):?>
                                        <tr>
                                            <td><a href="<?php echo BASE_URL;?>recruitment/forms/cv_transmittal/<?php echo $info['id'];?>"><?php echo $info['transmittal_no'];?></a></td>
                                            <td><?php echo date("F d, Y", strtotime($info['sent_date']));?></td>
                                            <td>
                                            	<strong>Principal</strong>: <?php echo strtoupper($_SESSION['settings']['principal'][$info['principal_id']]);?>
                                            	<?php echo (isset($_SESSION['settings']['company'][$info['company_id']]))?"<br><strong>Company</strong>: ".strtoupper($_SESSION['settings']['company'][$info['company_id']]):"";?>
                                        	</td>
                                            <td><?php echo $info['subject'];?></td>
                                            <td class="actions text-center">
                                                <a href="<?php echo BASE_URL;?>recruitment/forms/cv_transmittal/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Info"><i class="fa fa-eye"></i></a>
                                                <?php if(in_array(5, $_SESSION['rs_user']['delete_access'])):?>
                                                	<a href="<?php echo BASE_URL;?>recruitment/delete/cv_transmittal/<?php echo $info['id'];?>" onclick="if(confirm('Are you sure you want to delete this record?')){return true;}else{return false;}" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                                <?php endif;?>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            <?php endif;?>
                        </table>
                    
                    </div>
                </div>
            </section>
            
		</div>
	</div>
	
	<!-- end: page -->
</section>