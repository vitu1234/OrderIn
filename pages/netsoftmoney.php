<?php
session_start();

if(!isset($_SESSION['cart']) || !isset($_SESSION['user'])){
	?>	
	<script>
		window.location = "cart";
	</script>
<?php
}else{
	if(isset($_POST['location']) && isset($_POST['manual_location']) && isset($_POST['longtude']) && isset($_POST['latitude']) && isset($_POST['place_id']) && isset($_POST['total_pay'])){
	$location = addslashes($_POST['location']);
	$manual_location = addslashes($_POST['manual_location']);
	$longtude = addslashes($_POST['longtude']);
	$latitude = addslashes($_POST['latitude']);
	$place_id = addslashes($_POST['place_id']);
	$total_pay = addslashes($_POST['total_pay']);

	         //generate token
$token_random = rand(1000, 10000);
$business_name = "Daeyang";
$date = date("Y-m-d");
$token_id = $business_name.$token_random.$date;

			$final_total = 0;
				
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
				}



?>

<div class="col-lg-8 col-md-8 ">
	<div class="my-5" >
	    <form id="transact" method="post" action="">
		  <input type="hidden" name="business_number" id="business_number" placeholder="" value="882992942" required>
		  <input type="hidden" name="token_id" id="token_id" placeholder="" value="<?=$token_id?>" required="">
		  <input type="hidden" name="amount" id="amount" placeholder="" value="<?=$total_pay?>" required="">
<!--		  <input type="submit" class="login-btn btn-link text-light" style="background-color:#FF7C2F;" onClick="tester()" name="submit" value="proceed">-->
			
			<button onclick="tester()" style="background-color:#FF7C2F;" name="submit"  type="submit" class="login-btn btn-link text-light">Proceed</button>
	  </form> 
		   <form id="complete_transaction" method="post" action="process/integration.php" style="display:none;">
			  <input type="hidden" name="business_number" id="business_number" placeholder="" value="882992942" required>

			  <input type="hidden" name="token" id="token" placeholder="" value="<?=$token_id?>" required="">
			  <input type="hidden" name="location" id="location" placeholder="" value="<?=$location?>" required="">
			  <input type="hidden" name="latitude" id="latitude" placeholder="" value="<?=$latitude?>" required="">
			  <input type="hidden" name="longtude" id="longtude" placeholder="" value="<?=$longtude?>" required="">
			  <input type="hidden" name="place_id" id="place_id" placeholder="" value="<?=$place_id?>" required="">
			  <input type="hidden" name="manual_location" id="manual_location" placeholder="" value="<?=$manual_location?>" required="">

<!--			  <input class="primary" type="submit" name="submit" value="Complete Transaction">-->
			   <button onclick="tester()" style="background-color:#FF7C2F;" name="submit"  type="submit" class="login-btn btn-link text-light">Complete Transaction</button>
		  </form>	
</div>
</div>
<?php
	}else{
			?>	
	<script>
		window.location = "checkout";
	</script>
<?php
	}
	
} ?>
<script type="text/javascript" src="https://www.netsoftmoney.com/api/api.js"></script>
<script type="text/javascript">
   function tester(){
	  setTimeout(function(){ 
		  $("#transact").hide();
		  $("#complete_transaction").show();
	  }, 5000);
  }; 
</script>
