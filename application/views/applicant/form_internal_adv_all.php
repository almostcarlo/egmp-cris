<?php //var_dump($list)?>
<div>
    <section class="panel">
        <div class="panel-body scroll">
            
            <div class="row mb-lg">
                <div class="col-sm-12">
                    <h4 class="modal-title">Internal Advisory</h4>
                </div>
            </div>
            
            <?php foreach ($list as $int_adv_info):?>
                <div class="alert alert-info">
                    <button type="button" onclick="delete_record('internal_adv', '<?php echo $int_adv_info['id'];?>')" class="delete" data-dismiss="alert" aria-hidden="true"><i class="fa fa-trash-o"></i></button>
                    <p><strong><i class="fa fa-calendar"></i> Date: </strong><?php echo dateformat($int_adv_info['add_date'],3);?></p>
                    <p><strong><i class="fa fa-user"></i> User: </strong><?php echo $int_adv_info['add_by'];?></p>
                    <p><strong><i class="fa fa-comment"></i> Advisory: </strong><?php echo $int_adv_info['message'];?></p>
                </div>
            <?php endforeach;?>
            
        </div>
    </section>
</div>