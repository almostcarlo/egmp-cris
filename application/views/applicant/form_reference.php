<?php
    if(isset($ref_info[0])){
        $ref_name = $ref_info[0]['name'];
        $ref_company = $ref_info[0]['employer'];
        $ref_position = $ref_info[0]['position'];
        $ref_contactno = $ref_info[0]['contact_no'];
        $ref_email = $ref_info[0]['email'];
        $ref_relationship = $ref_info[0]['relationship'];
    }else{
        $ref_name = "";
        $ref_company = "";
        $ref_position = "";
        $ref_contactno = "";
        $ref_email = "";
        $ref_relationship = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Reference</h4>
                </div>
            </div>
            
            <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                <strong>ERROR!</strong><br>
                <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
        	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                <strong>SUCCESS!</strong><br>
                <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
            </div>

            <?php echo form_open('applicant/save_profile/reference', 'id="frm_reference"');?>
            
            	<input type="hidden" name="hRefId" value="<?php echo $record_id;?>">
            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="textRefName">Name:</label>
                            <input type="text" id="textRefName" name="textName" value="<?php echo $ref_name;?>" class="form-control input-sm" />
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="textRefPosition">Position Title:</label>
                            <input type="text" id="textRefPosition" name="textPosition" value="<?php echo $ref_position;?>" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="textRefCompany">Company Name:</label>
                            <input type="text" id="textRefCompany" name="textEmployer" value="<?php echo $ref_company;?>" class="form-control input-sm" />
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label fo="textRefContactNum">Contact No.:</label>
                            <input id="textRefContactNum" type="text" name="textContactNo" value="<?php echo $ref_contactno;?>" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label fo="textRefEmail">Email Address:</label>
                            <input id="textRefEmail" type="text" name="textEmail" value="<?php echo $ref_email;?>" class="form-control input-sm">
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label fo="textRefRelationship">Relationship:</label>
                            <input id="textRefRelationship" type="text" name="textRelationship" value="<?php echo $ref_relationship;?>" class="form-control input-sm">
                        </div>
                    </div>
                </div>
                
                <hr />

                <div class="row">
                    <div class="col-sm-3">
                        <input type="button" onclick="save_reference();" class="btn btn-block btn-primary" value="Submit">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>