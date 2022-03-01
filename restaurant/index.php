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

$orders_total = 0;
$food_tems = '';

//get the restaurant assigned to
$getRestaurant = $operation->retrieveSingle("SELECT * FROM `restaurant_managers` WHERE user_id = '$user_id'");
$rest_id = $getRestaurant['restaurant_id'];

//get items for the restaurant
$food_tems = $operation->countAll("SELECT * FROM `products` WHERE restaurant_id = '$rest_id'");

$dataPoints = '';
 $now = new DateTime();
$back = $now->sub(DateInterval::createFromDateString('30 days'));
$back2 = $now->sub(DateInterval::createFromDateString('7 days'));
$seven_days = $back2->format('Y-m-d 00:00:00');
//$thirty_days = $back->format('Y-m-d 00:00:00');

	$today = date("Y-m-d H:i:s");
	
	//15mins/37days after the first usage
	$date = strtotime("-30 day", strtotime($today));
	$thirty_days = date('Y-m-d H:i:s', $date);


$orders_thirty_days =0;
$orders_seven_days =0;
$all_time =0;

foreach($operation->retrieveMany("SELECT * FROM `products` WHERE restaurant_id = '$rest_id'") as $row){
  $product = $row['product_id'];
  $orders_total += $operation->countAll("SELECT * FROM `orders` WHERE product_id = '$product' AND date(date_created)=CURDATE()");
// UserMessageSentDate < now() - interval 30 DAY
  $orders_thirty_days += $operation->countAll("SELECT * FROM `orders` WHERE product_id = '$product' AND date_created < now() - interval 30 DAY");
  $orders_seven_days += $operation->countAll("SELECT * FROM `orders` WHERE product_id = '$product' AND date_created < now() - interval 7 DAY");
 $all_time += $operation->countAll("SELECT * FROM `orders` WHERE product_id = '$product'");
 
  $dataPoints =$all_time.",".$orders_thirty_days.",".$orders_seven_days.",".$orders_total;
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
	<link rel="stylesheet" type="text/css" href="css/materialPreloader.css">
</head>

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
											<li class="nav-item active">
												<a class="nav-link" href="index">Home </a>
											</li>
											<li class="nav-item">
												<a class="nav-link" href="orders">Orders</a>
											</li>
											<li class="nav-item">
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


	<!--how-to-work start-->
	<section class="how-to-work">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-sm-12 col-xs-12 py-3">
					<div class="card text-center">
                      <div class="card-header bg-warning">
                        <div class="row">
                            <div class="col">
                                <h2 class="text-right "><?=$food_tems?></h2>
                            </div>
                        </div>
                        <h4 class=" py-4"><i class="text-left fas fa-pizza-slice	px-3"></i> Food Items</h4>
                      </div>
                      
                      <div class="card-footer  bg-default">
                        <a href="meals" >
                            <span class="text-left text-warning">View Details</span>
                             <span class="text-right text-warning"><i class="fa fa-arrow-circle-right"></i></span>
                          </a>
                      </div>
                    </div>
				</div>
              
              <div class="col-md-6 col-sm-12 col-xs-12 py-3">
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
						<h1> Orders Summary</h1>
					</div>
				</div>
          </div>
			</div>
			<div class="row">				
				<div class="col-md-12">						
					<div class="container">
  
                      <div class="row my-2">
<!--
                          <div class="col-md-6 py-1" >
                              <div class="card">
                                  <div class="card-body">
                                      <canvas id="chLine"></canvas>
                                  </div>
                              </div>
                          </div>
-->
                          <div class="col-md-12 py-1 ">
                              <div class="card">
                                  <div class="card-body">
                                      <canvas id="chBar"></canvas>
                                  </div>
                              </div>
                          </div>
                      </div>
                      
                  </div>
				</div>
			</div>
  
		
  
	</section>
	<!--discover-new-restaurants-&-book-now end-->	

	<input type="hidden" id="uid" value="<?=$user_id?>" />
	<!--  add location modal-->
  <div id="confirmAdd" class="modal fade " role="dialog" aria-hidden="true" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered modal-md" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title font-weight-400 text-danger">Add Restaurant Location</h5>
          <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
        </div>
        <div class="modal-body p-4">
              
                <div id="dataRequests">



                 </div>

        </div>
      </div>
    </div>
  </div>
	
	
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
	 <script type="text/javascript" src="js/materialPreloader.js"></script>
	<script src="js/js.js"></script>
 <script>
	 
	 $(function(){
		  //check restaurant location
		 checkRestLocation();
		 
	 });
  
  /* chart.js chart examples */

// chart colors
var colors = ['#007bff','#28a745','#333333','#c3e6cb','#dc3545','#6c757d'];

/* large line chart */
var chLine = document.getElementById("chLine");
var chartData = {
  labels: ["S", "M", "T", "W", "T", "F", "S"],
  datasets: [{
    data: [10,589, 445, 483,40,50,100],
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
    labels: ["All time","30 Days ago", "7 Days ago", "Today"],
    datasets: [{
      data: [<?=$dataPoints?>],
      backgroundColor: colors[0]
    }]
  },
  options: {
    legend: {
      display: false
    },
    scales: {
        yAxes: [{
           ticks: {
               beginAtZero: true,
               callback: function(value) {if (value % 1 === 0) {return value;}}
           }
       }],
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
