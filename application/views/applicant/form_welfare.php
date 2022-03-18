<?php
    if(isset($welfare_info[0])){
    	$id = $welfare_info[0]['id'];
        $details = $welfare_info[0]['details'];
        $attachment = $welfare_info[0]['attachment'];
        $action = $welfare_info[0]['action'];
        $action_attachment = $welfare_info[0]['action_attachment'];
        $final_action = $welfare_info[0]['final_action'];
        $final_action_attachment = $welfare_info[0]['final_attachment'];
        $title = "Edit";
    }else{
    	$id = "";
        $details = "";
        $attachment = "";
        $action = "";
        $action_attachment = "";
        $final_action = "";
        $final_action_attachment = "";
        $title = "Add";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Applicant's Welfare - <?php echo $title;?> Case</h4>
                </div>
            </div>
            
            <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                <strong>ERROR!</strong><br>
                <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
        	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                <strong>SUCCESS!</strong><br>
                <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
            </div>

            <?php echo form_open_multipart('applicant/save_profile/welfare', 'id="frm_welfare"');?>

            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">
            	<input type="hidden" name="textRecordId" value="<?php echo $id;?>">

            	<?php if(!isset($_GET['for'])):?>
	                <div class="row">
	                    <div class="col-md-12 mt-sm">
	                        <div class="form-group">
	                            <label for="">Case Details:</label>
	                            <textarea name="textDetails" id="textDetails" class="form-control input-sm" rows="8"><?php echo $details;?></textarea>
	                        </div>
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-md-12 mt-sm">
	                        <div class="form-group">
	                            <label for="textAmount">Attachment:</label>
	                            <input type="file" id="textAttach" name="textAttach" value="" class="form-control input-sm <?php echo ($attachment != '')?"hidden":"";?>" placeholder="" />
                            	<?php if($attachment != ''):?>
                            		<div id="cont_attach">
	                            		<a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($id)."/applicant_welfare/attachment";?>" target="_blank"><?php echo $attachment;?></a>
                            			<a href="javascript:void(0);" onclick="delete_welfare_attachment('<?php echo $id?>', 'attachment')" style="color:red">[delete]</a>
                            		</div>
	                        	<?php endif;?>
	                        </div>
	                    </div>
	                </div>

	                <hr />
            	<?php endif;?>

                <?php if(isset($_GET['for']) && $_GET['for'] == 'action'):?>
	                <div class="row">
	                    <div class="col-md-12 mt-sm">
	                        <div class="form-group">
	                            <label for="">Action/Remarks:</label>
	                            <input type="hidden" id="textPrevAction" name="textPrevAction" value="<?php echo $action;?>" class="form-control input-sm" />
	                            <textarea name="textAction" id="textAction" class="form-control input-sm" rows="8"></textarea>
	                        </div>
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-md-12 mt-sm">
	                        <div class="form-group">
	                            <label for="textAmount">Attachment:</label>
	                            <input type="file" id="textAttachAction" name="textAttachAction" value="" class="form-control input-sm <?php echo ($action_attachment != '')?"hidden":"";?>" placeholder="" />
	                            <?php if($action_attachment != ''):?>
                            		<div id="cont_act_attach">
	                            		<a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($id)."/applicant_welfare/action_attachment";?>" target="_blank"><?php echo $action_attachment;?></a>
                            			<a href="javascript:void(0);" onclick="delete_welfare_attachment('<?php echo $id?>', 'action_attachment')" style="color:red">[delete]</a>
                            		</div>
	                        	<?php endif;?>
	                        </div>
	                    </div>
	                </div>

	                <hr />
                <?php endif;?>

                <?php if(isset($_GET['for']) && $_GET['for'] == 'final_action'):?>
	                <div class="row">
	                    <div class="col-md-12 mt-sm">
	                        <div class="form-group">
	                            <label for="">Final Action:</label>
	                            <textarea name="textFinalAction" id="textFinalAction" class="form-control input-sm" rows="8"><?php echo $final_action;?></textarea>
	                        </div>
	                    </div>
	                </div>

	                <div class="row">
	                    <div class="col-md-12 mt-sm">
	                        <div class="form-group">
	                            <label for="textAmount">Attachment:</label>
	                            <input type="file" id="textFinalAttach" name="textFinalAttach" value="" class="form-control input-sm" placeholder="" />
	                        </div>
	                    </div>
	                </div>

	                <hr />
                <?php endif;?>

                <div class="row">
                    <div class="col-sm-3">
                        <input type="button" onclick="save_welfare();" class="btn btn-block btn-primary" value="Submit">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>