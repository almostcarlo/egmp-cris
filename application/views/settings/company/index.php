<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Settings - Company</h2>
	</header>

	<!-- start: page -->

	<?php echo form_open('settings/search_company', 'id="frm_search_company"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearchInput" class="form-control input-lg" placeholder="(Name/Code)" autocomplete="off" value="<?php echo $this->input->post('textSearchInput');?>">
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

	<div class="row">
		<div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <a href="<?php echo BASE_URL;?>settings/add_company" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Company</a>
                    <h2 class="panel-title">Company List</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_SearchCompany">
                            <thead>
                                <tr>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>Principal</th>
                                    <th width="150px" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($list):?>
                                    <?php foreach ($list as $info):?>
                                        <tr>
                                            <td><?php echo strtoupper($info['code']);?></td>
                                            <td><a href="<?php echo BASE_URL;?>settings/company/edit/<?php echo $info['id'];?>"><?php echo ucwords(strtolower($info['name']));?></a></td>
                                            <td><?php echo $info['principal'];?></td>
                                            <td class="actions text-center">
                                            	<a href="<?php echo BASE_URL;?>settings/company/edit/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            	<a href="javascript:void(0);" onclick="settingsDelete('manager_company','<?php echo $info['id'];?>')" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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