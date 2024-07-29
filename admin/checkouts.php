<?php

require_once "../inc/config.php";
require_once "../inc/adminSession.php";
include("../class/class.php");
require_once "../inc/showalert.php";
require_once "../inc/shortLink.php";

$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
$conn = $dbConnect->connectDb();

$account_type = "admin" ? : header("../logout");

require_once "controller/checkout.php";
?>

<!DOCTYPE html>
<html>
<?php require_once "template-parts/head.php"; ?>
<body>

<?php
require_once "template-parts/navbar.php";
require_once "modal/modal.php";
?>

<section class="mt-5 pt-2">
<div class="container-fluid mt-5">
<div class="row">

<div class="col-md-1 text-md-end pt-md-2">
<label class="fw-bolder">Filter:</label>
</div>
<div class="col-md-5 p-0">
<input type="search" id="filterAdminCheckout" autofocus="" class="form-control resetSearch">
</div>
<div class="col-md-1 pt-md-1">	
<a href="checkouts" class="btn btn-outline-danger btn-sm" type="button">Reset</a>
</div>

</div>
</div>
</section>

<section class="mt-md-5 mt-3">

<div class="container-fluid">

<div class="row">
	<div class="col-md-12 text-center">
		<h2 class="text-primary fw-bolder text-uppercase">Checkout Information</h2>
	</div>
</div>

<div class="row">
<div class="col-md-12">

<div class="table-responsive" id="showDataCheckout">
<table class="table table-hover">
					<thead>
						<tr class="text-center align-middle">
							<th>No.</th>
							<th>Date Order</th>
							<th>Customer Name</th>
							<th>Address</th>
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
		<td><a href="checkout_per_name?customer_id=<?= urlencode(base64_encode($row['customer_id'])) ?>"><?= $row["customer_name"] ?></a></td>
		<td><?= $row["address"] ?></td>
	</tr>
<?php
$ctr++;
  }
 }
}

$recordsManager = new CheckoutsAdminManager($conn);
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


<?php require_once "template-parts/bottom.php"; ?>
</body>
</html>