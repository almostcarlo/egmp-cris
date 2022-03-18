$(document).ready(function(){
	/*DEPLOYMENT REPORT*/
	$('#SelectType').change(function(){
		if($(this).val() == 5){
			$('#divAgent').removeClass('hidden');
		}else{
			$('#divAgent').addClass('hidden');
		}
	})
})

function update_mr_weekly_sched(mr_id){
	$.get(base_url_js+'reports_operations/ajax_functions/update_mr_sched', {id:mr_id, sched:$('#selectSched_'+mr_id).val()}, function(data) {
		$('#selectSched_'+mr_id).addClass('hidden');
		$('#link_'+mr_id).removeClass('hidden');
		$('#link_'+mr_id).html($("#selectSched_"+mr_id+" option:selected").text());
	});
}