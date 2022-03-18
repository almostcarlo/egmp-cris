$(function () {
    /*validate add form*/
    $('#btn_submit').click(function(e){
    	if($('#SelectPrincipal').val() == ''){
    		$('#settings_noticeError').removeClass('hidden');
    		$('#errorMsg_Cont').html('Principal is required.');
    		$('#SelectPrincipal').focus();
    		return false;
    	}else if($('#textCompanyCode').val()==''){
    		$('#settings_noticeError').removeClass('hidden');
    		$('#errorMsg_Cont').html('Company code is required.');
    		$('#textCompanyCode').focus();
    		return false;
    	}else if($('#textCompanyName').val()==''){
    		$('#settings_noticeError').removeClass('hidden');
    		$('#errorMsg_Cont').html('Company name is required.');
    		$('#textCompanyName').focus();
    		return false;
    	}else{
    		if($('#textRecordId').val() == ''){
    			/*CHECK IF USERNAME EXISTS*/
				$.get(base_url_js+'settings/check_duplicate', {table:'manager_company', field:'code', value:$('#textCompanyCode').val()}, function(data) {
					if(data == 1){
	    	    		$('#settings_noticeError').removeClass('hidden');
	    	    		$('#errorMsg_Cont').html('Duplicate record not allowed.');
	    	    		$('#textCompanyCode').select();
						return false;
					}else{
						$('#frm_add_company').submit();						
					}
				});
    		}else{
    			$('#frm_add_company').submit();
    		}
    	}
    });
});