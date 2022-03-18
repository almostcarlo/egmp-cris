<?php
    if(isset($info)){
        $id = $info[0]['id'];
        $name = $info[0]['name'];
        $address = $info[0]['address'];
        $contact_person = $info[0]['contact_person'];
        $contact_no = $info[0]['contact_no'];
        $status = $info[0]['status'];
    }else{
        $id = "";
        $name = "";
        $address = "";
        $contact_person = "";
        $contact_no = "";
        $status = "";
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
        
        <?php echo form_open(BASE_URL.'settings/save/lending', 'id="frm_facebox_lending"')?>
        	
        	<input type="hidden" name="textRecordId" value="<?php echo $id;?>">

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for=""> Name:</label>
                        <input type="text" id="textName" name="textName" value="<?php echo $name;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for=""> Address:</label>
                        <textarea class="form-control input-sm" name="textAddr" id="textAddr" rows="3"><?php echo $address;?></textarea>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-8 mt-sm">
                    <div class="form-group">
                        <label for=""> Contact Person:</label>
                        <input type="text" id="textContactPerson" name="textContactPerson" value="<?php echo $contact_person;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>

                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="textName"> Contact No.:</label>
                        <input type="text" id="textContactNo" name="textContactNo" value="<?php echo $contact_no;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for=""> Status:</label>
                        <select class="form-control input-sm" name="selectStat" id="selectStat">
                            <option value="1" <?php echo ($status == '1')?"selected=\"selected\"":"";?>>Active</option>
                            <option value="0" <?php echo ($status == '0')?"selected=\"selected\"":"";?>>Not Active</option>
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

    	if($('#textName').val() == ''){
    		$('#defaultNoticeContError').html('Name is required.');
    		$("#frm_ErrorNotice").removeClass("hidden");
    		$('#textName').focus();
    	}else{
    		$.post(base_url_js+'settings/save/lending', $('#frm_facebox_lending').serialize(), function(data) {
    			if(data){
    				$('#defaultNoticeContSuccess').html('Successfully saved.');
    				$("#frm_SuccessNotice").removeClass("hidden");

    				setTimeout(function(){
    					$.facebox.close();
    					window.location.replace(base_url_js+'settings/search/lending');
    				}, 1000);
    			}else{
    				$('#defaultNoticeContError').html('Unable to save record.');
    				$("#frm_ErrorNotice").removeClass("hidden");
    			}
    		});
    	}
    }
</script>