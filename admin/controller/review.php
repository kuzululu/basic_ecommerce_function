<?php 

if (isset($_POST["btnUpdateReviews"])) {

	$updateReview = new UpdateReviewStatus($conn);

	if (!empty($_POST["update_reviewId"])) {
		$update_reviewId = $conn->escape_string(trim($_POST["update_reviewId"]));
		$update_review = $conn->escape_string(trim($_POST["update_review"]));

		$result = $updateReview->update($update_reviewId, $update_review);
		if ($result) {
			showAlertSuccess($result);
		}
	}

}

?>