<?php

include("inc/config.php");
include("class/class.php");

$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
$conn = $dbConnect->connectDb();

if (isset($_POST["retrieveCancelOrder"])) {
	$fetch = new RetrieveCancelOrderId($conn);
	$id = $_POST["retrieveCancelOrder"];

	$row = $fetch->retrieve($id);

	// output the user data into JSON Format
	header("Content-Type: application/json");
	echo json_encode($row);
	$dbConnect->closeConnection();
}

if (isset($_POST["del_reviewId"])) {
	$fetch = new RetrieveReivewId($conn);
	$id = $_POST["del_reviewId"];

	$row = $fetch->retrieve($id);

	// output the user data into JSON Format
	header("Content-Type: application/json");
	echo json_encode($row);
	$dbConnect->closeConnection();
}

?>