<?php
    if(isset($current_lineup_info)){
        $emp_offer_id = $current_lineup_info[0]['emp_offer_id'];
        $ref_no = $current_lineup_info[0]['ref_no'];
        $position = $current_lineup_info[0]['position'];
        $principal = $current_lineup_info[0]['principal'];
        $company = $current_lineup_info[0]['company'];
        $country = $current_lineup_info[0]['country'];
        $select_date = $current_lineup_info[0]['select_date'];
        $approval_date = $current_lineup_info[0]['approval_date'];
        $lineup_status = $current_lineup_info[0]['lineup_status'];
        $lineup_acceptance = $current_lineup_info[0]['lineup_acceptance'];
        $probation = $current_lineup_info[0]['probation'];
        $contract_type = $current_lineup_info[0]['contract_type'];
        $employment_status = $current_lineup_info[0]['employment_status'];
        $contract_period = $current_lineup_info[0]['contract_period'];
        $is_renewable = $current_lineup_info[0]['is_renewable'];
        $hrs_work = $current_lineup_info[0]['hrs_work'];
        $salary_currency = $current_lineup_info[0]['salary_currency'];
        $salary_per = $current_lineup_info[0]['salary_per'];
        $salary_amount = $current_lineup_info[0]['salary_amount'];
        $accomodation = $current_lineup_info[0]['accomodation'];
        $transportation = $current_lineup_info[0]['transportation'];
        $food = $current_lineup_info[0]['food'];
        $overtime = $current_lineup_info[0]['overtime'];
        $leave_provision = $current_lineup_info[0]['leave_provision'];
        $leave_ent = $current_lineup_info[0]['leave_ent'];
        $ticket_ent = $current_lineup_info[0]['ticket_ent'];
        $insurance = $current_lineup_info[0]['insurance'];
        $gratuity = $current_lineup_info[0]['gratuity'];
        $bonus = $current_lineup_info[0]['bonus'];
        $special_condition = $current_lineup_info[0]['special_condition'];
        $for_endorsement_id = $current_lineup_info[0]['for_endorsement_id'];
    }else{
        $emp_offer_id = 0;
        $ref_no = "";
        $position = "";
        $principal = "";
        $company = "";
        $country = "";
        $select_date = "";
        $approval_date = "";
        $lineup_status = "";
        $lineup_acceptance = "";
        $probation = "";
        $contract_type = "";
        $employment_status = "";
        $contract_period = "";
        $is_renewable = "N";
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
        $for_endorsement_id = "";
    }
?>
<div id="emp_offer" class="tab-pane active">

    <div class="row">
        <div class="col-md-6">
        
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Selection Details</h2>
                </header>
                <div class="panel-body">
                	<form>
                        <div class="row">
                        	<?php if(MR_REQUIRED):?>
                                <div class="col-md-6 mt-sm">
                                    <div id="" class="form-group">
                                        <label for="textMR">MR Ref:</label>
                                        <input type="text" id="textMR" name="textMR" value="<?php echo $ref_no;?>" autocomplete="off" readonly="readonly" class="form-control input-sm" />
                                    </div>
                                </div>
                            <?php endif;?>
                            
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCat">Category:</label>
                                    <input type="text" id="textCat" name="textCat" value="<?php echo $position;?>" autocomplete="off" readonly="readonly" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
    
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textPrincipal">Principal:</label>
                                    <input type="text" id="textPrincipal" name="textPrincipal" value="<?php echo $principal;?>" autocomplete="off" readonly="readonly" class="form-control input-sm" />
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCompany">Company:</label>
                                    <input type="text" id="textCompany" name="textCompany" value="<?php echo $company;?>" autocomplete="off" readonly="readonly" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textCountry">Country:</label>
                                    <input type="text" id="textCountry" name="textCountry" value="<?php echo $country;?>" autocomplete="off" readonly="readonly" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textSelectDate">Select Date:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textSelectDate" name="textSelectDate" value="<?php echo dateformat($select_date,2);?>" autocomplete="off" readonly="readonly" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textAppDate">Approval Date:</label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </span>
                                        <input id="textAppDate" name="textAppDate" value="<?php echo dateformat($approval_date, 2);?>" autocomplete="off" readonly="readonly" type="text" data-plugin-datepicker class="form-control input-sm">
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="SelectStatus">Interview Status:</label>
                                    <input id="" name="" value="<?php echo $lineup_status;?>" autocomplete="off" readonly="readonly" type="text" class="form-control input-sm">
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="SelectAccept">Acceptance:</label>
                                    <input id="" name="" value="<?php echo $lineup_acceptance;?>" autocomplete="off" readonly="readonly" type="text" class="form-control input-sm">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        
        </div>

        <div class="col-md-6">
            <section class="panel panel-featured panel-featured-primary">
                <header class="panel-heading">
                    <h2 class="panel-title">Employment Offer</h2>
                </header>
                
                <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                    <strong>ERROR!</strong><br>
                    <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
                </div>
                
            	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                    <strong>SUCCESS!</strong><br>
                    <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
                </div>
                
                <div class="panel-body">
                	<?php echo form_open('applicant/emp_offer', 'id="frm_emp_offer"');?>
                		<input type="hidden" name="textLineupId" value="<?php echo $lineup_id;?>" >
                		<input type="hidden" name="textRecordId" value="<?php echo $emp_offer_id;?>" >
                		<input type="hidden" name="textApplicantId" value="<?php echo $_GET['applicant_id'];?>" >

                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textProbation">Probation Period:</label>
                                    <input type="text" id="textProbation" name="textProbation" value="<?php echo $probation;?>" autocomplete="off" class="form-control input-sm" />
                                </div>
                            </div>
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="TextContractType">Contract Type:</label>
                                    <input type="text" id="TextContractType" name="TextContractType" value="<?php echo $contract_type;?>" autocomplete="off" class="form-control input-sm" />
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
                                        <option value="1 MONTH" <?php echo ($contract_period=='1 MONTH')?"selected=\"selected\"":"";?>>1 MONTH</option>
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
                        <label for=""><input type="checkbox" id="checkIsRenewable" name="checkIsRenewable" <?php echo ($is_renewable=='Y')?"checked=\"checked\"":""?> style="vertical-align:top"> contract period is renewable.</label>
                        
                        <div class="row">
                            <div class="col-md-6 mt-sm">
                                <div id="" class="form-group">
                                    <label for="textHrsWork">Hours of Work:</label>
                                    <input type="text" id="textHrsWork" name="textHrsWork" value="<?php echo $hrs_work;?>" autocomplete="off" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-md-4 mt-sm">
                                <div id="" class="form-group">
                                    <label for="">Salary:</label>
                                    <select id="SelectSalCurr" name="SelectSalCurr" class="form-control input-sm">
                                        <?php echo dropdown_options('currency', $salary_currency);?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4 mt-sm">
                            	<label for="">&nbsp;</label>
                                <div id="" class="form-group">
                                    <input type="text" id="textSalAmt" name="textSalAmt" value="<?php echo $salary_amount;?>" autocomplete="off" class="form-control input-sm" placeholder="0.00" />
                                </div>
                            </div>
                            <div class="col-md-4 mt-sm">
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
                        
                        <hr />
    
                        <div class="row">
                            <div class="col-sm-12">
                            	<?php if(is_null($lineup_id) || $lineup_id=='' || $lineup_id=='0'):?>
                                    <input type="button" value="Submit" class="btn btn-block btn-primary <?php echo (is_null($lineup_id) || $lineup_id=='' || $lineup_id=='0')?"disabled":""?>" id="btn_empoffer">
                                    <small class="required">*no active lineup found</small>
                                <?php elseif($for_endorsement_id):?>
                                    <small class="required">*applicant is already FOR ENDORSEMENT</small>
                            	<?php else:?>
                                	<input type="button" value="Submit" class="btn btn-block btn-primary" id="" onclick="save_emp_offer();">
                                <?php endif;?>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
            
        </div>
    </div>

</div>