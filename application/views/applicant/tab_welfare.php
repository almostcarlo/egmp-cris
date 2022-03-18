<div id="welfare" class="tab-pane active">

    <!-- WORK HISTORY -->
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            <!-- PRINT -->
            <?php if($welfare_info):?>
                <a href="<?php echo BASE_URL;?>applicant/print_welfare/<?php echo $applicant_id;?>" target="_blank" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;margin-left: 5px;"><i class="fa fa-print"></i> Print</a>
            <?php endif;?>

            <?php if($welfare_info && trim($welfare_info[0]['status']) == 'ACTIVE'):?>
                <!-- ACTION -->
                <?php if(trim($welfare_info[0]['details']) <> ''):?>
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/welfare/<?php echo $applicant_id;?>/<?php echo $welfare_info[0]['id'];?>?for=action'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;margin-left: 5px;"><i class="fa fa-edit"></i> Action/Remarks</a>
                <?php endif;?>

                <!-- FINAL ACTION -->
                <?php if(trim($welfare_info[0]['action']) <> ''):?>
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/welfare/<?php echo $applicant_id;?>/<?php echo $welfare_info[0]['id'];?>?for=final_action'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;margin-left: 5px;"><i class="fa fa-edit"></i> Final Action</a>
                <?php endif;?>
            <?php endif;?>

                <!-- ADD BTN -->
                <?php if(!$welfare_info):?>
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/welfare/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Case</a>
                <?php endif;?>

            <h2 class="panel-title">Welfare History</h2>
        </header>
        <div class="panel-body">
			<?php if($welfare_info):?>
                <div class="alert alert-default alert-nobg">
                    <!-- EDIT/DELETE -->
                    <?php if(in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('delete_access'))):?>
                        <button type="button" onclick="delete_record('welfare', '<?php echo $welfare_info[0]['id'];?>')" class="delete" data-dismiss="" aria-hidden="true"><i class="fa fa-trash-o"></i></button>
                        <a type="button" class="edit" href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/welfare/<?php echo $applicant_id;?>/<?php echo $welfare_info[0]['id'];?>'});"><i class="fa fa-pencil"></i></a>
                    <?php endif;?>

                    <div class="row">
                        <p class="col-md-9" style="margin-bottom:0;"><strong>Case Details:</strong><br /><?php echo $welfare_info[0]['details'];?><br><br></p>
                        <p class="col-md-3" style="margin-bottom:0;"><strong>Date:</strong> <?php echo dateformat($welfare_info[0]['add_date'],3)?></p>
                    </div>

                    <div class="row">
                        <p class="col-md-6" style="margin-bottom:0;"><strong>Attachments:</strong> <a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($welfare_info[0]['id'])."/applicant_welfare/attachment";?>" target="_blank"><?php echo basename($welfare_info[0]['attachment']);?></a></p>
                    </div>

                    <?php
                        if(trim($welfare_info[0]['action']) <> ''){
                    ?>
                            <hr>

                            <div class="row">
                                <p class="col-md-9" style="margin-bottom:0;"><strong>Action/Remarks:</strong><br />
                    <?php
                            $actions = explode("&&&", $welfare_info[0]['action']);
                            foreach($actions as $i){
                                $d = explode("[|]", $i);
                                $staff = (isset($d[1]))?ucwords($d[1]):"";
                                $this_date = (isset($d[2]))?dateformat($d[2],3):"";
                                echo $d[0]."<br>-<i>".$staff." ".$this_date."</i><br><br>";
                            }
                    ?>
                                </p>
                                <p class="col-md-3" style="margin-bottom:0;"><strong>Date:</strong> <?php echo dateformat($welfare_info[0]['action_date'],3)?></p>
                            </div>
                            <div class="row">
                                <p class="col-md-6" style="margin-bottom:0;"><strong>Attachments:</strong> <a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($welfare_info[0]['id'])."/applicant_welfare/action_attachment";?>" target="_blank"><?php echo basename($welfare_info[0]['action_attachment']);?></a></p>
                            </div>
                    <?php
                        }
                    ?>

                    <?php if(trim($welfare_info[0]['final_action']) <> ''):?>
                        <hr>

                        <div class="row">
                            <p class="col-md-9" style="margin-bottom:0;"><strong>Final Action/Remarks:</strong><br /><?php echo $welfare_info[0]['final_action'];?><br><br></p>
                            <p class="col-md-3" style="margin-bottom:0;"><strong>Date:</strong> <?php echo dateformat($welfare_info[0]['final_action_date'],3)?></p>
                        </div>

                        <div class="row">
                            <p class="col-md-6" style="margin-bottom:0;"><strong>Attachments:</strong> <a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($welfare_info[0]['id'])."/applicant_welfare/final_attachment";?>" target="_blank"><?php echo basename($welfare_info[0]['final_attachment']);?></a></p>
                        </div>
                    <?php endif;?>
                </div>
            <?php else:?>
                <small class="required">no record found.</small>
			<?php endif;?>
            
        </div>
    </section>

</div>