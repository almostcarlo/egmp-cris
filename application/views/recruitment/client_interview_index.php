<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Client Interview Updating</h2>
	</header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-4">
            <section class="panel">
                <header class="panel-heading">
                    <h3 class="panel-title">Search by MR</h3>
                </header>
                <div class="panel-body">
                    <?php echo form_open('recruitment/lists/client_interview', 'id="frm_client_interview"');?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-12 mt-sm">
                                        <div class="form-group">
                                            <label for="">MR Reference:</label>
                                            <select id="SelectMR" name="SelectMR" class="form-control input-sm">
                                                <option value="">All</option>
                                                <?php generate_dd($mr_list, $_POST['SelectMR'], TRUE, FALSE);?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                
                                <hr />

                                <div class="row">
                                    <div class="col-sm-12">
                                        <input type="submit" class="btn btn-block btn-primary" value="Search" id="btn_submit">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </section>
        </div>

        <div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <!-- <a href="<?php echo BASE_URL;?>print/reports/recruitment/project_distribution" target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-file"></i> Print</a> -->
                    <h3 class="panel-title">List of Applicants</h3>
                </header>
                <div class="panel-body">
                    <table class="table table-striped table-condensed table-hover mb-none" id="datatable_client_interview">
                        <thead>
                            <tr>
                                <td width="5%" class="text-left"><strong>#</strong></td>
                                <td width="25%" class="text-left"><strong>Name</strong></td>
                                <td width="10%" class="text-center"><strong>Mobile No.</strong></td>
                                <td width="15%" class="text-center"><strong>Status</strong></td>
                                <td width="15%" class="text-left"><strong>MR Reference</strong></td>
                                <td width="20%" class="text-left"><strong>Position</strong></td>
                                <td width="10%" class="text-center"><strong>Action</strong></td>
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
                                        <td class="text-center"><?php echo $v['mobile_no'];?></td>
                                        <td class="text-center"><?php echo $v['app_status'];?></td>
                                        <td class="text-left"><?php echo $v['mr_ref'];?></td>
                                        <td class="text-left"><?php echo $v['position'];?></td>
                                        <td class="text-center">
                                            <!-- <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/interview_sched/<?php echo $v['applicant_id'];?>/<?php echo $v['id'];?>'});" data-toggle="tooltip" data-placement="top" title="confirm Interview Schedule" data-original-title=""><i class="fa fa-pencil"></i></a> -->
                                            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/lineup/<?php echo $v['applicant_id'];?>/<?php echo $v['id'];?>'});" data-toggle="tooltip" data-placement="top" title="edit Lineup" data-original-title="Edit"><i class="fa fa-pencil"></i></a>

                                            <a href="<?php echo BASE_URL;?>profile/<?php echo $v['applicant_id'];?>/lineup" target="_blank" data-toggle="tooltip" data-placement="top" title="go to Lineup History" data-original-title=""><i class="fa fa-file"></i></a>
                                        </td>
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
	<!-- end: page -->
</section>