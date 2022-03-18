$(function () {

    $('#datatable_5col').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 4 } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_5col_search').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 4 } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_6col').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 6 } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_6col_search').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 5 } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_visa_alloc').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 7 } ],
        "info": true,
        "autoWidth": false
    });

    
    $('#datatable_oec_req').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 9 } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_jo_req').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 10} ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_lpt').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 5} ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_trans').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 2 } ],
        "info": true,
        "autoWidth": false
    });

    $('#datatable_visa_entry').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 8 } ],
        "info": true,
        "autoWidth": false
    });

    $('#dttbl_vfs_final').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 5 } ],
        "info": true,
        "autoWidth": false
    });

    $('#dttbl_vfs_rel').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 7 } ],
        "info": true,
        "autoWidth": false
    });

    $(document).bind('reveal.facebox', function() {
        $('#facebox #textVisaReqDate').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textRFPsubmit').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textRFPrelease').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textRFPReqDate').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textPOEASentDate').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textPOEAApproveDate').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textTransDate').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textTransSubmit').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textTransRel').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textSubDate, #textReqDate, #textPrDate').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textVisaDate').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textVisaStamp').datepicker({dateFormat: 'YYYY-MM-DD'});

        /*VFS*/
        $('#facebox #textPropDate, #textFinalDate, #textRelDate').datepicker({dateFormat: 'YYYY-MM-DD'});
    });
});

function delete_processing(what, hdr_id, dtl_id){
	if(!confirm("Deleting record. Do you want to proceed?")){
		return false;
	}else{
		window.location.replace(base_url_js+'processing/delete/'+what+'/'+hdr_id+'/'+dtl_id);
	}
}

function save_visa_alloc(){
    $("#frm_ErrorNotice_f, #frm_SuccessNotice_f").addClass("hidden");
    if($('#selectVisaNoReq').val()==''){
        $('#defaultNoticeContError_f').html('Request Allocation is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectVisaNoReq').focus();
    }else if($('#selectVisaCatReq').val()==''){
        $('#defaultNoticeContError_f').html('Request Category is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectVisaCatReq').focus();
    }else if($('#selectVisaStat').val() == ''){
        $('#defaultNoticeContError_f').html('Status is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectVisaStat').focus();
    }else if($('#selectVisaStat').val() == 'Accepted' && $('#selectApprovedCat').val()==''){
        $('#defaultNoticeContError_f').html('Approved VISA Category is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectApprovedCat').focus();
    }else if($('#selectVisaStat').val() == 'Denied' && $('#textRemarks').val()==''){
        $('#defaultNoticeContError_f').html('Remarks is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectApprovedCat').focus();
    }else{
        $.post(base_url_js+'applicant/visa_allocation', $('#frm_visa_alloc').serialize(), function(data) {
            if(data){
                $('#defaultNoticeContSuccess_f').html('record has been updated.');
                $("#frm_SuccessNotice_f").removeClass("hidden");
    
                setTimeout(function(){
                    window.location.replace(base_url_js+'processing/activity/visa_allocation');
                }, 1000);
            }else{
                $('#defaultNoticeContError_f').html('unable to update record.');
                $("#frm_ErrorNotice_f").removeClass("hidden");
            }
        });
    }
}

function get_visa_pos(){
    $('#selectVisaCatReq option:not(:first)').remove();
    $('#selectApprovedCat option:not(:first)').remove();
    $.get(base_url_js+'processing/get_visa_pos', {visa_id:$('#selectVisaNoReq').val()}, function(data){
        if(data!=''){
            obj = JSON.parse(data);

            /*REQUEST CATEGORY*/
            if(obj.request_category != null || obj.request_category != ''){
                $("#selectVisaCatReq").append(obj.request_category);
            }

            /*APPROVED CATEGORY*/
            if(obj.approved_category != null || obj.approved_category != ''){
                $("#selectApprovedCat").append(obj.approved_category);
            }
        }
    });
}

function get_jo_pos(){
    $('#selectJOCatReq option:not(:first)').remove();
    $.get(base_url_js+'processing/get_jo_pos', {jo_id:$('#selectJOIDReq').val()}, function(data){
        if(data!=''){
            obj = JSON.parse(data);

            if(obj.jo_category != null || obj.jo_category != ''){
                $("#selectJOCatReq").append(obj.jo_category);
            }
        }
    });
}

function get_approved_jo_pos(){
    $('#selectPOEAApprovedCat option:not(:first)').remove();
    $.get(base_url_js+'processing/get_jo_pos', {jo_id:$('#selectPOEAApprovedID').val(), approved:1}, function(data){
        if(data!=''){
            obj = JSON.parse(data);

            if(obj.jo_category != null || obj.jo_category != ''){
                $("#selectPOEAApprovedCat").append(obj.jo_category);
            }
        }
    });
}

function save_rfp_request(){
    $("#frm_ErrorNotice_f, #frm_SuccessNotice_f").addClass("hidden");
    if($('#selectRFPStat').val() == ''){
        $('#defaultNoticeContError_f').html('Status is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectRFPStat').focus();
    }else if($('#selectRFPStat').val() == 'Accepted' && $('#textRFPoec').val() == ''){
        $('#defaultNoticeContError_f').html('OEC is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textRFPoec').focus();
    }else if($('#selectRFPStat').val() == 'Accepted' && $('#textRFPcgno').val() == ''){
        $('#defaultNoticeContError_f').html('CG No. is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textRFPcgno').focus();
    }else if($('#selectRFPStat').val() == 'Denied' && $('#textRemarks').val()==''){
        $('#defaultNoticeContError_f').html('Remarks is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectApprovedCat').focus();
    }else{
        $.post(base_url_js+'applicant/oec_request', $('#frm_oec_request').serialize(), function(data) {
            if(data){
                $('#defaultNoticeContSuccess_f').html('record has been updated.');
                $("#frm_SuccessNotice_f").removeClass("hidden");
    
                setTimeout(function(){
                    window.location.replace(base_url_js+'processing/activity/oec_request');
                }, 1000);
            }else{
                $('#defaultNoticeContError_f').html('unable to update record.');
                $("#frm_ErrorNotice_f").removeClass("hidden");
            }
        });
    }
}

function save_jo_request(){
    $("#frm_ErrorNotice_f, #frm_SuccessNotice_f").addClass("hidden");
    if($('#selectJOIDReq').val() == ''){
        $('#defaultNoticeContError_f').html('Applied JO ID is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectJOIDReq').focus();
    }else if($('#selectJOCatReq').val() == ''){
        $('#defaultNoticeContError_f').html('Applied JO Category is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectJOCatReq').focus();
    }else if($('#selectPOEAApprovedID').val() != '' && $('#textPOEASentDate').val() == ''){
        $('#defaultNoticeContError_f').html('POEA Sent Date is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textPOEASentDate').focus();
    }else if($('#selectPOEAApprovedID').val() != '' && $('#textPOEAApproveDate').val() == ''){
        $('#defaultNoticeContError_f').html('POEA Approved Date is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textPOEAApproveDate').focus();
    }else if($('#textPOEAApproveDate').val() != '' && $('#selectPOEAApprovedID').val() == ''){
        $('#defaultNoticeContError_f').html('Approved JO ID is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectPOEAApprovedID').focus();
    }else if($('#textPOEAApproveDate').val() != '' && $('#selectPOEAApprovedCat').val() == ''){
        $('#defaultNoticeContError_f').html('Approved JO Category is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectPOEAApprovedCat').focus();
    }else{
        $.post(base_url_js+'applicant/jo_request', $('#frm_jo_request').serialize(), function(data) {
            if(data){
                $('#defaultNoticeContSuccess_f').html('record has been updated.');
                $("#frm_SuccessNotice_f").removeClass("hidden");
    
                setTimeout(function(){
                    window.location.replace(base_url_js+'processing/activity/jo_request');
                }, 1000);
            }else{
                $('#defaultNoticeContError_f').html('unable to update record.');
                $("#frm_ErrorNotice_f").removeClass("hidden");
            }
        });
    }
}

function save_visa_trans(){
    if($('#textTransNo').val() == ''){
        $('#defaultNoticeContError_f').html('Transmittal No. is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textTransNo').focus();
    }else if($('#textTransDate').val() == ''){
        $('#defaultNoticeContError_f').html('Transmittal Date is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textTransDate').focus();
    }else{
        $('#frm_visa_trans').submit();
    }
}

/*TRANSMITTAL ALLOCATION*/
function show_applicants(){
    $('.all_tbody').addClass("hidden");         /*HIDE ALL*/
    $('#tbody_nodata').removeClass('hidden');
    $("#frm_ErrorNotice_f").addClass("hidden"); /*HIDE ERROR NOTICE*/

    if($('#selectMRRef').val() != ''){
        $('#tbody_'+$('#selectMRRef').val()).removeClass("hidden");
        $('#tbody_nodata').addClass('hidden');
    }
}

function save_alloc_trans(){
    if($('#frm_alloc_trans input:checked').length <= 0){
        $('#defaultNoticeContError_f').html('Please select atleast one (1) applicant.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
    }else if($('#textTransSubmit').val() == ''){
        $('#defaultNoticeContError_f').html('Transmittal Submit Date is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textTransSubmit').focus();
    }else{
        $('#frm_alloc_trans').submit();
    }
}

function update_alloc_trans(){
    if($('#textTransSubmit').val() == ''){
        $('#defaultNoticeContError_f').html('Transmittal Submit Date is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textTransSubmit').focus();
    }else{
        $('#frm_alloc_trans').submit();
    }
}
/*END TRANSMITTAL ALLOCATION*/

/*BOOKING*/
function save_booking_req(){
    if($('#selectPrincipal').val() == ''){
        $('#defaultNoticeContError_f').html('Principal is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectPrincipal').focus();
    }else if($('#textPrDate').val() == ''){
        $('#defaultNoticeContError_f').html('Proposed Booking Date is required.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textPrDate').focus();
    }else{
        $('#frm_booking_req').submit();
    }
}

function save_app_booking_req(){
    if($('#frm_app_booking_req input:checked').length <= 0){
        $('#defaultNoticeContError_f').html('Please select atleast one (1) applicant.');
        $("#frm_ErrorNotice_f").removeClass("hidden");
    }else{
        $('#frm_app_booking_req').submit();
    }
}

function chkuncheck(){
    $('.chk_all:not(:hidden)').prop('checked', $('#chk_hdr').prop("checked"));
}
/*END BOOKING*/

function compute_end_date(sdate, days, cont_id) {
    if(sdate != ''){
        //var tt = document.getElementById('txtDate').value;

        var date = new Date(sdate);
        var newdate = new Date(date);

        newdate.setDate(newdate.getDate() + parseInt(days));
        
        var dd = newdate.getDate();
        var mm = newdate.getMonth() + 1;
        var y = newdate.getFullYear();

        var someFormattedDate = mm + '/' + dd + '/' + y;

        $(cont_id).val(someFormattedDate)
        //document.getElementById('follow_Date').value = someFormattedDate;
    }
}

function save_visa_nonksa(){
    $("#frm_ErrorNotice_f, #frm_SuccessNotice_f").addClass("hidden");

    if($('#textVisaNo').val() == ''){
        $('#defaultNoticeContError_f').html('VISA No. is required');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textVisaNo').focus();
    }else if($('#selectEmployer').val() == ''){
        $('#defaultNoticeContError_f').html('Client/Employer is required');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectEmployer').focus();
    }else if($('#textVisaDate').val() == ''){
        $('#defaultNoticeContError_f').html('VISA Date is required');
        $("#frm_ErrorNotice_f").removeClass("hidden");
    }else if($('#selectApplicant').val() == ''){
        $('#defaultNoticeContError_f').html('Please select applicant');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectApplicant').focus();
    }else{
        var formData = new FormData($('form#frm_visa_entry')[0]);

        $.ajax({
            url: base_url_js+'processing/save/visa_nonksa',
            type: 'POST',
            data: formData,
            async: false,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if(data == 1){
                    /*SUCCESS*/
                    window.location.replace(base_url_js+"processing/activity/visa_entry");
                }else if(data == 404){
                    $('#defaultNoticeContError_f').html('Applicant not found.');
                    $("#frm_ErrorNotice_f").removeClass("hidden");
                }else if(data == 400){
                    $('#defaultNoticeContError_f').html('Unable to upload file.');
                    $("#frm_ErrorNotice_f").removeClass("hidden");
                }
            }
        });
    }
}

function delete_file(id){
    $("#frm_ErrorNotice_f, #frm_SuccessNotice_f").addClass("hidden");

    if(confirm('Attachment will be deleted. Do you want to proceed?')){
        $.post(base_url_js+'processing/delete/visa_nonksa_attachment/'+id, function(data) {
            if(data == 1){
                $('.file_elements').addClass('hidden');     /*HIDE FILE HYPERLINK*/
                $('.input_elements').removeClass('hidden'); /*SHOW FILE INPUT*/

                $('#defaultNoticeContSuccess_f').html('Attachment has been deleted.');
                $("#frm_SuccessNotice_f").removeClass("hidden");
            }else{
                $('#defaultNoticeContError_f').html('Unable to delete attachment.');
                $("#frm_ErrorNotice_f").removeClass("hidden");
            }
        });
    }
}

function save_vfs(){
    $("#frm_ErrorNotice_f, #frm_SuccessNotice_f").addClass("hidden");

    if($('#selectApplicant').val() == ''){
        $('#defaultNoticeContError_f').html('Please select applicant');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#selectApplicant').focus();
    }else if($('#textPropDate').val() == ''){
        $('#defaultNoticeContError_f').html('Proposed Schedule is required');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textPropDate').focus();
    }else if($('#textVenue').val() == ''){
        $('#defaultNoticeContError_f').html('Venue is required');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textVenue').focus();
    }else if($('#textRelDate').val() != '' && $('#textRefNo').val() == ''){
        $('#defaultNoticeContError_f').html('Reference No. is required');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textRefNo').focus();
    }/*else if($('#textPropDate').val() != '' && $('#textFinalDate').val() == ''){
        $('#defaultNoticeContError_f').html('Final Schedule is required');
        $("#frm_ErrorNotice_f").removeClass("hidden");
        $('#textFinalDate').focus();
    }*/else{
        $.post(base_url_js+'processing/save/vfs_sched', $('#frm_vfs_sched').serialize(), function(data) {
            if(data == 1){
                /*SUCCESS*/
                window.location.replace(base_url_js+"processing/activity/vfs_sched");
            }else if(data == 404){
                $('#defaultNoticeContError_f').html('Applicant not found.');
                $("#frm_ErrorNotice_f").removeClass("hidden");
            }
        });
    }
}