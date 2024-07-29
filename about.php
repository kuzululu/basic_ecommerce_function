<?php

if (session_status() === PHP_SESSION_NONE) {
 session_start();

 require_once "inc/config.php";
 require_once "inc/session.php";
 include("class/class.php");
 require_once "inc/showalert.php";
}

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



<section id="about">

<div class="container-fluid bg-success bg-gradient">
	<div class="row p-md-5 text-light">
		
	<div class="col-md-8 mt-4 pt-3 pt-md-5 mt-md-5">
		<h1>About Us</h1>
		<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
		tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
		quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
		consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse
		cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non
		proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
	</div>

	<div class="col-md-4">
		<img src="images/about/about-hero.svg">
	</div>

	</div>
</div>
	
</section>

<section id="service" class="mt-md-5 mt-3 pt-md-5 pt-3 mb-5">
	
<div class="container">

	<div class="row">
		<h1 class="text-center text-uppercase text-muted">Our Service</h1>
		<h5 class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod Lorem ipsum dolor sit amet.</h5>
	</div>

	<div class="row mt-md-5 mt-3">
		
	<div class="col-md-3 mb-md-0 mb-4">
		<div class="p-md-4 p-4 shadow-lg">
			<h1 class="text-center"><i class="fa-solid fa-truck text-success"></i></h1>
			<h3 class="text-center text-muted">Delivery Services</h3>
		</div>
	</div>

	<div class="col-md-3 mb-md-0 mb-4">
		<div class="p-md-2 p-4 shadow-lg">
			<h1 class="text-center"><i class="fa-solid fa-arrows-left-right-to-line text-success"></i></h1>
			<h3 class="text-center text-muted">Shipping and Return</h3>
		</div>
	</div>

		<div class="col-md-3 mb-md-0 mb-4">
		<div class="p-md-4 p-4 shadow-lg">
			<h1 class="text-center"><i class="fa-solid fa-percent text-success"></i></h1>
			<h3 class="text-center text-muted">Promotion</h3>
		</div>
	</div>

	<div class="col-md-3 mb-md-0 mb-4">
		<div class="pe-md-2 ps-md-2 p-4 shadow-lg">
			<h1 class="text-center"><i class="fa-solid fa-headphones text-success"></i></h1>
			<h3 class="text-center text-muted">Customer Services</h3>
		</div>
	</div>

	</div>
</div>

</section>

<button class="btn btn-dark bnt-lg rounded-circle" id="btnScrollToTop"><i class="fa-solid fa-chevron-up"></i></button>

<?php require_once "template-parts/bottom.php"; ?>
</body>
</html>
