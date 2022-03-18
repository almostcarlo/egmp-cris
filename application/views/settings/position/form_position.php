<?php
    if(isset($info)){
        $id = $info[0]['id'];
        $desc = $info[0]['desc'];
        $js_id = $info[0]['jobspec_id'];
    }else{
        $id = "";
        $desc = "";
        $js_id = "";
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
        
        <?php echo form_open(BASE_URL.'settings/save/position', 'id="frm_facebox_position"')?>
        	
        	<input type="hidden" name="textRecordId" value="<?php echo $id;?>">

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="textFullName">Position/Category</label>
                        <input type="text" id="textPos" name="textPos" value="<?php echo $desc;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="textDesignation">Job Specification:</label>
                        <select id="selectJobspec" name="selectJobspec" class="form-control input-sm">
                        	<?php echo dropdown_options('jobspec', $js_id);?>
                        </select>
                    </div>
                </div>
            </div>
            
            <hr />

            <div class="row">
                <div class="col-sm-3">
                    <input type="button" onclick="save_position();" class="btn btn-block btn-primary" value="Submit">
                </div>
            </div>

        </form>
        
    </div>
</section>
<script>
    function save_position(){
    	$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");

    	if($('#textPos').val() == ''){
    		$('#defaultNoticeContError').html('Position/Category is required.');
    		$("#frm_ErrorNotice").removeClass("hidden");
    		$('#textPos').focus();
    	}else if($('#selectJobspec').val() == ''){
    		$('#defaultNoticeContError').html('Job Specification is required.');
    		$("#frm_ErrorNotice").removeClass("hidden");
    		$('#selectJobspec').focus();
    	}else{
    		$.post(base_url_js+'settings/save/position', $('#frm_facebox_position').serialize(), function(data) {
    			if(data){
    				$('#defaultNoticeContSuccess').html('Successfully saved.');
    				$("#frm_SuccessNotice").removeClass("hidden");

    				setTimeout(function(){
    					$.facebox.close();
    					window.location.replace(base_url_js+'settings/position');
    				}, 1000);
    			}else{
    				$('#defaultNoticeContError').html('Unable to save position.');
    				$("#frm_ErrorNotice").removeClass("hidden");
    			}
    		});
// 				$('#defaultNoticeContSuccess').html('Successfully saved.');
// 				$("#frm_SuccessNotice").removeClass("hidden");

// 				setTimeout(function(){
// 					$.facebox.close();
// 					$('#frm_facebox_position').submit();
// 				}, 1000);
    	}
    }
</script>