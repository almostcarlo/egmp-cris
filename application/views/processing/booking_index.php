<?php
// var_dump($arabic_date);
// var_dump($info);
// exit();
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
                	<a href="<?php echo BASE_URL;?>processing/activity/<?php echo strtolower($info[0]['type']);?>_request" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa"></i> <?php echo $info[0]['type'];?> Request List</a>
                    <h2 class="panel-title"><?php echo $info[0]['type'];?> Booking Request</h2>
                </header>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Request No.:</label>
                                <p><strong><?php echo $info[0]['request_no'];?></strong></p>
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Principal:</label>
                                <p><strong><?php echo $info[0]['principal'];?></strong></p>
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Company:</label>
                                <p><strong><?php echo $info[0]['company'];?></strong></p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Requested By:</label>
                                <p><strong><?php echo $info[0]['request_by'];?></strong></p>
                            </div>
                        </div>
                        
                        <div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Request Date:</label>
                                <p><strong><?php echo dateformat($info[0]['request_date'],1);?></strong></p>
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Proposed Booking Date:</label>
                                <p><strong><?php echo dateformat($info[0]['pr_book_date'],1);?></strong></p>
                            </div>
                        </div>
                        
    					<div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Date Submitted:</label>
                                <p><strong><?php echo dateformat($info[0]['submit_date'],1);?></strong></p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 mt-sm">
                            <div class="form-group">
                                <label for="">Airline:</label>
                                <p><strong><?php echo $info[0]['airline'];?></strong></p>
                            </div>
                        </div>

                        <div class="col-md-9 mt-sm">
                            <div class="form-group">
                                <label for="">Route:</label>
                                <p><strong><?php echo $info[0]['route'];?></strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
		</div>
	</div>

	<div class="row">
		<div class="col-md-12">
            
            <section class="panel">
                <header class="panel-heading">
                    <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'processing/facebox/add_booking_applicant/<?php echo $info[0]['id'];?>'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Applicant</a>
                    <h2 class="panel-title">List of Applicants</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="">
                            <thead>
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Name</th>
                                    <th class="text-center">Proposed Booking Date</th>
                                    <th class="text-center">Booking Date</th>
                                    <th class="text-center">Status</th>
                                    <th class="text-center">Passport No.</th>
                                    <th width="10%" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $n = 1;
                                    if($list){
                                        foreach($list as $i){
                                ?>
                                            <tr>
                                                <td><?php echo $n;?>.</td>
                                                <td><?php echo nameformat($i['fname'],$i['mname'],$i['lname'],1)?></td>
                                                <td class="text-center"><?php echo dateformat($i['pr_book_date'],5);?></td>
                                                <td class="text-center"><?php echo dateformat($i['book_date'],5);?></td>
                                                <td class="text-center"><?php echo $i['status'];?></td>
                                                <td class="text-center"><?php echo $i['ppt_no'];?></td>
                                                <td class="text-center">
                                                    <?php if($i['status'] != 'CONFIRMED' && (in_array(strtolower($_SESSION['rs_user']['username']), $this->config->item('delete_access')) || $_SESSION['rs_user']['username'] == $info[0]['request_by'])):?>
                                                        <a href="javascript:void(0);" onclick="delete_processing('booking_request','<?php echo $i['id'];?>','<?php echo $info[0]['id']?>');" data-toggle="tooltip"  data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                                                    <?php endif;?>
                                                </td>
                                            </tr>
                                <?php
                                            $n++;
                                        }
                                    }else{
                                ?>
                                        <tr>
                                            <td class="text-center" colspan="99">No data available in table.</td>
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