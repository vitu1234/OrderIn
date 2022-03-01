<?php
include("connection/Functions.php");
$operation = new Functions();
	session_start();
//check if logged in
if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
	header("Location:signin");
}
$user_id = $_SESSION['user'];

//check admin level here and create nav bar
$user = $operation->retrieveSingle("SELECT * FROM `users` WHERE user_id = '$user_id'");
$city_id = $user['city_id'];
$getCity = $operation->retrieveSingle("SELECT *FROM cities WHERE city_id = '$city_id'");

$level = '';


$prof = '';
if($user['img_url'] != ''){
  $prof = ' src="uploads/'.$user['img_url'].'"';
}else{
  $prof = 'src="images/profile/dp-2.jpg"';
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

    <title>OrderIn | User Profile </title>
    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/mega.menu.css" rel="stylesheet">
	<link href="css/owlslider.css" rel="stylesheet">
	<link href="css/custom.css" rel="stylesheet">
    
	<!-- Owl Carousel for this template-->
	<link href="vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
	<link href="vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
	
    <!-- Fontawesome styles for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	    <!-- DataTables CSS -->
    <link href="vendor/datatables/dataTables.bootstrap4.css" rel="stylesheet">
 
    <!-- DataTables Responsive CSS -->
<!--    <link href="vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">-->
	 <link rel="stylesheet" type="text/css" href="css/materialPreloader.css">
</head>
<style>
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
													<form class="form-inline">
													  <input class="form-control " type="search" placeholder="Search" aria-label="Search">
													  <button class="s-btn btn-link " type="submit"><i class="fas fa-search"></i></button>
													</form>																																								
												</div>
											</div>												
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
					<h3 id="page_title1">My Profile</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index">Home</a></li>
							<li id="page_title1" class="breadcrumb-item active" aria-current="page">My Profile</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--title-bar end-->
	<!--my-account start-->
	<section class="my-account">			
		<div class="profile-bg">
			<img height="150px" width="100%" src="images/profile/bg-img-2.jpg" alt="Responsive image">
			<div class="my-Profile-dt">
				<div class="container">
					<div class="row">
						<div class="container">							
							<div class="profile-dpt">
								<img id="img" <?=$prof?> height="200px" width="200px" alt="">
							</div>
							<div class="profile-all-dt">
								<div class="profile-name-dt">
									<h1><?=$user['fname']." ".$user['lname']?></h1>
									<p><span><i class="fas fa-map-marker-alt"></i></span> <?=$getCity['city_name']?></p>
								</div>								
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--my-account end-->	
	<!--my-account-tabs start-->
	<section class="all-profile-details">
		<div class="container">
			<div class="row">
				<div class="col-lg-3 col-md-4 col-12">
					<div class="left-tab-links">
						<div class="nav nav-pills nav-stacked nav-tabs ui vertical menu fluid">
							<a href="#timeline"  data-toggle="tab" class="item user-tab cursor-pointer active">Personal Details</a>
                          	<a href="#photos" data-toggle="tab" class="item user-tab cursor-pointer">Change Profile Picture</a>
							<a href="#about" data-toggle="tab" class="item user-tab cursor-pointer">Change Password</a>
						
						</div>						
					</div>				
				</div>
				<div class="col-lg-9 col-md-10 col-12">
					<div class="tab-content">
						<div class="tab-pane active" id="timeline">
							<div class="timeline">
								<div class="tab-content-heading">
									<h4>Personal Details</h4>
								</div>
								<div class="main-comments p-5">
									 <form id="personaldetailsForm" method="post">
                                       <div id="personalDetailsResponse"></div>
                                          <div class="row">
                                            <div class="col-12 col-sm-6">
                                              <div class="form-group">
                                                <label for="firstName">First Name</label>
                                                <input type="text" name="fname" value="<?=$user['fname']?>" class="form-control" data-bv-field="firstName" id="fname" required placeholder="Firstname" />
                                              </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                              <div class="form-group">
                                                <label for="fullName">Last Name</label>
                                                <input type="text" value="<?=$user['lname']?>" class="form-control" data-bv-field="fullName" name="lname" id="lname" required placeholder="Surname" />
                                              </div>
                                            </div>
                                            
                                            <div class="col-12 col-sm-6">
                                              <div class="form-group">
                                                <label for="firstName">Email</label>
                                                <input type="text" value="<?=$user['email']?>" class="form-control" data-bv-field="firstName" id="email" name="email" required placeholder="Email" />
                                              </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                              <div class="form-group">
                                                <label for="fullName">Phone</label>
                                                <input type="text" onkeypress="return isNumberKey(event)" value="0<?=$user['phone']?>" class="form-control" data-bv-field="fullName" id="phone" name="phone" required placeholder="Surname" />
                                              </div>
                                            </div>
                                            
                                           </div>
                                          <input type="hidden" value="<?=$user_id?>" name="personal_id" id="personal_id" required />
                                          <button onclick="updatePersonalDetails()" id="btn_personal_details" class="btn btn-primary btn-block mt-2 px-2 text-light" type="submit">Save Changes</button>
                                    </form>
							
								</div>
					
							</div>							
						</div>
						
                      	<div class="tab-pane " id="about">
							<div class="timeline">
								<div class="tab-content-heading">
									<h4>Change Password</h4>
								</div>
								<div class="main-comments p-5">
                                  
									 <form id="passwordForm" method="post">
                                       <div id="passwordDetailsResponse"></div>
                                          <div class="row">
                                            <div class="col-12 col-sm-6">
                                              <div class="form-group">
                                                <label for="firstName">Current Password</label>
                                                <input type="password" name="cpass" class="form-control" data-bv-field="firstName" id="cpass" required placeholder="Current Password" />
                                              </div>
                                            </div>
                                            <div class="col-12 col-sm-6">
                                              <div class="form-group">
                                                <label for="fullName">New Password</label>
                                                <input type="password" class="form-control" data-bv-field="fullName" name="npass" id="npass" required placeholder="New Password" />
                                              </div>
                                            </div>
											<div class="col-12 col-sm-6">
                                              <div class="form-group">
                                                <label for="fullName"> Confirm New Password</label>
                                                <input type="password" class="form-control" data-bv-field="fullName" name="cnpass" id="cnpass" required placeholder="New Password" />
                                              </div>
                                            </div>
											  
											 <div class="col-12 col-sm-6 mt-3">
													Show Password <input type="checkbox" onclick="myFunction()">
											  </div>  
											  
											  
											  
                                           </div>
                                          <input type="hidden" value="<?=$user_id?>" id="pass_id" name="pass_id" required />
                                          <button onclick="updatePassword()" id="btn_password_details" class="btn btn-primary btn-block mt-2 px-2 text-light" type="submit">Save Changes</button>
                                    </form>
								</div>
					
							</div>							
						</div>
                      
                        <div class="tab-pane " id="photos">
							<div class="timeline">
								<div class="tab-content-heading">
									<h4>Change Profile Picture</h4>
								</div>
								<div class="main-comments p-5">
                             
									 <form id="pictureForm" method="post">
                                       <div class="row">
                                         <div class="col-12 py-4">
                                            <div id="dp1DetailsResponse"></div>
                                         </div>
                                       </div>
                                       
                                          <div class="row">
                                            <div class="col-12 ">
                                              <div class="form-group">
                                                <label for="firstName">Select Picture</label>
                                                <input type="file" name="profile1" class="form-control" data-bv-field="firstName" id="profile1" required placeholder="Picture" s />
                                              </div>
                                            </div>
                                           </div>
                                          <input type="hidden" value="<?=$user_id?>"  id="profile_id" name="profile_id" required />
                                          <button onclick="upload1()" id="btn_prof_details" class="btn btn-primary btn-block mt-2 px-2 text-light" type="submit">Upload</button>
                                    </form>
								</div>
					
							</div>							
						</div>
      																	
					</div>
				</div>
		
			</div>
		</div>
	</section>
	<!--my-account-tabs end-->
			<!--footer start-->
<?php include('footer.php');?>
	<!--footer end-->		


    <!--Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!--Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	 <!--Assect scripts for this page-->
	<script src="vendor/OwlCarousel/owl.carousel.js"></script>
	<script src="js/owlslider.js"></script>
	<script src="js/js.js"></script>
  
 <!-- DataTables JavaScript -->
    <script src="vendor/datatables/jquery.dataTables.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.js"></script>
  </body>
  <script>
    $(document).ready(function() {
        $('#dataTables-example').DataTable({
            columnDefs: [
              {bSortable: false, targets: [2]} 
            ]
        });
      $("#imgCont").hide();
      $('.custom-select').css({"width":"100px","margin-bottom":"5px"});
    });
	  
	  function myFunction() {
  var y = document.getElementById("npass");
 if (y.type === "password") {
    y.type = "text";
  } else {
    y.type = "password";
  }
	
var x = document.getElementById("cnpass");
 if (x.type === "password") {
    x.type = "text";
  } else {
    x.type = "password";
  }
}
    </script>
</html>
