$('#textExpiryDate').datepicker({dateFormat: 'YYYY-MM-DD'});

var current_mr_id = $('#textRecordId').val();
var current_tab = $('#textCurrentTab').val();
	
$(function () {
	generateDropdown('company','#selectCompany',$('#selectCompany').val());
	generate_tab(current_tab);
	
	$('.mr_tab').click(function(){
		generate_tab($(this).attr('aria-controls'));
	});
});

function generateMRRef(){
	$.get(base_url_js+'recruitment/ajax_functions/get_mr_code', {p_id:$('#selectPrincipal').val()}, function(data) {
		$('#textRefCode').val(data);
	});
}

function save_mr(){
	$('#frm_ErrorNotice').addClass('hidden');
	if($('#selectPrincipal').val() == ''){
		$('#defaultNoticeContError').html('Principal is required.');
		$('#frm_ErrorNotice').removeClass('hidden');
	}else{
		$('#frm_mr').submit();
	}
}

function generateDropdown(w, select_id, cur_val){
	$(select_id).find('[value!=""]').remove();
	$.get(base_url_js+'settings/ajax_dd', {what:w, principal_id:$('#selectPrincipal').val(), selected_val:cur_val}, function(data) {
		if(data){
			$(select_id).append(data);
		}
	});
}

function generate_tab(what){
	$.get(base_url_js+'recruitment/ajax_tab', {tab:what, mr_id:current_mr_id}, function(data) {
		$('.tab-content').html(data);
	});
}

function save_jo(){
	$("#frm_SuccessNotice_fb, #frm_ErrorNotice_fb").addClass("hidden");
	
	if($('#textPosition').val() == ''){
		$('#defaultNoticeContError_fb').html('Position is required.');
		$("#frm_ErrorNotice_fb").removeClass("hidden");
		$('#textPosition').focus();
	}else{
		$('#frm_facebox_jo').submit();
	}
}

function save_mr_sched(){
	$("#frm_SuccessNotice_fb, #frm_ErrorNotice_fb").addClass("hidden");
	
	if($('#textVenue').val() == ''){
		$('#defaultNoticeContError_fb').html('Venue is required.');
		$("#frm_ErrorNotice_fb").removeClass("hidden");
		$('#textVenue').focus();
	}else if($('#inputInterviewDate').val() == ''){
		$('#defaultNoticeContError_fb').html('Interview Date is required.');
		$("#frm_ErrorNotice_fb").removeClass("hidden");
		$('#inputInterviewDate').focus();
	}else{
		$('#frm_facebox_sched').submit();
	}
}

function delete_mr(what, id){
	if(!confirm("Deleting record. Do you want to proceed?")){
		return false;
	}else{
		window.location.replace(base_url_js+'recruitment/delete/'+what+'/'+id);
	}
}