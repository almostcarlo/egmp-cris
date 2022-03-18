<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Reports - Recruitment</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-4">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">MR Summary Report</h3>
				</header>
				<div class="panel-body">

                    <?php echo form_open('reports_recruitment/print_report/mr_summary', 'id="frm_mr_summary" target="_blank"');?>

                        <div class="row">
                            <div class="col-md-12">
                                
                                <!-- CONFIRMED -->
                                <div class="row"  id="divC">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Principal:</label>
                                            <select id="SelectMR" name="SelectMR" class="form-control input-sm" onchange="enable_btn();">
                                            	<option value="">Please select</option>
                                                <?php
                                                    if(isset($mr_list)){
                                                        foreach($mr_list as $id => $i){
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
    function enable_btn(){
        if($('#SelectMRC').val() == '' && $('#SelectMRT').val() == ''){
            $('#btn_submit, #btn_excel').addClass('disabled');
        }else{
            $('#btn_submit, #btn_excel').removeClass('disabled');
        }
    }
</script>