<?php
    // var_dump($picture);
    // exit();
?>
<section role="main" class="content-body">
                    
	<header class="page-header">
		<h2>Settings - Users</h2>
	</header>

	<!-- start: page -->

	<div class="row">
        <div class="col-md-12">
            <!-- NOTIFICATION HERE -->
            <?php flashNotification();?>
        </div>

		<div class="col-md-6">
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">Change Password</h3>
				</header>
				<div class="panel-body">

                    <?php echo form_open('home/change_pass', 'id="frm_change_pass"');?>
                        <div class="row">
                            
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textUserStatus">Current Password:</label>
                                    <input type="password" id="textCurrPass" name="textCurrPass" value="" autocomplete="off" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        
                        <hr />

                        <label for="">Passwords should be at least 8 characters long.</label>
                        
                        <div class="row">
                            
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textPassword">New Password:</label>
                                    <input type="password" id="textPassword" name="textPassword" class="form-control input-sm" />
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textConfirmPassword">Confirm Password:</label>
                                    <input type="password" id="textConfirmPassword" name="textConfirmPassword" class="form-control input-sm" />
                                </div>
                            </div>
                            
                        </div>

                        <hr />

                        <div class="row">
                            <div class="col-md-6 col-sm-3">
                                <input type="submit" class="btn btn-block btn-primary" value="Submit" id="btn_submit_Userform">
                            </div>
                            <div class="col-md-6 col-sm-3">
                                <a href="<?php echo BASE_URL;?>dashboard" class="btn btn-block btn-danger">Cancel</a>
                            </div>
                        </div>
                                
                        
                    </form>
                    
                </div>
            </section>
		</div>

        <!-- PROFILE PIC -->
        <div class="col-md-6">
            <section class="panel">
                <header class="panel-heading">
                    <h3 class="panel-title">Change Profile Photo</h3>
                </header>
                <div class="panel-body">
                    <?php if($_SESSION['rs_user']['picture']<>''):?>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="thumb-info">
                                    <img src="<?php echo BASE_URL;?>home/my_profile_pic" style="width:200px; height:200px; border-radius:50%;" />
                                </div>
                            </div>
                        </div>
                    <?php endif;?>

                    <?php echo form_open('home/change_photo', 'id="frm_change_pass" enctype="multipart/form-data"');?>
                        <div class="row">
                            <div class="col-md-8 col-sm-3">
                                <div class="form-group">
                                    <label for="">Profile Photo:</label>
                                    <input type="file" class="form-control input-sm" id="fileUploadPhoto" name="fileUploadPhoto">
                                </div>
                            </div>
                            <div class="col-md-4 col-sm-3">
                                <div class="form-group">
                                    <label>&nbsp;</label>
                                    <input type="submit" class="btn btn-block btn-primary btn-sm" value="Upload">
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