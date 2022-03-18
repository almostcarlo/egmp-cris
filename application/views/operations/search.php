<?php //var_dump($applicants)?>
<section role="main" class="content-body">
    
	<header class="page-header">
		<h2>Operations - Applicant Search</h2>
	</header>

	<!-- start: page -->

	<?php echo form_open('operations/search?ref='.$_GET['ref'], 'id="frm_search_applicant"');?>
        <div class="input-group mb-md">
            <input type="text" name="textSearchApplicant" class="form-control input-lg" placeholder="Search Applicant (Last name, First name / Email)" autocomplete="off" value="<?php echo $this->input->post('textSearchApplicant');?>">
            <span class="input-group-btn">
                <button class="btn btn-primary btn-blue-theme btn-lg" type="submit">Search</button>
            </span>
        </div>
	</form>

	<?php if(!$applicants):?>
        <div class="alert alert-danger">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
            <strong>Error!</strong> No record found.
        </div>
    <?php endif;?>

	<?php if($applicants):?>
    	<div class="row">
    		<div class="col-md-12">
                
                <section class="panel">
                    <header class="panel-heading">
                        <!-- <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div> -->
                        <!-- <a href="<?php echo BASE_URL;?>applicant/create" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Create New Applicant</a> -->
                        <h2 class="panel-title">Applicant List</h2>
                    </header>
                    <div class="panel-body" style="display: block;">
                        <div class="">
    					
                            <table class="table table-striped table-condensed table-hover mb-none" id="datatable_SearchApplicant">
                                <thead>
                                    <tr>
                                        <th>Full Name</th>
                                        <th>Email</th>
                                        <!-- <th>Birthday</th> -->
                                        <th>Applied Position</th>
                                        <th>Age</th>
                                        <th>Status</th>
                                        <th width="150px" class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($applicants as $info):?>
                                        <tr>
                                            <td><a href="<?php echo $href;?><?php echo $info['id'];?>"><?php echo strtoupper(nameformat($info['fname'], $info['mname'], $info['lname'],1));?></a></td>
                                            <td><?php echo $info['email'];?></td>
                                            <!-- <td><?php echo date("F d, Y", strtotime($info['birthdate']));?></td> -->
                                            <td><?php echo str_replace("|", " / ", $info['position']);?></td>
                                            <td><?php echo $info['age'];?></td>
                                            <td><?php echo $info['status'];?></td>
                                            <td class="actions text-center">
                                                <a href="<?php echo BASE_URL;?>profile/<?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="View Profile"><i class="fa fa-eye"></i></a>
                                                <a href="<?php echo $href;?><?php echo $info['id'];?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Medical Form" target="_blank"><i class="fa fa-folder"></i></a>
                                            </td>
                                        </tr>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        
                        </div>
                    </div>
                </section>
                
    		</div>
    	</div>
	<?php endif;?>
	<!-- end: page -->
</section>