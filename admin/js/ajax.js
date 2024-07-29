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
});

// category ajax
$(document).ready(function(){
	$(document).on("click", ".edit-category", function(e){
		e.preventDefault();
		let id = $(this).attr("id");
		$.ajax({
			url: "retrieve.php",
			method: "POST",
			data:{
				update_category_id: id
			},
			dataType: "json",
			success: function(data){
				$("#update-category-id").val(data.category_id);
				$("#cat_name_update").val(data.category_name);
				$("#cat_stats_update").val(data.status);
			}
		});
	});

	$(document).on("click", ".del-category", function(e){
		e.preventDefault();
		let id = $(this).attr("id");
		$.ajax({
			url: "retrieve.php",
			method: "POST",
			data:{
				del_category_id: id
			},
			dataType: "json",
			success: function(data){
				$("#del-category-id").val(data.category_id);
				$("#delCat").html(data.category_name);
			}
		})
	});

	$(document).on("keyup", "#filterCategory", function(e){
		e.preventDefault();
		let filter = $(this).val();
		$.ajax({
			url: "../class/class.php",
			method: "POST",
			data:{
				filterCategory: filter
			},
			success: function(response){
				$("#showDataCategory").html(response);
			}
		});
	});
});

// ================

// product ajax
$(document).ready(function(){

	$(document).on("click", ".edit-product", function(e){
		e.preventDefault();
		let id = $(this).attr("id");
		$.ajax({
			url: "retrieve.php",
			method: "POST",
			data:{
				update_product_id: id
			},
			dataType: "json",
			success: function(data){
				$("#update-product-id").val(data.product_id);
				$("#prod_name_update").val(data.product_name);
				$("#prod_cat_update").val(data.category);
				$("#prod_price_update").val(data.price);
				$("#prod_stock_update").val(data.stock);
				$("#prod_active_update").val(data.status);
			}
		});
	});

$(document).on("click", ".del-product", function(e){
	e.preventDefault();
	let id = $(this).attr("id");
	$.ajax({
		url: "retrieve.php",
		method: "POST",
		data:{
			del_prod_id: id
		},
		dataType: "json",
		success: function(data){
			$("#del-product-id").val(data.product_id);
			$("#delProd").html(data.product_name);

		}
	});
});

$(document).on("keyup", "#filterProduct", function(e){
	e.preventDefault();
	let filter = $(this).val();
	$.ajax({
		url: "../class/class.php",
		method: "POST",
		data:{
			filterProduct: filter
		},
		success: function(response){
			$("#showDataProduct").html(response);
		}
	});
});

// checkout
$(document).on("click", ".edit-checkout", function(e){
	e.preventDefault();
	let id = $(this).attr("id");
	$.ajax({
		url: "retrieve.php",
		method: "POST",
		data:{
			retrieveCheckOutId: id
		},
		dataType: "json",
		success: function(data){
			$("#update_checkId").val(data.checkout_id);
			$("#update_chk_stats").val(data.status);
			// stop here error at select tags 
		}
	});
});

$(document).on("keyup", "#filterAdminCheckout", function(e){
	e.preventDefault();
	let filter = $(this).val();

	$.ajax({
		url: "../class/class.php",
		method: "POST",
		data:{
			filterAdminCheckout: filter
		},
		success: function(response){
			$("#showDataCheckout").html(response);
		}
	});
});


$(document).on("keyup", "#filterperNameAdminCheckout", function(e){
	e.preventDefault();
	let filter = $(this).val();
	let customer_id = $("#customerId").val();

	$.ajax({
		url: "../class/class.php",
		method: "POST",
		data:{
			filterperNameAdminCheckout: filter,
			customer_id: customer_id //<-- include customer_id in data
		},
		success: function(response){
			$("#showDatasCheckout").html(response);
		}
	});
});


//filter reports date
$(document).on("click", "#filterDate", function(e){
	e.preventDefault();

	let from_date = $("#from_date").val();
	let to_date = $("#to_date").val();

	if (from_date == "" && to_date == "") {
Swal.fire({
position: 'top-end',
title: 'Error',
text: 'Select Date First',
icon: 'error',
allowOutsideClick: false,
showConfirmButton: false,
allowEscapeKey: false
});
setTimeout(()=>{
window.location.href = window.location.href;
},2000);
	}else{
		$.ajax({
			url: "../class/class.php",
			method: "POST",
			data:{
				from_date: from_date, to_date: to_date
			},
			success: function(data){
				$("#showReports").html(data);
			}
		});
	}

});


$(document).on("click", ".edit_reviewId", function(e){
	e.preventDefault();
	let id = $(this).attr("id");
	$.ajax({
		url: "retrieve.php",
		method: "POST",
		data:{
			updateReviewId: id
		},
		dataType: "json",
		success: function(data){
			$("#update_reviewId").val(data.review_id);
			$("#update_review").val(data.status);
		}
	});
});

});


// ================

