<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>POEA Manager</h2>
	</header>

	<!-- start: page -->
	<?php flashNotification();?>

	<?php echo form_open('processing/search/poea', 'id="frm_search"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearch" class="form-control input-lg" placeholder="Accreditation No./Principal Name" autocomplete="off" value="<?php echo $this->input->post('textSearch');?>">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-blue-theme btn-lg" type="submit">Search</button>
            </span>
        </div>
	</form>

	<div class="row">
		<div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <a href="<?php echo BASE_URL;?>processing/forms/poea" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create Job Order</a>
                    <h2 class="panel-title">&nbsp;</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_5col">
                            <thead>
                                <tr>
                                    <th>Principal</th>
                                    <th>Accreditation No.</th>
                                    <th>Date Issued</th>
                                    <th>Expiry Date</th>
                                    <th width="150px" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $info):?>
                                    <tr>
                                        <td><a href="<?php echo BASE_URL;?>processing/forms/poea/<?php echo $info['id'];?>"><?php echo $info['principal'];?></a></td>
                                        <td><?php echo $info['accre_no'];?></td>
                                        <td><?php echo dateformat($info['issue_date'],1);?></td>
                                        <td><?php echo dateformat($info['expiry_date'],1);?></td>
                                        <td class="actions text-center">
                                            <a href="<?php echo BASE_URL;?>processing/forms/poea/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo BASE_URL;?>processing/forms/poea/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="JO List"><i class="fa fa-list"></i></a>
                                            <?php if(in_array(8, $_SESSION['rs_user']['delete_access'])):?>
                                            	<a href="javascript:void(0);" onclick="delete_processing('poea','<?php echo $info['id'];?>');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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