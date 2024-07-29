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

// Check if customer_name exists in the request
// $customer_request_id = urldecode(base64_decode($_REQUEST["customer_id"]));
$customer_request_id = $_REQUEST["customer_id"];

if (empty($customer_request_id)) {
	header("location: ../logout");
	// echo "empty</script>";
}

if (!isset($customer_request_id)) {
 header("location: ../logout");	
	// echo "not set</script>";
}

// Store the original length in the session if it's not already set
if (!isset($_SESSION['original_customer_name_length'])) {
   $_SESSION['original_customer_name_length'] = strlen($customer_request_id);
}

// Check if the length has changed
$current_length = strlen($customer_request_id);

// Debugging output
// echo "Original Length: " . $_SESSION['original_customer_name_length'] . "<br>";
// echo "Current Length: " . $current_length . "<br>";


// compare the variable to the session variable
if ($current_length !== $_SESSION["original_customer_name_length"]) {
	header("location: ../logout");
	// echo "not equal";
}

?>

<!DOCTYPE html>
<html>
<?php require_once "template-parts/head.php"; ?>
<body>

<?php
require_once "template-parts/special-nav.php";
require_once "modal/modal.php";
?>

<section class="mt-5 pt-2">
<div class="container-fluid mt-5">
<div class="row">

<div class="col-md-1 text-md-end pt-md-2">
<label class="fw-bolder">Filter:</label>
</div>
<div class="col-md-5 p-0">
<input type="search" id="filterperNameAdminCheckout" autofocus="" class="form-control resetSearch">
<input type="hidden" id="customerId" value="<?php echo isset($_REQUEST['customer_id']) ? urldecode(base64_decode($_REQUEST['customer_id'])) : ''; ?>">

</div>
<div class="col-md-5 pt-md-1 mt-md-0 mt-3">	
<a href="checkout_per_name?customer_id=<?= $customer_request_id ?>" class="btn btn-outline-danger btn-sm" type="button">Reset</a> <a type="button" class="btn btn-outline-primary btn-sm destroyCustomerNameLeghtSession">Back</a>
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

<div class="table-responsive" id="showDatasCheckout">
<table class="table table-hover">
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
							<th>Options</th>
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
		<td>
			<a href="#" id="<?= $row['checkout_id'] ?>" class="btn btn-outline-primary btn-sm edit-checkout" data-bs-toggle="modal" data-bs-target="#modalCheckUpdate">Update</a>
		</td>
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

$recordsManager = new CheckoutsAdminPerNameManager($conn);
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

<script type="text/javascript">
	// clear length session after clicking the button
	document.addEventListener("DOMContentLoaded", function() {
    let backButton = document.querySelector	(".destroyCustomerNameLeghtSession");
    
    backButton.addEventListener("click", function(event) {
        // Make an AJAX request to clear the session data
        fetch('clear_sessions.php')
            .then(response => response.text())
            .then(data => {
                console.log(data); // Optional: Log the response
                // Proceed with the back button action
                window.location.href = "checkouts";
            })
            .catch(error => console.error('Error:', error));
    });
});
</script>
</body>
</html>