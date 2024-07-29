<?php

if (session_status() == PHP_SESSION_NONE) {
	session_start();
}

require_once "inc/config.php";
include("class/class.php");
require_once "inc/showalert.php";

$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
$conn = $dbConnect->connectDb();

require_once "controller/login.php";

if (isset($_SESSION["user_id"])) {
	if ($_SESSION["account_type"] == "admin") {
		header("location: admin");
	}else{
		header("location: index");
	}
}


?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "template-parts/head.php"; ?>
<body id="bodyBackground">

<section id="login" class="mt-5">
	
<div class="container">
	<div class="row">
		<div class="col-md-4"></div>
		<div class="col-md-4 p-3 animate__animated animate__fadeInDown animate__slow text-light" id="login-form">
		<h3 class="text-uppercase text-center animate__animated animate__fadeIn animate__slow animate__infinite infinite">Login</h3>
			<form class="row needs-validation p-3" method="POST" novalidate="" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
				
			<div class="col-md-12 mb-3">
				<label class="fw-bolder">Email</label>
				<div class="input-group">
					<span class="input-group-text bg-info bg-gradient"><i class="fa fa-user text-light"></i></span>
					<input type="text" autofocus="" name="emailLog" class="form-control" required="">
				</div>
			</div>

			<div class="col-md-12 mb-3">
				<label class="fw-bolder">Password</label>
			<div class="input-group">
					<span class="input-group-text bg-gradient bg-info"><i class="fa fa-lock text-light"></i></span>
			<input type="password" name="passLog" class="form-control togglePass" required="">
			<span class="input-group-text bg-dark bg-gradient toggleIcon">
				<i class="fa fa-eye-slash text-light d-none hide_eyes"></i>
				<i class="fa fa-eye text-light show_eyes"></i>
			</span>
			</div>
			</div>

			<div class="col-md-12 mt-2 text-end">
				<input type="submit" class="btn btn-primary btn-sm" name="btnLogin" value="Login"> <a href="index" class="btn btn-success btn-sm">Back</a>
			</div>

			</form>
			<div class="bg-dark">
				<p class="text-center">No Account Register <i class="fa-solid fa-arrow-right align-middle"></i> &nbsp;<a href="register" type="button" class="text-light text-decoration-none animate__animated animate__fadeIn animate__slow animate__infinite	infinite">here</a>&nbsp; <i class="fa-solid fa-arrow-left align-middle"></i></p class="text-center">
			</div>
		</div>
		<div class="col-md-4"></div>
	</div>
</div>

</section>

<?php require_once "template-parts/bottom.php"; ?>
</body>
</html>