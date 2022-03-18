<?php
    if(isset($info)){
        $id = $info[0]['id'];
        $ip = $info[0]['ip_address'];
    }else{
        $id = "";
        $ip = "";
    }
?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>IP Whitelist</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-12">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">List of Allowed IP Address <a href="<?php echo BASE_URL;?>settings/search/ip-whitelist" class="btn btn-sm btn-info pull-right" style="margin-top:-4px;"><i class="fa fa-angle-left"></i> Back to IP List</a></h3>
				</header>
				<div class="panel-body">
				
					<?php flashNotification();?>
                    
                    <?php echo form_open('settings/save/ip-whitelist', 'id="frm_ip"');?>
                    	<input type="hidden" name="textRecordId" value="<?php echo $id;?>"/>
                        
                       <!-- <input type="text" id="textTitle" name="textTitle" value="<?php //echo $title;?>" class="form-control mb-sm" placeholder="Title Here..."/> -->
                        
                       <textarea id="textIPs" name="textIPs" class="form-control" placeholder="Start typing..."><?php echo $ip;?></textarea>
                       <p>Multiple IP Address must be separated by a comma (,)</p>
                        
                        <hr />

                        <div class="row">
                            <div class="col-sm-3">
                                <input type="submit" value="Save" class="btn btn-block btn-primary">
                            </div>
                            <!-- <div class="col-sm-2">
                                <input type="button" value="Clear" class="btn btn-block btn-default">
                            </div> -->
                        </div>
                        
                    </form>
                    
                </div>
            </section>
            
		</div>
	</div>
	<!-- end: page -->
</section>