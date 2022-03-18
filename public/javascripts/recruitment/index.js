$(function () {
	$('#errorNotice').hide();
	
    $('#datatable_5col, #datatable_5col_b').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 4 } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_forsending').DataTable({
        "paging": true,
        "pageLength": 100,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 0 } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_final').DataTable({
        "paging": true,
        "pageLength": 100,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": [0,7,8,9] } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_lineup').DataTable({
        "paging": true,
        "pageLength": 50,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": [8] } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_lineup_web').DataTable({
        "paging": true,
        "pageLength": 50,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": [8] } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_web_lineup').DataTable({
        "paging": true,
        "pageLength": 50,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": [7] } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_client_interview').DataTable({
        "paging": true,
        "pageLength": 100,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": [0,6] } ],
        "info": true,
        "autoWidth": false
    });
    
    $(document).bind('reveal.facebox', function() {
        $('#facebox #inputExpDate').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #inputInterviewDate').datepicker({dateFormat: 'YYYY-MM-DD'});
    });
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

function save_cvtrans(){
	$('#errorNotice').hide();
	if($('#textSentDate').val() == ''){
		$('#defaultNoticeCont').html('CV Sent Date is required.');
		$('#errorNotice').show();
	}else if($('#selectPrincipal').val() == ''){
		$('#defaultNoticeCont').html('Principal is required.');
		$('#errorNotice').show();
		$('#selectPrincipal').focus();
	}else{
		$('#frm_create').submit();
	}
}

function generate_tab(what, this_id, container){
	$(container).html('');
	var url = '';
	if(what == 'cv_initial'){
		url = base_url_js+'recruitment/ajax_cv_initial';
	}else if(what == 'cv_selected'){
		url = base_url_js+'recruitment/ajax_cv_selected';
	}

	$.get(url, {id:this_id}, function(data) {
		$(container).html(data);
	});
}

function web_lineup(action, id){
    var msg = 'Do you want to proceed?';
    if(action == 'add'){
        msg = 'Confirm Lineup?';
    }else if(action == 're'){
        msg = 'Re-evaluate Lineup?';
    }else{
        msg = 'Lineup will be deleted. Do you want to proceed?';
    }

    if(confirm(msg)){
        $.get(base_url_js+'recruitment/ajax_web_lineup', {id:id, action:action}, function(data) {
            if(data == 'error'){
                alert('An error occurred. Please try again.')
            }else{
                location.reload();
            }
        });
    }
}