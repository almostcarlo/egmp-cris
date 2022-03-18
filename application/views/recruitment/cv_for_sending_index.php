<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>CV Sending - For Sending</h2>
	</header>

	<!-- start: page -->
    <div class="row">
        <div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <!-- <a href="<?php echo BASE_URL;?>print/reports/recruitment/project_distribution" target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-file"></i> Print</a> -->
                    <h3 class="panel-title">List of Applicants</h3>
                </header>
                <div class="panel-body">
                    <table class="table table-striped table-condensed table-hover mb-none" id="datatable_forsending">
                        <thead>
                            <tr>
                                <td width="3%" class="text-left"><strong>#</strong></td>
                                <td width="25%" class="text-left"><strong>Name</strong></td>
                                <td width="10%" class="text-center"><strong>Status</strong></td>
                                <td width="15%" class="text-left"><strong>MR</strong></td>
                                <td width="27%" class="text-left"><strong>Position</strong></td>
                                <td width="10%" class="text-center"><strong>Date Reviewed</strong></td>
                                <td width="10%" class="text-center"><strong>Days Delayed</strong></td>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            if($list){
                                $n = 1;
                                foreach($list as $v){
?>
                                    <tr>
                                        <td class="text-left"><?php echo $n;?>.</td>
                                        <td class="text-left"><?php echo nameformat($v['fname'], $v['mname'], $v['lname'],1);?></td>
                                        <td class="text-center"><?php echo $v['status'];?></td>
                                        <td class="text-left"><?php echo $v['mr_ref'];?></td>
                                        <td class="text-left"><?php echo $v['position'];?></td>
                                        <td class="text-center"><?php echo dateformat($v['reviewed_date'],1);?></td>
                                        <td class="text-center"><?php echo getDateDiff($v['reviewed_date'], "day");?></td>
                                    </tr>
<?php
                                    $n++;
                                }
                            }
?>
                        </tbody>
                    </table>
                </div>
            </section>
            
        </div>

    </div>
</section>