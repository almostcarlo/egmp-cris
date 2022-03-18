<?php
    if(isset($info)){
        $title = "Edit";
        $principal_id = $info[0]['principal_id'];
        $company_id = $info[0]['company_id'];
        $id = $info[0]['id'];
        $existing_agreement = $info[0]['existing_agreement'];
        $file = $info[0]['file'];
        $remarks = $info[0]['remarks'];
        $doc_svc_agree = $info[0]['doc_svc_agree'];
    }else{
        $title = "Add";
        $principal_id = "";
        $id = "";
        $company_id = "";
        $existing_agreement = "";
        $file = "";
        $remarks = "";
        $doc_svc_agree = "";
    }
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Recruitment Fee Guide</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-6">
            
			<section class="panel">
                <header class="panel-heading">
                    <?php if($id<>''):?>
                        <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/rec_fee_label?id=<?php echo $id;?>'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Another Set</a>
                    <?php endif;?>
					<h3 class="panel-title">Recruitment Fee Guide - <?php echo $title;?></h3>
				</header>
				<div class="panel-body">
				
                	<?php flashNotification();?>
                    
                    <div id="settings_noticeError" class="alert alert-danger hidden">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <div id="errorMsg_Cont"><strong><span id="inputRequired"></span></strong>[error message here]</div>
                    </div>
                    
                    <?php echo form_open_multipart('settings/save/rec_fee_hdr', 'id="frm_rec_fee"');?>
                    
                    	<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
                        
                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="SelectPrincipal">Principal:</label>
                                            <select id="SelectPrincipal" name="SelectPrincipal" class="form-control input-sm">
                                                <?php echo dropdown_options('principal', $principal_id);?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="SelectCompany">Company:</label>
                                            <select id="SelectCompany" name="SelectCompany" class="form-control input-sm">
                                                <?php echo dropdown_options('company', $company_id);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">With Existing Recruitment Services Agrement:</label>
                                            <textarea class="form-control input-sm" name="textExistAgree" rows="4"><?php echo $existing_agreement?></textarea>
                                        </div>
                                    </div>
                                </div>
                                
                                <?php if($id):?>
                                    <div class="row">
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Recruitment Services Agreement:</label>
                                                <br>
                                                <a href="<?php echo BASE_URL."settings/files/svc/".base64_encode($principal_id);?>" target="_blank" class=""><?php echo $doc_svc_agree;?></a>
                                            </div>
                                        </div>
                                    </div>
                                <?php endif;?>
                                

                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Remarks:</label>
                                            <textarea class="form-control input-sm" name="textRemarks" rows="4"><?php echo $remarks?></textarea>
                                        </div>
                                    </div>
                                </div>

                                <hr />

                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-block btn-primary" value="Submit" id="btn_submit">
                                    </div>
                                    <div class="col-sm-6">
                                        <a href="<?php echo BASE_URL;?>settings/search/rec_fee" class="btn btn-block btn-danger">Cancel</a>
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </form>
                    
                </div>
            </section>
            
		</div>

        <?php if(isset($label) && count($label) > 0):?>
            <div class="col-md-12">
                <div class="tabs">
                    <ul class="nav nav-tabs tabs-primary">
                        <!-- <li class="profile_tab" aria-controls="reported_today"><a href="#reportedtoday" data-toggle="tab">All Categories</a></li> -->
                        <?php foreach($label as $k => $v):?>
                            <li class="recfee_tab <?php echo ($current_lbl_tab==$v['id'])?"active":"";?>" aria-controls="<?php echo $v['id'];?>"><a href="<?php echo $v['title'];?>" data-toggle="tab"><?php echo $v['title'];?></a></li>
                        <?php endforeach;?>
                    </ul>
                    <div class="tab-content">
                        
                    </div>
                </div>
    	   </div>
        <?php endif?>
	<!-- end: page -->
</section>
<script type="text/javascript">
    var current_lbl_tab = '<?php echo $current_lbl_tab;?>';
</script>