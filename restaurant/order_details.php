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
$user = $operation->retrieveSingle("SELECT * FROM `admins` WHERE user_id = '$user_id'");
$admin_level = $user['access_level'];
$city_id = $user['city_id'];

$total_restaurants = "";
$orders_total = '';
$drivers_total = '';
$customers_total = '';

//1 is just and admin, 2 is super admin
if($admin_level == 2){

}else{

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
	<link href="../images/orderlogo1.png" rel="shortcut icon" type="image/x-icon"/>

    <title>Order In | Admin </title>

    <!-- Bootstrap core CSS-->
    <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/style.css" rel="stylesheet">
	<link href="../css/responsive.css" rel="stylesheet">
	<link href="../css/mega.menu.css" rel="stylesheet">
	<link href="../css/bootstrap-select.css" rel="stylesheet">	
    
	<!-- Owl Carousel for this template-->
	<link rel="stylesheet" href="../assets/owlcarousel/assets/owl.carousel.min.css">
	
    <!-- Fontawesome styles for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<style>
  body {
    color: #000;
    overflow-x: hidden;
/*    height: 100%;*/
/*    background-color: #8C9EFF;*/
/*    background-repeat: no-repeat*/
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
</head>

<body>
	<!--header start-->
		<header id="header" class="default">
	
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
												<a class="nav-link" href="restaurants">Restaurants</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="drivers">Drivers</a>
											</li>
                                            <li class="nav-item ">
												<a class="nav-link" href="admins">Admins</a>
											</li>
                                          
                                            <li class="nav-item">
												<a class="nav-link" href="customers">Customers</a>
											</li>
                                          
									
										</ul>											
									</div>
									
								</nav>
								<div class="icons-set">
									<ul class="list-inline">
							
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
											<li class="nav-item dropdown">
												<a  class="dropdown-toggle-no-caret" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i><?=$user['fname']?> <i class="fas fa-caret-down"></i></a>
													<div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
													  <a class="dropdown-item" href="profile"> My Profile</a>
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
					<h3>Order #513 Details</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Order Details</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--title-bar end-->
	<!--add-restaurant start-->
	<section class="add-restaurant">
      
   
      
      
		<div class="container">					
			<div class="row ">
              
				<div class="col-lg-6 col-md-8 col-12 mb-3">
				<div class="card">
                  <div class="card-body py-0">
					<div class="basic-info">
						<h4>Restaurant Information</h4>						
							<div class="driver-dt">								
								<a href="user_profile_view.html"><img src="images/recipe-details/comment-1.png" alt=""></a>
								<h4> Amazing Bakes</h4>
                              
							</div>
                      
						<div class="form-group">
                          <p class="">
                            Area 6, Behind National Bank
                            (265)882992942
                            Demo Owner, owner@example.com
                          </p>
                          						
                           <hr/>
						</div>
                   
					</div>
                  		
				</div>
                  </div>
                  
                  
                  <div class="card mt-3">
                  <div class="card-body py-0">
					<div class="basic-info">
						<h4>Customer Information</h4>
                        <span>Vitumbiko Mafeni</span>
                          <p class="">
                            +265882992942, customer@example.com, Area 49, House # 50, Near CCAP
                            
                          </p>
                           <hr/>
                      <div class="form-group"></div>
					</div>
                  
                  
					<div class="basic-info">                      
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                  <tr>
                                      <th style="font-weight: 600;">Food Ordered</th>
                                      <td>Chips x Chicken Burger</td>
                                      <td></td>
                                  </tr>
                              
                                  <tr>
                                      <th style="font-weight: 600;">Comment</th>
                                      <td>If Possible add some extra chips without salt</td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <th style="font-weight: 600;">Cost</th>
                                      <td>MWK 5,000</td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <th style="font-weight: 600;">Payment</th>
                                      <td>NetSoft Money</td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <th style="font-weight: 600;">Status</th>
                                      <td>Pending</td>
                                      <td></td>
                                  </tr>
                            </table>
                        </div>
                      
                        
						
                      
					</div>					
						
						<div class="form-group">
							<div class="filter-radio">
								<ul>
									<li>
									 <button type="submit" class="add-resto-btn1 btn-link">Accept</button>
									</li>
									<li>
									  <button type="submit" class="add-resto-btn1 btn-danger">Reject</button>
									</li>
								</ul>
							</div>
						</div>
                    </div></div>	
				
              </div>
				<div class="col-lg-6 col-md-4 col-12 mb-3">
                  
                <div class="card">
                  <div class="card-body">
					<div class="new-heading">						
						<h1>Order Tracking</h1>
					</div>
					<div class="how-it-work-1">
						<iframe width="520" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=520&amp;height=400&amp;hl=en&amp;q=Lilongwe%20Lilongwe+(Area%2025)&amp;t=h&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> <a href='https://embed-map.org/'>embedMap</a> <script type='text/javascript' src='https://maps-generator.com/google-maps-authorization/script.js?id=e103c2c92388d5b3ea8137b8a81af79e0479d336'></script>
					</div>

                  </div>
			     </div>	
                  
                <div class="card mt-3">
                  <div class="card-body">
					<div class="new-heading">						
						<h4>Status History</h4>
					</div>
					<div class="how-it-work-1">
						<div class="container px-1 px-md-4 py-5 mx-auto">
                              <div class="row d-flex justify-content-between px-3 top">
                                  <div class="d-flex">
                                  </div>
                                 
                              </div> <!-- Add class 'active' to progress -->
                              <div class="row d-flex justify-content-center">
                                  <div class="col-12">
                                      <ul id="progressbar" class="text-center">
                                          <li class="active step0"></li>
                                          <li class="active step0"></li>
                                          <li class="active step0"></li>
                                          <li class="step0"></li>
                                      </ul>
                                  </div>
                              </div>
                              <div class="row justify-content-between top">
                                  <div class="row d-flex icon-content"> 
                                      <div class="d-flex flex-column">
                                          <p class="font-weight-bold">Ordered<br></p>
                                      </div>
                                  </div>
                                  <div class="row d-flex icon-content"> 
                                      <div class="d-flex flex-column">
                                          <p class="font-weight-bold">Accepted<br></p>
                                      </div>
                                  </div>
                                  <div class="row d-flex icon-content"> 
                                      <div class="d-flex flex-column">
                                          <p class="font-weight-bold">Delivering<br></p>
                                      </div>
                                  </div>
                                  <div class="row d-flex icon-content"> 
                                      <div class="d-flex flex-column">
                                          <p class="font-weight-bold">Delivered<br></p>
                                      </div>
                                  </div>
                              </div>
                      </div>
					</div>

                  </div>
			     </div>	
                  
              </div>
          </div>
		</div>
	</section>
	<!--add-restaurant end-->
	<!--footer start-->
<?php include('footer.php');?>
	<!--footer end-->		

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
	<!-- Assect scripts for this page-->
	<script src="../assets/owlcarousel/owl.carousel.js"></script>
	<script src="../js/owlslider.js"></script>
	<script src="../js/bootstrap-select.js"></script>	
	<script async="" defer="" src="https://maps.googleapis.com/maps/api/js?libraries=geometry,drawing&amp;key=AIzaSyCZhq0g1x1ttXPa1QB3ylcDQPTAzp_KUgA">
        </script>
  </body>

</html>
