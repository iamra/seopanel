function callse(label, seurl) {
	$.ajax({url: seurl, success: function(result){
		$("#" + label).html(result);
	}});
};

$(document).ready(function(){
	$(".CheckBoxClass").change(function(){
		if($(this).is(":checked")){
			$(this).next("label").addClass("LabelSelected");
		}else{
			$(this).next("label").removeClass("LabelSelected");
		}
	});
	$(".RadioClass").change(function(){
		if($(this).is(":checked")){
			$(".RadioSelected:not(:checked)").removeClass("RadioSelected");
			$(this).next("label").addClass("RadioSelected");
		}
	});	
});