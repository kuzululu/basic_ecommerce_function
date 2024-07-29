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

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "template-parts/head.php"; ?>
<body>

<?php 
	require_once "template-parts/dashboard-nav.php"; 
	require_once "inc/welcome-msg.php";
?>

<section id="checkouts" class="mt-5">
	<div class="container-fluid">

	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center fw-bolder text-uppercase">Checkouts</h1>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-md-1 text-md-end">
			<label class="fw-bolder pt-md-2">Filter:</label>
		</div>
		<div class="col-md-4 ps-md-0">
			<input type="search" id="filterCheckout" class="form-control resetSearch">
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
							<th>Date Order</th>
							<th>Customer Name</th>
							<th>Address</th>
							<th>Item</th>
							<th>QTY</th>
							<th>Price</th>
							<th>Sub Total</th>
							<th>Image</th>
							<th>Payment Method</th>
							<th>Status</th>
						</tr>
					</thead>
					<tbody>
<?php
class ViewRecords{
private $get;

public function __construct($get){
	$this->get = $get;
}

public function displayRecords(){
$ctr = 1;
$peso_sign = "\xE2\x82\xB1";
$total_price = 0;
while ($row = $this->get->fetch_assoc()) {
	$oridDateOrder = $row["date_order"];
	$dateTime = new DateTime($oridDateOrder);
	$formatDate = $dateTime->format("M d, Y");
	$total_price += $row["sub_total"];
?>
	<tr class="text-center align-middle">
		<td><?= $ctr ?></td>
		<td><?= $formatDate ?></td>	
		<td><?= $row["customer_name"] ?></td>
		<td><?= $row["address"] ?></td>
		<td><?= $row["item"] ?></td>
		<td><?= $row["qty"] ?></td>
		<td><?= $row["price"] ?></td>
		<td><?= $row["sub_total"] ?></td>
		<td><img  class="img-fluid" width="100" height="50" src="upload/<?= $row["image"] ?>"></td>
		<td><?= $row["payment_method"] ?></td>
		<td><?= $row["status"] ?></td>
	</tr>
<?php
$ctr++;
  }
?>
	<tr class="align-middle">
		<td class="fw-bolder text-end">Total Order:</td>
		<td class="text-center fw-bolder text-success"><?= $peso_sign.number_format($total_price) ?></td>
	</tr>
<?php
 }
}

$recordsManager = new CheckoutsManager($conn);
$records = $recordsManager->records();

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