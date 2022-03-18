<?php
    $start_date = dateformat(date("Y-m-")."01",1);
    $end_date = dateformat("today",1);

    $mr_list = get_items_from_cache('mr');
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Reports - Operations</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-4">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">Candidates in Process</h3>
				</header>
				<div class="panel-body">

                    <?php echo form_open('reports_operations/print_report/candidate_in_process', 'id="frm_candidates" target="_blank"');?>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="SelectPrincipal">Principal:</label>
                                            <select id="SelectPrincipal" name="SelectPrincipal" class="form-control input-sm" onchange="$('#SelectMR').val('')">
                                                <option value="">Please select</option>
                                                <?php echo dropdown_options('principal', 0, false);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">MR No.:</label>
                                            <select id="SelectMR" name="SelectMR" class="form-control input-sm">
                                                <option value="">Please select</option>
                                                <?php echo generate_dd($mr_list, NULL, true, false);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Source:</label>
                                            <select id="SelectSource" name="SelectSource" class="form-control input-sm">
                                                <option value="">All</option>
                                                <?php echo dropdown_options('source', 0, false);?>
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