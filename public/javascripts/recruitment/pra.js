$(function () {
	$('#datatable').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 4 } ],
        "info": true,
        "autoWidth": false
    });

    $(document).bind('reveal.facebox', function() {
        $('#facebox #textStartDate').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textEndDate').datepicker({dateFormat: 'YYYY-MM-DD'});

		$('#btn_submit').click(function(){
			$('#frm_ErrorNotice_fb').addClass('hidden');

			if($('#selectPrincipal').val() == ''){
				$('#defaultNoticeContError_fb').html('Principal is required.');
				$('#frm_ErrorNotice_fb').removeClass('hidden');
				$('#selectPrincipal').focus();
			}else if($('#textStartDate').val() == '' || $('#textEndDate').val() == ''){
				$('#defaultNoticeContError_fb').html('Start/End is required.');
				$('#frm_ErrorNotice_fb').removeClass('hidden');
			}else{
				$('#frm_facebox_pra').submit();
			}
		});
    });
});

function delete_attachement(what, rec_id){
	$('#frm_ErrorNotice_fb, #frm_SuccessNotice_fb').addClass('hidden');
	$.get(base_url_js+'recruitment/ajax_functions/delete_attachment', {what:what, id:rec_id}, function(data) {
		if(data != 'error'){
			$('#defaultNoticeContSuccess_fb').html('File has been deleted.');
			$('#frm_SuccessNotice_fb').removeClass('hidden');

			/*SHOW UPLOAD FILE INPUT*/
			if(what == 'file'){
				$('#textFile').removeClass('hidden');
				$('#cont_file_link').hide();
			}else{
				$('#textRcvCopy').removeClass('hidden');
				$('#cont_rcv_copy_link').hide();
			}
		}else{
			$('#defaultNoticeContError_fb').html('Unable to delete file.');
			$('#frm_ErrorNotice_fb').removeClass('hidden');
		}
	});
}