<?php
include("../../connection/Functions.php");
$operation = new Functions();
if(isset($_POST['rest_id']) && isset($_POST['place_id']) && isset($_POST['pac_input']) && isset($_POST['longtude']) && isset($_POST['latitude']) && !empty($_POST['rest_id']) && !empty($_POST['place_id']) && !empty($_POST['pac_input']) && !empty($_POST['longtude']) && !empty($_POST['latitude']) ){
    $rest_id = addslashes($_POST['rest_id']);
    $place_id = addslashes($_POST['place_id']);
    $address = addslashes($_POST['pac_input']);
    $longtude = addslashes($_POST['longtude']);
    $latitude = addslashes($_POST['latitude']);
    
    $table = "restaurant_info";
    $data = [
        'placeID'=>"$place_id",
        'exact_location'=>"$address",
        'longtude'=>"$longtude",
        'latitude'=>"$latitude"
    ];
    $where = "restaurant_id = '$rest_id'";
    if($operation->updateData($table,$data,$where) == 1){
        echo json_encode(array("code"=>1,"msg"=>"Restaurant location saved, redirecting please wait!"));
    }else{
        echo json_encode(array("code"=>2,"msg"=>"✖ An error occured, please try again later!"));
    }
    
   //edit restaurant info 
}if(isset($_POST['rest_id']) && isset($_POST['rest_name']) && isset($_POST['rest_phone']) && isset($_POST['city_id']) && isset($_POST['postal_location']) && !empty($_POST['rest_id']) && !empty($_POST['rest_name']) && !empty($_POST['city_id']) && !empty($_POST['postal_location']) ){
    
   $rest_id = addslashes($_POST['rest_id']);
   $phone = addslashes($_POST['rest_phone']);
   $rest_name = addslashes($_POST['rest_name']);
   $city_id = addslashes($_POST['city_id']);
   $postal_location = addslashes($_POST['postal_location']);
    
    $table = "restaurant_info";
    $data = [
        'city_id'=>"$city_id",
        'restaurant_name'=>"$rest_name",
        'restaurant_phone'=>"$phone",
        'restaurant_address'=>"$postal_location"
    ];
    $where = "restaurant_id = '$rest_id'";
    if($operation->updateData($table,$data,$where) == 1){
        echo json_encode(array("code"=>1,"msg"=>"Restaurant info saved, redirecting please wait!"));
    }else{
        echo json_encode(array("code"=>2,"msg"=>"✖ An error occured, please try again later!"));
    }
    
    //add coordinates
    
}if(isset($_POST['rest_id']) && isset($_POST['place_id']) && isset($_POST['location']) && isset($_POST['longtude']) && isset($_POST['latitude']) && !empty($_POST['rest_id']) && !empty($_POST['place_id']) && !empty($_POST['location']) && !empty($_POST['longtude']) && !empty($_POST['latitude']) ){
    $rest_id = addslashes($_POST['rest_id']);
    $place_id = addslashes($_POST['place_id']);
    $address = addslashes($_POST['location']);
    $longtude = addslashes($_POST['longtude']);
    $latitude = addslashes($_POST['latitude']);
    
    $table = "restaurant_info";
    $data = [
        'placeID'=>"$place_id",
        'exact_location'=>"$address",
        'longtude'=>"$longtude",
        'latitude'=>"$latitude"
    ];
    $where = "restaurant_id = '$rest_id'";
    if($operation->updateData($table,$data,$where) == 1){
        echo json_encode(array("code"=>1,"msg"=>"Restaurant location saved, redirecting please wait!"));
    }else{
        echo json_encode(array("code"=>2,"msg"=>"✖ An error occured, please try again later!"));
    }
    
}


?>