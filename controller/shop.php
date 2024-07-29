<?php

if (isset($_POST["btnAddCart"])) {
	// deduct stocks logic
	$productManager = new ProductManager($conn);
	$product_id = $conn->escape_string(trim($_POST["cart_prod_id"]));
	$quantity = $conn->escape_string(trim($_POST["product_qty"]));

	$productManager->deductStock($product_id, $quantity);

	// add to cart logic
	$insertCart = new AddToCart($conn);
	$cart_cust_id = $conn->escape_string(trim($_POST["cart_cust_id"])); 
	$cart_prod_id = $conn->escape_string(trim($_POST["cart_prod_id"])); 
	$cart_cust_name = $conn->escape_string(trim($_POST["cart_cust_name"])); 
	$cart_cust_add = $conn->escape_string(trim($_POST["cart_cust_add"])); 
	$cart_image = $conn->escape_string(trim($_POST["cart_image"])); 
	$cart_date_order = $conn->escape_string(trim($_POST["cart_date_order"]));
	$cart_product_item = $conn->escape_string(trim($_POST["cart_product_item"])); 
	$cart_product_price = $conn->escape_string(trim($_POST["cart_product_price"]));
	$product_qty = $conn->escape_string(trim($_POST["product_qty"]));  
	$prod_sub_total = $conn->escape_string(trim($_POST["prod_sub_total"]));
	$cart_prod_pending = $conn->escape_string(trim($_POST["cart_prod_pending"]));

	$result = $insertCart->addCart($cart_date_order, $cart_cust_id, $cart_prod_id, $cart_cust_name, $cart_cust_add, $cart_image, $cart_product_item, $cart_product_price, $product_qty, $prod_sub_total, $cart_prod_pending);
	if ($result) {
		showAlertSuccess($result);
	}
}


?>