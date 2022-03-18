<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Document Monitoring</h2>
	</header>

    <!-- start: page -->
    <div class="row">
        <div class="col-md-4">

            <?php echo form_open('operations/lists/doc_monitoring', 'id="frm_confirmed_lineup"')?>
                <section class="panel">
                    <header class="panel-heading">
                        <h3 class="panel-title">Search by Principal/MR Ref</h3>
                    </header>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12 mt-sm">
                                <div class="form-group">
                                    <label for="">Principal:</label>
                                    <select id="selectPrin" name="selectPrin" onchange="/*get_interview_sched($(this).val());*/" class="form-control input-sm">
                                        <option value="">All</option>
                                        <?php echo generate_dd($pr_list, $_POST['selectPrin'], TRUE, FALSE);?>
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
                                        <?php echo generate_dd($mr_list, $_POST['selectMR'], TRUE, FALSE);?>
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
                    <!-- <a href="<?php echo BASE_URL;?>print/reports/recruitment/project_distribution" target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-file"></i> Print</a> -->
                    <h3 class="panel-title">List of Applicants</h3>
                </header>
                <div class="panel-body">
                    <table class="table table-striped table-condensed table-hover mb-none" id="datatable_doc">
                        <thead>
                            <tr>
                                <td class="text-left"><strong>#</strong></td>
                                <td class="text-left"><strong>Name</strong></td>
                                <td class="text-left"><strong>PEOS</strong></td>
                                <td class="text-left"><strong>EREG</strong></td>
                                <td class="text-left"><strong>PASSPORT</strong></td>
                                <td class="text-left"><strong>NBI</strong></td>
                                <td class="text-left"><strong>Medical</strong></td>
                                <td class="text-left"><strong>OEC</strong></td>
                                <td class="text-left"><strong>VISA Stamp</strong></td>
                                <td class="text-left"><strong>PCR Test</strong></td>
                                <td class="text-left"><strong>School Cred.</strong></td>
                                <td class="text-left"><strong>OMA</strong></td>
                                <td class="text-left"><strong>PROMETRIC</strong></td>
                                <td class="text-left"><strong>DATAFLOW</strong></td>
                            </tr>
                        </thead>
                        <tbody>
<?php
                            if($list){
                                $n = 1;
                                foreach($list as $v){
                                    if($v['visa_stamp']<>'' && $v['visa_stamp']<>'0000-00-00'){
                                        $visa_stamp = $v['visa_stamp'];
                                    }else if($v['nonksa_visa_stamp']<>'' && $v['nonksa_visa_stamp']<>'0000-00-00'){
                                        $visa_stamp = $v['nonksa_visa_stamp'];
                                    }else{
                                        $visa_stamp = "";
                                    }

                                    if($v['college_diploma'] <> ''){
                                        //$school_cred = basename($v['college_diploma']);
                                        $school_cred = "College Diploma";
                                    }else if($v['hs_diploma'] <> ''){
                                        //$school_cred = basename($v['hs_diploma']);
                                        $school_cred = "HS Diploma";
                                    }else{
                                        $school_cred = "";
                                    }
                                    
                                    $ppt_exp = checkExpiry($v['ppt_exp']);
                                    $nbi_exp = checkExpiry($v['nbi_exp']);
?>
                                    <tr>
                                        <td class="text-left"><?php echo $n;?>.</td>
                                        <td class="text-left"><a href="<?php echo BASE_URL?>profile/<?php echo $v['applicant_id'];?>/overview" target="_blank"><?php echo nameformat($v['fname'], $v['mname'], $v['lname'],1);?></a></td>
                                        <td class="text-left"><?php echo $v['peos_serial'];?></td>
                                        <td class="text-left"><?php echo $v['ereg_serial'];?></td>
                                        <td class="text-left" style="color:<?php echo ($ppt_exp=='Expired')?"red":"green";?>"><?php echo dateformat($v['ppt_exp'],2);?></td>
                                        <td class="text-left" style="color:<?php echo ($nbi_exp=='Expired')?"red":"green";?>"><?php echo dateformat($v['nbi_exp'],2);?></td>
                                        <td class="text-left" style="color:<?php echo ($v['med_result']=='unfit')?"red":"green";?>"><?php echo $v['med_result'];?></td>
                                        <td class="text-left"><?php echo $v['rfp_oec_no'];?> <?php echo dateformat($v['rfp_release_date'],2);?></td>
                                        <td class="text-left"><?php echo $visa_stamp;?></td>
                                        <td class="text-left"><?php echo dateformat($v['pcr_testing_date'],2);?></td>
                                        <td class="text-left"><a href="<?php echo BASE_URL?>profile/<?php echo $v['applicant_id'];?>/overview" target="_blank"><?php echo $school_cred;?></a></td>
                                        <td class="text-left"><a href="<?php echo BASE_URL?>profile/<?php echo $v['applicant_id'];?>/overview" target="_blank"><?php echo basename($v['oma_file']);?></a></td>
                                        <td class="text-left"><a href="<?php echo BASE_URL?>profile/<?php echo $v['applicant_id'];?>/overview" target="_blank"><?php echo basename($v['pro_file']);?></a></td>
                                        <td class="text-left"><a href="<?php echo BASE_URL?>profile/<?php echo $v['applicant_id'];?>/overview" target="_blank"><?php echo basename($v['data_file']);?></a></td>
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
<script>
    function  get_interview_sched(mr_id){
        // $("#selectSched").empty().append('<option value="">All</option>');
        // if(mr_id != ''){
        //     $.get(base_url_js+'reports_recruitment/ajax/get_interview_sched', {id:mr_id}, function(data) {
        //         $("#selectSched").empty().append(data)
        //     });
        // }
    }
</script>