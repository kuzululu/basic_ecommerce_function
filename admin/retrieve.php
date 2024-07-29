<?php

include("../inc/config.php");
include("../class/class.php");

$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
$conn = $dbConnect->connectDb();

if (isset($_POST["update_category_id"])) {
	$fetch = new RetrieveCategoryId($conn);
	$id = $_POST["update_category_id"];
	$row = $fetch->retrieve($id);

	// output the user data into JSON Format
	header("Content-Type: application/json");
	echo json_encode($row);
	$dbConnect->closeConnection();
}

if (isset($_POST["del_category_id"])) {
	$fetch = new RetrieveCategoryId($conn);
	$id = $_POST["del_category_id"];
	$row = $fetch->retrieve($id);

	// output the user data into JSON Format
	header("Content-Type: application/json");
	echo json_encode($row);
	$dbConnect->closeConnection();
}

if (isset($_POST["update_product_id"])) {
	$fetch = new RetrieveProductId($conn);
	$id = $_POST["update_product_id"];
	$row = $fetch->retrieve($id);

	// output the user data into JSON Format
	header("Content-Type: application/json");
	echo json_encode($row);
	$dbConnect->closeConnection();
}

if (isset($_POST["del_prod_id"])) {
	$fetch = new RetrieveProductId($conn);
	$id = $_POST["del_prod_id"];
	$row = $fetch->retrieve($id);

	// output the user data into JSON Format
	header("Content-Type: application/json");
	echo json_encode($row);
	$dbConnect->closeConnection();
}

if (isset($_POST["retrieveCheckOutId"])) {
	$fetch = new RetrieveCheckoutid($conn);
	$id = $_POST["retrieveCheckOutId"];
	$row = $fetch->retrieve($id);

	// output the user data into JSON Format
	header("Content-Type: application/json");
	echo json_encode($row);
	$dbConnect->closeConnection();
}

if (isset($_POST["updateReviewId"])) {
	$fetch = new RetrieveReivewId($conn);
	$id = $_POST["updateReviewId"];
	$row = $fetch->retrieve($id);

	header("Content-Type: application/json");
	echo json_encode($row);
	$dbConnect->closeConnection();
}

?>