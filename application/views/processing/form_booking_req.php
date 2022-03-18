<?php
    if(isset($booking_info[0])){
        $id = $booking_info[0]['id'];
        $req_no = $booking_info[0]['request_no'];
        $req_by = $booking_info[0]['request_by'];
        $principal_id = $booking_info[0]['principal_id'];
        $company_id = $booking_info[0]['company_id'];
        $pr_date = $booking_info[0]['pr_book_date'];
        $req_date = $booking_info[0]['request_date'];
        $sub_date = $booking_info[0]['submit_date'];
        $route = $booking_info[0]['route'];
        $airline = $booking_info[0]['airline_id'];
        $to = $booking_info[0]['to'];
        $subject = $booking_info[0]['subject'];
        $message = $booking_info[0]['message'];
    }else{
        $id = "";
        $req_no = str_pad(getMaxCount("manager_booking")+1, 6, 0, STR_PAD_LEFT);
        $req_by = $_SESSION['rs_user']['username'];
        $principal_id = "";
        $company_id = "";
        $pr_date = "";
        $req_date = date("m/d/Y");
        $sub_date = date("m/d/Y");
        $route = "";
        $airline = "";
        $to = "";
        $subject = "";
        $message = "";
    }
?>
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title"><?php echo $type;?> Booking Request</h4>
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

            <?php echo form_open('processing/save/booking_req', 'id="frm_booking_req"');?>
            	
            	<input type="hidden" id="textRecordId_f" name="textRecordId" value="<?php echo $id;?>">
                <input type="hidden" id="textType" name="textType" value="<?php echo $type;?>">
            	
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Request No:</label>
                            <input type="text" id="textReqNo" name="textReqNo" value="<?php echo $req_no;?>" readonly="readonly" class="form-control input-sm" />
                        </div>
                    </div>
                    
					<div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Requested By:</label>
                            <input type="text" id="textReqBy" name="textReqBy" value="<?php echo $req_by;?>" readonly="readonly" class="form-control input-sm" />
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Principal:</label>
                            <select name="selectPrincipal" id="selectPrincipal" class="form-control input-sm">
                                <?php echo dropdown_options('principal', $principal_id);?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div class="form-group">
                            <label for="">Company:</label>
                            <select name="selectCompany" class="form-control input-sm">
                                <?php echo dropdown_options('company', $company_id);?>
                            </select>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Proposed Booking Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textPrDate" name="textPrDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($pr_date,2);?>">
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 mt-sm">
                        <div class="form-group">
                            <label for="">Request Date:</label>
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textReqDate" name="textReqDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($req_date,2);?>">
                            </div>
                        </div>
                    </div>
                </div>

                <?php if($type == 'LPT'):?>
                    <!-- LPT -->
                    <div class="row">
                        <div class="col-md-6 mt-sm">
                            <div class="form-group">
                                <label for="">Airline:</label>
                                <select name="selectAirline" class="form-control input-sm">
                                    <?php echo dropdown_options('airline', $airline);?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-6 mt-sm">
                            <div class="form-group">
                                <label for="">Date Submitted:</label>
                                <div class="input-group">
                                    <span class="input-group-addon">
                                        <i class="fa fa-calendar"></i>
                                    </span>
                                    <input id="textSubDate" name="textSubDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($sub_date,2);?>">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-sm">
                            <div class="form-group">
                                <label for="">Route:</label>
                                <textarea class="form-control input-sm" rows="3" name="textRoute"><?php echo $route;?></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- END LPT -->
                <?php endif;?>

                <?php if($type == 'PTA'):?>
                    <!-- PTA -->
                    <div class="row">
                        <div class="col-md-12 mt-sm">
                            <div class="form-group">
                                <label for="">To:</label>
                                <input type="text" id="textTo" name="textTo" value="<?php echo $to;?>" class="form-control input-sm" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-sm">
                            <div class="form-group">
                                <label for="">Subject:</label>
                                <input type="text" id="textSubject" name="textSubject" value="<?php echo $subject;?>" class="form-control input-sm" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12 mt-sm">
                            <div class="form-group">
                                <label for="">Message:</label>
                                <textarea class="form-control input-sm" rows="3" name="textMessage"><?php echo $message;?></textarea>
                            </div>
                        </div>
                    </div>
                    <!-- END PTA -->
                <?php endif;?>
                
                <hr />

                <div class="row">
                    <div class="col-sm-12">
                        <input type="button" class="btn btn-block btn-primary" value="Submit" id="" onclick="save_booking_req();">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>