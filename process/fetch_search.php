<?php
include("../connection/Functions.php");
$operation = new Functions();
session_start();

//check if query is posted and city is selected or not
sleep(1);
$output = '';
if(isset($_POST["query"]) && !empty($_POST["query"])){
	$search = addslashes($_POST["query"]);
    
    $query = '';
    $city_name = '';
    
    if(isset($_SESSION['selected_city']) && !empty($_SESSION['selected_city'])){
        $city_id = $_SESSION['selected_city'];
          $query = "
                SELECT product_id,product_name,product_price, prep_mins, delivery_fee,meal_type, products.img_url as prod_img_url, products.restaurant_id as restaurant_id, city_id, restaurant_name, restaurant_phone,restaurant_info.city_id, restaurant_info.img_url as rest_img FROM products
            INNER JOIN restaurant_info ON products.restaurant_id = restaurant_info.restaurant_id
            WHERE restaurant_info.city_id = '$city_id' AND product_name LIKE '%".$search."%'
            OR restaurant_name LIKE '%".$search."%' AND availability = 1
            LIMIT 10
        ";
        
        //get city name the user selected
        $getCity = $operation->retrieveSingle("SELECT * FROM `cities` WHERE city_id = '$city_id'");
            $city_name = '<h5 class="text-center">'.$getCity['city_name'].'</h5>';
    }else{
        $query = "
            SELECT product_id,product_name,product_price, prep_mins, delivery_fee,meal_type, products.img_url as prod_img_url, products.restaurant_id as restaurant_id, city_id, restaurant_name, restaurant_phone, restaurant_info.img_url as rest_img FROM products
            INNER JOIN restaurant_info ON products.restaurant_id = restaurant_info.restaurant_id
            WHERE product_name LIKE '%".$search."%'
            OR restaurant_name LIKE '%".$search."%' AND availability = 1
            LIMIT 10
        ";
    }
//    <a href="#meal_details" onclick="setValues('9')"><div class="bg-gradient"></div></a>
    $countProducts = $operation->countAll($query);
    if($countProducts > 0 ){
        $result = $operation->retrieveMany($query);
        $output .= '	
        <section class="mt-5">
			<h3 class="text-center">Search Results</h3>
			'.$city_name.'
    		<div class="container-fluid">
				<div class="row">
					<div class="col-md-3"></div>
					<div class="col-md-6 ">';
                    foreach($result as $row){
                        
                        	//get meal type
                            $meal_type = '';
								if($row['meal_type'] == 1){
								  $meal_type =  " - Veg. Meal";
								}elseif($row['meal_type'] == 2){
								  $meal_type =  " - Non-Veg. Meal";
								}else{
//									echo "<small>Vegeterian Meal</small>";
								}
                        
                        
                        $output.= '
                        <a href="meals#meal_details" onclick="setValues(\''.$row['product_id'].'\')">
                            <div class="media">
                              <img class="d-flex align-self-start" src="images/'.$row['prod_img_url'].'" alt="Meal Image">
                              <div class="media-body pl-3">
                                <div class="price py-2">MWK '.number_format($row['product_price'],2).'<small>'.$row['product_name'].'  '.$meal_type.'</small></div>
                                <div class="stats py-2">
                                    <span><i class="fas fa-shopping-cart"></i>Delivery Fee: MWK '.number_format($row['delivery_fee'],2).'</span>
                                    <span><i class="far fa-clock"></i>Preparing Time: '.$row['prep_mins'].' Min(s)</span>
                                </div>
                                <div class="address py-2">'.$row['restaurant_name'].'</div>
                              </div>
                             
                            </div>
                             </a>
                        ';
                    }
        $output.='
       	            </div>
					<div class="col-md-3"></div>
				</div>
			</div>
		</section>    
            ';
    }else{
        echo '<br><br><br><br><p class="alert alert-warning text-center">We couldn\'t find that, <a href="meals">check this</a> instead</p><br><br><br>';
    }
}

echo $output;
?>