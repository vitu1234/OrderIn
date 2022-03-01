<?php 
//importing required files 
require_once 'DbOperation.php';
require_once 'Firebase.php';
require_once 'Push.php'; 
    include("../../../connection/Functions.php");
    $operation = new Functions();

$db = new DbOperation();

$response = array(); 

//if($_SERVER['REQUEST_METHOD']=='POST'){	
	
	if(isset($_POST['driver_assign_id']) && isset($_POST['assigner']) && isset($_POST['order']) && !empty($_POST['driver_assign_id']) && !empty($_POST['assigner']) && !empty($_POST['order']) ){
        $driver_id = addslashes($_POST['driver_assign_id']);
        $assigner = addslashes($_POST['assigner']);
        $order = addslashes($_POST['order']);
        
        //check if the driver is still available
        if($operation->countAll("SELECT * FROM `driver_availability` WHERE user_id = '$driver_id' AND availability_status = 1") > 0){
            $table = 'order_assign';
            $data = [
                'order_id'=>"$order",
                'user_id'=>"$driver_id",
                'assigner'=>"$assigner",
                'email_status'=>1,
                'sms_status'=>1
            ];
            if($operation->insertData($table,$data) == 1){
				
					//hecking the required params 

					//creating a new push
					$push = null; 
			
				//get driver 
				$getDriver = $operation->retrieveSingle("SELECT *FROM users WHERE user_id = '$driver_id'");
				$title = "New Order Delivery Assigned";
				$msg = "Open to view tasks";
				$email = $getDriver['email'];
				
				
					//if the push don't have an image give null in place of image
					$push = new Push(
							$title,
							$msg,
							null
						);


					//getting the push from push object
					$mPushNotification = $push->getPush(); 

					//getting the token from database object 
					$devicetoken = $db->getTokenByEmail($email);

					//creating firebase class object 
					$firebase = new Firebase(); 

					//sending push notification and displaying result 
					 $firebase->send($devicetoken, $mPushNotification);
			
                echo json_encode(array("code"=>1,"msg"=>"Driver assigned, refreshing please wait!"));
            }else{
                echo json_encode(array("code"=>2,"msg"=>"An error occured try again later"));
            }
            
        }else{
            echo json_encode(array("code"=>2,"msg"=>"The selected driver is now offline, please choose a different driver and try again"));
        }
    }
	
	
	
	
	
	
	

//}else{
//	$response['error']=true;
//	$response['message']='Invalid request';
//}
//
//echo json_encode($response);

?>