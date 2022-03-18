$(function () {

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
			$('#frm_pta').submit();
		}
	});
});