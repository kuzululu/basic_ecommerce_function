<?php

require_once "../inc/config.php";
require_once "../inc/adminSession.php";
include("../class/class.php");
require_once "../inc/showalert.php";
require_once "../inc/shortLink.php";

$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
$conn = $dbConnect->connectDb();

$account_type = "admin" ? : header("../logout");

require_once "controller/product.php";

?>

<!DOCTYPE html>
<html>
<?php require_once "template-parts/head.php"; ?>
<body>

<?php
require_once "template-parts/navbar.php";
require_once "modal/modal.php";
?>

<section id="category" class="mt-5 pt-2">
<div class="container mt-5">

<div class="row">
	<div class="col-md-12">
		<h2 class="text-center text-muted fw-bolder text-uppercase animate__animated animate__fadeIn animate__infinite	infinite animate__slow">Reports</h2>
	</div>
</div>

<div class="row">
	<div class="col-md-3">
		<label class="fw-bolder">From date:</label>
		<input type="search" name="from_date" id="from_date" class="form-control">
	</div>
	<div class="col-md-3">
		<label class="fw-bolder">To date:</label>
		<input type="search" name="to_date" id="to_date" class="form-control">
	</div >
	<div class="col-md-5 pt-md-4 ps-md-0">
		<input type="button" id="filterDate" value="Filter" class="btn btn-outline-primary btn-sm"> <a href="reports" class="btn btn-outline-danger btn-sm">Reset</a>
	</div>
</div>
</div>
</section>

<section class="mt-md-5 mt-3">

<div class="container-fluid">
<div class="row">
<div class="col-md-12">

<div class="table-responsive" id="showReports">
<table class="table table-hover">

<thead>
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
		<td><?= $peso_sign.number_format($row["price"]) ?></td>
		<td><?= $peso_sign.number_format($row["sub_total"]) ?></td>
		<td><img class="img-fluid" width="100" height="50" src="../upload/<?= $row["image"] ?>"></td>
		<td><?= $row["payment_method"] ?></td>
		<td><?= $row["status"] ?></td>
	</tr>
<?php
$ctr++;
  }
?>
	<tr class="align-middle">
		<td class="fw-bolder text-end" colspan="2">Total Order:</td>
		<td class="text-center fw-bolder text-success"><?= $peso_sign.number_format($total_price) ?></td>
	</tr>
<?php
 }
}

$recordsManager = new CheckoutsAdminPerNameManager($conn);
$records = $recordsManager->reports();

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


<?php require_once "template-parts/bottom.php"; ?>
</body>
</html>