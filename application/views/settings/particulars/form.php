<?php
if(isset($info)){
    $id = $info[0]['id'];
    $name = $info[0]['name'];
}else{
    $id = "";
    $name = "";
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
        
        <?php echo form_open(BASE_URL.'settings/save/city', 'id="frm_facebox_particulars"')?>
        	
        	<input type="hidden" name="textRecordId" value="<?php echo $id;?>">

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="textName"> Particular Name</label>
                        <input type="text" id="textName" name="textName" value="<?php echo $name;?>" autocomplete="off" class="form-control input-sm" />
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
    		$('#defaultNoticeContError').html('Particular Name is required.');
    		$("#frm_ErrorNotice").removeClass("hidden");
    		$('#textName').focus();
    	}else{
    		$.post(base_url_js+'settings/save/particulars', $('#frm_facebox_particulars').serialize(), function(data) {
    			if(data){
    				$('#defaultNoticeContSuccess').html('Successfully saved.');
    				$("#frm_SuccessNotice").removeClass("hidden");

    				setTimeout(function(){
    					$.facebox.close();
    					window.location.replace(base_url_js+'settings/search/particulars');
    				}, 1000);
    			}else{
    				$('#defaultNoticeContError').html('Unable to save record.');
    				$("#frm_ErrorNotice").removeClass("hidden");
    			}
    		});
    	}
    }
</script>