var valid_mob = new RegExp('^0[0-9]{10}');
var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;

$(function () {
	$('#errorNotice').hide();
	
	if(create_error){
		$('#errorNotice').show();
		$('#defaultNoticeCont').html('Unable to create new applicant. Please contact System Administrator.');
	}

	$('#btn_createApplicant').click(function(){
		$('#errorNotice').hide();
		$('.has-error').removeClass("has-error");
		//$('#frm_create').submit();
		//$('#errorNotice').show();
		if($('#textEmail').val() == '' || ($('#textEmail').val() != '' && !emailReg.test($('#textEmail').val()))){
			$('#errorNotice').show();
			$('#defaultNoticeCont').html('Valid email address is required.');
			$('#textEmail').focus();
			$('#divEmail').addClass("has-error");
			return false;
		}else if($('#textAppliedCat').val() == '' && $('#textAppliedCat2').val() == ''){
			$('#errorNotice').show();
			$('#defaultNoticeCont').html('Applied position is required.');
			$('#textAppliedCat').focus();
			$('#divAppliedPos').addClass("has-error");
			return false;
		}/*else if($('#textPassword').val() == ''){
			errorNotice('#divPass', 'Password', '#textPassword');
			return false;
		}else if($('#textPassword').val() != $('#textConfirmPassword').val()){
			errorNotice('#divPass', 'Matching Password', '#textPassword');
			return false;
		}*/else if($('#textLastName').val() == '' || $('#textFirstName').val() == '' || $('#textMiddleName').val() == ''){
			$('#errorNotice').show();
			$('#defaultNoticeCont').html('Complete name is required.');
			$('#textLastName').focus();
			$('#divName').addClass("has-error");
			return false;
		}else if($('#textDateOfBirth').val() == ''){
			$('#errorNotice').show();
			$('#defaultNoticeCont').html('Birthdate is required.');
			$('#textDateOfBirth').focus();
			$('#divBday').addClass("has-error");
			return false;
		}/*else if($('#selectGender').val() == ''){
			errorNotice('#divBirth', 'Gender', '#selectGender');
			return false;
		}*/else if($('#textContactNumber').val() == '' || !valid_mob.test($('#textContactNumber').val())){
			$('#errorNotice').show();
			$('#defaultNoticeCont').html('Valid cell/mobile no. is required.');
			$('#textContactNumber').focus();
			$('#divMobNo').addClass("has-error");
			return false;
		}/*else if($('#selectCivilStatus').val() == ''){
			errorNotice('#divCivil', 'Civil Status', '#selectCivilStatus');
			return false;
		}*/else if($('#textStreet').val() == ''){
			$('#errorNotice').show();
			$('#defaultNoticeCont').html('Complete address is required.');
			$('#textStreet').focus();
			$('#divAddr').addClass("has-error");
			return false;
		}else if($('#selectCity').val() == ''){
			$('#errorNotice').show();
			$('#defaultNoticeCont').html('Complete address is required.');
			$('#selectCity').focus();
			$('#divCity').addClass("has-error");
			return false;
		}else if($('#selectSource').val() == '999' && $('#selectAgent').val() == ''){
			$('#errorNotice').show();
			$('#defaultNoticeCont').html('Agent is required.');
			$('#selectAgent').focus();
			//$('#divCity').addClass("has-error");
			return false;
		}else{
			/*CHECK DUPLICATE EMAIL AGAIN*/
			$.get(base_url_js+'applicant/ajax_duplicate_email', {email:$('#textEmail').val()}, function(data) {
				if(data == 1){
					$('.has-error').removeClass("has-error");
					$('#errorNotice').show();
					$('#defaultNoticeCont').html('Duplicate email not allowed!');
					$('#textEmail').select();
					$('#divEmail').addClass("has-error");
				}else{
					$('#frm_create').submit();
				}
			});
		}
	});
	
	/*CHECK FOR DUPLICATE EMAIL*/
	$('#textEmail').blur(function(){
		if($(this).val() != '' && emailReg.test($(this).val())){
			$.get(base_url_js+'applicant/ajax_duplicate_email', {email:$(this).val()}, function(data) {
				if(data == 1){
					$('.has-error').removeClass("has-error");
					$('#errorNotice').show();
					$('#defaultNoticeCont').html('Duplicate email not allowed!');
					$('#textEmail').select();
					$('#divEmail').addClass("has-error");
				}
			});
		}
	});

	/*AGENT DROPDOWN*/
	$('#selectSource').change(function(){
		if($(this).val() == '999'){
			$('#div_agent').removeClass('hidden');
		}else{
			$('#div_agent').addClass('hidden');
			$('#selectAgent').val('');
		}
	});

	/*REGION DROPDOWN*/
	$('#selectRegion').change(function(){
		if($(this).val() != ''){
			$.get(base_url_js+'applicant/ajax_get_province', {region_id:$(this).val()}, function(data) {
				$('#selectProvince').empty();
				$('#selectProvince').append(data);
			});
		}
	});

	/*PROVINCE DROPDOWN*/
	$('#selectProvince').change(function(){
		if($(this).val() != ''){
			$.get(base_url_js+'applicant/ajax_get_city', {province_id:$(this).val()}, function(data) {
				$('#selectCity').empty();
				$('#selectCity').append(data);
			});
		}
	});

	/*CITY DROPDOWN*/
	$('#selectCity').change(function(){
		if($(this).val() != ''){
			$.get(base_url_js+'applicant/ajax_get_brgy', {city_id:$(this).val()}, function(data) {
				$('#selectBrgy').empty();
				$('#selectBrgy').append(data);
			});
		}
	});
	
//    $('#errorNotice').hide();
//
//    $('#btn_submit').click(function(){
//    	if($('#textUser').val() == ''){
//    		errorNotice('#textUser', 'Username', '#textUser');    		
//    	}else if($('#textPassword').val() == ''){
//    		errorNotice('#textPassword', 'Password', '#textPassword');
//    	}else{
//    		$.post(base_url_js+'home/ajax_auth', $('#frm_login').serialize(), function(data) {
//    			var obj = jQuery.parseJSON(data);
//    			
//    			if(obj.status == 'error'){
//    				errorNotice('#textUser', '', '#textUser');
//    				$('#inputRequiredCustom').html(obj.msg);
//    			}else{
//    				window.location.replace(base_url_js+'home/dashboard');
//    			}
//    		});
//    	}
//    });
});