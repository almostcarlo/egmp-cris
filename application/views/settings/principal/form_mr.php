<?php
    if(isset($info)){
        $id = $info[0]['id'];
        $principal_id = $info[0]['principal_id'];
        $code = $info[0]['code'];
        $activity = explode('/',$info[0]['activity']);
        $doc_jdq = $info[0]['doc_jdq'];
        $rs = $info[0]['rs'];
        $rso = $info[0]['rso'];
        $fee = $info[0]['fee_condition'];
        $company_id = $info[0]['company_id'];
        $is_pooling = $info[0]['is_pooling'];
        $status = $info[0]['status'];
    }else{
        $id = "";
        $principal_id = "";
        $code = "";
        $activity = array('0'=>'LU');
        $doc_jdq = "";
        $company_id = "";
        $rs = "";
        $rso = "";
        $fee = "";
        $is_pooling = "N";
        $status = "1";
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
        
        <?php echo form_open_multipart('', 'id="frm_facebox_mr"')?>
        	
        	<input type="hidden" name="textRecordId" value="<?php echo $id;?>">
        	<input type="hidden" name="textPrincipalId" id="textPrincipalId" value="<?php echo $principal_id;?>">

            <div class="row">
                <!-- <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="textFullName">Client's Ref. No.:</label>
                        <input type="text" id="textReferenceNum" name="textReferenceNum" value="" class="form-control input-sm" />
                    </div>
                </div> -->
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="textFullName">Reference No.:</label>
                        <input type="text" id="textRefCode" name="textRefCode" value="<?php echo $code;?>" readonly="readonly" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="selectStatus">Status:</label>
                        <select id="selectStatus" name="selectStatus" class="form-control input-sm">
                            <option value="1" <?php echo ($status==1)?"selected=\"selected\"":""?>>Active</option>
                            <option value="2" <?php echo ($status==2)?"selected=\"selected\"":""?>>On-Hold</option>
                            <option value="0" <?php echo ($status==0)?"selected=\"selected\"":""?>>Closed</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="" style="margin-top:22px;"><input type="checkbox" name="chkPooling" value="1"<?php echo ($is_pooling=='Y')?"checked=\"checked\"":"";?> style="margin:0;vertical-align:middle;" /> (Check if POOLING DB)</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="textCompany">Company:</label>
                        <select id="selectCompany" name="selectCompany" class="form-control input-sm">
                        	<option value="">--Please select</option>
                            <?php //echo dropdown_options('company', $company_id);?>
                        </select>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="">Activity:</label><br />
                        <label style="font-weight:normal;margin-top:6px;"><input type="checkbox" style="margin:0;vertical-align:middle;" /> FR</label>&nbsp;&nbsp;&nbsp;
                        <label style="font-weight:normal;"><input type="checkbox" style="margin:0;vertical-align:middle;" style="margin:0;vertical-align:middle;" /> LU</label>&nbsp;&nbsp;&nbsp;
                        <label style="font-weight:normal;"><input type="checkbox" style="margin:0;vertical-align:middle;" /> CV</label>
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="selectClientSourceCode">Client Source Code:</label>
                        <select id="selectClientSourceCode" class="form-control input-sm">
                            <option>E1</option>
                            <option>E2</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="selectPriority">Priority:</label>
                        <select id="selectPriority" class="form-control input-sm">
                            <option>1</option>
                            <option>2</option>
                        </select>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="">Activity:</label><br />
                        <label style="font-weight:normal;"><input class="chkAct" name="chkActivity[]" type="checkbox" value="LU" style="margin:0;vertical-align:middle;" style="margin:0;vertical-align:middle;" <?php echo (in_array('LU', $activity))?"checked=\"checked\"":"";?> /> LU</label>&nbsp;&nbsp;&nbsp;
                        <label style="font-weight:normal;"><input class="chkAct" name="chkActivity[]" type="checkbox" value="CV" style="margin:0;vertical-align:middle;" <?php echo (in_array('CV', $activity))?"checked=\"checked\"":"";?> /> CV</label>&nbsp;&nbsp;&nbsp;
                        <label style="font-weight:normal;margin-top:6px;"><input class="chkAct" name="chkActivity[]" type="checkbox" value="FR" style="margin:0;vertical-align:middle;" <?php echo (in_array('FR', $activity))?"checked=\"checked\"":"";?>/> FR</label>
                    </div>
                </div>
                <!-- <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="fileRecruitmentDirectives">Recruitment Directives:</label>
                        <input type="file" id="fileRecruitmentDirectives" class="form-control input-sm" />
                    </div>
                </div> -->
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="selectFeeCondition">Fee Condition:</label>
                        <select id="selectFeeCondition" name="selectFeeCondition" class="form-control input-sm">
                        	<option value="">--Please select</option>
                            <option value="1" <?php echo ($fee==1)?"selected=\"selected\"":""?>>No Placement Fee</option>
                            <option value="2" <?php echo ($fee==2)?"selected=\"selected\"":""?>>1 Month Salary</option>
                            <option value="3" <?php echo ($fee==3)?"selected=\"selected\"":""?>>Others</option>
                        </select>
                    </div>
                </div>
            </div>
            <!-- <div class="row">
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="selectNatureProject">Nature of the Project:</label>
                        <select id="selectNatureProject" class="form-control input-sm">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="selectRM">RM:</label>
                        <select id="selectRM" class="form-control input-sm">
                            <option></option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="selectTE">TE:</label>
                        <select id="selectTE" class="form-control input-sm">
                            <option></option>
                        </select>
                    </div>
                </div>
            </div> -->
            <div class="row">
                <!-- <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="selectRSO">RSO:</label>
                        <select id="selectRSO" class="form-control input-sm">
                            <option></option>
                        </select>
                    </div>
                </div> -->

                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="selectRA">Assigned RS:</label>
                        <select id="selectRS" name="selectRS" class="form-control input-sm">
                            <?php echo dropdown_options('users', $rs);?>
                        </select>
                    </div>
                </div>

                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="">RSO:</label>
                        <select id="selectRSO" name="selectRSO" class="form-control input-sm">
                            <?php echo dropdown_options('users', $rso);?>
                        </select>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="fileJDQ">JDQ:</label>
                        <?php if($doc_jdq):?>
                            <br>
                            <a class="mr_current_file" href="<?php echo BASE_URL."settings/files/mr/".base64_encode($id);?>" target="_blank"><?php echo $doc_jdq;?></a>
                            <a class="mr_current_file" href="javascript:void(0);" onclick="AjaxDeleteFile('mr', '<?php echo $id;?>');" style="color:red;">[delete]</a>
                        <?php endif;?>
                        <input type="file" id="fileJDQ" name="fileJDQ" class="form-control input-sm <?php echo ($doc_jdq)?"hidden":""?>" />
                    </div>
                </div>
            </div>
            
            <hr />

            <div class="row">
                <div class="col-sm-3">
					<input type="button" onclick="save_mr();" class="btn btn-block btn-primary" value="Submit">
                </div>
            </div>

        </form>
        
    </div>
</section>
<script>
	generateDropdown('company','#selectCompany','<?php echo $company_id;?>');
</script>