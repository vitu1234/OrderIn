<?php
include("../connection/Functions.php");
$operation = new Functions();
	session_start();
//check if logged in
if(!isset($_SESSION['restaurant']) || empty($_SESSION['restaurant'])){
	header("Location:login.php");
}
$user_id = $_SESSION['restaurant'];

//check admin level here and create nav bar
$user = $operation->retrieveSingle("SELECT * FROM `users` WHERE user_id = '$user_id' AND user_role = 'manager'");
$city_id = $user['city_id'];
//get assigned restaurant
$getRestInfo = $operation->retrieveSingle("SELECT * FROM `restaurant_managers` WHERE user_id = '$user_id'");
$rest_id = $getRestInfo['restaurant_id'];

$orders = '';






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
  body {
    color: #000;
    overflow-x: hidden;
/*    height: 100%;*/
/*    background-color: #8C9EFF;*/
/*    background-repeat: no-repeat*/
}
	option{
		color: #000;
	}

.card {
    z-index: 0;
    background-color: #ECEFF1;
/*    padding-bottom: 20px;*/
/*    margin-top: 90px;*/
/*    margin-bottom: 90px;*/
    border-radius: 10px
}

.top {
/*    padding-top: 40px;*/
    padding-left: 13% !important;
    padding-right: 13% !important
}

#progressbar {
    margin-bottom: 30px;
    overflow: hidden;
    color: #455A64;
    padding-left: 0px;
    margin-top: 30px
}

#progressbar li {
    list-style-type: none;
    font-size: 13px;
    width: 25%;
    float: left;
    position: relative;
    font-weight: 400
}

#progressbar .step0:before {
    font-family: "Font Awesome 5 Free";
  font-weight: 900;
  content: "\f017";
  color: aliceblue;
}

#progressbar li:before {
    width: 40px;
    height: 40px;
    line-height: 45px;
    display: block;
    font-size: 20px;
    background: #C5CAE9;
    border-radius: 50%;
    margin: auto;
    padding: 0px
}

#progressbar li:after {
    content: '';
    width: 100%;
    height: 12px;
    background: #C5CAE9;
    position: absolute;
    left: 0;
    top: 16px;
    z-index: -1
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px;
    position: absolute;
    left: -50%
}

#progressbar li:nth-child(2):after,
#progressbar li:nth-child(3):after {
    left: -50%
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px;
    position: absolute;
    left: 50%
}

#progressbar li:last-child:after {
    border-top-right-radius: 10px;
    border-bottom-right-radius: 10px
}

#progressbar li:first-child:after {
    border-top-left-radius: 10px;
    border-bottom-left-radius: 10px
}

#progressbar li.active:before,
#progressbar li.active:after {
    background: #651FFF
}

#progressbar li.active:before {
     font-family: "Font Awesome 5 Free";
  font-weight: 900;
  content: "\f058";
  color: aliceblue;
}

.icon {
    width: 60px;
    height: 60px;
    margin-right: 15px
}

.icon-content {
    padding-bottom: 20px
}

@media screen and (max-width: 992px) {
    .icon-content {
        width: 50%
    }
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
											<li class="nav-item active">
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
										
<!--
										<li class="icon-items nav-item dropdown">
										<a class="nav-link dropdown-toggle-no-caret" href="#" id="navbarDropdown2" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-bell"></i></a>
										<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown2">	
											<div class="notification-item">
												<div class="property">
													<ul>
														<li><div class="setting"><a href="#">Setting</a></div></li>
														<li><div class="clear"><a href="#">Clear</a></div></li>
													</ul>
												</div>
												<div class="notification-details">														
													<div class="media">
														<div class="media-left">
															<a href="#"><img src="images/notification-img-2.png" alt=""></a>
														</div>
														<div class="media-body">
															<h4 class="media-heading">Jassica William</h4> 
															<p>comment on your Video.</p>																
															<div class="comment-date">10 min ago</div>
														</div>
													</div>													
													<div class="media">
														<div class="media-left">
															<a href="#"><img src="images/notification-img-3.png" alt=""></a>	
														</div>
														<div class="media-body">
															<h4 class="media-heading">Congratulations!</h4>
															<p>Your Order is Accepted.</p>																													
															<div class="comment-date">
																15 min ago
															</div>
														</div>
													</div>																										
													<div class="media">
														<div class="media-left">
															<a href="#"><img src="images/notification-img-4.png" alt=""></a>
														</div>
														<div class="media-body">
															<h4 class="media-heading">Order Delivered!</h4>
															<p>Your Order is Delivered.</p>
															<div class="comment-date">20 min ago</div>
														</div>
													</div>																																								
												</div>
											</div>												
										</div>	
										</li>
-->
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
					<h3>All Orders</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">All Orders</li>
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
                  <h3 class="text-center">All Orders</h3>
              </div>
          </div>
            <div class="row">
                <div class="col-lg-12">
                   <div id="content">
                        <!-- /.panel-heading -->
                            <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                                <thead class="ss">
                                    <tr >
                                        <th>Customer</th>
<!--                                        <th>Restaurant</th>-->
                                        <th >Date</th>
                                        <th >Driver</th>
                                        <th>Delivered?</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
									
									<?php
									//1 is just and admin, 2 is super admin
											$query  = "SELECT * FROM `orders` ";
											$orders = $operation->retrieveMany($query);
											foreach($orders as $order){
                                               $order_id = $order['order_id'];
												$customer_id = $order['user_id'];
												$product_id = $order['product_id'];
												//get customer_name 
												$getCustomer = $operation->retrieveSingle("SELECT *FROM users WHERE user_id = '$customer_id'");
												//getproduct order details
												$getProduct = $operation->retrieveSingle("SELECT *FROM products WHERE product_id = '$product_id'");
												$restuarant_id = $getProduct['restaurant_id'];
												
												//check restaurant
												if($rest_id == $restuarant_id){
													//get restaurant information
													$getRestaurantname = $operation->retrieveSingle("SELECT *FROM restaurant_info WHERE restaurant_id = '$restuarant_id'");

													//order date formating
													  $date = date_create($order['date_created']);
													  $full_date = date_format($date,"d M Y");
													//delivery status
													$delivery_status = '';
													if($order['order_delivery_status'] == 0){
														$delivery_status = '<i class="fas fa-times text-danger"></i>';
													}else{
														$delivery_status = '<i class="fas fa-check-circle text-success"></i>';
													}
													
													//check if assigned to driver
													$driver_assigned = '';
													if($operation->countAll("SELECT * FROM `order_assign` WHERE order_id = '$order_id'") >0 ){
														$driver_assigned = '<i class="fas fa-check-circle text-success"></i>';
													}else{
														$driver_assigned = '<i class="fas fa-times text-danger"></i>';
													}

													?>
													<tr class="rr">
														<td><?=$getCustomer['fname']." ".$getCustomer['lname']?></td>
														
														<td ><?=$full_date?></td>
														<td ><?=$driver_assigned?></td>
														<td><?=$delivery_status?></td>
														<td class="">
														  <a href="#view_order" onclick="setValues('<?=$order_id?>')">&#8226;&#8226;&#8226;</a>
														</td>
													</tr>
													<?php
												}
												
						
											}
									
									?>
									
                                
                                    
                                </tbody>
                            </table>
                           
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
		</div>
     </div>
	</section>
	<!--how-to-work end-->	
<input type="hidden" id="order" />
	<!--footer start-->
<?php include('footer.php');?>
	<!--footer end-->	  

    <!--Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
	 <!--Assect scripts for this page-->
	<script src="../vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="../js/owlslider.js"></script>
	<script src="js/js.js"></script>
    <script type="text/javascript" src="js/materialPreloader.js"></script>
 <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
  </body>
  <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            columnDefs: [
              {bSortable: false, targets: [3,4]} 
            ]
        });
      $('.custom-select').css({"width":"100px","margin-bottom":"5px"});
          window.onhashchange = locationHashChanged;
        
        window.onload = loadData;
    });
   
   function setValues(order){
        $("#order").val(order);
     }
    
      function locationHashChanged() {  
        if (location.hash === "#view_order") {  
            var order = $("#order").val();
            setCookie('order',order,1);
            toViewOrder(order);     
        }else{
           window.location = "orders";
        }
      }
    
    function loadData(){
        if(location.hash === "#view_order"){
           
          var order = getCookie('order');
            toViewOrder(order);     
        }else{
           
        }
    }
   
    </script>
</html>
