<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Settings - Agent</h2>
	</header>

	<!-- start: page -->

	<?php echo form_open('settings/search/agent', 'id="frm_search_agent"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearchInput" class="form-control input-lg" placeholder="(Agent Name)" autocomplete="off" value="<?php echo $this->input->post('textSearchInput');?>">
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
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/agent'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create Agent</a>
                    <h2 class="panel-title">Agent List</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_Search6Col">
                            <thead>
                                <tr>
                                    <th width="20%" class="text-left">Name</th>
                                    <th width="10%" class="text-center">Email</th>
                                    <th width="10%" class="text-center">Mobile No.</th>
                                    <th width="40%" class="text-left">Address</th>
                                    <th width="10%" class="text-center">status</th>
                                    <th width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $info):?>
                                    <tr>
                                        <td class="text-left"><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/agent/<?php echo $info['id'];?>'});"><?php echo nameformat($info['fname'],$info['mname'],$info['lname'],1);?></a></td>
                                        <td class="text-center"><?php echo $info['email'];?></td>
                                        <td class="text-center"><?php echo $info['mobile_no'];?></td>
                                        <td class="text-left"><?php echo $info['address'];?></td>
                                        <td class="text-center"><?php echo ($info['is_active']=='Y')?"Active":"Not Active";?></td>
                                        <td class="text-center">
                                        	<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/agent/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                        	<?php if(in_array($_SESSION['rs_user']['username'], $this->config->item('delete_access'))):?>
                                        		<a href="javascript:void(0);" onclick="settingsDelete('settings_agent','<?php echo $info['id'];?>')" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                        	<?php endif;?>
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