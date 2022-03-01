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

    <title>OrderIn | About Us</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/mega.menu.css" rel="stylesheet">
    
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
											<li class="nav-item  ">
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
													<form class="form-inline">
													  <input class="form-control " type="search" placeholder="Search" aria-label="Search">
													  <button class="s-btn btn-link " type="submit"><i class="fas fa-search"></i></button>
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
	<!--header end-->	
	<!--title-bar start-->
	<section class="title-bar">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="left-title-text">
						<h3>About us</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">About Us</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--title-bar end-->	
	<!--what-is-natto start-->
	<section class="about-natto">			
		<div class="container">		
			<div class="row">	
				<div class="col-md-12">
					<div class="new-heading">
						<h1> About OrderIn </h1>
					</div>						
				</div>
				<div class="row">
					<div class="col-md-2"></div>
				<div class="col-md-8">
					
					<div class="about-text1" style=" text-align:center;text-align:justify;">
						<p >At OrderIn,  we offer the delivery of a wide selection of meals of excellent quality from your trusted restaurants.</p><br>

<p>Are you in the mood for burgers? wraps? pizza? cake? Biryani? We’ve got you covered. We are simply the best food delivery service in town.</p><br>

<p>We have the most dedicated team of deliver personnel to carter for your every need. The key to our success is simple: deliver quality consistent food that taste great every single time. We pride ourselves on serving our customers delicious genuine dishes such as: Burgers, Pizza, Fast Food and whole meals.</p><br>

<p>Eat delicious food. Grab a drink. But most of all, relax! Your number one food delivery service is at your doorstep! Thank you from the bottom of our hearts for your continued support. </p>
					</div>
										
				</div>
				<div class="col-md-2"></div>
</div>

			</div>
			<div class="row">	
				<div class="col-md-3 col-sm-12">
					<div class="about-item">
					<img src="images/about/icon_1.svg" alt="">
					<h4>Search</h4>
					<!--<p> Nunc et risus. Etiam a nibh tunil Phasellus dignissim metus.</p>-->
					</div>
				</div>
				<div class="col-md-3 col-sm-12">
					<div class="about-item">
					<img src="images/about/icon_2.svg" alt="">
					<h4>Choose</h4>
					<!--<p> Nunc et risus. Etiam a nibh tunil Phasellus dignissim metus.</p>-->
					</div>
				</div>
				<div class="col-md-3 col-sm-12">
					<div class="about-item">
					<img src="images/about/icon_3.svg" alt="">
					<h4>Pay</h4>
					<!--<p> Nunc et risus. Etiam a nibh tunil Phasellus dignissim metus.</p>-->
					</div>
				</div>
				<div class="col-md-3 col-sm-12">
					<div class="about-item">
					<img src="images/about/icon_4.svg" alt="">
					<h4>Enjoy</h4>
					<!--<p> Nunc et risus. Etiam a nibh tunil Phasellus dignissim metus.</p>-->
					</div>
				</div>
			</div>
			<div class="order-now-btn">
				<a style="background-color:#FF7C2F;" href="meals" class="m-btn btn-link">Order Now</a>
			</div><br><br><br>
		</div>
	</section>
	<!--what-is-natto end-->
	<!--download-link start-->
	
	<!--download-link end-->	
	<!--active-in-30-countries Start-->

	<!--active-in-30-countries end-->	
	<!--our-team Start-->
	<section class="our-team">			
		<div class="container">
			<div class="row">	
				<div class="col-md-12">					
					<div class="new-heading">
						<h1>Our Team</h1>
					</div>
				</div>
			</div>	
			<div class="team">
				<div class="row">
					<div class="col-lg-3 col-md-6 col-sm-12">
						<div class="team-1">
							<div class="team-img">
								<img src="images/blog2.jpg" alt="">
							</div>
							<h4> Team Member 1 </h4>
							<p> Co-Founder </p>
							<div class="social-btns">
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-facebook-f"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-twitter"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-instagram"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-linkedin-in"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-youtube"></i></div></a>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12">
						<div class="team-1">
							<div class="team-img">
								<img src="images/blog2.jpg" alt="">
							</div>
							<h4>  Team Member 2 </h4>
							<p> Founder </p>
							<div class="social-btns">
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-facebook-f"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-twitter"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-instagram"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-linkedin-in"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-youtube"></i></div></a>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12">
						<div class="team-1">
							<div class="team-img">
								<img src="images/blog2.jpg" alt="">
							</div>
							<h4>  Team Member 3</h4>
							<p> Manager </p>
							<div class="social-btns">
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-facebook-f"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-twitter"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-instagram"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-linkedin-in"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-youtube"></i></div></a>
							</div>
						</div>
					</div>
					<div class="col-lg-3 col-md-6 col-sm-12">
						<div class="team-1">
							<div class="team-img">
								<img src="images/blog2.jpg" alt="">
							</div>
							<h4>  Team Member 4 </h4>
							<p> Marketing Manager </p>
							<div class="social-btns">
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-facebook-f"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-twitter"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-instagram"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-linkedin-in"></i></div></a>
								<a href="#"><div class="social-btn soc-btn"><i class="fab fa-youtube"></i></div></a>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--our team end-->
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
	<script src="js/owlslider.js"></script>
	
  </body>

</html>
