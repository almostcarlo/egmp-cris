<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Settings - Source of Application</h2>
	</header>

	<!-- start: page -->

	<?php echo form_open('settings/search/source', 'id="frm_search_source"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearchInput" class="form-control input-lg" placeholder="(Source Name)" autocomplete="off" value="<?php echo $this->input->post('textSearchInput');?>">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-blue-theme btn-lg" type="submit">Search</button>
            </span>
        </div>
	</form>

	<?php flashNotification();?>

	<div class="row">
		<div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/source'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Source</a>
                    <h2 class="panel-title">Source of Application List</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_Search3Col">
                            <thead>
                                <tr>
                                    <th>desc</th>
                                    <th width="10%">status</th>
                                    <th width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $info):?>
                                    <tr>
                                        <td><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/source/<?php echo $info['id'];?>'});"><?php echo $info['desc'];?></a></td>
                                        <td><?php echo ($info['is_active']=='Y')?"Active":"Not Active";?></td>
                                        <td class="text-center">
                                        	<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/source/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                        	<a href="javascript:void(0);" onclick="settingsDelete('settings_application_source','<?php echo $info['id'];?>')" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
	<!-- end: page -->
</section>