<?php
    include("../../connection/Functions.php");
    $operation = new Functions();

//print_r($_POST);die();

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
                
                //get driver token by email
                $getDriver = $operation->retrieveSingle("SELECT *FROM users WHERE user_id = '$driver_id' AND user_role = 'driver'");
                $driverEmail = $getDriver['email'];
                $getToken = $operation-retrieveSingle("SELECT *FROM devices WHERE email = '$driverEmail'");
                	
                $to = $getToken['token'];
            	$notif = array(
            		'title'=>'OrderInMW',
            		'body'=>"You're assigned for delivery",
            		"sound" => "default"
            		);
            		//send notification
            	$operation->sendNotif($to,$notif);
                
                
                
                echo json_encode(array("code"=>1,"msg"=>"Driver assigned, refreshing please wait!"));
            }else{
                echo json_encode(array("code"=>2,"msg"=>"An error occured try again later"));
            }
            
        }else{
            echo json_encode(array("code"=>2,"msg"=>"The selected driver is now offline, please choose a different driver and try again"));
        }
    }
?>