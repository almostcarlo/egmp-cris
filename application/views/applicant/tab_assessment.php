<?php
    //$nature_list = get_items_from_cache('nature');
    //var_dump($applicant_data['assessment']);
?>
<div id="assessment" class="tab-pane active">
    
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            
            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/assessment/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add New Assessment</a>
            <h2 class="panel-title">General Assessment</h2>
        </header>
        <div class="panel-body">
        
        	<?php if($applicant_data['assessment']):?>
        		<?php foreach ($applicant_data['assessment'] as $info):?>
                    <div class="alert alert-default alert-nobg">
                        <!-- <button type="button" class="delete" data-dismiss="alert" aria-hidden="true"><i class="fa fa-trash-o"></i></button> -->
                        <?php if(in_array(4, $_SESSION['rs_user']['delete_access'])):?>
                        	<!-- <a href="javascript:void(0);" onclick="delete_record('assessment', '<?php echo $info['id'];?>')" class="delete" data-dismiss="alert" aria-hidden="true"><i class="fa fa-trash-o"></i></a>-->
                        	<button type="button" onclick="delete_record('assessment', '<?php echo $info['id'];?>')" class="delete" data-dismiss="" aria-hidden="true"><i class="fa fa-trash-o"></i></button>
                        <?php endif;?>
                        <a href="<?php echo BASE_URL;?>pqd/assessment/<?php echo $info['id'];?>" target="_blank" type="button" class="print"><i class="fa fa-print"></i></a>
                        <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/assessment/<?php echo $applicant_id;?>/<?php echo $info['id'];?>'});" class="edit"><i class="fa fa-pencil"></i></a>
                        <div class="row">
                            <p class="col-md-12" style="margin-bottom:0;"><strong>Assessment Details:</strong><br /><?php echo nl2br($info['details']);?></p>
                        </div>
                        <br>
                        <div class="row">
                            <p class="col-md-6" style="margin-bottom:0;"><strong>Recommended Position:</strong> <?php echo $info['position'];?></p>
                            <p class="col-md-6" style="margin-bottom:0;"><strong>Nature of Project Experience:</strong> <?php echo ($info['nature_id']<>0)?$nature_list[$info['nature_id']]:"N/A";?></p>
                        </div>
                        <div class="row">
                            <p class="col-md-6" style="margin-bottom:0;"><strong>Date:</strong> <?php echo dateformat($info['add_date'],3);?></p>
                            <p class="col-md-6" style="margin-bottom:0;"><strong>Assesor:</strong> <?php echo $info['add_by'];?></p>
                        </div>
                    </div>
        		<?php endforeach;?>
            <?php else:?>
                <small class="required">no record found.</small>
        	<?php endif;?>

        </div>
    </section>  
</div>