<?php
	 include("connection/Functions.php");
	 $operation = new Functions();
	session_start();
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

    <title>OrderIn | Cart </title>

    <!-- Bootstrap core CSS-->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/cart.css" rel="stylesheet">
	<link href="css/alert_modal.css" rel="stylesheet">
	<link href="css/responsive.css" rel="stylesheet">
	<link href="css/search.css" rel="stylesheet">
	<link href="css/mega.menu.css" rel="stylesheet">
	<link href="css/thumbnail.slider.css" rel="stylesheet">
	<link href="css/datepicker.css" rel="stylesheet">
	<link href="css/bootstrap-select.css" rel="stylesheet">

	<!-- Owl Carousel for this template-->
	<link rel="stylesheet" href="assets/owlcarousel/assets/owl.carousel.min.css"> 
 	
    <!-- Fontawesome styles for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
	<style>
		body{
			background-color: #fdfdfd;
		}
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
					<h3>Cart</h3>
					</div>
				</div>
				<div class="col-md-6">
					<div class="right-title-text">  
						<ul>
							<li class="breadcrumb-item"><a href="index">Home</a></li>
							<li class="breadcrumb-item active" aria-current="page">Cart</li>
						</ul>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!--title-bar end-->	
	<!--meal-detail-start-->
	<section class="all-partners">	
		<div class="container pb-5 mb-2">
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
					
					//get the name of the size
					$prod_size = '<strong>Meal Size</strong>';
					$total_size = 0;
					if(isset($row['size'])){
						$size = $row['size']; 	
						$getSize = $operation->retrieveSingle("SELECT * FROM `product_sizes` WHERE prod_size_id ='$size' AND product_id = '$prod_id'");
						$prod_size .= '<span>'.$getSize['size_name'].' - MWK '.number_format($getSize['size_price'],2).'</span>';
						$total_size += $getSize['size_price'];
					}
					
					//get the name of the options
					$prod_options = '<strong>Extras</strong>';
					$total_options = 0;
					if(isset($row['options'])){
						// Variable Declaration for String
						$str = $row['options'];
						
						// Create Array Out of the String, The comma ',' is the delimiter
						// This would output 
						//       [ 1 => 1, 2 => 2, 3 => '', 4 => 4, 5 => 5, 6 => 6 ]
						$explodedStr = explode(',', $str);
	
						// Filter Array And Remove The empty element which in this case
						//    3 => ''
						$filteredArray = array_filter( $explodedStr );
						for($i=0;$i<(count($filteredArray));$i++){
							$option_id = $filteredArray[$i];
							$getExtras = $operation->retrieveSingle("SELECT * FROM `product_extras` WHERE prod_extras_id ='$option_id' AND product_id = '$prod_id'");
							$prod_options.= '<span>'.$getExtras['extra_name'].' - MWK '.number_format($getExtras['extra_price'],2).'</span>';
							$total_options+=$getExtras['extra_price'];
						}
						// Convert Array into String with comma delimiter 
						
					}
					

					
					?>
						 <!-- Cart Item-->
					<div id="cart_row<?=$prod_id?>" class="cart-item d-md-flex justify-content-between"><span onclick="removeFromCart('<?=$prod_id?>')" class="remove-item"><i class="fa fa-times"></i></span>
						<div class="px-3 my-3">
						<a class="cart-item-product" href="javascript:void(0);" onclick="setMeal('<?=$prod_id?>')">
							<div class="cart-item-product-thumb rounded"><img  height="55px" width="50px" src="images/<?=$image?>" alt="Product"></div>
							<div class="cart-item-product-info">
								<h4 class="cart-item-product-title"><?=$product_name?></h4>
								<input type="hidden" value="<?=$price?>" id="prod_cart_price<?=$prod_id?>"/>
								<input type="hidden" value="<?=$delivery_fee?>" id="prod_fee_price<?=$prod_id?>"/>
								<input type="hidden" value="<?=$total?>" id="prod_curr_tot<?=$prod_id?>"/>
								<input type="hidden" value="<?=$total_options?>" id="tot_options<?=$prod_id?>"/>
								<input type="hidden" value="<?=$total_size?>" id="tot_size<?=$prod_id?>"/>
								<span>MWK <?=number_format($price,2)?> + MWK <?=number_format($delivery_fee,2)?> (Delivery Fee)</span>
								<?=$prod_size?>
								<?=$prod_options?>
							</div>
						</a>
					</div>
						<div class="px-3 my-3 text-center">
						<div class="cart-item-label">Qty</div>
						<div class="count-input">
							<select class="form-control" id="qty<?=$prod_id?>" onchange="calculateSubTotal('<?=$prod_id?>')">
								<?php
									for($i=1;$i<=6;$i++){
										$selected ='';
										if($qty == $i){
											$selected = 'selected';
										}
										echo '<option '.$selected.' value="'.$i.'">'.$i.'</option>';
									}
								?>
								
								
							</select>
						</div>
					</div>
					<div class="px-3 my-3 text-center">
						<div class="cart-item-label">Subtotal</div><span id="subtotal<?=$prod_id?>" class="text-xl font-weight-medium">MWK <?=number_format($total,2)?></span>
					</div>

					</div>
		
					<?php
				}
			}else{
				echo '<div class=""><p class="text-center mb-5 alert alert-info">Nothing in cart!</p></div>';
			}
		?>
		<?php
			if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
		?>	
			    <!--  + Subtotal-->
		<div class="d-sm-flex justify-content-between align-items-center text-center text-sm-left">
			<form class="form-inline py-2">
            
        	</form>
			<input type="hidden" id="final_total" name="final_total" value="<?=$final_total?>"/>
			<div class="py-2"><span class="d-inline-block align-middle text-sm text-muted font-weight-medium text-uppercase mr-2">Total:</span><span style="color:#000" class="d-inline-block align-middle text-xl font-weight-medium" id="total_para">MWK <?=number_format($final_total,2)?></span></div>
		</div>
		<?php 
			}
		?>	
		<!-- Buttons-->
		   <hr class="my-2">
			<div class="row pt-3 pb-5 mb-2">
				<div class="col-sm-6 mb-3"><a class="btn text-light btn-style-1 btn-secondary btn-block" href="meals"><i class="fas fa-plus"></i>&nbsp; Meals</a></div>
				<?php
					if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])){
				?>
					<div class="col-sm-6 mb-3"><a class="btn btn-style-1 btn-warning text-light btn-block" style="background-color:#FF7C2F;" href="checkout">&nbsp;Checkout <i class="fas fa-chevron-right"></i></a></div>
				<?php 
					}
				?>
			</div>
		</div>
	</section>			
	<!--meal-deail end-->
	</div>
	<!--footer start-->
<?php include("footer.php");?>

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
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>
	 <!-- Assect scripts for this page-->
	<script src="assets/owlcarousel/owl.carousel.js"></script>
	<script src="js/custom.js"></script>
	<script src="js/thumbnail.slider.js"></script>
	<script src="js/bootstrap-datepicker.js"></script>
	<script src="js/bootstrap-select.js"></script>
	<script src="js/jquery.number.min.js"></script>
	<script src="js/js.js"></script>
	<script>
//		document.addEventListener('contextmenu', event => event.preventDefault());
	$(document).ready(function(){
		
	});
		
		
	</script>

  </body>

</html>
