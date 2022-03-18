<?php
    if(isset($info)){
        $title = "Edit";
        $id = $info[0]['id'];
        $principal_id = $info[0]['principal_id'];
        $company_id = $info[0]['company_id'];
        $order_date = $info[0]['order_date'];
        $confirmed_date = $info[0]['confirmed_date'];
        $ticket_no = $info[0]['ticket_no'];
        $travelagent_id = $info[0]['travel_agent_id'];
        $route1 = $info[0]['route1'];
        $fdate1 = $info[0]['flight_date1'];
        $airline1 = $info[0]['airline1'];
        $flight_no1 = $info[0]['flight_no1'];
        $route2 = $info[0]['route2'];
        $fdate2 = $info[0]['flight_date2'];
        $airline2 = $info[0]['airline2'];
        $flight_no2 = $info[0]['flight_no2'];
        $route3 = $info[0]['route3'];
        $fdate3 = $info[0]['flight_date3'];
        $airline3 = $info[0]['airline3'];
        $flight_no3 = $info[0]['flight_no3'];
        $route4 = $info[0]['route4'];
        $fdate4 = $info[0]['flight_date4'];
        $airline4 = $info[0]['airline4'];
        $flight_no4 = $info[0]['flight_no4'];
        $signatory = $info[0]['signatory'];
        $sig_pos = $info[0]['sig_pos'];
        $noted_by = $info[0]['noted_by'];
        $not_pos = $info[0]['not_pos'];
        $checked_by = $info[0]['checked_by'];
        $chk_pos = $info[0]['chk_pos'];
        $remarks = $info[0]['remarks'];
    }else{
        $title = "Add";
        $id = "";
        $principal_id = "";
        $company_id = "";
        $order_date = date("m/d/Y", strtotime("today"));
        $confirmed_date = "";
        $ticket_no = "";
        $travelagent_id = "";
        $route1 = "";
        $fdate1 = "";
        $airline1 = "";
        $flight_no1 = "";
        $route2 = "";
        $fdate2 = "";
        $airline2 = "";
        $flight_no2 = "";
        $route3 = "";
        $fdate3 = "";
        $airline3 = "";
        $flight_no3 = "";
        $route4 = "";
        $fdate4 = "";
        $airline4 = "";
        $flight_no4 = "";
        $signatory = "";
        $sig_pos = "";
        $noted_by = "";
        $not_pos = "";
        $checked_by = "";
        $chk_pos = "";
        $remarks = "";
    }
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Processing - PTA Manager</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-12">
            
			<section class="panel">
                <header class="panel-heading">
                	<a href="<?php echo BASE_URL;?>processing/search/pta" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> PTA List</a>
					<h3 class="panel-title">PTA Form - <?php echo $title;?></h3>
				</header>
				<div class="panel-body">
				
                	<?php flashNotification();?>
                    
                    <div id="frm_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
                        <strong>ERROR!</strong><br>
                        <div id="defaultNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
                    </div>
                    
                	<div id="frm_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                        <strong>SUCCESS!</strong><br>
                        <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
                    </div>
                    
                    <?php echo form_open('processing/save/pta', 'id="frm_pta"');?>
                    
                    	<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
                        
                        <div class="row">
                            <div class="col-md-6">
                                
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="SelectPrincipal">Principal:</label>
                                            <select id="SelectPrincipal" name="SelectPrincipal" class="form-control input-sm">
                                                <?php echo dropdown_options('principal', $principal_id);?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Company:</label>
                                            <select id="SelectCompany" name="SelectCompany" class="form-control input-sm">
                                                <?php echo dropdown_options('company', $company_id);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Order Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textOrderDate" name="textOrderDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($order_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Confirmed Date:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textConfirmedDate" name="textConfirmedDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($confirmed_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Travel Agent:</label>
                                            <select id="SelectTrAgent" name="SelectTrAgent" class="form-control input-sm">
                                                <?php echo dropdown_options('travelagent', $travelagent_id);?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mt-sm">
                                        <div class="form-group">
                                            <label for="">No. of Tickets:</label>
                                            <input type="text" id="textTicketNo" name="textTicketNo" autocomplete="off" value="<?php echo $ticket_no;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>

                                <hr />

                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Signatory:</label>
                                            <input type="text" id="textSignatory" name="textSignatory" autocomplete="off" value="<?php echo $signatory;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Position:</label>
                                            <input type="text" id="textSigPos" name="textSigPos" autocomplete="off" value="<?php echo $sig_pos;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Noted By:</label>
                                            <input type="text" id="textNotedBy" name="textNotedBy" autocomplete="off" value="<?php echo $noted_by;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Position:</label>
                                            <input type="text" id="textNotePos" name="textNotePos" autocomplete="off" value="<?php echo $not_pos;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Checked By:</label>
                                            <input type="text" id="textCheckedBy" name="textCheckedBy" autocomplete="off" value="<?php echo $checked_by;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Position:</label>
                                            <input type="text" id="textChkPos" name="textChkPos" autocomplete="off" value="<?php echo $chk_pos;?>" class="form-control input-sm" />
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Remarks:</label>
                                            <textarea rows="6" class="form-control input-sm" name="textRemarks" id="textRemarks"><?php echo $remarks;?></textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Route 1:</label>
                                                <textarea rows="3" class="form-control input-sm" name="textRoute1" id="textRoute1"><?php echo $route1;?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Date:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input id="textFDate1" name="textFDate1" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($fdate1,2);?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Airline:</label>
                                                <select id="SelectAirline1" name="SelectAirline1" class="form-control input-sm">
                                                    <?php echo dropdown_options('airline', $airline1);?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Flight No.:</label>
                                                <input type="text" id="textFlightNo1" name="textFlightNo1" autocomplete="off" value="<?php echo $flight_no1;?>" class="form-control input-sm" />
                                            </div>
                                        </div>
                                    </div>

                                    <hr />
                                    
                                    <div class="row">
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Route 2:</label>
                                                <textarea rows="3" class="form-control input-sm" name="textRoute2" id="textRoute2"><?php echo $route2;?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Date:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input id="textFDate2" name="textFDate2" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($fdate2,2);?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Airline:</label>
                                                <select id="SelectAirline2" name="SelectAirline2" class="form-control input-sm">
                                                    <?php echo dropdown_options('airline', $airline2);?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Flight No.:</label>
                                                <input type="text" id="textFlightNo2" name="textFlightNo2" autocomplete="off" value="<?php echo $flight_no2;?>" class="form-control input-sm" />
                                            </div>
                                        </div>
                                    </div>

                                    <hr />
                                    
                                    <div class="row">
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Route 3:</label>
                                                <textarea rows="3" class="form-control input-sm" name="textRoute3" id="textRoute3"><?php echo $route3;?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Date:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input id="textFDate3" name="textFDate3" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($fdate3,2);?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Airline:</label>
                                                <select id="SelectAirline3" name="SelectAirline3" class="form-control input-sm">
                                                    <?php echo dropdown_options('airline', $airline3);?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Flight No.:</label>
                                                <input type="text" id="textFlightNo3" name="textFlightNo3" autocomplete="off" value="<?php echo $flight_no3;?>" class="form-control input-sm" />
                                            </div>
                                        </div>
                                    </div>

                                    <hr />
                                    
                                    <div class="row">
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Route 4:</label>
                                                <textarea rows="3" class="form-control input-sm" name="textRoute4" id="textRoute4"><?php echo $route4;?></textarea>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Date:</label>
                                                <div class="input-group">
                                                    <span class="input-group-addon">
                                                        <i class="fa fa-calendar"></i>
                                                    </span>
                                                    <input id="textFDate4" name="textFDate4" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($fdate4,2);?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Airline:</label>
                                                <select id="SelectAirline4" name="SelectAirline4" class="form-control input-sm">
                                                    <?php echo dropdown_options('airline', $airline4);?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mt-sm">
                                            <div class="form-group">
                                                <label for="">Flight No.:</label>
                                                <input type="text" id="textFlightNo4" name="textFlightNo4" autocomplete="off" value="<?php echo $flight_no4;?>" class="form-control input-sm" />
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <input type="button" class="btn btn-block btn-primary" value="Submit" id="btn_submit">
                                        </div>
                                        <div class="col-sm-6">
                                            <a href="<?php echo BASE_URL;?>/processing/search/pta" class="btn btn-block btn-danger">Cancel</a>
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                            
                        </div>
                        
                    </form>
                    
                </div>
            </section>
		</div>
	</div>
	<!-- end: page -->
</section>