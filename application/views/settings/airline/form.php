<?php
if(isset($info)){
    $id = $info[0]['id'];
    $name = $info[0]['name'];
    $code = $info[0]['code'];
    $address = $info[0]['address'];
}else{
    $id = "";
    $name = "";
    $code = "";
    $address = "";
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
        
        <?php echo form_open(BASE_URL.'settings/save/airline', 'id="frm_facebox_airline"')?>
            
            <input type="hidden" name="textRecordId" value="<?php echo $id;?>">

            <div class="row">
                <div class="col-md-8 mt-sm">
                    <div class="form-group">
                        <label for=""> Airline Name</label>
                        <input type="text" id="textName" name="textName" value="<?php echo $name;?>" autocomplete="off" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for=""> Code</label>
                        <input type="text" id="textCode" name="textCode" value="<?php echo $code;?>" autocomplete="off" class="form-control input-sm" />
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
            $('#defaultNoticeContError').html('Airline Name is required.');
            $("#frm_ErrorNotice").removeClass("hidden");
            $('#textName').focus();
        }else if($('#textCode').val() == ''){
            $('#defaultNoticeContError').html('Airline Code is required.');
            $("#frm_ErrorNotice").removeClass("hidden");
            $('#textCode').focus();
        }else{
            $.post(base_url_js+'settings/save/airline', $('#frm_facebox_airline').serialize(), function(data) {
                if(data){
                    $('#defaultNoticeContSuccess').html('Successfully saved.');
                    $("#frm_SuccessNotice").removeClass("hidden");

                    setTimeout(function(){
                        $.facebox.close();
                        window.location.replace(base_url_js+'settings/search/airline');
                    }, 1000);
                }else{
                    $('#defaultNoticeContError').html('Unable to save airline.');
                    $("#frm_ErrorNotice").removeClass("hidden");
                }
            });
        }
    }
</script>