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
		$sql = "SELECT * FROM `restaurant_info` WHERE restaurant_info.city_id = '$city_id' AND restaurant_id < ".$product." ORDER BY restaurant_id DESC LIMIT 16";

	}else{
		$sql = "SELECT * FROM `restaurant_info` WHERE restaurant_id < ".$product." ORDER BY restaurant_id DESC LIMIT 16";
		
	}
        
    $productsLoad = $operation->retrieveMany($sql);
    $productsCount = $operation->countAll($sql);
    
    if($productsCount > 0){
        foreach($productsLoad as $row){
            $product_id_load = $row['restaurant_id'];
			$ids = $row['restaurant_id'];
			$cit = $row['city_id'];
			$city = $operation->retrieveSingle("SELECT *FROM cities WHERE city_id='$cit'");
			$image  ='';
			if($row['img_url'] != ''){
				$image =$row['img_url'];
			}else{
				$image = 'orderlogo1.png';
			}

            ?>
            					<div class="col-lg-6 col-md-12 col-12">
							<div class="partner-section">
								<div class="partner-bar">
									<div class="partner-topbar">
										<div class="partner-dt">
											<a onclick="setRestaurant('<?=$ids?>')" href="javascript:void(0);"><img src="images/<?=$image?>" alt=""></a>
											<div class="partner-name">
												<a onclick="setRestaurant('<?=$ids?>')" href="javascript:void(0);"><h4><?=$row['restaurant_name']?></h4></a>
												<div class="country"><?=$city['city_name']?></div>
												<p><span><i class="fas fa-map-marker-alt"></i></span><?=$row['restaurant_address']?> - <?=$row['exact_location']?></p>

											</div>

										</div>
									</div>
								
									<div class="partner-bottombar">
										<ul class="bottom-partner-links">

											<li><a onclick="setRestaurant('<?=$ids?>')" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="View Menu"><i class="fas fa-book"></i> View Menu</a></li>
										</ul>
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



