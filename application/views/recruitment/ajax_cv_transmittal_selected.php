<table class="table table-striped table-condensed table-hover mb-none" id="">
    <thead>
        <tr>
        	<th width="3%"><input type="checkbox" name="" id="" value="" onclick="checkbox_toggle(this.checked);"></th>
            <th width="10%">applicant ID</th>
            <th width="25%">Name</th>
            <th width="13%">MR REF</th>
            <th width="29%">Position</th>
            <th width="10%">cv status</th>
            <th width="10%">date</th>
        </tr>
    </thead>
    <tbody>
<?php
                if(count($app_list)>0){
                    $n = 1;
                    foreach ($app_list as $info){
?>
                        <tr>
                        	<td><input type="checkbox" name="" id="" value="<?php echo $info['cv_stat_id'];?>" class="cv_chk"> <?php echo $n;?>.</td>
                            <td><a href="<?php echo BASE_URL;?>profile/<?php echo $info['applicant_id'];?>/lineup" target="_blank"><?php echo $info['applicant_id'];?></a></td>
                            <td><?php echo strtoupper(nameformat($info['fname'], $info['mname'], $info['lname'], 1));?></td>
                            <td><?php echo $info['mr_ref'];?></td>
                            <td><?php echo $info['position'];?></td>
                            <td><?php echo ($info['cv_stat']=='initial')?"Shortlisted":ucwords($info['cv_stat']);?></td>
                            <td>
                            	<?php
                            	   if($info['cv_stat'] == 'initial'){
                            	       echo dateformat($info['cv_date']);
                            	   }else if($info['cv_stat'] == 'sent'){
                            	       echo dateformat($info['sent_date']);
                            	   }else if($info['cv_stat'] == 'reviewed'){
                            	       echo dateformat($info['reviewed_date']);
                            	   }else if($info['cv_stat'] == 'selected'){
                            	       echo dateformat($info['select_date']);
                            	   }
                            	   
                            	?>
                        	</td>
                        </tr>
            
<?php
                    
                        $n++;
                    }
                }else{
?>
                	<tr>
                		<td class="text-center" colspan="10">No data available in table</td>
                	</tr>
<?php
                }
?>
    </tbody>
</table>