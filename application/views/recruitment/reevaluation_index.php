<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Lineup List - For Re-Evaluation</h2>
	</header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-4">
            <?php echo form_open('recruitment/lists/lineup', 'id="frm_lineup"')?>
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="panel-title">Search by Client/MR</h3>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 mt-sm">
                                <div class="form-group">
                                    <label for="">Principal/Client:</label>
                                    <select id="selectPrincipal" name="selectPrincipal" class="form-control input-sm">
                                        <option value="">All</option>
                                        <?php echo generate_dd($principal_list, '', TRUE, FALSE);?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-sm">
                                <div class="form-group">
                                    <label for="">MR Ref.:</label>
                                    <select id="selectMR" name="selectMR" class="form-control input-sm">
                                        <option value="">All</option>
                                        <?php echo generate_dd($mr_list, '', TRUE, FALSE);?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <hr />
            
                        <div class="row">
                            <div class="col-sm-12">
                                <input type="submit" class="btn btn-block btn-primary" value="Search">
                            </div>
                        </div>
                    </div>
                </section>
            </form>
        </div>

        <div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <h3 class="panel-title">List of Applicants</h3>
                </header>
                <div class="panel-body">
                    <table class="table table-striped table-condensed table-hover mb-none" id="datatable_web_lineup">
                        <thead>
                            <tr>
                                <td class="text-left"><strong>#</strong></td>
                                <td width="10%" class="text-left"><strong>Name</strong></td>
                                <td class="text-center"><strong>Mobile No.</strong></td>
                                <td class="text-center"><strong>Status</strong></td>
                                <td class="text-left"><strong>Principal</strong></td>
                                <td class="text-left"><strong>MR Reference</strong></td>
                                <td class="text-left"><strong>Position</strong></td>
                                <!-- <td class="text-center"><strong>Interview Date</strong></td> -->
                                <td class="text-center"><strong>Action</strong></td>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            if($list){
                                $n = 1;
                                foreach($list as $v){
                                    $int_adv = "";
                                    $app_adv = "";
?>
                                    <tr>
                                        <td class="text-left"><?php echo $n;?>.</td>
                                        <td class="text-left"><?php echo nameformat($v['fname'], $v['mname'], $v['lname'],1);?></td>
                                        <td class="text-center"><?php echo $v['mobile_no'];?></td>
                                        <td class="text-center"><?php echo $v['app_status'];?></td>
                                        <td class="text-left"><?php echo strtoupper($v['principal']);?></td>
                                        <td class="text-left"><?php echo $v['mr_ref'];?></td>
                                        <td class="text-left"><?php echo strtoupper($v['position']);?></td>
                                        <!-- <td class="text-center"><?php echo dateformat($v['interview_date'],5);?></td> -->
                                        <td class="text-center">
                                            <a href="javascript:void(0);" onclick="web_lineup('add', '<?php echo $v['id'];?>');" data-toggle="tooltip" data-placement="top" title="Add to Lineup" data-original-title=""><i class="fa fa-plus"></i></a>

                                            <a href="javascript:void(0);" onclick="web_lineup('del', '<?php echo $v['id'];?>');" data-toggle="tooltip" data-placement="top" title="Remove Lineup" data-original-title=""><i class="fa fa-trash-o"></i></a>
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