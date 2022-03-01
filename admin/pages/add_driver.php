<?php
include("../../connection/Functions.php");
$operation = new Functions();
session_start();


$user_id = $_SESSION['admin'];

//check admin level here and create nav bar
$user = $operation->retrieveSingle("SELECT * FROM `admins` WHERE user_id = '$user_id'");
$admin_level = $user['access_level'];
$city_id = $user['city_id'];

$selectCity = '';


//1 is just and admin, 2 is super admin
if($admin_level == 2){
  //get cities
    $getCities = $operation->retrieveMany("SELECT * FROM `cities` ");
    foreach($getCities as $city){
        $selectCity .= '<option value="'.$city['city_id'].'">'.$city['city_name'].'</option>';
    }
}else{
  //identify admin city
  //get city
  $getCities = $operation->retrieveSingle("SELECT * FROM `cities` WHERE city_id = '$city_id'");
  $selectCity = '<option value="'.$getCities['city_id'].'">'.$getCities['city_name'].'</option>';
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
              <label for="fullName">Firstname</label>
              <input type="text" class="form-control" data-bv-field="fullName" id="fname" name="fname" required placeholder="Firstname" />
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Lastname</label>
              <input type="text" class="form-control" data-bv-field="fullName" id="lname" name="lname" required placeholder="Lastname" />
            </div>
          </div>
          
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Email</label>
              <input type="email" class="form-control" data-bv-field="fullName" id="email" name="email" required placeholder="Email" />
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Phone</label>
              <input type="text" maxlength="12" onkeypress="return isNumberKey(event)" class="form-control" data-bv-field="fullName" id="phone" name="phone" required placeholder="Phone" />
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Password</label>
              <input type="password" class="form-control" data-bv-field="fullName" id="password" name="password" required placeholder="Password" />
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="firstName">City </label>
              <select class="form-control" name="city_name" id="city_name" required>
                <option selected disabled>-Select City-</option>
                <?=$selectCity?>
              </select>
            </div>
          </div>
          <div class="col-12  mt-3">
            <div class="form-group">
                <button id="btn_save_restaurant" onclick="addDriver()" class="btn btn-sm btn-warning text-light" type="submit"><i class="fas fa-save"></i> Save</button>
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
