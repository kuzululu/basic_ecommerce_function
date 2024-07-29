<?php

if (isset($_POST["btnAddProduct"])) {
	$insertProduct = new InsertProduct($conn);

	$prod_name_entry = $conn->escape_string(trim($_POST["prod_name_entry"]));
	$prod_cat_entry = $conn->escape_string(trim($_POST["prod_cat_entry"]));
	$prod_price_entry = $conn->escape_string(trim($_POST["prod_price_entry"]));
	$prod_stock_entry = $conn->escape_string(trim($_POST["prod_stock_entry"]));
	$file = $_FILES["prod_file_entry"];
	$prod_encode_by_entry = $conn->escape_string(trim($_POST["prod_encode_by_entry"]));
	$prod_date_entry = $conn->escape_string(trim($_POST["prod_date_entry"]));
	$prod_active_entry = $conn->escape_string(trim($_POST["prod_active_entry"]));

	if (!empty($file["name"])) {
		$newFile = $insertProduct->uploadFile($file);
	}

	$result = $insertProduct->insert($prod_name_entry, $prod_cat_entry, $prod_price_entry, $prod_stock_entry, $newFile, $prod_encode_by_entry, $prod_date_entry, $prod_active_entry);
	if ($result) {
		showAlertSuccess($result);
	}
}

if (isset($_POST["btnUpdateProduct"])) {

	$updateProduct = new UpdateProductwithFile($conn);

	if (!empty($_POST["update_product_id"])) {
		$id = $conn->escape_string(trim($_POST["update_product_id"]));
		$prod_name_update = $conn->escape_string(trim($_POST["prod_name_update"]));
		$prod_cat_update = $conn->escape_string(trim($_POST["prod_cat_update"]));
		$prod_price_update = $conn->escape_string(trim($_POST["prod_price_update"]));
		$prod_stock_update = $conn->escape_string(trim($_POST["prod_stock_update"]));
		$prod_encode_by_update = $conn->escape_string(trim($_POST["prod_encode_by_update"]));
		$prod_file_update = $_FILES["prod_file_update"];
		$prod_active_update = $conn->escape_string(trim($_POST["prod_active_update"]));

		if (!empty($prod_file_update["name"])) {
			$newFile = $updateProduct->uploadFile($prod_file_update);

			$result = $updateProduct->updatewithFile($id, $prod_name_update, $prod_cat_update, $prod_price_update, $prod_stock_update, $newFile, $prod_encode_by_update, $prod_active_update);
			if ($result) {
				showAlertSuccess($result);
			}
		}else{
			$result = $updateProduct->updatewithoutFile($id, $prod_name_update, $prod_cat_update, $prod_price_update, $prod_stock_update, $prod_encode_by_update, $prod_active_update);
			if ($result) {
				showAlertSuccess($result);
			}
		}

 }
}

if (isset($_POST["btnDelProduct"])) {
	if (!empty($_POST["del_product_id"])) {
		$id = intval($_POST["del_product_id"]);

		$dataDelet = new DeleteProduct($conn);
		$result = $dataDelet->delete($id);
		if ($result) {
			showAlertDelete($result);
		}
	}
}

?>