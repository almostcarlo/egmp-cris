		<!-- start: page -->
		<section class="body-sign">
			<div class="center-sign">
				<a href="#" class="logo pull-left">
					<img src="<?php echo BASE_URL;?>public/images/<?php echo COMPANY_LOGO;?>" height="54" alt="<?php echo PROGRAM_NAME;?>" />
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign In</h2>
					</div>
					<div class="panel-body">
						<?php echo form_open('home/auth', 'id="frm_login"');?>

                            <div id="frm_loginErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                                <strong>ERROR!</strong><br>
                                <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong></div>
                            </div>

							<div class="form-group">
								<label for="textEmail">Username</label>
								<input id="textUser" name="textUser" type="text" class="form-control" />
							</div>

							<div class="form-group">
                                <label for="textPassword">Password</label>
                                <input id="textPassword" name="textPassword" type="password" class="form-control" />
							</div>
                            
                            <br />
                            
                            <button type="button" id="btn_submit" class="btn btn-success btn-blue-theme btn-block btn-lg">Sign In</button>
                            
                            <hr />

							<!-- <p class="text-center">Don't have an account? <a href="signup.php">Sign Up!</a> | <a href="forgot-password.php">Forgot password</a> -->

						</form>
					</div>
				</div>

				<p class="text-center text-muted">&copy; Copyright 2019. <strong><?php echo PROGRAM_NAME;?>.</strong> All rights reserved.</p>
			</div>
		</section>
		<!-- end: page -->