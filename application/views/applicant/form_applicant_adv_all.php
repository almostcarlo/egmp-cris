<div>
    <section class="panel">
        <div class="panel-body scroll">
            
            <div class="row mb-lg">
                <div class="col-sm-12">
                    <h4 class="modal-title">Applicant Advisory</h4>
                </div>
            </div>
            
            <?php foreach ($list as $i):?>
                <div class="alert <?php echo ($i['type']=='sms' && $i['seen']=='N')?"alert-success":"alert-info";?>">
                    <!-- REPLY BUTTON -->
                    <?php if($i['tbl'] == 'inbox'):?>
                        <!-- <button type="button" onclick="" class="edit" data-dismiss="alert" aria-hidden="true"><i class="fa fa-comment-o"></i></button> -->
                    <?php endif;?>

                    <!-- DELETE BUTTON -->
                    <?php if($i['tbl'] == ''):?>
                        <button type="button" onclick="delete_record('applicant_adv', '<?php echo $i['id'];?>')" class="delete" data-dismiss="alert" aria-hidden="true"><i class="fa fa-trash-o"></i></button>
                    <?php endif;?>
                    <p><strong><i class="fa fa-calendar"></i> Date: </strong><?php echo dateformat($i['add_date'],3);?></p>
                    <?php if($i['type']=='applicant' || $i['tbl'] == 'outbox'):?>
                        <p><strong><i class="fa fa-user"></i> User: </strong><?php echo $i['add_by'];?></p>
                    <?php endif;?>

                    <?php if($i['tbl'] == ''):?>
                        <p><strong><i class="fa fa-comment"></i> Advisory: </strong><?php echo $i['message'];?></p>
                    <?php else:?>
                        <p><strong><i class="fa fa-comment"></i> Sms <?php echo $i['tbl'];?>: </strong><?php echo $i['message'];?></p>
                    <?php endif;?>
                    
                </div>
            <?php endforeach;?>
            
        </div>
    </section>
</div>