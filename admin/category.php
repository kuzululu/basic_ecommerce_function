<?php

require_once "../inc/config.php";
require_once "../inc/adminSession.php";
include("../class/class.php");
require_once "../inc/showalert.php";

$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
$conn = $dbConnect->connectDb();

$account_type = "admin" ? : header("../logout");

require_once "controller/category.php";

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
				<a href="#" class="btn btn-outline-primary btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#modalAddCatogory">Insert Category</a>
			</div>

			<div class="col-md-3 text-md-end pt-md-2">
				<label class="fw-bolder">Filter:</label>
			</div>
			<div class="col-md-5 p-0">
				<input type="search" id="filterCategory" class="form-control resetSearch">
			</div>
			<div class="col-md-1 pt-md-1">	
			<a href="index" class="btn btn-outline-danger btn-sm" type="button">Reset</a>
			</div>

		</div>
	</div>
</section>

<section id="cat-table" class="mt-md-5 mt-3">
	
<div class="container-fluid">
	<div class="row">
		<div class="col-md-12">
			
		<div class="table-responsive" id="showDataCategory">
			<table class="table table-hover">
				
			<thead>
				<tr class="text-center">
					<th>No.</th>
					<th>Date Entry</th>
					<th>Category Name</th>
					<th>Encoded By</th>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>

<?php
	
	class RecordView{

	private $records;

	public function __construct($records){
		$this->records = $records;
	}

	public function displayRecords(){
	$ctr = 1;
	while ($row = $this->records->fetch_assoc()) {
		$origdate = $row["date_add"];
		$dateTime = new DateTime($origdate);
		$formatDate = $dateTime->format("M d, Y");
?>
			<tr class="text-center align-middle">
					<td><?= $ctr; ?></td>
					<td><?= $formatDate; ?></td>
					<td><?= $row["category_name"]; ?></td>
					<td><?= $row["encoded_by"]; ?></td>
					<td>
						<a href="#" id="<?= $row['category_id']; ?>" type="button" class="btn btn-outline-success edit-category btn-sm" data-bs-toggle="modal" data-bs-target="#modalUpdateCategory">Update</a>
						<a href="#" id="<?= $row['category_id']; ?>" type="button" class="btn btn-outline-danger btn-sm del-category" data-bs-toggle="modal" data-bs-target="#modalDeleteCategory">Delete</a>
					</td>
				</tr>
<?php
		$ctr++;
	 }
	}
}

$recordsManager = new CategoryRecordsManager($conn);
$records = $recordsManager->getRecords();
$recordView = new RecordView($records);
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