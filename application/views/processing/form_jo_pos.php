<?php
    if(isset($pos_info[0])){
        $id = $pos_info[0]['id'];
        $position = $pos_info[0]['position'];
        $gender = $pos_info[0]['gender'];
        $qty = $pos_info[0]['quantity'];
        $employment_status = $pos_info[0]['employment_status'];
        $contract_period = $pos_info[0]['contract_period'];
        $hrs_work = $pos_info[0]['hrs_work'];
        $salary_currency = $pos_info[0]['salary_currency'];
        $salary_per = $pos_info[0]['salary_per'];
        $salary_amount = $pos_info[0]['salary_amount'];
        $accomodation = $pos_info[0]['accomodation'];
        $transportation = $pos_info[0]['transportation'];
        $food = $pos_info[0]['food'];
        $overtime = $pos_info[0]['overtime'];
        $leave_provision = $pos_info[0]['leave_provision'];
        $leave_ent = $pos_info[0]['leave_ent'];
        $ticket_ent = $pos_info[0]['ticket_ent'];
        $insurance = $pos_info[0]['insurance'];
        $gratuity = $pos_info[0]['gratuity'];
        $bonus = $pos_info[0]['bonus'];
        $special_condition = $pos_info[0]['special_condition'];
        $remarks = $pos_info[0]['remarks'];
    }else{
        $id = "";
        $position = "";
        $gender = "";
        $qty = "";
        $employment_status = "";
        $contract_period = "";
        $hrs_work = "";
        $salary_currency = "";
        $salary_per = "";
        $salary_amount = "";
        $accomodation = "";
        $transportation = "";
        $food = "";
        $overtime = "";
        $leave_provision = "";
        $leave_ent = "";
        $ticket_ent = "";
        $insurance = "";
        $gratuity = "";
        $bonus = "";
        $special_condition = "";
        $remarks = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Job Order Category</h4>
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

            <?php echo form_open('processing/save/jo_pos', 'id="frm_jo_pos"');?>
            	
            	<input type="hidden" id="textRecordId_f" name="textRecordId" value="<?php echo $id;?>">
            	<input type="hidden" id="textJOId" name="textJOId" value="<?php echo $jo_id;?>">
            	
                <div class="row">
                    <div class="col-md-8 mt-sm">
                        <div class="form-group">
                            <label for="">Position:</label>
                            <input type="text" id="textPos" name="textPos" value="<?php echo $position;?>" autocomplete="off" class="form-control input-sm" />
                        </div>
                    </div>
                    
                    <div class="col-md-2 mt-sm">
                        <div class="form-group">
                            <label for="">Gender:</label>
                            <select id="SelectGender" name="SelectGender" class="form-control input-sm">
                                <option value="M" <?php echo ($gender=='M')?"selected=\"selected\"":"";?>>Male</option>
                                <option value="F" <?php echo ($gender=='F')?"selected=\"selected\"":"";?>>Female</option>
                                <option value="ANY" <?php echo ($gender=='ANY')?"selected=\"selected\"":"";?>>Both</option>
                            </select>
                        </div>
                    </div>
                    
					<div class="col-md-2 mt-sm">
                        <div class="form-group">
                            <label for="">Quantity:</label>
                            <input type="text" id="textQty" name="textQty" value="<?php echo $qty;?>" class="form-control input-sm" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="SelectEmpStatus">Employment Status:</label>
                            <select id="SelectEmpStatus" name="SelectEmpStatus" class="form-control input-sm">
                                <option value="">please select</option>
                                <option value="Single" <?php echo ($employment_status=='Single')?"selected=\"selected\"":"";?>>Single</option>
                                <option value="Family" <?php echo ($employment_status=='Family')?"selected=\"selected\"":"";?>>Family</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="SelectContractPeriod">Contract Period:</label>
                            <select id="SelectContractPeriod" name="SelectContractPeriod" class="form-control input-sm">
                                <option value="">please select</option>
                                <option value="1 MONTH" <?php echo ($contract_period=='1 MONTH')?"selected=\"selected\"":"";?>>1 MONTHS</option>
                                <option value="2 MONTHS" <?php echo ($contract_period=='2 MONTHS')?"selected=\"selected\"":"";?>>2 MONTHS</option>
                                <option value="3 MONTHS" <?php echo ($contract_period=='3 MONTHS')?"selected=\"selected\"":"";?>>3 MONTHS</option>
                                <option value="6 MONTHS" <?php echo ($contract_period=='6 MONTHS')?"selected=\"selected\"":"";?>>6 MONTHS</option>
                                <option value="9 MONTHS" <?php echo ($contract_period=='9 MONTHS')?"selected=\"selected\"":"";?>>9 MONTHS</option>
                                <option value="12 MONTHS" <?php echo ($contract_period=='12 MONTHS')?"selected=\"selected\"":"";?>>12 MONTHS</option>
                                <option value="18 MONTHS" <?php echo ($contract_period=='18 MONTHS')?"selected=\"selected\"":"";?>>18 MONTHS</option>
                                <option value="24 MONTHS" <?php echo ($contract_period=='24 MONTHS')?"selected=\"selected\"":"";?>>24 MONTHS</option>
                                <option value="36 MONTHS" <?php echo ($contract_period=='36 MONTHS')?"selected=\"selected\"":"";?>>36 MONTHS</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 mt-sm">
                        <div id="" class="form-group">
                            <label for="">Salary:</label>
                            <select id="SelectSalCurr" name="SelectSalCurr" class="form-control input-sm">
                                <?php echo dropdown_options('currency', $salary_currency);?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-2 mt-sm">
                    	<label for="">&nbsp;</label>
                        <div id="" class="form-group">
                            <input type="text" id="textSalAmt" name="textSalAmt" value="<?php echo $salary_amount;?>" autocomplete="off" class="form-control input-sm" placeholder="0.00" />
                        </div>
                    </div>
                    <div class="col-md-2 mt-sm">
                        <div id="" class="form-group">
                        	<label for="">&nbsp;</label>
                            <select id="SelectSalPer" name="SelectSalPer" class="form-control input-sm">
                                <option value="hour" <?php echo ($salary_per=='hour')?"selected=\"selected\"":""?>>/hour</option>
                                <option value="month" <?php echo ($salary_per=='month')?"selected=\"selected\"":""?>>/month</option>
                                <option value="year" <?php echo ($salary_per=='year')?"selected=\"selected\"":""?>>/year</option>
                                <option value="day" <?php echo ($salary_per=='day')?"selected=\"selected\"":""?>>/day</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-5 mt-sm">
                        <div id="" class="form-group">
                            <label for="textHrsWork">Hours of Work:</label>
                            <input type="text" id="textHrsWork" name="textHrsWork" value="<?php echo $hrs_work;?>" autocomplete="off" class="form-control input-sm" />
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="textAccom">Accomodation:</label>
                            <input type="text" id="textAccom" name="textAccom" value="<?php echo $accomodation;?>" autocomplete="off" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="textTransport">Transportation:</label>
                            <input type="text" id="textTransport" name="textTransport" value="<?php echo $transportation;?>" autocomplete="off" class="form-control input-sm" />
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="textFood">Food:</label>
                            <input type="text" id="textFood" name="textFood" autocomplete="off" value="<?php echo $food;?>" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="textOT">Overtime:</label>
                            <input type="text" id="textOT" name="textOT" autocomplete="off" value="<?php echo $overtime;?>" class="form-control input-sm" />
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="textLeavePr">Leave Provision:</label>
                            <input type="text" id="textLeavePr" name="textLeavePr" value="<?php echo $leave_provision;?>" autocomplete="off" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="textLeaveEnt">Leave Entitlement:</label>
                            <input type="text" id="textLeaveEnt" name="textLeaveEnt" value="<?php echo $leave_ent;?>" autocomplete="off" class="form-control input-sm" />
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="textTicket">Ticket Entitlement:</label>
                            <input type="text" id="textTicket" name="textTicket" value="<?php echo $ticket_ent;?>" autocomplete="off" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="textInsurance">Insurance:</label>
                            <input type="text" id="textInsurance" name="textInsurance" value="<?php echo $insurance;?>" autocomplete="off" class="form-control input-sm" />
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="textGratuity">Gratuity:</label>
                            <input type="text" id="textGratuity" name="textGratuity" value="<?php echo $gratuity;?>" autocomplete="off" class="form-control input-sm" />
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="textBonus">Bonus:</label>
                            <input type="text" id="textBonus" name="textBonus" value="<?php echo $bonus;?>" autocomplete="off" class="form-control input-sm" />
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div id="" class="form-group">
                            <label for="textSpCondition">Special Condition:</label>
                            <textarea id="textSpCondition" name="textSpCondition" class="form-control input-sm"><?php echo $special_condition?></textarea>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div id="" class="form-group">
                            <label for="textSpCondition">Remarks:</label>
                            <textarea id="textRemarks" name="textRemarks" class="form-control input-sm"><?php echo $remarks?></textarea>
                        </div>
                    </div>
                </div>
                
                <hr />

                <div class="row">
                    <div class="col-sm-12">
                        <input type="button" class="btn btn-block btn-primary" value="Submit" id="" onclick="save_jo_pos();">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>