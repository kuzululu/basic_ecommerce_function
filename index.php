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


<?php 
require_once "template-parts/carousel.php";
?>

<section id="categories" class="mt-5 mb-5">
<div class="container">

<div class="row">
<div class="col-md-12">
<h1 class="text-center fw-bolder text-uppercase">Categories</h1>
</div>
</div>

<div class="row">
<?php
class ViewCategory{

private $get;

public function __construct($get){
$this->get = $get;
}

public function displayView(){
while ($row = $this->get->fetch_assoc()) {
?>		 
<div class="col-md-4">
	<h3 class="text-center mt-3"><?= $row["category"]; ?></h3>
	<div class="pe-5 ps-5">
		<center><img src="upload/<?= $row['image']; ?>" class="border border-success border-2 img-fluid"></center>
	</div>
</div>
<?php
}
}
}

$recordCategoryManager = new DisplayCatetoryManager($conn);
$records = $recordCategoryManager->displayCategories();
$recorView = new ViewCategory($records);
$recorView->displayView();
?>
</div>

</div>
</section>
<hr>
<section id="products" class="mt-5">
<div class="container">

<div class="row">
<div class="col-md-12">
<h1 class="text-center fw-bolder text-uppercase">Products</h1>
</div>
</div>

<div class="row mb-3">

<?php 
class ViewDisplay{

private $get_shoes;

public function __construct($get_shoes){
$this->get_shoes = $get_shoes;
}

public function display(){
while ($row = $this->get_shoes->fetch_assoc()) {
?>

<div class="col-md-4 mb-5">
	<div class="pe-5 ps-5">
	<center>	<img src="upload/<?= $row['image']; ?>" class="border border-success border-2 img-fluid"></center>
	</div>
	<h3 class="text-center mt-3"><?= $row["product_name"]; ?></h3>
	<div class="text-center">
		<a href="shop" class="btn btn-outline-success btn-lg">Shop</a>
	</div>
</div>	
<?php 
}
}
}

$recordsManger = new DisplayProductManager($conn);
$records = $recordsManger->displayProducts();
$recorView = new ViewDisplay($records);
$recorView->display();
?>
</div>

</div>
</section>

<section id="featured">
<div class="container pt-5 mt-5">

<div class="row">
<div class="col-md-12">
	<h1 class="text-center fw-bolder text-muted text-uppercase">Featured Product</h1>
</div>
</div>

<div class="row">
<div class="col-md-3"></div>
<div class="col-md-6">
	<h5 class="text-center">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
	tempor incididunt ut labore et</h5>
</div>
<div class="col-md-3"></div>
</div>

<div class="row mt-5">
<div class="col-md-4 mb-3">
	<div class="card">
		<img src="images/featured/feature_prod_01.jpg" class="img-fluid card-img-top">
		<div class="card-body">
			<h2 class="text-success">Featured 1</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</p>

			<label>Reviews 25</label>
		</div>
	</div>
</div>

<div class="col-md-4 mb-3">
	<div class="card">
		<img src="images/featured/feature_prod_02.jpg" class="img-fluid card-img-top">
		<div class="card-body">
			<h2 class="text-success">Featured 1</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</p>

			<label>Reviews 25</label>
		</div>
 </div>
</div>

<div class="col-md-4 mb-3">
	<div class="card">
		<img src="images/featured/feature_prod_03.jpg" class="img-fluid card-img-top">
		<div class="card-body">
			<h2 class="text-success">Featured 1</h2>
			<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
			tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim</p>

			<label>Reviews 25</label>
		</div>
 </div>
</div>

</div>

</div>
</section>


<section id="reviews" class="mt-md-5 mt-3 mb-md-5">
<div class="container">

<div class="row mb-md-3 mb-2">
<div class="col-md-12">
<h1 class="text-center text-uppercase">Reviews</h1>
</div>
</div>

<div class="row">
<div class="col-md-12">

<div id="review_slider" class="carousel carousel-dark slide" data-bs-ride="carousel">

<div class="carousel-inner">

<?php
// use prepared statement to optimized the loop usually use in carousels
class ViewReviewVerified{
private $rev_verified;

public function __construct($rev_verified){
	$this->rev_verified = $rev_verified;
}

public function displayReview(){
$isActive = true;

while ($row = $this->rev_verified->fetch_assoc()) { 
$activeClass = $isActive ? "active" : "";
$isActive = false;
?>
		
<div class="carousel-item <?= $activeClass ?>" data-bs-interval="3000">
<div class="bg-white">
<center><h1 class="text-warning fs-1 fas fa-quote-right mb-md-3 mb-1"></h1></center>
	<h2 class="text-primary text-center fw-bolder"><?= $row["customer_name"] ?></h2>
	<hr>
	<h4 class="text-center"><?= $row["feedback"] ?></h4>
</div>
</div>

<?php			
	}
}
}
$reviewManager = new ReviewClients($conn);
$reviewRecords = $reviewManager->reviewVerified();
$reviewView = new ViewReviewVerified($reviewRecords);
$reviewView->displayReview();
?>

<button class="carousel-control-prev" type="button" data-bs-target="#review_slider" data-bs-slide="prev">
<span class="carousel-control-prev-icon" aria-hidden="true"></span>
</button>

<button class="carousel-control-next" type="button" data-bs-target="#review_slider" data-bs-slide="next">
<span class="carousel-control-next-icon" aria-hidden="true"></span>
</button>

</div>

</div>

<!-- end of carousel -->
	
</div>
</div>
</div>
</section>

<button class="btn btn-dark bnt-lg rounded-circle" id="btnScrollToTop"><i class="fa-solid fa-chevron-up"></i></button>

<?php require_once "template-parts/bottom.php"; ?>
</body>
</html>