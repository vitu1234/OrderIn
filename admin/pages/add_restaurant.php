<?php
include("../../connection/Functions.php");
$operation = new Functions();

//get cities
$getCities = $operation->retrieveMany("SELECT * FROM `cities` ");

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
        <div id="addRestaurantResponse"></div>      
   </div>
    <form id="addRestaurantForm"  action="" enctype="multipart/form-data" method="post">
        <div class="row">
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Restaurant Icon</label>
              <input type="file" class="form-control" data-bv-field="fullName" id="restaurant_icon" name="restaurant_icon" required placeholder="Restaurant Icon" accept=".png,.jpg,.jpeg" />
            </div>
          </div>
          
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Restaurant Name</label>
              <input type="text" class="form-control" data-bv-field="fullName" id="restaurant_name" name="restaurant_name" required placeholder="Restaurant Name" />
            </div>
          </div>
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Restaurant Phone</label>
              <input type="text" onkeypress="return isNumberKey(event)" class="form-control" data-bv-field="fullName" id="restaurant_phone" name="restaurant_phone" required placeholder="Restaurant Phone" />
            </div>
          </div>   
            
            
        <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="firstName">City </label>
              <select class="form-control" name="city_name" id="city_name" required>
                <option selected disabled>-Select City-</option>
                <?php
                  foreach($getCities as $city){
                    ?>
                      <option value="<?=$city['city_id']?>"><?=$city['city_name']?></option>
                    <?php
                  }
                ?>
              </select>
            </div>
          </div>
          <div class="col-12 ">
            <div class="form-group">
              <label for="birthDate">Postal Address</label>
              <textarea class="form-control" name="address" id="address" required placeholder="Restaurant Address" ></textarea>
            </div>
          </div>
<!--
            <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="birthDate">For better Tracking</label>
                  <div style="">
                    <input
                      id="pac-input"
                      name="pac-input"
                      class="form-control"
                      type="text"
                      placeholder="Search location"
                           required
                    />
                  </div>
               
            </div>
          </div>
-->
          <div class="col-12 col-sm-6 mt-3">
            <div class="form-group">
<!--                <input type="hidden" name="place_id" id="place_id" required />-->
<!--                <input type="hidden" name="place_name" id="place_name" required />-->
                <button id="btn_save_restaurant" onclick="addRest()" class="btn btn-sm btn-warning text-light" type="submit"><i class="fas fa-save"></i> Save</button>
            </div>
          </div>
         </div>
          
    </form>
   </div>
</div>

	
  <script>
      "use strict";

      // This sample requires the Places library. Include the libraries=places
      // parameter when you first load the API. For example:
      // <script
      // src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
      /*function initMap() {
        const input = document.getElementById("pac-input");
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
              $("#place_id").val(place.place_id);
              $("#place_name").val(place.name);
              $("#btn_save_restaurant").show();
            }
          );
        });
      }*/
    $(document).ready(function(){
      preloader.off();
      closeNav();

//      initMap();
//      $("#btn_save_restaurant").hide();
    });

    </script>