$(document).ready(function(){
	let input = $(".number");

	input.on("change", function(e){
		e.preventDefault();
		$(this).val($(this).val().length > 11 ? $(this).val().slice(0,11) : $(this).val());
	});
});