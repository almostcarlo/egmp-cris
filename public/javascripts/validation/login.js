$(function () {
    $('#errorNotice').hide();
    
    $('#textUser, #textPassword').keypress(function(e) {
        if(e.which == 13) {
        	$('#btn_submit').trigger('click');
        }
    });

    $('#btn_submit').click(function(){
    	if($('#textUser').val() == ''){
    		$('#defaultNoticeContError').html('Username is required.');
    		$("#frm_loginErrorNotice").removeClass("hidden");
    		$('#textUser').focus();
    		//errorNotice('#textUser', 'Username', '#textUser');    		
    	}else if($('#textPassword').val() == ''){
    		$('#defaultNoticeContError').html('Password is required.');
    		$("#frm_loginErrorNotice").removeClass("hidden");
    		$('#textPassword').focus();
    		//errorNotice('#textPassword', 'Password', '#textPassword');
    	}else{
    		$.post(base_url_js+'home/ajax_auth', $('#frm_login').serialize(), function(data) {
    			var obj = jQuery.parseJSON(data);
    			
    			if(obj.status == 'error'){
    	    		$('#defaultNoticeContError').html(obj.msg);
    	    		$("#frm_loginErrorNotice").removeClass("hidden");
    				//errorNotice('#textUser', '', '#textUser');
    				//$('#inputRequiredCustom').html(obj.msg);
    			}else{
    				//window.location.replace(base_url_js+'home/dashboard');
    				window.location.replace(base_url_js+'home/dashboard');
    			}
    		});
    	}
    });
});