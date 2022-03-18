<?php
    if(isset($info)){
        $id = $info[0]['id'];
        $principal_id = $info[0]['principal_id'];
        $name = $info[0]['name'];
        $designation = $info[0]['designation'];
        $email = $info[0]['email'];
        $tel_no = $info[0]['tel_no'];
        $mob_no = $info[0]['mob_no'];
        $skype = $info[0]['skype'];
        $facebook = $info[0]['facebook'];
    }else{
        $id = "";
        $principal_id = "";
        $name = "";
        $designation = "";
        $email = "";
        $tel_no = "";
        $mob_no = "";
        $skype = "";
        $facebook = "";
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
        
        <?php echo form_open('', 'id="frm_facebox"')?>
        	
        	<input type="hidden" name="textRecordId" value="<?php echo $id;?>">
        	<input type="hidden" name="textPrincipalId" id="textPrincipalId" value="<?php echo $principal_id;?>">

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="textFullName">Full Name:</label>
                        <input type="text" id="textFullName" name="textFullName" value="<?php echo $name;?>" class="form-control input-sm" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="textDesignation">Designation:</label>
                        <input type="text" id="textDesignation" name="textDesignation" value="<?php echo $designation;?>" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="textEmail">Email:</label>
                        <input type="text" id="textEmail" name="textEmail" value="<?php echo $email;?>" class="form-control input-sm" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="textMobileNum">Mobile No.:</label>
                        <input type="text" id="textMobileNum" name="textMobileNum" value="<?php echo $mob_no;?>" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="textTelNum">Tel. No.:</label>
                        <input type="text" id="textTelNum" name="textTelNum" value="<?php echo $tel_no;?>" class="form-control input-sm" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="textSkypeID">Skype ID:</label>
                        <input type="text" id="textSkypeID" name="textSkypeID" value="<?php echo $skype;?>" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="textFacebook">Facebook:</label>
                        <input type="text" id="textFacebook" name="textFacebook" value="<?php echo $facebook;?>" class="form-control input-sm" />
                    </div>
                </div>
            </div>
            
            <hr />

            <div class="row">
                <div class="col-sm-3">
                    <input type="button" onclick="save_contacts();" class="btn btn-block btn-primary" value="Submit">
                </div>
            </div>

        </form>
        
    </div>
</section>