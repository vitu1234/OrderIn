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
	<link href="images/orderlogo.png" rel="shortcut icon" type="image/x-icon"/>

    <title>OrderIn | Blog  Detail View </title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/mega.menu.css" rel="stylesheet">
	<link href="css/thumbnail.slider.css" rel="stylesheet">
	<link href="css/datepicker.css" rel="stylesheet">
	<link href="css/bootstrap-select.css" rel="stylesheet">

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
<header id="" class="default">
			<?php
				include("pages/top_bar.php");
				
			?>
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
						<div class="col-md-10 col-sm-12 col-xs-12 ">	
							<div class="menu-items">
								<nav class="navbar navbar-expand-lg navbar-light bg-light menu-right">										
									<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
										<span class="navbar-toggler-icon"></span>
									</button>

									<div class="collapse navbar-collapse" id="navbarSupportedContent">
										<ul class="navbar-nav mr-auto nav-text">
											<li class="nav-item ">
												<a class="nav-link" href="index">Home </a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="how_to_orders">How To Order?</a>
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
	<!--title-bar start-->
	<section class="title-bar">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="left-title-text">
					<h3>Blog Detail View</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item"><a href="our-blog.html">Our Blog</a></li>
							<li class="breadcrumb-item active" aria-current="page">Blog Detail View</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--title-bar end-->	
	<!--partners start-->
	<section class="all-partners">			
		<div class="container">		
			<div class="row">					
				<div class="col-lg-9 col-md-12 col-12">					
					<div class="event-picy-view">						
						<img src="images/blog2.jpg" alt="">						
					</div>
					<div class="blog-published-like-comments">
						<div class="published-time">
							<span><i class="far fa-calendar-alt"></i>Published 2 days ago</span>
						</div>
						<div class="like-comments">
						
						</div>
					</div>
					<div class="event-details">
						<div class="event-name-dt">							
							<div class="event-title">
								<h1>How to order food on our site: OrderIn</h1>
								<p>By Admin</p>
								
							</div>							
						</div>
						
					</div>
					<div class="event-description">
						<!--<h4>Description</h4>-->
						<p>1. Click on the “See menu and order” button. This will take you to the available food options in your area.</p><br>
						<p>
2. Choose the restaurant and the food you desire.</p><br>
<p>
3. Be sure to specify the size of the meal and decide on addons (sauces, vinegars etc)</p><br>
<p>
4. Add the selected items to your cart.</p><br>
<p>
5. Go to cart.</p><br>

<p>6. Fill your contact details and save.</p><br>
<p>
7. Add your delivery address and save. for example “13th Avenue, Mulunguzi, house number 4, Zomba” , or “Malili Rd, House number 435, Sector 4, Area 47, Lilongwe”</p><br>
<p>
8. Do not worry if you do not have all the details such as house number or street name. After this process we will prompt you to turn on location on your phone to get a live location.</p><br>
<p>
9.You will be informed of your total food bill + delivery fee.</p><br>
<p>
10. Choose payment method</p><br>
<p>
11. Place your order</p>
<a class="bnr-btn btn-link" href="meals.html">See Menu and Order</a> 
					</div>
								
				</div>
<br>
				<div class="col-lg-3 col-md-6">
					<div class="suggested-people">
						
						<div class="suggestions full-width">							
							<div class="suggestions-list">
							
								
							</div><!--suggestions-list end-->
						</div>						
					</div>										
					
				</div>
			</div>			
		</div>
		<br>
	</section>			
	<!--partners end-->
	</div>
	<!--footer start-->
	<?php include("footer.php"); ?>
	<!--footer end-->  				
	
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	<!-- Assect scripts for this page-->
	<script src="assets/owlcarousel/owl.carousel.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/thumbnail.slider.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-select.js"></script>
	<script src="js/js.js"></script>
	<script>
	$(function(){
		$('.datepicker').datepicker();
	});
	</script>

  </body>

</html>
