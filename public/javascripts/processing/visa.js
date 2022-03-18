$(function () {
	//$('#textValidity').datepicker({dateFormat: 'dd/mm/yy'});

//	generate_tab(current_tab);
//
//	$('.doc_tab').click(function(){
//		generate_tab($(this).attr('aria-controls'));
//	});
	
    $('#datatable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 4 } ],
        "info": true,
        "autoWidth": false
    });
	
	$('#btn_submit').click(function(){
		$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");
		
		if($('#textVISANo').val() == ''){
			$('#defaultNoticeContError').html('VISA No. is required.');
			$("#frm_ErrorNotice").removeClass("hidden");
			$('#textVISANo').focus();
		}else if($('#SelectPrincipal').val() == ''){
			$('#defaultNoticeContError').html('Principal is required.');
			$("#frm_ErrorNotice").removeClass("hidden");
			$('#SelectPrincipal').focus();
		}else{
			$.get(base_url_js+'processing/duplicate/manager_visa/visa_no/'+$('#textVISANo').val(), function(data){
				if($('#textRecordId').val() == '' && data > 0){
					$('#defaultNoticeContError').html('Duplicate VISA No. is not allowed.');
					$("#frm_ErrorNotice").removeClass("hidden");
					$('#textVISANo').focus();
				}else{
					$('#frm_processing').submit();					
				}
			});
		}
	});
});

function save_visa_pos(){
	if($('#textPos').val() == ''){
		$('#defaultNoticeContError_f').html('Position/Category is required.');
		$("#frm_ErrorNotice_f").removeClass("hidden");
		$('#textPos').focus();
	}else if($('#textQty').val() == ''){
		$('#defaultNoticeContError_f').html('Quantity is required.');
		$("#frm_ErrorNotice_f").removeClass("hidden");
		$('#textQty').focus();
	}else{
		$('#frm_visa_pos').submit();
	}
}

function save_visa_allocation(){
	$('#frm_ErrorNotice_f, #frm_SuccessNotice_f').addClass('hidden');

	if($('#selectMRRef').val() == ''){
		$('#frm_ErrorNotice_f').removeClass('hidden');
		$('#defaultNoticeContError_f').html('Please select MR');
	}else if($('#frm_visa_allocation input[type="checkbox"]:checked').length == 0){
		$('#frm_ErrorNotice_f').removeClass('hidden');
		$('#defaultNoticeContError_f').html('Please select applicant');
	}else{
		$('#frm_visa_allocation').submit();
	}
}

//function generate_tab(what){
//	current_tab = what;
//	$.get(base_url_js+'operations/ajax_tab', {tab:what, applicant_id:applicant_id}, function(data) {
//		$('.tab-content').html(data);
//	});
//}
//
//function save_doc(){
//	$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");
//	
//	if($('#textRecDate').val() == ''){
//		$('#defaultNoticeContError').html('Received Date is required.');
//		$("#frm_ErrorNotice").removeClass("hidden");
//		$('#textRecDate').focus();
//	}else if($('#selectRecBy').val() == ''){
//		$('#defaultNoticeContError').html('Received By is required.');
//		$("#frm_ErrorNotice").removeClass("hidden");
//		$('#selectRecBy').focus();
//	}else{
//		$('#frm_doclib').submit();
//	}
//}

//function delete_processing(what, visa_id, pos_id){
//	if(!confirm("Deleting record. Do you want to proceed?")){
//		return false;
//	}else{
//		window.location.replace(base_url_js+'processing/delete/visa_pos/'+visa_id+'/'+pos_id);
//	}
//}