<nav class="navbar bg-secondary bg-gradient fixed-top mb-5">
	
<div class="container-fluid">

<button class="navbar-toggler d-flex bg-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvas">
	<span class="navbar-toggler-icon"></span>
</button>
<h5 class="text-white d-md-block d-none ps-3 position-absolute ms-5 mt-2 animate__animated animate__fadeIn animate__slow animate__infinite infinite">E-commerce</h5>

<div class="dropdown pe-md-2">
	<a href="#" class="btn btn-outline-dark text-light dropdown-toggle" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 30%"><?= $initials; ?></a>
	<ul class="dropdown-menu dropdown-menu-end">
		<li class="nav-item p-1">
			<a href="logout" class="nav-link dropdown-item">logout</a>
		</li>
	</ul>
</div>

<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvas">
	
<div class="offcanvas-header">
		<h5 class="offcanvas-title text-muted fw-bolder"><?= $full_name; ?></h5>
		<button type="button" class="btn-close" data-bs-dismiss="offcanvas"></button>
</div><hr class="border border-2 border-secondary">

<div class="offcanvas-body">
	<div class="text-dark">Dashboard</div><hr class="border border-1 border-primary">

	<ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
		<li class="nav-item">
    <a class="nav-link active" aria-current="page" href="index"><i class="fa-solid fa-house"></i> Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="checkouts"><i class="fa-solid fa-money-bill"></i> Checkouts</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="reviews"><i class="fa-solid fa-comment"></i> Reviews</a>
  </li>
	</ul>

</div>

</div>

</div>

</nav>