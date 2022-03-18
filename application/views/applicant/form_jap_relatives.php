<?php
    if(isset($relative_info[0])){
    	$id = $relative_info[0]['id'];
        $name = $relative_info[0]['name'];
        $relationship = $relative_info[0]['relationship'];
        $age = $relative_info[0]['age'];
        $occupation = $relative_info[0]['occupation'];
        $address = $relative_info[0]['address'];
        $remarks = $relative_info[0]['remarks'];
        $title = "Edit";
    }else{
    	$id = "";
        $name = "";
        $relationship = "";
        $age = "";
        $occupation = "";
        $address = "";
        $remarks = "";
        $title = "Add";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Applicant's Relatives in Japan - <?php echo $title;?></h4>
                </div>
            </div>
            
            <div id="frm_ErrorNotice_f" class="alert alert-danger alert-dismissible hidden" role="alert">
                <strong>ERROR!</strong><br>
                <div id="defaultNoticeContError_f"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
        	<div id="frm_SuccessNotice_f" class="alert alert-success alert-dismissible hidden" role="alert">
                <strong>SUCCESS!</strong><br>
                <div id="defaultNoticeContSuccess_f"><strong><span id="inputRequired"></span></strong>[success message here]</div>
            </div>

            <?php echo form_open_multipart('applicant/save_profile/jap_relative', 'id="frm_jap_relative"');?>

            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">
            	<input type="hidden" name="textRecordId" value="<?php echo $id;?>">

                <div class="row">
                    <div class="col-md-10 mt-sm">
                        <div class="form-group">
                            <label for="">Name:</label>
                            <input type="text" name="textName" id="textName" class="form-control input-sm" value="<?php echo $name;?>">
                        </div>
                    </div>

                    <div class="col-md-2 mt-sm">
                        <div class="form-group">
                            <label for="">Age:</label>
                            <input type="text" id="textAge" name="textAge" value="<?php echo $age;?>" class="form-control input-sm" placeholder="" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Relationship:</label>
                            <input type="text" id="textRelationship" name="textRelationship" value="<?php echo $relationship;?>" class="form-control input-sm" placeholder="" />
                        </div>
                    </div>

                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Occupation:</label>
                            <input type="text" id="textOccupation" name="textOccupation" value="<?php echo $occupation;?>" class="form-control input-sm" placeholder="" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Address:</label>
                            <textarea name="textAddress" id="textAddress" class="form-control input-sm" rows="3"><?php echo $address;?></textarea>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Remarks:</label>
                            <textarea name="textRemarks" id="textRemarks" class="form-control input-sm" rows="3"><?php echo $remarks;?></textarea>
                        </div>
                    </div>
                </div>

                <hr />

                <div class="row">
                    <div class="col-sm-3">
                        <input type="button" onclick="save_jap_relatives();" class="btn btn-block btn-primary" value="Submit">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>