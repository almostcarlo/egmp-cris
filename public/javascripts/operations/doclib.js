$(function () {
	//$('#textValidity').datepicker({dateFormat: 'dd/mm/yy'});

	generate_tab(current_tab);

	$('.doc_tab').click(function(){
		generate_tab($(this).attr('aria-controls'));
	});
});

function edit_doc(type,id){
	generate_tab(type, id);

	/*HIGHLIGHT CURRENT TAB*/
	$('.doc_tab').removeClass('active');
	$('#li_'+type).addClass('active');

	/*SCROLL TO FORM*/
	$('html, body').animate({
		scrollTop: $("#divFormCont").offset().top
	}, 1000);
}

function generate_tab(what, id=''){
	current_tab = what;
	$.get(base_url_js+'operations/ajax_tab', {tab:what, applicant_id:applicant_id, doc_id:id}, function(data) {
		$('.tab-content').html(data);
	});
}

function save_doc(){
	$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");
	
	if($('#textRecDate').val() == ''){
		$('#defaultNoticeContError').html('Received Date is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textRecDate').focus();
	}else if($('#selectRecBy').val() == ''){
		$('#defaultNoticeContError').html('Received By is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#selectRecBy').focus();
	}else{
		$('#frm_doclib').submit();
	}
}

function delete_doclib(what, id){
	if(!confirm("Deleting applicant's document. Do you want to proceed?")){
		return false;
	}

	$.get(base_url_js+'operations/delete_doclib/'+id, {delete_what:what, applicant_id:applicant_id}, function(data) {
		if(what == 'file'){
			generate_tab(current_tab, id);
		}else{
			/*RELOAD PAGE*/
			window.location.replace(base_url_js+'operations/forms/doclib/'+applicant_id+'/'+current_tab);	
		}
	});
}