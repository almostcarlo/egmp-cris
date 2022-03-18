<?php
    if($this->router->fetch_method() != 'printReport'){
?>
<section role="main" class="content-body">
                    
	<header class="page-header">
		<h2>For Encoding</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-12">
            
			<section class="panel">
                <header class="panel-heading">
                	<a href="<?php echo BASE_URL;?>reception/printReport/for_encoding" target="_blank" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-file"></i> Print</a>
					<h3 class="panel-title">For Encoding</h3>
					
				</header>
				<div class="panel-body">
<?php
    }else{
?>
		<h3>For Encoding</h3>
		<strong>as of: <?php echo dateformat("today", 1);?></strong><br>
		<strong>Total No. of Applicants: <?php echo count($list);?></strong>
<?php
    }
?>
					<?php if($list):?>
                            <table class="table table-bordered" cellspacing="0" style="margin-bottom: 10px;">
                                <tbody>
                                    <tr>
                                        <td width="2%" class="text-left"><strong>#</strong></td>
                                        <td width="19%" class="text-left"><strong>Name</strong></td>
                                        <td width="5%" class="text-center"><strong>Age</strong></td>
                                        <td width="15%" class="text-left"><strong>Preferred Position</strong></td>
                                        <td width="19%" class="text-left"><strong>Job Opening Applied</strong></td>
                                        <td width="10%" class="text-center"><strong>Method of Application</strong></td>
                                        <td width="10%" class="text-center"><strong>Source of Application</strong></td>
                                        <td width="5%" class="text-center"><strong>Status</strong></td>
                                        <td width="10%" class="text-center"><strong>Apply Date</strong></td>
                                        <td width="5%" class="text-center"><strong>Days Delayed</strong></td>
                                    </tr>
                                    <?php $i = 0;?>
                                    <?php foreach ($list as $info):?>
                                    	<tr>
                                            <td><?php echo $i+=1;?>.</td>
                                    		<td>
                                    			<?php if($this->router->fetch_method() != 'printReport'):?>
                                    				<a href="<?php echo BASE_URL."profile/".$info['id']."/personal";?>" target="_blank"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'], 1)?></a>
                                    			<?php else:?>
                                    				<?php echo nameformat($info['fname'], $info['mname'], $info['lname'], 1)?>
                                    			<?php endif;?>
                                			</td>
                                    		<td class="text-center"><?php echo getage($info['birthdate']);?></td>
                                    		<td class="text-left"><?php echo $info['applied_pos'];?></td>
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
                                    		<td class="text-center"><?php echo $info['application_method'];?></td>
                                    		<td class="text-center"><?php echo $info['application_source'];?></td>
                                    		<td class="text-center"><?php echo $info['status'];?></td>
                                    		<td class="text-center"><?php echo dateformat($info['add_date'],1);?></td>
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