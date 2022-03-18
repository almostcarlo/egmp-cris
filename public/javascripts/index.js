$(function () {
//    alert('here');
});

function errorNotice(inputContainer, inputRequired, inputID){
	$('.form-group').removeClass("has-error");	/*remove all error highlight*/

	$('#errorNotice').show();					/*show notification error*/
	if(inputRequired != ''){
		$('#defaultNoticeCont').show();
		$('#CustomNoticeCont').hide();
		$('#inputRequired').html(inputRequired);	/*notification message*/
	}else{
		$('#defaultNoticeCont').hide();
		$('#CustomNoticeCont').show();
	}

	$(inputContainer).addClass("has-error");	/*highlight input with error*/
	
	$(inputID).focus();
}