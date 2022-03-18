<?php
if(isset($info)){
    $id = $info[0]['id'];
    $desc = $info[0]['desc'];
    $status = $info[0]['is_active'];
}else{
    $id = "";
    $desc = "";
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
        
        <?php echo form_open(BASE_URL.'settings/save/source', 'id="frm_facebox_source"')?>
        	
        	<input type="hidden" name="textRecordId" value="<?php echo $id;?>">

            <div class="row">
                <div class="col-md-8 mt-sm">
                    <div class="form-group">
                        <label for="textName"> Description</label>
                        <input type="text" id="textDesc" name="textDesc" value="<?php echo $desc;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
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

    	if($('#textDesc').val() == ''){
    		$('#defaultNoticeContError').html('Description is required.');
    		$("#frm_ErrorNotice").removeClass("hidden");
    		$('#textDesc').focus();
    	}else{
    		$.post(base_url_js+'settings/save/source', $('#frm_facebox_source').serialize(), function(data) {
    			if(data){
    				$('#defaultNoticeContSuccess').html('Successfully saved.');
    				$("#frm_SuccessNotice").removeClass("hidden");

    				setTimeout(function(){
    					$.facebox.close();
    					window.location.replace(base_url_js+'settings/search/source');
    				}, 1000);
    			}else{
    				$('#defaultNoticeContError').html('Unable to save source.');
    				$("#frm_ErrorNotice").removeClass("hidden");
    			}
    		});
    	}
    }
</script>