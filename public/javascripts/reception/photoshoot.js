var raw_image_data = '';
var current_applicant_id = '';

$(function () {
    $('#datatable_photoshoot').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": false,
        "order": [],
        "columnDefs": [ { "orderable": false, "targets": 4 } ],
        "info": true,
        "autoWidth": false
    });
});

function selectThis(id){
	$.get(base_url_js+'reception/ajax', {action:'photoshoot', applicant_id:id}, function(data) {
		current_applicant_id = id;
		$('#divUpload').html(data);

		$('#sectionPhotoshoot').removeClass('hidden');

		/*INITIALIZE WEBCAM*/
		Webcam.set({
		    width: 640,
		    height: 480,
		    image_format: 'jpeg',
		    jpeg_quality: 90,
		    force_flash: false
		});

	    Webcam.attach( '#my_camera' );
	});
}

function capture_img(){
	Webcam.freeze();
}

function freeze(){
	Webcam.freeze();
	$('#btn_freeze').addClass('hidden');
	$('#btn_unfreeze').removeClass('hidden');
}

function unfreeze(){
	Webcam.unfreeze();
	$('#btn_freeze').removeClass('hidden');
	$('#btn_unfreeze').addClass('hidden');
}

function save_webcam_image(){
	Webcam.snap( function(data_uri) {
	    raw_image_data = data_uri;
	});

	if(raw_image_data != ''){
		Webcam.upload( raw_image_data, base_url_js+'reception/saveWebpic?applicant_id='+current_applicant_id, function(code, text) {
		    selectThis(current_applicant_id);
		    $('#frm_camSuccessNotice').removeClass('hidden');
		});
	}

	unfreeze();
}

function save_profile_pix(){
	$("#frm_photoshootErrorNotice, #frm_photoshootSuccessNotice").addClass("hidden");
	if($('#fileUploadPhoto').val() == ''){
		$('#defaultNoticeContError').html('Please select a file to upload.');
		$("#frm_photoshootErrorNotice").removeClass("hidden");
		$('#fileUploadPhoto').focus()
	}else{
		/*AJAX UPLOAD*/
		var formData = new FormData($('form#frm_photoshoot')[0]);

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
					$("#frm_photoshootErrorNotice").removeClass("hidden");
					$('#fileUploadPhoto').focus()
				}else{
					$('#defaultNoticeContSuccess').html('File has been uploaded');
					$("#frm_photoshootSuccessNotice").removeClass("hidden");

					setTimeout(function(){
						selectThis($('#textApplicant_id').val());
					}, 1000);
				}
			}
		});
	}
}