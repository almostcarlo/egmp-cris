<?php
    if(isset($info)){
        $id = $info[0]['id'];
        $parent = $info[0]['parent_id'];
        $level = $info[0]['level'];
        $menu_title = $info[0]['title'];
        $url = $info[0]['url'];
        $css = $info[0]['css_class'];
        $order_no = $info[0]['order_no'];
        $title = "Edit";
    }else{
        $id = "";
        $parent= "";
        $level= "";
        $menu_title= "";
        $url= "";
        $css= "";
        $order_no = "0";
        $title = "Add";
    }
?>
<section role="main" class="content-body">
                    
	<header class="page-header">
		<h2>Settings - Menu</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-6">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">Menu Manager Form - <?php echo $title;?></h3>
				</header>
				<div class="panel-body">
                    
                	<?php if($this->session->flashdata('settings_notification')):?>
                        <div class="alert alert-<?php echo ($this->session->flashdata('settings_notification_status')=='Error')?"danger":"success";?>">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <strong><?php echo ($this->session->flashdata('settings_notification_status')=='Error')?"Error":"Success"?>!</strong> <?php echo $this->session->flashdata('settings_notification')?>
                        </div>
                	<?php endif;?>
                    
                    <div id="settings_noticeError" class="alert alert-danger hidden">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <div id="errorMsg_Cont"><strong><span id="inputRequired"></span></strong>[error message here]</div>
                    </div>
                    
                    <?php echo form_open('settings/save/menu', 'id="frm_add_menu"');?>
                    
                    	<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>"> 
                        
                        <div class="row">
                            
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="selectLevel">Level:</label>
                                    <select id="selectLevel" name="selectLevel" class="form-control input-sm" onchange="$('.selParent').hide(); $('.selParent').attr('disabled','disabled'); $('#selectParent'+$(this).val()).removeAttr('disabled'); $('#selectParent'+$(this).val()).show();">
                                        <?php if($id=='' || $level=='1'):?><option value="1" <?php echo ($level=='1')?"selected=\"selected\"":""?>>1</option><?php endif;?>
                                        <?php if($id=='' || $level=='2'):?><option value="2" <?php echo ($level=='2')?"selected=\"selected\"":""?>>2</option><?php endif;?>
                                        <?php if($id=='' || $level=='3'):?><option value="3" <?php echo ($level=='3')?"selected=\"selected\"":""?>>3</option><?php endif;?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="selectParent">Parent:</label>
                                    <?php if($level==""):?>
                                        <select id="selectParent1" name="selectParent" class="form-control input-sm selParent">
                                        	<option value="0">N/A</option>
                                        </select>
                                        <select id="selectParent2" name="selectParent" class="form-control input-sm selParent" style="display:none;" disabled="disabled">
                                        	<?php foreach ($menu_per_level[1] as $l1_id => $l1):?>
                                        		<option value="<?php echo $l1_id;?>"><?php echo $l1['title'];?></option>
                                        	<?php endforeach;?>
                                        </select>
                                        <select id="selectParent3" name="selectParent" class="form-control input-sm selParent" style="display:none;" disabled="disabled">
                                        	<?php foreach ($menu_per_level[2] as $l2_id => $l2):?>
                                        		<option value="<?php echo $l2_id;?>"><?php echo $menu_per_level[1][$l2['parent_id']]['title']." > ".$l2['title'];?></option>
                                        	<?php endforeach;?>
                                        </select>
                                    <?php else:?>
                                        <select id="" name="selectParent" class="form-control input-sm">
                                        	<option value="<?php echo $parent;?>"><?php echo ($level==3)?$menu_per_level[1][$menu_per_level[2][$parent]['parent_id']]['title']." > ":"";?><?php echo ($level>1)?$menu_per_level[intval($level-1)][$parent]['title']:"N/A";?></option>
                                        </select>
                                    <?php endif;?>
                                </div>
                            </div>
                            
                        </div>
                        
                        <div class="row">
                            
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group" id="divUsername">
                                    <label for="textUserName">Title:</label>
                                    <input type="text" id="textTitle" name="textTitle" value="<?php echo $menu_title;?>" autocomplete="off" class="form-control input-sm" />
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-4">
                                <div class="form-group">
                                    <label for="textName">URL:</label> <?php echo BASE_URL;?>
                                    <input type="text" id="textURL" name="textURL" value="<?php echo $url;?>" class="form-control input-sm" />
                                </div>
                            </div>
                            
                            
                            
                        </div>
                        
                        <div class="row">
							<div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textPosition">CSS Class:</label>
                                    <input type="text" id="textCSS" name="textCSS" value="<?php echo $css;?>" class="form-control input-sm" />
                                </div>
                            </div>
							<div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textPosition">Order No.:</label>
                                    <input type="text" id="textOrder" name="textOrder" value="<?php echo $order_no;?>" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>


                        <hr />

                        <div class="row">
                            <div class="col-md-6 col-sm-3">
                                <input type="submit" class="btn btn-block btn-primary" value="Submit" id="btn_submit_Userform">
                            </div>
                            <div class="col-md-6 col-sm-3">
                                <a href="<?php echo BASE_URL;?>settings/search/menu" class="btn btn-block btn-danger">Cancel</a>
                            </div>
                        </div>
                                
                        
                    </form>
                    
                </div>
            </section>
            
		</div>
	</div>
	<!-- end: page -->
</section>