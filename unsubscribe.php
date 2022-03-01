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
						<h3>Unsubscribe</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Unsubscribe</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--title-bar end-->	
	<!--what-is-natto start-->
	<section class="login_register">					
		<div class="container">					
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-6 col-12">
					
<!--					<div class="login-container">-->
						<div class="row">			
							<div class="col-lg-12 col-md-12 col-12">								
							   <div id="formCont">
								   <?php
								   		if(isset($_GET['q']) && !empty($_GET['q'])){
											$email = addslashes(urldecode($_GET['q']));
										
								   
								   ?>
									<form id="unsubscribeForm" enctype="multipart/form-data" action="" method="post">
										<div class="login-form">	

											<div id="unsubscribeResponse"></div>
											<div class="form-group">
												<input value="<?=$email?>"  type="hidden" class="video-form" name="email" id="email" placeholder="Enter Email " required />							
											</div>

											<button style="background-color:#FF7C2F;" id="unsubscribeBtn" type="submit" onclick="unsubscribe()" class="login-btn btn-link text-light">Unsubscribe</button>

										</div>	
									</form>
								   <?php
										}else{
											echo "<p>Ooops, Url not found <a href='index'> Browser Our Site</a></p>";
										}
									   ?>
                               </div>
							</div>
						</div>						
<!--					</div>						-->
				</div>				
			</div>			
		</div>
	</section>
	<!--what-is-natto end-->
	<!--download-link start-->
	
	<!--download-link end-->	
	<!--active-in-30-countries Start-->

	<!--active-in-30-countries end-->	

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
	<script src="js/js.js"></script>
	
  </body>

</html>
