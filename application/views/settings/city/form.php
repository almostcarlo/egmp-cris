<?php
if(isset($info)){
    $id = $info[0]['id'];
    $name = $info[0]['name'];
    $province = $info[0]['province'];
    $zipcode = $info[0]['zipcode'];
    $areacode = $info[0]['area_code'];
    $region = $info[0]['region'];
    $branch = $info[0]['branch_id'];
}else{
    $id = "";
    $name = "";
    $province = "";
    $zipcode = "";
    $areacode = "";
    $region = "";
    $branch = "";
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
        
        <?php echo form_open(BASE_URL.'settings/save/city', 'id="frm_facebox_city"')?>
        	
        	<input type="hidden" name="textRecordId" value="<?php echo $id;?>">

            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="textName"> City Name</label>
                        <input type="text" id="textName" name="textName" value="<?php echo $name;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="textProvince">Province:</label>
                        <input type="text" id="textProvince" name="textProvince" value="<?php echo $province;?>" class="form-control input-sm" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="textZip">Zipcode:</label>
                        <input type="text" id="textZip" name="textZip" value="<?php echo $zipcode;?>" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="textAreacode">Area Code:</label>
                        <input type="text" id="textAreacode" name="textAreacode" value="<?php echo $areacode;?>" class="form-control input-sm" />
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="textRegion">Region:</label>
                        <input type="text" id="textRegion" name="textRegion" value="<?php echo $region;?>" class="form-control input-sm" />
                    </div>
                </div>
                <!-- <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="textBranch">Branch:</label>
                        <input type="text" id="textBranch" name="textBranch" value="<?php echo $branch;?>" class="form-control input-sm" />
                    </div>
                </div> -->
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
    		$('#defaultNoticeContError').html('City Name is required.');
    		$("#frm_ErrorNotice").removeClass("hidden");
    		$('#textPos').focus();
    	}else{
    		$.post(base_url_js+'settings/save/city', $('#frm_facebox_city').serialize(), function(data) {
    			if(data){
    				$('#defaultNoticeContSuccess').html('Successfully saved.');
    				$("#frm_SuccessNotice").removeClass("hidden");

    				setTimeout(function(){
    					$.facebox.close();
    					window.location.replace(base_url_js+'settings/search/city');
    				}, 1000);
    			}else{
    				$('#defaultNoticeContError').html('Unable to save city.');
    				$("#frm_ErrorNotice").removeClass("hidden");
    			}
    		});
    	}
    }
</script>