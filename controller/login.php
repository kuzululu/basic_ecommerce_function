<?php

if (isset($_POST["btnLogin"])) {
	
	$email = new LoginUser($conn);

	$result = $email->login($conn, $_POST["emailLog"], $_POST["passLog"]);

	if ($result) {
			showAlertLoginError($result);
	}
}

$dbConnect->closeConnection();

?>