<?php
 include("connection/Functions.php");
	 $operation = new Functions();
	session_start();
	//check if user selected city
	$product_id_load = '';
	$countProducts = 0;
	if(isset($_SESSION['selected_city'])){
		$city_id = $_SESSION['selected_city'];
		$sql = "SELECT * FROM `restaurant_info` WHERE city_id = '$city_id' ORDER BY restaurant_id DESC LIMIT 16";
		$productsLoad = $operation->retrieveMany($sql);
    	$countProducts = $operation->countAll($sql);
	}else{
		$sql = "SELECT * FROM `restaurant_info` ORDER BY restaurant_id DESC LIMIT 16";
		$productsLoad = $operation->retrieveMany($sql);
    	$countProducts = $operation->countAll($sql);
	}

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
	
    <title>OrderIn | Browse Places</title>

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
			<?php include("pages/top_bar.php"); ?>
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
											<li class="nav-item">
												<a class="nav-link" href="how_to_orders">How To Order?</a>
											</li>
											<li class="nav-item  active">
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
	<!--header end-->
	<div class="" id="searchedContent">
	
	</div>
	
	<div id="replaceSearch">
	<!--title-bar start-->
	<section class="title-bar">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="left-title-text">
					<h3>Browse Places</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Browse Places</li>
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
						<h1> Browse Places </h1>
					</div>						
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-6">
					<div class="about-text1">
						<p>Browse your favourite restaurants <?php
//									display city viewed from
										if(isset($_SESSION['selected_city'])){
											$city = $_SESSION['selected_city'];
											$getCity = $operation->retrieveSingle("SELECT *FROM cities WHERE city_id = '$city'");
											echo " in ".$getCity['city_name'];
										}else{
											echo " in all Cities ";
										}
									?></p>
					</div>						
				</div>
			</div>
			<section class="browse-places-all">			
				<div class="container">		
					<div class="row text-left">
						
										<div >
					
				<div class="row" id="load_data_table">
					    <?php
                   if($countProducts > 0){
						foreach($productsLoad as $row){
							$ids = $row['restaurant_id'];
							$cit = $row['city_id'];
							$city = $operation->retrieveSingle("SELECT *FROM cities WHERE city_id='$cit'");
								$image  ='';
								if($row['img_url'] != ''){
									$image =$row['img_url'];
								}else{
									$image = 'orderlogo1.png';
								}
							
							?>
							<div class="col-lg-6 col-md-12 ">
							<div class="partner-section">
								<div class="partner-bar">
									<div class="partner-topbar">
										<div class="partner-dt">
											<a onclick="setRestaurant('<?=$ids?>')" href="javascript:void(0);"><img src="images/<?=$image?>" alt=""></a>
											<div class="partner-name" style="width:100%;">
												<a onclick="setRestaurant('<?=$ids?>')" href="javascript:void(0);"><h4><?=$row['restaurant_name']?></h4></a>
												<div class="country"><?=$city['city_name']?></div>
												<p class="text-justify" ><span><i class="fas fa-map-marker-alt"></i></span><?=$row['restaurant_address']?> - <?=$row['exact_location']?></p>

											</div>

										</div>
									</div>
								
									<div class="partner-bottombar">
										<ul class="bottom-partner-links">

											<li><a onclick="setRestaurant('<?=$ids?>')" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="View Menu"><i class="fas fa-book"></i> View Menu</a></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
							<?php
								$product_id_load = $row['restaurant_id'];
						}
						?>
		
			</div>
				<?php
					   if($countProducts >= 16){
						   ?>
				<div class="col-lg-12 col-md-12 col-sm-12  text-center pt-5" id="remove_row" style="">
				<div class="partner-btn">
					<button type="button" class="b-btn btn-link" style="background-color:#FF7C2F;" name="btn_more" data-pid="<?php echo $product_id_load; ?>" id="btn_more" >LOAD MORE</button>
					</div>
					
			</div>
					<?php
					   }
					}else{
					   echo '<div class="col-lg-12 col-md-12 col-sm-12  text-center pt-5">
					   	<p class="text-center alert alert-warning">No Meals Found, try changing city!</p>
					   </div>';
				   }
					?>
				</div>
						
						
					</div>
				</div>
			</section>
		</div>
	</section>
	<!--browse-places end-->	
	</div>
	<!--footer start-->
	<?php include("footer.php");?>
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
	
	<script>
		 $(document).ready(function(){ 
     //load more button
      $(document).on('click', '#btn_more', function(){  
           var last_product_id = $(this).data("pid");  
           $('#btn_more').html('<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div><div class="spinner-grow spinner-grow-sm" role="status">  <span class="sr-only">Loading...</span></div>');  
           $.ajax({  
                url:"process/load_browse_places.php",  
                method:"POST",  
                data:{last_product_id:last_product_id},  
                dataType:"text",  
                success:function(data)  
                {  
                     if(data != '')  
                     {  
                          $('#remove_row').remove();  
                          $('#load_data_table').append(data);  
                     }  
                     else  
                     {  
                          $('#btn_more').html("No Data");  
                     }  
                }  
           });  
      }); 

 });  
	
	</script>
  </body>

</html>
