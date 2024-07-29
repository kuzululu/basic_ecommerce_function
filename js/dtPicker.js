$(document).ready(function(){
	$("#date").datepicker({
		dateFormat: "mm/dd/yy",
		// change year and month
		changeMonth: true,
		changeYear: true,
		yearRange: "1900:c"
	});

	$("#to_date").datepicker({
		dateFormat: "mm/dd/yy",
		// change year and month
		changeMonth: true,
		changeYear: true,
		yearRange: "1900:c"
	});

	$("#from_date").datepicker({
		dateFormat: "mm/dd/yy",
		// change year and month
		changeMonth: true,
		changeYear: true,
		yearRange: "1900:c"
	});
});