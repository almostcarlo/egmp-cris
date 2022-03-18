<?php //var_dump($applicants)?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Photo Upload</h2>
	</header>

	<!-- start: page -->

	<?php echo form_open('reception/photo_shoot', 'id="frm_search"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearch" class="form-control input-lg" placeholder="Search Applicant (Last name, First name / Email)" autocomplete="off" value="<?php echo $this->input->post('textSearch');?>">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-blue-theme btn-lg" type="submit">Search</button>
            </span>
        </div>
	</form>

	<div class="row">
		<div class="col-md-7">
            
            <section class="panel">
                <header class="panel-heading">
                    <h2 class="panel-title">List of Applicants for Photo Upload</h2>
                </header>
                <div class="panel-body" style="display: block;">
                    <div class="table-responsive">
					
                        <table class="table table-striped table-condensed table-hover mb-none" id="datatable_photoshoot">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Status</th>
                                    <th>Apply Date</th>
                                    <th width="150px" class="text-center">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($applicants as $info):?>
                                    <tr>
                                        <td><a href="javascript:void(0);" onclick="selectThis('<?php echo $info['id'];?>')"><?php echo strtoupper(nameformat($info['fname'], $info['mname'], $info['lname'],1));?></a></td>
                                        <td><?php echo $info['email'];?></td>
                                        <td><?php echo $info['status'];?></td>
                                        <td><?php echo dateformat($info['add_date'],1);?></td>
                                        <td class="actions text-center">
                                            <a href="<?php echo BASE_URL;?>profile/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Profile" target="_blank"><i class="fa fa-eye"></i></a>
                                            <a href="javascript:void(0);" onclick="selectThis('<?php echo $info['id'];?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Upload Photo"><i class="fa fa-camera"></i></a>
                                        </td>
                                    </tr>
                                <?php endforeach;?>
                            </tbody>
                        </table>
                    
                    </div>
                </div>
            </section>
		</div>

		<div class="col-md-5">
            
			<section class="panel">
                <header class="panel-heading">
					<h3 class="panel-title">Applicant Information</h3>
				</header>
				<div class="panel-body">
                    <div class="row" id="divUpload">
                    	<div class="col-md-12">
                    		<small>*Please select from the list of applicants</small>
                    	</div>
                    </div>
                </div>
            </section>

            <!-- TAKE A PHOTO -->
            <section class="panel hidden" id="sectionPhotoshoot">
                <header class="panel-heading">
                    <h3 class="panel-title">Take A Photo</h3>
                </header>
                <div class="panel-body">
                    <div class="col-md-12">
                        <div id="frm_camSuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
                            <strong>SUCCESS!</strong><br>
                            <div id="defaultNoticeContSuccess"><strong><span id="inputRequired"></span></strong>Profile Picture successfully updated.</div>
                        </div>
                    </div>

                    <div class="row" id="">
                        <div class="col-md-12" align="center">
                            <div id="my_camera" style="width:640px; height:480px; background-color:#333333"></div>
                        </div>
                    </div>
                    <div class="row" id="" style="padding-top: 5px;">
                        <div class="col-md-12">
                            <button id="btn_freeze" onclick="freeze();" class="btn btn-block btn-info btn-sm"><i class="fa fa-camera"></i> Capture</button>
                            <button id="btn_unfreeze" onclick="unfreeze();" class="btn btn-block btn-info btn-sm hidden"><i class="fa fa-camera"></i> Take Another</button>
                            <button id="" onclick="save_webcam_image();" class="btn btn-block btn-primary btn-sm"><i class="fa fa-save"></i> Save</button>
                        </div>
                    </div>
                </div>
            </section>
        </div>
	</div>
	<!-- end: page -->
</section>