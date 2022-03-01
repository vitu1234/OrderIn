<?php
	 include("connection/Functions.php");
	 $operation = new Functions();
	session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
	
	<!-- Favicon -->
	<link href="images/orderlogo1.png" rel="shortcut icon" type="image/x-icon"/>

    <title>OrderIn | How to Order </title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/mega.menu.css" rel="stylesheet">
    <link href="css/search.css" rel="stylesheet">
	<!-- Owl Carousel for this template-->
	<link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css">

    <!-- Fontawesome styles for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
<style>
	.shopping-cart {
			display: inline-block;
			background: url('http://cdn1.iconfinder.com/data/icons/jigsoar-icons/24/_cart.png') no-repeat 0 0;
			width: 20px;
			height: 20px;
			margin: 0 10px 0 0;
		}
	</style>
</head>

<body>
	<!--header start-->
			<header id="" class="default">
			<?php include("pages/top_bar.php");?>
			<div class="menu">
				<div class="container">
					<div class="row">
						<div class="col-md-2 col-sm-12 col-xs-12">
							<div class="menu-left text-center text-md-left">
								<div class="logo-box">
									<a href="index"><img src="images/orderlogo.png" alt=""></a>
								</div>
							</div>
						</div>
						<div class="col-md-10 col-sm-12 col-xs-12">	
							<div class="menu-items">
								<nav class="navbar navbar-expand-lg navbar-light bg-light menu-right">										
									<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
										<span class="navbar-toggler-icon"></span>
									</button>

									<div class="collapse navbar-collapse" id="navbarSupportedContent">
										<ul class="navbar-nav mr-auto nav-text">
											<li class="nav-item">
												<a class="nav-link" href="index">Home </a>
											</li>
											<li class="nav-item  active">
												<a class="nav-link" href="#">How To Order</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="browse_places">Browse Places</a>
											</li>
										</ul>											
									</div>
									
								</nav>
								<div class="icons-set">
									<ul class="list-inline">
										<li class="icon-items nav-item dropdown ">
										<a class="nav-link dropdown-toggle-no-caret" href="#" id="navbarDropdown1" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-search"></i></a>										
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown1">	
											<div class="notification-item">													
												<div class="search-details">
													<form class="form-inline" >
													  <input class="form-control " style="color:#000;" type="text" placeholder="What are you craving for?" id="searchValue" aria-label="Search">
													  <button id="search_btn" class="s-btn btn-link " type="button"><i class="fas fa-search"></i></button>
													</form>																																								
												</div>
											</div>												
										</div>		
										</li>

										<?=$btn;?>									
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</header>
	
	<div class="" id="searchedContent">
	
	</div>
	
	<div id="replaceSearch">
	<!--header end-->	
	<!--title-bar start-->
	<section class="title-bar">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="left-title-text">
					<h3>How To Order</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">How To Order</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--title-bar end-->
	
	<!--how-to-orders start-->
	<section class="how-to-orders">			
		<div class="container">		
			<div class="row">	
				<div class="col-md-12">
					<div class="new-heading">
<!--						<h1> Order In 4 Steps </h1>-->
					</div>						
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-6">
					<div class="about-text1">
						
						<!--<h4>Description</h4>-->
						<ul class="list-group list-group-flush">
						  <li class="list-group-item d-flex justify-content-between align-items-center">
							Find A Meal
							<span class="badge badge-warning badge-pill">1</span>
						  </li>
						  <li class="list-group-item d-flex justify-content-between align-items-center">
							Add To Cart
							<span class="badge badge-warning ">2</span>
						  </li>
						  <li class="list-group-item d-flex justify-content-between align-items-center">
							Pay Online
							<span class="badge badge-warning badge-pill">3</span>
						  </li>
						<li class="list-group-item d-flex justify-content-between align-items-center">
							Seat Back &amp; Relax, We Will Deliver to you!
							<span class="badge badge-warning badge-pill">4</span>
						  </li>
						</ul>
						<a style="background-color:#FF7C2F;" class="bnr-btn btn-link" href="meals">See Menu and Order</a> 

					</div>						
				</div>
			</div>
			
		</div>
		<br>
	</section>
	<!--how-to-orders end-->	
	</div>
	<!--footer start-->
<?php include("footer.php"); ?>
	<!--footer end-->
	<!--footer end-->

        <!--Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	 <!--Assect scripts for this page-->
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="js/owlslider.js"></script>
	<script src="js/js.js"></script>
  </body>

</html>
