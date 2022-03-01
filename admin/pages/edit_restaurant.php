<?php
include("../../connection/Functions.php");
$operation = new Functions();
if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['uid']) || empty($_POST['uid'])){
  ?>
  <script>
      window.location = "restaurants";
  </script>
  <?php
  die();
}
//restaurant_id
$id = addslashes($_POST['id']);
$admin_id = addslashes($_POST['uid']);
//get restaurant info
$getrestaurant = $operation->retrieveSingle("SELECT * FROM `restaurant_info` WHERE restaurant_id = '$id'");
//get cities
$getCities = $operation->retrieveMany("SELECT * FROM `cities` ");
//check admin level here and create nav bar
$user = $operation->retrieveSingle("SELECT * FROM `admins` WHERE user_id = '$admin_id'");
$admin_level = $user['access_level'];
$city_id = $user['city_id'];

$msg = '';
$btnEdit ="";
$btnEditIcon ="";
$formId = '';
$formId2 = '';
$delBtn = '';
//1 is just and admin, 2 is super admin
if($admin_level == 2){
    $btnEdit = '<button id="ebtn_save_restaurant" onclick="editRest()" class="btn btn-sm btn-warning text-light" type="submit"><i class="fas fa-save"></i> Save Changes</button><a class=" mx-2 btn btn-sm btn-danger text-light" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-trash"></i> Delete</a>';
    $delBtn = '
    <button id="ebtn_delete_restaurant" onclick="deleteRest(\''.$id.'\')" class="mx-2 btn btn-sm btn-danger text-light" type="submit"><i class="fas fa-trash"></i> Yes</button>';
    $formId = 'id="editRestaurantForm"';
    $formId2 = 'id="editIconForm"';
    $btnEditIcon = '<button id="ebtn_save_icon" onclick="editIcon()" class="btn btn-sm btn-warning text-light" type="submit"><i class="fas fa-save"></i> Change Icon</button>';
}else{
  $msg ='<small class="text-danger">Only Super Admins Modify Information</small>';
  $btnEdit = "<span id='ebtn_save_restaurant'></span>";
}
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
</style>
<div id="content">
 <div class="card p-5">
   <div class="col-12">
     <?=$msg?>
    <img height="150px" width="150px" class="mb-3 rounded img-thumbnail" src="../images/<?=$getrestaurant['img_url']?>" />
   <div id="editRestaurantResponse"></div>    
   </div>
   
   <div id="less">
   <form <?=$formId2?>  action="" enctype="multipart/form-data" method="post">
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Restaurant Icon</label>
              <input type="file" required class="form-control" data-bv-field="fullName" id="erestaurant_icon" name="erestaurant_icon" placeholder="Restaurant Icon" accept=".png,.jpg,.jpeg" />
            </div>
          </div>

          <div class="col-12 col-sm-6 mt-3">
            <div class="form-group">
                <input type="hidden" value="<?=$getrestaurant['restaurant_id']?>" name="restaurant_id" id="restaurant_id" required />
                
                <?=$btnEditIcon?><button onclick="morem()" type="button" class="btn btn-sm btn-default mx-2"><i class="fas fa-chevron-down"></i></button>
            </div>
          </div>
         </div>
    </form>
   </div>
   
   <hr>
   <div id="more">
    <form class="mt-3" <?=$formId?>  action="" enctype="multipart/form-data" method="post">
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="firstName">City </label>
              <select class="form-control" name="ecity_name" id="ecity_name" required>
                <?php
                  foreach($getCities as $city){
//                      get selected city
                    $selected = '';
                      if($getrestaurant['city_id'] == $city['city_id']){
                        $selected = "selected";
                      }
                    ?>
                      <option <?=$selected?> value="<?=$city['city_id']?>"><?=$city['city_name']?></option>
                    <?php
                  }
                ?>
              </select>
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Restaurant Name</label>
              <input type="text" class="form-control" data-bv-field="fullName" id="erestaurant_name" name="erestaurant_name" required placeholder="Restaurant Name" value="<?=$getrestaurant['restaurant_name']?>" />
            </div>
          </div>
         <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Restaurant Phone</label>
              <input type="text" class="form-control" data-bv-field="fullName" id="erestaurant_phone" name="erestaurant_phone" required placeholder="Restaurant Phone" value="<?=$getrestaurant['restaurant_phone']?>" />
            </div>
          </div>     
            
            
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="birthDate">Address</label>
              <textarea class="form-control" name="eaddress" id="eaddress" required placeholder="Restaurant Address" ><?=$getrestaurant['restaurant_address']?></textarea>
            </div>
          </div>

          <div class="col-12 col-sm-6 mt-3">
            <div class="form-group">
                <input type="hidden" value="<?=$getrestaurant['placeID']?>" name="eplace_id" id="eplace_id" required />
                <input type="hidden" value="<?=$getrestaurant['restaurant_id']?>" name="restaurant_id" id="restaurant_id" required />
                
                <?=$btnEdit?><button onclick="lessm()" type="button" class="btn btn-sm btn-default mx-2"><i class="fas fa-chevron-up"></i></button>
            </div>
          </div>
         </div>
          
    </form>
    </div>
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
            <?=$delBtn?>
        </div>
            
      </div>
    </div>
  </div>
	
  <script>
      "use strict";

      // This sample requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script
      // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      /*function initMap() {
        const input = document.getElementById("epac-input");
        const autocomplete = new google.maps.places.Autocomplete(input);
        autocomplete.setFields([
          "place_id",
          "geometry",
          "name",
          "formatted_address"
        ]);
       
        const geocoder = new google.maps.Geocoder();
     
       
        autocomplete.addListener("place_changed", () => {
          const place = autocomplete.getPlace();

          if (!place.place_id) {
            return;
          }

          geocoder.geocode(
            {
              placeId: place.place_id
            },
            (results, status) => {
              if (status !== "OK") {
                window.alert("Geocoder failed due to: " + status);
                return;
              }
              $("#eplace_id").val(place.place_id);
              $("#eplace_name").val(place.name);
            }
          );
        });
      }*/
    $(document).ready(function(){
//      initMap();
      $("#more").hide();
      preloader.off();
      closeNav();
      
    });    
    </script>