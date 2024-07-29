// reset page if field is blank
$(document).ready(function(){

$(".resetSearch").on("keyup", function(e){
e.preventDefault();
let resetSearch = $(this).val();
resetSearch == "" ? window.location.href = window.location.href : null;
});

$(".resetSearch").on("change", function(e){
e.preventDefault();
let resetSearch = $(this).val();
resetSearch == "" ? window.location.href = window.location.href : null;
});

$(document).on("keyup", "#filterOrders", function(e){
	e.preventDefault();
	let filter = $(this).val();
	$.ajax({
		url: "class/class.php",
		method: "POST",
		data:{
			filterOrders: filter
		},
		success: function(response){
			$("#showOrder").html(response);
		}
	});
});

$(document).on("keyup", "#filterCancelOrders", function(e){
	e.preventDefault();
	let filter = $(this).val();
	$.ajax({
		url: "class/class.php",
		method: "POST",
		data:{
			filterCancelOrders: filter
		},
		success: function(response){
			$("#showcancelOrder").html(response);
		}
	});
});

$(document).on("keyup", "#filterCheckout", function(e){
	e.preventDefault();
	let filter = $(this).val();
	$.ajax({
		url: "class/class.php",
		method: "POST",
		data:{
			filterCheckout: filter
		},
		success: function(response){
			$("#showDataCheckout").html(response);
		}
	});
});

$(document).on("keyup", "#filterCart", function(e){
	e.preventDefault();
	let filter = $(this).val();
	$.ajax({
		url: "class/class.php",
		method: "POST",
		data:{
			filterCart: filter
		},
		success: function(response){
			$("#showDataCart").html(response);
		}
	});
});

$(document).on("click", ".cancel-order", function(e){
	e.preventDefault();
	let id = $(this).attr("id");
	$.ajax({
		url: "retrieve.php",
		method: "POST",
		data:{
			retrieveCancelOrder: id
		},
		dataType: "json",
		success: function(data){
			$("#cancel_cart_id").val(data.order_id);
			$("#cancel_order").html(data.item);
		}
	});
});

$(document).on("click", ".del_reviewId", function(e){
	e.preventDefault();
	let id = $(this).attr("id");
	$.ajax({
		url: "retrieve.php",
		method: "POST",
		data:{
			del_reviewId: id
		},
		dataType: "json",
		success: function(data){
			$("#review_delId").val(data.review_id);
			$("#review_statement").html(data.feedback);
		}
	});
});

});
