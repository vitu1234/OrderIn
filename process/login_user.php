<?php
include("../../connection/Functions.php");
$operation = new Functions();
session_start();
//login admin
if(isset($_POST['email']) && isset($_POST['password']) && !empty($_POST['email']) && !empty($_POST['password'])){
    $email = addslashes($_POST['email']);
    $password = addslashes($_POST['password']);
    
         $query = "SELECT * FROM `admins` WHERE email = '$email' ";
            $count = $operation->countAll($query);

            if($count == 1){

                //check password and email then redirect
                $user = $operation->retrieveSingle($query);
                $hashed_password = $user['password'];

                if(password_verify($password, $hashed_password)){
                    //check if user account is active
                    if($operation->countAll($query." AND account_status = 1") > 0){
                        $_SESSION['admin'] = $user['user_id'];
                        echo json_encode(array("code" => 1,"msg"=>"Success, redirecting!"));
                        
                    }else{
                        echo json_encode(array("code" => 2,"msg"=>"Your account has been terminated, contact manager!"));
                    }
                     

                }else{
                    echo json_encode(array("code" => 2,"msg"=>"Wrong password or email, try again!"));
                }

            }else{
                echo json_encode(array("code" => 2,"msg"=>"Email does not match any records!"));
            }
}

?>