<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Settings - Position</h2>
	</header>

	<!-- start: page -->

	<?php echo form_open('settings/search_position', 'id="frm_search_position"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearchInput" class="form-control input-lg" placeholder="(name of position/category)" autocomplete="off" value="<?php echo $this->input->post('textSearchInput');?>">
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
                    <div class="">
                        <!-- <a href="#" class="fa fa-caret-down"></a> -->
                        <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/position'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Position</a>
                    </div>
                    <h2 class="panel-title">Position List</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_SearchPosition">
                            <thead>
                                <tr>
                                    <th>Position/Category</th>
                                    <th>Job Specification</th>
                                    <th width="150px" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if($list):?>
                                    <?php foreach ($list as $info):?>
                                        <tr>
                                            <td><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/position/<?php echo $info['id'];?>'});"><?php echo strtoupper($info['desc']);?></a></td>
                                            <td><?php echo strtoupper($info['jobspec']);?></td>
                                            <td class="actions text-center">
                                            	<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/position/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            	<a href="javascript:void(0);" onclick="settingsDelete('settings_position','<?php echo $info['id'];?>')" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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