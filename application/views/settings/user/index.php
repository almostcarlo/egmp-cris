<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Settings - Users</h2>
	</header>

	<!-- start: page -->

	<?php echo form_open('settings/search_user', 'id="frm_search_user"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearchUser" class="form-control input-lg" placeholder="(Name/Username)" autocomplete="off" value="<?php echo $this->input->post('textSearchUser');?>">
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

	<?php if(!$users):?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Error!</strong> No record found.
        </div>
    <?php endif;?>

	<?php if($users):?>
    	<div class="row">
    		<div class="col-md-12">
                
                <section class="panel">
                    <header class="panel-heading">
                        <!-- <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div> -->
                        <a href="<?php echo BASE_URL;?>settings/add_user" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add User</a>
                        <h2 class="panel-title">User List</h2>
                    </header>
                    <div class="panel-body" style="display: block;">
                        <div class="">
    					
                            <table class="table table-striped table-condensed table-hover mb-none" id="datatable_SearchUser">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Position</th>
                                        <th>Status</th>
                                        <th width="150px" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($users as $info):?>
                                        <tr>
                                            <td>
                                            	<?php if($info['username'] != 'admin'):?>
                                            		<a href="<?php echo BASE_URL;?>settings/user/<?php echo $info['id'];?>"><?php echo ucwords(strtolower($info['name']));?></a>
                                            	<?php else:?>
                                            		<?php echo ucwords(strtolower($info['name']));?>
                                            	<?php endif;?>
                                        	</td>
                                            <td><?php echo $info['username'];?></td>
                                            <td><?php echo $info['position'];?></td>
                                            <td><?php echo ($info['is_active']=='Y')?"Active":"Not Active";?></td>
                                            <td class="actions text-center">
                                            	<?php if($info['username'] != 'admin'):?>
                                                	<a href="<?php echo BASE_URL;?>settings/user/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                	<a href="javascript:void(0);" onclick="settingsDelete('settings_users','<?php echo $info['id'];?>')" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
	<?php endif;?>
	<!-- end: page -->
</section>