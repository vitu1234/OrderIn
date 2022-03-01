<?php
include("../../connection/Functions.php");
$operation = new Functions();
//add meal
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";die();


if(isset($_FILES['meal_picture']) && isset($_POST['meal_name']) && isset($_POST['delivery_fee']) && isset($_POST['prep_mins']) && isset($_POST['meal_type']) && isset($_POST['meal_add_on']) && !empty($_POST['meal_name'])  && isset($_POST['rest_id']) && !empty($_POST['rest_id'])){
    $meal_name = addslashes($_POST['meal_name']);
//    $meal_price = addslashes($_POST['meal_price']);
    $delivery_fee = addslashes($_POST['delivery_fee']);
    $prep_mins = addslashes($_POST['prep_mins']);
    $rest_id = addslashes($_POST['rest_id']);
    
    $meal_type = addslashes($_POST['meal_type']);
    $addons = addslashes($_POST['meal_add_on']);
    $size = addslashes($_POST['meal_size']);
    
    $images = $_FILES['meal_picture']['name'];
    $image=strtolower(pathinfo($images,PATHINFO_EXTENSION));
    $filename=rand(1000, 1000000).".".$image;
    /* Location */
    $location = "../../images/".$filename;
    $uploadOk = 1;
    $imageFileType = pathinfo($location,PATHINFO_EXTENSION);
    /* Valid Extensions */
    $valid_extensions = array("jpg","jpeg","png");
    /* Check file extension */
    if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
       $uploadOk = 0;
    }
    
    
    if($_FILES['meal_picture']['size'] > 3000000 ){
        echo json_encode(array("code"=>2,"msg"=>"✖ File must be less than 3mb!"));
        die();
    }
    
    
    if($uploadOk == 0){
         echo json_encode(array("code"=>2,"msg"=>"✖ File type not supported, try jpg, jpeg or png!"));
    }else{
       /* Upload file */
       if(move_uploaded_file($_FILES['meal_picture']['tmp_name'],$location)){
                if(empty($_POST['meal_price'])){
                    $meal_price =0;
                }else{
                    $meal_price = addslashes($_POST['meal_price']);
                }
               $table = "products";
               $data = [
                   'restaurant_id'=>"$rest_id",
                   'product_name'=>"$meal_name",
                   'product_price'=>"$meal_price",
                   'meal_type'=>"$meal_type",
                   'availability'=>"1",
                   'delivery_fee'=>"$delivery_fee",
                   'prep_mins'=>"$prep_mins",
                   'img_url' => "$filename"  
               ];               
               if($operation->insertData($table,$data) == 1){
//                   echo $filename;
                   //check if product multiple is checked, 1=normal/no addons and 2 = checked with addons
                   if($addons == 2){
                       $addOnName = $_POST['addonName'];
                       $addonPrice = $_POST['addonPrice'];
                       //get the product id of the just added meal
                       $getProduct = $operation->retrieveSingle("SELECT *FROM products WHERE restaurant_id = '$rest_id' ORDER BY product_id DESC");
                       $product_id = $getProduct['product_id'];
                       $table = 'product_extras';
                       
                       for($i=0;$i<count($addOnName);$i++){
                           $name = $addOnName[$i];
                           $price = $addonPrice[$i];
                           
                           $data = [
                               'product_id'=>"$product_id",
                               'extra_name'=>"$name",
                               'extra_price'=>"$price"
                           ];
                           $operation->insertData($table,$data);
                       }
                       
                       
                   }
                   
                   //check if product multiple size is checked, 1=normal size and 2 = checked with sizes
                   if($size == 2){
                       $sizeName = $_POST['sizeName'];
                       $sizePrice = $_POST['sizePrice'];
                       //get the product id of the just added meal
                       $getProduct = $operation->retrieveSingle("SELECT *FROM products WHERE restaurant_id = '$rest_id' ORDER BY product_id DESC");
                       $product_id = $getProduct['product_id'];
                       $table = 'product_sizes';
                       
                       for($i=0;$i<count($sizeName);$i++){
                           $name = $sizeName[$i];
                           $price = $sizePrice[$i];
                           
                           $data = [
                               'product_id'=>"$product_id",
                               'size_name'=>"$name",
                               'size_price'=>"$price"
                           ];
                           $operation->insertData($table,$data);
                       }
                       
                       
                   }
                   echo json_encode(array("code"=>1,"msg"=>"Success, redirecting, please wait!"));
               }else{
//                   echo 0;
                   echo json_encode(array("code"=>2,"msg"=>"✖ An error occured while saving, please try again later!"));
               }
               
           
          
       }else{
          echo json_encode(array("code"=>2,"msg"=>"✖ An error occured while saving the picture!"));
       }
    }
    //edit meal
}elseif(isset($_POST['emeal_name']) && isset($_POST['emeal_price']) && isset($_POST['edelivery_fee']) && isset($_POST['eprep_mins']) && isset($_POST['meal_id']) && isset($_POST['eavailability']) && !empty($_POST['emeal_name']) && !empty($_POST['emeal_price']) && !empty($_POST['eprep_mins']) && !empty($_POST['meal_id']) && !empty($_POST['eavailability'])){
    $meal_name = addslashes($_POST['emeal_name']);
    $meal_price = addslashes($_POST['emeal_price']);
    $delivery_fee = addslashes($_POST['edelivery_fee']);
    $prep_mins = addslashes($_POST['eprep_mins']);
    $meal_id = addslashes($_POST['meal_id']);
    $availability = addslashes($_POST['eavailability']);
    $addons = addslashes($_POST['meal_add_on']);
    
    $meal_size = addslashes($_POST['meal_size']);
    
    $meal_type = addslashes($_POST['meal_type']);
    
    //modifying addons
    if($addons == 2){
        if(isset($_POST['eaddonName']) && !empty($_POST['eaddonName'])){
            $addOnName = $_POST['eaddonName'];
           $addonPrice = $_POST['eaddonPrice'];
           //check if addons already exist
           $countAddons = $operation->countAll("SELECT * FROM `product_extras` WHERE product_id = '$meal_id'");

            $table = 'product_extras';
            $where = "product_id = '$meal_id'";
            if($countAddons == 0){
                for($i=0;$i<count($addOnName);$i++){
                   $name = $addOnName[$i];
                   $price = $addonPrice[$i];

                   $data = [
                       'product_id'=>"$meal_id",
                       'extra_name'=>"$name",
                       'extra_price'=>"$price"
                   ];
                   $operation->insertData($table,$data);
                }
            }else{
                $table = 'product_extras';
                if($countAddons > 0){
                    //remove previous addons
                    $operation->deleteData($table,$where);
                }

                for($i=0;$i<count($addOnName);$i++){
                   $name = $addOnName[$i];
                   $price = $addonPrice[$i];

                   $data = [
                       'product_id'=>"$meal_id",
                       'extra_name'=>"$name",
                       'extra_price'=>"$price"
                   ];
                   $operation->insertData($table,$data);
                }
            }
        }else{
              $countAddons = $operation->countAll("SELECT * FROM `product_extras` WHERE product_id = '$meal_id'");

            $table = 'product_extras';
            $where = "product_id = '$meal_id'";
            if($countAddons > 0){
                //remove previous addons
                $operation->deleteData($table,$where);
            }
        }

    }else{
            $countAddons = $operation->countAll("SELECT * FROM `product_extras` WHERE product_id = '$meal_id'");

            $table = 'product_extras';
            $where = "product_id = '$meal_id'";
            if($countAddons > 0){
                //remove previous addons
                $operation->deleteData($table,$where);
            }
    }
                   
    //modifying meal sizes
        if($meal_size == 2){
        if(isset($_POST['esizeName']) && !empty($_POST['esizeName'])){
            $addOnName = $_POST['esizeName'];
           $addonPrice = $_POST['esizePrice'];
           //check if addons already exist
           $countAddons = $operation->countAll("SELECT * FROM `product_sizes` WHERE product_id = '$meal_id'");

            $table = 'product_sizes';
            $where = "product_id = '$meal_id'";
            if($countAddons == 0){
                for($i=0;$i<count($addOnName);$i++){
                   $name = $addOnName[$i];
                   $price = $addonPrice[$i];

                   $data = [
                       'product_id'=>"$meal_id",
                       'size_name'=>"$name",
                       'size_price'=>"$price"
                   ];
                   $operation->insertData($table,$data);
                }
            }else{
                $table = 'product_sizes';
                if($countAddons > 0){
                    //remove previous addons
                    $operation->deleteData($table,$where);
                }

                for($i=0;$i<count($addOnName);$i++){
                   $name = $addOnName[$i];
                   $price = $addonPrice[$i];

                   $data = [
                       'product_id'=>"$meal_id",
                       'size_name'=>"$name",
                       'size_price'=>"$price"
                   ];
                   $operation->insertData($table,$data);
                }
            }
        }else{
              $countAddons = $operation->countAll("SELECT * FROM `product_sizes` WHERE product_id = '$meal_id'");

            $table = 'product_sizes';
            $where = "product_id = '$meal_id'";
            if($countAddons > 0){
                //remove previous addons
                $operation->deleteData($table,$where);
            }
        }

    }else{
            $countAddons = $operation->countAll("SELECT * FROM `product_sizes` WHERE product_id = '$meal_id'");

            $table = 'product_sizes';
            $where = "product_id = '$meal_id'";
            if($countAddons > 0){
                //remove previous addons
                $operation->deleteData($table,$where);
            }
    }
    
    
    
    $table = "products";
    $where = "product_id = '$meal_id'";
//check if picture was attached
    
    if(file_exists($_FILES['emeal_picture']['tmp_name']) || is_uploaded_file($_FILES['emeal_picture']['tmp_name'])){
        $images = $_FILES['emeal_picture']['name'];
        
        $size =  $_FILES['emeal_picture']['size'];
        if($size > 3000000){
             echo json_encode(array("code"=>2,"msg"=>"✖ File should be less than or equal to 3mb"));
            die();
        }else{
        $image=strtolower(pathinfo($images,PATHINFO_EXTENSION));
        $filename=rand(1000, 1000000).".".$image;
        /* Location */
        $location = "../../images/".$filename;
        $uploadOk = 1;
        $imageFileType = pathinfo($location,PATHINFO_EXTENSION);

        /* Valid Extensions */
        $valid_extensions = array("jpg","jpeg","png");
        /* Check file extension */
        if( !in_array(strtolower($imageFileType),$valid_extensions) ) {
           $uploadOk = 0;
        }
    

        if($uploadOk == 0){
             echo json_encode(array("code"=>2,"msg"=>"✖ File type not supported, try jpg, jpeg or png!"));
        }else{
            //get the image sAVED earlier
            $checkImg = $operation->retrieveSingle("SELECT *FROM products WHERE product_id = '$meal_id'");
              $directory = "../../images/".$checkImg['img_url'];
            //delete previous picture
               if(unlink($directory)){
                            /* Upload file */
                    if(move_uploaded_file($_FILES['emeal_picture']['tmp_name'],$location)){               
                       $data = [
                           'product_name'=>"$meal_name",
                           'product_price'=>"$meal_price",
                           'meal_type'=>"$meal_type",
                           'availability'=>"$availability",
                           'delivery_fee'=>"$delivery_fee",
                           'prep_mins'=>"$prep_mins",
                           'img_url' => "$filename"  
                       ];  

                       if($operation->updateData($table,$data,$where) == 1){
        //                   echo $filename;
                           echo json_encode(array("code"=>1,"msg"=>"Success, redirecting, please wait!"));
                       }else{
        //                   echo 0;
                           echo json_encode(array("code"=>2,"msg"=>"✖ An error occured while saving, please try again later!"));
                       }
               

                    }else{
                         echo json_encode(array("code"=>2,"msg"=>"✖ An error occured while saving, please try again later!"));
                    }
               }else{
                   echo json_encode(array("code"=>2,"msg"=>"✖ An error occured while saving, please try again later!"));
               }
            }
        }
        

    }else{
        $data = [
           'product_name'=>"$meal_name",
           'product_price'=>"$meal_price",
            'meal_type'=>"$meal_type",
           'availability'=>"$availability",
           'delivery_fee'=>"$delivery_fee",
           'prep_mins'=>"$prep_mins",
       ]; 

       if($operation->updateData($table,$data,$where) == 1){
//                   echo $filename;
           echo json_encode(array("code"=>1,"msg"=>"Success, redirecting, please wait!"));
       }else{
//                   echo 0;
           echo json_encode(array("code"=>2,"msg"=>"✖ An error occured while saving, please try again later!"));
       }
    }
    //delete meal
}elseif(isset($_POST['del_meal']) && !empty($_POST['del_meal'])){
    $id = addslashes($_POST['del_meal']);
    $where = "product_id = '$id'";
    $table = "products";
    if($operation->deleteData($table,$where) == 1){
        echo json_encode(array("code"=>1,"msg"=>"Success, redirecting, please wait..."));
    }else{
        echo json_encode(array("code"=>2,"msg"=>"An error occured, please try again later"));
    }
}


?>