<?php
include("../connection/Functions.php");
$operation = new Functions();
    $output = '';  
    $product_id_load = ''; 
    if(isset($_POST['last_product_id'])){
        $product = addslashes($_POST['last_product_id']);
     $sql = '';   
    if(isset($_SESSION['selected_city'])){
		$city_id = $_SESSION['selected_city'];
		$sql = "SELECT product_id,product_name,product_price, prep_mins, delivery_fee,products.img_url as prod_img_url, products.restaurant_id as restaurant_id, city_id, restaurant_name, restaurant_phone, restaurant_info.img_url as rest_img FROM products 
		INNER JOIN restaurant_info ON restaurant_info.restaurant_id = products.restaurant_id WHERE restaurant_info.city_id = '$city_id' AND product_id < ".$product." AND products.availability = 1 ORDER BY product_id DESC LIMIT 16";

	}else{
		$sql = "SELECT product_id,product_name,product_price, prep_mins, delivery_fee,products.img_url as prod_img_url, products.restaurant_id as restaurant_id, city_id, restaurant_name, restaurant_phone, restaurant_info.img_url as rest_img FROM products 
		INNER JOIN restaurant_info ON restaurant_info.restaurant_id = products.restaurant_id WHERE product_id < ".$product." AND products.availability = 1 ORDER BY product_id DESC LIMIT 16";
		
	}
        
    $productsLoad = $operation->retrieveMany($sql);
    $productsCount = $operation->countAll($sql);
    
    if($productsCount > 0){
        foreach($productsLoad as $row){
            $product_id_load = $row['product_id'];
            $image  ='';
                if($row['rest_img'] != ''){
                    $image =$row['rest_img'];
                }else{
                    $image = 'orderlogo1.png';
                }

            ?>
            <div class="col-lg-3 col-md-6 col-sm-12 col-xs-12">
                <div class="all-meal">
                    <div class="top">
                        <a href="#meal_details" onclick="setValues('<?=$row['product_id']?>')"><div class="bg-gradient"></div></a>
                        <div class="top-img">
                            <img class="rounded" src="images/<?=$row['prod_img_url']?>" alt="">
                        </div>
                        
                        <div class="top-text">
                            <div class="heading text-light"><h4><a href="#meal_details" onclick="setValues('<?=$row['product_id']?>')"><?=$row['product_name']?></a></h4></div>
                            <div class="sub-heading">
                            <h5 class="text-warning  mb-3"><?=$row['restaurant_name']?></h5>
                            <p>MWK<?=number_format($row['product_price'],2)?></p>
                            </div>
                        </div>
                    </div>
                    <div class="bottom">
                        <div class="bottom-text">
                            <div class="delivery"><i class="fas fa-shopping-cart"></i>Delivery Fee : MWK <?=number_format($row['delivery_fee'],2)?></div>
                            <div class="time"><i class="far fa-clock"></i>Preparing Time : <?=$row['prep_mins']?> Min(s)</div>

                        </div>
                    </div>
                </div>					
            </div>
                    <?php
        }
        
        $output .= '
               <div class="col-lg-12 col-md-12 col-sm-12 text-center pt-5" id="remove_row">
				<button type="button" class="b-btn btn-link" style="background-color:#FF7C2F;"   name="btn_more" data-pid="'.$product_id_load.'" id="btn_more" >LOAD MORE</button>
			</div>
     ';  
     echo $output; 
    }
        
    }
  

    
?>



