<?php //var_dump($info); exit();?>
<section role="main" class="content-body">
                    
	<header class="page-header">
		<h2>Principal Manager - <?php echo $info[0]['code'];?></h2>
	</header>

	<!-- start: page -->

	<?php if($this->session->flashdata('settings_notification')):?>
        <div class="alert alert-<?php echo ($this->session->flashdata('settings_notification_status')=='Error')?"danger":"success";?>">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong><?php echo ($this->session->flashdata('settings_notification_status')=='Error')?"Error":"Success"?>!</strong> <?php echo $this->session->flashdata('settings_notification');?>
        </div>
    <?php endif;?>

	<div class="row">
		<div class="col-md-3">
            
			<section class="panel">
                <div class="panel-body">
                            
                    <div class="thumb-info">
                    	<?php if($info[0]['doc_logo']):?>
                    		<img src="<?php echo BASE_URL."settings/files/logo/".base64_encode($info[0]['id']);?>" class="round img-responsive" />
                    	<?php else:?>
                        	<img src="<?php echo BASE_URL;?>public/images/principal.jpg" class="round img-responsive">
                        <?php endif;?>
                        <div class="thumb-info-title">
                            <div class="thumb-info-inner"><?php echo $info[0]['name'];?></div>
                            <div class="thumb-info-type">Accre. No.: <?php echo $info[0]['accre_no'];?></div>
                        </div>
                        <hr />
                        <?php if($info[0]['description']!=''):?>
                            <div class="thumb-info-title">
                                <div class="thumb-info-type"><?php echo $info[0]['description'];?></div>
                            </div>
                            <hr />
                        <?php endif;?>
                        <div class="thumb-info-title">
                            <div class="thumb-info-type"><i class="fa fa-globe"></i> COUNTRY: <?php echo $country[$info[0]['country_id']];?></div>
                            <?php if($info[0]['tel_no']):?><div class="thumb-info-type"><i class="fa fa-phone"></i> PHONE: <?php echo $info[0]['tel_no'];?></div><?php endif;?>
                            <?php if($info[0]['fax_no']):?><div class="thumb-info-type"><i class="fa fa-fax"></i> FAX: <?php echo $info[0]['fax_no'];?></div><?php endif;?>
                            <div class="thumb-info-type"><?php echo $info[0]['address'];?> <?php echo $info[0]['city'];?></div>
                            <?php if($info[0]['email']):?><div class="thumb-info-type"><i class="fa fa-envelope"></i> EMAIL: <a href="mailto:" target="_blank"><?php echo $info[0]['email'];?></a></div><?php endif;?>
                            <?php if($info[0]['website']):?><div class="thumb-info-type"><i class="fa fa-link"></i> WEBSITE: <a href="#" target="_blank"><?php echo $info[0]['website'];?></a></div><?php endif;?>
                            <?php if($info[0]['facebook']):?><div class="thumb-info-type"><i class="fa fa-facebook"></i> FACEBOOK: <a href="#" target="_blank"><?php echo $info[0]['facebook'];?></a></div><?php endif;?>
                            <?php if($info[0]['linkedin']):?><div class="thumb-info-type"><i class="fa fa-linkedin"></i> LINKEDIN: <a href="#" target="_blank"><?php echo $info[0]['linkedin'];?></a></div><?php endif;?>
                        </div>
                        <hr />
                        <?php if($info[0]['doc_svc_agree']):?><a href="<?php echo BASE_URL."settings/files/svc/".base64_encode($info[0]['id']);?>" target="_blank" class="btn btn-block btn-sm btn-info"><i class="fa fa-file"></i> Service Agreement</a><?php endif;?>
                        <?php if($info[0]['doc_rec']):?><a href="<?php echo BASE_URL."settings/files/recdoc/".base64_encode($info[0]['id']);?>" target="_blank" class="btn btn-block btn-sm btn-info"><i class="fa fa-file"></i> Recruitment Document</a><?php endif;?>
                        <a href="<?php echo BASE_URL?>settings/principal/edit/<?php echo $info[0]['id'];?>" class="btn btn-block btn-sm btn-default"><i class="fa fa-pencil"></i> Update Info</a>
                    </div>
                    
                </div>
            </section>
            
        </div>
        
		<div class="col-md-9">
            
			<div id="tab_contacts"></div>
			<div id="tab_mr"></div>
			<div id="tab_jo"></div>
                
        </div>
        
    </div>
        
	<!-- end: page -->
</section>
<script>
	var current_principal_id = '<?php echo $info[0]['id'];?>';
</script>