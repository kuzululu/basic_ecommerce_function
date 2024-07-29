<?php

// entry category
if (isset($_POST["btnInsertCategory"])) {
	$insertRecords = new InsertCategoryName($conn);
	$cat_date_entry = $conn->escape_string(trim($_POST["cat_date_entry"])); 
	$cat_encoded_entry = $conn->escape_string(trim($_POST["cat_encoded_entry"]));
	$cat_name_entry = $conn->escape_string(trim($_POST["cat_name_entry"]));

	$result = $insertRecords->insert($cat_date_entry, $cat_encoded_entry, $cat_name_entry);
	
	if ($result) {
		showAlertSuccess($result);
	}
}

// update category
if (isset($_POST["btnUpdateCategory"])) {
	$dataUpdate = new UpdateCategory($conn);
	if (!empty($_POST["update_category_id"])) {
		$id = $conn->escape_string(trim($_POST["update_category_id"]));
		$cat_name_update = $conn->escape_string(trim($_POST["cat_name_update"]));
		
		$result = $dataUpdate->update($id, $cat_name_update);

		if ($result) {
			showAlertSuccess($result);
		}
	}
}

// delete category
if (isset($_POST["btnDelCategory"])) {
	if (!empty($_POST["del_category_id"])) {
		$id = intval($_POST["del_category_id"]);

		$dataDelet = new DeleteCategory($conn);
		$result = $dataDelet->delete($id);
		if ($result) {
			showAlertDelete($result);
		}
	}
}
?>