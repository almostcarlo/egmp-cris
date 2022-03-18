<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>IP Whitelist</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-12">
            
			<section class="panel">
			
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

                <header class="panel-heading">
					<h3 class="panel-title">List of Allowed IP Address <a href="<?php echo BASE_URL;?>settings/forms/ip-whitelist" class="btn btn-sm btn-warning pull-right" style="margin-top:-4px;"><i class="fa fa-plus"></i> Add IP</a></h3>
				</header>
				<div class="panel-body">
                    <div class="alert alert-default">
						<?php echo (trim($list[0]['ip_address'])<>'')?$list[0]['ip_address']:"No IP Address found.";?>
					</div>
                </div>
            </section>
            
		</div>
	</div>
	<!-- end: page -->
</section>