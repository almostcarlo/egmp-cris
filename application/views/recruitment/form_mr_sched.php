<?php
    if(isset($info)){
        $id = $info[0]['id'];
        $status = $info[0]['status'];
        $interview_date = $info[0]['interview_date'];
        $interview_time = $info[0]['interview_time'];
        $venue = $info[0]['venue'];
        $address = $info[0]['address'];
        $remarks= $info[0]['remarks'];
    }else{
        $id = "";
        $status = "";
        $interview_date = "";
        $interview_time = "";
        $venue = "";
        $address = "";
        $remarks= "";
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
        
    	<?php echo form_open('recruitment/save/mr_sched', 'id="frm_facebox_sched"')?>
        	
        	<input type="hidden" name="textRecordId" id="textRecordId" value="<?php echo $id;?>">
        	<input type="hidden" name="textMrId" id="textMrId" value="<?php echo $mr_id;?>">

            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="">Venue:</label>
                        <input type="text" id="textVenue" name="textVenue" value="<?php echo $venue;?>" class="form-control input-sm" />
                    </div>
                </div>
            </div>

			<div class="row">
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="selectStatus">Status:</label>
                        <select id="selectStatus" name="selectStatus" class="form-control input-sm">
                            <option value="0" <?php echo ($status=='0')?"selected=\"selected\"":""?>>Tentative</option>
                            <option value="1" <?php echo ($status=='1')?"selected=\"selected\"":""?>>Confirmed</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="inputInterviewDate">Interview Date:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input id="inputInterviewDate" name="inputInterviewDate" type="text" value="<?php echo dateformat($interview_date,0);?>" autocomplete="off" data-plugin-datepicker class="form-control input-sm">
                        </div>                        
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="textSalary">Time:</label>
                        <input type="text" id="textTime" name="textTime" value="<?php echo $interview_time;?>" class="form-control input-sm" />
                    </div>
                </div>
			</div>
            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="">Address:</label>
                        <textarea name="textAddress" id="textAddress" rows="3" cols="" class="form-control input-sm"><?php echo $address;?></textarea>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="">Remarks:</label>
                        <textarea name="textRemarks" id="textRemarks" rows="5" cols="" class="form-control input-sm"><?php echo $remarks;?></textarea>
                    </div>
                </div>
            </div>
            
            <hr />

            <div class="row">
                <div class="col-sm-3">
                    <input type="button" onclick="save_mr_sched();" class="btn btn-block btn-primary" value="Submit">
                </div>
            </div>

        </form>
        
    </div>
</section>