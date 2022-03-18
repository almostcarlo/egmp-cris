<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Recruitment Fee Guide - Search</h2>
	</header>

	<!-- start: page -->

	<?php echo form_open('settings/search/rec_fee', 'id="frm_search_city"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearchInput" class="form-control input-lg" placeholder="Principal/Company Name" autocomplete="off" value="<?php echo $this->input->post('textSearchInput');?>">
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
                        <a href="<?php echo BASE_URL?>settings/forms/rec_fee" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Recruitment Fee Guide</a>
                        <h2 class="panel-title">Recruitment Fee Guide List</h2>
                    </header>
                    <div class="panel-body" style="display: block;">
                        <div class="">
    					
                            <table class="table table-striped table-condensed table-hover mb-none" id="datatable_Search5Col">
                                <thead>
                                    <tr>
                                        <th width="25%">Principal</th>
                                        <th width="20%">Company</th>
                                        <th width="15%">Country</th>
                                        <th width="30%">Remarks</th>
                                        <th width="10%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <?php if($list):?>
                                    <tbody>
                                        <?php foreach ($list as $info):?>
                                            <tr>
                                                <td><a href="<?php echo BASE_URL;?>settings/forms/rec_fee/<?php echo $info['id'];?>" ><?php echo $info['principal'];?></a></td>
                                                <td><?php echo $info['company'];?></td>
                                                <td><?php echo $info['country'];?></td>
                                                <td><?php echo $info['remarks'];?></td>
                                                <td class="actions text-center">
                                                	<a href="<?php echo BASE_URL;?>settings/forms/rec_fee/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                	<a href="javascript:void(0);" onclick="settingsDelete('settings_recfee_hdr','<?php echo $info['id'];?>')" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                                </td>
                                            </tr>
                                        <?php endforeach;?>
                                    </tbody>
                                <?php endif;?>
                            </table>
                        
                        </div>
                    </div>
                </section>
                
    		</div>
    	</div>
	
	<!-- end: page -->
</section>