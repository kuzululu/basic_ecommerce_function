<?php

ob_start();
session_start();

$fullName = $_SESSION["first_name"] . " " . $_SESSION["last_name"];

if (!isset($_SESSION["user_id"])) {
	unset($_SESSION["user_id"]);
	header("location: ../logout");
}

if (isset($_SESSION["user_id"])) {
	$full_name = $_SESSION["first_name"] . " " . $_SESSION["last_name"];
	$fname = substr($_SESSION["first_name"], 0,1);
	$lname = substr($_SESSION["last_name"], 0,1);
	$initials = $fname . $lname;
}

// ternary operator
// check if account type are equal to the user
$_SESSION["account_type"] == "admin" ? /* true condition */ : header("location: ../logout");
?>