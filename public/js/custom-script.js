jQuery(document).ready(function(){
	console.log("RUN");
	jQuery("#selectAjax").change(function(select){
		console.log(select);
		
		console.log(jQuery(this).val());
		
		jQuery.ajax({
			url : "/spd/ajax",
			type : "POST",
			data : {
				'value' : jQuery(this).val()
			},
			success : function (data, textStatus, jqXHR){
				console.log(data);
				jQuery('#selectAjaxResult').html(data);
			}
		});
		
	});
});