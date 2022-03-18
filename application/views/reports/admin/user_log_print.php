<h3>User Logs</h3>

<strong>Date Covered: <?php echo dateformat($_POST['textStDate'], 1);?> - <?php echo dateformat($_POST['textEnDate'], 1);?></strong>
<br>

<?php if($list):?>
        <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px; width: 40% !important;">
            <tbody>
                <tr>
                    <td width="40%"><strong>Username</strong></td>
                    <td width="30%" class="text-center"><strong>Action</strong></td>
                    <td width="30%" class="text-center"><strong>Date</strong></td>
                </tr>
                <?php
                    
                    foreach ($list as $id => $info){
                ?>
                	<tr>
                		<td><?php echo $info['add_by'];?></td>
                		<td class="text-center"><?php echo $info['action'];?></td>
                        <td class="text-center"><?php echo dateformat($info['add_date'], 3);?></td>
                	</tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
<?php else:?>
    <p class="danger">No record found</p>
<?php endif;?>