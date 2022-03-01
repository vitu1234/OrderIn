<?php
include("../../connection/Functions.php");
$operation = new Functions();
session_start();
if(!isset($_POST['id']) || empty($_POST['id']) ){
  ?>
  <script>
      window.location = "orders";
  </script>
  <?php
  die();
}

$user_id = $_SESSION['restaurant'];
$order_id = addslashes($_POST['id']);


//get order extras
$extras = '';
$countExtras = $operation->countAll("SELECT * FROM `order_prod_extras` WHERE order_id = '$order_id'");
if($countExtras > 0){
       $extras.='
            <tr >
                <th class="text-center" style="font-weight: 600; align:center;" colspan="3">Meal Extras</th>
            </tr>
             <tr>
                <th style="font-weight: 600;">Extra Name</th>
                <th style="font-weight: 600;">Extra Price</th>
            
                ';
    $getExtras=$operation->retrieveMany("SELECT * FROM `order_prod_extras` WHERE order_id = '$order_id'");
    foreach($getExtras as $row){
        $ext_id = $row['prod_extras_id'];
        //get extra name and price
        $getExt = $operation->retrieveSingle("SELECT * FROM `product_extras` WHERE prod_extras_id = '$ext_id'");
        $extras.='
            <tr>
                <td>'.$getExt['extra_name'].'</td>    
                <td>'.$getExt['extra_price'].'</td>   
            </tr>
                ';
    }
}

//get meal size
$size = '';
$countSize = $operation->countAll("SELECT * FROM `order_prod_size` WHERE order_id = '$order_id'");
if($countSize > 0){
       $size.='
            <tr >
                <th class="text-center" style="font-weight: 600; align:center;" colspan="3">Meal</th>
            </tr>
             <tr>
                <th style="font-weight: 600;">Size Name</th>
                <th style="font-weight: 600;">Size Price</th>
            
                
                ';
    $getSize=$operation->retrieveMany("SELECT * FROM `order_prod_size` WHERE order_id = '$order_id'");
    foreach($getExtras as $row){
        $ext_id = $row['prod_size_id'];
        //get extra name and price
        $getExt = $operation->retrieveSingle("SELECT * FROM `product_sizes` WHERE prod_size_id = '$ext_id'");
        $extras.='
            <tr>
                <td>'.$getExt['size_name'].'</td>    
                <td>'.$getExt['size_price'].'</td>   
            </tr>
                ';
    }
}




//get restaurant city
$user = $operation->retrieveSingle("SELECT * FROM `users` WHERE user_id = '$user_id'");
$rest_city_id = $user['city_id'];

$query = "SELECT *FROM `orders` WHERE orders.order_id = '$order_id'";

//get the records
$getOrder = $operation->retrieveSingle($query);
$product_id = $getOrder['product_id'];
$customer_id = $getOrder['user_id'];

//get product details
$getProduct = $operation->retrieveSingle("SELECT * FROM `products` WHERE product_id='$product_id'");
//customer location
$getCustomerLocation = $operation->retrieveSingle("SELECT * FROM `customer_location` WHERE order_id='$order_id'");

//get customer details
$getCustomer = $operation->retrieveSingle("SELECT * FROM `users` WHERE user_id='$customer_id'");

//check if assigned to any driver
$order_action = '';
$getAssigned = $operation->countAll("SELECT * FROM `order_assign` WHERE order_id = '$order_id'");
$step2 = '';
$step3 = '';
$step4 = '';
if($getAssigned == 0){
 $order_action = '
               <ul >
                    <li>
                     <a href="#edit-bank-details" data-toggle="modal" class="btn btn-warning text-light">Assign Driver</a>
                    </li>
                    
                </ul>';
}else{
 
   $step2 = 'active';
   $step3 = 'active';
  if($getOrder['order_delivery_status'] == 1){
    $step4 = 'active';
  }
   
}

?>
<style>

        option{
		color: #000;
	       }
     label{
         color: #000;}
</style>

<div id="content">					
<div class="container">					
			<div class="row ">
              
				<div class="col-lg-6 col-md-8 col-12 mb-3">
<!--
				<div class="card">
                  <div class="card-body py-0">
					<div class="basic-info">
						<h4>Restaurant Information</h4>						
							<div class="driver-dt">								
								<a href="user_profile_view.html"><img src="images/recipe-details/comment-1.png" alt=""></a>
								<h4> Amazing Bakes</h4>
                              
							</div>
                      
						<div class="form-group">
                          <p class="">
                            Area 6, Behind National Bank
                            (265)882992942
                            Demo Owner, owner@example.com
                          </p>
                          						
                           <hr/>
						</div>
                   
					</div>
                  		
				</div>
                  </div>
                  
-->
                  
                  <div class="card mt-3">
                  <div class="card-body py-0">
					<div class="basic-info">
						<h4>Customer Information</h4>
                        <span><?=$getCustomer['fname']." ".$getCustomer['lname']?></span>
                          <p class="">
                            0<?=$getCustomer['phone']?>, <?=$getCustomer['email']?>, <?=$getCustomerLocation['exact_location']?> 
                            
                          </p>
                           <hr/>
                      <div class="form-group"></div>
					</div>
                  
                  
					<div class="basic-info">                      
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                  <tr>
                                      <th style="font-weight: 600;">Food Ordered</th>
                                      <td><?=$getProduct['product_name']?></td>
                                         <?=$size?>
                                      <?=$extras?>
                                      <td></td>
                                  </tr>
                              
<!--
                                  <tr>
                                      <th style="font-weight: 600;">Comment</th>
                                      <td>If Possible add some extra chips without salt</td>
                                      <td></td>
                                  </tr>
-->
                                  <tr>
                                      <th style="font-weight: 600;">Cost</th>
                                      <td>MWK <?=number_format($getProduct['product_price']+$getProduct['delivery_fee'],2)?></td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                      <th style="font-weight: 600;">Payment</th>
                                      <td>NetSoft Money</td>
                                      <td></td>
                                  </tr>
                                  <tr>
                                   
                                      <th style="font-weight: 600;">Status</th>
                                   <?php
                                     if($getOrder['payment_status'] == 0){
                                       echo '<td >Pending Delivery <i class="fas fa-times text-danger"></i></td>';
                                     }else{
                                        echo '<td>Paid <i class="fas fa-check-circle text-success"></i></td>';
                                     }
                                   ?>
                                      
                                      <td></td>
                                  </tr>
                            </table>
                        </div>
                      
                        
						
                      
					</div>					
						
						<div class="form-group">
							<div class="filter-radio">
                              <?=$order_action?>
								
							</div>
						</div>
                    </div></div>	
				
              </div>
				<div class="col-lg-6 col-md-4 col-12 mb-3">
                  
<!--
                <div class="card">
                  <div class="card-body">
					<div class="new-heading">						
						<h1>Order Tracking</h1>
					</div>
					<div class="how-it-work-1">
						<iframe width="520" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=520&amp;height=400&amp;hl=en&amp;q=Lilongwe%20Lilongwe+(Area%2025)&amp;t=h&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe> <a href='https://embed-map.org/'>embedMap</a> <script type='text/javascript' src='https://maps-generator.com/google-maps-authorization/script.js?id=e103c2c92388d5b3ea8137b8a81af79e0479d336'></script>
					</div>

                  </div>
			     </div>	
-->
                  
                <div class="card mt-3">
                  <div class="card-body">
					<div class="new-heading">						
						<h4>Status History</h4>
					</div>
					<div class="how-it-work-1">
						<div class="container px-1 px-md-4 py-5 mx-auto">
                              <div class="row d-flex justify-content-between px-3 top">
                                  <div class="d-flex">
                                  </div>
                                 
                              </div> <!-- Add class 'active' to progress -->
                              <div class="row d-flex justify-content-center">
                                  <div class="col-12">
                                      <ul id="progressbar" class="text-center">
                                          <li class="active step0"></li>
                                          <li class="<?=$step2?> step0"></li>
                                          <li class="<?=$step3?> step0"></li>
                                          <li class="<?=$step4?> step0"></li>
                                      </ul>
                                  </div>
                              </div>
                              <div class="row justify-content-between top">
                                  <div class="row d-flex icon-content"> 
                                      <div class="d-flex flex-column">
                                          <p class="font-weight-bold">Ordered<br></p>
                                      </div>
                                  </div>
                                  <div class="row d-flex icon-content"> 
                                      <div class="d-flex flex-column">
                                          <p class="font-weight-bold">Accepted<br></p>
                                      </div>
                                  </div>
                                  <div class="row d-flex icon-content"> 
                                      <div class="d-flex flex-column">
                                          <p class="font-weight-bold">Delivering<br></p>
                                      </div>
                                  </div>
                                  <div class="row d-flex icon-content"> 
                                      <div class="d-flex flex-column">
                                          <p class="font-weight-bold">Delivered<br></p>
                                      </div>
                                  </div>
                              </div>
                      </div>
					</div>

                  </div>
			     </div>	
                  
              </div>
          </div>
		</div>
		</div>

 <div id="edit-bank-details" class="modal fade " role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title font-weight-400">Available Drivers</h5>
                  <button type="button" class="close font-weight-400" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">&times;</span> </button>
                </div>
                <div class="modal-body p-4">
                    <div id="assignDriverResponse" style="width:100%;"></div><br/>
                  <form id="assignDriverForm" method="post">
                    <div class="row">
                      
                     
                      <div class="col-12 ">
                          <small class="text-danger my-3">If drivers do not appear below, no one is available/ready for deliveries!</small>
                         <div class="form-group">
                          <label for="fullName">Driver</label>
                          
                               
                               <?php
                                $msg = '';
                                    //check if drivers exist
                                if($operation->countAll("SELECT * FROM `users` WHERE account_status = 1 AND city_id = '$rest_city_id' AND user_role = 'driver'") > 0){
                                    
                                    ?>
                                      <select class="form-control" data-bv-field="fullName" id="driver_assign_id" name="driver_assign_id" required>
                                      <option selected disabled>-select driver-</option>
                                  <?php
                                    //get all drivers in the city
                                    $getDrivers = $operation->retrieveMany("SELECT * FROM `users` WHERE account_status = 1 AND city_id = '$rest_city_id' AND user_role = 'driver'");
                                        
                                    foreach($getDrivers as $row){
                                        //check if driver is online or not
                                        $name = $row['fname'].' '.$row['lname'];
                                        $driver_id = $row['user_id'];
                                        $phone = '0'.$row['phone'];
                                        
                                        if($operation->countAll("SELECT * FROM `driver_availability` WHERE user_id = '$driver_id' AND availability_status = 1") > 0){
                                            //check if is also assigned to other orders and count them
                                            $orderActive = 0;
                                            $countOtherOrders = $operation->countAll("SELECT * FROM `order_assign` WHERE user_id = '$driver_id'");
                                            if($countOtherOrders > 0 ){
                                                $getOtherOrders = $operation->retrieveMany("SELECT * FROM `order_assign` WHERE user_id = '$driver_id'");
                                                foreach($getOtherOrders as $dv_order){
                                                    $dv_order_id = $dv_order['order_id'];
                                                    $getOrderDv = $operation->retrieveSingle("SELECT * FROM `orders` WHERE order_id = '$dv_order_id'");
                                                    if($getOrderDv['order_delivery_status'] == 0){
                                                        $orderActive+=1;
                                                    }
                                                }
                                            }
                                            
                                           echo '<option value="'.$driver_id.'">'.$name.' - '.$phone.' [Active Jobs: '.$orderActive.']</option>';
                                        }else{
//                                            $msg =  "<p class='alert alert-warning text-center'>No Driver is available at present!</p>";
                                        }
                                    }
                                    ?>
                                    </select>
                                          <?php
                                }else{
                                    $msg = "<p class='alert alert-warning text-center'>No Driver is available at present!</p>";
                                }
                                echo "<br/>".$msg;
                               ?>                              
                          
                           
                        </div>
                      </div>    
					 
						
                   
                     </div>
                      <input type="hidden" value="<?=$user_id?>"  id="assigner" name="assigner" required />
                      <input type="hidden" value="<?=$order_id?>"  id="order" name="order" required />
                    <button onclick="assignDriver()"  id="assignDriverBtn" class="btn btn-primary btn-block mt-2" type="submit">Save </button>
                  </form>
                </div>
              </div>
            </div>
          </div>
			
<script>
    $(document).ready(function(){
      preloader.off();
      closeNav();
    });
</script>