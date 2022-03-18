<?php
// unset($doc_type['iprs picture']);
unset($doc_type['profile_pic']);
unset($doc_type['portal_pic']);
$current_tab = urldecode($current_tab);
// var_dump($all_docs);
// exit();
?>
<section role="main" class="content-body">
                  
	<header class="page-header">
		<h2>Document Library</h2>
	</header>

	<div class="row">
		<!-- APPLICANT INFORMATION -->
		<?php include APPPATH.'views/parts/applicant_information.php';?>

		<div class="col-md-12">
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">Document History</h2>
                </header>
                <div class="panel-body">
                    <table class="table table-striped table-condensed table-hover">
                        <thead>
                            <tr>
                                <th width="20%">Document Name</th>
                                <th width="20%">Attachment</th>
                                <th class="text-center" width="10%">Received Date</th>
                                <th class="text-center" width="10%">Released Date</th>
                                <th class="text-center" width="10%">Expiry Date</th>
                                <th width="25%">Remarks</th>
                                <th class="text-center" width="5%">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                    		<?php if($all_docs):?>
                    			<?php foreach($all_docs as $doc_info):?>
                    				<tr>
                    					<td><?php echo $doc_info['description'];?></td>
                    					<td>
                    						<?php if($doc_info['from_portal'] == 'Y' && !file_exists($doc_info['filename'])):?>
                    							<?php echo $doc_info['filename'];?>
                    						<?php else:?>
                    							<a href="<?php echo BASE_URL."applicant/my_files/".base64_encode($doc_info['id']);?>" target="_blank"><?php echo $doc_info['filename'];?></a>
                    						<?php endif;?>
                    					</td>
                    					<td class="text-center"><?php echo dateformat($doc_info['add_date']);?></td>
                    					<td class="text-center"><?php echo dateformat($doc_info['released_date']);?></td>
                    					<td class="text-center"><?php echo dateformat($doc_info['expiry_date']);?></td>
                    					<td><?php echo $doc_info['remarks'];?></td>
                    					<td class="text-center">
                    						<?php if(!in_array($doc_info['type_id'], array(35,22))):?>
	                    						<?php if($doc_info['from_portal'] == 'Y' && !file_exists($doc_info['filename'])):?>
	                    							<a href="<?php echo BASE_URL;?>download-file/<?php echo base64_encode($doc_info['id']);?>"><i class="fa fa-download" data-toggle="tooltip" data-placement="top" title="Download File from Portal"></i></a>
	                    						<?php else:?>
	                    							<a href="javascript:void(0);" onclick="edit_doc('<?php echo $doc_info['doc_type'];?>',<?php echo $doc_info['id'];?>);" data-toggle="tooltip" data-placement="top" title="Edit Document"><i class="fa fa-pencil"></i></a>
	                    						<?php endif;?>
                    						<?php endif;?>
                    					</td>
                    				</tr>
                    			<?php endforeach;?>
                    		<?php endif;?>
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
		
		<div class="col-md-12">
			<?php flashNotification(); ?>
		</div>

		<div class="col-md-12" id="divFormCont">
			<div class="tabs">
				<ul class="nav nav-tabs tabs-primary">
					<!-- <li class="profile_tab" aria-controls="reported_today"><a href="#reportedtoday" data-toggle="tab">Reported Today</a></li> -->
					<?php foreach ($doc_type as $code => $doc):?>
						<li class="doc_tab <?php echo ($current_tab == $code)?"active":""?>" aria-controls="<?php echo $code;?>" id="li_<?php echo $code;?>">
							<a href="<?php echo $code;?>" data-toggle="tab"><?php echo ucwords(strtolower($doc['desc']));?></a>
						</li>
					<?php endforeach;?>
				</ul>
				<div class="tab-content">
                    
                </div>
            </div>
		</div>
	</div>
</section>

<script>
	var applicant_id = '<?php echo $applicant_data['personal']->id;?>';
	var current_tab = '<?php echo $current_tab;?>';
</script>