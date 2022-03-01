<?php
include("../../connection/Functions.php");
$operation = new Functions();
session_start();
if(!isset($_POST['id']) || empty($_POST['id']) || !isset($_POST['uid']) || empty($_POST['uid'])){
  ?>
  <script>
      window.location = "restaurants.php";
  </script>
  <?php
}

$user_id = $_SESSION['admin'];
$id = addslashes($_POST['id']);
//check admin level here and create nav bar
$user = $operation->retrieveSingle("SELECT * FROM `admins` WHERE user_id = '$user_id'");
$admin_level = $user['access_level'];
$city_id = $user['city_id'];

$selectCity = '';

$getDriver  = $operation->retrieveSingle("SELECT *FROM admins WHERE user_id = '$id'");
$driver_city_id = $getDriver['city_id'];
$access_level = '';
//1 is just and admin, 2 is super admin
if($admin_level == 2){
  
  //get cities
    $getCities = $operation->retrieveMany("SELECT * FROM `cities` ");
    foreach($getCities as $city){
      $slecte = '';
      if($driver_city_id == $city['city_id']){
        $slecte = 'selected';
      }
        $selectCity .= '<option '.$slecte.' value="'.$city['city_id'].'">'.$city['city_name'].'</option>';
    }
  
      $access = '';
      if($getDriver['access_level'] == 1){
            $access_level = '<option selected value="1">City Admin</option><option value="2">Super Admin</option>';
      }else{
            $access_level = '<option value="1">City Admin</option><option selected value="2">Super Admin</option>';
      }

}else{
  //identify admin city
  //get city
  $getCities = $operation->retrieveSingle("SELECT * FROM `cities` WHERE city_id = '$city_id'");
  $selectCity = '<option selected value="'.$getCities['city_id'].'">'.$getCities['city_name'].'</option>';
      
      $access_level = '<option selected value="1">City Admin</option>';
}
$msg = '';
$color = '';
if($getDriver['account_status'] == 1){
  $msg = 'Deactivate Account';
  $color = 'btn-danger';
}else{
  $msg = 'Activate Account';
  $color = 'btn-warning';
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
    <form id="editAdminForm"  action="" enctype="multipart/form-data" method="post">
        <div class="row">
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Firstname</label>
              <input type="text" class="form-control" data-bv-field="fullName" id="efname" name="efname" required placeholder="Firstname" value="<?=$getDriver['fname']?>" />
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Lastname</label>
              <input type="text" class="form-control" data-bv-field="fullName" id="elname" name="elname" required placeholder="Lastname" value="<?=$getDriver['lname']?>" />
            </div>
          </div>
          
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Email</label>
              <input disabled type="email" class="form-control" data-bv-field="fullName" id="eemail" name="email" required placeholder="Email" value="<?=$getDriver['email']?>" />
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Phone</label>
              <input type="text" maxlength="12" onkeypress="return isNumberKey(event)" class="form-control" data-bv-field="fullName" id="ephone" name="ephone" value="<?=$getDriver['phone']?>" required placeholder="Phone" />
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="fullName">Password</label>
              <input type="password" class="form-control" data-bv-field="fullName" id="epassword" name="epassword"  placeholder="Password"  />
            </div>
          </div>
          
          <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="firstName">City </label>
              <select class="form-control" name="ecity_name" id="ecity_name" required>
                <?=$selectCity?>
              </select>
            </div>
          </div>
          
            
        <div class="col-12 col-sm-6">
            <div class="form-group">
              <label for="firstName">Access Level </label>
              <select class="form-control" name="eaccess_level" id="eaccess_level" required>
                <?=$access_level?>
              </select>
            </div>
          </div>
          
          <div class="col-12 col-sm-6  mt-3">
            <div class="form-group">
              <input type="hidden" name="admin_id" id="admin_id" value="<?=$id?>" />
              <input type="hidden" class="form-control" data-bv-field="fullName"  name="eemail" required placeholder="Email" value="<?=$getDriver['email']?>" />
              
                <button id="btn_save_restaurant" onclick="editAdmin()" class="btn btn-sm btn-warning text-light" type="submit"><i class="fas fa-save"></i> Save</button>
              
                <a class=" mx-2 btn btn-sm btn-danger text-light" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal"><i class="fas fa-trash"></i> Delete</a>
              
                <a id="statusBtn" class=" mx-2 mt-1 btn btn-sm <?=$color?> text-light" href="javascript:void(0);" data-toggle="modal" data-target="#logoutModal2"><i class=""></i> <?=$msg?></a>
            </div>
          </div>
         </div>
          
    </form>
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
            <button id="ebtn_delete_restaurant" onclick="deleteAdmin('<?=$id?>')" class="mx-2 btn btn-sm btn-danger text-light" type="submit"><i class="fas fa-trash"></i> Yes</button>
        </div>
            
      </div>
    </div>
  </div>
  
  <!-- deactivate Modal-->
  <div class="modal fade" id="logoutModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true"><i class="fas fa-times text-dark"></i></span>
          </button>
        </div>
        <div id="statusRestaurantResponse"></div>
          <small class="text-danger mx-3">Are sure you want to <?=$msg?> account? </small>
       
           <div class="modal-footer">
          
          
            <button class="btn btn-sm btn-secondary text-light" type="button" data-dismiss="modal">No</button>
            <button id="ebtn_status_restaurant" onclick="accountStatusAdmin('<?=$id?>')" class="mx-2 btn btn-sm btn-warning text-light" type="button"><i class=""></i> Yes</button>
        </div>
            
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

