$(function () {
	$('#errorNotice').hide();
	
	$('#btn_savemedform').click(function(){
		$('#errorNotice').hide();
		
		if($('#selectClinic').val() == ''){
			$('#defaultNoticeCont').html('Clinic is required.');
			$('#errorNotice').show();
			jQuery("html").animate({ scrollTop: 1 }, "fast");
		}else if($('#selectResult').val() != '' && $('#textMedDate').val() == '' ){
			$('#defaultNoticeCont').html('Medical Exam Date is required.');
			$('#errorNotice').show();
			jQuery("html").animate({ scrollTop: 1 }, "fast");
		}else{
			$('#frm_medical').submit();
		}
	});
});