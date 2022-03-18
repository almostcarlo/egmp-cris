<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Reports - Recruitment</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-4">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">Lineup Monitoring Report</h3>
				</header>
				<div class="panel-body">

                    <?php echo form_open('reports_recruitment/print_report/lineup_monitor', 'id="frm_lineup_monitor" target="_blank"');?>

                        <div class="row">
                            <div class="col-md-12">

                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Schedule Status:</label>
                                            <select id="SelectStat" name="SelectStat" onchange="change_stat();" class="form-control input-sm">
                                            	<option value="1">CONFIRMED</option>
                                                <option value="0">TENTATIVE</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- CONFIRMED -->
                                <div class="row"  id="divC">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Principal:</label>
                                            <select id="SelectMRC" name="SelectMRC" onchange="enable_btn(); get_interview_sched($(this).val());" class="form-control input-sm">
                                            	<option value="">Please select</option>
                                                <?php
                                                    if(isset($mr_list[1])){
                                                        foreach($mr_list[1] as $id => $i){
                                                ?>
                                                            <option value="<?php echo $id;?>"><?php echo strtoupper($i['principal'])." (".$i['mr_ref'].")";?></option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- TENTATIVE -->
                                <div class="row hidden" id="divT">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Principal:</label>
                                            <select id="SelectMRT" name="SelectMRT" onchange="enable_btn(); get_interview_sched($(this).val());" class="form-control input-sm">
                                                <option value="">Please select</option>
                                                <?php
                                                    if(isset($mr_list[0])){
                                                        foreach($mr_list[0] as $id => $i){
                                                ?>
                                                            <option value="<?php echo $id;?>"><?php echo strtoupper($i['principal'])." (".$i['mr_ref'].")";?></option>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <!-- INTERVIEW SCHED -->
                                <div class="row" id="divT">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Interview Schedule:</label>
                                            <select id="selectSched" name="selectSched" class="form-control input-sm">
                                                <option value="">All</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />

                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-block btn-primary disabled" value="Create Report" id="btn_submit">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-block btn-success disabled" value="Open in Excel" id="btn_excel" name="btn_excel">
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
<script>
    function change_stat(){
        $('#SelectMRC, #SelectMRT').val('');
        $('#btn_submit, #btn_excel').addClass('disabled');

        if($('#SelectStat').val() == 1){
            $('#divT').addClass('hidden');
            $('#divC').removeClass('hidden');
        }else{
            $('#divC').addClass('hidden');
            $('#divT').removeClass('hidden');
        }
    }

    function enable_btn(){
        if($('#SelectMRC').val() == '' && $('#SelectMRT').val() == ''){
            $('#btn_submit, #btn_excel').addClass('disabled');
        }else{
            $('#btn_submit, #btn_excel').removeClass('disabled');
        }
    }

    function  get_interview_sched(mr_id){
        $("#selectSched").empty().append('<option value="">All</option>');
        if(mr_id != ''){
            $.get(base_url_js+'reports_recruitment/ajax/get_interview_sched', {id:mr_id}, function(data) {
                $("#selectSched").empty().append(data)
            });
        }
    }
</script>