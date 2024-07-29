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

 if (!isset($_SESSION["user_id"])) {
 	// showAlertNotification();
 	header("location: login");
 }

$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
$conn = $dbConnect->connectDb();

require_once "controller/cart.php";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "template-parts/head.php"; ?>
<body>

<?php 
	require_once "template-parts/navbar.php"; 
	require_once "inc/welcome-msg.php";
	require_once "modal/modal.php";
?>

<section id="cart" class="mt-2">
	<div class="container-fluid">

	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center fw-bolder text-uppercase">Cart</h1>
		</div>
	</div>

	<div class="row mb-3">
		<div class="col-md-1 text-md-end">
			<label class="fw-bolder pt-md-2">Filter:</label>
		</div>
		<div class="col-md-4 ps-md-0">
			<input type="search" id="filterCart" class="form-control resetSearch">
		</div>
	</div>

		<div class="row mb-3">
			<div class="table-responsive" id="showDataCart">
				<table class="table table-condensed">
					<thead>
						<tr class="text-center">
							<th>No.</th>
							<th>Date Order</th>
							<th>Customer Name</th>
							<th>Address</th>
							<th>Item</th>
							<th>Image</th>
							<th>Price</th>
							<th>Qty</th>
							<th>Sub Total</th>
							<th>Status</th>
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
		$peso_sign = "\xE2\x82\xB1";
		$total_price = 0;
		while ($row = $this->query->fetch_assoc()) {
		$origDateOrder = $row["date_order"];
		$dateTime = new DateTime($origDateOrder);
		$formatDateOrder = $dateTime->format("M d, Y");
		$total_price += $row["sub_total"];
?>
					<tr class="text-center align-middle">
						<td><?= $ctr ?></td>
						<td><?= $formatDateOrder ?></td>
						<td><?= $row["customer_name"] ?></td>
						<td><?= $row["customer_add"] ?></td>
						<td><?= $row["item"] ?></td>
						<td><img src="upload/<?= $row['image'] ?>" class="img-fluid" width="100" height="50"></td>
						<td><?= $peso_sign.number_format($row["price"]) ?></td>
						<td><?= number_format($row["qty"]) ?></td>
						<td><?= $peso_sign.number_format($row["sub_total"]) ?></td>
						<td><?= $row["status"] ?></td>
						<td><a href="#" id="<?= $row['order_id'] ?>" class="btn btn-outline-danger btn-sm cancel-order" type="button" data-bs-toggle="modal" data-bs-target="#modalCartCancel">Cancel</a></td>
					</tr>
<?php
$ctr++;
    		}
?>
	<tr class="align-middle">
		<td class="fw-bolder text-end">Total Price:</td>
		<td class="text-center fw-bolder"><?= $peso_sign.number_format($total_price) ?></td>
	</tr>
<?php
 	}
}

$recordsManger = new CartRecordsManager($conn);
$records = $recordsManger->records();

$recordView = new ViewRecords($records);
$recordView->displayRecords();

?>
					</tbody>
				</table>
			</div>		
		</div>

<div class="row">
	<div class="col-md-12">
		<form method="POST" class="needs-validation" novalidate="" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>">
			<div class="col-md-12 text-md-end">
				<?php
						class FormRecords{
						private $query;

						public function __construct($query){
							$this->query = $query;	
						}

						public function displayItem(){
							while ($row = $this->query->fetch_assoc()) {
?>
				<input type="hidden" name="order_id[]" value="<?= $row['order_id'] ?>">
				<input type="hidden" name="date_order[]" value="<?= $row['date_order'] ?>">
				<input type="hidden" name="product_id[]" value="<?= $row['product_id']?>">
				<input type="hidden" name="customer_id[]" value="<?= $_SESSION['user_id'] ?>">
				<input type="hidden" name="customer_name[]" value="<?= $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>">	
				<input type="hidden" name="customer_add[]" value="<?= $_SESSION['user_add'] ?>">
				<input type="hidden" name="customer_item[]" value="<?= $row['item']?>">
				<input type="hidden" name="customer_img[]" value="<?= $row['image'] ?>">
				<input type="hidden" name="customer_price[]" value="<?= $row['price'] ?>">
				<input type="hidden" name="customer_qty[]" value="<?= $row['qty'] ?>">
				<input type="hidden" name="customer_subtotal[]" value="<?= $row['sub_total'] ?>">
				<input type="hidden" name="customer_stats[]" value="<?= $row['status'] ?>">
				<?php		
								}
							}
					}

					$recordsCartItem = new CartRecordsManager($conn);
					$recordsItem = $recordsCartItem->records();

					$recordView = new FormRecords($recordsItem);
					$recordView->displayItem();
				?>
				<input type="hidden" name="payment_method" value="COD">
				<input type="submit" name="btnCheckout" class="btn btn-outline-success btn-sm" value="CheckOut">
			</div>
		</form>
	</div>
</div>		

	</div>
</section>

<button class="btn btn-dark bnt-lg rounded-circle" id="btnScrollToTop"><i class="fa-solid fa-chevron-up"></i></button>

<?php require_once "template-parts/bottom.php"; ?>
</body>
</html>