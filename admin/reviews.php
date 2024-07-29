<?php

require_once "../inc/config.php";
require_once "../inc/adminSession.php";
include("../class/class.php");
require_once "../inc/showalert.php";
require_once "../inc/shortLink.php";

$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
$conn = $dbConnect->connectDb();

$account_type = "admin" ? : header("../logout");

require_once "controller/review.php";

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

<div class="row mb-3">
<div class="col-md-12">

<div class="table-responsive">
<table class="table table-hover" id="showDataCheckout">
	<thead>
		<tr class="text-center align-middle">
			<th>No.</th>
			<th>Customer Name</th>
			<th>Feedback</th>
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
		while ($row = $this->query->fetch_assoc()) { ?>
			
		<tr class="text-center align-middle"> 
			<td><?= $ctr; ?></td>
			<td><?= $row["customer_name"] ?></td>
			<td><?= $row["feedback"] ?></td>
			<td><?= $row["status"] ?></td>
			<td>
				<a href="#" id="<?= $row['review_id'] ?>" class="btn btn-outline-success btn-sm edit_reviewId" data-bs-toggle="modal" data-bs-target="#modalUpdateClientStatusReview">Update</a>
			</td>
		</tr>

	<?php		
	$ctr++;
		}
	}
}

$recordsManager = new ReviewAdmin($conn);
$records = $recordsManager->reviews();

$view = new ViewRecords($records);
$view->displayRecords();

?>
	</tbody>
</table>
</div>

</div>
</div>

</div> <!-- end of container -->

</section>


<?php require_once "template-parts/bottom.php"; ?>
</body>
</html>