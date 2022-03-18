$(function () {
//	$('#errorNotice').hide();
//	alert('here');
    $('#datatable_cvtrans').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 4 } ],
        "info": true,
        "autoWidth": false
    });
    
    $('#datatable_cvtrans_app').DataTable({
	    "paging": true,
	    "lengthChange": false,
	    "searching": false,
	    "order": [],
	    "columnDefs": [ { "orderable": false, "targets": 3 } ],
	    "info": false,
	    "autoWidth": false
    });

	generate_tab('cv_selected',current_trans_id,'#cont_cv_selected');
	
    $(document).bind('reveal.facebox', function() {
        $('#facebox #textDate').datepicker({dateFormat: 'YYYY-MM-DD'});
    });
});

function sendtoinitial(id, t_id, l_id){
	$.get(base_url_js+'recruitment/ajax_cv_status', {applicant_id:id, status:'initial', trans_id:t_id, lineup_id:l_id}, function(data) {
		$('#tr_'+id).hide();
		generate_tab('cv_selected',t_id,'#cont_cv_selected');
	});
}

function checkbox_toggle(status){
	$('input[class=cv_chk]').each(function(){
      $(this).prop('checked', status);
   });
}

function updateCVStat(){
    var ck_box = $('input[class=cv_chk]:checked').length;
    var SelectedList = new Array();

	if(ck_box > 0){
		$('input[class=cv_chk]:checked').each(function() {
			SelectedList.push($(this).val());
		});

		$.facebox({ajax:base_url_js+'recruitment/facebox/form_cv_status?ids='+SelectedList});
	}else{
		alert('Please select applicant(s) to update.');
	}
}

function saveCVStat(){
	if($('#selectStat').val()==''){
		$('#defaultNoticeContError').html('CV Status is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
	}else{
		$.post(base_url_js+'recruitment/ajax_multiple_cv_status', $('#frm_cv_status').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('record has been updated.');
				$("#frm_SuccessNotice").removeClass("hidden");
	
				setTimeout(function(){
					$.facebox.close();

					/*reload ajax*/
					generate_tab('cv_selected',current_trans_id,'#cont_cv_selected');
				}, 500);
			}else{
				$('#defaultNoticeContError').html('unable to update record.');
				$("#frm_ErrorNotice").removeClass("hidden");
			}
		});
	}
}