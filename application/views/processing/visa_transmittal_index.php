<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Processing - VISA Transmittal</h2>
	</header>

	<!-- start: page -->
	<?php flashNotification();?>

	<!-- <?php echo form_open('processing/search/transmittal/'.$visa_id, 'id="frm_search"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearch" class="form-control input-lg" placeholder="Transmittal No." autocomplete="off" value="<?php echo $this->input->post('textSearch');?>">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-blue-theme btn-lg" type="submit">Search</button>
            </span>
        </div>
	</form> -->

	<div class="row">
		<div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/transmittal/<?php echo $visa_info[0]['id'];?>'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create Transmittal</a>
                    <a href="<?php echo BASE_URL;?>processing/search/visa" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px; margin-right: 5px;"> VISA List</a>
                    <a href="<?php echo BASE_URL;?>processing/forms/visa/<?php echo $visa_info[0]['id'];?>" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px; margin-right: 5px;"> VISA No. <?php echo $visa_info[0]['visa_no'];?></a>
                    <h2 class="panel-title">&nbsp;</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_trans">
                            <thead>
                                <tr>
                                    <th>Transmittal No.</th>
                                    <th class="text-center">Transmittal Date</th>
                                    <th width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $info):?>
                                    <tr>
                                        <td><a href="<?php echo BASE_URL;?>processing/search/transmittal_alloc/<?php echo $info['id'];?>"><?php echo $info['transmittal_no'];?></a></td>
                                        <td class="text-center"><?php echo dateformat($info['transmittal_date'],1);?></td>
                                        <td class="actions text-center">
                                            <?php if(in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('delete_access'))):?>
                                            	<a href="javascript:void(0);" onclick="delete_processing('transmittal','<?php echo $info['visa_id'];?>','<?php echo $info['id'];?>');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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