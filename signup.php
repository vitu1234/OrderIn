<?php
	include("connection/Functions.php");
	 $operation = new Functions();
	session_start();

	$selectCity = '';

//get uder preffered city
if(!isset($_SESSION['selected_city']) || empty($_SESSION['selected_city'])){
	
	$getCities = $operation->retrieveMany("SELECT * FROM `cities` ");
	foreach($getCities as $city){
		$selectCity .= '<option value="'.$city['city_id'].'">'.$city['city_name'].'</option>';
	}
}else{
	$city_id = $_SESSION['selected_city'];
	$getCities = $operation->retrieveSingle("SELECT * FROM `cities` WHERE city_id = '$city_id'");
	  $selectCity = '<option value="'.$getCities['city_id'].'">'.$getCities['city_name'].'</option>';
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
	
    <title>OrderIn | Register Now</title>

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


	<!--title-bar end-->	
	<!--login-and-register start-->
	<section class="login_register">			
		<div class="container">					
			<div class="row justify-content-center">
				<div class="col-lg-6 col-md-6 col-12">
					<div class="login-container">
						<div class="row">			
							<div class="col-lg-12 col-md-12 col-12">
								<form id="registerForm" action="" method="post">	
									<div class="login-form">	
										<div class="login-logo">									
											<a href="index"><img src="images/orderlogo.png" alt=""></a>
										</div>
										<div class="create-text"><h4>Create Your Account</h4></div>				<div id="loginResponse"></div>						
										<div class="form-group">
											<input type="text" class="video-form" id="fname" name="fname" placeholder="Firstname" required>							
										</div>
										<div class="form-group">
											<input type="text" class="video-form" id="lname" name="lname" placeholder="Lastname" required>							
										</div>
										<div class="form-group">
											<input type="email" class="video-form" id="email" name="email" placeholder="Email Address" required>							
										</div>
											<div class="form-group">
											<input onkeypress="return isNumberKey(event)" maxlength="12" type="text" class="video-form" id="phone" name="phone" placeholder="Phone Number" required>							
										</div>
											<div class="form-group">
											<select class="form-control" name="city_name" id="city_name" required>
												<option selected disabled>-Select City-</option>
												<?=$selectCity?>
											 </select>						
										</div>
										<div class="form-group">
											<input type="password" class="video-form" id="pass1" name="pass1" placeholder="Password" required>							
										</div>
										<div class="form-group">
											<input type="password" class="video-form" id="pass2" name="pass2" placeholder="Confirm Password" required>							
										</div>
										<div class="signup-checkbox text-left">
											  <input value="1" type="checkbox" id="terms_check" name="terms_check">
											  <label for="terms_check">I agree to OrderIn's <span><a href="terms_conditions" >Terms of Service</a></span> &amp; <span><a href="terms_conditions"> Policies.</a></span></label>
										</div>
										<button  type="submit" id="loginBtn" style="background-color:#FF7C2F" class="login-btn btn-link">Register Now</button>
									
										<div class="forgot-password">	
											<p>If you have an account?<a href="signin"><span style="color:#ffa803;"> - Login Now</span></a></p>
										</div>										
									</div>	
								</form>		
							</div>
						</div>						
					</div>						
				</div>				
			</div>			
		</div>
	</section>
	<!--login-and-register end-->
	<!--footer start-->
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
	
	
  </body>

</html>
