<?php
// session section
if (session_status() === PHP_SESSION_NONE) {
 session_start();
}

// database section
class DatabaseConnection{

private $host;
private $user;
private $pass;
private $dbName;
private $conn;

public function __construct($host, $user, $pass, $dbName){
$this->host = $host;
$this->user = $user;
$this->pass = $pass;
$this->dbName = $dbName;
}

public function connectDb(){
$this->conn = new mysqli($this->host, $this->user, $this->pass, $this->dbName);

if ($this->conn->connect_error) {
die("Connection failed: " . $this->conn->connect_error);
}

return $this->conn;
}


public function closeConnection(){
if ($this->conn) {
$this->conn->close();
}
}

}

// registration section
class UserRegistration{

private $conn;

public function __construct($conn){
$this->conn = $conn;
}

public function register($first_name, $middle_name, $last_name, $email, $password, $address, $date_register, $status, $contact, $account_type){

$first_name = $this->conn->escape_string(trim($first_name));
$middle_name = $this->conn->escape_string(trim($middle_name));
$last_name = $this->conn->escape_string(trim($last_name));
$email = $this->conn->escape_string(trim($email));
$password = $this->conn->escape_string(trim($password));
$address = $this->conn->escape_string(trim($address));
$date_register = $this->conn->escape_string(trim($date_register));
$status = $this->conn->escape_string(trim($status));
$contact = $this->conn->escape_string(trim($contact));
$account_type = $this->conn->escape_string(trim($account_type));

$check_email = "SELECT * FROM tbl_users WHERE email='$email'";
$check_email_row = $this->conn->query($check_email);
$total_email = $check_email_row->num_rows;

if ($total_email > 0) {
showAlertRegistrationError();
}else{
$hash = password_hash($password, PASSWORD_BCRYPT);
$sql = "INSERT INTO tbl_users(first_name, middle_name, last_name, email, password, user_add, date_register, status, phone_number, account_type) VALUES(?,?,?,?,?,?,?,?,?,?)";
$stmt = $this->conn->prepare($sql);
$stmt->bind_param("ssssssssss", $first_name, $middle_name, $last_name, $email, $hash, $address, $date_register, $status, $contact, $account_type);
$stmt->execute();
$stmt->close();
showAlertRegistrationSuccess();
}
}
}

class UserAdminRegistration{

private $conn;

public function __construct($conn){
$this->conn = $conn;
}

public function register($first_name, $middle_name, $last_name, $email, $password, $address, $date_register, $status, $contact, $account_type){

$first_name = $this->conn->escape_string(trim($first_name));
$middle_name = $this->conn->escape_string(trim($middle_name));
$last_name = $this->conn->escape_string(trim($last_name));
$email = $this->conn->escape_string(trim($email));
$password = $this->conn->escape_string(trim($password));
$address = $this->conn->escape_string(trim($address));
$date_register = $this->conn->escape_string(trim($date_register));
$status = $this->conn->escape_string(trim($status));
$contact = $this->conn->escape_string(trim($contact));
$account_type = $this->conn->escape_string(trim($account_type));

$check_email = "SELECT * FROM tbl_users WHERE email='$email'";
$check_email_row = $this->conn->query($check_email);
$total_email = $check_email_row->num_rows;

if ($total_email > 0) {
showAlertRegistrationError();
}else{
$hash = password_hash($password, PASSWORD_BCRYPT);
$sql = "INSERT INTO tbl_users(first_name, middle_name, last_name, email, password, user_add, date_register, status, phone_number, account_type) VALUES(?,?,?,?,?,?,?,?,?,?)";
$stmt = $this->conn->prepare($sql);
$stmt->bind_param("ssssssssss", $first_name, $middle_name, $last_name, $email, $hash, $address, $date_register, $status, $contact, $account_type);
$stmt->execute();
$stmt->close();
showAlertRegistrationSuccess();
}
}
}
// ============================


// login section
class LoginUser{

private $conn;

public function __construct($conn){
$this->conn = $conn;
}

public function login($conn, $email, $password){
$email = $this->conn->escape_string(trim($email));
$password = $this->conn->escape_string(trim($password));

$sql = "SELECT * FROM tbl_users WHERE email='$email'";
$stmt = $this->conn->query($sql);
$total_email = $stmt->num_rows;

if ($total_email > 0) {
while ($row = $stmt->fetch_assoc()) {
$user_id = $row["user_id"];
$db_email = $row["email"];
$db_pass = $row["password"];
$db_fname = $row["first_name"];
$db_lname = $row["last_name"];
$db_status = $row["status"];
$db_account_type = $row["account_type"];
$db_add = $row["user_add"];
$db_dateReg = $row["date_register"];

if (password_verify($password, $db_pass) && strcmp($email, $db_email) === 0) {
$_SESSION["user_id"] = $user_id;
$_SESSION["email"] = $db_email;
$_SESSION["password"] = $db_pass;
$_SESSION["first_name"] = $db_fname;
$_SESSION["last_name"] = $db_lname;
$_SESSION["status"] = $db_status;
$_SESSION["account_type"] = $db_account_type;
$_SESSION["user_add"] = $db_add;
$_SESSION["date_register"] = $db_dateReg;

if ($db_account_type === "admin") {
	header("location: admin");
}else{
	header("location: index");
}

}else{
return "Wrong Password or kindly Considerate  the sensitive case of the email!";
}
}
}else{
return "No Email";
}
}
}

// ====================================


// ================ADMIN SECTION===============

// count total rows
class TotalNumRows{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function getTotalEarnings(){
		$status = "Delivered";
	 $sql = "SELECT * FROM tbl_checkout WHERE status = '$status'";
		$row = $this->conn->query($sql);
		return $row;
	}

	public function getTotalTransactions(){
		$sql = "SELECT COUNT(*) AS total_transacs FROM tbl_checkout";
		$stmt = $this->conn->query($sql);
		$row = $stmt->fetch_assoc();
		$total_transacs = $row["total_transacs"];
		return $total_transacs;
	}

	public function getTotalUsers(){
		$sql = "SELECT COUNT(*) AS total_users FROM tbl_users";
		$stmt = $this->conn->query($sql);
		$row = $stmt->fetch_assoc();
		$total_users = $row["total_users"];
		return $total_users;
	}

	public function getTotalPending(){
		$status = "PENDING";
		$sql = "SELECT COUNT(*) AS total_pending FROM tbl_checkout WHERE status='$status'";
		$stmt = $this->conn->query($sql);
		$row = $stmt->fetch_assoc();
		$total_pending = $row["total_pending"];
		return $total_pending;
	}

		public function getTotalCancel(){
		$status = "Cancel Order";
		$sql = "SELECT COUNT(*) AS total_cancel FROM tbl_checkout WHERE status='$status'";
		$stmt = $this->conn->query($sql);
		$row = $stmt->fetch_assoc();
		$total_cancel = $row["total_cancel"];
		return $total_cancel;
	}

	public function getTotalDelivered(){
		$status = "Delivered";
		$sql = "SELECT COUNT(*) AS total_cancel FROM tbl_checkout WHERE status='$status'";
		$stmt = $this->conn->query($sql);
		$row = $stmt->fetch_assoc();
		$total_cancel = $row["total_cancel"];
		return $total_cancel;
	}

		public function getTotalDelivery(){
		$status = "Out for Delivery";
		$sql = "SELECT COUNT(*) AS total_delivery FROM tbl_checkout WHERE status='$status'";
		$stmt = $this->conn->query($sql);
		$row = $stmt->fetch_assoc();
		$total_delivery = $row["total_delivery"];
		return $total_delivery;
	}

	public function getTotalShipped(){
		$status = "Shipped Out";
		$sql = "SELECT COUNT(*) AS total_shipped FROM tbl_checkout WHERE status='$status'";
		$stmt = $this->conn->query($sql);
		$row = $stmt->fetch_assoc();
		$total_shipped = $row["total_shipped"];
		return $total_shipped;
	}
	
}

// category page section
class InsertCategoryName{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function insert($cat_date_entry, $cat_encoded_entry, $cat_name_entry){
		
	 $check_cat_name = "SELECT * FROM tbl_category WHERE category_name = '$cat_name_entry'";
		$check_cat_name_row = $this->conn->query($check_cat_name);
		$total_cat_name = $check_cat_name_row->num_rows;

		if ($total_cat_name > 0) {
			return "Avoid Duplication of Category Name";
		}else{
		$sql = "INSERT INTO tbl_category(category_name, date_add, encoded_by) VALUES(?,?,?)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("sss", $cat_name_entry, $cat_date_entry, $cat_encoded_entry);
		$stmt->execute();
		$stmt->close();

		return "Add Category Successfull";
		}
	}
}

class CategoryRecordsManager{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function getRecords(){
		$sql = "SELECT * FROM tbl_category ORDER BY category_id DESC";
		$records = $this->conn->query($sql);
		return $records;
	}
}

class RetrieveCheckoutid{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function retrieve($id){
		$sql = "SELECT * FROM tbl_checkout WHERE checkout_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$stmt->close();
		return $row;
	}
}

class RetrieveCategoryId{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function retrieve($id){
		$sql = "SELECT * FROM tbl_category WHERE category_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$stmt->close();
		return $row;
	}
}

class UpdateCategory{

 private $conn;

 public function __construct($conn){
 	$this->conn = $conn;
 }

 public function update($id, $cat_name_update){
 	//  $check_cat_name = "SELECT * FROM tbl_category WHERE category_name = '$cat_name_update'";
	 // $check_cat_name_row = $this->conn->query($check_cat_name);
	 // $total_cat_name = $check_cat_name_row->num_rows;

 	// if ($total_cat_name > 0) {
 		// return "Avoid Duplication of Category Name";
 	// }else{
 	$sql = "UPDATE tbl_category SET category_name=? WHERE category_id=?";
 	$stmt = $this->conn->prepare($sql);
 	$stmt->bind_param("ssi", $cat_name_update, $cat_stats_update, $id);
 	$stmt->execute();
 	$stmt->close();

 	return "Update Category Successfull";
 	// }	
 }
}

class DeleteCategory{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function delete($id){
		$sql = "DELETE FROM tbl_category WHERE category_id=?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$result = $stmt->execute();
		return "Category is Deleted Successfull";
	}
}

class FilterCategory{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function filter($name){
		$sql = "SELECT * FROM tbl_category WHERE category_name LIKE '%$name%' || encoded_by LIKE '%$name%'";
		$get = $this->conn->query($sql);
		$total = $get->num_rows;
		$data = "";

		$data .="

			<table class='table table-hover'>
				
			<thead>
				<tr class='text-center'>
					<th>No.</th>
					<th>Date Entry</th>
					<th>Category Name</th>
					<th>Encoded By</th>
					<th>Options</th>
				</tr>
			</thead>
			<tbody>
		";

		if ($total > 0) {
			$ctr = 1;
			while ($row = $get->fetch_assoc()) {
				$origdate = $row["date_add"];
				$dateTime = new DateTime($origdate);
				$formatDate = $dateTime->format("M d, Y");
				$data .="

				<tr class='text-center'>
					<td>".$ctr."</td>
					<td>".$formatDate."</td>
					<td>".$row['category_name']."</td>
					<td>".$row['encoded_by']."</td>
					<td>
						<a href='#' id='".$row['category_id'].">' type='button' class='btn btn-outline-success edit-category btn-sm' data-bs-toggle='modal' data-bs-target='#modalUpdateCategory'>Update</a>
						<a href='#' id='".$row['category_id'].">' type='button' class='btn btn-outline-danger btn-sm del-category' data-bs-toggle='modal' data-bs-target='#modalDeleteCategory'>Delete</a>
					</td>
				</tr>

				";

				$ctr++;
			}
			$data .="</tbody>";
		}else{
			$data .="
			<tbody>
			 <tr>
			   <td colspan='6' class='text-center fw-bolder'><h4 class='text-danger fw-bolder animate__animated animate__fadeIn animate__infinite infinite'>No Record</h4></td>
			 </tr>
			</tbody>
";
		}
		$data .="</table>";
		echo $data;
	}
}

// filter category
if (isset($_POST["filterCategory"])) {
	$filter = $_POST["filterCategory"];
	include("../inc/config.php");

	$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
	$conn = $dbConnect->connectDb();
	
	$liveFilter = new FilterCategory($conn);
	$liveFilter->filter($filter);
	$dbConnect->closeConnection();
}
// 

// product page section
class CategorySelect{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function categorySelect(){

		$categories = [];

		$sql = "SELECT * FROM tbl_category";
		$result = $this->conn->query($sql);

		while ($row = $result->fetch_assoc()) {
			$categories[] = $row["category_name"];
		}
		return $categories;
	}
}

class InsertProduct{

private $conn;

public function __construct($conn){
	$this->conn = $conn;
}

public function uploadFile($file){
	$origName = $file["name"];
	$extension = pathinfo($origName, PATHINFO_EXTENSION);
	$newFile = uniqid() . "_" . $origName;
	$destination = "../upload/" . $newFile;

	while (file_exists($destination)) {
		$newFile = uniqid() . "_" . $origName;
		$destination = "../upload/" . $newFile;
	}

	move_uploaded_file($file["tmp_name"], $destination);
	return $newFile;
}

public function insert($prod_name_entry, $prod_cat_entry, $prod_price_entry, $prod_stock_entry, $file, $prod_encode_by_entry, $prod_date_entry, $prod_active_entry){
	$sql = "INSERT INTO tbl_product(product_name, category, price, stock, image, added_by, date_added, status) VALUES(?,?,?,?,?,?,?,?)";
	$stmt = $this->conn->prepare($sql);
	$stmt->bind_param("ssssssss", $prod_name_entry, $prod_cat_entry, $prod_price_entry, $prod_stock_entry, $file, $prod_encode_by_entry, $prod_date_entry, $prod_active_entry);
	$stmt->execute();
	$stmt->close();

	return "Add Product Successfull";
 }
}

class ProductRecordsManager{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function getRecords(){
		$sql = "SELECT * FROM tbl_product ORDER BY product_id DESC";
		$records = $this->conn->query($sql);
		return $records;
	}
}

class RetrieveProductId{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function retrieve($id){
		$sql = "SELECT * FROM tbl_product WHERE product_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$stmt->close();
		return $row;
	}
}

class UpdateProductwithFile{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function uploadFile($file){
	$origName = $file["name"];
	$extension = pathinfo($origName, PATHINFO_EXTENSION);
	$newFile = uniqid() . "_" . $origName;
	$destination = "../upload/" . $newFile;

	while (file_exists($destination)) {
		$newFile = uniqid() . "_" . $origName;
		$destination = "../upload/" . $newFile;
	}

	move_uploaded_file($file["tmp_name"], $destination);
	return $newFile;
}

	public function updatewithFile($id, $prod_name_update, $prod_cat_update, $prod_price_update, $prod_stock_update, $newFile, $prod_encode_by_update, $prod_active_update){

		$sql = "UPDATE tbl_product SET product_name=?, category=?, price=?, stock=?, image=?, update_by=?, status=? WHERE product_id=?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("sssssssi", $prod_name_update, $prod_cat_update, $prod_price_update, $prod_stock_update, $newFile, $prod_encode_by_update, $prod_active_update, $id);
		$stmt->execute();
		$stmt->close();
		return "Update Product Successfull and file is uploaded!";
	}

	public function updatewithoutFile($id, $prod_name_update, $prod_cat_update, $prod_price_update, $prod_stock_update, $prod_encode_by_update, $prod_active_update){

		$sql = "UPDATE tbl_product SET product_name=?, category=?, price=?, stock=?, update_by=?, status=? WHERE product_id=?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("ssssssi", $prod_name_update, $prod_cat_update, $prod_price_update, $prod_stock_update, $prod_encode_by_update, $prod_active_update, $id);
		$stmt->execute();
		$stmt->close();
		return "Update Product Successfull and file is retained";
	}
}

class FilterProduct{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function filter($filter){
		$sql = "SELECT * FROM tbl_product WHERE product_name LIKE '%$filter%' || category LIKE '%$filter%' || status LIKE '%$filter%'";
		$get = $this->conn->query($sql);
		$total = $get->num_rows;
		$data = "";

		$data .="
<table class='table table-hover'>
<thead>
<tr class='text-center'>
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
		";

if ($total > 0) {
	$ctr = 1;
$peso_sign = "\xE2\x82\xB1";
$total_amount = 0;

while ($row = $get->fetch_assoc()) {
	$origdate = $row["date_added"];
	$dateTime = new DateTime($origdate);
	$formatDate = $dateTime->format("M d, Y");
	$total_amount += $row["price"];

	$data .="

<tr class='text-center'>
	<td>".$ctr."</td>
	<td>".$formatDate."</td>
	<td>".$row['product_name']."</td>
	<td>".$row['category']."</td>
	<td>".$peso_sign.number_format($row['price'])."</td>
	<td>".$row['stock']."</td>
	<td><a href='../upload/".$row['image']."' target='_blank' class='text-success fw-bolder text-decoration-none'>".shortenLinkName($row['image'])."</a></td>
	<td>".$row['added_by']."</td>
	<td>".$row['update_by']."</td>
	<td>".$row['status']."</td>
	<td>
	<a href='#' id='".$row['product_id']."' type='button' class='btn btn-outline-success edit-product btn-sm' data-bs-toggle='modal' data-bs-target='#modalUpdateProduct'>Update</a>
	<a href='#' id='".$row['product_id']."' type='button' class='btn btn-outline-danger btn-sm del-product' data-bs-toggle='modal' data-bs-target='#modalDeleteProduct'>Delete</a>
</td>
</tr>
	";
$ctr++;
}

$data .="

<tr>
	<td class='fw-bolder text-end'>Sales:</td>
	<td class='fw-bolder'>".$peso_sign.number_format($total_amount)."</td>
</tr>

";

$data .="</tbody>";
}else{
	$data .="
			<tbody>
			 <tr>
			   <td colspan='11' class='text-center fw-bolder'><h4 class='text-danger fw-bolder animate__animated animate__fadeIn animate__infinite infinite'>No Record</h4></td>
			 </tr>
			</tbody>
";
}
$data .="</table>";
echo $data;
	}
}

if (isset($_POST["filterProduct"])) {
	$filter = $_POST["filterProduct"];
	include("../inc/shortLink.php");
	include("../inc/config.php");

	$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
	$conn = $dbConnect->connectDb();

	$liveFilter = new FilterProduct($conn);
	$liveFilter->filter($filter);
	$dbConnect->closeConnection();
}


class DeleteProduct{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function delete($id){
		$sql = "DELETE FROM tbl_product WHERE product_id=?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$result = $stmt->execute();
		return "Product is Deleted Successfull";
	}
}

class CheckoutsAdminManager{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function records(){
		// normal query
		// $sql = "SELECT * FROM tbl_checkout ORDER BY checkout_id DESC";

		// for avoid duplication of data
		$sql = "SELECT *, MIN(customer_name) FROM tbl_checkout GROUP BY customer_name ORDER BY customer_name DESC";
		$get = $this->conn->query($sql);
		return $get;
	}
}

class CheckoutsAdminPerNameManager{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function records(){
		$sql = "SELECT * FROM tbl_checkout WHERE customer_id ='".urldecode(base64_decode($_REQUEST["customer_id"]))."'";
		$get = $this->conn->query($sql);
		return $get;
	}

	public function reports(){
		$sql = "SELECT * FROM tbl_checkout ORDER BY date_order DESC";
		$get = $this->conn->query($sql);
		return $get;
	}
}


class UpdateChkStatus{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function update($id, $status){
		$sql = "UPDATE tbl_checkout SET status=? WHERE checkout_id=?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("si", $status, $id);
		$stmt->execute();
		$stmt->close();

		return "Successfull Change the Order Status";
	}
}


class FilterAdminCheckout{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function filter($name){
		// normal query
		// $sql = "SELECT * FROM tbl_checkout WHERE (date_order LIKE '%$name%' || item LIKE '%$name%' || status LIKE '%$name%' || customer_name LIKE '%$name%' || payment_method LIKE '%$name%') AND customer_id='".$_SESSION["user_id"]."'";

		// query with specific lenght and specific position of letters
		$sql = "SELECT *, MIN(customer_name) FROM tbl_checkout WHERE LEFT(date_order, LENGTH('$name')) = '$name' || date_order LIKE '%$name%' || LEFT(status, LENGTH('$name')) = '$name' || item LIKE '%$name%' || LEFT(customer_name,LENGTH('$name')) = '$name'  GROUP BY customer_name";
		$get = $this->conn->query($sql);
		$total = $get->num_rows;
		$data = "";

		$data .="

		<table class='table table-hover'>
					<thead>
						<tr class='text-center align-middle'>
							<th>No.</th>
							<th>Date Order</th>
							<th>Customer Name</th>
							<th>Address</th>
						</tr>
					</thead>
					<tbody>
		";

		if ($total > 0) {
			$ctr = 1;
			$peso_sign = "\xE2\x82\xB1";
			$total_price = 0;
			while ($row = $get->fetch_assoc()) {

			$oridDateOrder = $row["date_order"];
			$dateTime = new DateTime($oridDateOrder);
			$formatDate = $dateTime->format("M d, Y");

			$data .="

			<tr class='text-center align-middle'>
		<td>".$ctr."</td>
		<td>".$formatDate."</td>	
		<td><a href='checkout_per_name?".$row['customer_name']."'>".$row['customer_name']."</a></td>
		<td>".$row['address']."</td>
	</tr>

			";

				$ctr++;
			}
	$data .="</tbody>";
		}else{
			$data .="

		<tbody>
			 <tr>
			   <td colspan='12' class='text-center fw-bolder'><h4 class='text-danger fw-bolder animate__animated animate__fadeIn animate__infinite infinite'>No Record</h4></td>
			 </tr>
			</tbody>

	";
		}
	
	$data .="</table>";
	echo $data;	
	 }
	}


if (isset($_POST["filterAdminCheckout"])) {
	$filter = $_POST["filterAdminCheckout"];
		include("../inc/config.php");

		$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
		$conn = $dbConnect->connectDb();

	$liveFilter = new FilterAdminCheckout($conn);
	$liveFilter->filter($filter);
	$dbConnect->closeConnection();
}

class FilterPerNameAdminCheckout{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function filter($name, $customer_id){
		// decode the customer id
		// normal query
		$sql = "SELECT * FROM tbl_checkout WHERE (date_order LIKE '%$name%' || item LIKE '%$name%' || status LIKE '%$name%' || customer_name LIKE '%$name%' || payment_method LIKE '%$name%') AND customer_id='$customer_id'";

		$get = $this->conn->query($sql);
		$total = $get->num_rows;
		$data = "";

		$data .="

		<table class='table table-hover'>
					<thead>
						<tr class='text-center align-middle'>
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
		";

		if ($total > 0) {
			$ctr = 1;
			$peso_sign = "\xE2\x82\xB1";
			$total_price = 0;
			while ($row = $get->fetch_assoc()) {

			$oridDateOrder = $row["date_order"];
			$dateTime = new DateTime($oridDateOrder);
			$formatDate = $dateTime->format("M d, Y");
			$total_price += $row["sub_total"];

			$data .="

			<tr class='text-center align-middle'>
		<td>".$ctr."</td>
		<td>".$formatDate."</td>	
		<td>".$row["customer_name"]."</td>
		<td>".$row["address"]."</td>
		<td>".$row["item"]."</td>
		<td>".$row["qty"]."</td>
		<td>".$peso_sign.number_format($row["price"])."</td>
		<td>".$peso_sign.number_format($row["sub_total"])."</td>
		<td><img class='img-fluid' width='100' height='50' src='../upload/".$row['image']."'></td>
		<td>".$row["payment_method"]."</td>
		<td>".$row["status"]."</td>
		<td>
			<a href='#' id='".$row['checkout_id']."' class='btn btn-outline-primary btn-sm edit-checkout' data-bs-toggle='modal' data-bs-target='#modalCheckUpdate'>Update</a>
		</td>
	</tr>

			";
				$ctr++;
			}

	$data .="
	<tr class='align-middle'>
		<td class='fw-bolder text-end'>Total Order:</td>
		<td class='text-center fw-bolder text-success'>".$peso_sign.number_format($total_price)."</td>
	</tr>
	</tbody>";
		}else{
			$data .="

		<tbody>
			 <tr>
			   <td colspan='12' class='text-center fw-bolder'><h4 class='text-danger fw-bolder animate__animated animate__fadeIn animate__infinite infinite'>No Record</h4></td>
			 </tr>
			</tbody>

	";
		}
	
	$data .="</table>";
	echo $data;	
	 }
	}


if (isset($_POST["filterperNameAdminCheckout"])) {
		$filter = $_POST["filterperNameAdminCheckout"];
		$customer_id = $_POST["customer_id"];
		include("../inc/config.php");

		$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
		$conn = $dbConnect->connectDb();

	$liveFilter = new FilterPerNameAdminCheckout($conn);
	$liveFilter->filter($filter, $customer_id);
	$dbConnect->closeConnection();
}

// reports date admin
class ReportFilterDate{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function filterDate($fromDate, $toDate){

	// convert input dates to YYYY-MM-DD
	$formatfromDate = date("Y-m-d", strtotime($fromDate));
	$formattoDate = date("Y-m-d", strtotime($toDate));

 	$sql = "SELECT * FROM tbl_checkout WHERE STR_TO_DATE(date_order, '%m/%d/%Y') BETWEEN ? AND ? ORDER BY date_order DESC";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("ss", $formatfromDate, $formattoDate);
		$stmt->execute();
		$result = $stmt->get_result();
		$data = "";
		$total = $result->num_rows;

		$data .="

<table class='table table-hover'>

<thead>
<thead>
						<tr class='text-center align-middle'>
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
		";

		if ($total > 0) {
			$ctr = 1;
			$peso_sign = "\xE2\x82\xB1";
			$total_price = 0;

			while ($row = $result->fetch_assoc()) {
				$oridDateOrder = $row["date_order"];
				$dateTime = new DateTime($oridDateOrder);
				$formatDate = $dateTime->format("M d, Y");
				$total_price += $row["sub_total"];


				$data .="
				<tr class='text-center align-middle'>
					<td>".$ctr."</td>
					<td>".$formatDate."</td>	
					<td>".$row["customer_name"]."</td>
					<td>".$row["address"]."</td>
					<td>".$row["item"]."</td>
					<td>".$row["qty"]."</td>
					<td>".$row["price"]."</td>
					<td>".$row["sub_total"]."</td>
					<td><img class='img-fluid' width='100' height='50' src='../upload/".$row['image']."'></td>
					<td>".$row["payment_method"]."</td>
					<td>".$row["status"]."</td>
				</tr>
				";

				$ctr++;
			}

		$data .="
	<tr class='align-middle'>
		<td class='fw-bolder text-end'>Total Order:</td>
		<td class='text-center fw-bolder text-success'>".$peso_sign.number_format($total_price)."</td>
	</tr>
	</tbody>";

		}else{
			$data .="
				<tbody>
		   <tr>
		    <td class='text-center text-uppercase fw-bolder text-danger' colspan='11'><h3 class='animate__animated animate__fadeIn animate__infinite infinite'>No Records</h3></td>
		   </tr>
			</tbody>
			";
		}

		$data .="
		</table>
		";
		echo $data;
	}
}

if (isset($_POST["from_date"], $_POST["to_date"])) {
	include("../inc/config.php");
	include("../inc/shortLink.php");

	$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
	$conn = $dbConnect->connectDb();

	$dateFilter = new ReportFilterDate($conn);
	$fromDate = $_POST["from_date"];
	$toDate = $_POST["to_date"];

	$dateFilter->filterDate($fromDate, $toDate);
}

class ReviewAdmin{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function reviews(){
		$status = "For Review";
		$sql = "SELECT * FROM tbl_review ORDER BY review_id DESC";
		$query = $this->conn->query($sql);
		return $query;
	}
}

class UpdateReviewStatus{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function update($id, $status){
		$sql = "UPDATE tbl_review SET status=? WHERE review_id=?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("si", $status, $id);
		$stmt->execute();
		$stmt->close();
		return "Review Status has been Updated";
	}

}

//==========================================


 // =============CLIENT USER SECTION =================


//client page classes
// home page index or the landing page section or for client user page
class DisplayProductManager{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function displayProducts(){
	$sql_shoes = "SELECT * FROM tbl_product ORDER BY product_id DESC";
		$get_shoes = $this->conn->query($sql_shoes);
		return $get_shoes;
	}
}

class DisplayCatetoryManager{
	
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function displayCategories(){
		// displaying single records if have Duplication
		$sql = "SELECT category, MIN(image) AS image FROM tbl_product GROUP BY category ORDER BY product_id DESC";
		$get = $this->conn->query($sql);
		return $get;
	}
}

class AddToCart{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function addCart($cart_date_order, $cart_cust_id, $cart_prod_id, $cart_cust_name, $cart_cust_add, $cart_image, $cart_product_item, $cart_product_price, $product_qty, $prod_sub_total, $cart_prod_pending){

		if (empty($_POST["product_qty"]) || $_POST["product_qty"] === 0) {
			return "Kindly change the quantity of the product first";
		}else{
			$sql = "INSERT INTO tbl_cart(date_order, customer_id, product_id, customer_name, customer_add, image, item, price, qty, sub_total, status) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $this->conn->prepare($sql);
			$stmt->bind_param("sssssssssss", $cart_date_order, $cart_cust_id, $cart_prod_id, $cart_cust_name, $cart_cust_add, $cart_image, $cart_product_item, $cart_product_price, $product_qty, $prod_sub_total, $cart_prod_pending);
			$stmt->execute();
			$stmt->close();

			return "Add to cart is Successfull";
		}
	}
}

class CartRecordsManager{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function records(){
		$sql = "SELECT * FROM tbl_cart WHERE customer_id = '".$_SESSION["user_id"]."' ORDER BY order_id DESC";
		$query = $this->conn->query($sql);
		return $query;
	}

	public function recordsOrder(){
		// normal sql
		$sql = "SELECT * FROM tbl_cart_archive WHERE customer_id = '".$_SESSION["user_id"]."'";
		$query = $this->conn->query($sql);
		return $query;
	}
}

class RetrieveCancelOrderId{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function retrieve($id){
		$sql = "SELECT * FROM tbl_cart WHERE order_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$stmt->close();
		return $row;
	}
}

class UpdateCartOrder{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function delete($id){
		if (isset($id)) {
			// start the transaction
			$this->conn->begin_transaction();
			
				// Retrieve the quantity and product ID of the item being canceled
				 $sql = "SELECT qty, product_id FROM tbl_cart WHERE order_id=?";
     $stmt = $this->conn->prepare($sql);
     $stmt->bind_param("i", $id);
     $stmt->execute();
     $stmt->bind_result($qty, $product_id);
     $stmt->fetch();
     $stmt->close();

      // Update the stock or add the stocks in the product table
      $sql = "UPDATE tbl_product SET stock = stock + ? WHERE product_id=?";
      $stmt = $this->conn->prepare($sql);
      $stmt->bind_param("ii", $qty, $product_id);
      $stmt->execute();
      $stmt->close();

       // Delete the item from the cart
       $sql = "DELETE FROM tbl_cart WHERE order_id=?";
       $stmt = $this->conn->prepare($sql);
       $stmt->bind_param("i", $id);
       $stmt->execute();
       $stmt->close();

      // Commit the transaction
      $this->conn->commit();

      return "Your item is cancelled";

		}
		return false;
	}
}

class FilterCart{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function filter($name){
		$sql = "SELECT * FROM tbl_cart WHERE (item LIKE '%$name%' || status LIKE '%$name%' || customer_name LIKE '%$name%') AND customer_id='".$_SESSION["user_id"]."'";
		$get = $this->conn->query($sql);
		$total = $get->num_rows;
		$data = "";

		$data .="
			<table class='table table-condensed'>
					<thead>
						<tr class='text-center'>
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
		";

		if ($total > 0) {
			$ctr = 1;
			$peso_sign = "\xE2\x82\xB1";
			$total_price = 0;
			while ($row = $get->fetch_assoc()) {
			$origDateOrder = $row["date_order"];
			$dateTime = new DateTime($origDateOrder);
			$formatDateOrder = $dateTime->format("M d, Y");
			$total_price += $row["sub_total"];

			$data .="

				<tr class='text-center align-middle'>
						<td>".$ctr."</td>
						<td>".$formatDateOrder."</td>
						<td>".$row["customer_name"]."</td>
						<td>".$row["customer_add"]."</td>
						<td>".$row["item"]."</td>
						<td><img src='upload/".$row['image']."' class='img-fluid' width='100' height='50'></td>
						<td>".$peso_sign.number_format($row["price"])."</td>
						<td>".number_format($row["qty"])."</td>
						<td>".$peso_sign.number_format($row["sub_total"])."</td>
						<td class=text-primary fw-bolder text-uppercase>".$row["status"]."</td>
							<td><a href='#' id='".$row['order_id']."' class='btn btn-outline-danger btn-sm cancel-order' type='button' data-bs-toggle='modal' data-bs-target='#modalCartCancel'>Cancel</a></td>
					</tr>

			";
					$ctr++;
			}
	$data .="
					<tr class='align-middle'>
					<td class='fw-bolder text-end'>Total Order:</td>
					<td class='text-center fw-bolder'>".$peso_sign.number_format($total_price)."</td>
				</tr>
			";

$data .="</tbody>";
		}else{
	$data .="

		<tbody>
			 <tr>
			   <td colspan='10' class='text-center fw-bolder'><h4 class='text-danger fw-bolder animate__animated animate__fadeIn animate__infinite infinite'>No Record</h4></td>
			 </tr>
			</tbody>

	";
		}
	$data .= "</table>";
	echo $data;
	}
}

if (isset($_POST["filterCart"])) {
		$filter = $_POST["filterCart"];
		include("../inc/config.php");
		include("../inc/session.php");

		$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
		$conn = $dbConnect->connectDb();

	$liveFilter = new FilterCart($conn);
	$liveFilter->filter($filter);
	$dbConnect->closeConnection();
}


class FilterCancelOrders{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function filter($cancel){
		$sql = "SELECT * FROM tbl_cart_archive WHERE item LIKE '%$cancel%' || status LIKE '%$cancel%'";
		$get = $this->conn->query($sql);
		$total = $get->num_rows;
		$data = "";

		$data .="
			<table class='table table-condensed'>
					<thead>
						<tr class='text-center'>
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
						</tr>
					</thead>
					<tbody>
		";

		if ($total > 0) {
			$ctr = 1;
			$peso_sign = "\xE2\x82\xB1";
			$total_price = 0;
			while ($row = $get->fetch_assoc()) {
			$origDateOrder = $row["date_order"];
			$dateTime = new DateTime($origDateOrder);
			$formatDateOrder = $dateTime->format("M d, Y");
			$total_price += $row["sub_total"];

			$data .="

				<tr class='text-center align-middle'>
						<td>".$ctr."</td>
						<td>".$formatDateOrder."</td>
						<td>".$row["customer_name"]."</td>
						<td>".$row["customer_add"]."</td>
						<td>".$row["item"]."</td>
						<td><img src=upload/".$row['image']." class=img-fluid width=100 height=50></td>
						<td>".$peso_sign.number_format($row["price"])."</td>
						<td>".number_format($row["qty"])."</td>
						<td>".$peso_sign.number_format($row["sub_total"])."</td>
						<td class=text-primary fw-bolder>".$row["status"]."</td>
					</tr>

			";
					$ctr++;
			}
	$data .="
					<tr class='align-middle'>
					<td class='fw-bolder text-end'>Total Order:</td>
					<td class='text-center fw-bolder'>".$peso_sign.number_format($total_price)."</td>
				</tr>
			";

$data .="</tbody>";
		}else{
	$data .="

		<tbody>
			 <tr>
			   <td colspan='10' class='text-center fw-bolder'><h4 class='text-danger fw-bolder animate__animated animate__fadeIn animate__infinite infinite'>No Record</h4></td>
			 </tr>
			</tbody>

	";
		}
	$data .= "</table>";
	echo $data;
	}
}

if (isset($_POST["filterCancelOrders"])) {
		$filter = $_POST["filterCancelOrders"];
		include("../inc/config.php");

		$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
		$conn = $dbConnect->connectDb();

	$liveFilter = new FilterCancelOrders($conn);
	$liveFilter->filter($filter);
	$dbConnect->closeConnection();
}

class AddCheckout{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function addCheckout($date_order, $customer_id, $customer_name, $customer_add, $customer_item, $customer_qty, $customer_price, $customer_subtotal, $customer_img, $payment_method, $customer_stats){
		$sql = "INSERT INTO tbl_checkout(date_order, customer_id, customer_name, address, item, qty, price, sub_total, image, payment_method, status) VALUES(?,?,?,?,?,?,?,?,?,?,?)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("sssssssssss", $date_order, $customer_id, $customer_name, $customer_add, $customer_item, $customer_qty, $customer_price, $customer_subtotal, $customer_img, $payment_method, $customer_stats);
		$stmt->execute();
		$stmt->close();

		return "Checkout Successfull go to the dashboard to view your item";
	}
}

class CheckoutsManager{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function records(){
		$sql = "SELECT * FROM tbl_checkout WHERE customer_id='".$_SESSION["user_id"]."' ORDER BY date_order DESC";
		$get = $this->conn->query($sql);
		return $get;
	}
}

// deduct the stocks
class ProductManager{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function deductStock($product_id, $quantity){
		 $sql = "UPDATE tbl_product SET stock = stock - ? WHERE product_id = ?";
   $stmt = $this->conn->prepare($sql);
   $stmt->bind_param("si", $quantity, $product_id);
   $stmt->execute();
   $stmt->close();
	}
}

// filter checkout
class FilterCheckout{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function filter($name){
		// normal query
		// $sql = "SELECT * FROM tbl_checkout WHERE (date_order LIKE '%$name%' || item LIKE '%$name%' || status LIKE '%$name%' || customer_name LIKE '%$name%' || payment_method LIKE '%$name%') AND customer_id='".$_SESSION["user_id"]."'";

		// query with specific lenght and specific position of letters
		$sql = "SELECT * FROM tbl_checkout WHERE(LEFT(date_order, LENGTH('$name')) = '$name' || date_order LIKE '%$name%' || LEFT(status, LENGTH('$name')) = '$name' || item LIKE '%$name%' || LEFT(customer_name,LENGTH('$name')) = '$name' ) AND customer_id='".$_SESSION["user_id"]."'";
		$get = $this->conn->query($sql);
		$total = $get->num_rows;
		$data = "";

		$data .="
			<table class='table table-condensed'>
					<thead>
					<tr class='text-center align-middle'>
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
					</thead>
					<tbody>
		";

		if ($total > 0) {
			$ctr = 1;
			$peso_sign = "\xE2\x82\xB1";
			$total_price = 0;
			while ($row = $get->fetch_assoc()) {
			$origDateOrder = $row["date_order"];
			$dateTime = new DateTime($origDateOrder);
			$formatDate = $dateTime->format("M d, Y");
			$total_price += $row["sub_total"];

			$data .="

		<tr class='text-center align-middle'>
		<td>".$ctr."</td>
		<td>".$formatDate."</td>	
		<td>".$row["customer_name"]."</td>
		<td>".$row["address"]."</td>
		<td>".$row["item"]."</td>
		<td>".$row["qty"]."</td>
		<td>".$row["price"]."</td>
		<td>".$row["sub_total"]."</td>
		<td><img  class='img-fluid' width='100' height='50' src='upload/".$row["image"]."'></td>
		<td>".$row["payment_method"]."</td>
		<td>".$row["status"]."</td>
	</tr>

			";
					$ctr++;
			}
	$data .="
					<tr class='align-middle'>
					<td class='fw-bolder text-end'>Total Order:</td>
					<td class='text-center fw-bolder'>".$peso_sign.number_format($total_price)."</td>
				</tr>
			";

$data .="</tbody>";
		}else{
	$data .="

		<tbody>
			 <tr>
			   <td colspan='11' class='text-center fw-bolder'><h4 class='text-danger fw-bolder animate__animated animate__fadeIn animate__infinite infinite'>No Record</h4></td>
			 </tr>
			</tbody>

	";
		}
	$data .= "</table>";
	echo $data;
	}
}

if (isset($_POST["filterCheckout"])) {
		$filter = $_POST["filterCheckout"];
		include("../inc/config.php");
		include("../inc/session.php");

		$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
		$conn = $dbConnect->connectDb();

	$liveFilter = new FilterCheckout($conn);
	$liveFilter->filter($filter);
	$dbConnect->closeConnection();
}

class ReviewClients{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function reviews(){
		$first_initials = substr($_SESSION["first_name"], 0,1);
		$last_initials = substr($_SESSION["last_name"], 0,1);
		$initials = $first_initials.$last_initials;

		$status = "For Review";
		$sql = "SELECT * FROM tbl_review WHERE status = '$status' AND customer_id = '".$_SESSION["user_id"]."'";
		$query = $this->conn->query($sql);
		return $query;
	}

	public function reviewVerified(){
		// use prepared statement to optimized the loop usually use in carousels
		$status = "Verified";
		$sql = "SELECT * FROM tbl_review WHERE status = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("s", $status);
		$stmt->execute();
		$rev_verified = $stmt->get_result();
		return $rev_verified;
	}
}

class InsertReviews{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function insert($customer_id, $customer_name, $feedback, $status){

		$sql = "INSERT INTO tbl_review(customer_id, customer_name, feedback, status) VALUES(?,?,?,?)";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("ssss", $customer_id, $customer_name, $feedback, $status);
		$stmt->execute();
		$stmt->close();
		return "Reviews Successfull Added";
	}
}

class RetrieveReivewId{

	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function retrieve($id){
		$sql = "SELECT * FROM tbl_review WHERE review_id = ?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$stmt->execute();
		$result = $stmt->get_result();
		$row = $result->fetch_assoc();
		$stmt->close();
		return $row;
	}
}

class DeleteReview{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function delete($id){
		$sql = "DELETE FROM tbl_review WHERE review_id=?";
		$stmt = $this->conn->prepare($sql);
		$stmt->bind_param("i", $id);
		$result = $stmt->execute();
		return "Review is Deleted Successfull";
	}
}

?>