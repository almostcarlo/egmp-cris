$(function(){
	//$('#inputSelectDate, #inputApproveDate, #inputDeployDate').datepicker({dateFormat: 'YYYY-MM-DD'});

	if($('#textRecordId').val() != ''){
		//populate selected by list
		pos_id = $('#SelectPosition').val();
		$.get(base_url_js+'jobs/jobinfo', {mr_pos_id:pos_id}, function(data){
			if(data!=''){
				obj = JSON.parse(data);

				/* principal name */
				$('#textPrincipal').val(obj.principal.toUpperCase());

				/*mr ref*/
				if(obj.mr_id == null){
					$('#textMrId').val(0);
				}else{
					$('#textMrId').val(obj.mr_id);
					$('#textMRRef').val(obj.mr_ref.toUpperCase());
				}

				/* company name */
				if(obj.company != null || obj.company != ''){
					$('#textCompany').val(obj.company.toUpperCase());
				}
				
				/*contacts*/
				if(obj.contacts != null || obj.contacts != ''){
					$.each(obj.contacts, function(key, value) {
					    //alert(key+' ==> '+value.id+' ['+value.name);
						$("#selectBy").append(new Option(value.name, value.id));
					});
					
					$('#selectBy').val($('#textCurrentSelectedBy').val());
				}
			}
		});
	}
	
	$('#SelectPosition').change(function(){
		$('#textMRRef, #textPrincipal, #textCompany').val('');
		$("#selectBy option[value!='']").remove();

		if($(this).val() != ''){
			var pos_id = $(this).val();

			$.get(base_url_js+'jobs/jobinfo', {mr_pos_id:pos_id}, function(data){
				if(data!=''){
					obj = JSON.parse(data);
	
					/* principal name */
					$('#textPrincipal').val(obj.principal.toUpperCase());
	
					/*mr ref*/
					if(obj.mr_id == null){
						$('#textMrId').val(0);
					}else{
						$('#textMrId').val(obj.mr_id);
						$('#textMRRef').val(obj.mr_ref.toUpperCase());
					}
	
					/* company name */
					if(obj.company != null || obj.company != ''){
						$('#textCompany').val(obj.company.toUpperCase());
					}
					
					/*contacts*/
					if(obj.contacts != null || obj.contacts != ''){
						$.each(obj.contacts, function(key, value) {
						    //alert(key+' ==> '+value.id+' ['+value.name);
							$("#selectBy").append(new Option(value.name, value.id));
						});
					}
				}
			});
		}
	});
	
	$('#selectStatus, #selectAccept').change(function(){
		$('#divDeployDate').addClass("hidden");
		if($('#selectStatus').val() == 'Selected' && $('#selectAccept').val() == 'Accepted'){
			// $('#selectDBStat').val('OPERATIONS');
			$('#selectDBStat').val('MOBILIZATION');
		}else{
			if($('#selectAccept').val() == 'Declined' || $('#selectAccept').val() == 'Negotiate'){
				$('#selectDBStat').val('RESERVED');
			}else{
				$('#selectDBStat').val('ACTIVE');
			}
		}
	});
	
	$('#selectDBStat').change(function(){
		$('#divDeployDate').addClass("hidden");
		$('#selectStatus').val('');
		$('#selectAccept').val('');
		$('#btn_deadfile').addClass("hidden");
		$('.btn-default, .required').removeClass("hidden");

		// if($(this).val() == 'OPERATIONS' || $(this).val() == 'DEPLOYED' || $(this).val() == 'RESERVED'){
		if($(this).val() == 'MOBILIZATION' || $(this).val() == 'DEPLOYED' || $(this).val() == 'RESERVED'){
			$('#selectStatus').val('Selected');
			$('#selectAccept').val('Accepted');

			if($(this).val() == 'DEPLOYED'){
				$('#divDeployDate').removeClass("hidden");
			}
		}else if($(this).val() == 'DEADFILE' || $(this).val() == 'ACTIVE'){
			$('#btn_deadfile').removeClass("hidden");
			$('.btn-default, .required').addClass("hidden");
		}
	});

	$('#textIsDropped').change(function(){
		if($(this).val() == 'N'){
			if($('#selectStatus').val() == 'Selected' && $('#selectAccept').val() == 'Accepted'){
				// $('#selectDBStat').val('OPERATIONS')
				$('#selectDBStat').val('MOBILIZATION')
			}
		}
	});
})

function save_lineup(){
	$("#frm_ErrorNotice, #frm_SuccessNotice").addClass("hidden");

	/*DROP LINEUP*/
	if($('#chkDropped').is(':checked')){
		if(confirm('Selected line up will be dropped and this applicant will be transferred to RESERVED. Do you want to proceed?')){
			$('#selectDBStat').val('RESERVED');
			$('#frm_status').submit();
		}
	}else{
		if($('#textRecordId').val() == '' && $('#SelectPosition').val() == ''){
			$('#defaultNoticeContError').html('Position is required.');
			$("#frm_ErrorNotice").removeClass("hidden");
			$('#SelectPosition').focus();
		// }else if($('#selectDBStat').val() == 'OPERATIONS' && $('#textSelectDate').val() == ''){
		}else if($('#selectDBStat').val() == 'MOBILIZATION' && $('#textSelectDate').val() == ''){
			$('#defaultNoticeContError').html('Select Date is required.');
			$("#frm_ErrorNotice").removeClass("hidden");
		}else if($('#selectDBStat').val() == 'DEPLOYED' && $('#inputDeployDate').val() == ''){
			$('#defaultNoticeContError').html('Deployment Date is required.');
			$("#frm_ErrorNotice").removeClass("hidden");
		}else{
			$('#frm_status').submit();
			//$.post(base_url_js+'applicant/ajax_save_profile/lineup', $('#frm_status').serialize(), function(data){
	//		$.post(base_url_js+'operations/ajax_save/status_changer', $('#frm_status').serialize(), function(data){
	//			if(data){
	//				if($('#textRecordId').val() == ''){
	//					$('#defaultNoticeContSuccess').html('Successfully added new lineup.');
	//				}else{
	//					$('#defaultNoticeContSuccess').html('Successfully updated lineup.');
	//				}
	//
	//				$("#frm_SuccessNotice").removeClass("hidden");
	//
	//				setTimeout(function(){
	//					$.facebox.close();
	//					generate_tab(current_tab);
	//				}, 1000);
	//			}else{
	//				$('#defaultNoticeContError').html('Unable to save lineup.');
	//				$("#frm_ErrorNotice").removeClass("hidden");
	//			}
	//		});
		}
	}
}

function update_status(){
	$('#frm_status').attr('action', base_url_js+'operations/save/no_lineup');
	$('#frm_status').submit();
}