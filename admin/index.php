<?php
include("../connection/Functions.php");
$operation = new Functions();
	session_start();
//check if logged in
if(!isset($_SESSION['admin']) || empty($_SESSION['admin'])){
	header("Location:login");
}
$user_id = $_SESSION['admin'];

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
	$total_restaurants = $operation->countAll("SELECT * FROM `restaurant_info`");
	$orders_total = $operation->countAll("SELECT * FROM `orders` WHERE date(date_created)=CURDATE() ");
	$drivers_total = $operation->countAll("SELECT * FROM `users` WHERE user_role = 'driver'");
	$customers_total = $operation->countAll("SELECT * FROM `users` WHERE user_role = 'customer'");
}else{
	$total_restaurants = $operation->countAll("SELECT * FROM `restaurant_info` AND city_id = '$city_id'");
	$orders_total = $operation->countAll("SELECT * FROM `orders` WHERE date(date_created)=CURDATE() AND city_id = '$city_id'");
	$drivers_total = $operation->countAll("SELECT * FROM `users` WHERE user_role = 'driver' AND city_id = '$city_id'");
	$customers_total = $operation->countAll("SELECT * FROM `users` WHERE user_role = 'customer' AND city_id = '$city_id'");
}

$dataPoints = array();
$labels = array();

$all_time =0;
//get all resturants 

 




//print_r($labels);print_r($dataPoints); die();

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
    
	<!-- Owl Carousel for this template-->
	<link href="../vendor/OwlCarousel/assets/owl.carousel.css" rel="stylesheet">
	<link href="../vendor/OwlCarousel/assets/owl.theme.default.min.css" rel="stylesheet">
	
    <!-- Fontawesome styles for this template-->
    <link href="../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	
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
											<li class="nav-item active">
												<a class="nav-link" href="index">Home </a>
											</li>
<!--
											<li class="nav-item">
												<a class="nav-link" href="orders">Orders</a>
											</li>
-->
											<li class="nav-item">
												<a class="nav-link" href="restaurants">Restaurants</a>
											</li>
                                              <li class="nav-item">
												<a class="nav-link" href="restaurant_managers">Managers</a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="drivers">Drivers</a>
											</li>
                                            <li class="nav-item">
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
												<a  class="dropdown-toggle-no-caret" href="#" id="accountDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user-circle"></i><?=$user['fname']?>  <i class="fas fa-caret-down"></i></a>
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


	<!--how-to-work start-->
	<section class="how-to-work">
		<div class="container">
			<div class="row">
				<div class="col-md-3 col-sm-12 col-xs-12 py-3">
					<div class="card text-center">
                      <div class="card-header bg-warning">
                        <div class="row">
                            <div class="col">
                                <h2 class="text-right "><?=$total_restaurants?></h2>
                            </div>
                        </div>
                        <h4 class=" py-4"><i class="text-left fas fa-pizza-slice	px-3"></i> Restaurants</h4>
                      </div>
                      
                      <div class="card-footer  bg-default">
                        <a href="restaurants" >
                            <span class="text-left text-warning">View Details</span>
                             <span class="text-right text-warning"><i class="fa fa-arrow-circle-right"></i></span>
                          </a>
                      </div>
                    </div>
				</div>
              
              <div class="col-md-3 col-sm-12 col-xs-12 py-3">
					<div class="card text-center">
                      <div class="card-header bg-primary ">
                        <div class="row">
                            <div class="col">
                                <h2 class="text-right text-light"><?=$orders_total?></h2>
                            </div>
                        </div>
                        <h4 class=" py-4 text-light"><i class="text-left fas fa-balance-scale px-3"></i> Orders Today</h4>
                      </div>
                      
                      <div class="card-footer  bg-default">
                        <a href="orders" >
                            <span class="text-left text-primary">View Details</span>
                             <span class="text-right text-primary"><i class="fa fa-arrow-circle-right"></i></span>
                          </a>
                      </div>
                    </div>
		      </div>
              
				<div class="col-md-3 col-sm-12 col-xs-12 py-3">
					<div class="card text-center">
                      <div class="card-header bg-default ">
                        <div class="row">
                            <div class="col">
                                <h2 class="text-right "><?=$drivers_total?></h2>
                            </div>
                        </div>
                        <h4 class=" py-4 "><i class="text-left fas fa-user-alt px-3"></i> Drivers</h4>
                      </div>
                      
                      <div class="card-footer  bg-default">
                        <a href="drivers" >
                            <span class="text-left text-default">View Details</span>
                             <span class="text-right text-default"><i class="fa fa-arrow-circle-right"></i></span>
                          </a>
                      </div>
                    </div>
		      </div>
           		<div class="col-md-3 col-sm-12 col-xs-12 py-3">
					<div class="card text-center">
                      <div class="card-header bg-info ">
                        <div class="row">
                            <div class="col">
                                <h2 class="text-right text-light"><?=$customers_total?></h2>
                            </div>
                        </div>
                        <h4 class=" py-4 text-light"><i class="text-left fas fa-user-alt px-3"></i> Customers</h4>
                      </div>
                      
                      <div class="card-footer">
                        <a href="customers" >
                            <span class="text-left text-info ">View Details</span>
                             <span class="text-right text-info "><i class="fa fa-arrow-circle-right"></i></span>
                          </a>
                      </div>
                    </div>
		      </div>
			</div>
		</div>
	</section>
	<!--how-to-work end-->	
	<!--discover-new-restaurants-&-book-now start-->
	<section class="new-restaurants-book-now">		
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div class="new-heading">
<!--						<h1> Restaurant Orders </h1>-->
					</div>
				</div>
          </div>
			</div>
			<div class="row">				
				<div class="col-md-12">						
					<div class="container">
<!--
                     <select name="rest" id="rest" class="form-control">
                        <option selected disabled></option>
                     </select>
-->
                      <div class="row my-2">
<!--
                          <div class="col-md-6 py-1">
                              <div class="card">
                                  <div class="card-body">
                                      <canvas id="chLine"></canvas>
                                  </div>
                              </div>
                          </div>
-->
<!--
                          <div class="col-md-12 py-1 ">
                              <div class="card">
                                  <div class="card-body">
                                      <canvas id="chBar"></canvas>
                                  </div>
                              </div>
                          </div>
-->
                      </div>
<!--
                      <div class="row py-2">
                          <div class="col-6 py-1" style="margin-left: 20%;">
                              <div class="card">
                                  <div class="card-body " style="">
                                      <canvas id="chDonut1"></canvas>
                                  </div>
                              </div>
                          </div>
                      
                      </div>
-->
                  </div>
				</div>
			</div>
  
		
  
	</section>
	<!--discover-new-restaurants-&-book-now end-->	

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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.js"></script>
  <script>
  
  /* chart.js chart examples */

// chart colors
var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

/* large line chart */
var chLine = document.getElementById("chLine");
var chartData = {
  labels: ["AMAZING BAKES", "STEERS", "KIPS"],
  datasets: [{
    data: [589, 445, 483],
    backgroundColor: 'transparent',
    borderColor: colors[0],
    borderWidth: 4,
    pointBackgroundColor: colors[0]
  }

  ]
};
if (chLine) {
  new Chart(chLine, {
  type: 'line',
  data: chartData,
  options: {
    scales: {
      xAxes: [{
        ticks: {
          beginAtZero: false
        }
      }]
    },
    legend: {
      display: false
    },
    responsive: true
  }
  });
}


/* bar chart */
var chBar = document.getElementById("chBar");
if (chBar) {
  new Chart(chBar, {
  type: 'bar',
  data: {
    labels: <?=json_encode($labels)?>,
    datasets: [{
      data: <?=json_encode($dataPoints, JSON_NUMERIC_CHECK)?>,
      backgroundColor: colors[0]
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
      xAxes: [{
        barPercentage: 0.4,
        categoryPercentage: 0.5
      }]
    }
  }
  });
}

/* 3 donut charts */
var donutOptions = {
  cutoutPercentage: 85, 
  legend: {position:'bottom', padding:5, labels: {pointStyle:'circle', usePointStyle:true}}
};

// donut 1
var chDonutData1 = {
    labels: ['AMAZING BAKES', 'STEERS', 'KIPS'],
    datasets: [
      {
        backgroundColor: colors.slice(0,3),
        borderWidth: 0,
        data: [589, 445, 483]
      }
    ]
};

var chDonut1 = document.getElementById("chDonut1");
if (chDonut1) {
  new Chart(chDonut1, {
      type: 'pie',
      data: chDonutData1,
      options: donutOptions
  });
}


/* 3 line charts */
var lineOptions = {
    legend:{display:false},
    tooltips:{interest:false,bodyFontSize:11,titleFontSize:11},
    scales:{
        xAxes:[
            {
                ticks:{
                    display:false
                },
                gridLines: {
                    display:false,
                    drawBorder:false
                }
            }
        ],
        yAxes:[{display:false}]
    },
    layout: {
        padding: {
            left: 6,
            right: 6,
            top: 4,
            bottom: 6
        }
    }
};

  </script>
  
  
  </body>

</html>
