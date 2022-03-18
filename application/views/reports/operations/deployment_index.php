<?php
    $start_date = dateformat(date("Y-m-")."01",1);
    $end_date = dateformat("today",1);
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
					<h3 class="panel-title">Deployment Report</h3>
				</header>
				<div class="panel-body">

                    <?php echo form_open('reports_operations/print_report/deployment', 'id="frm_deployment" target="_blank"');?>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Deployment Date from:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textStDate" name="textStDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($start_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">to:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textEnDate" name="textEnDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat($end_date,2);?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Report Type:</label>
                                            <select id="SelectType" name="SelectType" class="form-control input-sm">
                                            	<option value="1">Summary per Principal</option>
                                            	<option value="2">Detailed per Principal</option>
                                                <option value="3">POEA Welfare Monitoring</option>
                                                <option value="4">Finished Contract</option>
                                                <option value="5">By Position</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="SelectPrincipal">Client:</label>
                                            <select id="SelectPrincipal" name="SelectPrincipal" class="form-control input-sm">
                                                <option value="">All</option>
                                                <?php //echo dropdown_options('principal', 0, false);?>
                                                <?php echo generate_dd($principals,NULL,TRUE,FALSE);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Country:</label>
                                            <select id="SelectCountry" name="SelectCountry" class="form-control input-sm">
                                                <option value="">All</option>
                                                <?php echo generate_dd($countries,NULL,TRUE,FALSE);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Category:</label>
                                            <select id="selectCategory" name="selectCategory" class="form-control input-sm">
                                                <option value="">All</option>
                                                <?php echo generate_dd($categories,NULL,TRUE,FALSE);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Applicant Source:</label>
                                            <select id="selectSource" name="selectSource" class="form-control input-sm">
                                                <option value="">All</option>
                                                <?php echo generate_dd($sources,NULL,TRUE,FALSE);?>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Encoder:</label>
                                            <select id="selectUser" name="selectUser" class="form-control input-sm">
                                                <option value="">All</option>
                                                <?php echo generate_dd($encoders,NULL,TRUE,FALSE);?>
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