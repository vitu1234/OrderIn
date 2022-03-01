<?php
include("../../connection/Functions.php");
$operation = new Functions();

if(isset($_POST['uidCheck']) && !empty($_POST['uidCheck'])){
    $id = addslashes($_POST['uidCheck']);//restaurant manager
    //get restaurant_info
    $getRest = $operation->retrieveSingle("SELECT * FROM `restaurant_managers` WHERE user_id = '$id'");
    $rest_id = $getRest['restaurant_id'];
    $getRestInfo = $operation->retrieveSingle("SELECT * FROM `restaurant_info` WHERE restaurant_id = '$rest_id'");
    
    if($getRestInfo['longtude'] == '' || $getRestInfo['latitude'] == ''){
         echo json_encode(array("code"=>1,"msg"=>"<p class='text-danger'><i class='fas fa-exclamation-triangle'></i> Please add an exact location for your restaurant, customers view restaurants with a location only </p><br/> <a onclick='dismissModal()' class='float-right' href='restaurant_info#add_info'><i class='fas fa-plus'></i> Add Here</a>"));
    }else{
        echo json_encode(array("code"=>2));
    }
}

?>