<?php

if (isset($_SESSION["user_id"])) {
	$full_name = $_SESSION["first_name"] . " " . $_SESSION["last_name"];
	$first_initials = substr($_SESSION["first_name"], 0,1);
	$last_initials = substr($_SESSION["last_name"], 0,1);
	$initials = $first_initials . $last_initials;
}


?>