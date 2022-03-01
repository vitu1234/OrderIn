<link href="js/conscent/cookiealert.css" rel="stylesheet">
<?php
$btn ='';
	if(isset($_SESSION['user'])){
		$id = $_SESSION['user'];
		//get user
		$getUser = $operation->retrieveSingle("SELECT *FROM users WHERE user_id ='$id'");
		$btn = "";
		?>
		
		<div class="topbar">
					<div class="container">
						<div class="row">
							<div class="col-md-4">
								<div class="topbar-left text-center text-md-left">
									<ul class="list-inline">
										<li> <a href="contact"> Contact </a></li>
										<li> <a href="about"> About Us </a></li>
										<li> <a href="our_blog"> Blog </a></li>											
									
									</ul>
								</div>
							</div>
							<div class="col-md-8">
								<div class="topbar-right text-center text-md-right">
									<ul class="list-inline">
																	
										<li><a href="cart"><h6><span><i class="shopping-cart"></i></span>Cart <span style="background-color:#FF7C2F;" id="cart_count" class="badge badge-secondary"><?php
											if(isset($_SESSION['cart'])){
												echo count($_SESSION['cart']);
											}else{
												echo 0;
											}
											?></span></h6></a></li>										
																				
										<li class="nav-item dropdown">
										<a  class="dropdown-toggle-no-caret" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i><?=$getUser['fname']?>  <i class="fas fa-caret-down"></i></a>
											<div class="dropdown-menu dropdown-menu-right" aria-labelledby="accountDropdown">
											  <a class="dropdown-item" href="my_orders"> Order History</a>
												<a class="dropdown-item" href="user_profile_view"> My Profile</a>
											  <a class="dropdown-item" href="logout"> Logout</a>
											 
										   </div>
										</li>									
									</ul>
								</div>
							</div>
						</div>
					</div>
			</div>

		<?php
	}else{
		$btn = '
			<li class="partner-btn">
				<a style="background-color:#FF7C2F;" href="signin" class="b-btn btn-link">Sign In</a>
			</li>	
			<li class="partner-btn">
				<a style="background-color:#FF7C2F;" href="signup" class="b-btn btn-link">Create Account</a>
			</li>	
		
		';
		?>
			
		<div class="topbar">
					<div class="container">
						<div class="row">
							<div class="col-md-4">
								<div class="topbar-left text-center text-md-left">
									<ul class="list-inline">
										<li> <a href="contact"> Contact </a></li>
										<li> <a href="about"> About Us </a></li>
										<li> <a href="our_blog"> Blog </a></li>											
									
									</ul>
								</div>
							</div>
							<div class="col-md-8">
								<div class="topbar-right text-center text-md-right">
									<ul class="list-inline">
																	
										<li><a href="cart"><h6><span><i class="shopping-cart"></i></span>Cart <span id="cart_count" class="badge badge-secondary"><?php
											if(isset($_SESSION['cart'])){
												echo count($_SESSION['cart']);
											}else{
												echo 0;
											}
											?></span></h6></a></li>										
																				
																	
									</ul>
								</div>
							</div>
						</div>
					</div>
			</div>
			
		<?php
	}

?>