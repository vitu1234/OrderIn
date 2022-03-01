<?php
include("../../connection/Functions.php");
$operation = new Functions();
session_start();


$user_id = $_SESSION['restaurant'];

//check admin level here and create nav bar
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
        <div id="addLocationResponse"></div>      
   </div>
    <form id="addRestLocationForm"  action="" enctype="multipart/form-data" method="post">
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Search for your restaurant</label>
              <input type="text"  class="form-control" data-bv-field="fullName" id="pac-input" name="pac_input" required placeholder="Search for your restaurant location" />
            </div>
          </div>
          <div class="col-12 col-sm-6 mt-3">
            <div class="form-group">
                <input type="text" required name="rest_id" id="rest_id" value="<?=$rest_id?>" />
                <input type="text" required name="latitude" id="latitude" />
                <input type="text" required name="longtude" id="longtude" />
                <input type="text" required name="place_id" id="place_id" />
                <button id="btn_location_google" onclick="addRestInfo()" class="btn btn-sm btn-warning text-light" type="submit"><i class="fas fa-save"></i> Save</button>
            </div>
          </div>
            
            <div class="col-12">
                <div class="float-right">
                    <small>Not found or enter manually? </small> <a href="#restaurant_coordinates">Next</a>
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
      function initMap() {
        const input = document.getElementById("pac-input");
        const autocomplete = new google.maps.places.Autocomplete(input);
       
        const geocoder = new google.maps.Geocoder();
     
       
        autocomplete.addListener("place_changed", () => {
          const place = autocomplete.getPlace();
           var lat = place.geometry.location.lat();
           var lng = place.geometry.location.lng();
          
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
              $("#latitude").val(lat);
              $("#longtude").val(lng);
              $("#btn_location_google").show();
            }
          );
        });
      }
    $(document).ready(function(){
      preloader.off();
      closeNav();

      initMap();
      $("#btn_location_google").hide();
    });

    </script>


<script>
    $(document).ready(function(){
      initMap();
      preloader.off();
      closeNav();
    });
</script>

<!--	google maps api-->
