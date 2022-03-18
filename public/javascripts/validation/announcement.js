$(function () {
//    $('#errorNotice').hide();
//    
//    $('#textUser, #textPassword').keypress(function(e) {
//        if(e.which == 13) {
//        	$('#btn_submit').trigger('click');
//        }
//    });

    $('#btn_submit').click(function(){
    	if($('#textTitle').val() == ''){
    		$('#defaultNoticeContError').html('Title is required.');
    		$("#frm_ErrorNotice").removeClass("hidden");
    		$('#textTitle').focus();    		
    	}else if($('#textAnnouncements').val() == ''){
    		$('#defaultNoticeContError').html('Details is required.');
    		$("#frm_ErrorNotice").removeClass("hidden");
    		$('#textAnnouncements').focus();
    	}else{
    		$('#frm_announcement').submit();
//    		$.post(base_url_js+'home/ajax_auth', $('#frm_login').serialize(), function(data) {
//    			var obj = jQuery.parseJSON(data);
//    			
//    			if(obj.status == 'error'){
//    	    		$('#defaultNoticeContError').html(obj.msg);
//    	    		$("#frm_loginErrorNotice").removeClass("hidden");
//    				//errorNotice('#textUser', '', '#textUser');
//    				//$('#inputRequiredCustom').html(obj.msg);
//    			}else{
//    				//window.location.replace(base_url_js+'home/dashboard');
//    				window.location.replace(base_url_js+'applicant');
//    			}
//    		});
    	}
    });
});