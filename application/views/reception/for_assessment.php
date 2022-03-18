<?php
    if($this->router->fetch_method() != 'printReport'){
?>
<section role="main" class="content-body">
                    
	<header class="page-header">
		<h2>For Assessment</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-12">
            
			<section class="panel">
                <header class="panel-heading">
                	<a href="<?php echo BASE_URL;?>reception/printReport/for_assessment" target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-file"></i> Print</a>
					<h3 class="panel-title">For Assessment</h3>
					
				</header>
				<div class="panel-body">
<?php
    }else{
?>
		<h3>For Assessment</h3>
		<strong>as of: <?php echo dateformat("today", 1);?></strong><br>
		<strong>Total No. of Applicants: <?php echo count($list);?></strong>
<?php
    }
?>
					<?php if($list):?>
                            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                                <tbody>
                                    <tr>
                                        <td width="15%" class="text-center" rowspan="2"><strong>Name</strong></td>
                                        <td width="5%" class="text-center" rowspan="2"><strong>Age</strong></td>
                                        <td width="10%" class="text-center" rowspan="2"><strong>CV Link</strong></td>
                                        <td width="15%" class="text-center" rowspan="2"><strong>Preferred Position</strong></td>
                                        <td width="15%" class="text-center" rowspan="2"><strong>Job Opening Applied</strong></td>
                                        <td width="10%" class="text-center" colspan="3"><strong>Years of Experience</strong></td>
                                        <td width="10%" class="text-center" rowspan="2"><strong>Education</strong></td>
                                        <td width="5%" class="text-center" rowspan="2"><strong>Method of Application</strong></td>
                                        <td width="5%" class="text-center" rowspan="2"><strong>Source of Application</strong></td>
                                        <td width="5%" class="text-center" rowspan="2"><strong>Status</strong></td>
                                        <td width="5%" class="text-center" rowspan="2"><strong>Days Delayed</strong></td>
                                    </tr>
                                    <tr>
                                    	<td class="text-center"><strong>Local</strong></td>
                                    	<td class="text-center"><strong>Abroad</strong></td>
                                    	<td class="text-center"><strong>Total</strong></td>
                                    </tr>
                                    <?php foreach ($list as $info):?>
                                    <?php
                                        $explocal = 0;
                                        $expabroad = 0;
                                        $exptotal = 0;
                                        if(isset($work_info[$info['id']])){
                                            foreach ($work_info[$info['id']] as $val) {
                                                if($val['start_date']!='0000-00-00 00:00:00' && $val['start_date']!='0000-00-00'){
                                                    $start_date = $val['start_date'];
                                                    $end_date = ($val['end_date']!='0000-00-00 00:00:00' && $val['end_date']!='0000-00-00')?$val['end_date']:"today";
                                                    $diff = abs(strtotime($start_date) - strtotime($end_date));
                                                    $years = floor($diff / (365*60*60*24));
                                                    $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                                                    $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                                                    
                                                    if ($val['country_id'] == 161) {
                                                        $explocal = $explocal + $years;
                                                    } else {
                                                        $expabroad = $expabroad + $years;
                                                    }
                                                }
                                            }
                                            $exptotal = $explocal+$expabroad;
                                        }
                                    ?>
                                    	<tr>
                                    		<td>
                                    			<?php if($this->router->fetch_method() != 'printReport'):?>
                                    				<a href="<?php echo BASE_URL."profile/".$info['id']."/assessment";?>" target="_blank"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'], 1)?></a>
                                    			<?php else:?>
                                    				<?php echo nameformat($info['fname'], $info['mname'], $info['lname'], 1)?>
                                    			<?php endif;?>
                                			</td>
                                    		<td class="text-center"><?php echo getage($info['birthdate']);?></td>
                                    		<td class="text-center">
                                    			<?php if($this->router->fetch_method() != 'printReport'):?>
                                    				<a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($info['cv_file_id']);?>" target="_blank"><?php echo $info['cv_file'];?></a>
                                    			<?php else:?>
                                    				<?php echo $info['cv_file'];?>
                                    			<?php endif;?>
                                			</td>
                                    		<td class="text-center"><?php echo $info['applied_pos'];?></td>
                                    		<td class="text-left">
                                    			<?php
                                    			 if(isset($list_lineup[$info['id']])){
                                    			     foreach ($list_lineup[$info['id']] as $l_info){
                                    			         if($l_info['pos'] != ''){
                                    			             echo "<strong>-{$l_info['pos']}</strong> ";
                                    			             
                                    			             if(MR_REQUIRED){
                                    			                 if($l_info['mr'] != ''){
                                    			                     echo "({$l_info['mr']})";
                                    			                 }else if($l_info['principal'] != ''){
                                    			                     echo "({$l_info['principal']})";
                                    			                 }else{
                                    			                     echo "(N/A)";
                                    			                 }
                                    			             }else{
                                    			                 echo "({$l_info['principal']})";
                                    			             }
                                    			             
                                    			             echo "<br>";
                                    			         }
                                    			     }
                                    			 }
                                    			?>
                                			</td>
                                    		<td class="text-center"><?php echo $explocal;?></td>
                                    		<td class="text-center"><?php echo $expabroad;?></td>
                                    		<td class="text-center"><?php echo $exptotal;?></td>
                                    		<td class="text-left">
                                    		<?php
                                    		if(isset($educ_info[$info['id']])){
                                    		    foreach ($educ_info[$info['id']] as $e_id => $e_info){
                                    		        echo "-".$e_info['desc']."<br>";
                                    		    }
                                    		}
                                    		?>
                                    		</td>
                                    		<td class="text-center"><?php echo $info['application_method'];?></td>
                                    		<td class="text-center"><?php echo $info['application_source'];?></td>
                                    		<td class="text-center"><?php echo $info['status'];?></td>
                                    		<td class="text-center"><?php echo getDateDiff($info['add_date'],"day") //date_diff(dateformat($info['add_date'],0),dateformat("today",0));?></td>
                                    	</tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                            <hr>
					<?php endif;?>
<?php
    if($this->router->fetch_method() != 'printReport'){
?>
                </div>
            </section>
            
		</div>

	</div>
	<!-- end: page -->
</section>
<?php
    }
?>