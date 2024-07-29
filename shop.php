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
 	// showAlertNotification();
 	header("location: login");
 }

$dbConnect = new DatabaseConnection($host, $user, $pass, $dbName);
$conn = $dbConnect->connectDb();

require_once "controller/shop.php";

?>

<!DOCTYPE html>
<html lang="en">
<?php require_once "template-parts/head.php"; ?>
<body>

<?php 
	require_once "template-parts/navbar.php"; 
	require_once "inc/welcome-msg.php";
?>

<section id="products" class="mt-5">
	<div class="container">

	<div class="row">
		<div class="col-md-12">
			<h1 class="text-center fw-bolder text-uppercase">Products</h1>
		</div>
	</div>

		<div class="row mb-3">

<?php 
class ViewDisplay{

private $get_shoes;

public function __construct($get_shoes){
	$this->get_shoes = $get_shoes;
}

public function display(){
while ($row = $this->get_shoes->fetch_assoc()) {
	$peso_sign = "\xE2\x82\xB1";
?>
			
			<div class="col-md-4 mb-5">
			<form method="POST" class="needs-validation checkStocks" novalidate="" action="<?php htmlspecialchars($_SERVER['PHP_SELF']) ?>" enctype="multipart/form-data">

				<input type="hidden" name="cart_prod_id" value="<?= $row['product_id'] ?>">
				<input type="hidden" name="cart_cust_id" value="<?= $_SESSION['user_id'] ?>">
				<input type="hidden" name="cart_cust_name" value="<?= $_SESSION['first_name'] . " " . $_SESSION['last_name'] ?>">
				<input type="hidden" name="cart_date_order" value="<?= date('m/d/Y') ?>">
				<input type="hidden" name="cart_cust_add" value="<?= $_SESSION['user_add'] ?>">
				<input type="hidden" name="cart_image" value="<?= $row['image'] ?>">
				<input type="hidden" name="cart_product_item" value="<?= $row['product_name'] ?>">
				<input type="hidden" name="cart_product_price" class="prod_price" value="<?= $row['price'] ?>">
				<input type="hidden" name="cart_prod_pending" value="Pending">


				<div class="pe-5 ps-5">
				<center>	<img src="upload/<?= $row['image']; ?>" class="border border-success border-2 img-fluid"></center>

				</div>
				<h3 class="text-center mt-3"><?= $row["product_name"]; ?></h3>

				<div class="row">

					<div class="col-6 text-center">
					<h5 class="text-success fw-bolder">Price: <?= $peso_sign.number_format($row["price"]) ?></h5>
					</div>

					<div class="col-6 text-center">
						<h5 class="text-success fw-bolder stock-amount">Stocks: <?= $row["stock"] ?></h5>
					</div>

					<div class="col-12 d-flex mb-3">
						<label>Qty:</label> <input type="number" class="form-control product_qty" name="product_qty" required="" min="0" oninput="validateNumber(this)" value="0">
						<input type="text" readonly="" name="prod_sub_total" class="sub_total form-control">
					</div>

				</div>

				<div class="row">
					<div class="text-center col-md-12">
					<input type="submit" id="btn-add-cart" class="btn btn-outline-success btn-lg" value="Add to Cart" name="btnAddCart">
				</div>
				</div>

			</form>
			</div>	
<?php 
  }
 }
}

$recordsManger = new DisplayProductManager($conn);
$records = $recordsManger->displayProducts();
$recorView = new ViewDisplay($records);
$recorView->display();
?>
		</div>

	</div>
</section>

<button class="btn btn-dark bnt-lg rounded-circle" id="btnScrollToTop"><i class="fa-solid fa-chevron-up"></i></button>

<?php require_once "template-parts/bottom.php"; ?>

	<script type="text/javascript">
			let validateNumber = (input) =>{
				input.value = input.value.replace(/\D/g, ""); //numbers only back to start
				if (input.value < 0) {
					input.value = 0;
				}
			}

$(document).ready(function(){
    $(".product_qty").change(function(){
        // Get the form that contains the current quantity input
        let form = $(this).closest("form");
        
        // Get the price and subtotal input fields within this form
        let price = parseFloat(form.find(".prod_price").val());
        let qty = parseInt($(this).val());
        let total = price * qty;
        
        // Update the subtotal input field within this form
        let subtotalInput = form.find(".sub_total");
        subtotalInput.val(total.toFixed(2));
        subtotalInput.attr("value", total.toFixed(2)); // Ensure the attribute is set
    });
});

// check if the stocks is zero the button add to cart is disabled
$(document).ready(function(){
	// Iterate through each product form
	$(".checkStocks").each(function(){
		  let stockAmount = $(this).find(".stock-amount").text().split(':')[1].trim(); // Extracting the stock number
     if (parseInt(stockAmount) === 0) {
         $(this).find("#btn-add-cart").attr("disabled", "disabled");
     }
	});

	$(".product_qty").on("input", function(){
		 let form = $(this).closest("form");
   let stockAmount = form.find(".stock-amount").text().split(':')[1].trim(); // Extracting the stock number
   let quantity = parseInt($(this).val());

   if (quantity > stockAmount || quantity <= 0) {
       form.find("#btn-add-cart").attr("disabled", "disabled");
   } else {
       form.find("#btn-add-cart").removeAttr("disabled");
   }
	});

});
	</script>
</body>
</html>