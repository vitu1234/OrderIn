<?php
include("../../connection/Functions.php");
$operation = new Functions();
session_start();
if(!isset($_POST['id']) || empty($_POST['id']) ){
  ?>
  <script>
      window.location = "meals";
  </script>
  <?php
  die();
}

$user_id = $_SESSION['restaurant'];
$meal_id = addslashes($_POST['id']);
//check admin level here and create nav bar
$user = $operation->retrieveSingle("SELECT * FROM `users` WHERE user_id = '$user_id'");
$city_id = $user['city_id'];


//get meal info
$getMeal = $operation->retrieveSingle("SELECT * FROM `products` WHERE product_id = '$meal_id'");

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
   
   <img src="../images/<?=$getMeal['img_url']?>" height="300px" class="mb-5" width="300px" /> 
    <form id="addDriverForm"  action="" enctype="multipart/form-data" method="post">
        <div class="row">
          <div class="col-12">
            <div id="addRestaurantResponse"></div>      
       </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Picture</label>
              <input type="file" class="form-control" data-bv-field="fullName" id="emeal_picture" name="emeal_picture"  placeholder="Meal Picture" />
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Meal Name</label>
              <input type="text" class="form-control" data-bv-field="fullName" id="emeal_name" name="emeal_name" required placeholder="Meal Name" value="<?=$getMeal['product_name']?>" />
            </div>
          </div>
          
          
<!--
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Price (MW)</label>
              <input type="text" min="0" onkeypress="return isNumberKey(event)" class="form-control" data-bv-field="fullName" id="emeal_price" name="emeal_price" required placeholder="Meal Price" value="<?=$getMeal['product_price']?>" />
            </div>
          </div>
          
-->
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Delivery Fee (MW) - <i><small class="text-muted">put 0 if free</small></i></label>
              <input type="text" min="0" onkeypress="return isNumberKey(event)" class="form-control" data-bv-field="fullName" id="edelivery_fee" name="edelivery_fee" required placeholder="Delivery Fee" value="<?=$getMeal['delivery_fee']?>" />
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Preparing Time (Mins.)</label>
              <input type="text"  class="form-control" data-bv-field="fullName" id="eprep_mins" name="eprep_mins" required placeholder="Preparing Time (Mins.)" value="<?=$getMeal['prep_mins']?>" />
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Availability</label>
              <select required name="eavailability" id="eavailability" class="form-control">
                  <?php
                    if($getMeal['availability'] == 1){
                      ?>
                      <option value="1" selected>Available</option>
                      <option value="2" >Unavailable</option>
                  
                      <?php
                    }else{
                          ?>
                      <option value="1" >Available</option>
                      <option value="2" selected>Unavailable</option>
                  
                      <?php
                    }
                  ?>
              </select>
            </div>
          </div>
          
          
           <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Meal Type</label>
              <br/>
              <?php
                //get meal type
                $chk1 = '';
                $chk2 = '';
                $chk3 = '';
                if($getMeal['meal_type'] == 1){
                  $chk1 = 'checked';
                }elseif($getMeal['meal_type'] == 2){
                  $chk2 = 'checked';
                }else{
                    $chk3 = 'checked';
                }
              ?>
              <div class="form-check form-check-inline my-2">
                <input <?=$chk1?> required class="form-check-input" type="radio" name="meal_type" id="meal_type1" value="1">
                <label class="form-check-label" for="meal_type1">Veg</label>
              </div>
              <div class="form-check form-check-inline">
                <input <?=$chk2?> required class="form-check-input" type="radio" name="meal_type" id="meal_type2" value="2">
                <label class="form-check-label" for="meal_type2">Non-Veg</label>
              </div>
              <div class="form-check form-check-inline">
                <input <?=$chk3?> required class="form-check-input" type="radio" name="meal_type" id="meal_type3" value="3" >
                <label class="form-check-label" for="meal_type3">Other</label>
              </div>
            </div>
          </div>
          
          <div class="col-12 col-6">
            <div class="form-group">
              <label for="fullName">Price </label>
              <br/>
              <!--              get whats in the dp options-->

              <?php
                $checked = '';
                $checked1 = '';
                $dsp = '';
                
                       
                //check if extras are there
                $countExt = $operation->countAll("SELECT * FROM `product_extras` WHERE product_id = '$meal_id'");
                if($countExt > 0){
                    $checked = '<input checked required  class="form-check-input" type="radio" name="meal_add_on" id="meal_size_multiple" value="2">
                <label class="form-check-label" id="dx" for="meal_size_multiple">Multiple</label>';
                  
                    $getExt = $operation->retrieveMany("SELECT * FROM `product_extras` WHERE product_id = '$meal_id'");
                  
                    $dsp.='<div class="form-inline"><input type="text" min="0" onkeypress="return isNumberKey(event)" class="form-control" data-bv-field="fullName" id="emeal_price" name="emeal_price" value="'.$getMeal['product_price'].'" required placeholder="Meal Price" /></div><div class="form-group mt-1"><label for="fullName">Addons</label><input type="hidden"  field="fullName" /><div/>';
                  $i = 0;
                    foreach($getExt as $row){
                      $i++;
                      $dsp.= '<div class="form-inline" id="meals_container"><div id="rowMeals0"> </div><div id="rowMeals'.$i.'">                    <input value="'.$row['extra_name'].'" type="text" placeholder="Name" class="form-control m-2" id="eaddonName" name="eaddonName[]" required /><input value="'.$row['extra_price'].'" type="text" onkeypress="return isNumberKey(event)" placeholder="Price(MWK)" class="form-control m-2" id="eaddonPrice" name="eaddonPrice[]" required /> <button onclick=edelete_row("rowMeals'.$i.'") type="button" class="btn btn-sm btn-danger m-2 text-light"><i class="fas fa-times"></i></button></div>';
                    }
                  $dsp.='</div><button onclick="eadd_row()" type="button" class="btn btn-sm btn-success m-2 text-light"><i class="fas fa-plus"></i> More Options</button>';
                }else{
                    $checked = '<input checked  required class="form-check-input" type="radio" name="meal_add_on" id="meal_size_normal" value="1">
                    <label class="form-check-label" id="dx" for="meal_size_normal">Normal</label>';
                                      
                   $dsp.='<div class="form-inline"><input type="text" min="0" onkeypress="return isNumberKey(event)" class="form-control" data-bv-field="fullName" id="emeal_price" name="emeal_price" value="'.$getMeal['product_price'].'" required placeholder="Meal Price" /></div><div class="form-group mt-2"><label for="fullName">Addons</label><input type="hidden"  field="fullName" /><div/><div class="form-inline" id="meals_container"><div id="rowMeals1"> </div></div>';
                  
                    $dsp.='</div><button onclick="eadd_row()" type="button" class="btn btn-sm btn-success m-2 text-light"><i class="fas fa-plus"></i> More Options</button>';
                    
                }
              ?>
              
              
              
              <div class="form-check form-check-inline my-2">
                <?=$checked?>
              </div>
            <div id="all_options">
                <?=$dsp?>
              
            </div>
          </div>
          </div>
          
           <div class="col-8">
            <div class="form-group">
              <label for="fullName">Size </label>
              <br/>
              <!--              get whats in the dp options-->

              <?php
                $checked = '';
                $checked1 = '';
                $dsp = '';
                
                       
                //check if extras are there
                $countExt = $operation->countAll("SELECT * FROM `product_sizes` WHERE product_id = '$meal_id'");
                if($countExt > 0){
                    $checked = '<input checked required  class="form-check-input" type="radio" name="meal_size" id="meal_size_multiple" value="2">
                <label class="form-check-label" id="sdx" for="meal_size_multiple">Multiple</label>';
                  
                    $getExt = $operation->retrieveMany("SELECT * FROM `product_sizes` WHERE product_id = '$meal_id'");
                  
                  $i = 0;
                    foreach($getExt as $row){
                      $i++;
                      $dsp.= '<div class="form-inline" id="smeals_container"><div id="srowMeals0"> </div><div id="srowMeals'.$i.'">                    <input value="'.$row['size_name'].'" type="text" placeholder="Name" class="form-control m-2" id="esizeName" name="esizeName[]" required /><input value="'.$row['size_price'].'" type="text" onkeypress="return isNumberKey(event)" placeholder="Price(MWK)" class="form-control m-2" id="esizePrice" name="esizePrice[]" required /> <button onclick=esdelete_row("srowMeals'.$i.'") type="button" class="btn btn-sm btn-danger m-2 text-light"><i class="fas fa-times"></i></button></div>';
                    }
                  $dsp.='</div><button onclick="esadd_row()" type="button" class="btn btn-sm btn-success m-2 text-light"><i class="fas fa-plus"></i> More</button>';
                }else{
                    $checked = '<input checked  required class="form-check-input" type="radio" name="meal_size" id="meal_size_normal" value="1">
                    <label class="form-check-label" id="sdx" for="meal_size_normal">Normal</label>';
                                      
                   $dsp.='<div class="form-inline"></div><div class="form-inline" id="smeals_container"><div id="srowMeals1"> </div></div>';
                  
                    $dsp.='</div><button onclick="esadd_row()" type="button" class="btn btn-sm btn-success m-2 text-light"><i class="fas fa-plus"></i> More</button>';
                    
                }
              ?>
              
              
              
              <div class="form-check form-check-inline my-2">
                <?=$checked?>
              </div>
            <div id="all_options">
                <?=$dsp?>
              
            </div>
          </div>
          </div>
          
          <div class="col-12 ">
        
          </div>
          
          
          
          <div class="col-12 ">
            <div class="form-group">
                <input type="hidden" required name="meal_id" id="meal_id" value="<?=$meal_id?>" />
                <button id="btn_save_restaurant" onclick="editMeal()" class="btn btn-sm btn-warning text-light" type="submit"><i class="fas fa-save"></i> Save</button>
 
                 <a class=" mx-2 btn btn-sm btn-danger text-light" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-trash"></i> Delete</a>
            </div>
            
          </div>
          
         </div>
          
    </form>
   </div>
</div>

   <!-- delete Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times text-dark"></i></span>
          </button>
        </div>
        <div id="deleteRestaurantResponse"></div>
          <small class="text-danger mx-3">Are sure you want to delete? Deleted data is unrecoverable</small>
       
           <div class="modal-footer">
          
          
            <button class="btn btn-sm btn-secondary text-light" type="button" data-dismiss="modal">No</button>
            <button id="ebtn_delete_restaurant" onclick="deleteMeal('<?=$meal_id?>')" class="mx-2 btn btn-sm btn-danger text-light" type="submit"><i class="fas fa-trash"></i> Yes</button>
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
