<?php
    if(isset($info)){
        $id = $info[0]['id'];
        $pos_id = $info[0]['pos_id'];
        $religion = $info[0]['religion'];
        $gender = $info[0]['gender'];
        $currency = $info[0]['salary_curr'];
        $required = $info[0]['required'];
        $target = $info[0]['target'];
        $salary_amt = $info[0]['salary_amt'];
        $food = $info[0]['allowance_type'];
        $food_amt = $info[0]['allowance_amt'];
        $status = $info[0]['status'];
        $job_desc = $info[0]['desc'];
        $job_req = $info[0]['req'];
        $location = $info[0]['location'];
        $mr_ref = $info[0]['mr_ref'];
        $expiry_date = $info[0]['expiry_date'];
        
        get_items_from_cache('principal');
    }else{
        $id = "";
        $pos_id = "";
        $religion = "Any";
        $gender = "Any";
        $currency = 1;
        $required = "";
        $target = "";
        $salary_amt = "";
        $food = "";
        $food_amt = "";
        $status = "";
        $job_desc = "";
        $job_req = "";
        $location = "";
        $mr_ref = "";
        $expiry_date = "";
    }
?>
<section class="panel">
    <div class="panel-body">
        
            <div id="frm_ErrorNotice_fb" class="alert alert-danger alert-dismissible hidden" role="alert">
                <strong>ERROR!</strong><br>
                <div id="defaultNoticeContError_fb"><strong><span id="inputRequired"></span></strong>[error message here]</div>
            </div>
            
        	<div id="frm_SuccessNotice_fb" class="alert alert-success alert-dismissible hidden" role="alert">
                <strong>SUCCESS!</strong><br>
                <div id="defaultNoticeContSuccess_fb"><strong><span id="inputRequired"></span></strong>[success message here]</div>
            </div>
        
    	<?php echo form_open('recruitment/save/jo', 'id="frm_facebox_jo"')?>
        	
        	<input type="hidden" name="textRecordId" id="textRecordId" value="<?php echo $id;?>">
        	<input type="hidden" name="textPrincipalId" id="textPrincipalId" value="<?php echo $principal_id;?>">
        	<input type="hidden" name="textCompanyId" id="textCompanyId" value="<?php echo $company_id;?>">
        	<input type="hidden" name="textMrId" id="textMrId" value="<?php echo $mr_id;?>">

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="textPosition">Position:</label>
                        <select id="textPosition" name="textPosition" class="form-control input-sm">
                            <?php echo dropdown_options('position', $pos_id);?>
                        </select>
                    </div>
                </div>
            </div>
            
			<div class="row">
                <div class="col-md-2 mt-sm">
                    <div class="form-group">
                        <label for="textRequired">Required Qty:</label>
                        <input type="text" id="textRequired" name="textRequired" value="<?php echo $required;?>" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-2 mt-sm">
                    <div class="form-group">
                        <label for="textTarget">Target:</label>
                        <input type="text" id="textTarget" name="textTarget" value="<?php echo $target;?>" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="inputExpDate">Expiry Date:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input id="inputExpDate" name="inputExpDate" type="text" value="<?php echo dateformat($expiry_date,0);?>" autocomplete="off" data-plugin-datepicker class="form-control input-sm">
                        </div>                        
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="selectStatus">Status:</label>
                        <select id="selectStatus" name="selectStatus" class="form-control input-sm">
                            <option value="1" <?php echo ($status=='1')?"selected=\"selected\"":""?>>Active</option>
                            <option value="2" <?php echo ($status=='2')?"selected=\"selected\"":""?>>On-Hold</option>
                            <option value="0" <?php echo ($status=='0')?"selected=\"selected\"":""?>>Closed</option>
                        </select>
                    </div>
                </div>
			</div>
            <div class="row">
                <div class="col-md-2 mt-sm">
                    <div class="form-group">
                        <label for="selectCurrency">Currency:</label>
                        <select id="selectCurrency" name="selectCurrency" class="form-control input-sm">
                            <?php echo dropdown_options('currency', $currency);?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="textSalary">Salary:</label>
                        <input type="text" id="textSalary" name="textSalary" value="<?php echo $salary_amt;?>" class="form-control input-sm" />
                    </div>
                </div>
                <div class="col-md-2 mt-sm">
                    <div class="form-group">
                        <label for="selectFood">Food:</label>
                        <select id="selectFood" name="selectFood" class="form-control input-sm">
                            <option value="FF" <?php echo ($food=='FF')?"selected=\"selected\"":""?>>FF</option>
                            <option value="FI" <?php echo ($food=='FI')?"selected=\"selected\"":""?>>FI</option>
                            <option value="FA" <?php echo ($food=='FA')?"selected=\"selected\"":""?>>FA</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="textFoodAllowance">Food Allowance:</label>
                        <input type="text" id="textFoodAllowance" name="textFoodAllowance" value="<?php echo $food_amt;?>" class="form-control input-sm" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="selectGender">Gender:</label>
                        <select id="selectGender" name="selectGender" class="form-control input-sm">
                            <option value="Male" <?php echo ($gender=='Male')?"selected=\"selected\"":""?>>Male</option>
                            <option value="Female" <?php echo ($gender=='Female')?"selected=\"selected\"":""?>>Female</option>
                            <option value="Any" <?php echo ($gender=='Any')?"selected=\"selected\"":""?>>Any</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6 mt-sm">
                    <div class="form-group">
                        <label for="selectReligion">Religion:</label>
                        <select id="selectReligion" name="selectReligion" class="form-control input-sm">
                            <option value="Muslim" <?php echo ($religion=='Muslim')?"selected=\"selected\"":""?>>Muslim</option>
                            <option value="Non-Muslim" <?php echo ($religion=='Non-Muslim')?"selected=\"selected\"":""?>>Non-Muslim</option>
                            <option value="Any" <?php echo ($religion=='Any')?"selected=\"selected\"":""?>>Any</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="textJobDesc">Location:</label>
                        <input type="text" id="textLocation" name="textLocation" value="<?php echo $location;?>" class="form-control input-sm" />
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="textJobDesc">Job Description:</label>
                        <textarea name="textJobDesc" id="textJobDesc" rows="5" cols="" class="form-control input-sm"><?php echo $job_desc;?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="textFoodAllowance">Job Requirements:</label>
                        <textarea name="textJobReq" id="textJobReq" rows="5" cols="" class="form-control input-sm"><?php echo $job_req;?></textarea>
                    </div>
                </div>
            </div>
            
            <hr />

            <div class="row">
                <div class="col-sm-3">
                    <input type="button" onclick="save_jo();" class="btn btn-block btn-primary" value="Submit">
                </div>
            </div>

        </form>
        
    </div>
</section>