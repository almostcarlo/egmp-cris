<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Reports - Operations</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-4">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">Daily Cash Collection Report</h3>
				</header>
				<div class="panel-body">

                    <?php echo form_open('reports_operations/print_report/daily_cash', 'id="frm_daily" target="_blank"');?>

                        <div class="row">
                            <div class="col-md-12">

                                <div class="row">
                                    <div class="col-md-6 mt-sm">
                                        <div class="form-group">
                                            <label for="">Payment Date from:</label>
                                            <div class="input-group">
                                                <span class="input-group-addon">
                                                    <i class="fa fa-calendar"></i>
                                                </span>
                                                <input id="textStDate" name="textStDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat("today",2);?>">
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
                                                <input id="textEnDate" name="textEnDate" autocomplete="off" type="text" data-plugin-datepicker class="form-control input-sm" value="<?php echo dateformat("today",2);?>">
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
                                            <label for="">Payment Method:</label>
                                            <select id="SelectPayment" name="SelectPayment" class="form-control input-sm">
                                                <option value="">All</option>
                                                <?php echo dropdown_options('payment_method', 0, false);?>
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