<?php
    $start_date = dateformat(date("Y-m-")."01",1);
    $end_date = dateformat("today",1);
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Reports</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-4">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">Medical Report</h3>
				</header>
				<div class="panel-body">

                    <?php echo form_open('reports_medical/print_report', 'id="frm_medical" target="_blank"');?>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Medical Exam Start Date:</label>
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
                                            <label for="">End Date:</label>
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
                                            <label for="SelectPrincipal">Principal:</label>
                                            <select id="SelectPrincipal" name="SelectPrincipal" class="form-control input-sm">
                                            	<option value="">All</option>
                                                <?php echo dropdown_options('principal', 0, false);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="SelectClinic">Clinic:</label>
                                            <select id="SelectClinic" name="SelectClinic" class="form-control input-sm">
                                                <option value="">All</option>
                                                <?php echo dropdown_options('clinic', 0, false);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">Report Type:</label>
                                            <select id="SelectType" name="SelectType" class="form-control input-sm">
                                            	<option value="1">Medical Exam Taken - Summary</option>
                                            	<option value="2">Medical Exam Taken - Detailed</option>
                                                <option value="3">Fit and Unfit Summary</option>
                                                <option value="4">Pending Result - Summary</option>
                                                <option value="5">Pending Result - Detailed</option>
                                                <option value="6">Fit Applicants - Detailed</option>
                                                <option value="7">Unfit Applicants - Detailed</option>
                                                <option value="8">Awaiting Result - Detailed</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />

                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-block btn-primary" value="Create Report" id="btn_submit">
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