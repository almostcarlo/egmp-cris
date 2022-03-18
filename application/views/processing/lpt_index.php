<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Processing - LPT Manager</h2>
	</header>

	<!-- start: page -->
	<?php flashNotification();?>

	<?php echo form_open('processing/search/lpt', 'id="frm_search"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearch" class="form-control input-lg" placeholder="LPT No" autocomplete="off" value="<?php echo $this->input->post('textSearch');?>">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-blue-theme btn-lg" type="submit">Search</button>
            </span>
        </div>
	</form>

	<div class="row">
		<div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <a href="<?php echo BASE_URL;?>processing/forms/lpt" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create LPT</a>
                    <h2 class="panel-title">&nbsp;</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_lpt">
                            <thead>
                                <tr>
                                    <th>LPT No.</th>
                                    <th>Principal</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Confirmed Date</th>
                                    <th class="text-center">No. of Ticket</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($list as $info):?>
                                    <tr>
                                        <td><a href="<?php echo BASE_URL;?>processing/forms/lpt/<?php echo $info['id'];?>"><?php echo $info['code'];?></a></td>
                                        <td><?php echo $info['principal'];?> <?php echo ($info['company']<>'')?" - ".$info['company']:"";?></td>
                                        <td class="text-center"><?php echo dateformat($info['order_date'],1);?></td>
                                        <td class="text-center"><?php echo dateformat($info['confirmed_date'],1);?></td>
                                        <td class="text-center"><?php echo $info['ticket_no'];?></td>
                                        <td class="actions text-center">
                                            <a href="<?php echo BASE_URL;?>processing/forms/lpt/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            <!-- <a href="<?php echo BASE_URL;?>processing/forms/poea/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="JO List"><i class="fa fa-list"></i></a> -->
                                            <!-- <?php if(in_array(8, $_SESSION['rs_user']['delete_access'])):?>
                                            	<a href="javascript:void(0);" onclick="delete_processing('poea','<?php echo $info['id'];?>');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                            <?php endif;?> -->
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