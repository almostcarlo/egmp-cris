<?php
if(isset($info)){
    $id = $info[0]['id'];
    $fname = $info[0]['fname'];
    $mname = $info[0]['mname'];
    $lname = $info[0]['lname'];
    $status = $info[0]['is_active'];
    $code = $info[0]['code'];
    $mobile = $info[0]['mobile_no'];
    $email = $info[0]['email'];
    $address = $info[0]['address'];
    $remarks = $info[0]['remarks'];
}else{
    $id = "";
    $fname = "";
    $mname = "";
    $lname = "";
    $status = "";
    $code = "";
    $mobile = "";
    $email = "";
    $address = "";
    $remarks = "";
}
?>
<section class="panel">
    <div class="panel-body">
    
            <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                <strong>ERROR!</strong><br>
                <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
        	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                <strong>SUCCESS!</strong><br>
                <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
            </div>
        
        <?php echo form_open(BASE_URL.'settings/save/agent', 'id="frm_facebox_agent"')?>
        	
        	<input type="hidden" name="textRecordId" value="<?php echo $id;?>">

            <div class="row">
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for=""> First Name</label>
                        <input type="text" id="textFname" name="textFname" value="<?php echo $fname;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for=""> Middle Name</label>
                        <input type="text" id="textMname" name="textMname" value="<?php echo $mname;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for=""> Last Name</label>
                        <input type="text" id="textLname" name="textLname" value="<?php echo $lname;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
            </div>

            <div class="row">
                <!-- <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for=""> Agent Code</label>
                        <input type="text" id="textCode" name="textCode" value="<?php echo $code;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div> -->
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for=""> Mobile No.</label>
                        <input type="text" id="textMobile" name="textMobile" value="<?php echo $mobile;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for=""> Email</label>
                        <input type="text" id="textEmail" name="textEmail" value="<?php echo $email;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for=""> Address</label>
                        <input type="text" id="textAddress" name="textAddress" value="<?php echo $address;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for=""> Remarks</label>
                        <textarea id="textRemarks" name="textRemarks" class="form-control input-sm"><?php echo $remarks;?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="textProvince">Status:</label>
                        <select class="form-control input-sm" id="textStatus" name="textStatus">
                            <option value="Y" <?php echo ($status=='Y')?"selected=\"selected\"":"";?>>Active</option>
                            <option value="N" <?php echo ($status=='N')?"selected=\"selected\"":"";?>>Not Active</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <hr />

            <div class="row">
                <div class="col-sm-3">
                    <input type="button" onclick="save_this();" class="btn btn-block btn-primary" value="Submit">
                </div>
            </div>

        </form>
        
    </div>
</section>
<script>
    function save_this(){
    	$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");

    	if($('#textFname').val() == ''){
    		$('#defaultNoticeContError').html('Complete Name is required.');
    		$("#frm_ErrorNotice").removeClass("hidden");
    		$('#textFname').focus();
    	}else if($('#textMname').val() == ''){
    		$('#defaultNoticeContError').html('Complete Name is required.');
    		$("#frm_ErrorNotice").removeClass("hidden");
    		$('#textMname').focus();
    	}else if($('#textLname').val() == ''){
    		$('#defaultNoticeContError').html('Complete Name is required.');
    		$("#frm_ErrorNotice").removeClass("hidden");
    		$('#textLname').focus();
    	}else if($('#textMobile').val() == ''){
    		$('#defaultNoticeContError').html('Mobile No. is required.');
    		$("#frm_ErrorNotice").removeClass("hidden");
    		$('#textMobile').focus();
    	}else{
    		$.post(base_url_js+'settings/save/agent', $('#frm_facebox_agent').serialize(), function(data) {
    			if(data){
    				$('#defaultNoticeContSuccess').html('Successfully saved.');
    				$("#frm_SuccessNotice").removeClass("hidden");

    				setTimeout(function(){
    					$.facebox.close();
    					window.location.replace(base_url_js+'settings/search/agent');
    				}, 1000);
    			}else{
    				$('#defaultNoticeContError').html('Unable to save agent.');
    				$("#frm_ErrorNotice").removeClass("hidden");
    			}
    		});
    	}
    }
</script>