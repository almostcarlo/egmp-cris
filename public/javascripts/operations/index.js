//jQuery(document).ready(function($) {
//	$('a[rel*=facebox]').facebox(); 
//});

$(function () {
//	$('#frm_profileErrorNotice').hide();

    $('#datatable_SearchApplicant').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 5 } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_doc').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": [2,3,4,5,6,7,8,9,10,11,12,13] } ],
        "info": true,
        "autoWidth": false
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