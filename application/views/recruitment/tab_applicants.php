<section class="panel">
    <div class="panel-body">
        <div class="">
    	
            <table class="table table-striped table-condensed table-hover mb-none" id="">
                <thead>
                    <tr>
                        <th width="35%">Name</th>
                        <th width="25%">Position</th>
                        <th width="10%">Status</th>
                        <th width="10%">Apply Date</th>
                        <th width="10%">Interview Status</th>
                        <th width="10%">Acceptance</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($info as $k => $v):?>
                        <tr>
                            <td><a href="<?php echo BASE_URL?>profile/<?php echo $v['applicant_id']?>/lineup" target="_blank"><?php echo nameformat($v['fname'],$v['mname'],$v['lname'],1);?></a></td>
                            <td><?php echo $v['position']?></td>
                            <td><?php echo $v['status']?></td>
                            <td><?php echo dateformat($v['add_date'],1)?></td>
                            <td><?php echo $v['lineup_status']?></td>
                            <td><?php echo $v['lineup_acceptance']?></td>
                        </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        
        </div>
    </div>
</section>