$(function () {
    $('#datatable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 5 } ],
        "info": true,
        "autoWidth": false
    });
    
    $(document).bind('reveal.facebox', function() {
        $('#facebox #textSubmitDate').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textAppDate').datepicker({dateFormat: 'YYYY-MM-DD'});
    });

	$('#btn_submit').click(function(){
		$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");
		
		if($('#SelectPrincipal').val() == ''){
			$('#defaultNoticeContError').html('Principal is required.');
			$("#frm_ErrorNotice").removeClass("hidden");
			$('#SelectPrincipal').focus();
		}else if($('#textAccreNo').val() == ''){
			$('#defaultNoticeContError').html('Accreditation No. is required.');
			$("#frm_ErrorNotice").removeClass("hidden");
			$('#textAccreNo').focus();
		}else{
			$.get(base_url_js+'processing/duplicate/manager_poea/accre_no/'+$('#textAccreNo').val(), function(data){
				if($('#textRecordId').val() == '' && data > 0){
					$('#defaultNoticeContError').html('Duplicate Accreditation No. is not allowed.');
					$("#frm_ErrorNotice").removeClass("hidden");
					$('#textAccreNo').focus();
				}else{
					$('#frm_processing').submit();					
				}
			});
		}
	});
});

function save_jo_pos(){
	if($('#textPos').val() == ''){
		$('#defaultNoticeContError_f').html('Position is required.');
		$("#frm_ErrorNotice_f").removeClass("hidden");
		$('#textPos').focus();
	}else{
		$('#frm_jo_pos').submit();
//		$.get(base_url_js+'processing/duplicate/manager_poea_jo/jo_id/'+$('#textJOID').val(), function(data){
//			if($('#textRecordId_f').val() == '' && data > 0){
//				$('#defaultNoticeContError_f').html('Duplicate Job Order ID is not allowed.');
//				$("#frm_ErrorNotice_f").removeClass("hidden");
//				$('#textJOID').focus();
//			}else{
//				$('#frm_jo_pos').submit();					
//			}
//		});
	}
}

function save_jo_allocation(){
	$('#frm_ErrorNotice_f, #frm_SuccessNotice_f').addClass('hidden');

	if($('#selectMRRef').val() == ''){
		$('#frm_ErrorNotice_f').removeClass('hidden');
		$('#defaultNoticeContError_f').html('Please select MR');
	}else if($('#frm_jo_allocation input[type="checkbox"]:checked').length == 0){
		$('#frm_ErrorNotice_f').removeClass('hidden');
		$('#defaultNoticeContError_f').html('Please select applicant');
	}else{
		$('#frm_jo_allocation').submit();
	}
}