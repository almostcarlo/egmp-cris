<?php
if(isset($info)){
    $id = $info[0]['id'];
    $sent_date = date("m/d/Y", strtotime($info[0]['sent_date']));
    $principal_id = $info[0]['principal_id'];
    $company_id = $info[0]['company_id'];
    $attention = $info[0]['attention'];
    $from = $info[0]['from'];
    $subject = $info[0]['subject'];
    $message= $info[0]['message'];
    $trans_no = $info[0]['transmittal_no'];
    
    get_items_from_cache('principal');
}else{
    $id = "";
    $sent_date = "";
    $principal_id = "";
    $company_id = "";
    $attention = "";
    $from = "";
    $subject = "";
    $message= '';
    $trans_no = "";
}
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>CV Sending Transmittal</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-6">
            
			<section class="panel">
                <header class="panel-heading">
                	<a href="<?php echo BASE_URL;?>recruitment/lists/cv_transmittal" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> CV Sending Transmittal List</a>
					<h3 class="panel-title"><strong>Step 1.</strong> Create Transmittal</h3>
				</header>
				<div class="panel-body">
				
					<?php if(isset($_SESSION['settings_notification_status']) && $_SESSION['settings_notification_status'] == 'Success'):?>
                    	<div id="" class="alert alert-success alert-dismissible" role="alert">
                            <strong>SUCCESS!</strong><br>
                            <div id=""><strong><span id="inputRequired"></span></strong><?php echo $_SESSION['settings_notification'];?></div>
                        </div>
					<?php endif;?>
					
					<?php if(isset($_SESSION['settings_notification_status']) && $_SESSION['settings_notification_status'] == 'Error'):?>
                        <div id="" class="alert alert-danger alert-dismissible" role="alert">
                            <strong>ERROR!</strong><br>
                            <div id=""><strong><span id="inputRequired"></span></strong><?php echo $_SESSION['settings_notification'];?></div>
                        </div>
					<?php endif;?>
				
                    <div id="errorNotice" class="alert alert-danger alert-dismissible" role="alert">
                        <strong>ERROR!</strong><br>
                        <div id="defaultNoticeCont"><strong><span id="inputRequired"></span></strong></div>
                    </div>
                    
                    <?php echo form_open('recruitment/create/cv_transmittal', 'id="frm_create"');?>
                    	<input type="hidden" name="textRecordId" value="<?php echo $id;?>" />
                        
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <label for="">Sent Date<span class="required">*</span>:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textSentDate" name="textSentDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo $sent_date;?>">
                                    </div>
                                </div>
                            </div>
                            <?php if($id):?>
                                <div class="col-md-3 mt-sm">
                                    <div class="form-group">
                                        <label for="">Transmittal No.:</label>
                                        <input type="text" id="" name="" autocomplete="off" readonly="readonly" class="form-control input-sm" value="<?php echo $trans_no;?>" />
                                    </div>
                                </div>
                            <?php endif;?>
                        </div>
                        
                        <div class="row" id="">
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <label for="">Principal<span class="required">*</span>:</label>
                                    <?php if(!$id):?>
                                        <select id="selectPrincipal" name="textPrincipalId" onchange="populatedd('company', 'principal', '#selectPrincipal');" class="form-control input-sm">
                                            <?php echo dropdown_options('principal', $principal_id);?>
                                        </select>
                                    <?php else:?>
                                    	<p><?php echo strtoupper($_SESSION['settings']['principal'][$principal_id]);?></p>
                                    <?php endif;?>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <label for="">Company:</label>
                                    <?php if(!$id):?>
                                        <select id="selectCompany" name="selectCompany" onchange="" class="form-control input-sm">
                                            <option value="">--Please select</option>
                                        </select>
                                    <?php else:?>
                                    	<p><?php echo (isset($_SESSION['settings']['company'][$company_id]))?strtoupper($_SESSION['settings']['company'][$company_id]):"";?></p>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mt-sm">
                                <div id="divEmail" class="form-group">
                                    <label for="textAttention">Attention:</label>
                                    <textarea class="form-control input-sm" id="" name="textAttention"><?php echo $attention;?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="divEmail" class="form-group">
                                    <label for="">From:</label>
                                    <input type="text" id="" name="textFrom" autocomplete="off" class="form-control input-sm" value="<?php echo $from;?>" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mt-sm">
                                <div id="divEmail" class="form-group">
                                    <label for="">Subject:</label>
                                    <textarea class="form-control input-sm" id="" name="textSubject"><?php echo $subject;?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 mt-sm">
                                <div id="divEmail" class="form-group">
                                    <label for="">Message:</label>
                                    <textarea class="form-control input-sm" id="" name="textMsg" rows="4"><?php echo $message;?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <hr />

                        <div class="row">
                            <div class="col-sm-12">
                                <input type="button" value="Save" class="btn btn-block btn-primary" id="btn_createcv" onclick="save_cvtrans();">
                            </div>
                        </div>
                        
                    </form>
                    
                </div>
            </section>
        </div>
        
        <?php if(isset($app_list)):?>
            <div class="col-md-6">
    			<section class="panel">
                    <header class="panel-heading">
    					<h3 class="panel-title"><strong>Step 2.</strong> Select Applicant</h3>
    				</header>
    				<div class="panel-body">
    				
                            <div id="cont_cv_initial" class="">
        					
                                <table class="table table-striped table-condensed table-hover mb-none" id="datatable_cvtrans_app">
                                    <thead>
                                        <tr>
                                            <th width="15%">applicant ID</th>
                                            <th width="35%">Name</th>
                                            <th width="40%">Position</th>
                                            <th width="10%" class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($app_list as $info):?>
                                            <tr id="tr_<?php echo $info['applicant_id'];?>">
                                                <td><a href="<?php echo BASE_URL;?>profile/<?php echo $info['applicant_id'];?>/lineup" target="_blank"><?php echo $info['applicant_id'];?></a></td>
                                                <td><?php echo strtoupper(nameformat($info['fname'], $info['mname'], $info['lname'], 1));?></td>
                                                <td><?php echo $info['position'];?></td>
                                                <td class="actions text-center">
                                                	<a href="<?php echo BASE_URL;?>profile/<?php echo $info['applicant_id'];?>/lineup" data-toggle="tooltip" data-placement="top" title="" data-original-title="view profile" target="_blank"><i class="fa fa-eye"></i></a>
                                                    <a href="javascript:sendtoinitial('<?php echo $info['applicant_id'];?>','<?php echo $id;?>', '<?php echo $info['lineup_id'];?>');" data-toggle="tooltip" data-placement="top" title="" data-original-title="add to list"><i class="fa fa-plus"></i></a>
                                                    <?php /*if(in_array(5, $_SESSION['rs_user']['delete_access'])):?>
                                                    	<a href="<?php echo BASE_URL;?>recruitment/delete/cv_transmittal/<?php echo $info['applicant_id'];?>" onclick="if(confirm('Are you sure you want to delete this record?')){return true;}else{return false;}" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                                    <?php endif;*/?>
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
		
		<?php if($id):?>
    		<div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                    	<a href="javascript:updateCVStat();" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> Update CV Status</a>
                		<h3 class="panel-title">Selected for CV Sending</h3>
                	</header>
                	<div class="panel-body">
                	
                		<div id="cont_cv_selected"></div>
                	
                        <!-- <div id="errorNotice" class="alert alert-danger alert-dismissible" role="alert">
                            <strong>ERROR!</strong><br>
                            <div id="defaultNoticeCont"><strong><span id="inputRequired"></span></strong></div>
                        </div> -->
                
                    </div>
                </section>
    		</div>
		<?php endif;?>
	<!-- end: page -->
</section>
<script>
	var current_trans_id = '<?php echo $id;?>';
</script>