<?php
include("../../connection/Functions.php");
$operation = new Functions();
session_start();


$user_id = $_SESSION['restaurant'];

//check restaurant city
$user = $operation->retrieveSingle("SELECT * FROM `users` WHERE user_id = '$user_id'");
$city_id = $user['city_id'];


//get the restaurant assigned to
$getRestaurant = $operation->retrieveSingle("SELECT * FROM `restaurant_managers` WHERE user_id = '$user_id'");
$rest_id = $getRestaurant['restaurant_id'];



?>
<style>
  select, label, option,input{
    color: #000;
  }
  input[type="text"]{
    color: #000 !important;
  }
  
  textarea{
    color: #000 !important;
  }
  
   input[type="text"],input[type="email"], input[type="password"]{
    color: #000 !important;
  }
</style>
<div id="content">
 <div class="card p-5">
   <div class="col-12">
        <div id="addRestaurantResponse"></div>      
   </div>
    <form id="addDriverForm"  action="" enctype="multipart/form-data" method="post">
        <div class="row">
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Picture</label>
              <input type="file" class="form-control" data-bv-field="fullName" id="meal_picture" name="meal_picture" required placeholder="Meal Picture" />
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Meal Name</label>
              <input type="text" class="form-control" data-bv-field="fullName" id="meal_name" name="meal_name" required placeholder="Meal Name" />
            </div>
          </div>
          
          
<!--
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Price (MWK)</label>
              <input type="text" min="0" onkeypress="return isNumberKey(event)" class="form-control" data-bv-field="fullName" id="meal_price" name="meal_price" required placeholder="Meal Price" />
            </div>
          </div>
-->
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Delivery Fee (MWK) - <i><small class="text-muted">put 0 if free</small></i></label>
              <input type="text" min="0" onkeypress="return isNumberKey(event)" class="form-control" data-bv-field="fullName" id="delivery_fee" name="delivery_fee" required placeholder="Delivery Fee" />
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Preparing Time (Mins.)</label>
              <input type="text" onkeypress="return isNumberKey(event)" class="form-control" data-bv-field="fullName" id="prep_mins" name="prep_mins" required placeholder="Preparing Time (Mins.)" />
            </div>
          </div>
          
          
          
        <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Meal Type</label>
              <br/>
              <div class="form-check form-check-inline my-2">
                <input required class="form-check-input" type="radio" name="meal_type" id="meal_type1" value="1">
                <label class="form-check-label" for="meal_type1">Veg</label>
              </div>
              <div class="form-check form-check-inline">
                <input required class="form-check-input" type="radio" name="meal_type" id="meal_type2" value="2">
                <label class="form-check-label" for="meal_type2">Non-Veg</label>
              </div>
              <div class="form-check form-check-inline">
                <input required class="form-check-input" type="radio" name="meal_type" id="meal_type3" value="3" >
                <label class="form-check-label" for="meal_type3">Other</label>
              </div>
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Price | Addons</label>
              <br/>
              <div class="form-check form-check-inline my-2">
                <input onclick="removeAddOns()" required class="form-check-input" type="radio" name="meal_add_on" id="meal_size_normal" value="1">
                <label class="form-check-label" for="meal_size_normal">No Addons</label>
              </div>
              <div class="form-check form-check-inline">
                <input required onclick="showAddOns()" class="form-check-input" type="radio" name="meal_add_on" id="meal_size_multiple" value="2">
                <label class="form-check-label" for="meal_size_multiple">Multiple</label>
                
              </div>
            <div id="all_options">
              
            </div>
          </div>
          </div>
          
          
          <div class="col-12 col-sm-6">
              <div class="form-group">
                <label for="fullName">Meal Size </label>
                <br/>
                <div class="form-check form-check-inline my-2">
                  <input onclick="removeSizes()" required class="form-check-input" type="radio" name="meal_size" id="size1" value="1">
                  <label class="form-check-label" for="size1">Normal</label>
                </div>
                <div class="form-check form-check-inline">
                  <input required onclick="showSizes()" class="form-check-input" type="radio" name="meal_size" id="size2" value="2">
                  <label class="form-check-label" for="size2">Multiple</label>

                </div>
              <div id="all_meal_size_options">

              </div>
            </div>
          </div>
          
          <div class="col-12 ">
        
          </div>
          
          
          
          <div class="col-12 col-sm-6 mt-3">
            <div class="form-group">
                <input type="hidden" required name="rest_id" id="rest_id" value="<?=$rest_id?>" />
                <button id="btn_save_restaurant" onclick="addMeal()" class="btn btn-sm btn-warning text-light" type="submit"><i class="fas fa-save"></i> Save</button>
            </div>
          </div>
         </div>
          
    </form>
   </div>
</div>
<script>
    $(document).ready(function(){
      preloader.off();
      closeNav();
    });
</script>
