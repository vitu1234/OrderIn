<?php
	 include("connection/Functions.php");
	 $operation = new Functions();
	session_start();
//for pagination
//check if user selected restaurant
if(!isset($_COOKIE['view_restaurant']) || empty($_COOKIE['view_restaurant'])){
	header("Location:browse_places");
}

	$product_id_load = '';
	$countProducts = 0;

		$rest_id = $_COOKIE['view_restaurant'];
	//get restaurant name
	$getRestaurantInfo = $operation->retrieveSingle("SELECT * FROM `restaurant_info` WHERE restaurant_id = '$rest_id'");

		$sql = "SELECT product_id,product_name,product_price, prep_mins, delivery_fee,products.img_url as prod_img_url, products.restaurant_id as restaurant_id, city_id, restaurant_name, restaurant_phone, restaurant_info.img_url as rest_img FROM products 
		INNER JOIN restaurant_info ON restaurant_info.restaurant_id = products.restaurant_id WHERE products.restaurant_id = '$rest_id' AND products.availability = 1 ORDER BY product_id DESC LIMIT 16";
		$productsLoad = $operation->retrieveMany($sql);
    	$countProducts = $operation->countAll($sql);
	
   
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

    <title>OrderIn | Restaurant Menu </title>

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
	<link rel="stylesheet" type="text/css" href="css/materialPreloader.css">
	<link rel="stylesheet" type="text/css" href="css/custom.css">
	<style>.shopping-cart {
    display: inline-block;
    background: url('http://cdn1.iconfinder.com/data/icons/jigsoar-icons/24/_cart.png') no-repeat 0 0;
    width: 20px;
    height: 20px;
    margin: 0 10px 0 0;
}</style>
</head>

<body>
	<div id="myNav" class="overlay"></div>
	<!--header start-->
			<header id="" class="default">
			<?php include('pages/top_bar.php') ?>
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
	<!--header end-->	
	<!--title-bar start-->
	<section class="title-bar">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="left-title-text">
					<h3 id="page_title1">Meals</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text" id="page_title2">  
						<ul>
							<li class="breadcrumb-item"><a href="index">Home</a></li>
							<li  class="breadcrumb-item active" aria-current="page">Meals</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--title-bar end-->
	<!--meals start-->
	<section class="all-partners mb-5" id="content">			
		<div class="container">		
			<div class="row">	
				
				<div >
					<div class="col-lg-12 col-md-12 m-left m-right">
						<div class="all-meals-show">
							<div class="new-heading">
<!--								<h1> MENU </h1>-->
								<div class="loc-title" id="page_title1">
									<?php
//									display city viewed from
										
											echo $getRestaurantInfo['restaurant_name']." - Meals";
										
									?>
									
								</div>
							</div>
						</div>
					</div>
				<div class="row" id="load_data_table">
					    <?php
                   if($countProducts > 0){
						foreach($productsLoad as $row){
								$image  ='';
								if($row['rest_img'] != ''){
									$image =$row['rest_img'];
								}else{
									$image = 'orderlogo1.png';
								}
							
							?>
							<div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<div class="all-meal" >
									<div class="top" >
										<a href="#meal_details" onclick="setValues('<?=$row['product_id']?>')"><div class="bg-gradient"></div></a>
										<div class="top-img">
											<img class="rounded" src="images/<?=$row['prod_img_url']?>" alt="">
										</div>
										
										<div class="top-text" >
											<div class="heading text-light"><h4><a href="#meal_details" onclick="setValues('<?=$row['product_id']?>')"><?=$row['product_name']?></a></h4></div>
											<div class="sub-heading">
											<h5 class="text-warning  mb-3"><?=$row['restaurant_name']?></h5>
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
								$product_id_load = $row['product_id'];
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
					   	<p class="text-center alert alert-warning">No Meals Found, try changing restaurant!</p>
					   </div>';
				   }
					?>
				</div>
					
		
				
				
			</div>			
		</div>
	</section>	
	<br><br><br>
	</div>
	<!--meals end-->
	<!--footer start-->
<?php include("footer.php"); ?>
	<!--footer end-->
<input type="hidden" id="product"/>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	<!-- Assect scripts for this page-->
	<script src="assets/owlcarousel/owl.carousel.js"></script>
	<script src="js/owlslider.js"></script>
	<script src="js/custom.js"></script>
	<script type="text/javascript" src="js/materialPreloader.js"></script>
	<script src="js/jquery.number.min.js"></script>
	<script src='//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js'></script>
	<script src="js/js.js"></script>
	 <script>  
 $(document).ready(function(){ 
     //load more button
      $(document).on('click', '#btn_more', function(){  
           var last_product_id = $(this).data("pid");  
           $('#btn_more').html('<div class="spinner-border spinner-border-sm" role="status"><span class="sr-only">Loading...</span></div><div class="spinner-grow spinner-grow-sm" role="status">  <span class="sr-only">Loading...</span></div>');  
           $.ajax({  
                url:"process/load_restaurant_menu.php",  
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
	 //detect hashchange
	  window.onhashchange = locationHashChanged;
      window.onload = loadData;
 });  
		 
	function setValues(product){
        $("#product").val(product);
     }
    
      function locationHashChanged() {  
        if (location.hash === "#") {  
           
        }else if(location.hash === "#meal_details"){
            var product = $("#product").val();
            setCookie('meal_detail',product,1);
            toMealDetail(product);     
        }else{
           window.location = "meals";
        }
      }
    
    function loadData(){
        if (location.hash === "#") {  
//           toAddMeal()
        }else if(location.hash === "#meal_details"){
          var product = getCookie('meal_detail');
            toMealDetail(product);     
        }else{
           
        }
    }
 </script>
  </body>

</html>
