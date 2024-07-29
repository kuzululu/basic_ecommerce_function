<?php

if (session_status() === PHP_SESSION_NONE) {
 session_start();
}

 require_once "inc/config.php";
 require_once "inc/session.php";
 include("class/class.php");
 require_once "inc/showalert.php";

 if (isset($_SESSION["user_id"])) {
	if ($_SESSION["account_type"] == "admin") {
		header("location: admin");
	}
}


$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
$conn = $dbConnect->connectDb();

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "template-parts/head.php"; ?>
<body>

<?php 
	require_once "template-parts/navbar.php";
	require_once "inc/welcome-msg.php";
?>

<section id="contact" class="mt-md-5 mt-3 pb-md-5">
	<div class="container-fluid p-md-5  p-3">
		<div class="row">
			<div class="col-md-12 pb-md-5">
				<h1 class="text-muted text-center text-uppercase">Contact Us</h1>
			<h5 class="text-center">Proident, sunt in culpa qui officia deserunt mollit anim id est laborum. Lorem ipsum dolor sit amet.</h5>
		</div>
	</div>
	</div>
</section>

<section>
	<div class="container-fluid"> 
		<div class="row">
			<div class="col-md-12 p-0">
				<?php require_once "template-parts/maps.php"; ?>
			</div>
		</div>
	</div>
</section>

<section id="form-map">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				
			<form class="row needs-validation" method="POST" novalidate="" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
				
			</form>

			</div>
		</div>
	</div>
</section>

<button class="btn btn-dark bnt-lg rounded-circle" id="btnScrollToTop"><i class="fa-solid fa-chevron-up"></i></button>

<?php require_once "template-parts/bottom.php"; ?>
</body>
</html>
