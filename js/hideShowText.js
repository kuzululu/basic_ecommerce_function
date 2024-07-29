$(document).ready(function(){
	$("#floatRemarks").on("change", function(){
		let select = $("#floatRemarks");
	let output = $("#others");

	if (select.val() === "Others") {
		output.show();
	}else{
		output.hide();
	}
	});

	$("#floatUpdateRemarks").on("change", function(){
		let sel_up = $("#floatUpdateRemarks");
		let out_up = $("#floatUpdateSpecify");

		if (sel_up.val() === "Others") {
			out_up.removeAttr("readonly");
		}else{
			out_up.attr("readonly", true);
		}
	});

});