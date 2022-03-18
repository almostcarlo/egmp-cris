<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Lineup List</h2>
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
                    <table class="table table-striped table-condensed table-hover mb-none" id="datatable_lineup_web">
                        <thead>
                            <tr>
                                <td class="text-left"><strong>#</strong></td>
                                <td width="10%" class="text-left"><strong>Name</strong></td>
                                <td class="text-center"><strong>Mobile No.</strong></td>
                                <td class="text-center"><strong>Status</strong></td>
                                <td class="text-left"><strong>Principal</strong></td>
                                <td class="text-left"><strong>MR Reference</strong></td>
                                <td class="text-left"><strong>Position</strong></td>
                                <td class="text-center"><strong>Interview Date</strong></td>
                                <!-- <td width="16%" class="text-left"><strong>Internal Advisory</strong></td>
                                <td width="16%" class="text-left"><strong>Applicant Advisory</strong></td> -->
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
                                    
                                    // if(array_key_exists($v['applicant_id'],$all_adv)){
                                    //     if(array_key_exists('internal',$all_adv[$v['applicant_id']])){
                                    //         $adv_i = reset($all_adv[$v['applicant_id']]['internal']);
                                    //         $int_adv = "<i>".dateformat($adv_i['add_date'],1)." ".$adv_i['add_by']."</i>: ".$adv_i['message'];
                                    //     }
                                    // }
                                    
                                    // if(array_key_exists($v['applicant_id'],$all_adv)){
                                    //     if(array_key_exists('applicant',$all_adv[$v['applicant_id']])){
                                    //         $adv_a = reset($all_adv[$v['applicant_id']]['applicant']);
                                    //         $app_adv = "<i>".dateformat($adv_a['add_date'],1)." ".$adv_a['add_by']."</i>: ".$adv_a['message'];
                                    //     }
                                    // }
?>
                                    <tr>
                                        <td class="text-left"><?php echo $n;?>.</td>
                                        <td class="text-left"><?php echo nameformat($v['fname'], $v['mname'], $v['lname'],1);?></td>
                                        <td class="text-center"><?php echo $v['mobile_no'];?></td>
                                        <td class="text-center"><?php echo $v['app_status'];?></td>
                                        <td class="text-left"><?php echo strtoupper($v['principal']);?></td>
                                        <td class="text-left"><?php echo $v['mr_ref'];?></td>
                                        <td class="text-left"><?php echo strtoupper($v['position']);?></td>
                                        <td class="text-center"><?php echo dateformat($v['interview_date'],5);?></td>
                                        <!-- <td class="text-left"><?php echo $int_adv;?></td>
                                        <td class="text-left"><?php echo $app_adv;?></td> -->
                                        <td class="text-center">
                                            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'recruitment/facebox/form_stat_changer?lineup_id=<?php echo $v['id'];?>'});" data-toggle="tooltip" data-placement="top" title="confirm Interview Schedule" data-original-title=""><i class="fa fa-pencil"></i></a>

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

        <!-- WEBSITE APPLICANT -->
        <?php /*if($list_online && count($list_online) > 0):?>
            <div class="col-md-12">
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="panel-title">List of Applicants - Applied thru Portal</h3>
                    </header>
                    <div class="panel-body">
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_lineup">
                            <thead>
                                <tr>
                                    <td class="text-left"><strong>#</strong></td>
                                    <td width="10%" class="text-left"><strong>Name</strong></td>
                                    <td class="text-center"><strong>Mobile No.</strong></td>
                                    <td class="text-center"><strong>Status</strong></td>
                                    <td class="text-left"><strong>Principal</strong></td>
                                    <td class="text-left"><strong>MR Reference</strong></td>
                                    <td class="text-left"><strong>Position</strong></td>
                                    <td class="text-center"><strong>Interview Date</strong></td>
                                    <td class="text-center"><strong>Action</strong></td>
                                </tr>
                            </thead>
                            <tbody>
<?php
                                $n = 1;
                                foreach($list_online as $v){
?>
                                    <tr>
                                        <td class="text-left"><?php echo $n;?>.</td>
                                        <td class="text-left"><?php echo nameformat($v['fname'], $v['mname'], $v['lname'],1);?></td>
                                        <td class="text-center"><?php echo $v['mobile_no'];?></td>
                                        <td class="text-center"><?php echo $v['app_status'];?></td>
                                        <td class="text-left"><?php echo strtoupper($v['principal']);?></td>
                                        <td class="text-left"><?php echo $v['mr_ref'];?></td>
                                        <td class="text-left"><?php echo strtoupper($v['position']);?></td>
                                        <td class="text-center"><?php echo dateformat($v['interview_date'],5);?></td>
                                        <td class="text-center">
                                            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'recruitment/facebox/form_stat_changer?lineup_id=<?php echo $v['id'];?>'});" data-toggle="tooltip" data-placement="top" title="confirm Interview Schedule" data-original-title=""><i class="fa fa-pencil"></i></a>

                                            <a href="<?php echo BASE_URL;?>profile/<?php echo $v['applicant_id'];?>/lineup" target="_blank" data-toggle="tooltip" data-placement="top" title="go to Lineup History" data-original-title=""><i class="fa fa-file"></i></a>
                                        </td>
                                    </tr>
<?php
                                    $n++;
                                }
?>
                            </tbody>
                        </table>
                    </div>
                </section>
            </div>
        <?php endif;*/?>
    </div>
	<!-- end: page -->
</section>
<script>
    // function  get_mr(prin_id){
    //     $("#selectMR").empty().append('<option value="">All</option>');
    //     if(mr_id != ''){
    //         $.get(base_url_js+'reports_recruitment/ajax/get_mr', {id:prin_id}, function(data) {
    //             $("#selectMR").empty().append(data)
    //         });
    //     }
    // }
</script>