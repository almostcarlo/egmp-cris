<?php if(!$print):?>
<section role="main" class="content-body">
                    
	<header class="page-header">
		<h2>For Endorsement</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-12">
            
			<section class="panel">
                <header class="panel-heading">
                	<a href="<?php echo BASE_URL;?>print/reports/operations/for_endorsement" target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-file"></i> Print</a>
					<h3 class="panel-title">Applicants For Endorsement</h3>
				</header>
				<div class="panel-body">
<?php else:?>
<h3>Applicants For Endorsement</h3>
<?php endif;?>
					<?php if($list):?>
                        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                            <tbody>
                                <tr>
                                	<td width="1%"><strong>#</strong></td>
                                    <td width="12%"><strong>Name</strong></td>
                                    <td width="5%"><strong>MR</strong></td>
                                    <td width="13%"><strong>Principal</strong></td>
                                    <td width="12%"><strong>Position</strong></td>
                                    <td width="5%" class="text-center"><strong>Passport Rec. Date</strong></td>
                                    <td width="5%" class="text-center"><strong>NBI Rec. Date</strong></td>
                                    <td width="5%" class="text-center"><strong>Medical Exam Date</strong></td>
                                    <td width="5%" class="text-center"><strong>Medical Result</strong></td>
                                    <td width="5%" class="text-center"><strong>Select Date</strong></td>
                                    <td width="5%" class="text-center"><strong>Approval Date</strong></td>
                                    <td width="14%"><strong>Internal Advisory</strong></td>
                                    <td width="14%"><strong>Applicant Advisory</strong></td>
                                </tr>
                                <?php
                                	$n = 0;
                                    foreach ($list as $k => $info){
										$int_adv = "";
										$app_adv = "";
                                        $n += 1;
                                        
                                        if(array_key_exists($info['applicant_id'],$all_adv)){
                                            if(array_key_exists('internal',$all_adv[$info['applicant_id']])){
                                                $adv_i = reset($all_adv[$info['applicant_id']]['internal']);
                                                $int_adv = dateformat($adv_i['add_date'],1)." ".$adv_i['add_by'].": ".$adv_i['message'];
                                            }
                                        }
                                        
                                        if(array_key_exists($info['applicant_id'],$all_adv)){
                                            if(array_key_exists('applicant',$all_adv[$info['applicant_id']])){
                                                $adv_a = reset($all_adv[$info['applicant_id']]['applicant']);
                                                $app_adv = dateformat($adv_a['add_date'],1)." ".$adv_a['add_by'].": ".$adv_a['message'];
                                            }
                                        }
                                ?>
                                	<tr>
                                		<td><?php echo $n;?>.</td>
                                		<td>
                                			<?php if(!$print):?>
                                				<a href="<?php echo BASE_URL;?>profile/<?php echo $info['applicant_id'];?>/documents" target="_blank"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'], 1)?></a>
                                			<?php else:?>
                                				<?php echo nameformat($info['fname'], $info['mname'], $info['lname'], 1)?>
                                			<?php endif;?>
                            			</td>
                                		<td><?php echo $info['mr_ref'];?></td>
                                		<td><?php echo $info['principal'];?></td>
                                		<td><?php echo $info['position'];?></td>
                                		<td class="text-center"><?php echo dateformat($info['ppt_rec_date'],0);?></td>
                                		<td class="text-center"><?php echo dateformat($info['nbi_rec_date'],0);?></td>
                                        <td class="text-center"><?php echo dateformat($info['clinic_exam_date'],0);?></td>
                                        <td><?php echo $info['med_result'];?></td>
                                		<td class="text-center"><?php echo dateformat($info['select_date'],0);?></td>
                                		<td class="text-center"><?php echo dateformat($info['approval_date'],0);?></td>
                                		<td><?php echo $int_adv;?></td>
                                		<td><?php echo $app_adv?></td>
                                	</tr>
                            	<?php
                                    }
                            	?>
                            </tbody>
                        </table>
                    <?php else:?>
                        <small>no record found</small>
					<?php endif;?>
<?php if(!$print):?>
                </div>
            </section>
            
		</div>

	</div>
	<!-- end: page -->
</section>
<?php endif;?>