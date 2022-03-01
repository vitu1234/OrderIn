$("#loginForm").on('submit',function(e){
   var form_data = $(this).serialize();
    
    var email = $("#email").val();
    var password = $("#password").val();
    if(email !== '' && password !== ''){
      
      $("#loginBtn").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Checking...');
       $.ajax({ //make ajax request to cart_process.php
          url: "process/login_user.php",
              type: "POST",
              //dataType:"json", //expect json value from server
              data: form_data
          }).done(function(dataResult){ //on Ajax success
             $("#loginResponse").fadeIn();
            $("#loginBtn").html('Login');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#loginResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "index";
               },1000);
            }else if(data.code == 2){
               $("#loginResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#loginResponse").fadeOut();
              },1500);
            }else{
              $("#loginResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#loginResponse").fadeOut();
              },1500);
            }

       });
     
    }else{
      $("#loginResponse").html('<p class="alert alert-danger text-center">Both fields are required</p>');
       setTimeout(function(){
                  $("#loginResponse").fadeOut();
              },1500);
    }
   e.preventDefault();
});

//to restaurant
function toAddRestaurant(){
 startPreloader();
  $("#content").load("pages/add_restaurant.php");
  $("#page_title1").html('Add Restaurant');
  $("#page_title2").html('Add Restaurant');
  $("#btn_to_add").hide();
}
//add restaurant
function addRest(){
$("#addRestaurantForm").on('submit',function(e){
 $("#addRestaurantResponse").html('');
 
   var form_data = $(this).serialize();
    var city_id = $("#city_name").val();
    var restaurant_name = $("#restaurant_name").val();
    var address = $("#address").val();
    var phone = $("#restaurant_phone").val();
  //validate the file
     var file_size = $('#restaurant_icon')[0].files[0].size;
      var f_size = true;
      var f_type = true;
      var ext = $('#restaurant_icon').val().split('.').pop().toLowerCase();
      //Allowed file types
      if($.inArray(ext, ['png','jpg','jpeg','PNG','JPG','JPEG']) == -1) {
         f_type = false; 
          $("#addRestaurantResponse").html('<p class="text-center alert alert-danger" style="width:100%;">✖ File type not supported, try png,jpg or jpeg files!</p>');
         $(this).trigger('reset');
          setTimeout(function(){
              $("#addRestaurantResponse").fadeOut(500);
          },800);
      }
    
          if(file_size>3000000) {

                f_size = false;
//                response("File size should not exceed 3mb!");
           $(this).trigger('reset');
                $("#addRestaurantResponse").html('<p class="text-center alert alert-danger" style="width:100%;">✖ File size should not exceed 3mb!</p>');
                    setTimeout(function(){
                    $("#addRestaurantResponse").fadeOut(500);
                },800);
            }
    if(f_type == true && f_size == true && address !== '' && restaurant_name !== '' && city_id !== ''){
      $("#btn_save_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
     //add form data
          var fd = new FormData();
          var files = $('#restaurant_icon')[0].files[0];
          fd.append('restaurant_icon',files);
          fd.append('city_name',city_id);
          fd.append('restaurant_name',restaurant_name);
          fd.append('restaurant_phone',phone);
          fd.append('address',address);
     
       $.ajax({ //make ajax request to cart_process.php
          url: "process/restaurant_manager.php",
          type: "POST",
          //dataType:"json", //expect json value from server
          contentType: false,
          processData: false,
          data: fd,
          success: function(dataResult){ //on Ajax success           
             $("#addRestaurantResponse").fadeIn();
            $("#btn_save_restaurant").html('<i class="fas fa-save"></i> Save');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#addRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "restaurants";
               },1000);
            }else if(data.code == 2){
               $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }
          }
       });
     
    }else{
     $(this).trigger('reset');
      $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
    }
   e.preventDefault();
});
 
}
//open edit restaurant page
function toeditRestaurant(id,uid){
  startPreloader();
  $("#content").load("pages/edit_restaurant.php",{id:id,uid:uid});
  $("#page_title1").html('Edit Restaurant');
  $("#page_title2").html('Edit Restaurant');
  $("#btn_to_add").hide();
}
//edit restaurant
function editRest(){
  $("#editRestaurantForm").on('submit',function(e){
   var form_data = $(this).serialize();
    var city_id = $("#ecity_name").val();
    var restaurant_name = $("#erestaurant_name").val();
    var address = $("#eaddress").val();
    var restaurant_id = $("#restaurant_id").val();
//    var pac_input = $("#epac-input").val();
   
   
   
   
   
    if( address !== '' && restaurant_name !== '' && city_id !== '' && restaurant_id !== ''){
      
      $("#ebtn_save_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: "process/restaurant_manager.php",
              type: "POST",
              //dataType:"json", //expect json value from server
              data: form_data
          }).done(function(dataResult){ //on Ajax success
        console.log(dataResult);
             $("#editRestaurantResponse").fadeIn();
            $("#ebtn_save_restaurant").html('<i class="fas fa-save"></i> Save Changes');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#editRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "restaurants";
               },1000);
            }else if(data.code == 2){
               $("#editRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#editRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#editRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#editRestaurantResponse").fadeOut();
              },1500);
            }

       });
     
    }else{
      $("#editRestaurantResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#editRestaurantResponse").fadeOut();
              },1500);
    }
   e.preventDefault();
});
 
}
//add restaurant
function editIcon(){
$("#editIconForm").on('submit',function(e){
 $("#editRestaurantResponse").html('');
 
   var form_data = $(this).serialize();
    var restaurant_id = $("#restaurant_id").val();
  //validate the file
     var file_size = $('#erestaurant_icon')[0].files[0].size;
      var f_size = true;
      var f_type = true;
      var ext = $('#erestaurant_icon').val().split('.').pop().toLowerCase();
      //Allowed file types
      if($.inArray(ext, ['png','jpg','jpeg','PNG','JPG','JPEG']) == -1) {
         f_type = false; 
          $("#editRestaurantResponse").html('<p class="text-center alert alert-danger" style="width:100%;">✖ File type not supported, try png,jpg or jpeg files!</p>');
         $(this).trigger('reset');
          setTimeout(function(){
              $("#editRestaurantResponse").fadeOut(500);
          },800);
      }
    
     if(file_size>3000000) {
          f_size = false;
//                response("File size should not exceed 3mb!");
           $(this).trigger('reset');
                $("#editRestaurantResponse").html('<p class="text-center alert alert-danger" style="width:100%;">✖ File size should not exceed 3mb!</p>');
                    setTimeout(function(){
                    $("#editRestaurantResponse").fadeOut(500);
                },800);
            }
 
    if(f_type == true && f_size == true && restaurant_id !== ''){
      $("#ebtn_save_icon").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
     //add form data
          var fd = new FormData();
          var files = $('#erestaurant_icon')[0].files[0];
          fd.append('erestaurant_icon',files);
          fd.append('erestaurant_id',restaurant_id);     
       $.ajax({ //make ajax request to cart_process.php
          url: "process/restaurant_manager.php",
          type: "POST",
          //dataType:"json", //expect json value from server
          contentType: false,
          processData: false,
          data: fd,
          success: function(dataResult){ //on Ajax success      
             $("#editRestaurantResponse").fadeIn();
            $("#ebtn_save_icon").html('<i class="fas fa-save"></i> Change Icon');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#editRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "restaurants";
               },1000);
            }else if(data.code == 2){
               $("#editRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#editRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#editRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#editRestaurantResponse").fadeOut();
              },1500);
            }
          }
       });
     
    }else{
     $(this).trigger('reset');
      $("#editRestaurantResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#editRestaurantResponse").fadeOut();
              },1500);
    }
   e.preventDefault();
});
 
}



//delete restaurant
function deleteRest(del_id){
  if(del_id !== ''){
   $("#ebtn_delete_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
     $.ajax({ //make ajax request to cart_process.php
          url: "process/restaurant_manager.php",
             type: "POST",
            data: {
                del_id: del_id
            },
            success : function(dataResult){ //on Ajax success
             $("#deleteRestaurantResponse").fadeIn();
            $("#ebtn_delete_restaurant").html('<i class="fas fa-trash"></i> Delete');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#deleteRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "restaurants";
               },1000);
            }else if(data.code == 2){
               $("#deleteRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#deleteRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#deleteRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#deleteRestaurantResponse").fadeOut();
              },1500);
            }
            }
       });
  }else{
     $("#deleteRestaurantResponse").html('<p class="alert alert-danger text-center">Ooops, checking you!</p>');
       setTimeout(function(){
         window.location = "restaurants";
      },1500);
  }
}

//to driver
function toAddDriver(){
  startPreloader();
  $("#content").load("pages/add_driver.php");
  $("#page_title1").html('Add Driver');
  $("#page_title2").html('Add Driver');
  $("#btn_to_add").hide();
}

//add driver
function addDriver(){
$("#addDriverForm").on('submit',function(e){
   var form_data = $(this).serialize();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var password = $("#password").val();
    var city_id = $("#city_name").val();
    if(city_id !== '' && password !== '' && phone !== '' && fname !== '' && lname !== '' ){
      
      $("#btn_save_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: "process/driver_manager.php",
              type: "POST",
              //dataType:"json", //expect json value from server
              data: form_data
          }).done(function(dataResult){ //on Ajax success
         $("#addRestaurantResponse").html('');
             $("#addRestaurantResponse").fadeIn();
            $("#btn_save_restaurant").html('<i class="fas fa-save"></i> Save');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#addRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "drivers";
               },1000);
            }else if(data.code == 2){
               $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }

       });
     
    }else{
      $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
    }
   e.preventDefault();
});
 
}

//open edit driver page
function toeditDriver(id,uid){
  startPreloader();
  $("#content").load("pages/edit_driver.php",{id:id,uid:uid});
  $("#page_title1").html('Edit Driver');
  $("#page_title2").html('Edit Driver');
  $("#btn_to_add").hide();
}
//edit driver
function editDriver(){
$("#editDriverForm").on('submit',function(e){
   var form_data = $(this).serialize();
    var fname = $("#efname").val();
    var lname = $("#elname").val();
    var email = $("#eemail").val();
    var phone = $("#ephone").val();
    var city_id = $("#ecity_name").val();
    var driver_id = $("#driver_id").val();
    if(city_id !== '' && phone !== '' &&  email !== '' && fname !== '' && lname !== '' && driver_id !== '' ){
      
      $("#btn_save_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: "process/driver_manager.php",
              type: "POST",
              //dataType:"json", //expect json value from server
              data: form_data
          }).done(function(dataResult){ //on Ajax success
        console.log(dataResult);
             $("#addRestaurantResponse").fadeIn();
            $("#btn_save_restaurant").html('<i class="fas fa-save"></i> Save');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#addRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "drivers";
               },1000);
            }else if(data.code == 2){
               $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }

       });
     
    }else{
      $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
    }
   e.preventDefault();
});
 
}

//delete Driver
function deleteDriver(del_id){
  if(del_id !== ''){
   $("#ebtn_delete_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
     $.ajax({ //make ajax request to cart_process.php
          url: "process/driver_manager.php",
             type: "POST",
            data: {
                del_id: del_id
            },
            success : function(dataResult){ //on Ajax success
             $("#deleteRestaurantResponse").fadeIn();
            $("#ebtn_delete_restaurant").html('<i class="fas fa-trash"></i> Delete');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#deleteRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "drivers";
               },1000);
            }else if(data.code == 2){
               $("#deleteRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#deleteRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#deleteRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#deleteRestaurantResponse").fadeOut();
              },1500);
            }
            }
       });
  }else{
     $("#deleteRestaurantResponse").html('<p class="alert alert-danger text-center">Ooops, checking you!</p>');
       setTimeout(function(){
         window.location = "drivers";
      },1500);
  }
}
//account status
function accountStatusDriver(status_id){
  if(status_id !== ''){
   $("#ebtn_status_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
     $.ajax({ //make ajax request to cart_process.php
          url: "process/driver_manager.php",
             type: "POST",
            data: {
                status_id: status_id
            },
            success : function(dataResult){ //on Ajax success
             $("#statusRestaurantResponse").fadeIn();
            $("#ebtn_status_restaurant").html('<i class="fas fa-trash"></i> Yes');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#statusBtn").html(data.status);
               $("#statusRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               $("#statusBtn").html(data.btnMessage);
               setTimeout(function(){
                 $("#logoutModal2").modal('toggle');
                $("#statusRestaurantResponse").fadeOut();
               },1000);
            }else if(data.code == 2){
               $("#statusRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#statusRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#statusRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#statusRestaurantResponse").fadeOut();
              },1500);
            }
            }
       });
  }else{
     $("#statusRestaurantResponse").html('<p class="alert alert-danger text-center">Ooops, checking you!</p>');
       setTimeout(function(){
         window.location = "drivers";
      },1500);
  }
}

//to admin
function toAddAdmin(){
  startPreloader();
  $("#content").load("pages/add_admin.php");
  $("#page_title1").html('Add Admin');
  $("#page_title2").html('Add Admin');
  $("#btn_to_add").hide();
}

//add admin
function addAdmin(){
$("#addAdminForm").on('submit',function(e){
   var form_data = $(this).serialize();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var password = $("#password").val();
    var city_id = $("#city_name").val();
    var access_level = $("#access_level").val();
    if(city_id !== '' && password !== '' && phone !== '' && fname !== '' && lname !== '' && access_level !== '' ){
      
      $("#btn_save_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: "process/admin_manager.php",
              type: "POST",
              //dataType:"json", //expect json value from server
              data: form_data
          }).done(function(dataResult){ //on Ajax success
             $("#addRestaurantResponse").html('');
             $("#addRestaurantResponse").fadeIn();
            $("#btn_save_restaurant").html('<i class="fas fa-save"></i> Save');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#addRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "admins";
               },1000);
            }else if(data.code == 2){
               $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }

       });
     
    }else{
      $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
    }
   e.preventDefault();
});
 
}

//open edit driver page
function toEditAdmin(id,uid){
  startPreloader();
  $("#content").load("pages/edit_admin.php",{id:id,uid:uid});
  $("#page_title1").html('Edit Admin');
  $("#page_title2").html('Edit Admin');
  $("#btn_to_add").hide();
}
//edit admin
function editAdmin(){
$("#editAdminForm").on('submit',function(e){
   var form_data = $(this).serialize();
    var fname = $("#efname").val();
    var lname = $("#elname").val();
    var email = $("#eemail").val();
    var phone = $("#ephone").val();
    var city_id = $("#ecity_name").val();
    var access_level = $("#eaccess_level").val();
    var admin_id = $("#admin_id").val();
    if(city_id !== '' && phone !== '' &&  email !== '' && fname !== '' && lname !== '' && admin_id !== '' && access_level !== ''){
      
      $("#btn_save_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: "process/admin_manager.php",
              type: "POST",
              //dataType:"json", //expect json value from server
              data: form_data
          }).done(function(dataResult){ //on Ajax success
             $("#addRestaurantResponse").fadeIn();
            $("#btn_save_restaurant").html('<i class="fas fa-save"></i> Save');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#addRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "admins";
               },1000);
            }else if(data.code == 2){
               $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }

       });
     
    }else{
      $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
    }
   e.preventDefault();
});
 
}

//delete admin
function deleteAdmin(del_id){
  if(del_id !== ''){
   $("#ebtn_delete_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
     $.ajax({ //make ajax request to cart_process.php
          url: "process/admin_manager.php",
             type: "POST",
            data: {
                del_id: del_id
            },
            success : function(dataResult){ //on Ajax success
             $("#deleteRestaurantResponse").fadeIn();
            $("#ebtn_delete_restaurant").html('<i class="fas fa-trash"></i> Delete');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#deleteRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "admins";
               },1000);
            }else if(data.code == 2){
               $("#deleteRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#deleteRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#deleteRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#deleteRestaurantResponse").fadeOut();
              },1500);
            }
            }
       });
  }else{
     $("#deleteRestaurantResponse").html('<p class="alert alert-danger text-center">Ooops, checking you!</p>');
       setTimeout(function(){
         window.location = "admins";
      },1500);
  }
}
//account status
function accountStatusAdmin(status_id){
  if(status_id !== ''){
   $("#ebtn_status_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
     $.ajax({ //make ajax request to cart_process.php
          url: "process/admin_manager.php",
             type: "POST",
            data: {
                status_id: status_id
            },
            success : function(dataResult){ //on Ajax success
             $("#statusRestaurantResponse").fadeIn();
            $("#ebtn_status_restaurant").html('<i class="fas fa-trash"></i> Yes');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#statusBtn").html(data.status);
               $("#statusRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               $("#statusBtn").html(data.btnMessage);
               setTimeout(function(){
                 $("#logoutModal2").modal('toggle');
                $("#statusRestaurantResponse").fadeOut();
               },1000);
            }else if(data.code == 2){
               $("#statusRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#statusRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#statusRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#statusRestaurantResponse").fadeOut();
              },1500);
            }
            }
       });
  }else{
     $("#statusRestaurantResponse").html('<p class="alert alert-danger text-center">Ooops, checking you!</p>');
       setTimeout(function(){
         window.location = "admins";
      },1500);
  }
}

//profile update
function updatePersonalDetails(){
$("#personaldetailsForm").on('submit',function(e){
   var form_data = $(this).serialize();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var personal_id = $("#personal_id").val();
    if(personal_id !== '' && phone !== '' && fname !== '' && lname !== '' && email !== '' ){
      
      $("#btn_personal_details").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: "process/profile_manager.php",
              type: "POST",
              //dataType:"json", //expect json value from server
              data: form_data
          }).done(function(dataResult){ //on Ajax success
             $("#personalDetailsResponse").html('');
             $("#personalDetailsResponse").fadeIn();
            $("#btn_personal_details").html(' Save Changes');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#personalDetailsResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "profile";
               },1000);
            }else if(data.code == 2){
               $("#personalDetailsResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#personalDetailsResponse").fadeOut();
              },1500);
            }else{
              $("#personalDetailsResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#personalDetailsResponse").fadeOut();
              },1500);
            }

       });
     
    }else{
      $("#personalDetailsResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#personalDetailsResponse").fadeOut();
              },1500);
    }
   e.preventDefault();
});
 
}
//password update
function updatePassword(){
$("#passwordForm").on('submit',function(e){
   var form_data = $(this).serialize();
    var cpass = $("#cpass").val();
    var npass = $("#npass").val();
    var pass_id = $("#pass_id").val();
     var cnpass = $("#cnpass").val();
 if(npass !== cnpass){
      $("#passwordDetailsResponse").html('<p class="alert alert-danger text-center">New password and confirm do not match!</p>');
               setTimeout(function(){
                  $("#passwordDetailsResponse").fadeOut();
              },1500);
 }else{
        if(pass_id !== '' && cpass !== '' && npass !== '' ){
      
      $("#btn_password_details").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: "process/profile_manager.php",
              type: "POST",
              //dataType:"json", //expect json value from server
              data: form_data
          }).done(function(dataResult){ //on Ajax success
             $("#passwordDetailsResponse").html('');
             $("#passwordDetailsResponse").fadeIn();
            $("#btn_password_details").html(' Save Changes');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#passwordDetailsResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "profile";
               },1000);
            }else if(data.code == 2){
               $("#passwordDetailsResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#passwordDetailsResponse").fadeOut();
              },1500);
            }else{
              $("#passwordDetailsResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#passwordDetailsResponse").fadeOut();
              },1500);
            }

       });
     
    }else{
      $("#passwordDetailsResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#passwordDetailsResponse").fadeOut();
              },1500);
    }
 }
 
 
 

   e.preventDefault();
});
 
}
//profile picture
function upload1(){
  $("#pictureForm").on('submit',function(e){
     $("#dp1DetailsResponse").html('');
    $("#dp1DetailsResponse").fadeIn(500);
    
      var profile_id = $("#profile_id").val();
      var file_size = $('#profile1')[0].files[0].size;
      var f_size = true;
      var f_type = true;
      var ext = $('#profile1').val().split('.').pop().toLowerCase();
      //Allowed file types
      if($.inArray(ext, ['png','jpg','jpeg','PNG','JPG','JPEG']) == -1) {
         f_type = false; 
          $("#profileChange").hide();
          $("#dp1DetailsResponse").html('<p class="text-center alert alert-danger" style="width:100%;">✖ File type not supported, try png,jpg or jpeg files!</p>');
          setTimeout(function(){
              $("#dp1DetailsResponse").fadeOut(500);
          },800);
      }
    
          if(file_size>3000000) {

                f_size = false;
//                response("File size should not exceed 3mb!");
                $("#dp1DetailsResponse").html('<p class="text-center alert alert-danger" style="width:100%;">✖ File size should not exceed 3mb!</p>');
                    setTimeout(function(){
                    $("#dp1DetailsResponse").fadeOut(500);
                },800);
            }

      if(f_type == true && f_size == true && profile_id !==''){
         $("#btn_prof_details").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
          var fd = new FormData();
          var files = $('#profile1')[0].files[0];
          fd.append('profile1',files);
            fd.append('profile_id',profile_id);
          $.ajax({
              url: 'process/dp_manager.php',
              type: 'post',
              data: fd,
              contentType: false,
              processData: false,
              success: function(data){
//                        alert(data);
                    $("#dp1DetailsResponse").fadeIn(500);
                $("#btn_prof_details").html("Upload");
                  var dataResult = JSON.parse(data);
                  if(dataResult.code == 1){
                   $("#dp1DetailsResponse").html('<span class="text-center alert alert-success" style="width:100%;">Success</span>');
                      $("#img").attr('src','uploads/'+dataResult.msg); 
                      $("#image_name").val(dataResult.msg); 
//                            $("#img").show(); // Display image element
                  }else{
                      $("#profileChange").hide();
//                            alert('file not uploaded');
                      $("#dp1DetailsResponse").html('<span class="text-center alert alert-danger" style="width:100%;">'+dataResult.msg+'</span>'); 

                  }
              },
          });
      }else{
          setTimeout(function(){
              $("#dp1DetailsResponse").fadeOut(500);
          },800);
          $("#dp1DetailsResponse").html('<span class="text-center alert alert-danger" style="width:100%;">✖ File type is invalid or size exceeds 3mb!</span>'); 
          $("#profileChange").hide();
      }
      e.preventDefault();
  });
  
}

//restaurant managers
//to manager
function toAddManager(){
  startPreloader();
  $("#content").load("pages/add_manager.php");
  $("#page_title1").html('Add Manager');
  $("#page_title2").html('Add Manager');
  $("#btn_to_add").hide();
}

//add manager
function addManager(){
$("#addDriverForm").on('submit',function(e){
   var form_data = $(this).serialize();
    var fname = $("#fname").val();
    var lname = $("#lname").val();
    var email = $("#email").val();
    var phone = $("#phone").val();
    var password = $("#password").val();
    var city_id = $("#city_name").val();
    var rest_id = $("#rest_name").val();
    if(city_id !== '' && password !== '' && phone !== '' && fname !== '' && lname !== '' && rest_id !=='' ){
      
      $("#btn_save_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: "process/manager_manager.php",
              type: "POST",
              //dataType:"json", //expect json value from server
              data: form_data
          }).done(function(dataResult){ //on Ajax success
         $("#addRestaurantResponse").html('');
             $("#addRestaurantResponse").fadeIn();
            $("#btn_save_restaurant").html('<i class="fas fa-save"></i> Save');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#addRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "restaurant_managers";
               },1000);
            }else if(data.code == 2){
               $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }

       });
     
    }else{
      $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
    }
   e.preventDefault();
});
 
}

//open edit manager page
function toeditManager(id,uid){
  startPreloader();
  $("#content").load("pages/edit_manager.php",{id:id,uid:uid});
  $("#page_title1").html('Edit Manager');
  $("#page_title2").html('Edit Manager');
  $("#btn_to_add").hide();
}
//edit manager
function editManager(){
$("#editDriverForm").on('submit',function(e){
   var form_data = $(this).serialize();
    var fname = $("#efname").val();
    var lname = $("#elname").val();
    var email = $("#eemail").val();
    var phone = $("#ephone").val();
    var city_id = $("#ecity_name").val();
    var driver_id = $("#driver_id").val();
    var rest_id = $("#erest_name").val();
    if(city_id !== '' && phone !== '' &&  email !== '' && fname !== '' && lname !== '' && driver_id !== '' && rest_id !== ''){
      
      $("#btn_save_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: "process/manager_manager.php",
              type: "POST",
              //dataType:"json", //expect json value from server
              data: form_data
          }).done(function(dataResult){ //on Ajax success
        console.log(dataResult);
             $("#addRestaurantResponse").fadeIn();
            $("#btn_save_restaurant").html('<i class="fas fa-save"></i> Save');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#addRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "restaurant_managers";
               },1000);
            }else if(data.code == 2){
               $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
            }

       });
     
    }else{
      $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
    }
   e.preventDefault();
});
 
}

//delete manager
function deleteManager(del_id){
  if(del_id !== ''){
   $("#ebtn_delete_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
     $.ajax({ //make ajax request to cart_process.php
          url: "process/driver_manager.php",
             type: "POST",
            data: {
                del_id: del_id
            },
            success : function(dataResult){ //on Ajax success
             $("#deleteRestaurantResponse").fadeIn();
            $("#ebtn_delete_restaurant").html('<i class="fas fa-trash"></i> Delete');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#deleteRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "restaurant_managers";
               },1000);
            }else if(data.code == 2){
               $("#deleteRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#deleteRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#deleteRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#deleteRestaurantResponse").fadeOut();
              },1500);
            }
            }
       });
  }else{
     $("#deleteRestaurantResponse").html('<p class="alert alert-danger text-center">Ooops, checking you!</p>');
       setTimeout(function(){
         window.location = "restaurant_managers";
      },1500);
  }
}
//account status
function accountStatusManager(status_id){
  if(status_id !== ''){
   $("#ebtn_status_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
     $.ajax({ //make ajax request to cart_process.php
          url: "process/manager_manager.php",
             type: "POST",
            data: {
                status_id: status_id
            },
            success : function(dataResult){ //on Ajax success
             $("#statusRestaurantResponse").fadeIn();
            $("#ebtn_status_restaurant").html('<i class="fas fa-trash"></i> Yes');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#statusBtn").html(data.status);
               $("#statusRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               $("#statusBtn").html(data.btnMessage);
               setTimeout(function(){
                 $("#logoutModal2").modal('toggle');
                $("#statusRestaurantResponse").fadeOut();
               },1000);
            }else if(data.code == 2){
               $("#statusRestaurantResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#statusRestaurantResponse").fadeOut();
              },1500);
            }else{
              $("#statusRestaurantResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#statusRestaurantResponse").fadeOut();
              },1500);
            }
            }
       });
  }else{
     $("#statusRestaurantResponse").html('<p class="alert alert-danger text-center">Ooops, checking you!</p>');
       setTimeout(function(){
         window.location = "restaurant_managers";
      },1500);
  }
}

//show/hide form edit restaurant
function morem(){
  $("#less").fadeOut(500);
  $("#more").fadeIn(500);
}

function lessm(){
  $("#less").fadeIn(500);
  $("#more").fadeOut(500);
}

//RESETTING PASSWORD
function openResetPage(){
 $("#title").html("Password Reset");
  $("#formCont").load('pages/resetpassword1.php');
}

function next(email){
  $("#formCont").load('pages/resetpassword2.php',{email:email});
}

function next2(email){
  $("#formCont").load('pages/resetpassword3.php',{email:email});
}

//resetpassword
function sendResetEmail(){
$("#resetForm1").on('submit',function(e){
   var form_data = $(this).serialize();

    var email = $("#reset_email").val();
    
    if(email !=='' ){
      
      $("#reset1").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: "process/password_reset_manager.php",
              type: "POST",
              //dataType:"json", //expect json value from server
              data: form_data
          }).done(function(dataResult){ //on Ajax success
         $("#reset1Response").html('');
             $("#reset1Response").fadeIn();
            $("#reset1").html('Next');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#reset1Response").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 next(email);
               },1000);
            }else if(data.code == 2){
               $("#reset1Response").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#reset1Response").fadeOut();
              },1500);
            }else{
              $("#reset1Response").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#reset1Response").fadeOut();
              },1500);
            }

       });
     
    }else{
      $("#reset1Response").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#reset1Response").fadeOut();
              },1500);
    }
   e.preventDefault();
});
 
}

function checkCode(){
   $("#resetForm2").on('submit',function(e){
   var form_data = $(this).serialize();

    var email = $("#cemail").val();
    var code = $("#code").val();
    if(email !=='' && code !== ''){
      
      $("#reset2Btn").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: "process/password_reset_manager.php",
              type: "POST",
              //dataType:"json", //expect json value from server
              data: form_data
          }).done(function(dataResult){ //on Ajax success
         $("#reset2Response").html('');
             $("#reset2Response").fadeIn();
            $("#reset2Btn").html('Next');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#reset2Response").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 next2(email);
               },1000);
            }else if(data.code == 2){
               $("#reset2Response").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#reset2Response").fadeOut();
              },1500);
            }else{
              $("#reset2Response").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#reset2Response").fadeOut();
              },1500);
            }

       });
     
    }else{
      $("#reset2Response").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#reset2Response").fadeOut();
              },1500);
    }
   e.preventDefault();
});
 
}

function resetFinish(){
    $("#resetForm3").on('submit',function(e){
   var form_data = $(this).serialize();

    var email = $("#remail").val();
    var pass1 = $("#pass1").val();
    var pass2 = $("#pass2").val();
 if(email !=='' && pass1 !== '' && pass2 !== ''){
    if(pass1 === pass2){
      $("#reset3Btn").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: "process/password_reset_manager.php",
              type: "POST",
              //dataType:"json", //expect json value from server
              data: form_data
          }).done(function(dataResult){ //on Ajax success
         $("#reset3Response").html('');
             $("#reset3Response").fadeIn();
            $("#reset2Btn").html('Next');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#reset3Response").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "login";
               },1000);
            }else if(data.code == 2){
               $("#reset3Response").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
              setTimeout(function(){
                  $("#reset3Response").fadeOut();
              },1500);
            }else{
              $("#reset3Response").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
               setTimeout(function(){
                  $("#reset3Response").fadeOut();
              },1500);
            }

       });
     }else{
        $("#reset3Response").html('<p class="alert alert-danger text-center">Passwords do not match</p>');
       setTimeout(function(){
         $("#reset3Response").fadeOut();
       },1500);
     }
  
    }else{
      $("#reset3Response").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#reset3Response").fadeOut();
              },1500);
    }
   e.preventDefault();
});
 
}










function startPreloader(){
 
    preloader = new $.materialPreloader({
        position: 'top',
        height: '8px',
        col_1: '#159756',
        col_2: '#da4733',
        col_3: '#3b78e7',
        col_4: '#fdba2c',
        fadeIn: 200,
        fadeOut: 200
    });
    preloader.on();
   openNav();
}

function openNav() {
  document.getElementById("myNav").style.height = "100%";
}

function closeNav() {
  document.getElementById("myNav").style.height = "0%";
}

function setCookie(name,value,days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days*24*60*60*1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "")  + expires + "; path=/";
}
function getCookie(name) {
    var nameEQ = name + "=";
    var ca = document.cookie.split(';');
    for(var i=0;i < ca.length;i++) {
        var c = ca[i];
        while (c.charAt(0)==' ') c = c.substring(1,c.length);
        if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length,c.length);
    }
    return null;
}
function eraseCookie(name) {   
    document.cookie = name +'=; Path=/; Expires=Thu, 01 Jan 1970 00:00:01 GMT;';
}

function isNumberKey(evt){
         var charCode = (evt.which) ? evt.which : event.keyCode
         if (charCode > 31 && (charCode < 48 || charCode > 57))
            return false;

         return true;
      }
//needs to be empty
 function initMap() {}
