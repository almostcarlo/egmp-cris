<?php
    //disable uploading profile pic from this popup
    // unset($doc_type['iprs picture']);
    unset($doc_type['profile_pic']);
    unset($doc_type['portal_pic']);
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row mb-lg">
                <div class="col-sm-12">
                    <h4 class="modal-title">Upload <?php echo ($upload_what!='')?$upload_what:" File";?></h4>
                </div>
            </div>

            <div id="frm_WarningNotice" class="alert alert-warning alert-dismissible hidden" role="alert">
                <strong>WARNING!</strong><br>
                <div id="defaultNoticeContWarning"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
            <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                <strong>ERROR!</strong><br>
                <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
        	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                <strong>SUCCESS!</strong><br>
                <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
            </div>

            <?php echo form_open_multipart('applicant/save_profile/upload', 'id="frm_upload"');?>
            	
            	<input type="hidden" name="textApplicant_id" value="<?php echo $applicant_id;?>">
                <p>-PDF or MS Word documents only<br>-for images, use jpeg/jpg/png/gif type of file only<br>-maximum of <?php echo (MAX_FILE_UPLOAD/1024);?>mb per file</p>
                
                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="selectDocType">Type of Document:</label>
                            <select id="selectDocType" name="selectDocType" class="form-control input-sm">
                            	<option value="">Please select</option>
                            	<?php foreach ($doc_type as $code => $doc):?>
                                	<option value="<?php echo $code;?>" <?php echo ($upload_what=='CV' && $code == 'iprs_cv')?"selected=\"selected\"":"";?>><?php echo ucwords(strtolower($doc['desc']));?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-8 mt-sm">
                        <div class="form-group">
                            <label for="fileProfilePhoto">File:</label>
                            <input type="file" class="form-control input-sm" id="fileUpload" name="fileUpload">
                        </div>
                    </div>
                    <div class="col-md-4 mt-sm">
                        <div class="form-group">
                            <label>&nbsp;</label>
                            <input type="button" onclick="save_uploaded_file()" class="btn btn-block btn-primary btn-sm" id="btn_upload" value="Upload">
                        </div>
                    </div>
                </div>
                
                <!-- <div class="input-group">
                    <input type="file" class="form-control input-sm" id="fileUpload" name="fileUpload">
                    <span class="input-group-btn">
                        <button class="btn btn-primary btn-sm" type="button" onclick="save_uploaded_file('<?php echo $upload_what;?>')">Upload</button>
                    </span>
                </div>-->
            
            </form>
            
        </div>
    </section>
</div>