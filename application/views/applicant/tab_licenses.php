<div id="licenses" class="tab-pane active">

    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            
            <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/training/<?php echo $applicant_id;?>'});" class="btn btn-info btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Data</a>
            <h2 class="panel-title">Trainings / Seminar</h2>
        </header>
        <div class="panel-body">
			<?php if($applicant_data['training']):?>
    			<?php foreach ($applicant_data['training'] as $training_info):?>
                    <div class="alert alert-default alert-nobg">
                        <button type="button" onclick="delete_record('training', '<?php echo $training_info['id'];?>')" class="delete" data-dismiss="alert" aria-hidden="true"><i class="fa fa-trash-o"></i></button>
                        <a type="button" class="edit" href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'applicant/facebox/training/<?php echo $applicant_id;?>/<?php echo $training_info['id'];?>'});"><i class="fa fa-pencil"></i></a>
                        <h5><?php echo $training_info['training_desc']?></h5>
                        <div class="row">
                            <p class="col-md-6" style="margin-bottom:0;"><strong>Training Center:</strong> <?php echo $training_info['training_center']?></p>
                            <p class="col-md-3" style="margin-bottom:0;"><strong>Date:</strong> <?php echo date("M Y", strtotime($training_info['start_date']))?>-<?php echo (dateformat($training_info['end_date']))?date("M Y", strtotime($training_info['end_date'])):"Present"?></p>
                            <p class="col-md-3" style="margin-bottom:0;"><strong>Country:</strong> <?php echo $training_info['country'];?></p>
                        </div>
                    </div>
    			<?php endforeach;?>
            <?php else:?>
                <small class="required">no record found.</small>
    		<?php endif;?>
        </div>
    </section>
</div>