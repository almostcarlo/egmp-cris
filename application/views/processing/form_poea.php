<?php
    if(isset($info)){
        $title = "Edit";
        $id = $info[0]['id'];
        $principal_id = $info[0]['principal_id'];
        $accre_no = $info[0]['accre_no'];
        $issue_date = $info[0]['issue_date'];
        $exp_date = $info[0]['expiry_date'];
        $remarks = $info[0]['remarks'];
    }else{
        $title = "Add";
        $id = "";
        $principal_id = "";
        $accre_no = "";
        $issue_date = "";
        $exp_date = "";
        $remarks = "";
    }
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>POEA Manager</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-3">
            
			<section class="panel">
                <header class="panel-heading">
                	<a href="<?php echo BASE_URL;?>processing/search/poea" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> POEA Job Order List</a>
					<h3 class="panel-title">POEA Manager Form - <?php echo $title;?></h3>
				</header>
				<div class="panel-body">
				
                	<?php flashNotification();?>
                    
                    <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                        <strong>ERROR!</strong><br>
                        <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
                    </div>
                    
                	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                        <strong>SUCCESS!</strong><br>
                        <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
                    </div>
                    
                    <?php echo form_open('processing/save/poea', 'id="frm_processing"');?>
                    
                    	<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
                        
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="SelectPrincipal">Principal:</label>
                                            <select id="SelectPrincipal" name="SelectPrincipal" class="form-control input-sm">
                                                <?php echo dropdown_options('principal', $principal_id);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Accreditation No.:</label>
                                            <input type="text" id="textAccreNo" name="textAccreNo" autocomplete="off" value="<?php echo $accre_no;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Date Issued:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textIssueDate" name="textIssueDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($issue_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Accre Expiry Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textExpDate" name="textExpDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($exp_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Remarks:</label>
                                            <textarea rows="6" class="form-control input-sm" name="textRemarks" id="textRemarks"><?php echo $remarks;?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />

                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="button" class="btn btn-block btn-primary" value="Submit" id="btn_submit">
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </form>
                    
                </div>
            </section>
		</div>
		
		<?php if($id!=''):?>
    		<div class="col-md-9">
    			<section class="panel">
                    <header class="panel-heading">
                    	<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/poea_jo/<?php echo $id;?>'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add JO</a>
    					<h3 class="panel-title">Job Order List</h3>
    				</header>
    				<div class="panel-body">
                        <div class="">
    					
                            <table class="table table-striped table-condensed table-hover mb-none" id="datatable">
                                <thead>
                                    <tr>
                                        <th width="10%">Job Order ID</th>
                                        <th width="10%" class="text-center">Date Approved</th>
                                        <th width="10%" class="text-center">Date Submitted</th>
                                        <th width="10%" class="text-center">Validity Date</th>
                                        <th width="10%" class="text-center">Categories</th>
                                        <th width="10%" class="text-center">Allocation</th>
                                        <th width="10%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($jo_list as $info):?>
                                        <tr>
                                            <td><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/poea_jo/<?php echo $id;?>/<?php echo $info['id'];?>'});"><?php echo $info['jo_id'];?></a></td>
                                            <td class="text-center"><?php echo dateformat($info['approved_date'], 1)?></td>
                                            <td class="text-center"><?php echo dateformat($info['submit_date'], 1)?></td>
                                            <td class="text-center"><?php echo dateformat($info['expiry_date'], 1)?></td>
                                            <td class="text-center"><a href="<?php echo BASE_URL;?>processing/search/jo_pos/<?php echo $info['id'];?>"><?php echo (array_key_exists($info['id'], $jo_pos_list))?count($jo_pos_list[$info['id']]):"0";?></a></td>
                                            <td class="text-center">
                                                <?php //echo (array_key_exists($info['id'], $jo_allocation))?count($jo_allocation[$info['id']]):"0";?>
                                                <?php
                                                    if(array_key_exists($info['id'], $jo_allocation)){
                                                        echo "<a href=\"javascript:void(0);\" onclick=\"$.facebox({ajax:base_url_js+'processing/facebox/view_jo_allocation/{$info['id']}?all=true'});\">".count($jo_allocation[$info['id']])."</a>";
                                                    }else{
                                                        echo "0";
                                                    }
                                                ?>
                                            </td>
                                            <td class="actions text-center">
                                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/poea_jo/<?php echo $id;?>/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                                <a href="<?php echo BASE_URL;?>processing/search/jo_pos/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="JO Categories"><i class="fa fa-list"></i></a>
                                                
                                                <!-- DISABLE DELETE IF ALLOCATION > 0 -->
                                                
                                                <?php if(in_array(8, $_SESSION['rs_user']['delete_access'])):?>
                                                	<a href="javascript:void(0);" onclick="delete_processing('poea_jo','<?php echo $id;?>','<?php echo $info['id'];?>');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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
		<?php endif;?>
	</div>
	<!-- end: page -->
</section>