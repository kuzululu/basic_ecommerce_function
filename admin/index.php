<?php

require_once "../inc/config.php";
require_once "../inc/adminSession.php";
include("../class/class.php");

require_once "../inc/showalert.php";

$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
$conn = $dbConnect->connectDb();

$account_type = "admin" ? : header("../logout");

?>

<!DOCTYPE html>
<html>
<?php require_once "template-parts/head.php"; ?>
<body id="adminBody">

<?php
	require_once "template-parts/navbar.php";
?>

<section class="mt-md-5 pt-md-5">
	<div class="container">
	<div class="row mb-3">
		<div class="col-md-12 text-center">
			<h2 class="text-uppercase text-info information fw-bolder animate__animated animate__headShake animate__infinite	infinite animate__slow">Information</h2>
		</div>
	</div>

		<div class="row">

			<div class="col-md-4 border bg-gradient bg-success text-light text-center p-md-4 p-3">
				<h4>Delivered</h4>
			<?php
					$total_delivered = new TotalNumRows($conn);
					$total = $total_delivered->getTotalDelivered();
					echo "<h4>".$total."</h4>";
				?>
			</div>

			<div class="col-md-4 border bg-gradient bg-danger text-light text-center p-md-4 p-3">
				<h4>Cancelled</h4>
			<?php
					$total_cancel = 	new TotalNumRows($conn);
					$total = $total_cancel->getTotalCancel();
					echo "<h4>".$total."</h4>";
				?>
			</div>

			<div class="col-md-4 border bg-gradient bg-secondary text-light text-center p-md-4 p-3">
				<h4>Pending</h4>
				<?php
					$total_pending = 	new TotalNumRows($conn);
					$total = $total_pending->getTotalPending();
					echo "<h4>".$total."</h4>";
				?>
			</div>

		</div> <!-- end of row -->

		<div class="row mt-3">
		<div class="col-md-4 border bg-gradient bg-primary text-light text-center p-md-4 p-3">
				<h4>Users</h4>
			<?php
					$total_users = 	new TotalNumRows($conn);
					$total = $total_users->getTotalUsers();
					echo "<h4>".$total."</h4>";
				?>
			</div>

			<div class="col-md-4 border bg-gradient bg-dark text-light text-center p-md-4 p-3">
				<h4>Shipped Out</h4>
				<?php
					$total_delivery = 	new TotalNumRows($conn);
					$total = $total_delivery->getTotalDelivery();
					echo "<h4>".$total."</h4>";
				?>
			</div>

			<div class="col-md-4 border bg-gradient bg-warning text-center p-md-4 p-3">
				<h4>Delivery</h4>
			<?php
					$total_shipped = 	new TotalNumRows($conn);
					$total = $total_shipped->getTotalShipped();
					echo "<h4>".$total."</h4>";
				?>
			</div>

		</div> <!-- end of row -->

		<div class="row mt-3">
			 	<div class="col-md-6 p-md-4 border bg-gradient bg-dark text-light p-3 text-center">
				<h4>Transactions</h4>
				<?php
					$total_records = 	new TotalNumRows($conn);
					$total = $total_records->getTotalTransactions();
					echo "<h4>".$total."</h4>";
				?>
			</div>

		<div class="col-md-6 p-md-4 border bg-gradient bg-info p-3 text-center">
			<h4>Earnings</h4>
			<?php
					class ViewEarnings{
						private $row;

						public function __construct($row){
							$this->row = $row;
						}

						public function displayEarnings(){
							$peso_sign = "\xE2\x82\xB1";
							$total_earnings = 0;
							while ($earnings = $this->row->fetch_assoc()) {
								$total_earnings += $earnings["sub_total"];
							} ?>
					<h4><?= $peso_sign.number_format($total_earnings) ?></h4>
					<?php	
						}
					}

					$recodsEarnings = new TotalNumRows($conn);
						$records = $recodsEarnings->getTotalEarnings();
						$view = new ViewEarnings($records);
						$view->displayEarnings();
				?>
			</div>
		</div>
	</div> <!-- end of column -->
</section>

<?php require_once "template-parts/bottom.php"; ?>
</body>
</html>