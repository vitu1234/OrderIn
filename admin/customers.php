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
	<link href="../css/custom.css" rel="stylesheet">
    
	<!-- Owl Carousel for this template-->
	<link href="../vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
	<link href="../vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
	
    <!-- Fontawesome styles for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	    <!-- DataTables CSS -->
    <link href="../vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
 
    <!-- DataTables Responsive CSS -->
<!--    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">-->
</head>
<style>
  label{
    color: #000;
  }
  
  
  </style>
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
											<li class="nav-item ">
												<a class="nav-link" href="drivers">Drivers</a>
											</li>
                                            <li class="nav-item">
												<a class="nav-link" href="admins">Admins</a>
											</li>
                                          
                                            <li class="nav-item active">
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
					<h3>All Customers</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Customers</li>
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
<!--                      <button data-toggle="modal" data-target="#exampleModal" type="button" style="float: right;" class="upload-btn btn-link text-light"><i class="fa fa-plus"></i> Add</button>-->
                 
              </div>
          </div>
          <br/>
          <br/>
            <div class="row">
                <div class="col-lg-12">
              
                              <!-- /.panel-heading -->
                            <table width="100%" class="table table-striped table-hover" id="dataTables-example">
                                <thead class="ss">
                                    <tr >
                                        <th>Name</th>
                                        
                                        <th>Phone</th>
                                        <th>Email</th>
                                     <th>City</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
									//1 is just and admin, 2 is super admin
										if($admin_level == 2){
											$query  = "SELECT * FROM `users` WHERE user_role = 'customer'";
											$orders = $operation->retrieveMany($query);
											foreach($orders as $order){
												//get customer information
												$user_city  = $order['city_id'];
												$city_name = $operation->retrieveSingle("SELECT * FROM `cities` WHERE city_id = '$user_city'");
												
												?>
												<tr class="rr">
													<td><?=$order['fname']." ".$order['lname']?></td>
													<td><?='0'.$order['phone']?></td>
													<td><?=$order['email']?></td>
													<td ><?=$city_name['city_name']?></td>
<!--
													<td class="">
													  <a href="order_details.php">&#8226;&#8226;&#8226;</a>
													</td>
-->
												</tr>
												<?php
											}
										}else{
											$query  = "SELECT * FROM `users` WHERE user_role = 'customer' AND city_id = '$city_id'";
											$orders = $operation->retrieveMany($query);
											foreach($orders as $order){
												//get customer information
												$user_city  = $order['city_id'];
												$city_name = $operation->retrieveSingle("SELECT * FROM `cities` WHERE city_id = '$city_id'");
												
												
													?>
													<tr class="rr">
														<td><?=$order['fname']." ".$order['lname']?></td>
                                                       <td>0<?=$order['phone']?></td>
                                                       <td><?=$order['email']?></td>
                                                       <td ><?=$city_name['city_name']?></td>
<!--
														<td class="">
														  <a href="order_details.php">&#8226;&#8226;&#8226;</a>
														</td>
-->
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
	</section>
	<!--how-to-work end-->	

		<!--footer start-->
<?php include('footer.php');?>
	<!--footer end-->		

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Driver</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
         <form id="personaldetails" method="post">
              <div class="row">
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="firstName">Driver Name</label>
                    <input type="text"  class="form-control" data-bv-field="firstName" id="fname" required />
                  </div>
                </div>
                <div class="col-12 col-sm-6">
                  <div class="form-group">
                    <label for="fullName">City</label>
                    <select class="form-control" name="city" id="city" required>
                    
                      <option selected disabled>-Select City-</option>
                      <option >Blanytre</option>
                      <option >Lilongwe</option>
                      <option >Zomba</option>
                    </select>
                  </div>
                </div>

               </div>
              <button type="button" class="btn btn-primary text-light"><i class="fa fa-save"></i> Save </button>
            </form>
      </div>
      
    </div>
  </div>
</div>
    <!--Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>
	 <!--Assect scripts for this page-->
	<script src="../vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="../js/owlslider.js"></script>
  
 <!-- DataTables JavaScript -->
    <script src="../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../vendor/datatables/dataTables.bootstrap4.min.js"></script>
  </body>
  <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            columnDefs: [
              {bSortable: false, targets: []} 
            ]
        });
      
      $('.custom-select').css({"width":"100px","margin-bottom":"5px"});
      
    });
    </script>
</html>
