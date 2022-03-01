<?php
	$id =2;
session_start();
//    $newitem = array(
//    'idproduk' => $id, 
//    'nm_produk' => 'hoodie', 
//    'img_produk' => 'images/produk/hodie.jpg', 
//    'harga_produk' => '20', 
//    'qty' => '2' 
//    );
//    //if not empty
//    if(!empty($_SESSION['cart']))
//    {    
//        //and if session cart same 
//        if(isset($_SESSION['cart'][$id]) == $id) {
//            $_SESSION['cart'][$id]['qty']++;
//        } else { 
//            //if not same put new storing
//            $_SESSION['cart'][$id] = $newitem;
//        }
//    } else  {
//        $_SESSION['cart'] = array();
//        $_SESSION['cart'][$id] = $newitem;
//    }
//echo "<pre>";
//print_r($_SESSION['cart']);
//echo "</pre><br/>".count($_SESSION['cart']);
//foreach($_SESSION['cart'] as $pro){
//	echo $pro['nm_produk'];
//}

// Variable Declaration for String
$str = "1,2,4,5,6,";

// Create Array Out of the String, The comma ',' is the delimiter
// This would output 
//       [ 1 => 1, 2 => 2, 3 => '', 4 => 4, 5 => 5, 6 => 6 ]
$explodedStr = explode(',', $str);

// Filter Array And Remove The empty element which in this case
//    3 => ''
$filteredArray = array_filter( $explodedStr );
for($i=0;$i<(count($filteredArray));$i++){
	echo $filteredArray[$i]."<br/>";
}
$actual_link = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://$_SERVER[HTTP_HOST]/ss";
echo $actual_link;
//echo urlencode("vitumafeni@yahoo.com");
// Convert Array into String with comma delimiter 