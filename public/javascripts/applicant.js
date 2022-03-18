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

	generate_tab(current_tab);

	$('.profile_tab').click(function(){
		//$('#errorPrompt, #successPrompt').hide();
		generate_tab($(this).attr('aria-controls'));
	});
	
    $(document).bind('reveal.facebox', function() {
        $('#facebox #inputBirthDate').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textPRADate').datepicker({dateFormat: 'YYYY-MM-DD'});
        $('#facebox #textEducFrom').datepicker({dateFormat: 'YYYY-MM'});
        $('#facebox #textEducTo').datepicker({dateFormat: 'YYYY-MM'});
        $('#facebox #textWorkFrom').datepicker({dateFormat: 'YYYY-MM'});
        $('#facebox #textWorkTo').datepicker({dateFormat: 'YYYY-MM'});
        $('#facebox #textTrainingDateFrom').datepicker({dateFormat: 'YYYY-MM'});
        $('#facebox #textTrainingDateTo').datepicker({dateFormat: 'YYYY-MM'});
        /*$('#facebox #textPRADate').focus();*/

		/*AGENT*/
	    $('#selectSource').change(function(){
	    	if($(this).val() == '999'){
	    		$('#div_agent').removeClass('hidden');
	    	}else{
	    		$('#div_agent').addClass('hidden');
	    	}
	    });

	    /*NUMERIC ONLY*/
		$('input[name="textAmount"]').keyup(function(e){
			if (/\D/g.test(this.value)){
				// Filter non-digits from input value.
				//this.value = this.value.replace(/\D/g, '');
				this.value = this.value.replace(/[^\d.]/g, '');
			}
		});

	    $('#checkNoEmployment').click(function(){
	    	if($(this).prop('checked')){
	    		$('#textCompany, #textPosition, #textSalary, #selectCountry, #textWorkFrom, #textWorkTo, #textJobDesc').prop('disabled', true);
	    	}else{
	    		$('#textCompany, #textPosition, #textSalary, #selectCountry, #textWorkFrom, #textWorkTo, #textJobDesc').prop('disabled', false);
	    	}
	    });

		/*REGION DROPDOWN*/
		$('#selectRegion').on('change', function(){
			if($(this).val() != ''){
				$.get(base_url_js+'applicant/ajax_get_province', {region_id:$(this).val()}, function(data) {
					$('#selectProvince, #selectCity, #selectBrgy').empty();
					$('#selectProvince').append(data);
				});
			}
		});

		/*PROVINCE DROPDOWN*/
		$('#selectProvince').change(function(){
			if($(this).val() != ''){
				$.get(base_url_js+'applicant/ajax_get_city', {province_id:$(this).val()}, function(data) {
					$('#selectCity,#selectBrgy').empty();
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
    });
});

function generate_tab(what){
	if(what != ''){
		current_tab = what;
		$.get(base_url_js+'applicant/ajax_tab', {tab:what, applicant_id:applicant_id}, function(data) {
			$('.tab-content').html(data);

			if(what == 'processing'){
				$('#textVisaDocReqDate').datepicker({dateFormat: 'YYYY-MM-DD'});
				$('#textVisaDocPrepDate').datepicker({dateFormat: 'YYYY-MM-DD'});
				$('#textVisaDocSendDate').datepicker({dateFormat: 'YYYY-MM-DD'});
				$('#textVisaDocRecvDate').datepicker({dateFormat: 'YYYY-MM-DD'});
				$('#textVisaDocExpDate').datepicker({dateFormat: 'YYYY-MM-DD'});
				$('#textVisaDocVrfyDate').datepicker({dateFormat: 'YYYY-MM-DD'});
				$('#textContractSched').datepicker({dateFormat: 'YYYY-MM-DD'});
				$('#textContractEndorsed').datepicker({dateFormat: 'YYYY-MM-DD'});
				$('#textContractChk').datepicker({dateFormat: 'YYYY-MM-DD'});
				$('#textContractRel').datepicker({dateFormat: 'YYYY-MM-DD'});
				$('#textPdosSched').datepicker({dateFormat: 'YYYY-MM-DD'});
				$('#textPdosTaken').datepicker({dateFormat: 'YYYY-MM-DD'});
			}
		});
	}
}

/*SAVE APPLICANT INFO*/
var valid_mob = new RegExp('^0[0-9]{10}');
function save_profile(){
	$("#frm_profileErrorNotice, #frm_profileSuccessNotice").addClass("hidden");
	if($('#textFname').val()==''){
		$('#defaultNoticeContError').html('Firstname is required.');
		$("#frm_profileErrorNotice").removeClass("hidden");
		$('#textFname').focus();
	}else if($('#textMname').val()==''){
		$('#defaultNoticeContError').html('Middlename is required.');
		$("#frm_profileErrorNotice").removeClass("hidden");
		$('#textMname').focus();
	}else if($('#textLname').val()==''){
		$('#defaultNoticeContError').html('Lastname is required.');
		$("#frm_profileErrorNotice").removeClass("hidden");
		$('#textLname').focus();
	}else if(!valid_mob.test($('#textContactNumber').val())){
		$('#defaultNoticeContError').html('Valid mobile no. is required.');
		$("#frm_profileErrorNotice").removeClass("hidden");
		$('#textContactNumber').focus();
	}else if($('#selectSource').val()=='999' && $('#selectAgent').val()==''){
		$('#defaultNoticeContError').html('Agent is required.');
		$("#frm_profileErrorNotice").removeClass("hidden");
		$('#selectAgent').focus();
	}else{
		$.post(base_url_js+'applicant/save_profile/personal', $('#frm_profile').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('record has been updated.');
				$("#frm_profileSuccessNotice").removeClass("hidden");
	
				setTimeout(function(){
				   //window.location.reload(1);
					window.location.replace(base_url_js+'profile/'+applicant_id+'/'+current_tab);
				}, 1000);
			}else{
				$('#defaultNoticeContError').html('unable to update record.');
				$("#frm_profileErrorNotice").removeClass("hidden");
			}
		});
	}
}

/*SAVE EDUC*/
function save_education(){
	if($('#selectEducation').val() == ''){
		$('#defaultNoticeContError').html('Education level is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#selectEducation').focus()
	}else if($('#textSchool').val() == ''){
		$('#defaultNoticeContError').html('School name is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textSchool').focus()
	}else{
		$.post(base_url_js+'applicant/save_profile/education', $('#frm_education').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('record has been updated.');
				$("#frm_SuccessNotice").removeClass("hidden");

				setTimeout(function(){
					//window.location.replace(base_url_js+'profile/'+applicant_id+'/'+current_tab);
					$.facebox.close();
					generate_tab(current_tab);
				}, 1000);
			}else{
				$('#defaultNoticeContError').html('unable to update record.');
				$("#frm_ErrorNotice").removeClass("hidden");
			}
		});
	}
}

/*SAVE WORK*/
function save_work(){
	if($('#checkNoEmployment').is(':checked') == false && $('#textCompany').val() == ''){
		$('#defaultNoticeContError').html('Company name is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textCompany').focus()
	}else if($('#checkNoEmployment').is(':checked') == false && $('#textPosition').val() == ''){
		$('#defaultNoticeContError').html('Position is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textPosition').focus()
	}else{
		$.post(base_url_js+'applicant/save_profile/work', $('#frm_work').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('record has been updated.');
				$("#frm_SuccessNotice").removeClass("hidden");

				setTimeout(function(){
					//window.location.replace(base_url_js+'profile/'+applicant_id+'/'+current_tab);
					$.facebox.close();
					generate_tab(current_tab);
				}, 1000);
			}else{
				$('#defaultNoticeContError').html('unable to update record.');
				$("#frm_ErrorNotice").removeClass("hidden");
			}
		});
	}
}

/*SAVE REFERENCE*/
function save_reference(){
	if($('#textRefName').val() == ''){
		$('#defaultNoticeContError').html('Name is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textRefName').focus()
	}else if($('#textRefContactNum').val() == ''){
		$('#defaultNoticeContError').html('Contact No. is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textRefContactNum').focus()
	}else{
		$.post(base_url_js+'applicant/save_profile/reference', $('#frm_reference').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('record has been updated.');
				$("#frm_SuccessNotice").removeClass("hidden");

				setTimeout(function(){
					//window.location.replace(base_url_js+'profile/'+applicant_id+'/'+current_tab);
					$.facebox.close();
					generate_tab(current_tab);
				}, 1000);
			}else{
				$('#defaultNoticeContError').html('unable to update record.');
				$("#frm_ErrorNotice").removeClass("hidden");
			}
		});
	}
}

/*SAVE TRAINING*/
function save_training(){
	if($('#textTrainings').val() == ''){
		$('#defaultNoticeContError').html('Title is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textTrainings').focus()
	}else if($('#textLicenseNum').val() == ''){
		$('#defaultNoticeContError').html('Training Center is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textLicenseNum').focus()
	}else{
		$.post(base_url_js+'applicant/save_profile/training', $('#frm_training').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('record has been updated.');
				$("#frm_SuccessNotice").removeClass("hidden");

				setTimeout(function(){
					//window.location.replace(base_url_js+'profile/'+applicant_id+'/'+current_tab);
					$.facebox.close();
					generate_tab(current_tab);
				}, 1000);
			}else{
				$('#defaultNoticeContError').html('unable to update record.');
				$("#frm_ErrorNotice").removeClass("hidden");
			}
		});
	}
}

function save_int_adv(){
	if($('#textAdvisory').val() == ''){
		$('#defaultNoticeContError').html('Your message is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textAdvisory').focus()
	}else{
		$.post(base_url_js+'applicant/save_advisory/internal', $('#frm_int_adv').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('Successfully saved.');
				$("#frm_SuccessNotice").removeClass("hidden");

				setTimeout(function(){
					//window.location.replace(base_url_js+'profile/'+applicant_id+'/'+current_tab);
					$.facebox.close();
					generate_tab(current_tab);
				}, 1000);
			}else{
				$('#defaultNoticeContError').html('Unable to save advisory.');
				$("#frm_ErrorNotice").removeClass("hidden");
			}
		});
	}
}

function save_app_adv(){
	if($('#textAdvisory').val() == ''){
		$('#defaultNoticeContError').html('Your message is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textAdvisory').focus()
	}else{
		$('#btn_send').addClass('disabled');
		$("#frm_InfoNotice").removeClass("hidden");
		$("#frm_ErrorNotice").addClass("hidden");

		$.post(base_url_js+'applicant/save_advisory/applicant', $('#frm_app_adv').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('Successfully saved.');
				$("#frm_SuccessNotice").removeClass("hidden");
				$("#frm_InfoNotice").addClass("hidden");

				setTimeout(function(){
					//window.location.replace(base_url_js+'profile/'+applicant_id+'/'+current_tab);
					$.facebox.close();
					generate_tab(current_tab);
				}, 1000);
			}else{
				$('#defaultNoticeContError').html('Unable to save advisory.');
				$("#frm_ErrorNotice").removeClass("hidden");
				$("#frm_InfoNotice").addClass("hidden");
			}
		});
	}
}

function save_skills(){
	if($('#textSkills').val() == ''){
		$('#defaultNoticeContError').html('Skills description is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textSkills').focus()
	}else{
		$.post(base_url_js+'applicant/save_profile/skills', $('#frm_skills').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('Successfully saved.');
				$("#frm_SuccessNotice").removeClass("hidden");

				setTimeout(function(){
					//window.location.replace(base_url_js+'profile/'+applicant_id+'/'+current_tab);
					$.facebox.close();
					generate_tab(current_tab);
				}, 1000);
			}else{
				$('#defaultNoticeContError').html('Unable to save skills.');
				$("#frm_ErrorNotice").removeClass("hidden");
			}
		});
	}
}

function save_position(){
	if($('#textAppliedCat2').val() == '' && $('#textAppliedCat1').val() == ''){
		$('#defaultNoticeContError').html('Applied position is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textAppliedCat1').focus()
	}else{
		$.post(base_url_js+'applicant/save_profile/position', $('#frm_position').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('Successfully saved.');
				$("#frm_SuccessNotice").removeClass("hidden");

				setTimeout(function(){
					//window.location.replace(base_url_js+'profile/'+applicant_id+'/'+current_tab);
					$.facebox.close();
					generate_tab(current_tab);
				}, 1000);
			}else{
				$('#defaultNoticeContError').html('Unable to save applied position.');
				$("#frm_ErrorNotice").removeClass("hidden");
			}
		});
	}
}

function save_profile_pix(){
	$("#frm_profileErrorNotice, #frm_profileSuccessNotice").addClass("hidden");
	if($('#fileUploadPhoto').val() == ''){
		$('#defaultNoticeContError').html('Please select a file to upload.');
		$("#frm_profileErrorNotice").removeClass("hidden");
		$('#fileUploadPhoto').focus()
	}else{
		/*AJAX UPLOAD*/
		var formData = new FormData($('form#frm_profile')[0]);

		$.ajax({
			url: base_url_js+'applicant/upload/profile_pix',
			type: 'POST',
			data: formData,
			async: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				obj = JSON.parse(data);
				
				if(obj.status == 'error'){
					$('#defaultNoticeContError').html(obj.msg);
					$("#frm_profileErrorNotice").removeClass("hidden");
					$('#fileUploadPhoto').focus()
				}else{
					$('#defaultNoticeContSuccess').html('File has been uploaded. Please refresh the page.');
					$("#frm_profileSuccessNotice").removeClass("hidden");
					$('#fileUploadPhoto').focus()
				}
			}
		});
	}
}

function save_uploaded_file(){
	$("#frm_ErrorNotice, #frm_SuccessNotice, #frm_WarningNotice").addClass("hidden");
	if($('#selectDocType').val() == ''){
		$('#defaultNoticeContError').html('Please select the type of document.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#selectDocType').focus()
	}else if($('#fileUpload').val() == ''){
		$('#defaultNoticeContError').html('Please select a file to upload.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#fileUpload').focus()
	}else{
		/*SHOW UPLOAD WARNING*/
		$('#defaultNoticeContWarning').html('Please wait until the file is completely uploaded.');
		$("#frm_WarningNotice").removeClass("hidden");

		/*DISABLE UPLOAD BUTTON*/
		$('#btn_upload').attr('disabled', true);

		/*AJAX UPLOAD*/
		var formData = new FormData($('form#frm_upload')[0]);

		$.ajax({
			url: base_url_js+'applicant/upload',
			type: 'POST',
			data: formData,
			async: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				obj = JSON.parse(data);
				
				if(obj.status == 'error'){
					$('#defaultNoticeContError').html(obj.msg);
					$("#frm_ErrorNotice").removeClass("hidden");
					$("#frm_WarningNotice").addClass("hidden");
					$('#fileUpload').focus()
				}else{
					$('#defaultNoticeContSuccess').html('File has been uploaded. Please refresh the page.');
					$("#frm_SuccessNotice").removeClass("hidden");
					$("#frm_WarningNotice").addClass("hidden");
					
					generate_tab(current_tab);
				}
			}
		});
	}
}

function save_emp_offer(){
	$('#frm_ErrorNotice, #frm_SuccessNotice').addClass("hidden");
	$.post(base_url_js+'applicant/save_profile/emp_offer', $('#frm_emp_offer').serialize(), function(data) {
		if(data){
			$('#defaultNoticeContSuccess').html('Employment Offer successfully updated.');
			$("#frm_SuccessNotice").removeClass("hidden");

			setTimeout(function(){
				$('#frm_ErrorNotice, #frm_SuccessNotice').addClass("hidden");
			}, 3000);
		}else{
			$('#defaultNoticeContError').html('Unable to save applied position.');
			$("#frm_ErrorNotice").removeClass("hidden");
		}
	});
}

function delete_record(what, id){
	if(what == 'cv'){
		if(!confirm("Deleting applicant's cv. Do you want to proceed?")){
			return false;
		}
	}else if(what == 'lineup'){
		if(!confirm("Deleting applicant's lineup. Do you want to proceed?")){
			return false;
		}
	}else if(what == 'assessment'){
		if(!confirm("Deleting applicant's assessment. Do you want to proceed?")){
			return false;
		}
	}else if(what == 'accounts_card'){
		if(!confirm("Deleting Accounts card particular. Do you want to proceed?")){
			return false;
		}
	}else if(what == 'welfare'){
		if(!confirm("Deleting welfare record. Do you want to proceed?")){
			return false;
		}
	}else if(what == 'jap_relative'){
		if(!confirm("Deleting relative. Do you want to proceed?")){
			return false;
		}
	}

	$.get(base_url_js+'applicant/delete/'+what+'/'+id, {applicant_id:applicant_id}, function(data) {
		if(what=='cv' || what == 'lineup' || what == 'assessment'){
			/*RELOAD PAGE*/
			window.location.replace(base_url_js+'profile/'+applicant_id+'/'+current_tab);
		}else{
			generate_tab(current_tab);
		}
	});
}

function delete_applicant(id){
	if(confirm('Do you want to proceed?')){
		$.get(base_url_js+'applicant/delete_applicant', {applicant_id:id}, function(data) {
			if(data == 'error'){
				alert('Unable to delete record. Please contact System Administrator.')
			}else{
				window.location.replace(base_url_js+'applicant');
			}
		});
	}
}

function save_accounts(){
	$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");
	if($('#selectParticular').val() == ''){
		$('#defaultNoticeContError').html('Particular is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#selectParticular').focus()
	}else if($('#selectParticular').val() == 0 && $('#textNewParticular').val() == ''){
		$('#defaultNoticeContError').html('New Particular is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textNewParticular').focus()
	}else if($('#textAmount').val() == ''){
		$('#defaultNoticeContError').html('Amount is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textAmount').focus()
	}else if($('#selectPayment').val() == ''){
		$('#defaultNoticeContError').html('Payment Method is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#selectPayment').focus()
	}else{
		$.post(base_url_js+'applicant/save_profile/accounts_card', $('#frm_accounts').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('Successfully saved.');
				$("#frm_SuccessNotice").removeClass("hidden");

				setTimeout(function(){
					$.facebox.close();
					generate_tab(current_tab);
				}, 1000);
			}else{
				$('#defaultNoticeContError').html('Unable to save accounts card particular.');
				$("#frm_ErrorNotice").removeClass("hidden");
			}
		});
	}
}

function new_particular(p_id){
	if(p_id == 0){
		$('#selectParticular').attr('disabled', 'disabled');
		$('#divNewParticular').removeClass('hidden');
		$('#textNewParticular').focus();
	}else{
		$('#divNewParticular').addClass('hidden');
	}
}

function save_accounts_rmk(){
	$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");
	if($('#textRemarks').val() == ''){
		$('#defaultNoticeContError').html('Remarks is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textRemarks').focus()
	}else{
		$.post(base_url_js+'applicant/save_profile/accounts_card_rmk', $('#frm_accounts_remarks').serialize(), function(data) {
			if(data){
				$('#defaultNoticeContSuccess').html('Successfully saved.');
				$("#frm_SuccessNotice").removeClass("hidden");

				setTimeout(function(){
					$.facebox.close();
					generate_tab(current_tab);
				}, 1000);
			}else{
				$('#defaultNoticeContError').html('Unable to save remarks.');
				$("#frm_ErrorNotice").removeClass("hidden");
			}
		});
	}
}

function for_endorsement(id, allow){
	if(allow){
		if(confirm('LINEUP and EMPLOYMENT OFFER cannot be edited anymore if you proceed ENDORSEMENT.\n\n Do you want to continue?')){
			window.location.replace(base_url_js+'applicant/for_endorsement/'+id);
		}
	}else{
		alert('Cannot proceed endorsement, please check if applicant is:\n\n-SELECTED and APPROVED\n-LINEUP DETAILS and EMPLOYMENT OFFER are completely filled up\n-PASSPORT is Valid\n-MEDICAL is Valid\n-NBI is Valid');
	}
	// $.get(base_url_js+'applicant/for_endorsement/'+id, function(data) {
	// 	alert(data);
	// });
	// if(confirm('LINEUP and EMPLOYMENT OFFER cannot be edited anymore if you proceed ENDORSEMENT.\n\n Do you want to continue?')){
	// 	alert(id);
	// }
}

function remove_for_endorsement(id){
	if(confirm('Applicant will be removed from FOR ENDORSEMENT.\n\n Do you want to continue?')){
		window.location.replace(base_url_js+'applicant/for_endorsement/'+id+'/remove');
	}
}


/*PROCESSING TAB*/
function get_visa_pos(){
	$('#selectVisaCatReq option:not(:first)').remove();
	$.get(base_url_js+'processing/get_visa_pos', {visa_id:$('#selectVisaNoReq').val()}, function(data){
		if(data!=''){
			obj = JSON.parse(data);

			// if(obj != null || obj != ''){
			// 	$.each(obj, function(key, value) {
			// 		$("#selectVisaCatReq").append(new Option(value, key));
			// 	});
			// }

			/*REQUEST CATEGORY*/
            if(obj.request_category != null || obj.request_category != ''){
                $("#selectVisaCatReq").append(obj.request_category);
            }
		}
	});
}

function save_visa_request(){
	if($('#selectVisaNoReq').val() == ''){
		alert('VISA No. is required.');
		$('#selectVisaNoReq').focus()
	}else if($('#selectVisaCatReq').val() == ''){
		alert('VISA Category is required.');
		$('#selectVisaCatReq').focus()
	}else{
		$('#form_visa_req').submit();
	}
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

function save_jo_request(){
	if($('#selectJOIDReq').val() == ''){
		alert('JO ID is required.');
		$('#selectJOIDReq').focus()
	}else if($('#selectJOCatReq').val() == ''){
		alert('JO Category is required.');
		$('#selectJOCatReq').focus()
	}else{
		$('#form_poea_req').submit();
	}
}

function deallocate_jo(id){
	if(confirm("JO Request will be deleted. Do you want to proceed?")){
		window.location.replace(base_url_js+'applicant/processing/deallocate_jo/'+id);
	}
}

function visa_endorsement(id){
	window.location.replace(base_url_js+'applicant/processing/visa_endorsement/'+id);
}

function rfp_endorsement(id){
	window.location.replace(base_url_js+'applicant/processing/rfp_endorsement/'+id);
}

function save_visa_documentation(){
	$('#form_visa_doc').submit();
}

function save_contract_signing(){
	$('#form_contract_signing').submit();
}

function submit_pdos(){
	$('#form_pdos').submit();
}

function save_welfare(){
	$("#frm_SuccessNotice, #frm_ErrorNotice").addClass("hidden");
	if($('#textDetails').val() == ''){
		$('#defaultNoticeContError').html('Case Details is required.');
		$("#frm_ErrorNotice").removeClass("hidden");
		$('#textDetails').focus()
	}else{
		/*AJAX UPLOAD*/
		var formData = new FormData($('form#frm_welfare')[0]);

		$.ajax({
			url: base_url_js+'applicant/save_profile/welfare',
			type: 'POST',
			data: formData,
			async: false,
			cache: false,
			contentType: false,
			processData: false,
			success: function (data) {
				if(data){
					$('#defaultNoticeContSuccess').html('Successfully saved.');
					$("#frm_SuccessNotice").removeClass("hidden");

					setTimeout(function(){
						$.facebox.close();
						generate_tab(current_tab);
					}, 1000);
				}else{
					$('#defaultNoticeContError').html('Unable to save welfare details.');
					$("#frm_ErrorNotice").removeClass("hidden");
				}
			}
		});
	}
}

function delete_welfare_attachment(id, fld_name){
	$.get(base_url_js+'applicant/delete/welfare_doc/'+id, {applicant_id:applicant_id, tbl_fld_name:fld_name}, function(data) {
		if(fld_name == 'attachment'){
			$('#facebox #textAttach').removeClass('hidden');
			$('#facebox #cont_attach').addClass('hidden');
		}else if(fld_name == 'action_attachment'){
			$('#facebox #textAttachAction').removeClass('hidden');
			$('#facebox #cont_act_attach').addClass('hidden');
		}

		$('#defaultNoticeContSuccess').html('Attachment successfully deleted.');
		$("#frm_SuccessNotice").removeClass("hidden");
	});
}
/*END PROCESSING TAB*/

/*JAPAN RESUME*/
function jap_profile(what, formname){
    $.post(base_url_js+'applicant/ajax_save_profile/'+what, $(formname).serialize(), function(data){
		if(data){
// alert(data);
// return false;
			$('#defaultNoticeContSuccess').html('Successfully saved.');
			$("#frm_SuccessNotice").removeClass("hidden");

			setTimeout(function(){
				$.facebox.close();
				generate_tab(current_tab);
			}, 1000);
		}else{
			$('#defaultNoticeContError').html('Unable to save '+what);
			$("#frm_ErrorNotice").removeClass("hidden");
		}
    });
}

function save_jap_relatives(){
	$("#frm_SuccessNotice_f, #frm_ErrorNotice_f").addClass("hidden");
	if($('#textName').val() == ''){
		$('#defaultNoticeContError_f').html('Name is required.');
		$("#frm_ErrorNotice_f").removeClass("hidden");
		$('#textName').focus()
	}else{
		$.post(base_url_js+'applicant/ajax_save_profile/jap_relative', $('#frm_jap_relative').serialize(), function(data){
			if(data){
				$('#defaultNoticeContSuccess_f').html('Successfully saved.');
				$("#frm_SuccessNotice_f").removeClass("hidden");

				setTimeout(function(){
					$.facebox.close();
					generate_tab(current_tab);
				}, 1000);
			}else{
				$('#defaultNoticeContError_f').html('Unable to save remarks.');
				$("#frm_ErrorNotice_f").removeClass("hidden");
			}
		});
	}
}
/*END JAPAN RESUME*/