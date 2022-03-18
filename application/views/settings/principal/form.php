<?php
    if(isset($info)){
        $title = "Edit";
        $id = $info[0]['id'];
        $name = $info[0]['name'];
        $code = $info[0]['code'];
        $address = $info[0]['address'];
        $city = $info[0]['city'];
        $country_id= $info[0]['country_id'];
        $nature_id = $info[0]['nature_id'];
        $tel_no = $info[0]['tel_no'];
        $fax_no = $info[0]['fax_no'];
        $email = $info[0]['email'];
        $website = $info[0]['website'];
        $facebook = $info[0]['facebook'];
        $linkedin = $info[0]['linkedin'];
        $doc_logo = $info[0]['doc_logo'];
        $doc_svc_agree = $info[0]['doc_svc_agree'];
        $doc_rec = $info[0]['doc_rec'];
        $accre_no = $info[0]['accre_no'];
        $desc = $info[0]['description'];
    }else{
        $title = "Add";
        $id = "";
        $name = "";
        $code = "";
        $address = "";
        $city = "";
        $nature_id = 8;
        $country_id = 231;
        $tel_no = "";
        $fax_no = "";
        $email = "";
        $website = "";
        $facebook = "";
        $linkedin = "";
        $doc_logo = "";
        $doc_svc_agree = "";
        $doc_rec = "";
        $accre_no = "";
        $desc = "";
    }
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Settings - Principal</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-6">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">Principal Manager Form - <?php echo $title;?></h3>
				</header>
				<div class="panel-body">
				
                	<?php if($this->session->flashdata('settings_notification')):?>
                        <div class="alert alert-success">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong>Success!</strong> <?php echo $this->session->flashdata('settings_notification')?>
                        </div>
                	<?php endif;?>
                    
                    <div id="settings_noticeError" class="alert alert-danger hidden">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <div id="errorMsg_Cont"><strong><span id="inputRequired"></span></strong>[error message here]</div>
                    </div>
                    
                    <?php echo form_open_multipart('settings/save/principal', 'id="frm_add_principal"');?>
                    
                    	<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
                        
                        <div class="row">
                            <div class="col-md-12">
                                
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="fileLogo">Principal Logo:</label>
                                            <?php if(!$doc_logo):?>
                                            	<input type="file" id="fileLogo" name="fileLogo" class="form-control input-sm" />
                                        	<?php else:?>
                                        		<br>
                                        		<a href="<?php echo BASE_URL."settings/files/logo/".base64_encode($id);?>" target="_blank" class=""><?php echo $doc_logo;?></a>
                                        		<a href="javascript:void(0);" onclick="DeleteFile('logo', '<?php echo $id;?>');" style="color:red;">[delete]</a>
                                        	<?php endif;?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="fileServiceAgreement">Service Agreement:</label>
                                            <?php if(!$doc_svc_agree):?>
                                            	<input type="file" id="fileServiceAgreement" name="fileServiceAgreement" class="form-control input-sm" />
                                            <?php else:?>
                                            	<br>
                                            	<a href="<?php echo BASE_URL."settings/files/svc/".base64_encode($id);?>" target="_blank" class=""><?php echo $doc_svc_agree;?></a>
                                            	<a href="javascript:void(0);" onclick="DeleteFile('svc', '<?php echo $id;?>');" style="color:red;">[delete]</a>
                                        	<?php endif;?>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="fileRecruitmentDocument">Recruitment Document:</label>
                                            <?php if(!$doc_rec):?>
                                            	<input type="file" id="fileRecruitmentDocument" name="fileRecruitmentDocument" class="form-control input-sm" />
                                        	<?php else:?>
                                        		<br>
                                        		<a href="<?php echo BASE_URL."settings/files/rec/".base64_encode($id);?>" target="_blank" class=""><?php echo $doc_rec;?></a>
                                        		<a href="javascript:void(0);" onclick="DeleteFile('rec', '<?php echo $id;?>');" style="color:red;">[delete]</a>
                                            <?php endif;?>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="textPrincipalCode">Principal Code:</label>
                                            <input type="text" id="textPrincipalCode" name="textPrincipalCode" autocomplete="off" value="<?php echo $code;?>" <?php echo ($id)?"readonly=\"readonly\"":""?> class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="textPrincipalName">Principal Name:</label>
                                            <input type="text" id="textPrincipalName" name="textPrincipalName" value="<?php echo $name;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="textPrincipalName">Description:</label>
                                            <textarea id="textPrincipalDesc" name="textPrincipalDesc" rows="3" class="form-control input-sm"><?php echo $desc;?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="textAccreditationNumber">Accreditation Number:</label>
                                            <input type="text" id="textAccreditationNumber" name="textAccreditationNumber" value="<?php echo $accre_no;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="selectNatureCompany">Nature of the Company:</label>
                                            <select id="selectNatureCompany" name="selectNatureCompany" class="form-control input-sm">
                                                <?php echo dropdown_options('nature', $nature_id);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="textAddress">Address:</label>
                                            <input type="text" id="textAddress" name="textAddress" value="<?php echo $address;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="textCity">City / State:</label>
                                            <input type="text" id="textCity" name="textCity" value="<?php echo $city;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="selectCountry">Country:</label>
                                            <select id="selectCountry" name="selectCountry" class="form-control input-sm">
                                                <?php echo dropdown_options('country', $country_id);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="textTelephone">Telephone:</label>
                                            <input type="text" id="textTelephone" name="textTelephone" value="<?php echo $tel_no;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="textFax">Fax:</label>
                                            <input type="text" id="textFax" name="textFax" value="<?php echo $fax_no;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="textEmail">Email:</label>
                                            <input type="text" id="textEmail" name="textEmail" value="<?php echo $email;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="textWebsite">Website:</label>
                                            <input type="text" id="textWebsite" name="textWebsite" value="<?php echo $website;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="textFacebook">Facebook:</label>
                                            <input type="text" id="textFacebook" name="textFacebook" value="<?php echo $facebook;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="textLinkedIn">LinkedIn:</label>
                                            <input type="text" id="textLinkedIn" name="textLinkedIn" value="<?php echo $linkedin;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />

                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="button" class="btn btn-block btn-primary" value="Submit" id="btn_submit">
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="<?php echo BASE_URL;?>settings/principal/<?php echo $id;?>" class="btn btn-block btn-danger">Cancel</a>
                                    </div>
                                </div>
                                
                            </div>
                            
                        </div>
                        
                    </form>
                    
                </div>
            </section>
            
		</div>
	</div>
	<!-- end: page -->
</section>
<script>
	var current_principal_id = '<?php echo $id;?>';
</script>