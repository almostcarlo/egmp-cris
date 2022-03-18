<?php
    if(isset($info)){
        $id = $info[0]['id'];
        $type = $info[0]['type'];
        $principal_id = $info[0]['principal_id'];
        $venue = $info[0]['venue'];
        $start_date = $info[0]['start_date'];
        $end_date = $info[0]['end_date'];
        $user_id = $info[0]['user_id'];
        $status = $info[0]['status'];
        $file = $info[0]['file'];
        $rcv_copy = $info[0]['rcv_copy'];
        $remarks = $info[0]['remarks'];
    }else{
        $id = "";
        $type = "";
        $principal_id = "";
        $venue = "";
        $start_date = "";
        $end_date = "";
        $user_id = "";
        $status = "Requested";
        $file = "";
        $rcv_copy = "";
        $remarks = "";
    }

    $stat_option = array('Requested'=>'Requested','Disapproved'=>'Disapproved','Signed'=>'Signed','Released'=>'Released','Archived'=>'Archived');

    if($id && $status == 'Requested'){
    	unset($stat_option['Released'], $stat_option['Archived']);
    }else if($id && $status == 'Signed'){
    	unset($stat_option['Requested'], $stat_option['Archived']);
    }else if($id && $status == 'Released'){
    	unset($stat_option['Requested'], $stat_option['Signed'],$stat_option['Disapproved']);
    }else{
    	unset($stat_option['Signed'],$stat_option['Disapproved'], $stat_option['Released'], $stat_option['Archived']);
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
        
    	<?php echo form_open_multipart('recruitment/save/pra', 'id="frm_facebox_pra"')?>
        	
        	<input type="hidden" name="textRecordId" id="textRecordId" value="<?php echo $id;?>">

			<div class="row">
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="">Type:</label>
                        <select id="selectType" name="selectType" class="form-control input-sm">
                            <option value="PRA" <?php echo ($type=='PRA')?"selected=\"selected\"":""?>>PRA</option>
                            <option value="SRA" <?php echo ($type=='SRA')?"selected=\"selected\"":""?>>SRA</option>
                            <option value="JFA" <?php echo ($type=='JFA')?"selected=\"selected\"":""?>>JFA</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-8 mt-sm">
                    <div class="form-group">
                        <label for="">Principal:</label>
                        <select id="selectPrincipal" name="selectPrincipal" class="form-control input-sm">
                            <?php echo dropdown_options('principal', $principal_id);?>
                        </select>
                    </div>
                </div>
			</div>

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
                        <label for="">Staff:</label>
                        <select id="selectUser" name="selectUser" class="form-control input-sm">
                            <?php echo dropdown_options('users', $user_id);?>
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="">Start Date:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input id="textStartDate" name="textStartDate" type="text" value="<?php echo dateformat($start_date,0);?>" autocomplete="off" data-plugin-datepicker class="form-control input-sm">
                        </div>                        
                    </div>
                </div>
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="">End Date:</label>
                        <div class="input-group">
                            <span class="input-group-addon">
                                <i class="fa fa-calendar"></i>
                            </span>
                            <input id="textEndDate" name="textEndDate" type="text" value="<?php echo dateformat($end_date,0);?>" autocomplete="off" data-plugin-datepicker class="form-control input-sm">
                        </div>                        
                    </div>
                </div>
			</div>

			<div class="row">
                <div class="col-md-4 mt-sm">
                    <div class="form-group">
                        <label for="">Status:</label>
                        <select id="selectStatus" name="selectStatus" class="form-control input-sm">
                            <?php generate_dd($stat_option, $status, TRUE, FALSE);?>
                        </select>
                    </div>
                </div>
			</div>

			<div class="row <?php echo ($id && $status == 'Released')?"":"hidden";?>">
                <div class="col-md-8 mt-sm">
                    <div class="form-group">
                        <label for="">Attached Documents:</label>
                        <?php if($file):?>
                            <div id="cont_file_link">
                                <a href="<?php echo BASE_URL;?>recruitment/files/pra_file/<?php echo base64_encode($id);?>" target="_blank"><?php echo $file;?></a>
                                <a href="javascript:void(0);" onclick="delete_attachement('file', '<?php echo $id;?>');" style="color:red;">[delete]</a>
                            </div>
                            <input type="file" id="textFile" name="textFile" class="form-control input-sm hidden" />
                        <?php else:?>
                            <input type="file" id="textFile" name="textFile" class="form-control input-sm" />
                        <?php endif;?>
                    </div>
                </div>
			</div>

			<div class="row <?php echo ($id && $status == 'Released')?"":"hidden";?>">
				<div class="col-md-8 mt-sm">
                    <div class="form-group">
                        <label for="">Receiving Copy:</label>
                        <?php if($rcv_copy):?>
                            <div id="cont_rcv_copy_link">
                                <a href="<?php echo BASE_URL;?>recruitment/files/pra_rcv_copy/<?php echo base64_encode($id);?>" target="_blank"><?php echo $rcv_copy;?></a>
                                <a href="javascript:void(0);" onclick="delete_attachement('rcv_copy', '<?php echo $id;?>');" style="color:red;">[delete]</a>
                            </div>
                            <input type="file" id="textRcvCopy" name="textRcvCopy" class="form-control input-sm hidden" />
                        <?php else:?>
                            <input type="file" id="textRcvCopy" name="textRcvCopy" class="form-control input-sm" />
                        <?php endif;?>
                    </div>
                </div>
			</div>

			<div class="row <?php echo ($id)?"":"hidden";?>">
                <div class="col-md-12 mt-sm">
                    <div class="form-group">
                        <label for="">Remarks:</label>
                        <textarea id="textRemarks" name="textRemarks" class="form-control input-sm"><?php echo $remarks;?></textarea>
                    </div>
                </div>
			</div>
            
            <hr />

            <div class="row">
                <div class="col-sm-3">
                    <input type="button" class="btn btn-block btn-primary" value="Submit" id="btn_submit">
                </div>
            </div>

        </form>
        
    </div>
</section>