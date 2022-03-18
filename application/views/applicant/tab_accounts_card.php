<div id="reportedtoday" class="tab-pane active">
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            <?php if(in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('accounts_card_access')) && !in_array($applicant_data['personal']->status, array('DEADFILE','DEPLOYED'))):?>
                <!-- ADD REMARKS -->
                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/accounts_card_rmk/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;margin-left: 5px;"><i class="fa fa-plus"></i> Add Remarks</a>

                <!-- CLEARED BUTTON -->
                <?php if(in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('accounts_clearance_access')) && !dateformat($accounts_hdr[0]['clearance_date'])):?>
                    <a href="<?php echo BASE_URL;?>applicant/update_clearance/<?php echo $applicant_id;?>" onclick="if(confirm('Clearance Date will be updated. Do you want to proceed?')){return true;}else{return false;}" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;margin-left: 5px;"><i class="fa fa-check"></i> Cleared</a>
                <?php endif;?>
            <?php endif;?>

            <?php if((in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('accounts_card_access_deployed')) && in_array($applicant_data['personal']->status, array('DEPLOYED'))) || (in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('accounts_card_access')) && in_array($applicant_data['personal']->status, array('OPERATIONS','SELECTED - ACCEPTED')))):?>
                <!-- ADD BUTTON -->
                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/accounts_card/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;margin-left: 5px;"><i class="fa fa-plus"></i> Add Particulars</a>
            <?php endif;?>

            <a href="<?php echo BASE_URL;?>accounts_card/<?php echo base64_encode($applicant_id);?>" target="_blank" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-print"></i> Print Accounts Card</a>
            <h2 class="panel-title">Accounts Card <?php echo (dateformat($accounts_hdr[0]['clearance_date']))?"- Date Cleared: <strong>".dateformat($accounts_hdr[0]['clearance_date'])."</strong>":"";?></h2>
            <?php if($accounts_hdr[0]['remarks'] <> ''):?>
                <small><?php echo nl2br($accounts_hdr[0]['remarks']);?></small>
            <?php endif;?>
        </header>
        <div class="panel-body">
            <table class="table table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th width="20%">Particulars</th>
                        <th class="text-right" style="padding-right:5%;" width="12%">Amount Paid</th>
                        <th width="10%">Charge To</th>
                        <th width="10%">Payment Method</th>
                        <th width="18%">Reference</th>
                        <th class="text-center" width="15%">Edit Date</th>
                        <th class="text-center" width="15%">Add Date</th>
                        <?php if((in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('accounts_card_access')) && !in_array($applicant_data['personal']->status, array('DEADFILE','DEPLOYED'))) || (in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('accounts_card_access_deployed')) && in_array($applicant_data['personal']->status, array('DEPLOYED')))):?>
                            <th class="text-center" width="5%">Action</th>
                        <?php endif;?>
                    </tr>
                </thead>
                <?php if($accounts_data):?>
                    <tbody>
                		<?php foreach ($accounts_data as $info):?>
                            <?php if($info['id']):?>
                                <tr>
                                    <td><?php echo $info['particular']?></td>
                                    <td class="text-right" style="padding-right:5%;"><?php echo $info['amount']?></td>
                                    <td><?php echo $info['charge_to']?></td>
                                    <td><?php echo $info['payment_method']?></td>
                                    <td><?php echo $info['reference']?></td>
                                    <td class="text-center"><?php echo dateformat($info['edit_date'],6)?> <i><?php echo $info['edit_by']?></i></td>
                                    <td class="text-center"><?php echo dateformat($info['add_date'],6)?> <i><?php echo $info['add_by']?></i></td>
                                    <?php if((in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('accounts_card_access')) && !in_array($applicant_data['personal']->status, array('DEADFILE','DEPLOYED'))) || (in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('accounts_card_access_deployed')) && in_array($applicant_data['personal']->status, array('DEPLOYED')))):?>
                                        <td class="actions text-center">
                                            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/accounts_card/<?php echo $applicant_id;?>/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="edit particular" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            <a href="javascript:void(0);" onclick="delete_record('accounts_card', '<?php echo $info['id'];?>')" data-toggle="tooltip"  data-placement="top" title="delete particular" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    <?php endif;?>
                                </tr>
                            <?php else:?>
                                <tr>
                                    <td colspan="10">
                                        <small class="required">no record found.</small>
                                    </td>
                                </tr>
                            <?php endif;?>
                		<?php endforeach;?>
                    </tbody>
                <?php endif;?>
            </table>
        </div>
    </section>
    
</div>