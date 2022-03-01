<?php
include("../connection/Functions.php");
$operation = new Functions();
	session_start();
//check if logged in
if(!isset($_SESSION['restaurant']) || empty($_SESSION['restaurant'])){
	header("Location:login.php");
}

$user_id = $_SESSION['restaurant'];

//get city
$user = $operation->retrieveSingle("SELECT * FROM `users` WHERE user_id = '$user_id' AND user_role = 'manager'");
$city_id = $user['city_id'];

$orders_total = 0;
$food_tems = '';

//get the restaurant assigned to
$getRestaurant = $operation->retrieveSingle("SELECT * FROM `restaurant_managers` WHERE user_id = '$user_id'");
$rest_id = $getRestaurant['restaurant_id'];

$getRest = $operation->retrieveSingle("SELECT * FROM `restaurant_info` WHERE restaurant_id = '$rest_id'");
$city_id = $getRest['city_id'];
$getCities = $operation->retrieveMany("SELECT * FROM `cities` ");


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
	<link href="../images/orderlogo1.png" rel="shortcut icon" type="image/x-icon"/>

    <title>OrderIn | Manager </title>
    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
	<link href="../css/responsive.css" rel="stylesheet">
	<link href="../css/mega.menu.css" rel="stylesheet">
	<link href="../css/owlslider.css" rel="stylesheet">
  <link href="css/custom.css" rel="stylesheet">
    
	<!-- Owl Carousel for this template-->
	<link href="../vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
	<link href="../vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
	
    <!-- Fontawesome styles for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	    <!-- DataTables CSS -->
    <link href="../vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
 
    <!-- DataTables Responsive CSS -->
<!--    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">-->
  <link rel="stylesheet" type="text/css" href="css/materialPreloader.css">
</head>
<style>
  label{
    color: #000;
  }
	select, label, option,input{
    color: #000;
  }
  input[type="text"]{
    color: #000 !important;
  }
  
  textarea{
    color: #000 !important;
  }
  
   input[type="text"],input[type="email"], input[type="password"]{
    color: #000 !important;
  }
  </style>
<body>
  <div id="myNav" class="overlay"></div>
	<!--header start-->
		<header id="" class="default">
	
			<div class="menu">
				<div class="container">
					<div class="row">
						<div class="col-md-2 col-sm-12 col-xs-12">
							<div class="menu-left text-center text-md-left">
								<div class="logo-box">
									<a href="index"><img src="../images/orderlogo.png" alt="" height="60px"></a>
								</div>
							</div>
						</div>
						<div class="col-md-10 col-sm-12 col-xs-12 mt-3">	
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
												<a class="nav-link" href="orders">Orders</a>
											</li>
											
											<li class="nav-item ">
												<a class="nav-link" href="meals">Meals</a>
											</li>
										</ul>											
									</div>
									
								</nav>
								<div class="icons-set">
									<ul class="list-inline">

											<li class="nav-item dropdown">
												<a  class="dropdown-toggle-no-caret" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i><?=$user['fname']?>  <i class="fas fa-caret-down"></i></a>
													<div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
													  <a class="dropdown-item" href="profile"> My Profile</a>
													  <a class="dropdown-item" href="restaurant_info"> Restaurant Info.</a>
													  <a class="dropdown-item" href="logout"> Logout</a>

												   </div>
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
					<h3 id="page_title1">Restaurant Info.</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index">Home</a></li>
							<li id="page_title2" class="breadcrumb-item active" aria-current="page">Restaurant Info.</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--title-bar end-->

	<!--how-to-work start-->
	<section class="how-to-work">
		<div class="container">
			         <!-- /.row -->
            
          <div class="row">
              <div class="col-lg-12">               
                      
                 
              </div>
          </div>
          <br/>
          <br/>
            <div class="row">
                <div class="col-lg-12">
					<div id="content">
<!--                            display info here-->
                        <div class="col-12">
							<img class="mb-3 rounded img-thumbnail" src="../images/<?=$getRest['img_url']?>" height="150px" width="150px" />
							<div id="editRestaurantInfoResponse"></div>      
					   </div>
						<form id="editRestInfoForm"  action="" enctype="multipart/form-data" method="post">
							<div class="row">
							  <div class="col-12 col-sm-6">
								<div class="form-group">
								  <label for="fullName">Restaurant Name</label>
								  <input type="text"  class="form-control" data-bv-field="fullName" id="rest_name" name="rest_name" value="<?=$getRest['restaurant_name']?>" required placeholder="Restaurant Name" />
								</div>
							  </div>
                            <div class="col-12 col-sm-6">
								<div class="form-group">
								  <label for="fullName">Restaurant Phone</label>
								  <input type="text"  class="form-control" data-bv-field="fullName" id="rest_phone" name="rest_phone" value="<?=$getRest['restaurant_phone']?>" required placeholder="Restaurant Phone" />
								</div>
							  </div>
                                
							<div class="col-12 col-sm-6">
								<div class="form-group">
								  <label for="fullName">City</label>
								  <select class="form-control" name="city_id" id="city_id" required>
									  <?php
									  	foreach($getCities as $row){
											$selected = '';
											if($city_id == $row['city_id']){
												$selected = 'selected';
											}
											?>
									  			<option <?=$selected?> value="<?=$row['city_id']?>"><?=$row['city_name']?></option>
									  		<?php
										}
									  ?>
									<option></option>
								  </select>
								</div>
							  </div>
							
							<div class="col-12 col-sm-6">
								<div class="form-group">
								  <label for="fullName">Postal Address</label>
									<textarea  class="form-control" data-bv-field="fullName" id="postal_location" name="postal_location"  required placeholder="Exact Address" ><?=$getRest['restaurant_address']?></textarea>
								</div>
							  </div>	
								
							 <div class="col-12">
								<div class="form-group">
								  <label for="fullName">Google Maps Address</label>
									<textarea disabled class="form-control" data-bv-field="fullName"    placeholder="Exact Address" ><?=$getRest['exact_location']?></textarea>
								</div>
							  </div>	
								
							  <div class="col-12 col-sm-6 mt-3">
								<div class="form-group">
									<input type="hidden" required name="rest_id" id="rest_id" value="<?=$rest_id?>" />
									<button id="btn_save_restaurant" onclick="editRestInfo()" class="btn btn-sm btn-warning text-light" type="submit"><i class="fas fa-save"></i> Save</button>
								</div>
							  </div>
							 </div>

						</form>
                        <div class="float-right">
                        <small>Incorrect Google Maps Address?</small> <a href="#add_info"><i class="fas fa-plus"></i>Change Here</a>
                    </div>     
                    </div>
                   
				</div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
		</div>
	</section>
	<!--how-to-work end-->	
<input type="hidden" id="product"/>
		<!--footer start-->
<?php include('footer.php');?>
	<!--footer end-->		
<!--google maps-->
    <!--Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
	 <!--Assect scripts for this page-->
  <script type="text/javascript" src="js/materialPreloader.js"></script>
	<script src="../vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="../js/owlslider.js"></script>
	<script src="js/js.js"></script>
  
 <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
  </body>
  <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            columnDefs: [
              {bSortable: false, targets: [0,4]} 
            ]
        });
      
      $('.custom-select').css({"width":"100px","margin-bottom":"5px"});
      
       window.onhashchange = locationHashChanged;
        
        window.onload = loadData;
      
    });
      function setValues(product){
        $("#product").val(product);
     }
    
      function locationHashChanged() {  
        if (location.hash === "#add_info") {  
           toAddRestInfo()
        }else if(location.hash === "#restaurant_coordinates"){
			toAddRestCoordinates()	 
		}else{
           window.location = "restaurant_info";
        }
      }
    
    function loadData(){
        if (location.hash === "#add_info") {  
           toAddRestInfo()
        }else if(location.hash === "#restaurant_coordinates"){
			toAddRestCoordinates()	 
		}else{
           
        }
    }
    </script>
	
<!--	google maps api-->
	<script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCsv43N4fIGspg5a2sD1SG_w6-6YJHb8ho&callback=initMap&libraries=places&v=weekly"
      defer
    ></script>
</html>
