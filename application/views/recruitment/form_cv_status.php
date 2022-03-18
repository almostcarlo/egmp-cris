<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row mb-lg">
                <div class="col-sm-12">
                    <h4 class="modal-title">Update CV Status</h4>
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

            <?php echo form_open('recruitment/save_cv_status', 'id="frm_cv_status"');?>
            	
            	<input type="hidden" name="textRecordId" value="<?php echo $ids;?>">
                <!-- <p>-PDF or MS Word documents only<br>-for images, use jpeg/jpg/png/gif type of file only<br>-maximum of 10mb per file</p> -->
                
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="selectDocType">Status:</label>
                            <select id="selectStat" name="selectStat" class="form-control input-sm">
                            	<option value="">Please select</option>
                            	<option value="reviewed">Reviewed</option>
                            	<option value="sent">Sent</option>
                            	<option value="selected">Selected</option>
                            	<option value="rejected">Rejected</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textDate" name="textDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo date("m/d/Y");?>">
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <input type="button" onclick="saveCVStat()" class="btn btn-block btn-primary btn-sm" id="btn_upload" value="Save">
                        </div>
                    </div>
                </div>
            
            </form>
            
        </div>
    </section>
</div>