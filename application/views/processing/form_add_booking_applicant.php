<!-- ADD APPLICANT FOR BOOKING REQUEST -->
<div>
    <section class="panel">
        <div class="panel-body <?php echo (isset($scroll))?"scroll":"";?>">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">Booking Request - Add Applicant</h4>
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

            <?php echo form_open('processing/save_app_booking_req', 'id="frm_app_booking_req"');?>
                
                <input type="hidden" id="textReqId" name="textReqId" value="<?php echo $lpt_req_id;?>">

                <div class="row">
                    <div class="col-md-12 mt-sm">
                        <div id="" class="form-group">
                            <label for="">MR Reference:</label>
                            <select id="selectMRRef" name="selectMRRef" class="form-control input-sm" onchange="show_applicants();">
                                <?php echo generate_dd($mr_list);?>
                            </select>
                        </div>
                    </div>
                </div>
                <hr>

	            <table class="table table-striped table-condensed table-hover mb-none" id="datatable_6col">
	                <thead>
	                    <tr>
	                    	<th><input type="checkbox" name="" id="chk_hdr" value="" <?php echo (!isset($mr_list))?"disabled=\"disabled\"":"";?> onclick="chkuncheck();"></th>
	                        <th>Name</th>
	                        <th>Position</th>
	                        <!-- <th class="text-center">E-Code</th> -->
	                    </tr>
	                </thead>
	                <?php
	                	if(isset($app_list)){
	                		foreach($app_list as $mr_id => $app_list){
	                ?>
				                <tbody class="all_tbody hidden" id="tbody_<?php echo $mr_id;?>">
                	<?php
                					foreach($app_list as $app_info){
					?>
					                	<tr>
					                		<td><input type="checkbox" class="chk_all" id="" name="selected_app[]" value="<?php echo $app_info['applicant_id'];?>"></td>
					                		<td><?php echo nameformat($app_info['fname'], $app_info['mname'], $app_info['lname'],1)?></td>
					                		<td><?php echo $app_info['position'];?></td>
					                	</tr>
					<?php
                					}
                	?>
			                	</tbody>
	                <?php
	                		}
	                	}
	                ?>
	                <tbody id="tbody_nodata">
	                	<tr>
	                		<td class="text-center" colspan="10">No data available in table.</td>
	                	</tr>
	                </tbody>
	            </table>

                <hr />

                <div class="row">
                    <div class="col-sm-12">
                        <input type="button" class="btn btn-block btn-primary" value="Submit Request" id="" onclick="save_app_booking_req();">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>