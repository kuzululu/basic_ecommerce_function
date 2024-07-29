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

if (!isset($_SESSION["user_id"])) {
header("location: login");
}

$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
$conn = $dbConnect->connectDb();

require_once "controller/reviews.php";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "template-parts/head.php"; ?>
<body>

<?php 
require_once "template-parts/dashboard-nav.php"; 
require_once "inc/welcome-msg.php";
require_once "modal/modal.php";
?>

<section id="checkouts" class="mt-5">
<div class="container-fluid">

<div class="row">
<div class="col-md-12">
<h1 class="text-center fw-bolder text-uppercase">Reviews</h1>
</div>
</div>

<div class="row">
<div class="col-md-3 mb-3">
<a href="#" class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#modalInsertComment">Insert Comment</a>
</div>

<div class="col-md-8 d-md-flex mb-3">
<label class="fw-bolder pt-md-2 me-md-2">Filter:</label>
<input type="search" id="filterComment" class="form-control resetSearch">
</div>

<div class="col-md-1 mb-3 ps-md-0">
<div class="pt-md-1">
	<a href="reviews" type="button" class="btn btn-outline-danger btn-sm">Reset</a>
</div>
</div>

</div>
<hr>

<div class="row mb-3">
<div class="col-md-12">

<div class="table-responsive">
<table class="table table-hover" id="showDataCheckout">
<thead>
<tr class="text-center align-middle">
<th>No.</th>
<th>Customer Name</th>
<th>Feedback</th>
<th>Options</th>
</tr>
</thead>
<tbody>
<?php

class ViewRecords{
private $query;

public function __construct($query){
$this->query = $query;
}

public function displayRecords(){
$ctr = 1;
while ($row = $this->query->fetch_assoc()) { ?>

<tr class="text-center align-middle"> 
<td><?= $ctr; ?></td>
<td><?= $row["customer_name"] ?></td>
<td><?= $row["feedback"] ?></td>
<td>
	<a href="#" id="<?= $row['review_id'] ?>" class="btn btn-outline-danger btn-sm del_reviewId" type="button" data-bs-toggle="modal" data-bs-target="#modalDeleteReview">Delete</a>
</td>
</tr>

<?php		
$ctr++;
}
}
}

$recordsManager = new ReviewClients($conn);
$records = $recordsManager->reviews();

$view = new ViewRecords($records);
$view->displayRecords();

?>
</tbody>
</table>
</div>

</div>
</div>

</div>
</section>

<button class="btn btn-dark bnt-lg rounded-circle" id="btnScrollToTop"><i class="fa-solid fa-chevron-up"></i></button>

<?php require_once "template-parts/bottom.php"; ?>
</body>
</html>