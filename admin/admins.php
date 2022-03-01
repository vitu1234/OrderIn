<?php
include("../connection/Functions.php");
$operation = new Functions();
	session_start();
//check if logged in
if(!isset($_SESSION['admin']) || empty($_SESSION['admin'])){
	header("Location:login.php");
}
$user_id = $_SESSION['admin'];

//check admin level here and create nav bar
$user = $operation->retrieveSingle("SELECT * FROM `admins` WHERE user_id = '$user_id'");
$admin_level = $user['access_level'];
$city_id = $user['city_id'];

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

    <title>OrderIn | Admin </title>
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
<!--
											<li class="nav-item">
												<a class="nav-link" href="orders">Orders</a>
											</li>
-->
											<li class="nav-item ">
												<a class="nav-link" href="restaurants">Restaurants</a>
											</li>
                                              <li class="nav-item">
												<a class="nav-link" href="restaurant_managers">Managers</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="drivers">Drivers</a>
											</li>
                                            <li class="nav-item active">
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
												<a  class="dropdown-toggle-no-caret" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i><?=$user['fname']?><i class="fas fa-caret-down"></i></a>
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
					<h3 id="page_title1">All Admins</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index">Home</a></li>
							<li id="page_title1" class="breadcrumb-item active" aria-current="page">All Admins</li>
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
                      <a  href="#add_admin" id="btn_to_add" style="float: right;" class="upload-btn btn-link text-light"><i class="fa fa-plus"></i> Add</a>
                 
              </div>
          </div>
          <br/>
          <br/>
            <div class="row">
                <div class="col-lg-12">
              		<div id="content">
                              <!-- /.panel-heading -->
                            <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                                <thead class="ss">
                                    <tr >
                                        <th>Admin Name</th>
                                        <th>Access Level</th>
                                        <th>City</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
									<?php
									//1 is just and admin, 2 is super admin
										if($admin_level == 2){
											$query  = "SELECT * FROM `admins`";
											$orders = $operation->retrieveMany($query);
											foreach($orders as $order){
												//get customer information
												$user_city  = $order['city_id'];
												$city_name = $operation->retrieveSingle("SELECT * FROM `cities` WHERE city_id = '$user_city'");
												$access_level = '';
												if($order['access_level'] == 2){
													$access_level = "All Cities";
												}else{
													$access_level = "City";
												}
												$name = '';
												$btn = '';
												if($order['user_id'] == $user_id){
													$name = "Me";
													$btn = "href='profile'";
												}else{
													$name = $order['fname']." ".$order['lname'];
													$btn = 'href="#edit_admin" onclick="setValues(\''.$order['user_id'].'\', \''.$user_id.'\')"';
												}
												?>
												<tr class="rr">
													<td><?=$name?></td>
													<td ><?=$access_level?></td>
													<td ><?=$city_name['city_name']?></td>
													<td class="">
													  <a <?=$btn?>>&#8226;&#8226;&#8226;</a>
													</td>
												</tr>
												<?php
											}
										}else{
											$query  = "SELECT * FROM `admins` WHERE city_id = '$city_id'";
											$orders = $operation->retrieveMany($query);
											foreach($orders as $order){
												//get customer information
												$user_city  = $order['city_id'];
												$city_name = $operation->retrieveSingle("SELECT * FROM `cities` WHERE city_id = '$user_city'");
												$access_level = '';
												if($order['access_level'] == 2){
													$access_level = "All Cities";
												}else{
													$access_level = "City";
												}
												
												$name = '';
												$btn = '';
												if($order['user_id'] == $user_id){
													$name = "Me";
													$btn = "href='profile'";
												}else{
													$name = $order['fname']." ".$order['lname'];
													$btn = 'href="#edit_admin" onclick="setValues(\''.$order['user_id'].'\', \''.$user_id.'\')"';
												}
												?>
												<tr class="rr">
													<td><?=$name?></td>
													<td ><?=$access_level?></td>
													<td ><?=$city_name['city_name']?></td>
													<td class="">
													  <a <?=$btn?>>&#8226;&#8226;&#8226;</a>
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
					</div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
		</div>
	</section>
	<!--how-to-work end-->	
<input type="hidden" id="rest"/>
<input type="hidden" id="user"/>
<?php include('footer.php');?>

    <!--Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
	 <!--Assect scripts for this page-->
	<script src="../vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="../js/owlslider.js"></script>
  <script type="text/javascript" src="js/materialPreloader.js"></script>
<script type="text/javascript" src="js/js.js"></script>
 <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/jquery.dataTables.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.js"></script>
  </body>
  <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            columnDefs: [
              {bSortable: false, targets: [3]} 
            ]
        });
      
      $('.custom-select').css({"width":"100px","margin-bottom":"5px"});
      
       window.onhashchange = locationHashChanged;
        
        window.onload = loadData;
      
    });
    
    
      function setValues(rest, user){
        $("#rest").val(rest);
        $("#user").val(user);
      }
    
      function locationHashChanged() {  
        if (location.hash === "#add_admin") {  
           toAddAdmin();
        }else if(location.hash === "#edit_admin"){
            var rest = $("#rest").val();
            var user = $("#user").val();
            setCookie('ppkcookie1',rest,1);
            setCookie('ppkcookie2',user,1);
            toEditAdmin(rest,user);     
        }else{
           window.location = "admins";
        }
      }
    
    function loadData(){
        if (location.hash === "#add_admin") {  
           toAddAdmin();
        }else if(location.hash === "#edit_admin"){
           
          var rest = getCookie('ppkcookie1');
          var user = getCookie('ppkcookie2');
            toEditAdmin(rest,user);     
        }else{
           
        }
    }
    </script>
</html>
