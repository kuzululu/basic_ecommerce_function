<?php

if (isset($_POST["btnCancelOrder"])) {
	$id = $_POST["cancel_cart_id"];
	$delete = new UpdateCartOrder($conn);
	$result = $delete->delete($id);	
	if ($result) {
		showAlertDelete($result);
	}
}

if (isset($_POST["btnCheckout"])) {

	$addCheckout = new AddCheckout($conn);
	$addCartArchive = new AddCheckout($conn);

	// Loop through the posted arrays and process each item
	foreach ($_POST['customer_id'] as $key => $value) {
		$customer_id = $conn->escape_string(trim($_POST["customer_id"][$key]));
		$product_id = $conn->escape_string(trim($_POST["product_id"][$key]));
		$date_order = $conn->escape_string(trim($_POST["date_order"][$key]));
		$customer_name = $conn->escape_string(trim($_POST["customer_name"][$key]));
		$customer_add = $conn->escape_string(trim($_POST["customer_add"][$key]));
		$customer_item = $conn->escape_string(trim($_POST["customer_item"][$key]));
		$customer_qty = $conn->escape_string(trim($_POST["customer_qty"][$key]));
		$customer_price = $conn->escape_string(trim($_POST["customer_price"][$key]));
		$customer_subtotal = $conn->escape_string(trim($_POST["customer_subtotal"][$key]));
		$customer_img = $conn->escape_string(trim($_POST["customer_img"][$key]));
		$customer_stats = $conn->escape_string(trim($_POST["customer_stats"][$key]));
		$payment_method = $conn->escape_string(trim($_POST["payment_method"]));

		$result = $addCheckout->addCheckout($date_order, $customer_id, $customer_name, $customer_add, $customer_item, $customer_qty, $customer_price, $customer_subtotal, $customer_img, $payment_method, $customer_stats);
		if ($result) {

			// Assuming you have a unique identifier for each row, like an order_id
   $order_id = $conn->escape_string(trim($_POST["order_id"][$key]));

   // Delete the row from the existing table
   $deleteQuery = "DELETE FROM tbl_cart WHERE order_id = ?";
   $stmt = $conn->prepare($deleteQuery);
   $stmt->bind_param("s", $order_id);
   $stmt->execute();
   $stmt->close();

			showAlertSuccess($result);
		}
	}
}


?>