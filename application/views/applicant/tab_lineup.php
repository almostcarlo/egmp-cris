<div id="reportedtoday" class="tab-pane active">
    
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            <?php if($allow_lineup):?>
                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/lineup/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add New Lineup</a>
            <?php endif;?>
            <h2 class="panel-title">Lineup History</h2>
            
        </header>
        <div class="panel-body">
        
        	<!-- <?php if(!$lineup_data):?>
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <strong>No record found.</strong>
                </div>
            <?php endif;?> -->

            
            <?php if($lineup_data):?>
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th width="15%">Position</th>
                            <th width="15%">Principal</th>
                            <?php if(MR_REQUIRED):?><th>MR Ref.</th><?php endif;?>
                            <th class="text-center">Selection Status</th>
                            <th class="text-center">Acceptance</th>
                            <th class="text-center">Select Date</th>
                            <th class="text-center">Approval Date</th>
                            <th class="text-center">Mob Result</th>
                            <th width="20%">Interview Schedule</th>
                            <th width="7%" class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                		<?php foreach ($lineup_data as $info):?>
                            <tr>
                                <td><?php echo $info['position']?></td>
                                <td><?php echo ($info['principal_id']<>'' && array_key_exists($info['principal_id'], $_SESSION['settings']['principal']))?$_SESSION['settings']['principal'][$info['principal_id']]:"N/A";?></td>
                                <?php if(MR_REQUIRED):?><td><?php echo $info['mr_ref']?></td><?php endif;?>
                                <td class="text-center"><?php echo $info['lineup_status']?></td>
                                <td class="text-center"><?php echo $info['lineup_acceptance']?></td>
                                <td class="text-center"><?php echo dateformat($info['select_date'],1)?></td>
                                <td class="text-center"><?php echo dateformat($info['approval_date'],1)?></td>
                                <td class="text-center">
                                    <?php if($applicant_data['personal']->status == 'ACTIVE' && strpos($info['activity'], 'LU') !== false && $info['is_deployed'] != 'Y' && ($info['lineup_status'] != 'Selected' && $info['lineup_acceptance'] != 'Accepted')):?>
                                        <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/interview_sched/<?php echo $applicant_id;?>/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="edit Interview Schedule" data-original-title=""><?php echo $info['mob_result']?></a>
                                    <?php else:?>
                                        <?php echo $info['mob_result']?>
                                    <?php endif;?>
                                </td>
                                <td>
                                    <?php if(strpos($info['activity'], 'LU') !== false):?>
                                        <?php echo dateformat($info['interview_date'],5);?> <?php echo (dateformat($info['interview_date']))?"- ".$info['venue']:"";?>
                                    <?php else:?>
                                        N/A
                                    <?php endif;?>
                                </td>
                                <td class="actions text-center">
                                    <?php if($info['is_deployed'] != 'Y'):?>
                                        <!-- EDIT -->
                                        <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/lineup/<?php echo $applicant_id;?>/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="edit Lineup" data-original-title="Edit"><i class="fa fa-pencil"></i></a>

                                        <!-- ASSESSMENT -->
                                        <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/assessment_l/<?php echo $applicant_id;?>/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="Lineup Assessment" data-original-title="Lineup Assessment"><i class="fa fa-file"></i></a>

                                        <?php if($info['assess_detail']!=''):?>
                                            <a href="<?php echo BASE_URL;?>pqd/assessment_lineup/<?php echo $info['id'];?>" target="_blank" data-toggle="tooltip" data-placement="top" title="print Lineup Assessment" data-original-title="Lineup Assessment"><i class="fa fa-print"></i></a>
                                        <?php endif;?>

                                        <!-- INTERVIEW SCHED -->
                                        <?php if($applicant_data['personal']->status == 'ACTIVE' && strpos($info['activity'], 'LU') !== false && $info['is_deployed'] != 'Y' && ($info['lineup_status'] != 'Selected' && $info['lineup_acceptance'] != 'Accepted')):?>
                                            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/interview_sched/<?php echo $applicant_id;?>/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="edit Interview Schedule" data-original-title=""><i class="fa fa-calendar"></i></a>
                                        <?php endif;?>

                                        <!-- DELETE -->
                                        <?php if(in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('delete_lineup_access')) && $info['is_deployed'] == 'N' && ($info['lineup_status'] != 'Selected' && $info['lineup_acceptance'] != 'Accepted')):?>
                                        	<a href="javascript:void(0);" onclick="delete_record('lineup', '<?php echo $info['id'];?>')" data-toggle="tooltip"  data-placement="top" title="delete Lineup" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                        <?php endif;?>
                                    <?php else:?>
                                        &nbsp;
                                    <?php endif;?>
                                </td>
                            </tr>
                		<?php endforeach;?>
                    </tbody>
                </table>
            <?php else:?>
                <small class="required">no record found.</small>
            <?php endif;?>

            <?php if(!$allow_lineup):?>
                <br>
                <small class="required">*general assessment is required before adding new lineup</small>
            <?php endif;?>
            
        </div>
    </section>
    
</div>