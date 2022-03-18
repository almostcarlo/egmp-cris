$(function () {
    $('#datatable_Search2Col').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 1 } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_Search3Col').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 2 } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_Search4Col').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 3 } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_Search5Col').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 4 } ],
        "info": true,
        "autoWidth": false
    });
    
    $('#datatable_Search6Col').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 5 } ],
        "info": true,
        "autoWidth": false
    });
	
    $('#datatable_SearchUser').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 4 } ],
        "info": true,
        "autoWidth": false
    });
    
    $('#datatable_SearchPosition').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 2 } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_SearchCompany').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 3 } ],
        "info": true,
        "autoWidth": false
    });
    
    /*validate add user form*/
    $('#btn_submit_Userform').click(function(e){
    	if($('#textUserName').val()==''){
    		$('#settings_noticeError').removeClass('hidden');
    		$('#errorMsg_Cont').html('Username is required.');
    		$('#textUserName').focus();
    		return false;
    	}else if($('#textName').val()==''){
    		$('#settings_noticeError').removeClass('hidden');
    		$('#errorMsg_Cont').html('Complete name is required.');
    		$('#textName').focus();
    		return false;
    	}else{
    		if($('#textRecordId').val() == ''){
    			if($('#textPassword').val()==''){
    	    		$('#settings_noticeError').removeClass('hidden');
    	    		$('#errorMsg_Cont').html('Password is required.');
    	    		$('#textPassword').focus();
    	    		return false;
    	    	}else if($('#textConfirmPassword').val()==''){
    	    		$('#settings_noticeError').removeClass('hidden');
    	    		$('#errorMsg_Cont').html('Please confirm your password.');
    	    		$('#textConfirmPassword').focus();
    	    		return false;
    	    	}else if($('#textPassword').val() != $('#textConfirmPassword').val()){
    	    		$('#settings_noticeError').removeClass('hidden');
    	    		$('#errorMsg_Cont').html('Password does not match.');
    	    		$('#textConfirmPassword').focus();
    	    		return false;
    	    	}
    		}else{
    			if($('#textPassword').val() != $('#textConfirmPassword').val()){
    	    		$('#settings_noticeError').removeClass('hidden');
    	    		$('#errorMsg_Cont').html('Password does not match.');
    	    		$('#textConfirmPassword').focus();
    	    		return false;
    	    	}
    		}

    		if($('#textRecordId').val() == ''){
    			/*CHECK IF USERNAME EXISTS*/
				$.get(base_url_js+'settings/check_duplicate', {table:'settings_users', field:'username', value:$('#textUserName').val()}, function(data) {
					if(data == 1){
	    	    		$('#settings_noticeError').removeClass('hidden');
	    	    		$('#errorMsg_Cont').html('Duplicate record not allowed.');
	    	    		$('#textUserName').focus();
						return false;
					}else{
						$('#frm_add_user').submit();						
					}
				});
    		}else{
    			$('#frm_add_user').submit();
    		}
    	}
    });
});

function settingsDelete(tbl, id){
	var msg = 'Record will be permanently deleted. ';
	var url = base_url_js+'settings/delete/'+tbl+'/'+id;
	
	if(tbl == 'settings_users'){
		msg = 'Deleting user #'+id+'. ';
	}else if(tbl == 'manager_principal_contacts'){
		msg = 'Deleting principal contact. ';
		url = base_url_js+'settings/delete/'+tbl+'/'+id+'/'+current_principal_id;
	}else if(tbl == 'manager_principal'){
		msg = 'Deleting principal data. the ff will also be deleted:\n -MR\n -Job Openings\n -Uploaded files/documents\n\n ';
	}

	if(confirm(msg + 'Do you want to proceed?')){
		window.location.replace(url);
	}
}