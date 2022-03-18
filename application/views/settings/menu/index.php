<?php
    $menu_per_level = array();

    foreach ($all_menu as $v){
        $menu_per_level[$v['level']][$v['id']] = $v;
    }
//     var_dump($menu_per_level);
//     exit();
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Settings - Menu</h2>
	</header>

	<!-- start: page -->

	<?php echo form_open('settings/search/menu', 'id="frm_search_menu"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearchInput" class="form-control input-lg" placeholder="(Title)" autocomplete="off" value="<?php echo $this->input->post('textSearchInput');?>">
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
                        <a href="<?php echo BASE_URL;?>settings/add/menu" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Menu</a>
                        <h2 class="panel-title">Menu List</h2>
                    </header>
                    <div class="panel-body" style="display: block;">
                        <div class="">
    					
                            <table class="table table-striped table-condensed table-hover mb-none" id="datatable_Search6Col">
                                <thead>
                                    <tr>
                                        <th>Title</th>
                                        <th>Parent</th>
                                        <th>URL</th>
                                        <th>Level</th>
                                        <th>Order No.</th>
                                        <th width="150px" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($list as $info):?>
                                    <!--LVL1 PARENT $menu_per_level[intval($info['level']-1)][$info['parent_id']]['parent_id'] -->
                                        <tr>
                                            <td><a href="<?php echo BASE_URL;?>settings/menu/<?php echo $info['id'];?>"><?php echo $info['title'];?></a></td>
                                            <td><?php echo ($info['level']>2)?$menu_per_level[1][$menu_per_level[intval($info['level']-1)][$info['parent_id']]['parent_id']]['title']." > ":""?> <?php echo ($info['level']>1)?$menu_per_level[intval($info['level']-1)][$info['parent_id']]['title']:"";?></td>
                                            <td><?php echo $info['url'];?></td>
                                            <td><?php echo $info['level'];?></td>
                                            <td><?php echo $info['order_no'];?></td>
                                            <td class="actions text-center">
                                            	<a href="<?php echo BASE_URL;?>settings/menu/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            	<a href="javascript:void(0);" onclick="settingsDelete('settings_menu','<?php echo $info['id'];?>')" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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