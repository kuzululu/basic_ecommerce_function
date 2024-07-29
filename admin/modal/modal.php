<!-- modal insert category -->
<div class="modal fade" id="modalAddCatogory" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	
<div class="modal-dialog modal-dialog-scrollable modal-lg">
	
<div class="modal-content">
	
<div class="modal-header">
	<h4 class="text-primary fw-bolder">Entry</h4>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
	<form class="row needs-validation" novalidate="" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">

	<input type="hidden" name="cat_date_entry" value="<?= date('m/d/y') ?>">
	<input type="hidden" name="cat_encoded_entry" value="<?= $fullName; ?>">
		
	<div class="col-md-6 mb-3 pe-md-0">
		<label class="fw-bolder">Category Name</label>
		<input type="text" name="cat_name_entry" class="form-control" required="">
	</div>

	<div class="col-md-6 mt-md-1 pt-md-4 ps-md-1 mb-3">
		<input type="submit" class="btn btn-outline-primary btn-sm" name="btnInsertCategory" value="Add">
	</div>

	</form>
</div>

</div> <!-- end of modal content -->

</div> <!-- end of modal dialog -->

</div> <!-- end of modal -->

<!-- update modal category -->
<div class="modal fade" id="modalUpdateCategory" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	
<div class="modal-dialog modal-dialog-scrollable modal-lg">
	
<div class="modal-content">
	
<div class="modal-header">
	<h4 class="text-success fw-bolder">Update</h4>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
	<form class="row needs-validation" novalidate="" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
	<input type="hidden" name="update_category_id" id="update-category-id">
	<div class="col-md-6 mb-3">
		<label class="fw-bolder">Category Name</label>
		<input type="text" name="cat_name_update" id="cat_name_update" class="form-control" required="">
	</div>

	<div class="col-md-12">
		<input type="submit" class="btn btn-outline-success btn-sm" name="btnUpdateCategory" value="Update">
	</div>

	</form>
</div>

</div> <!-- end of modal content -->

</div> <!-- end of modal dialog -->

</div> <!-- end of modal -->

<!-- Delete category modal -->
<div class="modal fade" id="modalDeleteCategory" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	
<div class="modal-dialog modal-dialog-scrollable modal-lg">
	
<div class="modal-content">
	
<div class="modal-header">
	<h4 class="text-danger fw-bolder">Delete</h4>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">

	<h3>Do you want to delete the category <em><span id="delCat" class="text-danger fw-bolder"></span></em>?</h3>

	<form class="row needs-validation" novalidate="" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
	<input type="hidden" name="del_category_id" id="del-category-id">
	
	<div class="col-md-12">
		<input type="submit" class="btn btn-outline-danger btn-sm" name="btnDelCategory" value="Delete">
	</div>

	</form>
</div>

</div> <!-- end of modal content -->

</div> <!-- end of modal dialog -->

</div> <!-- end of modal -->


<!-- -->

<!-- modal product section -->
<div class="modal fade" id="modalAddProduct" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">

<div class="modal-dialog modal-dialog-scrollable modal-lg">
	
<div class="modal-content">
	
<div class="modal-header">
	<h4 class="text-primary fw-bolder">Entry</h4>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
	<form class="row needs-validation" novalidate="" enctype="multipart/form-data" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">

	<input type="hidden" name="prod_date_entry" class="form-control" value="<?= date('m/d/Y') ?>">
	<input type="hidden" name="prod_encode_by_entry" class="form-control" value="<?= $fullName; ?>">

	<div class="col-md-4 mb-3">
		<label class="fw-bolder">Product Name</label>
		<input type="text" name="prod_name_entry" class="form-control" required="">
	</div>

<!-- Array -->
<?php
	$categoriesSelect = new CategorySelect($conn);
	$categories = $categoriesSelect->categorySelect();
?>
	<div class="col-md-4 mb-3">
		<label class="fw-bolder">Category</label>
		<select class="form-control" name="prod_cat_entry" required="">
			<option name="prod_cat_entry" value=""></option>
			<?php foreach ($categories as $category) { ?>
				<option name="prod_cat_entry" value="<?= $category; ?>"><?= $category; ?></option>
			<?php } ?>
		</select>
	</div>
<!-- -->

<!-- avoid negative values -->
<div class="col-md-4 mb-3">
	<label class="fw-bolder">Price</label>
	<input type="number" name="prod_price_entry" class="form-control" required="" value="0" min="0" step="1" oninput="validateNumber(this)">
</div>

<div class="col-md-4 mb-3">
	<label class="fw-bolder">Stock</label>
	<input type="number" name="prod_stock_entry" class="form-control" required="" value="0" min="0" step="1" oninput="validateNumber(this)">
</div>

	<div class="col-md-4 mb-3">
		<label class="fw-bolder">Upload Product</label>
		<input type="file" name="prod_file_entry" class="form-control" required="" accept="image/*">
	</div>

	<div class="col-md-4 mb-3">
		<label>Status</label>
		<select class="form-control" name="prod_active_entry" required="">
			<option name="prod_active_entry" value=""></option>
			<option name="prod_active_entry" value="Active">Active</option>
			<option name="prod_active_entry" value="Inactive">Inactive</option>
		</select>
	</div>

	<div class="col-md-12">
		<input type="submit" name="btnAddProduct" class="btn btn-outline-primary btn-sm" value="Add">
	</div>
	
	</form>
</div>

</div> <!-- end of modal content -->

</div> <!-- end of modal dialog -->

</div> <!-- end of modal -->


<!-- update modal product -->
<div class="modal fade" id="modalUpdateProduct" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	
<div class="modal-dialog modal-dialog-scrollable modal-lg">
	
<div class="modal-content">
	
<div class="modal-header">
	<h4 class="text-success fw-bolder">Update</h4>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
	<form class="row needs-validation" novalidate="" enctype="multipart/form-data" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
	<input type="hidden" name="update_product_id" id="update-product-id">
	
	<input type="hidden" name="prod_encode_by_update" class="form-control" value="<?= $fullName; ?>">

	<div class="col-md-4 mb-3">
		<label class="fw-bolder">Product Name</label>
		<input type="text" name="prod_name_update" id="prod_name_update" class="form-control" required="">
	</div>

<!-- Array -->
<?php
	$categoriesSelect = new CategorySelect($conn);
	$categories = $categoriesSelect->categorySelect();
?>
	<div class="col-md-4 mb-3">
		<label class="fw-bolder">Category</label>
		<select class="form-control" name="prod_cat_update" id="prod_cat_update" required="">
			<option name="prod_cat_update" value=""></option>
			<?php foreach ($categories as $category) { ?>
				<option name="prod_cat_update" value="<?= $category; ?>"><?= $category; ?></option>
			<?php } ?>
		</select>
	</div>
<!-- -->

<!-- avoid negative values -->
<div class="col-md-4 mb-3">
	<label class="fw-bolder">Price</label>
	<input type="number" name="prod_price_update" id="prod_price_update" class="form-control" required="" value="0" min="0" step="1" oninput="validateNumber(this)">
</div>

<div class="col-md-4 mb-3">
	<label class="fw-bolder">Stock</label>
	<input type="number" name="prod_stock_update" id="prod_stock_update" class="form-control" required="" value="0" min="0" step="1" oninput="validateNumber(this)">
</div>

	<div class="col-md-4 mb-3">
		<label class="fw-bolder">Upload Product</label>
		<input type="file" name="prod_file_update" class="form-control" accept="image/*">
	</div>

	<div class="col-md-4 mb-3">
		<label>Status</label>
		<select class="form-control" name="prod_active_update" id="prod_active_update" required="">
			<option name="prod_active_update" value=""></option>
			<option name="prod_active_update" value="Active">Active</option>
			<option name="prod_active_update" value="Inactive">Inactive</option>
		</select>
	</div>



	<div class="col-md-12">
		<input type="submit" class="btn btn-outline-success btn-sm" name="btnUpdateProduct" value="Update">
	</div>

	</form>
</div>

</div> <!-- end of modal content -->

</div> <!-- end of modal dialog -->

</div> <!-- end of modal -->

<!-- Delete product modal -->
<div class="modal fade" id="modalDeleteProduct" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	
<div class="modal-dialog modal-dialog-scrollable modal-lg">
	
<div class="modal-content">
	
<div class="modal-header">
	<h4 class="text-danger fw-bolder">Delete</h4>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">

	<h3>Do you want to delete the product <em><span id="delProd" class="text-danger fw-bolder"></span></em>?</h3>

	<form class="row needs-validation" novalidate="" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
	<input type="hidden" name="del_product_id" id="del-product-id">
	
	<div class="col-md-12">
		<input type="submit" class="btn btn-outline-danger btn-sm" name="btnDelProduct" value="Delete">
	</div>

	</form>
</div>

</div> <!-- end of modal content -->

</div> <!-- end of modal dialog -->

</div> <!-- end of modal -->


<!-- modal update checkout -->
<div class="modal fade" id="modalCheckUpdate" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	
<div class="modal-dialog modal-dialog-scrollable">
	
<div class="modal-content">
	
<div class="modal-header">
	<h4 class="text-success fw-bolder">Update</h4>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
	<form class="row needs-validation" novalidate="" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
	<input type="hidden" name="update_checkId" id="update_checkId">
	
	<div class="col-md-12 mb-3">
		<label class="fw-bolder">Status</label>
		<select class="form-control" name="update_chk_stats" id="update_chk_stats" required="">
			<option name="update_chk_stats" value=""></option>
			<option name="update_chk_stats" value="Cancel Order">Cancel Order</option>
			<option name="update_chk_stats" value="Shipped Out">Shipped Out</option>
			<option name="update_chk_stats" value="Out for Delivery">Out for Delivery</option>
			<option name="update_chk_stats" value="Delivered">Delivered</option>
			<option name="update_chk_stats" value="Pending">Pending</option>
		</select>
	</div>

	<div class="col-md-12">
		<input type="submit" class="btn btn-outline-success btn-sm" name="btnCheckUpdateStats" value="Update">
	</div>

	</form>
</div>

</div> <!-- end of modal content -->

</div> <!-- end of modal dialog -->

</div> <!-- end of modal -->
<!--  --> 


<!-- modal update client review status -->
<div class="modal fade" id="modalUpdateClientStatusReview" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	
<div class="modal-dialog modal-dialog-scrollable">
	
<div class="modal-content">
	
<div class="modal-header">
	<h4 class="text-success fw-bolder">Update</h4>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
	<form class="row needs-validation" novalidate="" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
	<input type="hidden" name="update_reviewId" id="update_reviewId">
	
	<div class="col-md-12 mb-3">
		<label class="fw-bolder">Status</label>
		<select class="form-control" name="update_review" id="update_review" required="">
			<option name="update_review" value=""></option>
			<option name="update_review" value="Verified">Verified</option>
			<option name="update_review" value="For Review">For Review</option>
			<option name="update_review" value="Pending">Pending</option>
		</select>
	</div>

	<div class="col-md-12">
		<input type="submit" class="btn btn-outline-success btn-sm" name="btnUpdateReviews" value="Update">
	</div>

	</form>
</div>

</div> <!-- end of modal content -->

</div> <!-- end of modal dialog -->

</div> <!-- end of modal -->

<!-- -->



	<script type="text/javascript">
			let validateNumber = (input) =>{
				input.value = input.value.replace(/\D/g, ""); //numbers only back to start
				if (input.value < 0) {
					input.value = 0;
				}
			}
	</script>
	<!-- -->