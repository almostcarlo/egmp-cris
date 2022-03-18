$(function () {
    generate_recfeetab(current_lbl_tab);

	$('.recfee_tab').click(function(){
		generate_recfeetab($(this).attr('aria-controls'));
	});

    $('#btn_submit').click(function(){
        if($('#SelectPrincipal').val() == ''){
            $('#settings_noticeError').removeClass('hidden');
            $('#errorMsg_Cont').html('Principal is required.');
            $('#SelectPrincipal').focus();
            return false;
        }else{
            $('#frm_rec_fee').submit();
        }
    });
});

function generate_recfeetab(what){
    current_lbl_tab = what;
    $.get(base_url_js+'settings/ajax_tab/recfee', {label_id:what}, function(data) {
        $('.tab-content').html(data);
    });
}

function delete_record(what, id){
    if(!confirm("Record will be permanently deleted. Do you want to proceed?")){
        return false;
    }else{
        $.get(base_url_js+'settings/ajax_delete', {table:what, rec_id:id}, function(data) {
            generate_recfeetab(current_lbl_tab);
        });
    }
}