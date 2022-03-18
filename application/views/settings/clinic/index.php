<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Settings - Clinic</h2>
	</header>

	<!-- start: page -->

	<?php echo form_open('settings/search/clinic', 'id="frm_search_clinic"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearchInput" class="form-control input-lg" placeholder="(Clinic Name/Code)" autocomplete="off" value="<?php echo $this->input->post('textSearchInput');?>">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-blue-theme btn-lg" type="submit">Search</button>
            </span>
        </div>
	</form>

	<?php if($this->session->flashdata('settings_notification')):?>
        <div class="alert alert-success">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Success!</strong> <?php echo $this->session->flashdata('settings_notification')?>
        </div>
	<?php endif;?>

	<?php if(!$list):?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Error!</strong> No record found.
        </div>
    <?php endif;?>

	<?php if($list):?>
    	<div class="row">
    		<div class="col-md-12">
                
                <section class="panel">
                    <header class="panel-heading">
                        <a href="<?php echo BASE_URL;?>settings/add/clinic" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Clinic</a>
                        <h2 class="panel-title">Clinic List</h2>
                    </header>
                    <div class="panel-body" style="display: block;">
                        <div class="">
    					
                            <table class="table table-striped table-condensed table-hover mb-none" id="datatable_Search6Col">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Code</th>
                                        <th>Address</th>
                                        <th>Contact Person</th>
                                        <th>Tel No.</th>
                                        <th width="150px" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $info):?>
                                        <tr>
                                            <td><a href="<?php echo BASE_URL;?>settings/clinic/<?php echo $info['id'];?>"><?php echo $info['name'];?></a></td>
                                            <td><?php echo $info['code'];?></td>
                                            <td><?php echo $info['address'];?></td>
                                            <td><?php echo $info['contact_person'];?></td>
                                            <td><?php echo $info['tel_no'];?></td>
                                            <td class="actions text-center">
                                            	<a href="<?php echo BASE_URL;?>settings/clinic/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            	<a href="javascript:void(0);" onclick="settingsDelete('settings_clinic','<?php echo $info['id'];?>')" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        
                        </div>
                    </div>
                </section>
                
    		</div>
    	</div>
	<?php endif;?>
	<!-- end: page -->
</section>