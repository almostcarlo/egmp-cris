$(function () {
    // $('#datatable').DataTable({
    //     "paging": true,
    //     "lengthChange": true,
    //     "searching": true,
    //     "order": [],
    //     "columnDefs": [ { "orderable": false, "targets": 5 } ],
    //     "info": true,
    //     "autoWidth": false
    // });
    
    // $(document).bind('reveal.facebox', function() {
    //     $('#facebox #textSubmitDate').datepicker({dateFormat: 'YYYY-MM-DD'});
    //     $('#facebox #textAppDate').datepicker({dateFormat: 'YYYY-MM-DD'});
    // });

	$('#btn_submit').click(function(){
		$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");
		
		if($('#SelectPrincipal').val() == ''){
			$('#defaultNoticeContError').html('Principal is required.');
			$("#frm_ErrorNotice").removeClass("hidden");
			$('#SelectPrincipal').focus();
		}else if($('#textRoute1').val() == ''){
			$('#defaultNoticeContError').html('Route is required.');
			$("#frm_ErrorNotice").removeClass("hidden");
			$('#textRoute1').focus();
		}else{
			$('#frm_lpt').submit();
		}
	});
});

// function save_poea_jo(){
// 	if($('#textJOID').val() == ''){
// 		$('#defaultNoticeContError_f').html('Job Order ID is required.');
// 		$("#frm_ErrorNotice_f").removeClass("hidden");
// 		$('#textJOID').focus();
// 	}else{
// 		$.get(base_url_js+'processing/duplicate/manager_poea_jo/jo_id/'+$('#textJOID').val(), function(data){
// 			if($('#textRecordId_f').val() == '' && data > 0){
// 				$('#defaultNoticeContError_f').html('Duplicate Job Order ID is not allowed.');
// 				$("#frm_ErrorNotice_f").removeClass("hidden");
// 				$('#textJOID').focus();
// 			}else{
// 				$('#frm_poea_jo').submit();					
// 			}
// 		});
// 	}
// }