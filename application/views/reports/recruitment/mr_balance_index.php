<?php
    $start_date = dateformat(date("Y-m-")."01",1);
    $end_date = dateformat("today",1);
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Reports - Recruitment</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-4">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">Client MR Balance Sheet</h3>
				</header>
				<div class="panel-body">

                    <?php echo form_open('reports_recruitment/print_report/mr_balance', 'id="frm_encoded" target="_blank"');?>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">MR No.:</label>
                                            <select id="SelectMR" name="SelectMR" class="form-control input-sm">
                                                <?php echo generate_dd($mr_list);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />

                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-block btn-primary" value="Create Report" id="btn_submit">
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="submit" class="btn btn-block btn-success" value="Open in Excel" id="btn_excel" name="btn_excel">
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