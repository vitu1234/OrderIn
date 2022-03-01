
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

    <title>OrderIn | Home </title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/mega.menu.css" rel="stylesheet">
	<link href="css/owlslider.css" rel="stylesheet">
	<link href="css/search.css" rel="stylesheet">
    
	<!-- Owl Carousel for this template-->
	<link href="vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
	<link href="vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
	
    <!-- Fontawesome styles for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	 <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.css" media="screen">
	<link href="css/gallery.css" rel="stylesheet">
		<style>.shopping-cart {
    display: inline-block;
    background: url('http://cdn1.iconfinder.com/data/icons/jigsoar-icons/24/_cart.png') no-repeat 0 0;
    width: 20px;
    height: 20px;
    margin: 0 10px 0 0;
}</style>
</head>

<body>
	<!--header start-->
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
											<li class="nav-item active">
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
	<!--header end-->
	<!--banner start-->
		<section class="block-preview">
			<div class="cover-banner" style="background-image: url(images/slide1.jpg)"></div>
			<div class="container">
				<div class="row">	
					<div class="col-lg-8 col-md-6 col-sm-12">
						<div class="left-text-b">
							<h6 class="exeption">You order, we deliver.</h6>
							<h1 class="title">OrderIn</h1>
							
							<!--<p>Get our services from 24 hours.</p>-->
							<a style="background-color:#FF7C2F;" class="bnr-btn btn-link" href="meals">See Menu and Order</a>
						</div>
					</div>
					<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<form method="post" action="" id="addCityForm"> 
							<div class="form-box">
								<div id="citySetResponse"></div>
								<div class="input-group-prepend">
<!--								  <div class="input-group-text"><i class="fas fa-map-marker-alt"></i></div>-->
								</div>
								<select name="customer_city"  id="customer_city" required class="find-resto skills" >
								<?php
									$getCities = $operation->retrieveMany("SELECT * FROM `cities` ");
									
									if(isset($_SESSION['selected_city'])){
										?>
										<option value="all">All Cities</option>
										<?php
										foreach($getCities as $row){
											$selected = '';
											if($row['city_id'] == $_SESSION['selected_city']){
												$selected = 'selected';
											}
											echo '<option '.$selected.' value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
										}
									}else{
										?>
										<option selected disabled>-Select City-</option>
										<?php
										foreach($getCities as $row){
											echo '<option value="'.$row['city_id'].'">'.$row['city_name'].'</option>';
										}
										
									}
								?>
								</select>
								<button style="background-color:#FF7C2F;" id="addCityBtn" onclick="setCity()" class="search-btn btn-link" type="submit"><i class="fas fa-map-marker-alt"></i> Find Food</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</section>
	<!--banner end-->
	
	<!--browse-places start-->
	<section class="browse-places">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="browse-heading">
						<h6> Browse Places </h6>
					</div>
				</div>
			</div>
			<div class="row">				
				<div class="col-lg-12 col-md-12">
					<div class="owl-carousel browse-owl owl-theme">
						
						<?php
							
							if(isset($_SESSION['selected_city'])){
								$city_id = $_SESSION['selected_city'];
								$getRestaurants = $operation->retrieveMany("SELECT * FROM `restaurant_info` WHERE city_id = '$city_id'");
								
									foreach($getRestaurants as $row){
										$rest_id = $row['restaurant_id'];
										$image  ='';
										if($row['img_url'] != ''){
											$image =$row['img_url'];
										}else{
											$image = 'orderlogo1.png';
										}
										echo '<div class="item">
												<div class="places">
													<a onclick="setRestaurant('.$rest_id.')" href="javascript:void(0);">
														<div class="b-icon">
															<img class="rounded" width="80px" height="100px" src="images/'.$image.'" alt="">
														</div>
														<div class="b-text">
															'.$row['restaurant_name'].'
														</div>
													</a>
												</div>
											</div>';
									}
								}else{
									$getRestaurants = $operation->retrieveMany("SELECT * FROM `restaurant_info`");
								
									foreach($getRestaurants as $row){
										$rest_id = $row['restaurant_id'];
										$image  ='';
										if($row['img_url'] != ''){
											$image =$row['img_url'];
										}else{
											$image = 'orderlogo1.png';
										}
										echo '<div class="item mx-2">
												<div class="places">
													<a onclick="setRestaurant('.$rest_id.')" href="javascript:void(0);">
														<div class="b-icon">
															<img class="rounded" width="80px" height="100px" src="images/'.$image.'" alt="">
														</div>
														<div class="b-text">
															'.$row['restaurant_name'].'
														</div>
													</a>
												</div>
											</div>';
									}

								}
						
						?>
						
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--browse-places end-->	
	<!--how-to-work start-->

	<!--how-to-work end-->	
	<!--discover-new-restaurants-&-book-now start-->
	<!--discover-new-restaurants-&-book-now end-->	
	<!--order-food-online-in-your-area start-->
	<section class="order-food-online">		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="new-heading">
						<h1> Order Food Online</h1>
					</div>
				</div>
			</div>
			<div class="row">
<!--				get random foods-->
				
				<?php
					if(isset($_SESSION['selected_city'])){
						$city_id = $_SESSION['selected_city'];
						$getRandomProducts = $operation->retrieveMany("SELECT product_id,product_name,product_price, prep_mins, delivery_fee,products.img_url as prod_img_url, products.restaurant_id as restaurant_id, city_id, restaurant_name, restaurant_phone, restaurant_info.img_url as rest_img FROM products INNER JOIN restaurant_info ON restaurant_info.restaurant_id = products.restaurant_id WHERE restaurant_info.city_id = '$city_id' AND products.availability = 1 ORDER BY RAND() LIMIT 4");
						
						foreach($getRandomProducts as $row){
							$rest = $row['restaurant_id'];
							$prod_id = $row['product_id'];
								$image  ='';
								if($row['rest_img'] != ''){
									$image =$row['rest_img'];
								}else{
									$image = 'orderlogo1.png';
								}
							
							?>
							<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
								<div class="all-meal">
									<div class="top">
										<a href="javascript:void(0);" onclick="setMeal('<?=$prod_id?>')"><div class="bg-gradient"></div></a>
										<div class="top-img">
											<img class="rounded" src="images/<?=$row['prod_img_url']?>" alt="">
										</div>

										<div class="top-text">
											<div class="heading text-light"><h4><a href="javascript:void(0);" onclick="setMeal('<?=$prod_id?>')"><?=$row['product_name']?></a></h4></div>
											<div class="sub-heading">
											<h5 class="text-warning  mb-3"><a href="javascript:void(0);" onclick="setRestaurant('<?=$rest?>')"><?=$row['restaurant_name']?></a></h5>
											<p>MWK<?=number_format($row['product_price'],2)?></p>
											</div>
										</div>
									</div>
									<div class="bottom">
										<div class="bottom-text">
											<div class="delivery"><i class="fas fa-shopping-cart"></i>Delivery Fee : MWK <?=number_format($row['delivery_fee'],2)?></div>
											<div class="time"><i class="far fa-clock"></i>Preparing Time : <?=$row['prep_mins']?> Min(s)</div>

										</div>
									</div>
								</div>					
							</div>
							<?php
						}
						
					}else{
						$getRandomProducts = $operation->retrieveMany("SELECT product_id,product_name,product_price, prep_mins, delivery_fee,products.img_url as prod_img_url, products.restaurant_id as restaurant_id, city_id, restaurant_name, restaurant_phone, restaurant_info.img_url as rest_img FROM products INNER JOIN restaurant_info ON restaurant_info.restaurant_id = products.restaurant_id WHERE products.availability = 1 ORDER BY RAND() LIMIT 4");
						
						foreach($getRandomProducts as $row){
							$prod_id = $row['product_id'];
							$rest = $row['restaurant_id'];
								$image  ='';
								if($row['rest_img'] != ''){
									$image =$row['rest_img'];
								}else{
									$image = 'orderlogo1.png';
								}
							
							?>
							<div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
								<div class="all-meal">
									<div class="top">
										<a href="javascript:void(0);" onclick="setMeal('<?=$prod_id?>')"><div class="bg-gradient"></div></a>
										<div class="top-img">
											<img class="rounded" src="images/<?=$row['prod_img_url']?>" alt="">
										</div>
										
										<div class="top-text">
											<div class="heading text-light"><h4><a href="javascript:void(0);" onclick="setMeal('<?=$prod_id?>')"><?=$row['product_name']?></a></h4></div>
											<div class="sub-heading">
											<h5 class="text-warning  mb-3"><a href="javascript:void(0);" onclick="setRestaurant('<?=$rest?>')"><?=$row['restaurant_name']?></a></h5>
											<p>MWK<?=number_format($row['product_price'],2)?></p>
											</div>
										</div>
									</div>
									<div class="bottom">
										<div class="bottom-text">
											<div class="delivery"><i class="fas fa-shopping-cart"></i>Delivery Fee : MWK <?=number_format($row['delivery_fee'],2)?></div>
											<div class="time"><i class="far fa-clock"></i>Preparing Time : <?=$row['prep_mins']?> Min(s)</div>

										</div>
									</div>
								</div>					
							</div>
							<?php
						}
					}
				
				?>
	
			
			</div>
			<div class="meal-btn">
				<a style="background-color:#FF7C2F;" href="meals" class="m-btn btn-link">Show All</a>
			</div>
		</div>
	</section>
	<!--order-food-online-in-your-area end-->	
	<!--offer-banners start-->

	<!--offer-banners end-->	
	<!--featured-restaurants start-->
	<section class="featured-restaurants">
		<div class="container">				
			<div class="row">									
				<div class="col-lg-8">
					<div class="new-heading">
						<h1> Featured Restaurants </h1>
					</div>
					<div class ="bg-resto">
					<?php
						//show random restaurant
					
							if(isset($_SESSION['selected_city'])){
								$city_id = $_SESSION['selected_city'];
								$getRestaurants = $operation->retrieveMany("SELECT * FROM `restaurant_info` WHERE city_id = '$city_id' ORDER BY RAND() LIMIT 5");
								
									foreach($getRestaurants as $row){
										$rest_id = $row['restaurant_id'];
										$image  ='';
										if($row['img_url'] != ''){
											$image =$row['img_url'];
										}else{
											$image = 'orderlogo1.png';
										}
										echo '			
										<div class="resto-item">	
											<div class="row">	
												<div class="col-md-4 col-sm-12">
													<div class="resto-img">
														<img class="rounded" height="55px" width="50px" src="images/'.$image.'" alt="">
														<div class="resto-name">
															<h4><a onclick="setRestaurant('.$rest_id.')" href="javascript:void(0);">'.$row['restaurant_name'].'</a></h4>
															
														</div>
													</div>
												</div>
												<div class="col-md-4 col-sm-12">															
													<div class="resto-location">

														<span><i class="fas fa-map-marker-alt"></i>  </span> 
														'.$row['restaurant_address'].' - '.$row['exact_location'].'
													</div>						
												</div>	
												<div class="col-md-4 col-sm-12">															
													<div class="menu-btn">
														<a style="background-color:#FF7C2F;" onclick="setRestaurant('.$rest_id.')" class="mn-btn btn-link" href="javascript:void(0);"> View Menu</a>  
													</div>						
												</div>
											</div>						
										</div>';
									}
								}else{
									$getRestaurants = $operation->retrieveMany("SELECT * FROM `restaurant_info` ORDER BY RAND() LIMIT 5");
								
									foreach($getRestaurants as $row){
										$rest_id = $row['restaurant_id'];
										$image  ='';
										if($row['img_url'] != ''){
											$image =$row['img_url'];
										}else{
											$image = 'orderlogo1.png';
										}
										echo '			
										<div class="resto-item">	
											<div class="row">	
												<div class="col-md-4 col-sm-12">
													<div class="resto-img">
														<img class="rounded" height="55px" width="50px" src="images/'.$image.'" alt="">
														<div class="resto-name">
															<h4><a onclick="setRestaurant('.$rest_id.')" href="javascript:void(0);">'.$row['restaurant_name'].'</a></h4>
															
														</div>
													</div>
												</div>
												<div class="col-md-4 col-sm-12">															
													<div class="resto-location">

														<span><i class="fas fa-map-marker-alt"></i>  </span> 
														'.$row['restaurant_address'].' - '.$row['exact_location'].'
													</div>						
												</div>	
												<div class="col-md-4 col-sm-12">															
													<div class="menu-btn">
														<a style="background-color:#FF7C2F;" class="mn-btn btn-link" onclick="setRestaurant('.$rest_id.')" href="javascript:void(0);"> View Menu</a>  
													</div>						
												</div>
											</div>						
										</div>';
									}

								}
						
						?>
				
						
				
					</div>
				</div>
				<div class="col-lg-4">
					<div class="new-heading treading-sellers">
						<h1> Most Ordered</h1>
					</div>
					<div class ="bg-resto">
						<?php
						//show Trending restaurant
						$sql = "SELECT products.product_id,products.product_name,products.restaurant_id,products.img_url AS prod_img_url,COUNT(*) AS total FROM `orders`
						INNER JOIN products ON products.product_id = orders.product_id WHERE products.availability = 1
						GROUP BY product_id  ORDER BY total LIMIT 5";
						$getOrders = $operation->retrieveMany($sql);
						if(isset($_SESSION['selected_city'])){
							$city = $_SESSION['selected_city'];
							foreach($getOrders as $row){
								$prod_id = $row['product_id'];
								$rest_id = $row['restaurant_id'];
								//get restaurant name
								$countCity = $operation->countAll("SELECT *FROM restaurant_info WHERE restaurant_id = '$rest_id' AND city_id = '$city_id'");
								if($countCity >0){
								$getRest = $operation->retrieveSingle("SELECT *FROM restaurant_info WHERE restaurant_id = '$rest_id' AND city_id = '$city_id'");
								
								echo '	
								<div class="treading-item">	
									<div class="row">	
										<div class=" col-lg-7 col-md-6">
											<div class="resto-img">
												<img height="55px" width="50px" class="rounded"  src="images/'.$row['prod_img_url'].'" alt="">
												<div class="resto-name">
													<h4><a  href="javascript:void(0);" onclick="setMeal('.$prod_id.')"> '.$row['product_name'].' </a></h4>
													<p><small>'.$getRest['restaurant_name'].'</small></p>
												</div>										
											</div>

										</div>	
										<div class="col-lg-5 col-md-6 ">
											<div class="menu-btn">
												<a style="background-color:#FF7C2F;" class="mn-btn btn-link" href="javascript:void(0);" onclick="setMeal('.$prod_id.')">View Meal</a>  
											</div>
										</div>
									</div>						
								</div>';
								}
							}
						}else{

							foreach($getOrders as $row){
								$prod_id = $row['product_id'];
								$rest_id = $row['restaurant_id'];
								//get restaurant name
								$getRest = $operation->retrieveSingle("SELECT *FROM restaurant_info WHERE restaurant_id = '$rest_id'");
								echo '	
								<div class="treading-item">	
									<div class="row">	
										<div class=" col-lg-7 col-md-6">
											<div class="resto-img">
												<img height="55px" width="50px" class="rounded" src="images/'.$row['prod_img_url'].'" alt="">
												<div class="resto-name">
													<h5><a href="javascript:void(0);" onclick="setMeal('.$prod_id.')"> '.$row['product_name'].' </a></h5>
													<p><small>'.$getRest['restaurant_name'].'</small></p>
												</div>										
											</div>

										</div>	
										<div class="col-lg-5 col-md-6 ">
											<div class="menu-btn">
												<a style="background-color:#FF7C2F;" class="mn-btn btn-link" href="javascript:void(0);" onclick="setMeal('.$prod_id.')">View Meal</a>  
											</div>
										</div>
									</div>						
								</div>';
							}
						}
						?>
						
						
						
					</div>
				</div>
				
			</div>	
		</div>
		
	</section>
	<!--featured restaurants end-->	
	<!--explore-your-favorite-recipes start-->
	<section class="explore-recipes">			
		<div class="container">		
			<div class="row">	
				<div class="col-md-12">
					<div class="new-heading">
						<h1> Our Food </h1>
						<p><small>WE OFFER THE BEST SELECTION OF FOOD FROM YOU FAVORITE RESTAURANTS IN TOWN</small></p>
					</div>	
				</div>
			</div>
			<div class="b-recipes">

				    <!-- Page Content -->
   <div class="container page-top">



        <div class="row">


            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="images/food1.jpg" class="fancybox" rel="ligthbox">
                    <img  src="images/food1.jpg" class="zoom img-fluid "  alt="">
                   
                </a>
            </div>
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="images/food2.jpg"  class="fancybox" rel="ligthbox">
                    <img  src="images/food2.jpg" class="zoom img-fluid"  alt="">
                </a>
            </div>
            
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="images/food3.jpg" class="fancybox" rel="ligthbox">
                    <img  src="images/food3.jpg" class="zoom img-fluid "  alt="">
                </a>
            </div>
            
            <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="images/food4.jpg" class="fancybox" rel="ligthbox">
                    <img  src="images/food4.jpg" class="zoom img-fluid "  alt="">
                </a>
            </div>
            
             <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="images/food5.jpg" class="fancybox" rel="ligthbox">
                    <img  src="images/food6.jpg" class="zoom img-fluid "  alt="">
                </a>
            </div>
            
             <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="images/food6.jpg" class="fancybox" rel="ligthbox">
                    <img  src="images/food7.jpg" class="zoom img-fluid "  alt="">
                </a>
            </div>
            
<!--
             <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="https://images.pexels.com/photos/56005/fiji-beach-sand-palm-trees-56005.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="fancybox" rel="ligthbox">
                    <img  src="https://images.pexels.com/photos/56005/fiji-beach-sand-palm-trees-56005.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="zoom img-fluid "  alt="">
                </a>
            </div>
            
             <div class="col-lg-3 col-md-4 col-xs-6 thumb">
                <a href="https://images.pexels.com/photos/1038002/pexels-photo-1038002.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="fancybox" rel="ligthbox">
                    <img  src="https://images.pexels.com/photos/1038002/pexels-photo-1038002.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=650&w=940" class="zoom img-fluid "  alt="">
                </a>
            </div>
-->
            
            
           
           
       </div>

     
      

    </div>
				
			</div>
		
		</div>
	</section>
	<!--explore-your-favorite-recipes end-->	
	<!--download-link start-->
	<section class="pocket-block-preview">
			<!--<div class="pocket-cover-banner" style="background-image: url(images/homepage/bottom-banner.jpg)"></div>
			<div class="container">
				<div class="row">	
					<div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">
						<div class="pocket-items">
							<div class="new-heading">
								<h1>Orderin in Your Pocket</h1>
							</div>
							<div class="line">
								<img src="images/homepage/line.svg" alt="">
							</div>
							<p>We’ll send you a link, open it on your phone to download the app.</p>
							<form class="search-form">
								<input type="text" class="send-link" placeholder="Enter your email address">
								<button type="submit" class="pocket-btn">Send Link</button>
							</form>
							<div class="download-btns">
								<a href="#"><img src="images/homepage/app-store.png" alt=""></a>
								<a href="#"><img src="images/homepage/play-store.png" alt=""></a>
							</div>
						</div>
					</div>
					<div class="col-lg-5 col-md-5">
						<div class="mobile-image">
							<img src="images/homepage/mobile.png" alt="">
						</div>
					</div>
				</div>
			</div>-->
		</section>
	</div>
	<!--download-link end-->	
	<!--footer start-->
<?php include("footer.php");?>	  

    <!--Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	 <!--Assect scripts for this page-->
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="js/owlslider.js"></script>
	<script src="js/js.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>
  </body>

</html>
<script>
$(document).ready(function(){
	$("#searchedContent").hide();
  $(".fancybox").fancybox({
        openEffect: "none",
        closeEffect: "none"
    });
    
    $(".zoom").hover(function(){
		
		$(this).addClass('transition');
	}, function(){
        
		$(this).removeClass('transition');
	});
});
    
</script>