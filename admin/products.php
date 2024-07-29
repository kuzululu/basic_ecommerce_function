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

<div class="col-md-3 pt-md-1">
<a href="#" class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#modalAddProduct">Insert Product</a>
</div>

<div class="col-md-3 text-md-end pt-md-2">
<label class="fw-bolder">Filter:</label>
</div>
<div class="col-md-5 p-0">
<input type="search" id="filterProduct" autofocus="" class="form-control resetSearch">
</div>
<div class="col-md-1 pt-md-1">	
<a href="products" class="btn btn-outline-danger btn-sm" type="button">Reset</a>
</div>

</div>
</div>
</section>

<section id="cat-table" class="mt-md-5 mt-3">

<div class="container-fluid">
<div class="row">
<div class="col-md-12">

<div class="table-responsive" id="showDataProduct">
<table class="table table-hover">

<thead>
<tr class="text-center">
<th>No.</th>
<th>Date Entry</th>
<th>Product Name</th>
<th>Category</th>
<th>Price</th>
<th>Stock</th>
<th>Image</th>
<th>Encoded By</th>
<th>Update By</th>
<th>Status</th>
<th>Options</th>
</tr>
</thead>
<tbody>
<?php 

class RecordsView{

private $records;

public function __construct($records){
	$this->records = $records;
}

public function displayRecords(){
$ctr = 1;
$peso_sign = "\xE2\x82\xB1";
$total_amount = 0;
while ($row = $this->records->fetch_assoc()) {
	$origdate = $row["date_added"];
	$dateTime = new DateTime($origdate);
	$formatDate = $dateTime->format("M d, Y");
	
	$total_amount += $row["price"];
?>
<tr class="text-center align-middle">
	<td><?= $ctr; ?></td>
	<td><?= $formatDate; ?></td>
	<td><?= $row["product_name"]; ?></td>
	<td><?= $row["category"]; ?></td>
	<td><?= $peso_sign.number_format($row["price"]); ?></td>
	<td><?= $row["stock"]; ?></td>
	<td><a href="../upload/<?= $row['image']; ?>" target="_blank" class="text-success fw-bolder text-decoration-none"><?= shortenLinkName($row["image"]); ?></a></td>
	<td><?= $row["added_by"]; ?></td>
	<td><?= $row["update_by"]; ?></td>
	<td><?= $row["status"]; ?></td>
	<td>
						<a href="#" id="<?= $row['product_id']; ?>" type="button" class="btn btn-outline-success edit-product btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdateProduct">Update</a>
						<a href="#" id="<?= $row['product_id']; ?>" type="button" class="btn btn-outline-danger btn-sm del-product" data-bs-toggle="modal" data-bs-target="#modalDeleteProduct">Delete</a>
					</td>
</tr>
<?php
 $ctr++;
  }
?>
<tr>
	<td class="fw-bolder  text-end">Sales:</td>
	<td class="fw-bolder"><?= $peso_sign.number_format($total_amount); ?></td>
</tr>
<?php 
 }
}

$recordsManager = new ProductRecordsManager($conn);
$records = $recordsManager->getRecords();

$recordView = new RecordsView($records);
$recordView->displayRecords();
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