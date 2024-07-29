<!-- Cancel Cart order modal -->
<div class="modal fade" id="modalCartCancel" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	
<div class="modal-dialog modal-dialog-scrollable modal-lg">
	
<div class="modal-content">
	
<div class="modal-header">
	<h4 class="text-danger fw-bolder">Cancel</h4>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">

	<h3>Do you want to cancel the <em><span id="cancel_order" class="text-danger fw-bolder"></span></em>?</h3>

	<form class="row needs-validation" novalidate="" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
	<input type="hidden" name="cancel_cart_id" id="cancel_cart_id">
	<div class="col-md-12">
		<input type="submit" class="btn btn-outline-danger btn-sm" name="btnCancelOrder" value="Cancel">
	</div>

	</form>
</div>

</div> <!-- end of modal content -->

</div> <!-- end of modal dialog -->

</div> <!-- end of modal -->

<!-- modal Reviews -->
<div class="modal fade" id="modalInsertComment" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	
<div class="modal-dialog modal-dialog-scrollable modal-lg">
	
<div class="modal-content">
	
<div class="modal-header">
	<h4 class="text-primary fw-bolder">Comment</h4>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
<form class="row needs-validation" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
	<input type="hidden" name="insertNameReviews" value="<?= $initials; ?>">
	<input type="hidden" name="insertUserReviews" value="<?= $_SESSION['user_id'] ?>">
	<input type="hidden" name="insertStatsReviews" value="For Review">
	<div class="col-md-12 mb-3">
		<label class="fw-bolder">Feedback:</label>
		<textarea class="form-control" name="insertFeedback" required=""></textarea>
	</div>
	<div class="col-md-12">
		<input type="submit" class="btn btn-outline-primary btn-sm" value="Comment" name="btnInsertComment">
	</div>
</form>
</div>

</div> <!-- end of modal content -->

</div> <!-- end of modal dialog -->

</div> <!-- end of modal -->

<div class="modal fade" id="modalDeleteReview" aria-hidden="true" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1">
	
<div class="modal-dialog modal-dialog-scrollable modal-lg">
	
<div class="modal-content">
	
<div class="modal-header">
	<h4 class="text-danger fw-bolder">Delete</h4>
	<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">
<h3>You will delete your review of <em><span id="review_statement" class="text-danger fw-bolder"></span></em>?</h3>
<form class="row needs-validation" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
 <input type="hidden" name="review_delId" id="review_delId">
 <div class="col-md-12">
 	<input type="submit" name="btnDeleteReview" class="btn btn-outline-danger btn-sm" value="Delete">
 </div>
</form>
</div>

</div> <!-- end of modal content -->

</div> <!-- end of modal dialog -->

</div> <!-- end of modal -->

<!-- -->