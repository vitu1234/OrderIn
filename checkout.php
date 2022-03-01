<?php
	 include("connection/Functions.php");
	 $operation = new Functions();
session_start();
if(!isset($_SESSION['cart']) || empty($_SESSION['cart'])){
		header("Location:cart");
	}

if(!isset($_SESSION['user']) || empty($_SESSION['user'])){
		header("Location:signin");
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

    <title>OrderIn | Checkout </title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/mega.menu.css" rel="stylesheet">
	<link href="css/thumbnail.slider.css" rel="stylesheet">
	<link href="css/alert_modal.css" rel="stylesheet">
	<link href="css/search.css" rel="stylesheet">
	<link href="css/datepicker.css" rel="stylesheet">
	<link href="css/bootstrap-select.css" rel="stylesheet">
	<link href="css/bootstrap-select.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="css/materialPreloader.css">
	<!-- Owl Carousel for this template-->
	<link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css"> 
 	
    <!-- Fontawesome styles for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">


<style>
	.shopping-cart {
    display: inline-block;
    background: url('http://cdn1.iconfinder.com/data/icons/jigsoar-icons/24/_cart.png') no-repeat 0 0;
    width: 20px;
    height: 20px;
    margin: 0 10px 0 0;
}</style>
</head>

<body>
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
						<div class="col-md-10 col-sm-12 col-xs-12">	
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
													<form class="form-inline" >
													  <input class="form-control " style="color:#000;" type="text" placeholder="What are you craving for?" id="searchValue" aria-label="Search">
													  <button id="search_btn" class="s-btn btn-link " type="button"><i class="fas fa-search"></i></button>
													</form>																																								
												</div>
											</div>												
										</div>		
										</li>




								
										<?=$btn;?>								
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</header>
	<!--header end-->		
		<div class="" id="searchedContent">
	
	</div>
	
	<div id="replaceSearch">
	<!--title-bar start-->
	<section class="title-bar">
		<div class="container">
			<div class="row">
				<div class="col-md-6">
					<div class="left-title-text">
					<h3>Checkout</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Checkout</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--title-bar end-->	
	<!--partners start-->
	<section class="all-partners">			
		<div class="container">		
			<div class="row" id="checkoutData">					
				<div class="col-lg-8 col-md-8">
					   <p id="tt" class="text-danger my-2"><i class="fas fa-exclamation-triangle"></i> If location is not found within 1 minute, make sure you allowed location permissions on this site</p>
					
					    <form id="addCoordinatesForm"  action="" enctype="multipart/form-data" method="post">
							<div class="row">
							  <div class="col-12 col-sm-6">
								<div class="form-group">
								  <label for="fullName">Found Location</label>
								  <input style="color:#000;" type="text" class="form-control py-2" readonly data-bv-field="fullName" id="location" name="location" required placeholder="Getting Location..." />
								</div>
							  </div>
							
								<div class="col-12 col-sm-6">
								<div class="form-group">
								  <label for="fullName">For Efficiency</label>
									<textarea class="form-control " style="color:#000;" id="manual_location" name="manual_location" required placeholder="Enter address manually"></textarea>
								 
								</div>
							  </div>
								  <div class="col-12 ">
								<div class="form-group">
									<input type="hidden" required name="longtude" id="longtude" required />
									<input type="hidden" required name="latitude" id="latitude" required/>
									<input type="hidden" required name="place_id" id="place_id" required/>
									<div id="button_holder">
									  <button disabled id="btn_save_coordinates" class="b-btn btn-link text-light" type="button"></button>
									</div>
								</div>
							  </div>
							 </div>
						</form>

				</div>

				<div class="col-lg-4 col-md-4">						
					<div class="right-payment-method">
						<h4>Payment Method</h4>
						<div class="single-payment-method">
							
							
						</div>
						<div class="single-payment-method">
							<div class="payment-method-name">
								<div class="custom-control custom-radio">
									<input type="radio" checked id="directbank" name="paymentmethod" value="bank" class="custom-control-input">
									<label class="custom-control-label" for="directbank"><a href="https://netsoftmoney.com/">NetSoft Money</a></label>
								</div>
							</div>

						</div>
					</div>
					<div class="your-order">
						<h4 class="text-center">Your Order</h4>
								<?php
			$final_total = 0;
			if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
				
				foreach($_SESSION['cart'] as $row){
						$prod_id = $row['product_id']; 
						$product_name = $row['product_name'];
						$image = $row['product_image']; 
						$price = $row['product_price']; 
						$delivery_fee = $row['delivery_fee']; 
						$prep_mins = $row['prep_mins']; 
						$total = $row['total']; 
						$qty = $row['qty']; 
						$final_total +=$total;
					
						?>
						<div class="order-d">
							<div class="item-dt-left">
								<span><?=$product_name?></span>
								<p><?=$qty?> X MWK <?=number_format($price,2)?> + MWK <?=number_format($delivery_fee,2)?>(Delivery Fee)</p>
							</div>
							<div class="item-dt-right">
								<p><?=number_format($total,2)?></p>
							</div>			
						</div>
						
						<?php
					
				}
						
				?>
					<div class="total-bill">
							<div class="total-bill-text">
								<h5>Total</h5>
							</div>
							<div class="total-bill-payment">
								<p>MWK <?=number_format($final_total,2)?></p>
								<input type="hidden" name="total_pay" id="total_pay" value="<?=$final_total?>"/>
							</div>
						</div>	
				<?php
			}
					?>
						
						
						
					</div>
					<div class="checkout-btn">
						
						<a style="background-color:#FF7C2F;" href="javascript:void(0);" onclick="show_netsoft()" id="payBtnn" class="btn text-light btn-style-1 btn-warning btn-block">Payment</a>
						<a href="meals" class="btn text-light btn-style-1 btn-secondary btn-block"><i class="fas fa-plus"></i>&nbsp; Meals</a>
					</div>
				</div>				
			</div>			
		</div>
	</section>			
	<!--partners end-->
	</div>
	<!--footer start-->
<?php include("footer.php"); ?>
	<!--footer end-->
<div id="modal_warning" class="modal modal-message modal-warning fade" style="display: none;" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center">
                    
                </div>
                <div class="modal-title"><i class="fas fa-exclamation-triangle"></i>Warning</div>

                <div class="modal-body" id="msg_title">Is something wrong?</div>
                <div class="modal-footer">
                    <button type="button" class="bt-btn btn-ling btn-sm" data-dismiss="modal">OK</button>
                </div>
            </div> <!-- / .modal-content -->
        </div> <!-- / .modal-dialog -->
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
	<script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	 <!-- Assect scripts for this page-->
	<script src="assets/owlcarousel/owl.carousel.js"></script>
	<script type="text/javascript" src="js/materialPreloader.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/js.js"></script>
		 <script type="text/javascript" src="https://www.netsoftmoney.com/api/api.js"></script>
	<script src="js/thumbnail.slider.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-select.js"></script>	

  </body>
<!--get location-->
	<script>
		document.addEventListener('contextmenu', event => event.preventDefault());
  let G, options, spans;
    $(document).ready(function(){
//      preloader.off();
//      closeNav();
      init();
        $("#btn_save_coordinates").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Getting your location...');
    });

        //geolocation.js
// How to use Navigator.geolocation

function init(){
    if(navigator.geolocation){
        let giveUp = 1000 * 30;  //30 seconds
        let tooOld = 1000 * 60 * 60;  //one hour
        options ={
            enableHighAccuracy: true,
            timeout: giveUp,
            maximumAge: tooOld
        }
        
        navigator.geolocation.getCurrentPosition(gotPos, posFail, options);
    }else{
        //using an old browser that doesn't support geolocation
      alert("You need to update your browser!");
    }
}

function gotPos(position){
//    spans = document.querySelectorAll('p span');
//    spans[0].textContent = position.coords.latitude;
//    spans[1].textContent = position.coords.longitude;
//    spans[2].textContent = position.coords.accuracy;
//    
//    spans[6].textContent = position.timestamp;
  $("#latitude").val(position.coords.latitude);
  $("#longtude").val(position.coords.longitude);
  
 getData(position.coords.latitude, position.coords.longitude);
  
}

function posFail(err){
    //err is a number
    let errors = {
        1: 'No permission',
        2: 'Unable to determine',
        3: 'Took too long'
    }
    $("#addRestaurantCoordResponse").fadeIn(500);
    $("#addRestaurantCoordResponse").html('<p class="text-center alert alert-danger">'+errors[err]+'</p>');
    setTimeout(function(){
         $("#addRestaurantCoordResponse").fadeOut(500);
         $("#addRestaurantCoordResponse").html('');
       },1000);
//    document.querySelector('h1').textContent = errors[err];
}
  
function getData(lat, lng){
  var location = lat+','+lng;
     axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
        params:{
          latlng:location,
          key:'AIzaSyCsv43N4fIGspg5a2sD1SG_w6-6YJHb8ho'
        }
      })
      .then(function(response){
        // Log full response
//        console.log(response);
       // Formatted Address
       
       if(response.data.results[1] !== '' || response.data.results[1] != undefined || response.data.results[1] != null){
          var formattedAddress = response.data.results[1].formatted_address;
          var place_id = response.data.results[0].place_id;
          $("#location").val(formattedAddress);
          $("#place_id").val(place_id);
       }else{
            var formattedAddress = response.data.results[0].formatted_address;
            var place_id = response.data.results[0].place_id;
            $("#location").val(formattedAddress);
            $("#place_id").val(place_id);
       }
       
      $('#button_holder').html('');
      $('#button_holder').html('');
      $("#text_info").hide();
      $("#tt").hide();

      })
      .catch(function(error){
//        console.log(error);
       $("#addRestaurantCoordResponse").fadeIn(500);
        $("#addRestaurantCoordResponse").html('<p>An error occurred, please try again later</p>');
       setTimeout(function(){
         $("#addRestaurantCoordResponse").fadeOut(500);
         $("#addRestaurantCoordResponse").html('');
       },1000);
      });
    }
//netsoft		
//function tester(){
//	  setTimeout(function(){ 
//		  $("#transact").hide();
//		  $("#complete_transaction").show();
//	  }, 5000);
//  }; 
		
</script>
</html>
