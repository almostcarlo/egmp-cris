<div id="reportedtoday" class="tab-pane active">
    
    <section class="panel panel-featured panel-featured-primary">
        <header class="panel-heading">
            
            <h2 class="panel-title">Deployment History</h2>
            
        </header>
        <div class="panel-body">

            <?php if($lineup_data):?>
                <table class="table table-striped table-condensed table-hover">
                    <thead>
                        <tr>
                            <th>Position</th>
                            <th>Principal</th>
                            <?php if(MR_REQUIRED):?><th>MR Ref.</th><?php endif;?>
                            <th>Deployment Date</th>
                            <th>Contract Period</th>
                            <th>Contract Finished</th>
                        </tr>
                    </thead>
                    <tbody>
                		<?php foreach ($lineup_data as $info):?>
                            <tr>
                                <td><?php echo $info['position']?></td>
                                <td><?php echo (isset($_SESSION['settings']['principal'][$info['principal_id']]))?$_SESSION['settings']['principal'][$info['principal_id']]:"N/A";?></td>
                                <?php if(MR_REQUIRED):?><td><?php echo $info['mr_ref']?></td><?php endif;?>
                                <td><?php echo dateformat($info['deployment_date'],1)?></td>
                                <td><?php echo $info['contract_period']?></td>
                                <td><?php echo dateformat($info['contract_fin_date'],1)?></td>
                            </tr>
                		<?php endforeach;?>
                    </tbody>
                </table>
            <?php else:?>
                <small class="required">no record found.</small>
            <?php endif;?>
            
        </div>
    </section>
    
</div>