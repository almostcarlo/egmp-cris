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
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/lpt_request'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create LPT Request</a>
                    <h2 class="panel-title">Booking Request (LPT)</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_6col_search">
                            <thead>
                                <tr>
                                    <th class="text-left">Request No.</th>
                                    <th class="text-left">Principal</th>
                                    <th class="text-center">Requested By</th>
                                    <th class="text-center">Date Requested</th>
                                    <th class="text-center">Propose Booking Date</th>
                                    <th class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach($list as $info){
                                ?>
                                        <tr>
                                            <td class="text-left"><a href="<?php echo BASE_URL;?>processing/search/booking/<?php echo $info['id'];?>"><?php echo $info['request_no'];?></a></td>
                                            <td class="text-left"><?php echo $info['principal'];?> <?php echo ($info['company']<>'')?"- ".$info['company']:"";?></td>
                                            <td class="text-center"><?php echo $info['request_by'];?></td>
                                            <td class="text-center"><?php echo dateformat($info['request_date'],1);?></td>
                                            <td class="text-center"><?php echo dateformat($info['pr_book_date'],1);?></td>
                                            <td class="text-center">
                                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/lpt_request/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>

                                                <?php if(in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('delete_access')) || $_SESSION['rs_user']['username'] == $info['request_by']):?>
                                                    <a href="javascript:void(0);" onclick="delete_processing('lpt_request','<?php echo $info['id'];?>');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                                <?php endif;?>
                                            </td>
                                        </tr>
                                <?php
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