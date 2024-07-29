<?php
// session section
if (session_status() === PHP_SESSION_NONE) {
 session_start();
}

unset($_SESSION['original_customer_name_length']);
?>