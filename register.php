<?php

if (session_status() === PHP_SESSION_NONE) {
	session_start();
}

if (isset($_SESSION["user_id"])) {
	if ($_SESSION["account_type"] == "admin") {
		header("location: admin");
	}else{
		header("location: index");
	}
}


require_once "inc/config.php";
include("class/class.php");
require_once "inc/showalert.php";

$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
$conn = $dbConnect->connectDb();

require_once "controller/register.php";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "template-parts/head.php"; ?>
<body id="bodyBackground">


<section id="register" class="mt-5">
	
<div class="container">
<div class="row">
	<div class="col-md-2"></div>
	<div class="col-md-8 mt-5 p-3 text-light animate__animated animate__zoomIn animate__slow" id="register-form">
	<h3 class="text-center text-uppercase animate__animated animate__fadeIn animate__slow animate__infinite infinite">Registration</h3>
		<form class="row needs-validation" novalidate="" method="POST" action="<?php htmlspecialchars($_SERVER['PHP_SELF']); ?>">

		<input type="hidden" name="date_register" value="<?= date('m/d/Y'); ?>">
		<input type="hidden" name="account_status" value="Active">
		<input type="hidden" name="account_type" value="user">
			
		<div class="col-md-4 mb-3">
			<label class="fw-bolder">First Name</label>
			<div class="input-group">
				<span class="input-group-text bg-info bg-gradient"><i class="fa fa-user text-light"></i></span>
				<input type="text" name="first_name" class="form-control" required="">
			</div>
		</div>

		<div class="col-md-4 mb-3">
			<label class="fw-bolder">Middle Name</label>
			<div class="input-group">
				<span class="input-group-text bg-info bg-gradient"><i class="fa fa-user text-light"></i></span>
				<input type="text" name="middle_name" class="form-control" required="">
			</div>
		</div>

		<div class="col-md-4 mb-3">
			<label class="fw-bolder">Last Name</label>
			<div class="input-group">
				<span class="input-group-text bg-info bg-gradient"><i class="fa fa-user text-light"></i></span>
				<input type="text" name="last_name" class="form-control" required="">
			</div>
		</div>

		<div class="col-md-4 mb-3">
			<label class="fw-bolder">Email</label>
			<div class="input-group">
				<span class="input-group-text bg-info bg-gradient"><i class="fa fa-envelope text-light"></i></span>
				<input type="email" name="email" class="form-control" required="">
			</div>
		</div>

		<div class="col-md-4 mb-3">
			<label class="fw-bolder">Password</label>
			<div class="input-group">
					<span class="input-group-text bg-gradient bg-info"><i class="fa fa-lock text-light"></i></span>
			<input type="password" name="password" class="form-control togglePass" pattern="^(?=.*[A-Z]).{8,}$" required="">
			<span class="input-group-text bg-dark bg-gradient toggleIcon">
				<i class="fa fa-eye-slash text-light d-none hide_eyes"></i>
				<i class="fa fa-eye text-light show_eyes"></i>
			</span>
			</div>
		</div>

		<div class="col-md-4 mb-3">
			<label class="fw-bolder">Contact</label>
			<div class="input-group">
				<span class="input-group-text bg-info"><i class="fa fa-phone-alt text-light"></i></span>
				<input type="number" class="form-control number" name="contact" required="" value="0" minlength="8" maxlength="11" min="0" step="1" oninput="validateNumber(this)">
				<script type="text/javascript">
					// prevent negative value
					let validateNumber = (input) =>{
						if (input.value < 0) {
							input.value = 0;
						}
					}
				</script>
			</div>
		</div>

		<div class="col-md-12 mb-3">
			<label class="fw-bolder">Address</label>
			<div class="input-group">
				<span class="input-group-text bg-info bg-gradient"><i class="fa fa-house text-light"></i></span>
				<input type="text" name="address" class="form-control" required="">
			</div>
		</div>

		<div class="col-md-12 text-end">
			<input type="submit" class="btn btn-dark btn-sm" value="Register" name="btnRegister"> <a href="index" type="button" class="btn btn-danger btn-sm">Back</a>
		</div>

		</form>
	</div>
	<div class="col-md-2"></div>
</div>
</div>

</section>

<?php require_once "template-parts/bottom.php"; ?>
</body>
</html>