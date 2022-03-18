$(function () {
	generate_tab('contacts');
	generate_tab('mr');
	generate_tab('jo');
	
    $(document).bind('reveal.facebox', function() {
        $('#facebox #inputExpDate').datepicker({dateFormat: 'YYYY-MM-DD'});
    });

    /*validate add user form*/
    $('#btn_submit').click(function(e){
    	if($('#textPrincipalCode').val()==''){
    		$('#settings_noticeError').removeClass('hidden');
    		$('#errorMsg_Cont').html('Principal code is required.');
    		$('#textPrincipalCode').focus();
    		return false;
    	}else if($('#textPrincipalName').val()==''){
    		$('#settings_noticeError').removeClass('hidden');
    		$('#errorMsg_Cont').html('Principal name is required.');
    		$('#textPrincipalName').focus();
    		return false;
    	}else{
    		if($('#textRecordId').val() == ''){
    			/*CHECK IF USERNAME EXISTS*/
				$.get(base_url_js+'settings/check_duplicate', {table:'manager_principal', field:'code', value:$('#textPrincipalCode').val()}, function(data) {
					if(data == 1){
	    	    		$('#settings_noticeError').removeClass('hidden');
	    	    		$('#errorMsg_Cont').html('Duplicate record not allowed.');
	    	    		$('#textPrincipalCode').select();
						return false;
					}else{
						$('#frm_add_principal').submit();						
					}
				});
    		}else{
    			$('#frm_add_principal').submit();
    		}
    	}
    });
});

function DeleteFile(what, id){
	var msg = '';
	if(what=='logo'){
		msg = 'principal logo';
	}else if(what=='svc'){
		msg = 'service agreement';
	}else{
		msg = 'recruitment document';
	}
	
	if(confirm('Deleting '+msg+'. Do you want to proceed?')){
		window.location.replace(base_url_js+'settings/delete_file/'+what+'/'+id);
	}
}

function AjaxDeleteFile(what, id){
	var msg = '';
	if(what=='mr'){
		msg = 'JDQ';
	}else{
		msg = 'recruitment document';
	}
	
	if(confirm('Deleting '+msg+'. Do you want to proceed?')){
		$.get(base_url_js+'settings/delete_file/'+what+'/'+id, {}, function(data) {
			if(data){
				$('.mr_current_file').hide();			/*hide file href*/
				$('#fileJDQ').removeClass('hidden');	/*show file input*/

				$('#defaultNoticeContSuccess').html('JDQ Successfully deleted.');
				$("#frm_SuccessNotice").removeClass("hidden");
			}else{
				$('#defaultNoticeContError').html('Unable to delete JDQ.');
				$("#frm_ErrorNotice").removeClass("hidden");
			}
		});
	}
}

function generate_tab(what){
	//current_tab = what;
	var container = '';
	if(what == 'contacts'){
		container = "#tab_contacts";
	}else if(what == 'mr'){
		container = "#tab_mr";
	}else if(what == 'jo'){
		container = "#tab_jo";
	}

	$.get(base_url_js+'settings/ajax_principal_tab', {p_tab:what, p_id:current_principal_id}, function(data) {
		$(container).html(data);
	});
}

function save_contacts(){
	$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");
	$('#textPrincipalId').val(current_principal_id);

	if($('#textFullName').val() == ''){
		$('#defaultNoticeContError').html('Name is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textFullName').focus()
	}else{
		$.post(base_url_js+'settings/save/contacts', $('#frm_facebox').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('Successfully saved.');
				$("#frm_SuccessNotice").removeClass("hidden");

				setTimeout(function(){
					$.facebox.close();
					generate_tab('contacts');
				}, 1000);
			}else{
				$('#defaultNoticeContError').html('Unable to save contacts.');
				$("#frm_ErrorNotice").removeClass("hidden");
			}
		});
	}
}

function save_mr(){
	$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");
	$('#textPrincipalId').val(current_principal_id);
	
	if($('input[class=chkAct]:checked').length == 0){
		$('#defaultNoticeContError').html('Activity is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
	}else if($('#selectRS').val() == ''){
		$('#defaultNoticeContError').html('RS is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#selectRS').focus()
	}else{
		/*AJAX UPLOAD*/
		var formData = new FormData($('form#frm_facebox_mr')[0]);

		$.ajax({
			url: base_url_js+'settings/save/mr',
			type: 'POST',
			data: formData,
			async: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				obj = JSON.parse(data);
				
				if(obj.status == 'error'){
					$('#defaultNoticeContError').html(obj.msg);
					$("#frm_ErrorNotice").removeClass("hidden");
				}else{
					$('#defaultNoticeContSuccess').html(obj.msg);
					$("#frm_SuccessNotice").removeClass("hidden");

					setTimeout(function(){
						$.facebox.close();
						generate_tab('mr');
					}, 1000);
				}
			}
		});
	}
}

function save_jo(){
	$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");
	$('#textPrincipalId').val(current_principal_id);
	
	if($('#textPosition').val() == ''){
		$('#defaultNoticeContError').html('Position is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textPosition').focus();
	}else if($('#selectMR').val() == ''){
		$('#defaultNoticeContError').html('MR is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#selectMR').focus();
	}else{
		$.post(base_url_js+'settings/save/jo', $('#frm_facebox_jo').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('Successfully saved.');
				$("#frm_SuccessNotice").removeClass("hidden");

				setTimeout(function(){
					$.facebox.close();
					generate_tab('jo');
				}, 1000);
			}else{
				$('#defaultNoticeContError').html('Unable to save Job Opening.');
				$("#frm_ErrorNotice").removeClass("hidden");
			}
		});
	}
}

function settingsAjaxDelete(tbl, id){
	var msg = "";
	var msg_error = "";
	var tab_notice = "";
	var tab_notice_cont = "";
	var tab_to_gen = "";

	if(tbl == 'manager_principal_contacts'){
		msg = 'Deleting principal contact. ';
		tab_notice = "#tabNoticeContError";
		tab_notice_cont = "#tab_ErrorNotice";
		tab_to_gen = "contacts";
		msg_error = "Unable to delete contact.";
	}else if(tbl == 'manager_mr'){
		msg = 'Deleting MR data. the ff will also be deleted:\n -Job Openings\n -Uploaded files/documents\n\n ';
		tab_notice = "#mr_tabNoticeContError";
		tab_notice_cont = "#mr_tab_ErrorNotice";
		tab_to_gen = "mr";
		msg_error = "Unable to delete MR.";
	}else if(tbl == 'manager_jobs'){
		msg = 'Deleting jobs data. ';
		tab_notice = "#jobs_tabNoticeContError";
		tab_notice_cont = "#jobs_tab_ErrorNotice";
		tab_to_gen = "jo";
		msg_error = "Unable to delete record.";
	}

	if(confirm(msg + 'Do you want to proceed?')){
		$.get(base_url_js+'settings/ajax_delete', {table:tbl, rec_id:id, principal_id:current_principal_id}, function(data) {
			if(!data){
				$(tab_notice).html(msg_error);
				$(tab_notice_cont).removeClass("hidden");
				
				setTimeout(function(){
					generate_tab(tab_to_gen);
				}, 2000);
			}else{
				generate_tab(tab_to_gen);
				
				/*refresh JOBS tab*/
				if(tbl == 'manager_mr'){
					generate_tab('jo');					
				}
			}
		});
	}
}


function generateDropdown(w, select_id, cur_val){
	$.get(base_url_js+'settings/ajax_dd', {what:w, principal_id:current_principal_id, selected_val:cur_val}, function(data) {
		if(data){
			$(select_id).append(data);
		}
	});
}