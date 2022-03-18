<?php
    if(isset($doc_info[0])){
        $id = $doc_info[0]['id'];
        $serial_no = $doc_info[0]['serial_no'];
        $rec_date = $doc_info[0]['add_date'];
        $rec_by = $doc_info[0]['add_by'];
        $issue_date = $doc_info[0]['issue_date'];
        $exp_date = $doc_info[0]['expiry_date'];
        $file = $doc_info[0]['filename'];
        $is_auth = $doc_info[0]['is_auth'];
        $is_201 = $doc_info[0]['is_201'];
        $rel_date = $doc_info[0]['released_date'];
        $rel_by = $doc_info[0]['released_by'];
        $remarks = $doc_info[0]['remarks'];
        $btn = "Update Document";
    }else{
        $id = "";
        $serial_no = "";
        $rec_date = date("m/d/Y", strtotime('today'));
        $rec_by = $_SESSION['rs_user']['id'];
        $issue_date = "";
        $exp_date = "";
        $file = "";
        $is_auth = "";
        $is_201 = "";
        $rel_date = "";
        $rel_by = "";
        $remarks = "";
        $btn = "Add Document";
    }
?>
<div id="" class="tab-pane active">
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            <h2 class="panel-title"><?php echo ucwords(strtolower($doc_name));?></h2>
        </header>
        <div class="panel-body">

            <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                <strong>ERROR!</strong><br>
                <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
        	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                <strong>SUCCESS!</strong><br>
                <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
            </div>
        
			<?php echo form_open_multipart('operations/save_doclib', 'id="frm_doclib"');?>
				<input type="hidden" name="textRecordId" value="<?php echo $id;?>">
				<input type="hidden" name="textApplicant_id" value="<?php echo $_GET['applicant_id'];?>">
				<input type="hidden" name="textDocType" value="<?php echo urldecode($_GET['tab']);?>">
                <input type="hidden" name="textDocTypeID" value="<?php echo urldecode($type_id);?>">
			
				<div class="row">
					<div class="col-md-6" style="padding-left:15px;padding-right:15px;">

                        <div class="row" id="">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textAppliedCat">Serial No.:</label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <input type="text" id="textSerialNo" name="textSerialNo" autocomplete="off" class="form-control input-sm" value="<?php echo $serial_no;?>" />
                                </div>
                            </div>
                        </div>
                        
						<div class="row" id="">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textAppliedCat">Received Date:</label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textRecDate" name="textRecDate" value="<?php echo dateformat($rec_date,2);?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" placeholder="MM/DD/YYYY" <?php echo ($rec_date && $id)?"readonly=\"readonly\"":""?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
						<div class="row" id="">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="">File Attached:</label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <?php if($file):?>
                                    	<a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($id);?>" target="_blank"><?php echo $file;?></a>
                                    	<a href="javascript:void(0);" onclick="delete_doclib('file','<?php echo $id;?>');" style="color:red;">[delete file]</a>
                                    <?php else:?>
                                    	<input type="file" id="fileAttached" name="fileAttached" autocomplete="off" class="form-control input-sm" />
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        
						<!-- <div class="row" id="">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textAppliedCat">Released Date:</label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textRelDate" name="textRelDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" placeholder="MM/DD/YYYY" value="<?php echo dateformat($rel_date,2)?>" <?php echo (dateformat($rel_date))?"readonly=\"readonly\"":""?>>
                                    </div>
                                </div>
                            </div>
                        </div> -->
                        
						<div class="row" id="">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textAppliedCat">Remarks:</label>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div class="form-group">
                                    <textarea name="textRemarks" id="textRemarks" rows="7" class="form-control input-sm"><?php echo $remarks;?></textarea>
                                </div>
                            </div>
                        </div>
					
					</div>
					
					<!-- LEFT COLUMN -->
					<div class="col-md-6" style="padding-left:15px;padding-right:15px;">
						<div class="row" id="">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="">Issue Date:</label>
                                </div>
                            </div>
                            <div class="col-md-7 mt-sm">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textIssueDate" name="textIssueDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" placeholder="MM/DD/YYYY" value="<?php echo dateformat($issue_date,2);?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
						<div class="row" id="">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textAppliedCat2">Expiry Date:</label>
                                </div>
                            </div>
                            <div class="col-md-7 mt-sm">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textValidity" name="textValidity" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" placeholder="MM/DD/YYYY" value="<?php echo dateformat($exp_date,2);?>">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
						<div class="row" id="">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textAppliedCat2">Received By:</label>
                                </div>
                            </div>
                            <div class="col-md-7 mt-sm">
                                <div class="form-group">
                                	<?php if($rec_by && $id):?>
                                		<input type="text" value="<?php echo $rec_by;?>" class="form-control input-sm" readonly="readonly">
                                	<?php else:?>
                                        <select id="selectRecBy" name="selectRecBy" class="form-control input-sm">
                                            <?php echo dropdown_options('users_by_name',$rec_by,1);?>
                                        </select>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        
						<div class="row" id="">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textAppliedCat2">Authenticated:</label>
                                </div>
                            </div>
                            <div class="col-md-2 mt-sm">
                                <div class="form-group">
                                    <select id="selectAuth" name="selectAuth" class="form-control input-sm">
                                    	<option value="N" <?php echo ($is_auth=='N')?"selected=\"selected\"":""?>>No</option>
                                        <option value="Y" <?php echo ($is_auth=='Y')?"selected=\"selected\"":""?>>Yes</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-3 mt-sm">
                                <div class="form-group text-center">
                                    <label for="textAppliedCat2">201 Copy:</label>
                                </div>
                            </div>
                            <div class="col-md-2 mt-sm">
                                <div class="form-group">
                                    <select id="select201" name="select201" class="form-control input-sm">
                                    	<option value="N" <?php echo ($is_201=='N')?"selected=\"selected\"":""?>>No</option>
                                        <option value="Y" <?php echo ($is_201=='Y')?"selected=\"selected\"":""?>>Yes</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row" id="">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textAppliedCat">Released Date:</label>
                                </div>
                            </div>
                            <div class="col-md-7 mt-sm">
                                <div class="form-group">
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textRelDate" name="textRelDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" placeholder="MM/DD/YYYY" value="<?php echo dateformat($rel_date,2)?>" <?php echo (dateformat($rel_date))?"readonly=\"readonly\"":""?>>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
						<div class="row" id="">
                            <div class="col-md-3 mt-sm">
                                <div class="form-group">
                                    <label for="textAppliedCat2">Released By:</label>
                                </div>
                            </div>
                            <div class="col-md-7 mt-sm">
                                <div class="form-group">
                                	<?php if($rel_by):?>
                                		<input type="text" value="<?php echo $rel_by;?>" class="form-control input-sm" readonly="readonly">
                                	<?php else:?>
                                        <select id="selectRelBy" name="selectRelBy" class="form-control input-sm">
                                            <?php echo dropdown_options('users_by_name','',1);?>
                                        </select>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        
                        <hr class="col-sm-10">
                        
                        <div class="row">
                            <div class="col-sm-5">
                            	<?php if(dateformat($rel_date)):?>
                            		<input type="button" value="Delete Document" class="btn btn-block btn-danger" id="" onclick="delete_doclib('record','<?php echo $id;?>');" >
                            	<?php else:?>
                                	<input type="button" value="<?php echo $btn;?>" class="btn btn-block btn-primary" onclick="save_doc();">
                                <?php endif;?>
                            </div>
                            <div class="col-sm-5">
                                <input type="button" value="Clear" class="btn btn-block btn-danger" onclick="generate_tab('<?php echo $_GET['tab'];?>');">
                            </div>
                        </div>
					</div>
					<!-- END LEFT COLUMN -->
				</div>
			
			</form>
        </div>
    </section>
    
</div>
<script>
$(function () {
	$('#textValidity, #textRecDate, #textRelDate, #textIssueDate').datepicker({dateFormat: 'dd/mm/yy'});
});
</script>