<?php
// var_dump($list);
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Processing - Activity</h2>
	</header>

	<!-- start: page -->
	<?php flashNotification();?>

	<div class="row">
		<div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">JO Request</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_jo_req">
                            <thead>
                                <tr>
                                    <th class="text-left">#</th>
                                    <th width="12%" class="text-left">Name</th>
                                    <th width="15%" class="text-left">Principal</th>
                                    <th width="10%" class="text-center">MR Ref.</th>
                                    <th width="15%" class="text-left">Lineup Category</th>
                                    <th width="15%" class="text-left">Applied JO Category</th>
                                    <th class="text-center">Salary</th>
                                    <th class="text-center">Date Requested</th>
                                    <th class="text-center">Date Sent to POEA</th>
                                    <th class="text-center">JO Approved Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $n = 1;
                                    foreach($list as $info){
                                        $salary = ($info['currency_code']<>'')?$info['currency_code']." ".$info['poea_request_sal_amt']."/".$info['poea_request_sal_per']:"";
                                ?>
                                        <tr>
                                            <td class="text-left"><?php echo $n;?>.</td>
                                            <td class="text-left"><a href="<?php echo BASE_URL;?>profile/<?php echo $info['applicant_id'];?>/processing" target="_blank"><?php echo nameformat($info['fname'], $info['mname'], $info['lname'],1);?></a></td>
                                            <td class="text-left"><?php echo $info['principal'];?></td>
                                            <td class="text-center"><?php echo $info['mr_ref'];?></td>
                                            <td class="text-left"><?php echo $info['lineup_cat'];?></td>
                                            <td class="text-left"><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/jo_request/<?php echo $info['id'];?>'});"><?php echo $info['request_cat'];?></a></td>
                                            <td class="text-left"><?php echo $salary;?></td>
                                            <td class="text-center"><?php echo dateformat($info['poea_req_date'],0);?></td>
                                            <td class="text-center"><?php echo dateformat($info['poea_sent_date'],0);?></td>
                                            <td class="text-center"><?php echo dateformat($info['poea_approve_date'],0);?></td>
                                            <td class="text-center">
                                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/jo_request/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                            </td>
                                        </tr>
                                <?php
                                        $n++;
                                    }
                                ?>
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </section>
            
		</div>
	</div>
	<!-- end: page -->
</section>