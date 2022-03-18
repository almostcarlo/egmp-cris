<?php
    if(isset($info)){
        $id = $info[0]['id'];
        $name = $info[0]['name'];
        $code = $info[0]['code'];
        $address = $info[0]['address'];
        $contact_person = $info[0]['contact_person'];
        $tel_no = $info[0]['tel_no'];
        $fax_no = $info[0]['fax_no'];
        $email = $info[0]['email'];
        $remarks = $info[0]['remarks'];
        $title = "Edit";
    }else{
        $id = "";
        $name = "";
        $code = "";
        $address = "";
        $contact_person = "";
        $tel_no = "";
        $fax_no = "";
        $email = "";
        $remarks = "";
        $title = "Add";
    }
?>
<section role="main" class="content-body">
                    
	<header class="page-header">
		<h2>Settings - Clinic</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-6">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">Clinic Manager Form - <?php echo $title;?></h3>
				</header>
				<div class="panel-body">
                    
                	<?php if($this->session->flashdata('settings_notification')):?>
                        <div class="alert alert-<?php echo ($this->session->flashdata('settings_notification_status')=='Error')?"danger":"success";?>">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong><?php echo ($this->session->flashdata('settings_notification_status')=='Error')?"Error":"Success"?>!</strong> <?php echo $this->session->flashdata('settings_notification')?>
                        </div>
                	<?php endif;?>
                    
                    <div id="settings_noticeError" class="alert alert-danger hidden">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <div id="errorMsg_Cont"><strong><span id="inputRequired"></span></strong>[error message here]</div>
                    </div>
                    
                    <?php echo form_open('settings/save/clinic', 'id="frm_add_clinic"');?>
                    
                    	<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>"> 
                        
                        <div class="row">
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textName">Clinic Name:</label>
                                    <input type="text" id="textName" name="textName" value="<?php echo $name;?>" class="form-control input-sm" />
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textCode">Code:</label>
                                    <input type="text" id="textCode" name="textCode" value="<?php echo $code;?>" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-12 col-sm-3">
                                <div class="form-group">
                                    <label for="textAddress">Address:</label>
                                    <textarea name="textAddress" id="textAddress" rows="" cols="" class="form-control input-sm"><?php echo $address;?></textarea>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group" id="divUsername">
                                    <label for="textContact">Contact Person:</label>
                                    <input type="text" id="textContact" name="textContact" value="<?php echo $contact_person;?>" autocomplete="off" class="form-control input-sm" />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-4">
                                <div class="form-group">
                                    <label for="textTelNo">Tel No.:</label>
                                    <input type="text" id="textTelNo" name="textTelNo" value="<?php echo $tel_no;?>" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
							<div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textFax">Fax No.:</label>
                                    <input type="text" id="textFax" name="textFax" value="<?php echo $fax_no;?>" class="form-control input-sm" />
                                </div>
                            </div>
							<div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textEmail">Email:</label>
                                    <input type="text" id="textEmail" name="textEmail" value="<?php echo $email;?>" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
							<div class="col-md-12 col-sm-3">
                                <div class="form-group">
                                    <label for="textRemarks">Remarks:</label>
                                    <textarea name="textRemarks" id="textRemarks" rows="" cols="" class="form-control input-sm"><?php echo $remarks;?></textarea>
                                </div>
                            </div>
                        </div>

                        <hr />

                        <div class="row">
                            <div class="col-md-6 col-sm-3">
                                <input type="submit" class="btn btn-block btn-primary" value="Submit" id="">
                            </div>
                            <div class="col-md-6 col-sm-3">
                                <a href="<?php echo BASE_URL;?>settings/search/clinic" class="btn btn-block btn-danger">Cancel</a>
                            </div>
                        </div>
                                
                        
                    </form>
                    
                </div>
            </section>
            
		</div>
	</div>
	<!-- end: page -->
</section>