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
       <p class="text-danger text-center"><i class="fas fa-exclamation-triangle"></i> Make sure you're at your restaurant now!</p>
        <div id="addRestaurantCoordResponse"></div> 
     
   </div>
    <form id="addCoordinatesForm"  action="" enctype="multipart/form-data" method="post">
        <div class="row">
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Found Location</label>
              <input type="text" class="form-control" readonly data-bv-field="fullName" id="location" name="location" required placeholder="Getting Location..." />
            </div>
          </div>
          <div class="col-12 col-sm-6 mt-3">
            <div class="form-group">
                <input type="hidden" required name="rest_id" id="rest_id" value="<?=$rest_id?>" />
                <input type="hidden" required name="longtude" id="longtude" required />
                <input type="hidden" required name="latitude" id="latitude" required/>
                <input type="hidden" required name="place_id" id="place_id" required/>
                <div id="button_holder">
                  <button disabled id="btn_save_coordinates" class="btn btn-sm btn-warning text-light" type="button"><i class="fas fa-save"></i> Save</button>
                </div>
            </div>
          </div>
         </div>
    </form>
   <div class="col-12">
      <p class="text-info" id="text_info"><small>If this message does not disappear within 1 minute, make sure you allowed location permissions</small></p>
   </div>
   </div>
</div>
<script>
  let G, options, spans;
    $(document).ready(function(){
      preloader.off();
      closeNav();
      init();
        $("#btn_save_coordinates").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Getting your location...');
    });

        //geolocation.js
// How to use Navigator.geolocation

function init(){
    if(navigator.geolocation){
        let giveUp = 1000 * 30;  //30 seconds
        let tooOld = 1000 * 60 * 60;  //one hour
        options ={
            enableHighAccuracy: true,
            timeout: giveUp,
            maximumAge: tooOld
        }
        
        navigator.geolocation.getCurrentPosition(gotPos, posFail, options);
    }else{
        //using an old browser that doesn't support geolocation
      alert("You need to update your browser!");
    }
}

function gotPos(position){
//    spans = document.querySelectorAll('p span');
//    spans[0].textContent = position.coords.latitude;
//    spans[1].textContent = position.coords.longitude;
//    spans[2].textContent = position.coords.accuracy;
//    
//    spans[6].textContent = position.timestamp;
  $("#latitude").val(position.coords.latitude);
  $("#longtude").val(position.coords.longitude);
  
 getData(position.coords.latitude, position.coords.longitude);
  
}

function posFail(err){
    //err is a number
    let errors = {
        1: 'No permission',
        2: 'Unable to determine',
        3: 'Took too long'
    }
    $("#addRestaurantCoordResponse").fadeIn(500);
    $("#addRestaurantCoordResponse").html('<p class="text-center alert alert-danger">'+errors[err]+'</p>');
    setTimeout(function(){
         $("#addRestaurantCoordResponse").fadeOut(500);
         $("#addRestaurantCoordResponse").html('');
       },1000);
//    document.querySelector('h1').textContent = errors[err];
}
  
function getData(lat, lng){
  var location = lat+','+lng;
     axios.get('https://maps.googleapis.com/maps/api/geocode/json',{
        params:{
          latlng:location,
          key:'AIzaSyCsv43N4fIGspg5a2sD1SG_w6-6YJHb8ho'
        }
      })
      .then(function(response){
        // Log full response
//        console.log(response);
       // Formatted Address
       
       if(response.data.results[1] !== '' || response.data.results[1] != undefined || response.data.results[1] != null){
          var formattedAddress = response.data.results[1].formatted_address;
          var place_id = response.data.results[0].place_id;
          $("#location").val(formattedAddress);
          $("#place_id").val(place_id);
       }else{
            var formattedAddress = response.data.results[0].formatted_address;
            var place_id = response.data.results[0].place_id;
            $("#location").val(formattedAddress);
            $("#place_id").val(place_id);
       }
       
      $('#button_holder').html('');
      $('#button_holder').html('<button onclick="saveCoordinates()" id="btn_coordinates" class="btn btn-sm btn-warning text-light" type="submit"><i class="fas fa-save"></i> Save</button>');
      $("#text_info").hide();

      })
      .catch(function(error){
//        console.log(error);
       $("#addRestaurantCoordResponse").fadeIn(500);
        $("#addRestaurantCoordResponse").html('<p>An error occurred, please try again later</p>');
       setTimeout(function(){
         $("#addRestaurantCoordResponse").fadeOut(500);
         $("#addRestaurantCoordResponse").html('');
       },1000);
      });
    }
</script>