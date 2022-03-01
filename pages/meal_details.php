<?php
include("../connection/Functions.php");
$operation = new Functions();
session_start();
if(!isset($_POST['id']) || empty($_POST['id']) ){
  ?>
  <script>
      window.location = "meals";
  </script>
  <?php
  die();
}
$prod_id = addslashes($_POST['id']);
//get product
$getProduct = $operation->retrieveSingle("SELECT product_id, product_name,product_price,availability,meal_type,delivery_fee,prep_mins, products.img_url as prod_img_url, restaurant_info.img_url as rest_img_url, restaurant_name, restaurant_phone, restaurant_address,exact_location FROM products INNER JOIN restaurant_info ON products.restaurant_id = restaurant_info.restaurant_id WHERE product_id = '$prod_id'");
$total = $getProduct['product_price']+$getProduct['delivery_fee'];
$img = '';
if($getProduct['rest_img_url'] != ''){
	$img = $getProduct['rest_img_url'];
}else{
	$img = "orderlogo1.png";
}

?>
<style>
	div{
		color: #000;
	}
</style>

		<div class="container">		
			<div class="row">					
				<div class="col-lg-6 col-md-6">
					<div id="sync1" class=" owl-carousel owl-theme">
						<div class="item">
							<img id="mm" class="rounded img-fluid" style="width:70%;height:50%;"  src="images/<?=$getProduct['prod_img_url']?>" alt="Image">
						</div>					
					</div>

					<div id="sync2" class="owl-carousel owl-theme">
						<div class="item">
						</div>

					</div>
					
					<div class="resto-meal-dt">
						<div class="resto-detail">
							<div class="resto-picy">
								<a href="javascript:void(0)"><img class="rounded" height="55px" width="50px" src="images/<?=$img?>" alt=""></a>
							</div>
							<div class="name-location">
								<a href="javascript:void(0)"><h1><?=$getProduct['restaurant_name']?></h1></a>
								<p><span><i class="fas fa-phone"></i></span>0<?=$getProduct['restaurant_phone']?> </p>
								<p><span><i class="fas fa-map-marker-alt"></i></span><?=$getProduct['restaurant_address']?> - <?=$getProduct['exact_location']?></p>
							</div>
						</div>
					
					</div>
			
				
				</div>
				<div class="col-lg-6 col-md-6">
					<form id="addCartForm" action="" method="post">
					<div class="right-side">
						<div class="new-heading t-bottom">
							<h1><?=$getProduct['product_name']?>  
							</h1>
							<br/>
							<h5>		
								<?php
								//get meal type
								if($getProduct['meal_type'] == 1){
								  echo "<small>Veg. Meal</small>";
								}elseif($getProduct['meal_type'] == 2){
								  echo "<small>Non-Veg. Meal</small>";
								}else{
//									echo "<small>Vegeterian Meal</small>";
								}
							?></h5>
						</div>
										
						<div class="price">
							<span>MWK <?=number_format($getProduct['product_price'],2)?></span>
						</div>
						<div class="dt-detail">
							<ul>
								<li>
									<div class="delivery">
										<i class="fas fa-shopping-cart"></i>Delivery Fee: MWK <?=number_format($getProduct['delivery_fee'],2)?>
									</div>
									<div class="time">
										<i class="far fa-clock"></i>Preparing Time: <?=$getProduct['prep_mins']?> Min(s)
									</div>
						
								</li>
							</ul>
						</div>
					
<!--						check options and product size -->
						<?php
							//check for product sizes
							$countSize = $operation->countAll("SELECT *FROM product_sizes WHERE product_id = '$prod_id'");
							 if($countSize >0){
								 echo '<div class="Extra-option">
									<strong style="color:black;">Meal Size (required)</strong>
									<ul class="food-bootom">
									';
								 	$options = $operation->retrieveMany("SELECT *FROM product_sizes WHERE product_id = '$prod_id'");
								 	$i=0;
								 	foreach($options as $row){
										$i++;
										echo '	
										<li>
											<p class="food-left">
												<input onclick="onCheckSizes(\''.$row['size_price'].'\')" type="radio" id="c11'.$i.'" value="'.$row['prod_size_id'].'" name="sizes[]" required />
												<label for="c11'.$i.'">'.$row['size_name'].'</label>
											</p>
											<span>MWK '.number_format($row['size_price'],2).'</span>
										</li>';
									}
								 
								 echo '</ul></div>';
							 }
								//check for product options 
							$countOptions = $operation->countAll("SELECT *FROM product_extras WHERE product_id = '$prod_id'");
							 if($countOptions >0){
								 echo '<div class="Extra-option">
								 		<strong style="color:black;">Extras</strong>
										<ul class="food-bootom">
									';
								 	$options = $operation->retrieveMany("SELECT *FROM product_extras WHERE product_id = '$prod_id'");
								 $i =0;
								 	foreach($options as $row){
										$i++;
										echo '	
										<li>
											<p class="food-left">
												<input onclick="onCheckOptions(\''.$i.'\',\''.$row['extra_price'].'\')" type="checkbox" id="c1'.$i.'" value="'.$row['prod_extras_id'].'" name="options[]">
												<label for="c1'.$i.'">'.$row['extra_name'].'</label>
											</p>
											<span>MWK '.number_format($row['extra_price'],2).'</span>
										</li>';
									}
								 
								 echo '</ul></div>';
							 }	 
						
						?>
						
						<div class="Qty" >
										<h4> Qty</h4>
										 <div class="input-group">
											<div class="input-group-prepend">
												<button type="button" class="minus-btn btn-sm" id="minus-btn"><i class="fas fa-minus-square"></i></button>
											</div>
											<input  type="text" name="qty_input" id="qty_input" class="qty-control" value="1" min="1" max="6">
											<div class="input-group-prepend">
												<button type="button" class="add-btn btn-sm" id="plus-btn"><i class="fas fa-plus-square"></i></button>
											</div>
										</div>
									</div>
						<div class="total-cost">
							<div class="total-text">
								<h5>Total</h5>
							</div>
							<div class="total-price">
								<input type="hidden" id="total" name="total" value="<?=$total?>" />
								<input type="hidden" id="actual_total" name="actual_total" value="<?=$getProduct['product_price']?>" />
								<input type="hidden" id="product_id" name="product_id" value="<?=$prod_id?>" />
								<input type="hidden" id="delivery_fee" name="delivery_fee" value="<?=$getProduct['delivery_fee']?>" />
								<p id="para_total">MWK <?=number_format($total,2)?></p>
							</div>
						</div>
						<div class="order-now-check">
							<!--<button class="on-btn btn-link" onclick="">Order Now</button>-->
							<button style="background-color:#FF7C2F;" id="add-to-cart" class="b-btn btn-link" type="submit">Add to cart</button>
						</div>
						
						
					</div>
						</form>
				</div>
			</div>			
		</div>

<!--<input type="text" id="prevCheckedAmount" value="0" />-->
<input type="hidden" id="sizeAmount" value="0" />
<input type="hidden" id="optionAmount" value="0" />
	<script src="js/thumbnail.slider.js"></script>
	<script src="js/js.js"></script>

<script>
	function onCheckSizes(amount){
		var prod_actual_total = parseInt($("#actual_total").val());
		var delivery_fee =parseInt($("#delivery_fee").val());
		var qty = parseInt($("#qty_input").val());
		var optionAmount = parseInt($("#optionAmount").val());
		
		if($('input[name="sizes[]').is(':checked')){
			var sizeAmount = parseInt(amount);
//			console.log("set size amount: "+sizeAmount);
			$("#sizeAmount").val(sizeAmount);
			
			var total = (parseInt(sizeAmount+optionAmount+prod_actual_total)*qty)+delivery_fee;
			
//			console.log("new total: "+total)
			$("#total").val(total);
			$("#para_total").html("MWK "+$.number( total, 2 ));
			
			
		}else{
//			alert("unchecked")
		}
	}
	
	function onCheckOptions(id,amount){
		var prod_actual_total = parseInt($("#actual_total").val());
		var delivery_fee =parseInt($("#delivery_fee").val());
		var qty = parseInt($("#qty_input").val());
		
		if($('#c1'+id).is(':checked')){
//			console.log("checked-: "+amount);
			
			var checked = parseInt(amount);
			var sizeAMount = parseInt($("#sizeAmount").val());	
			var checkedOptionTotal = parseInt($("#optionAmount").val())//already existing checked optional sum
			
			//new selected amount total
			var newOptionTotal = parseInt(amount)+checkedOptionTotal;
			$("#optionAmount").val(newOptionTotal)
			
			var total = (parseInt(newOptionTotal+prod_actual_total+sizeAMount)*qty)+delivery_fee;
			$("#total").val(total);
			$("#para_total").html("MWK "+$.number( total, 2 ));
//			console.log("tot new: "+total);
			
		}else{
			console.log("unchecked-subtract: "+amount);
			var checked = parseInt(amount);
			var sizeAMount = parseInt($("#sizeAmount").val());	
			var checkedOptionTotal = parseInt($("#optionAmount").val())//already existing checked optional sum
			//new selected amount total
			var newOptionTotal = checkedOptionTotal-parseInt(amount);
			$("#optionAmount").val(newOptionTotal)
			
			var total = (parseInt(newOptionTotal+prod_actual_total+sizeAMount)*qty)+delivery_fee;
			$("#total").val(total);
			$("#para_total").html("MWK "+$.number( total, 2 ));
//			console.log("tot new: "+total);
			
		}
	}
	
	
	
    $(document).ready(function(){
      preloader.off();
      closeNav();
		

		
		
//		if ($('input[name="sizes[]"]').length && $('input[name="options[]"]').length){
//			alert("both")
//		}else if($('input[name="sizes[]"]').length){
//			if($('input[name="sizes[]').is(':checked')){
//				alert($('input[name="sizes[]').is(':checked').val())
//			}	 
//		}else if($('input[name="options[]"]').length){
//			var total = $("#total").val();	 
//			if($('#terms_check').is(':checked')){
//				
//			}
//		}else{
////			alert(none);
//		}
		
		
		$('#qty_input').prop('readonly', true);
		$('#plus-btn').click(function(){
			if($('#qty_input').val() == 6){
				
			}else{
				$('#qty_input').val(parseInt($('#qty_input').val()) + 1 );
			}
    	
			var actual_total = parseInt($("#actual_total").val());
			var qty = parseInt($("#qty_input").val());
			var checked = parseInt($("#sizeAmount").val());
			var optioCheck = parseInt($("#optionAmount").val());
			
			
			
			if(actual_total !== '' && qty !=='' && qty > 0){
				var delivery_fee =parseInt($("#delivery_fee").val());
				var new_tot = ((actual_total+checked+optioCheck)*qty)+delivery_fee;
				$("#total").val(new_tot);
				$("#para_total").html("MWK "+$.number( new_tot, 2 ));
			}
			
    	    });
		
        $('#minus-btn').click(function(){
    	$('#qty_input').val(parseInt($('#qty_input').val()) - 1 );
			var actual_total = parseInt($("#actual_total").val());
			var qty = parseInt($("#qty_input").val());
			var checked = parseInt($("#sizeAmount").val());
			var optioCheck = parseInt($("#optionAmount").val());
			
			if(actual_total !== '' && qty !=='' && qty > 0){
				var delivery_fee =parseInt($("#delivery_fee").val());
				var new_tot = ((actual_total+checked+optioCheck)*qty)+delivery_fee;
				$("#total").val(new_tot);
				$("#para_total").html("MWK "+$.number( new_tot, 2 ));
			}
    	if ($('#qty_input').val() == 0) {
			$('#qty_input').val(1);
		}

		});
    });
	//add to cart
	$('#add-to-carts').on('click', function () {
		var product_id = $("#product_id").val();
		var qty_input = $("#qty_input").val();
		var total = $("#total").val();
		 $("#add-to-cart").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');

		if(product_id !== '' && qty_input !=='' && total !=='' ){
			$.ajax({  
                url:"process/cart_manager.php",  
                method:"POST",  
                data:{
                    product_id:product_id,
                    qty_input:qty_input,
                    total:total
                },  
              
                success:function(data){  
//                    alert(data);
                    var dataResult = JSON.parse(data);
                    $("#add-to-cart").html('Add to cart');
                   if(dataResult.code == 1){
					   $("#cart_count").html(dataResult.count_cart);
					   	var cart = $('.shopping-cart');
						var imgtodrag = $("#mm").eq(0);
						if (imgtodrag) {
							var imgclone = imgtodrag.clone()
								.offset({
								top: imgtodrag.offset().top,
								left: imgtodrag.offset().left
							})
								.css({
								'opacity': '0.5',
									'position': 'absolute',
									'height': '150px',
									'width': '150px',
									'z-index': '100'
							})
								.appendTo($('body'))
								.animate({
								'top': cart.offset().top + 10,
									'left': cart.offset().left + 10,
									'width': 100,
									'height': 100
							}, 1000, 'easeInOutExpo');

							setTimeout(function () {
								cart.effect("shake", {
									times: 2
								}, 200);
							}, 1500);

							imgclone.animate({
								'width': 0,
									'height': 0
							}, function () {
								$(this).detach()
							});
						}
                   }
				}
           });
			
			
		}
    });
</script>