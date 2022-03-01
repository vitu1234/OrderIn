<?php
    session_start();
//set session for user selected city
    if(isset($_POST['customer_city']) && !empty($_POST['customer_city'])){
        $city_id = addslashes($_POST['customer_city']);
        if($city_id == 'all'){
            unset($_SESSION['selected_city']);
        }else{
            $_SESSION['selected_city'] = $city_id;
        }
        
        echo json_encode(array("code"=>1));
    }
?>