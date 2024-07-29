<nav class="navbar navbar-expand-lg navbar-light pt-md-3 pb-md-3 bg-white" id="navbar">
<div class="container-fluid">
<a class="fs-5 navbar-brand animate__animated animate__fadeIn animate__slow infinite animate__infinite" href="#">E-commerce</a>
<button class="navbar-toggler bg-light" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
<span class="navbar-toggler-icon"></span>
</button>
<div class="collapse navbar-collapse" id="navbarSupportedContent">
<ul class="navba-nav me-auto">
</ul>

<ul class="navbar-nav me-auto mb-2 mb-lg-0 w-75 d-md-flex justify-content-center">
<li class="nav-item pe-md-5 ps-md-5">
<a class="nav-link fs-5 active" aria-current="page" href="index">Home</a>
</li>
<li class="nav-item pe-md-5 ps-md-5">
<a class="nav-link fs-5" href="about">About</a>
</li>
<li class="nav-item pe-md-5 ps-md-5">
<a href="shop" class="nav-link fs-5">Shop</a>
</li>
<li class="nav-item pe-md-5 ps-md-5">
<a href="contact" class="nav-link fs-5">Contact</a>
</li>
<?php
 if (isset($_SESSION["user_id"])) { ?>
<li class="nav-item">
	<a href="reviews" class="nav-link fs-5">Add Comment</a>
</li>
<?php } ?>
</ul>
<hr class="border border-1 border-light">
<div class="d-flex">
<ul class="navbar-nav me-auto">
<?php
if (isset($_SESSION["user_id"])) { ?>
<li class="nav-item">
<a href="cart" class="nav-link fs-5"><i class="fa-solid fa-cart-shopping"></i>
  	<?php

  	class CartRecordsCountManager{
	private $conn;

	public function __construct($conn){
		$this->conn = $conn;
	}

	public function records(){
		$sql = "SELECT COUNT(*) AS total FROM tbl_cart WHERE customer_id = '".$_SESSION['user_id']."'";
		$stmt = $this->conn->query($sql);
		$row = $stmt->fetch_assoc();
		$total = $row["total"];
		return $total;
	}
}

  	  $totalCount = new CartRecordsCountManager($conn);
  	  $total = $totalCount->records();
  	  echo "<sup>".$total."</sup>";
  	?>
</a>
</li>
<?php	
}
?>

<?php 
if (isset($_SESSION["user_id"])) { ?>
	<li class="nav-item dropdown">
		<a href="#" class="nav-link dropdown-toggle" role="button" data-bs-toggle="dropdown"><?= $initials; ?></a>
	<ul class="dropdown-menu dropdown-menu-end">
		<li>
		<a href="checkouts" class="nav-link fs-5">Dashboard</a>
	</li>
	<li class="nav-item">
		<a href="logout" class="nav-link fs-5">Logout</a>
	</li>	
	</ul>
	</li>
<?php	}else{ ?>
	<li class="nav-item">
		<a href="login" class="nav-link fs-5">Login</a>
	</li>
<?php	} ?>

</ul>
</div>
</div>
</div>
</nav>