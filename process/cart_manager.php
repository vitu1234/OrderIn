<?php
include("../connection/Functions.php");
$operation = new Functions();
session_start();
//add meal to cart
//echo "<pre>";
//print_r($_POST);
//echo "</pre>";

if(isset($_POST['product_id']) && isset($_POST['total']) && isset($_POST['qty_input'])){
	$prod_id = addslashes($_POST['product_id']);
	$qty = addslashes($_POST['qty_input']);
	$total = addslashes($_POST['total']);
	
	$getProduct = $operation->retrieveSingle("SELECT product_id, product_name,product_price,availability,delivery_fee,prep_mins, products.img_url as prod_img_url, restaurant_info.img_url as rest_img_url, restaurant_name, restaurant_phone, restaurant_address,exact_location FROM products INNER JOIN restaurant_info ON products.restaurant_id = restaurant_info.restaurant_id WHERE product_id = '$prod_id'");
	$product_name= $getProduct['product_name'];
	$image= $getProduct['prod_img_url'];
	$price= $getProduct['product_price'];
	$delivery_fee= $getProduct['delivery_fee'];
	$prep_mins= $getProduct['prep_mins'];
	
	$newitem = array();
	
	//check type of customer selections made
	if(isset($_POST['sizes']) && isset($_POST['options'])){
		$size = $_POST['sizes'];
		for($i=0;$i<count($size);$i++){
			$newitem['size'] = $size[$i]; 
				//if not empty
			if(!empty($_SESSION['cart'])){    
				//and if session cart same 
				if(isset($_SESSION['cart'][$prod_id]) == $prod_id) {
					$_SESSION['cart'][$prod_id]['size'] = $size[$i];
				}
			}
		}
		$op = '';
		$options = $_POST['options'];
		for($i=0;$i<count($options);$i++){
			$op.= $options[$i].','; 
		}
		$newitem['options']=$op;
		
				    //if not empty
		if(!empty($_SESSION['cart'])){    
			//and if session cart same 
			if(isset($_SESSION['cart'][$prod_id]) == $prod_id) {
				$_SESSION['cart'][$prod_id]['options'] = $op;
			}
		} 
			
	}elseif(isset($_POST['sizes'])){
		$size = $_POST['sizes'];
		for($i=0;$i<count($size);$i++){
			$newitem['size'] = $size[$i];
			//if not empty
			if(!empty($_SESSION['cart'])){    
				//and if session cart same 
				if(isset($_SESSION['cart'][$prod_id]) == $prod_id) {
					$_SESSION['cart'][$prod_id]['size'] = $size[$i];
				}
			} 
			
		}
		
	}elseif(isset($_POST['options'])){
		$op = '';
		$options = $_POST['options'];
		for($i=0;$i<count($options);$i++){
			$op.= $options[$i].','; 
		}
		$newitem['options']=$op;
		
			    //if not empty
		if(!empty($_SESSION['cart'])){    
			//and if session cart same 
			if(isset($_SESSION['cart'][$prod_id]) == $prod_id) {
				$_SESSION['cart'][$prod_id]['options'] = $op;
			}
		} 
		
	}
	
	$newitem['product_id'] = $prod_id; 
	$newitem['product_name'] = $product_name; 
	$newitem['product_image'] = $image; 
	$newitem['product_price'] = $price; 
	$newitem['delivery_fee'] = $delivery_fee; 
	$newitem['prep_mins'] = $prep_mins; 
	$newitem['total'] = $total; 
	$newitem['qty'] = $qty;	 

	    //if not empty
    if(!empty($_SESSION['cart'])){    
        //and if session cart same 
        if(isset($_SESSION['cart'][$prod_id]) == $prod_id) {
            $_SESSION['cart'][$prod_id]['qty'] = $qty;
            $_SESSION['cart'][$prod_id]['product_price'] = $price;
            $_SESSION['cart'][$prod_id]['delivery_fee'] = $delivery_fee;
            $_SESSION['cart'][$prod_id]['total'] = $total;
        } else { 
            //if not same put new storing
            $_SESSION['cart'][$prod_id] = $newitem;
        }
    } else  {
        $_SESSION['cart'] = array();
        $_SESSION['cart'][$prod_id] = $newitem;
    }
	
	echo json_encode(array("code"=>1,"count_cart"=>count($_SESSION['cart'])));
	
}elseif(isset($_POST['del_id']) && !empty($_POST['del_id'])){
	$prod_id = addslashes($_POST['del_id']);
		    //if not empty
    if(!empty($_SESSION['cart'])){    
        //and if session cart same 
        if(isset($_SESSION['cart'][$prod_id]) == $prod_id) {
			unset($_SESSION['cart'][$prod_id]); //remove the item from the cart
			$final_total = 0;
			//calculate new total
			foreach($_SESSION['cart'] as $row){
				$total = $row['total']; 
				$final_total +=$total;
			}
			echo json_encode(array("code"=>1,"new_total"=>$final_total,"count_cart"=>count($_SESSION['cart'])));
        } else { 
            //if not same put new storing
            echo json_encode(array("code"=>2,"msg"=>"Oops, product already removed, refresh page!"));
        }
    }else{
		echo json_encode(array("code"=>2,"msg"=>"Oops, cart might be empty, refresh page!"));
	}
//	calculate subtotal
}elseif(isset($_POST['id']) && isset($_POST['qty']) && isset($_POST['new_tot']) && !empty($_POST['id']) && !empty($_POST['qty']) && !empty($_POST['new_tot'])){
	$prod_id = addslashes($_POST['id']);
	$qty = addslashes($_POST['qty']);
	$new_tot = addslashes($_POST['new_tot']);
	
	
			    //if not empty
    if(!empty($_SESSION['cart'])){    
        //and if session cart same 
        if(isset($_SESSION['cart'][$prod_id]) == $prod_id) {
			$_SESSION['cart'][$prod_id]['qty'] = $qty;
			$_SESSION['cart'][$prod_id]['total'] = $new_tot;
		
			echo json_encode(array("code"=>1));
        } else { 
            //if not same put new storing
            echo json_encode(array("code"=>2,"msg"=>"Oops, refresh page!"));
        }
    }else{
		echo json_encode(array("code"=>2,"msg"=>"Oops, cart might be empty, refresh page!"));
	}
}


?>