<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Announcements</h2>
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
					<h3 class="panel-title">List of Announcements <a href="<?php echo BASE_URL;?>announcement/create" class="btn btn-sm btn-warning pull-right" style="margin-top:-4px;"><i class="fa fa-plus"></i> Add Announcements</a></h3>
				</header>
				<div class="panel-body">
				
					<?php if($list):?>
						<?php foreach ($list as $info):?>
                            <div class="alert alert-default">
                                <h5><a href="<?php echo BASE_URL;?>announcement/edit/<?php echo $info['id'];?>"><?php echo $info['title'];?></a></h5>
        						<?php echo word_limiter($info['details'], 100);?> <a href="<?php echo BASE_URL;?>announcement/edit/<?php echo $info['id'];?>">Read more</a>
        					</div>
						<?php endforeach;?>
					<?php endif;?>
                    
                </div>
            </section>
            
		</div>
	</div>
	<!-- end: page -->
</section>