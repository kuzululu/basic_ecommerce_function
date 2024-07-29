<?php

if (isset($_POST["btnInsertComment"])) {
	$insert = new InsertReviews($conn);

	$insertNameReviews = $conn->escape_string(trim($_POST["insertNameReviews"]));
	$insertStatsReviews = $conn->escape_string(trim($_POST["insertStatsReviews"]));
	$insertFeedback = $conn->escape_string(trim($_POST["insertFeedback"]));
	$insertUserReviews = $conn->escape_string(trim($_POST["insertUserReviews"]));

	$result = $insert->insert($insertUserReviews, $insertNameReviews, $insertFeedback, $insertStatsReviews);

	if ($result) {
		showAlertSuccess($result);
	}
}

if (isset($_POST["btnDeleteReview"])) {
	if (!empty($_POST["review_delId"])) {
		$id = intval($_POST["review_delId"]);

		$dataDelet = new DeleteReview($conn);
		$result = $dataDelet->delete($id);
		if ($result) {
			showAlertDelete($result);
		}
	}
}

?>