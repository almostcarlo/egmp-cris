<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Reports - Operations</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-4">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">Advance Status Report</h3>
				</header>
				<div class="panel-body">

                    <?php echo form_open('reports_operations/print_report/adv_stat_report', 'id="frm_adv_stat" target="_blank"');?>

                        <input type="hidden" name="h_cols" id="h_cols" value="">
                        <input type="hidden" name="h_rows" id="h_rows" value="">

                        <div class="row">
                            <div class="col-md-12">

                                
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">MR Ref:</label>
                                            <select id="SelectMR" name="SelectMR" class="form-control input-sm">
                                                <?php //echo dropdown_options('principal', 0, false);?>
                                                <?php generate_dd($list_mr, 0, TRUE, TRUE);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />

                                <div class="row">
                                    <div class="col-sm-6">
                                        <input type="button" class="btn btn-block btn-primary" value="Create Report" id="btn_submit">
                                    </div>

                                    <div class="col-sm-6">
                                        <input type="button" data-toggle="modal" data-target="#modalReportSettings" class="btn btn-block btn-default" value="Report Settings" id="">
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

<?php include APPPATH.'views\modal\modal-report-settings.php';?>

<script type="text/javascript">
    window.onload = function(){
      $('#btn_submit').click(function(){
        if($('#SelectMR').val() == ''){
            alert('MR Ref. is required.');
        }else{
            $('#frm_adv_stat').submit();
        }
      });
    };

  function checkbox(val, grp, what){
    if(what == 'col'){
        var chkID = "#btnCheck";
        var unchkID = "#btnUncheck";
    }else{
        var chkID = "#btnCheckR";
        var unchkID = "#btnUncheckR";
    }

    if(val == 1){
        $(chkID).addClass('hidden');
        $(unchkID).removeClass('hidden');
        $(grp).prop('checked', true);
    }else{
        $(chkID).removeClass('hidden');
        $(unchkID).addClass('hidden');
        $(grp).prop('checked', false);
    }
  }

  function save_report_settings(){
    var cols = new Array('col_name');
    var rows = new Array();
    $('.chkCol').each(function(){
        if($(this).is(":checked")){
            cols.push($(this).val());
        }
    });

    $('.chkRow').each(function(){
        if($(this).is(":checked")){
            rows.push($(this).val());
        }
    });

    $('#h_cols').val(cols);
    $('#h_rows').val(rows);
    $('#modalReportSettings').modal('hide');
  }
</script>