<?php
	include("../connection/Functions.php");
//for sending emails
	require("../mailing/vendor/phpmailer/phpmailer/src/PHPMailer.php");
require("../mailing/vendor/phpmailer/phpmailer/src/SMTP.php");
require("../mailing/vendor/phpmailer/phpmailer/src/Exception.php");
	$operation = new Functions();
	session_start();
	if(isset($_POST["token"]) && isset($_POST['location']) && isset($_POST['manual_location']) && isset($_POST['longtude']) && isset($_POST['latitude']) && isset($_POST['place_id'])){
			$user = $_SESSION['user'];
			$location = addslashes($_POST['location']);
			$manual_location = addslashes($_POST['manual_location']);
			$longtude = addslashes($_POST['longtude']);
			$latitude = addslashes($_POST['latitude']);
			$place_id = addslashes($_POST['place_id']);
		
		$fields_string = "";

		//set POST variables
		$url = 'https://netsoftmoney.com/gateway/transactions.php';
		$fields = array(
			'token' => urlencode($_POST['token'])
		);

		//url-ify the data for the POST
		foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
		rtrim($fields_string, '&');

		//open connection
		$ch = curl_init();

		//set the url, number of POST vars, POST data
		curl_setopt($ch,CURLOPT_URL, $url);
		curl_setopt($ch,CURLOPT_POST, count($fields));
		curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

		//execute post
		$result = curl_exec($ch);

		//close connection
		curl_close($ch);

//		echo $result;
		//update database when paid
		if($result == 2029){
			$table1 = "orders";
			$table2 = "customer_location";
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
					
						$data1 = [
							'user_id'=>"$user",
							'product_id'=>"$prod_id",
							'quantity'=>"$qty",
							'payment_status'=>"1",
							'order_delivery_status'=>"0"
						];
					
						if($operation->insertData($table1,$data1) ==1){
							
							//get restaurant and sent email
							$getProduct = $operation->retrieveSingle("SELECT * FROM `products` WHERE product_id = '$prod_id'");
							
							$rest_id = $getProduct['restaurant_id'];
							//get managers
							$getManagers = $operation->retrieveMany("SELECT * FROM `restaurant_managers` WHERE restaurant_id = '$rest_id'");
							foreach($getManagers as $manager){
								//confused i won't do query joins
								$user_id = $manager['user_id'];
								//get user email
								$manas = "manager";
								$getUser = $operation->retrieveSingle("SELECT * FROM `users` WHERE user_id = '$user_id' AND user_role = '$manas'");
								$email = $getUser['email'];
								$fname = $getUser['fname'];
								$lname = $getUser['lname'];
								//send email to restaurant managers
								//send email
								$output='<p>Dear '.$fname." ".$lname.',</p>';
								$output.='<p>Your restaurant has received new orders, please login into the portal and server your customers!</p>';
								$output.='<p>-------------------------------------------------------------</p>';
								$output.='<p>Email: '.$email.'<br/> </p>';		
								$output.='<p>-------------------------------------------------------------</p>';
								$output.='<p>Thanks,</p>';
								$output.='<p>OrderMw, Food Order and Delivery System.</p>';
								$body = $output; 
								$message = " " ;
								$headers = "From :  Admin Support - ordermw.com";

						  		$mail = new PHPMailer\PHPMailer\PHPMailer();
								//$mail->IsSMTP(); // enable SMTP

								$mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only
								$mail->SMTPAuth = true; // authentication enabled
								$mail->SMTPSecure = 'tls'; // secure transfer enabled REQUIRED for Gmail
								$mail->Host = "mail.ordermw.com";
								$mail->Port = 587; // or 587
								$mail->IsHTML(true);
								$mail->Username = "support@ordermw.com";
								$mail->Password = "passwordHere";
								$mail->setFrom("support@ordermw.com","OrderMw");
								$mail->Subject = "DRIVER ACCOUNT CREDENTIALS - ordermw.com";
								$mail->Body = $body;
								$mail->addAddress($email);

								 if(!$mail->Send()){
								 }else{
								 }
								
								
							}
							
							
							
							//get the order
							$getOrder = $operation->retrieveSingle("SELECT * FROM `orders` WHERE user_id = '$user' AND product_id='$prod_id' ORDER BY order_id DESC");
							$order_id = $getOrder['order_id'];
							$data2 = [
								'order_id'=>"$order_id",
								'placeID'=>"$place_id",
								'exact_location'=>"$location",
								'customer_address'=>"$manual_location",
								'longtude'=>"$longtude",
								'latitude'=>"$latitude"
							];
							$operation->insertData($table2,$data2);
							
							
								//get the name of the size
							if(isset($row['size'])){
								$size = $row['size']; 	
								$td  = 'order_prod_size';
								$dt = [
									'prod_size_id'=>"$size",
									'order_id' =>"$order_id"
								];
								$operation->insertData($td,$dt);
							}

							//get the name of the options
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
									$td  = 'order_prod_extras';
									$dt = [
										'prod_extras_id'=>"$option_id",
										'order_id' =>"$order_id"
									];
									$operation->insertData($td,$dt);
								}
								// Convert Array into String with comma delimiter 

							}
							
							unset($_SESSION['cart']);
							
							?>
								<script>
									window.location = "../bill_slip";
								</script>
							<?php
						}
						
					
				}
			
		}else{
			?>
			<script>
				window.location = "../checkout";
			</script>
		<?php
		}

	}

?>