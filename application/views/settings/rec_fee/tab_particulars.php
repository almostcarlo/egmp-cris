<div id="reportedtoday" class="tab-pane active">
    
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/rec_fee_particulars?recfee_id=<?php echo $data[0]['recfee_id'];?>&label_id=<?php echo $data[0]['id'];?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Particulars</a>
            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/rec_fee_label/<?php echo $data[0]['id'];?>/?id=<?php echo $data[0]['recfee_id'];?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px; margin-right: 5px;"><i class="fa fa-pencil"></i> Edit</a>
            <h2 class="panel-title"><?php echo $data[0]['title']?> - <?php echo ($data[0]['pos_id']<>0)?$data[0]['position']:"All Categories";?></h2>
            
        </header>
        <div class="panel-body">
            <div class="alert alert-default alert-nobg">
                <div class="row">
                    <!-- <p class="col-md-12" style="margin-bottom:0;"><strong>Service Fee:</strong><br /><?php echo nl2br($info['details']);?></p> -->
                    <p class="col-md-5" style="margin-bottom:0;"><strong>Service Fee:</strong> <?php echo $data[0]['service_fee'];?></p>
                    <p class="col-md-5" style="margin-bottom:0;"><strong>Insurance Fee:</strong> <?php echo $data[0]['insurance_fee'];?></p>
                </div>
                <div class="row">
                    <p class="col-md-5" style="margin-bottom:0;"><strong>Placement Fee:</strong> <?php echo $data[0]['placement_fee'];?></p>
                    <p class="col-md-5" style="margin-bottom:0;"><strong>Processing Fee:</strong> <?php echo $data[0]['processing_fee'];?></p>
                </div>
                <div class="row">
                    <p class="col-md-5" style="margin-bottom:0;"><strong>Salary Deduction:</strong> <?php echo $data[0]['salary_deduction'];?></p>
                    <p class="col-md-5" style="margin-bottom:0;"><strong>Ticket Condition:</strong> <?php echo $data[0]['ticket_condition'];?></p>
                </div>
                <div class="row">
                    <p class="col-md-10" style="margin-bottom:0;"><strong>Term of Payment for the Service:</strong> <?php echo nl2br($data[0]['terms']);?></p>
                </div>
                <div class="row">
                    <p class="col-md-10" style="margin-bottom:0;"><strong>Remarks:</strong> <?php echo nl2br($data[0]['remarks']);?></p>
                </div>
            </div>


            <table class="table table-striped table-condensed table-hover">
                <thead>
                    <tr>
                        <th width="25%">Particulars</th>
                        <th width="10%">Charge To</th>
                        <th class="text-right" style="padding-right:5%;" width="10%">Amount</th>
                        <th width="30%">Remarks</th>
                        <th class="text-center" width="10%">Date</th>
                        <th class="text-center" width="10%">Added By</th>
                        <th class="text-center" width="5%">Action</th>
                    </tr>
                </thead>
                <tbody>
            		<?php if($particulars):?>
                        <?php foreach($particulars as $p_k => $p_v):?>
                            <tr>
                                <td><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/rec_fee_particulars/<?php echo $p_v['id'];?>?recfee_id=<?php echo $data[0]['recfee_id'];?>&label_id=<?php echo $data[0]['id'];?>'});"><?php echo $p_v['particular_desc']?></a></td>
                                <td><?php echo $p_v['charge_to']?></td>
                                <td class="text-right" style="padding-right:5%;"><?php echo $p_v['amount']?></td>
                                <td><?php echo $p_v['remarks']?></td>
                                <td class="text-center"><?php echo dateformat($p_v['add_date'],3);?></td>
                                <td class="text-center"><?php echo $p_v['add_by']?></td>
                                <td class="text-center">
                                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/rec_fee_particulars/<?php echo $p_v['id'];?>?recfee_id=<?php echo $data[0]['recfee_id'];?>&label_id=<?php echo $data[0]['id'];?>'});" data-toggle="tooltip" data-placement="top" title="edit particular" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                        <a href="javascript:void(0);" onclick="delete_record('settings_recfee_dtl','<?php echo $p_v['id'];?>')" data-toggle="tooltip"  data-placement="top" title="delete particular" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                </td>
                            </tr>
                        <?php endforeach;?>
                    <?php else:?>
                        <tr>
                            <td colspan="7" class="text-center">No record found</td>
                        </tr>
                    <?php endif;?>
                </tbody>
            </table>
        </div>
    </section>
    
</div>