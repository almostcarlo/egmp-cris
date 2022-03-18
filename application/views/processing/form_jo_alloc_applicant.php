<?php
    // var_dump($pos_info);
?>
<!-- ADD APPLICANT FOR JO ALLOCATION -->
<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">JO Allocation</h4>
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

            <?php echo form_open('processing/save_jo_allocation', 'id="frm_jo_allocation"');?>
                
                <input type="hidden" id="textJOId" name="textJOId" value="<?php echo $jo_id;?>">
                <input type="hidden" id="textJOPosId" name="textJOPosId" value="<?php echo $jo_pos_id;?>">

                <div class="row">
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">MR Reference:</label>
                            <select id="selectMRRef" name="selectMRRef" class="form-control input-sm" onchange="show_applicants();">
                                <?php echo generate_dd($mr_list);?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6 mt-sm">
                        <div id="" class="form-group">
                            <label for="">VISA Position:</label>
                            <!-- <div class="input-group">
                                <span class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </span>
                                <input id="textTransSubmit" name="textTransSubmit" value="<?php echo date("m/d/Y");?>" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm">
                            </div> -->
                            <input type="text" class="form-control input-sm" readonly="readonly" value="<?php echo $pos_info[0]['position'];?>">
                        </div>
                    </div>
                </div>
                <hr>

	            <table class="table table-striped table-condensed table-hover mb-none" id="datatable_6col">
	                <thead>
	                    <tr>
	                    	<th>&nbsp;</th>
	                        <th>Name</th>
	                        <th>Lineup Category</th>
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
					                		<td>
                                                <input type="checkbox" class="chk_all" id="" name="selected_app[]" value="<?php echo $app_info['applicant_id'];?>">
                                                <input type="hidden" value="<?php echo $app_info['processing_id'];?>" name="processing_ids[]">
                                                <input type="hidden" value="<?php echo $app_info['lineup_id'];?>" name="lineup_ids[]">
                                            </td>
					                		<td><?php echo nameformat($app_info['fname'], $app_info['mname'], $app_info['lname'])?></td>
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
                        <input type="button" class="btn btn-block btn-primary" value="Allocate" id="btnAllocate" onclick="save_jo_allocation();">
                    </div>
                </div>

            </form>
            
        </div>
    </section>
</div>