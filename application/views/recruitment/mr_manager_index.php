<?php //var_dump($list); exit();?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>MR Manager</h2>
	</header>

	<!-- start: page -->

	<?php echo form_open('recruitment/lists/mr_manager', 'id="frm_search"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearch" class="form-control input-lg" placeholder="Search MR Manager (MR Reference/Principal)" autocomplete="off" value="<?php echo $this->input->post('textSearch');?>">
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
                	<a href="<?php echo BASE_URL;?>recruitment/forms/form_mr_manager" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create New MR</a>
                    <h2 class="panel-title">Active MR</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_5col">
                            <thead>
                                <tr>
                                    <th width="20%">MR Reference</th>
                                    <th width="30%">Principal</th>
                                    <th width="20%">Activity</th>
                                    <th width="20%">Date Created</th>
                                    <th width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <?php if($mr_active):?>
                                <tbody>
                                    <?php foreach ($mr_active as $info):?>
                                        <tr>
                                            <td><a href="<?php echo BASE_URL;?>recruitment/forms/form_mr_manager/<?php echo $info['id'];?>"><?php echo $info['mr_ref'];?></a></td>
                                            <td><?php echo strtoupper($info['principal']);?><?php echo ($info['company']!='')?" - ".strtoupper($info['company']):"";?></td>
                                            <td><?php echo $info['activity'];?></td>
                                            <td><?php echo date("F d, Y", strtotime($info['add_date']));?></td>
                                            <td class="actions text-center">
                                                <a href="<?php echo BASE_URL;?>recruitment/forms/form_mr_manager/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit MR"><i class="fa fa-pencil"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            <?php endif;?>
                        </table>
                    
                    </div>
                </div>
            </section>
            
            <?php if($mr_for_update):?>
                <section class="panel">
                    <header class="panel-heading">
                        <h2 class="panel-title">For MR Updating</h2>
                    </header>
                    <div class="panel-body" style="display: block;">
                        <div class="">
                            <table class="table table-striped table-condensed table-hover mb-none" id="datatable_5col_b">
                                <thead>
                                    <tr>
                                        <th width="20%">MR Reference</th>
                                        <th width="30%">Principal</th>
                                        <th width="20%">Activity</th>
                                        <th width="20%">Date Created</th>
                                        <th width="10%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                    <?php foreach ($mr_for_update as $info):?>
                                        <tr>
                                            <td><a href="<?php echo BASE_URL;?>recruitment/forms/form_mr_manager/<?php echo $info['id'];?>"><?php echo $info['mr_ref'];?></a></td>
                                            <td><?php echo strtoupper($info['principal']);?><?php echo ($info['company']!='')?" - ".strtoupper($info['company']):"";?></td>
                                            <td><?php echo $info['activity'];?></td>
                                            <td><?php echo date("F d, Y", strtotime($info['add_date']));?></td>
                                            <td class="actions text-center">
                                                <a href="<?php echo BASE_URL;?>recruitment/forms/form_mr_manager/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit MR"><i class="fa fa-pencil"></i></a>
                                            	<a href="<?php echo BASE_URL;?>recruitment/delete/mr_manager/<?php echo $info['id'];?>" onclick="if(confirm('Are you sure you want to delete this record?')){return true;}else{return false;}" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>
            <?php endif;?>
		</div>
	</div>
	
	<!-- end: page -->
</section>