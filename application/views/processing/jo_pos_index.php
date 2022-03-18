<?php
// var_dump($hdr_info);
// exit();
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Job Order Categories</h2>
	</header>

	<!-- start: page -->
	<?php flashNotification();?>

	<div class="row">
		<div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                	<a href="<?php echo BASE_URL;?>processing/forms/poea/<?php echo $hdr_info[0]['poea_id'];?>" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> back to Job Order List</a>
                    <h2 class="panel-title">&nbsp;</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Principal:</label>
                                <input type="text" id="" name="" value="<?php echo $hdr_info[0]['principal'];?>" readonly="readonly" class="form-control input-sm" />
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Accreditation No.:</label>
                                <input type="text" id="" name="" value="<?php echo $hdr_info[0]['accre_no'];?>" readonly="readonly" class="form-control input-sm" />
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Date Issued:</label>
                                <input type="text" id="" name="" value="<?php echo dateformat($hdr_info[0]['issue_date'],1);?>" readonly="readonly" class="form-control input-sm" />
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Expiry Date:</label>
                                <input type="text" id="" name="" value="<?php echo dateformat($hdr_info[0]['expiry_date'],1);?>" readonly="readonly" class="form-control input-sm" />
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Job Order ID:</label>
                                <input type="text" id="" name="" value="<?php echo $hdr_info[0]['jo_id'];?>" readonly="readonly" class="form-control input-sm" />
                            </div>
                        </div>
                        
                        <div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Job Ref:</label>
                                <input type="text" id="" name="" value="<?php echo $hdr_info[0]['jo_ref'];?>" readonly="readonly" class="form-control input-sm" />
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Date Approved:</label>
                                <input type="text" id="" name="" value="<?php echo dateformat($hdr_info[0]['approved_date'],1);?>" readonly="readonly" class="form-control input-sm" />
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Date Submitted:</label>
                                <input type="text" id="" name="" value="<?php echo dateformat($hdr_info[0]['submit_date'],1);?>" readonly="readonly" class="form-control input-sm" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/jo_pos/<?php echo $hdr_info[0]['poea_jo_id'];?>'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create JO Category</a>
                    <h2 class="panel-title">&nbsp;</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable">
                            <thead>
                                <tr>
                                    <th>Position</th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Allocation</th>
                                    <th class="text-center">Balance</th>
                                    <th>Remarks</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($pos_list as $info):?>
                                    <tr>
                                        <td width="20%"><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/jo_pos/<?php echo $hdr_info[0]['poea_jo_id'];?>/<?php echo $info['id'];?>'});"><?php echo $info['position'];?></a></td>
                                        <td width="10%" class="text-center"><?php echo $info['quantity'];?></td>
                                        <td width="10%" class="text-center">
                                            <?php
                                                if(array_key_exists($info['id'], $pos_allocation)){
                                                    echo "<a href=\"javascript:void(0);\" onclick=\"$.facebox({ajax:base_url_js+'processing/facebox/view_jo_allocation/{$info['id']}'});\">".count($pos_allocation[$info['id']])."</a>";
                                                }else{
                                                    echo "0";
                                                }
                                            ?>
                                        </td>
                                        <td width="10%" class="text-center">
                                            <?php
                                                if(array_key_exists($info['id'], $pos_allocation)){
                                                    echo ($info['quantity'] - intval(count($pos_allocation[$info['id']])));
                                                }else{
                                                    echo $info['quantity'];
                                                }
                                            ?>
                                        </td>
                                        <td width="40%"><?php echo $info['remarks'];?></td>
                                        <td class="actions text-center">
                                            <!-- ADD ALLOCATION -->
                                            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/jo_alloc/<?php echo $hdr_info[0]['poea_jo_id'];?>/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="Add Allocation" data-original-title="Add Allocation"><i class="fa fa-user"></i></a>

                                            <!-- EDIT JO POS -->
                                            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/jo_pos/<?php echo $hdr_info[0]['poea_jo_id'];?>/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit JO Category"><i class="fa fa-pencil"></i></a>

                                            <!-- DELETE -->
                                            <?php if(in_array(8, $_SESSION['rs_user']['delete_access'])):?>
                                            	<a href="javascript:void(0);" onclick="delete_processing('jo_pos','<?php echo $hdr_info[0]['poea_jo_id'];?>','<?php echo $info['id'];?>');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete JO Category"><i class="fa fa-trash-o"></i></a>
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