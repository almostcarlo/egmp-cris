<div>
    <section class="panel">
        <div class="panel-body">
            
            <div class="row">
                <div class="col-sm-12">
                    <h4 class="modal-title">VISA Allocation - <?php echo $visa_status;?></h4>
                </div>
            </div>

            <table class="table table-striped table-condensed table-hover mb-none" id="datatable_6col">
                <thead>
                    <tr>
                        <th class="text-left">Name</th>
                        <th class="text-center">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($list as $info):?>
                        <tr>
                            <td class="text-left"><a href="<?php echo BASE_URL;?>profile/<?php echo $info['applicant_id'];?>/processing" target="_blank"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'], 1)?></a></td>
                            <td class="text-center"><?php echo $info['status'];?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>

            <hr>

            <div class="row">
                <div class="col-sm-12">
                    <input type="button" class="btn btn-block btn-danger" value="Close" id="" onclick="$.facebox.close();">
                </div>
            </div>
        </div>
    </section>
</div>