<section class="panel">
    <header class="panel-heading">
        <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/contacts'});" class="btn btn-primary btn-sm pull-right" style="margin-top:-5px;"><i class="fa fa-plus"></i> Add Contact Person</a>
		<h3 class="panel-title">Contact Persons</h3>
	</header>
	<div class="panel-body">
	
        <div id="tab_ErrorNotice" class="alert alert-danger alert-dismissible hidden" role="alert">
            <strong>ERROR!</strong><br>
            <div id="tabNoticeContError"><strong><span id="inputRequired"></span></strong>[error message here]</div>
        </div>
        
    	<div id="tab_SuccessNotice" class="alert alert-success alert-dismissible hidden" role="alert">
            <strong>SUCCESS!</strong><br>
            <div id="tabNoticeContSuccess"><strong><span id="inputRequired"></span></strong>[success message here]</div>
        </div>
        
        <table class="table table-striped table-condensed table-hover">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Designation</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Mobile</th>
                    <th width="150" class="text-center">Action</th>
                </tr>
            </thead>
            <tbody>
            	<?php if($data):?>
            		<?php foreach ($data as $info):?>
                        <tr>
                            <td width="25%"><a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/contacts/<?php echo $info['id'];?>'});"><?php echo ucwords(strtolower($info['name']))?></a></td>
                            <td><?php echo ucwords(strtolower($info['designation']))?></td>
                            <td class="text-center"><?php echo $info['email'];?></td>
                            <td class="text-center"><?php echo $info['mob_no'];?></td>
                            <td class="actions text-center">
                                <a href="javascript:void(0);" onclick="$.facebox({ajax:base_url_js+'settings/facebox/contacts/<?php echo $info['id'];?>'});" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i></a>
                                <a href="javascript:void(0);" onclick="settingsAjaxDelete('manager_principal_contacts', '<?php echo $info['id'];?>')" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash-o"></i></a>
                            </td>
                        </tr>
            		<?php endforeach;?>
				<?php else:?>
					<tr>
						<td>no record found.</td>
					</tr>
            	<?php endif;?>
            </tbody>
        </table>
        
    </div>
</section>