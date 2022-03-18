<table class="table table-striped table-condensed table-hover mb-none" id="datatable_cvtrans_app">
    <thead>
        <tr>
            <th width="10%">ID</th>
            <th width="40%">Name</th>
            <th width="40%">Position</th>
            <th width="10%" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($app_list as $info):?>
            <tr>
                <td><a href="<?php echo BASE_URL;?>profile/<?php echo $info['applicant_id'];?>/lineup" target="_blank"><?php echo $info['applicant_id'];?></a></td>
                <td><?php echo strtoupper(nameformat($info['fname'], $info['mname'], $info['lname'], 1));?></td>
                <td><?php echo $info['position'];?></td>
                <td class="actions text-center">
                	<a href="<?php echo BASE_URL;?>profile/<?php echo $info['applicant_id'];?>/lineup" data-toggle="tooltip" data-placement="top" title="" data-original-title="view profile" target="_blank"><i class="fa fa-eye"></i></a>
                    <a href="javascript:sendtoinitial(1);" data-toggle="tooltip" data-placement="top" title="" data-original-title="add to list"><i class="fa fa-plus"></i></a>
                </td>
            </tr>
        <?php endforeach;?>
    </tbody>
</table>