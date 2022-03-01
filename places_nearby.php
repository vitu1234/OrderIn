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
	
    <title>OrderIn | Nearby</title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/mega.menu.css" rel="stylesheet">
    
	<!-- Owl Carousel for this template-->
	<link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css">
   	
    <!-- Fontawesome styles for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	
</head>

<body>
	<!--header start-->
<header id="header" class="default">
			<div class="topbar">
					<div class="container">
						<div class="row">
							<div class="col-md-4">
								<div class="topbar-left text-center text-md-left">
									<ul class="list-inline">
										<li> <a href="contact.html"> Contact </a></li>
										<li> <a href="about.html"> About Us </a></li>
										<li> <a href="our_blog.html"> Blog </a></li>											
									
									</ul>
								</div>
							</div>
							<div class="col-md-8">
								<div class="topbar-right text-center text-md-right">
									<ul class="list-inline">
																	
										<li><a href="checkout.html"><i class="fas fa-shopping-cart"></i>Food Orders <span class="badge badge-secondary">3</span></a></li>										
																				
										<li class="nav-item dropdown">
										<a  class="dropdown-toggle-no-caret" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i>Alinafe <i class="fas fa-caret-down"></i></a>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
											  <a class="dropdown-item" href="my_profile_dashbord.html"> My Profile</a>
											  <a class="dropdown-item" href="setting.html"> Setting</a>
											  <a class="dropdown-item" href="signin.html"> Logout</a>
											 
										   </div>
										</li>									
									</ul>
								</div>
							</div>
						</div>
					</div>
			</div>
			<div class="menu">
				<div class="container">
					<div class="row">
						<div class="col-md-2 col-sm-12 col-xs-12">
							<div class="menu-left text-center text-md-left">
								<div class="logo-box">
									<a href="index.html"><img src="images/orderlogo.png" alt=""></a>
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
												<a class="nav-link" href="index.html">Home </a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="how_to_orders.html">How To Orders?</a>
											</li>
											<li class="nav-item  active">
												<a class="nav-link" href="#">Browse Places</a>
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

							
										<li class="partner-btn">
											<a href="signin.html" class="b-btn btn-link">Sign In</a>
										</li>	
										<li class="partner-btn">
											<a href="signup.html" class="b-btn btn-link">Create Account</a>
										</li>									
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
					<h3>Nearby</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index.html">Home</a></li>
							<li class="breadcrumb-item"><a href="browse_places.html">Browse Places</a></li>
							<li class="breadcrumb-item active" aria-current="page">Nearby</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--title-bar end-->	
	<!--browse-places start-->
	<section class="browse-places-all">			
		<div class="container">		
			<div class="row">	
				<div class="col-md-12">
					<div class="new-heading">
						<h1> Nearby Places </h1>
					</div>						
				</div>
			</div>
			<div class="row">
				<div class="col-lg-12 col-md-12 text-left">
					<div class="form-group">
						<label for="searchLocation">Search Your Location</label>
						<div class="field-input">
							<input type="text" class="nearby-form" id="searchLocation"  placeholder="Search your location">							
							<i class="fas fa-search"></i>
						</div>											
					</div>
					<div class="map-1">
						<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d245730.10222151442!2d34.890676124600816!3d-15.775833268576772!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x18d84513cbc0005f%3A0x236358dae4d811e6!2sBlantyre!5e0!3m2!1sen!2smw!4v1598189152492!5m2!1sen!2smw" style="border:0" allowfullscreen></iframe>
					</div>
				</div>	
				<div class="col-lg-12 col-md-12 col-12 text-left">
					<div class="places-heading">
						<h1>Near Places</h1>
					</div>
				</div>			
			</div>
			<div class="row text-left">
				<div class="col-lg-6 col-md-12 col-12">
					<div class="partner-section">
						<div class="partner-bar">
							<div class="partner-topbar">
								<div class="partner-dt">
									<a href="restaurant_detail.html"><img src="images/food4.jpg" alt=""></a>
									<div class="partner-name">
										<a href="restaurant_detail.html"><h4>Amazing Bakes</h4></a>
										<div class="country">Blantyre, Malawi</div>
										<p><span><i class="fas fa-map-marker-alt"></i></span>Victoria Avenue</p>
									
									</div>
									
								</div>
							</div>
							<div class="partner-subbar">
								<div class="detail-text">
									<ul>
										<li>Open - Close : 9.00AM to 12PM (Mon-Sun)</li>
										<li>Cuisines : Lunch, Breakfast, Dinner</li>
										<li>Discount : 20% of on all orders</li>
										
									</ul>
								</div>
							</div>
							<div class="partner-bottombar">
								<ul class="bottom-partner-links">
								
									<li><a href="meals.html" data-toggle="tooltip" data-placement="top" title="View Menu"><i class="fas fa-book"></i> View Menu</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
					<div class="col-lg-6 col-md-12 col-12">
					<div class="partner-section">
						<div class="partner-bar">
							<div class="partner-topbar">
								<div class="partner-dt">
									<a href="restaurant_detail.html"><img src="images/food5.jpg" alt=""></a>
									<div class="partner-name">
										<a href="restaurant_detail.html"><h4>Amazing Bakes</h4></a>
										<div class="country">Blantyre, Malawi</div>
										<p><span><i class="fas fa-map-marker-alt"></i></span>Victoria Avenue</p>
									
									</div>
									
								</div>
							</div>
							<div class="partner-subbar">
								<div class="detail-text">
									<ul>
										<li>Open - Close : 9.00AM to 12PM (Mon-Sun)</li>
										<li>Cuisines : Lunch, Breakfast, Dinner</li>
										<li>Discount : 20% of on all orders</li>
										
									</ul>
								</div>
							</div>
							<div class="partner-bottombar">
								<ul class="bottom-partner-links">
								
									<li><a href="meals.html" data-toggle="tooltip" data-placement="top" title="View Menu"><i class="fas fa-book"></i> View Menu</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			<div class="col-lg-6 col-md-12 col-12">
					<div class="partner-section">
						<div class="partner-bar">
							<div class="partner-topbar">
								<div class="partner-dt">
									<a href="restaurant_detail.html"><img src="images/food5.jpg" alt=""></a>
									<div class="partner-name">
										<a href="restaurant_detail.html"><h4>Amazing Bakes</h4></a>
										<div class="country">Blantyre, Malawi</div>
										<p><span><i class="fas fa-map-marker-alt"></i></span>Victoria Avenue</p>
									
									</div>
									
								</div>
							</div>
							<div class="partner-subbar">
								<div class="detail-text">
									<ul>
										<li>Open - Close : 9.00AM to 12PM (Mon-Sun)</li>
										<li>Cuisines : Lunch, Breakfast, Dinner</li>
										<li>Discount : 20% of on all orders</li>
										
									</ul>
								</div>
							</div>
							<div class="partner-bottombar">
								<ul class="bottom-partner-links">
								
									<li><a href="meals.html" data-toggle="tooltip" data-placement="top" title="View Menu"><i class="fas fa-book"></i> View Menu</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
	<div class="col-lg-6 col-md-12 col-12">
					<div class="partner-section">
						<div class="partner-bar">
							<div class="partner-topbar">
								<div class="partner-dt">
									<a href="restaurant_detail.html"><img src="images/food4.jpg" alt=""></a>
									<div class="partner-name">
										<a href="restaurant_detail.html"><h4>Amazing Bakes</h4></a>
										<div class="country">Blantyre, Malawi</div>
										<p><span><i class="fas fa-map-marker-alt"></i></span>Victoria Avenue</p>
									
									</div>
									
								</div>
							</div>
							<div class="partner-subbar">
								<div class="detail-text">
									<ul>
										<li>Open - Close : 9.00AM to 12PM (Mon-Sun)</li>
										<li>Cuisines : Lunch, Breakfast, Dinner</li>
										<li>Discount : 20% of on all orders</li>
										
									</ul>
								</div>
							</div>
							<div class="partner-bottombar">
								<ul class="bottom-partner-links">
								
									<li><a href="meals.html" data-toggle="tooltip" data-placement="top" title="View Menu"><i class="fas fa-book"></i> View Menu</a></li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--browse-places end-->
	<!--footer start-->
		<footer class="footer">
		<div class="subscribe-now line">
			<div class="container">
				<div class="row justify-content-between">
					<div class="col-lg-5 col-md-6">
						<div class="subscribe-newsletter">
							<div class="sub-text">
								<p>Connect with us for update and offers.</p>
							</div>
							<form>
								<input class="input-subscribe" name="newsletter" type="text" placeholder="Enter your email address">
								<div class="subscribe-btn">							
									<div class="s-n-btn">
										<button class="newsletter-btn btn-link">Subscribe Now</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
					<div class="img-title " >
						<a href="index.html" ><img width="250px" class="bg-light" src="images/orderInLogo.png" alt=""></a>
					</div>
					<p class="text-justify">At OrderIn,  we offer the delivery of a wide selection of meals of excellent quality from your trusted restaurants. Are you in the mood for burgers? wraps? pizza? cake? Biryani? We’ve got you covered.  </p>
				</div>
				<div class="col-md-3 col-sm-12 col-xs-12">
					<div class="link-title">
						<h4>About OrderIn</h4>
						<ul class="links">
							<li><a href="about.html">About Us</a></li>
							<li><a href="#">Careers</a></li>
							<li><a href="our_blog.html">Blog</a></li>
							<li><a href="#">Mobile Apps</a></li>
							<li><a href="contact.html">Contact</a></li>
						</ul>
					</div>					
				</div>
				<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
					<div class="link-title">
						<h4>Business</h4>
						<ul class="links">
							<!--<li><a href="add_restaurant.html">Add a Restaurant</a></li>-->
							<li><a href="#">Order Guidelines</a></li>
							<li><a href="#">Orders</a></li>
							<li><a href="#">Book</a></li>
							<li><a href="#">Trace</a></li>
							<li><a href="#">Advertise</a></li>
						</ul>
					</div>					
				</div>
				<div class="col-lg-3 col-md-4 col-sm-12 col-xs-12">
					<div class="link-title">
						<h4>Partner With Us</h4>
						<ul class="links">
							<!--<li><a href="add_restaurant.html">For Restaurants</a></li>-->
						</ul>
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
		<div class="privacy-cards">
			<div class="container">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="privacy-terms">
							<ul>
								<li><a href="#">Privacy</a></li>
								<li><a href="#">Terms & Conditions</a></li>
								<li><a href="#">Sitemap</a></li>
							</ul>
						</div>
					</div>
					<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
						<div class="cards">
							<img src="images/cards.png" alt="">
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="copyright">
			<div class="container">
				<div class="row">
					<div class="col-lg-12 col-md-12">
						<div class="copyright-text">
						<i class="far fa-copyright"></i>Copyright <script>document.write(new Date().getFullYear());</script> <a href="index.html">OrderIn</a>Design by <a class="text-light" href="https://netsoftmw.com">NetSoftMalawi</a>. All Rights Reserved.
						</div>
					</div>			
				</div>
			</div>
		</div>
	</footer>
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
