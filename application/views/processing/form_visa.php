<?php
// var_dump($allocation);
// exit();
    if(isset($info)){
        $title = "Edit";
        $id = $info[0]['id'];
        $principal_id = $info[0]['principal_id'];
        $visa_no = $info[0]['visa_no'];
        $sponsor_no = $info[0]['sponsor_no'];
        $visa_date = $info[0]['visa_date'];
        $exp_date = $info[0]['expiry_date'];
        $closing_date = $info[0]['closing_date'];
        $remarks = $info[0]['remarks'];
        $arab_date_yy = substr($info[0]['visa_date_arabic'],0,4);
        $arab_date_dd = substr($info[0]['visa_date_arabic'],8,2);
        $arab_date_mm = substr($info[0]['visa_date_arabic'],5,2);
    }else{
        $title = "Add";
        $id = "";
        $principal_id = "";
        $visa_no = "";
        $sponsor_no = "";
        $visa_date = "";
        $exp_date = "";
        $closing_date = "";
        $remarks = "";
        $arab_date_yy = "";
        $arab_date_dd = "";
        $arab_date_mm = "";
    }
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Processing - VISA Manager</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-4">
            
			<section class="panel">
                <header class="panel-heading">
                	<a href="<?php echo BASE_URL;?>processing/search/visa" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> VISA List</a>
                    <?php if($id):?>
                        <a href="<?php echo BASE_URL;?>processing/search/transmittal/<?php echo $id;?>" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px; margin-right: 5px;"> VISA Transmittal</a>
                    <?php endif;?>
					<h3 class="panel-title">VISA Manager Form - <?php echo $title;?></h3>
				</header>
				<div class="panel-body">
				
                	<?php if($this->session->flashdata('settings_notification')):?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Success!</strong> <?php echo $this->session->flashdata('settings_notification')?>
                        </div>
                	<?php endif;?>
                    
                    <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                        <strong>ERROR!</strong><br>
                        <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
                    </div>
                    
                	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                        <strong>SUCCESS!</strong><br>
                        <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
                    </div>
                    
                    <?php echo form_open_multipart('processing/save/visa', 'id="frm_processing"');?>
                    
                    	<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
                        
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">VISA No.:</label>
                                            <input type="text" id="textVISANo" name="textVISANo" autocomplete="off" value="<?php echo $visa_no;?>" <?php echo ($id)?"readonly=\"readonly\"":""?> class="form-control input-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Sponsor ID:</label>
                                            <input type="text" id="textSponsorNo" name="textSponsorNo" value="<?php echo $sponsor_no;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                
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
                                    <div class="col-md-2 mt-sm">
                                        <div class="form-group">
                                            <label for="">Arabic Date:</label>
                                            <input type="text" id="textArabDateYY" name="textArabDateYY" autocomplete="off" placeholder="yyyy" value="<?php echo $arab_date_yy;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group">
                                            <label for=""></label>
                                            <select id="SelectArabDateMM" name="SelectArabDateMM" class="form-control input-sm">
                                                <option value="">mm</option>
                                                <option value="01" <?php echo ($arab_date_mm=='01')?"selected=\"selected\"":"";?>>Muharram (01)</option>
                                                <option value="02" <?php echo ($arab_date_mm=='02')?"selected=\"selected\"":"";?>>Safar (02)</option>
                                                <option value="03" <?php echo ($arab_date_mm=='03')?"selected=\"selected\"":"";?>>Rabi' I (03)</option>
                                                <option value="04" <?php echo ($arab_date_mm=='04')?"selected=\"selected\"":"";?>>Rabi' II (04)</option>
                                                <option value="05" <?php echo ($arab_date_mm=='05')?"selected=\"selected\"":"";?>>Jumada I (05)</option>
                                                <option value="06" <?php echo ($arab_date_mm=='06')?"selected=\"selected\"":"";?>>Jumada II (06)</option>
                                                <option value="07" <?php echo ($arab_date_mm=='07')?"selected=\"selected\"":"";?>>Rajab (07)</option>
                                                <option value="08" <?php echo ($arab_date_mm=='08')?"selected=\"selected\"":"";?>>Sha'aban (08)</option>
                                               	<option value="09" <?php echo ($arab_date_mm=='09')?"selected=\"selected\"":"";?>>Ramadan (09)</option>
                                               	<option value="10" <?php echo ($arab_date_mm=='10')?"selected=\"selected\"":"";?>>Shawwal (10)</option>
                                               	<option value="11" <?php echo ($arab_date_mm=='11')?"selected=\"selected\"":"";?>>Dhu al-Qi'dah (11)</option>
                                               	<option value="12" <?php echo ($arab_date_mm=='12')?"selected=\"selected\"":"";?>>Dhu al-Hijjah (12)</option> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-1 mt-sm">
                                        <div class="form-group">
                                            <label for="">&nbsp</label>
                                            <input type="text" id="textArabDateDD" name="textArabDateDD" autocomplete="off" placeholder="dd" value="<?php echo $arab_date_dd;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">VISA Date (Gregorian):</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textVISADate" name="textVISADate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($visa_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Expiry Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textExpDate" name="textExpDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($exp_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Date Closed:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textCloseDate" name="textCloseDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($closing_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Remarks:</label>
                                            <textarea rows="5" class="form-control input-sm" name="textRemarks" id="textRemarks"><?php echo $remarks;?></textarea>
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
    		<div class="col-md-8">
    			<section class="panel">
                    <header class="panel-heading">
                    	<a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/visa/<?php echo $id;?>'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> Add Position</a>
    					<h3 class="panel-title">VISA Position</h3>
    				</header>
    				<div class="panel-body">
                        <div class="">
    					
                            <table class="table table-striped table-condensed table-hover mb-none" id="datatable_6col">
                                <thead>
                                    <tr>
                                        <th width="20%">Position/Category</th>
                                        <th class="text-center" width="10%">Gender</th>
                                        <th class="text-right" width="10%">Quantity</th>
                                        <th class="text-right" width="10%">Allocation</th>
                                        <th class="text-right" width="10%">Pending</th>
                                        <th class="text-center" width="10%">Authority No.</th>
                                        <th width="20%">Remarks</th>
                                        <th width="10%" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($pos_list as $info):?>
                                        <tr>
                                            <td><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/visa/<?php echo $id;?>/<?php echo $info['id'];?>'});"><?php echo $info['position'];?></a></td>
                                            <td class="text-center"><?php echo ($info['gender']=='M')?"Male":"Female";?></td>
                                            <td class="text-right" style="padding-right:20px;"><?php echo $info['quantity'];?></td>
                                            <td class="text-right" style="padding-right:20px;">
                                                <!-- APPROVED ALLOCATION -->
                                                <?php if(isset($allocation['approved'][$info['id']])):?>
                                                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/view_allocation/<?php echo $info['id'];?>/1'});"><?php echo count($allocation['approved'][$info['id']]);?></a>
                                                <?php else:?>
                                                    0
                                                <?php endif;?>
                                            </td>
                                            <td class="text-right" style="padding-right:20px;">
                                                <!-- PENDING ALLOCATION -->
                                                <?php if(isset($allocation['pending'][$info['id']])):?>
                                                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/view_allocation/<?php echo $info['id'];?>/0'});"><?php echo count($allocation['pending'][$info['id']]);?></a>
                                                <?php else:?>
                                                    0
                                                <?php endif;?>
                                            </td>
                                            <td class="text-center"><?php echo $info['authority_no'];?></td>
                                            <td><?php echo $info['remarks'];?></td>
                                            <td class="actions text-center">
                                                <!-- ADD ALLOCATION -->
                                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/visa_alloc/<?php echo $id;?>/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="Add Allocation" data-original-title="Add Allocation"><i class="fa fa-user"></i></a>

                                                <!-- EDIT CATEGORY-->
                                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/visa/<?php echo $id;?>/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit Category"><i class="fa fa-pencil"></i></a>

                                                <!-- DELETE -->
                                                <?php if(in_array(7, $_SESSION['rs_user']['delete_access'])):?>
                                                	<a href="javascript:void(0);" onclick="delete_processing('visa_pos','<?php echo $id;?>','<?php echo $info['id'];?>');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
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