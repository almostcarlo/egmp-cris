<?php
    if(isset($pos_info[0])){
        $id = $pos_info[0]['id'];
        $pos = $pos_info[0]['position'];
        $gender = $pos_info[0]['gender'];
        $authorityno = $pos_info[0]['authority_no'];
        $remarks = $pos_info[0]['remarks'];
        $qty = $pos_info[0]['quantity'];
    }else{
        $id = "";
        $pos = "";
        $gender = "";
        $qty = "";
        $authorityno = "";
        $remarks = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">VISA Position</h4>
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

            <?php echo form_open('processing/save/visa_pos', 'id="frm_visa_pos"');?>
            	
            	<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
            	<input type="hidden" id="textVisaId" name="textVisaId" value="<?php echo $visa_id;?>">

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="selectPosition">Position:</label>
                            <!-- <select id="selectPosition" name="selectPosition" class="form-control input-sm">
                            	<?php echo dropdown_options('position', $pos)?>
                            </select> -->
                            <input class="form-control input-sm" name="textPos" id="textPos" autocomplete="off" value="<?php echo $pos;?>">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="selectGender">Gender:</label>
                            <select id="selectGender" name="selectGender" class="form-control input-sm">
                            	<option value="M" <?php echo ($gender=='M')?"selected=\"selected\"":"";?>>Male</option>
                            	<option value="F" <?php echo ($gender=='F')?"selected=\"selected\"":"";?>>Female</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Quantity:</label>
                            <input type="text" id="textQty" name="textQty" value="<?php echo $qty;?>" class="form-control input-sm" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Authority No.:</label>
                            <input type="text" id="textAuthNo" name="textAuthNo" value="<?php echo $authorityno;?>" class="form-control input-sm" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="selectFieldOfStudy">Remarks:</label>
                            <textarea class="form-control input-sm" rows="5" name="textRemarks"><?php echo $remarks;?></textarea>
                        </div>
                    </div>
                </div>
                
                <hr />

                <div class="row">
                    <div class="col-sm-12">
                        <input type="button" class="btn btn-block btn-primary" value="Submit" id="btn_save_pos" onclick="save_visa_pos();">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>