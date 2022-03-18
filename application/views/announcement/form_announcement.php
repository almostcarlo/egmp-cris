<?php
    if(isset($info)){
        $id = $info[0]['id'];
        $title = $info[0]['title'];
        $details = $info[0]['details'];
    }else{
        $id = "";
        $title = "";
        $details = "";
    }
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Announcements</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-12">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">Announcements <a href="<?php echo BASE_URL;?>announcement" class="btn btn-sm btn-info pull-right" style="margin-top:-4px;"><i class="fa fa-angle-left"></i> Back to Announcements List</a></h3>
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

                    <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                        <strong>ERROR!</strong><br>
                        <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
                    </div>
                    
                	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                        <strong>SUCCESS!</strong><br>
                        <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
                    </div>
                    
                    <?php echo form_open('announcement/save', 'id="frm_announcement"');?>
                    	<input type="hidden" name="textRecordId" value="<?php echo $id;?>"/>
                        
                       <input type="text" id="textTitle" name="textTitle" value="<?php echo $title;?>" class="form-control mb-sm" placeholder="Title Here..."/>
                        
                       <textarea id="textAnnouncements" name="textDetails" class="form-control" placeholder="Start typing..."><?php echo $details;?></textarea>
                        
                        <hr />

                        <div class="row">
                            <div class="col-sm-8">
                                <input type="button" id="btn_submit" value="Save" class="btn btn-block btn-success btn-green-theme">
                            </div>
                            <div class="col-sm-2">
                                <input type="reset" value="Clear" class="btn btn-block btn-default">
                            </div>
                            <?php if($id && in_array(3, $_SESSION['rs_user']['delete_access'])):?>
                                <div class="col-sm-2">
                                    <a href="<?php echo BASE_URL;?>announcement/delete/<?php echo $id;?>" onclick="if(confirm('Do you want to proceed?')){return true;}else{return false;}" class="btn btn-block btn-danger">Delete</a>
                                </div>
                            <?php endif;?>
                        </div>
                        
                    </form>
                    
                </div>
            </section>
            
		</div>
	</div>
	<!-- end: page -->
</section>