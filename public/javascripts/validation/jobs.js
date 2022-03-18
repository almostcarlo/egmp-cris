$(function () {
	var index_column_no = 7;
	if(!is_mr_required){
		index_column_no = 6;
	}
	
    $('#datatable_SearchJobs').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": index_column_no } ],
        "info": true,
        "autoWidth": false
    });
    
    $(document).bind('reveal.facebox', function() {
        $('#facebox #inputExpDate').datepicker({dateFormat: 'YYYY-MM-DD'});
    });

//	generate_tab(current_tab);
//
//	$('.profile_tab').click(function(){
//		//$('#errorPrompt, #successPrompt').hide();
//		generate_tab($(this).attr('aria-controls'));
//	});
//	
//    $(document).bind('reveal.facebox', function() {
//        $('#facebox #inputBirthDate').datepicker({dateFormat: 'YYYY-MM-DD'});
//        $('#facebox #textPRADate').datepicker({dateFormat: 'YYYY-MM-DD'});
//        $('#facebox #textEducFrom').datepicker({dateFormat: 'YYYY-MM'});
//        $('#facebox #textEducTo').datepicker({dateFormat: 'YYYY-MM'});
//        $('#facebox #textWorkFrom').datepicker({dateFormat: 'YYYY-MM'});
//        $('#facebox #textWorkTo').datepicker({dateFormat: 'YYYY-MM'});
//        $('#facebox #textTrainingDateFrom').datepicker({dateFormat: 'YYYY-MM'});
//        $('#facebox #textTrainingDateTo').datepicker({dateFormat: 'YYYY-MM'});
//        /*$('#facebox #textPRADate').focus();*/
//    });
});

function populatedd(get_what, per_what, initiator){
	var populate_this = '';
	var value_per_what = per_what;
	var rec_id = $(initiator).val();
	if(get_what == 'company'){
		populate_this = '#selectCompany';
	}else if(get_what == 'mr'){
		populate_this = '#selectMR';
		
		if(per_what == 'company' && rec_id == ''){
			/*if no company selected, show all mr of principal*/
			value_per_what = 'principal';
			rec_id = $('#selectPrincipal').val();
		}
	}

	$.get(base_url_js+'jobs/dropdown', {what:get_what, per:value_per_what, id:rec_id}, function(data) {
		$(populate_this+" option[value!='']").remove();	/*clear options*/

		if(data != ''){
			$(populate_this).append(data);				/*populate*/
		}
	});
}

function save_jo(){
	$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");
	
	if($('#textPosition').val() == ''){
		$('#defaultNoticeContError').html('Position is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textPosition').focus();
	}else if($('#selectPrincipal').val() == ''){
		$('#defaultNoticeContError').html('Principal is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#selectPrincipal').focus();
	}else if($('#selectMR').val() == ''){
		$('#defaultNoticeContError').html('MR is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#selectMR').focus();
	}else{
		/*CHECK DUPLICATE*/
		var mr_to_check = '';
		var mr_to_show_error = '';
		var p_to_check = '';
		if($('#textRecordId').val() != ''){
			mr_to_check = $('#textMrId').val();
			mr_to_show_error = $('#textMrRef').html();
			p_to_check = $('#textPrincipalId').val();
		}else{
			mr_to_check = $('#selectMR').val();
			mr_to_show_error = $('#selectMR option:selected').text()
			p_to_check = $('#selectMR').val();
		}
		
		$.get(base_url_js+'jobs/check_duplicate', {pos_id:$('#textPosition').val(), mr_id:mr_to_check, p_id:p_to_check, job_id:$('#textRecordId').val()}, function(data) {
			if(data>0){
				$('#defaultNoticeContError').html($('#textPosition option:selected').text()+' - '+mr_to_show_error+' already exist.');
				$("#frm_ErrorNotice").removeClass("hidden");
				$('#selectMR').focus();
			}else{
				$('#frm_facebox_jo').submit();				
			}
		});
	}
}