<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Processing - VISA Manager</h2>
	</header>

	<!-- start: page -->
	<?php flashNotification();?>

	<?php echo form_open('processing/search/visa', 'id="frm_search"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearch" class="form-control input-lg" placeholder="VISA No./Principal Name" autocomplete="off" value="<?php echo $this->input->post('textSearch');?>">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-blue-theme btn-lg" type="submit">Search</button>
            </span>
        </div>
	</form>

	<div class="row">
		<div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <a href="<?php echo BASE_URL;?>processing/forms/visa" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create New VISA</a>
                    <h2 class="panel-title">&nbsp;</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_5col">
                            <thead>
                                <tr>
                                    <th>VISA No.</th>
                                    <th>Principal</th>
                                    <th>VISA Date</th>
                                    <th>Expiry Date</th>
                                    <th width="150px" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $info):?>
                                    <tr>
                                        <td><a href="<?php echo BASE_URL;?>processing/forms/visa/<?php echo $info['id'];?>"><?php echo $info['visa_no'];?></a></td>
                                        <td><?php echo $info['principal'];?></td>
                                        <td><?php echo dateformat($info['visa_date'],1);?></td>
                                        <td><?php echo dateformat($info['expiry_date'],1);?></td>
                                        <td class="actions text-center">
                                            <a href="<?php echo BASE_URL;?>processing/forms/visa/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a href="<?php echo BASE_URL;?>processing/search/transmittal/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="VISA Transmittal"><i class="fa fa-list"></i></a>
                                            <?php if(in_array(6, $_SESSION['rs_user']['delete_access'])):?>
                                            	<a href="javascript:void(0);" onclick="delete_processing('visa','<?php echo $info['id'];?>');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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