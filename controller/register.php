<?php

if (isset($_POST["btnRegister"])) {
	$insert = new UserRegistration($conn);

	$register = $insert->register($_POST["first_name"], $_POST["middle_name"], $_POST["last_name"], $_POST["email"], $_POST["password"], $_POST["address"], $_POST["date_register"], $_POST["account_status"], $_POST["contact"], $_POST["account_type"]);
}

$dbConnect->closeConnection();

?>