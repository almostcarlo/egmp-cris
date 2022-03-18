<?php
// var_dump($arabic_date);
// var_dump($visa_info);
// exit();
    if($visa_info[0]['visa_date_arabic'] <> ''){
        $arabic_date = substr($visa_info[0]['visa_date_arabic'], 0,4)." ".$arabic_date[substr($visa_info[0]['visa_date_arabic'], 5,2)]." ".substr($visa_info[0]['visa_date_arabic'], 8);
    }else{
        $arabic_date = "";
    }
    
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Processing - VISA Transmittal</h2>
	</header>

	<!-- start: page -->
	<?php flashNotification();?>

	<div class="row">
		<div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                	<a href="<?php echo BASE_URL;?>processing/search/transmittal/<?php echo $visa_info[0]['visa_id'];?>" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> Transmittal List</a>
                    <h2 class="panel-title">Transmittal No.: <strong><?php echo $visa_info[0]['transmittal_no'];?></strong><br>Date: <strong><?php echo dateformat($visa_info[0]['transmittal_date'],1);?></strong></h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">VISA No.:</label>
                                <p><strong><?php echo $visa_info[0]['visa_no'];?></strong></p>
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Sponsor ID:</label>
                                <p><strong><?php echo $visa_info[0]['sponsor_no'];?></strong></p>
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Principal:</label>
                                <p><strong><?php echo $visa_info[0]['principal'];?></strong></p>
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Country:</label>
                                <p><strong><?php echo $visa_info[0]['country'];?></strong></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">VISA Date (Arabic):</label>
                                <p><strong><?php echo $arabic_date?></strong></p>
                            </div>
                        </div>
                        
                        <div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">VISA Date (Gregorian):</label>
                                <p><strong><?php echo dateformat($visa_info[0]['visa_date'],1);?></strong></p>
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Expiry Date:</label>
                                <p><strong><?php echo dateformat($visa_info[0]['expiry_date'],1);?></strong></p>
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Date Closed:</label>
                                <p><strong><?php echo dateformat($visa_info[0]['closing_date'],1);?></strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-sm">
                            <div class="form-group">
                                <label for="">Remarks:</label>
                                <p><strong><?php echo $visa_info[0]['remarks'];?></strong></p>
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
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/add_applicant/<?php echo $visa_info[0]['visa_id'];?>/<?php echo $visa_info[0]['transmittal_id'];?>'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Applicant</a>
                    <h2 class="panel-title">Selected Applicants</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Name</th>
                                    <th>VISA Category</th>
                                    <th class="text-center">E-Code</th>
                                    <th class="text-center">Auth</th>
                                    <th class="text-center">Submitted</th>
                                    <th class="text-center">Released</th>
                                    <th width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $n = 1;
                                    if($alloc_info){
                                        foreach($alloc_info as $i){
                                ?>
                                            <tr>
                                                <td><?php echo $n;?>.</td>
                                                <td><?php echo nameformat($i['fname'],$i['mname'],$i['lname'])?></td>
                                                <td><?php echo $i['approved_cat'];?></td>
                                                <td class="text-center"><?php echo $i['transmittal_ecode'];?></td>
                                                <td class="text-center"><?php echo $i['transmittal_auth'];?></td>
                                                <td class="text-center"><?php echo dateformat($i['transmittal_submit_date'],5);?></td>
                                                <td class="text-center"><?php echo dateformat($i['transmittal_release_date'],5);?></td>
                                                <td class="text-center">
                                                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/edit_applicant/<?php echo $i['applicant_processing_id'];?>/<?php echo $visa_info[0]['transmittal_id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                    <a href="<?php echo BASE_URL;?>processing/print_page/emb_form/<?php echo $i['applicant_processing_id'];?>" target="_blank" data-toggle="tooltip" data-placement="top" title="" data-original-title="Emb Transmittal"><i class="fa fa-print"></i></a>
                                                </td>
                                            </tr>
                                <?php
                                            $n++;
                                        }
                                    }else{
                                ?>
                                        <tr>
                                            <td class="text-center" colspan="99">No data available in table.</td>
                                        </tr>
                                <?php
                                    }
                                /*foreach ($pos_list as $info):?>
                                    <tr>
                                        <td width="20%"><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/jo_pos/<?php echo $visa_info[0]['poea_jo_id'];?>/<?php echo $info['id'];?>'});"><?php echo $info['position'];?></a></td>
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
                                        <td width="10%" class="actions text-center">
                                            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/jo_pos/<?php echo $visa_info[0]['poea_jo_id'];?>/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            <?php if(in_array(8, $_SESSION['rs_user']['delete_access'])):?>
                                            	<a href="javascript:void(0);" onclick="delete_processing('jo_pos','<?php echo $visa_info[0]['poea_jo_id'];?>','<?php echo $info['id'];?>');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                            <?php endif;?>
                                        </td>
                                    </tr>
                                <?php endforeach;*/?>
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </section>
            
		</div>
	</div>
	<!-- end: page -->
</section>