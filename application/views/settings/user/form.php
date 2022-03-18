<?php
    if(isset($user_info)){
        $id = $user_info[0]['id'];
        $status = $user_info[0]['is_active'];
        $username = $user_info[0]['username'];
        $name = $user_info[0]['name'];
        $position = $user_info[0]['position'];
        $department= $user_info[0]['department'];
        $title = "Edit";
        $branch_id = $user_info[0]['branch_id'];
    }else{
        $id = "";
        $status = "Y";
        $username = "";
        $name = "";
        $position = "";
        $department= "";
        $title = "Add";
        $branch_id = "";
    }
?>
<section role="main" class="content-body">
                    
	<header class="page-header">
		<h2>Settings - Users</h2>
	</header>

	<!-- start: page -->

	<div class="row">
		<div class="col-md-6">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">User Manager Form - <?php echo $title;?></h3>
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
                    
                    <?php echo form_open('settings/save/user', 'id="frm_add_user"');?>
                    
                    	<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>"> 
                        
                        <div class="row">
                            
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textUserStatus">User Status:</label>
                                    <select id="textUserStatus" name="textUserStatus" class="form-control input-sm">\
                                        <option value="Y" <?php echo ($status=='Y')?"selected=\"selected\"":""?>>Active</option>
                                        <option value="N" <?php echo ($status=='N')?"selected=\"selected\"":""?>>Not Active</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group" id="divUsername">
                                    <label for="textUserName">User Name:</label>
                                    <input type="text" id="textUserName" name="textUserName" value="<?php echo $username;?>" <?php echo ($id)?"readonly=\"readonly\"":""?> autocomplete="off" class="form-control input-sm" />
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-4">
                                <div class="form-group">
                                    <label for="textName">Complete Name:</label>
                                    <input type="text" id="textName" name="textName" value="<?php echo $name;?>" class="form-control input-sm" />
                                </div>
                            </div>
                            
                            
                            
                        </div>
                        
                        <div class="row">
							<div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textPosition">Position:</label>
                                    <input type="text" id="textPosition" name="textPosition" value="<?php echo $position;?>" class="form-control input-sm" />
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-4">
                                <div class="form-group">
                                    <label for="textDepartment">Department:</label>
                                    <input type="text" id="textDepartment" name="textDepartment" value="<?php echo $department;?>" class="form-control input-sm" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textPosition">Branch:</label>
                                    <select id="selectBranch" name="selectBranch" class="form-control input-sm">\
                                        <?php echo dropdown_options('branch', $branch_id);?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        
                        <hr />
                        
                        <div class="row">
                            
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textPassword">Password:</label>
                                    <input type="password" id="textPassword" name="textPassword" class="form-control input-sm" />
                                </div>
                            </div>
                            
                            <div class="col-md-6 col-sm-3">
                                <div class="form-group">
                                    <label for="textConfirmPassword">Confirm Password:</label>
                                    <input type="password" id="textConfirmPassword" class="form-control input-sm" />
                                </div>
                            </div>
                            
                        </div>

                        <hr />

                        <div class="row">
                            <div class="col-md-6 col-sm-3">
                                <input type="button" class="btn btn-block btn-primary" value="Submit" id="btn_submit_Userform">
                            </div>
                            <div class="col-md-6 col-sm-3">
                                <a href="<?php echo BASE_URL;?>settings/user" class="btn btn-block btn-danger">Cancel</a>
                            </div>
                        </div>
                                
                        
                    </form>
                    
                </div>
            </section>
            
		</div>
		
		<?php if($id!=''):?>
    		<!-- MENU ACCESS -->
    		<div class="col-md-4">
    			<section class="panel">
                    <header class="panel-heading">
    					<h3 class="panel-title">Menu Access</h3>
    				</header>
    				<div class="panel-body">
    					<?php echo form_open('settings/update_user_access', 'id="frm_user_access"');?>
    						<input type="hidden" id="textRecordId" name="textRecordId" value="<?php echo $id;?>">
    						
                            <div class="row">
                        		<div class="col-md-12 col-sm-3">
                        			<ul id="accordion">
                        				<?php foreach ($menu_list[1][0] as $id1 => $lvl1):?>
                        					<li>
                        						<!-- LEVEL 1 -->
                        						<?php $lvl1_user = explode(",", $lvl1['user_id']);?>
                        						<input type="checkbox" id="Parent<?php echo $id1;?>" name="checkMenu[]" <?php echo (in_array($id,$lvl1_user))?"checked=\"checked\"":""?> value="<?php echo $id1;?>" onclick="$('.Child<?php echo $id1;?>').prop('checked', false);">
                                            	<?php if(array_key_exists($id1,$menu_list[2])):?>
                                                	<a data-toggle="collapse" href="#collapse_<?php echo $id1;?>">
                                                    	<span><strong><?php echo $lvl1['title'];?></strong></span>
                                                	</a>
                                        			<ul id="collapse_<?php echo $id1;?>" class="collapse">
                                        				<?php foreach ($menu_list[2][$id1] as $id2 => $lvl2):?>
                                            				<li>
                                            					<!-- LEVEL 2 -->
                                            					<?php $lvl2_user = explode(",", $lvl2['user_id']);?>
                                            					<input type="checkbox" id="Parent<?php echo $id2;?>" name="checkMenu[]" <?php echo (in_array($id,$lvl2_user))?"checked=\"checked\"":""?> value="<?php echo $id2;?>" onclick="$('#Parent<?php echo $id1;?>').prop('checked', true);" class="Child<?php echo $id1;?>">
                                                            	<span><?php echo $lvl2['title'];?></span>
                                                            	<?php if(array_key_exists($id2,$menu_list[3])):?>
                                                            		<ul id="collapse_<?php echo $id1;?>" class="">
                                                            			<?php foreach ($menu_list[3][$id2] as $id3 => $lvl3):?>
                                                            				<li>
                                                            					<!-- LEVEL 3 -->
                                                            					<?php $lvl3_user = explode(",", $lvl3['user_id']);?>
                                                            					<input type="checkbox" name="checkMenu[]" <?php echo (in_array($id,$lvl3_user))?"checked=\"checked\"":""?> value="<?php echo $id3;?>" onclick="$('#Parent<?php echo $id1;?>,#Parent<?php echo $id2;?>').prop('checked', true);"  class="Child<?php echo $id1;?>">
                                                                            	<span><?php echo $lvl3['title'];?></span>
                                                            				</li>
                                                            			<?php endforeach;?>
                                                            		</ul>
                                                            	<?php endif;?>
                                            				</li>
                                        				<?php endforeach;?>
                                        			</ul>
                                        		<?php else:?>
                                        			<!-- IF NO SUBMENU -->
                                        			<span><strong><?php echo $lvl1['title'];?></strong></span>
                                        		<?php endif;?>
                        					</li>
                        				<?php endforeach;?>
                        			</ul>
        						</div>
                            </div>
                            <hr />
    
                            <div class="row">
                                <div class="col-md-12 col-sm-3">
                                    <input type="submit" class="btn btn-block btn-primary" value="Save" id="">
                                </div>
                            </div>
                        </form>
                    </div>
                </section>
    		</div>
    		<!-- END MENU ACCESS -->
		<?php endif;?>
		
	</div>
	<!-- end: page -->
</section>