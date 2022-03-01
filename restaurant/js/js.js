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

//to meal
function toAddMeal(){
  startPreloader();
  $("#content").load("pages/add_meal.php");
  $("#page_title1").html('Add Meal');
  $("#page_title2").html('Add Meal');
  $("#btn_to_add").hide();
}

//add meal
function addMeal(){
$("#addDriverForm").on('submit',function(e){
  $("#addRestaurantResponse").html('');
 $("#addRestaurantResponse").fadeIn();
    var meal_name = $("#meal_name").val();
//    var meal_price = $("#meal_price").val();
    var prep_mins = $("#prep_mins").val();
    var delivery_fee = $("#delivery_fee").val();
    var rest_id = $("#rest_id").val();
 
   var addons = $('input[name="meal_add_on"]:checked').val();
   var meal_type = $('input[name="meal_type"]:checked').val();
   
    if(delivery_fee !== '' && prep_mins !== '' && meal_name !== '' && rest_id !== '' ){
      var form_data = new FormData(this); //Creates new FormData object
       
      $("#btn_save_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: 'process/meal_manager.php',
          type: 'post',
          data : form_data,
          contentType: false,
          cache: false,
          processData:false,
          success: function(dataResult){ //on Ajax success
         $("#addRestaurantResponse").html('');
             $("#addRestaurantResponse").fadeIn();
            $("#btn_save_restaurant").html('<i class="fas fa-save"></i> Save');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#addRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "meals";
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
              },
       });
     
    }else{
      $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
    }
   e.preventDefault();
   e.stopImmediatePropagation();
});
 
}


//FOR ADDONS
//add row
function add_row(){
  $rowno=$("#meals_container div").length;
  $rowno=$rowno+1;
  $("#meals_container div:last").after("<div id='rowMeals"+$rowno+"'><input type='text' placeholder='Name' class='form-control m-2' id='addonName' name='addonName[]' required /><input type='text' onkeypress='return isNumberKey(event)' placeholder='Price(MWK)' class='form-control m-2' id='addonPrice' name='addonPrice[]' required />                  <button onclick=delete_row('rowMeals"+$rowno+"') type='button' class='btn btn-sm btn-danger m-2 text-light'><i class='fas fa-times'></i></button></div>");
 }
//delete row
function delete_row(rowno){
 $('#'+rowno).remove();
}
//change option
function showAddOns(){
 $("#all_options").html('');
 $("#all_options").show();
  $("#all_options").html('<div class="form-inline"><input type="text" min="0" onkeypress="return isNumberKey(event)" class="form-control" data-bv-field="fullName" id="meal_price" name="meal_price" required placeholder="Meal Price" /></div><div class="form-group mt-2"><label for="fullName">Addons</label><input type="hidden"  field="fullName" /><div/><div class="form-inline" id="meals_container"><div id="rowMeals1">                    <input type="text" placeholder="Name" class="form-control m-2" id="addonName" name="addonName[]" required /><input type="text" onkeypress="return isNumberKey(event)" placeholder="Price(MWK)" class="form-control m-2" id="addonPrice" name="addonPrice[]" required /></div></div><button onclick="add_row()" type="button" class="btn btn-sm btn-success m-2 text-light"><i class="fas fa-plus"></i> More Options</button>');
}
//change option
function removeAddOns(){
  $("#all_options").html('');
  $("#all_options").show();
  $("#all_options").html('<div class="form-inline"> <input type="text" min="0" onkeypress="return isNumberKey(event)" class="form-control" data-bv-field="fullName" id="meal_price" name="meal_price" required placeholder="Meal Price" /></div>');
}

//FOR MEAL SIZES
//add row
function add_meal_size_row(){
  $rowno=$("#meals_container_size div").length;
  $rowno=$rowno+1;
  $("#meals_container_size div:last").after("<div id='rowMealSize"+$rowno+"'><input type='text' placeholder='Name' class='form-control m-2' id='sizeName' name='sizeName[]' required /><input type='text' onkeypress='return isNumberKey(event)' placeholder='Price(MWK)' class='form-control m-2' id='sizePrice' name='sizePrice[]' required />                  <button onclick=delete_meal_size_row('rowMealSize"+$rowno+"') type='button' class='btn btn-sm btn-danger m-2 text-light'><i class='fas fa-times'></i></button></div>");
 }
//delete row
function delete_meal_size_row(rowno){
 $('#'+rowno).remove();
}
//change option
function showSizes(){
 $("#all_meal_size_options").html('');
 $("#all_meal_size_options").show();
  $("#all_meal_size_options").html('<div class="form-inline" id="meals_container_size"><div id="rowMealSize1">                    <input type="text" placeholder="Large" class="form-control m-2" id="sizeName" name="sizeName[]" required /><input type="text" onkeypress="return isNumberKey(event)" placeholder="Price(MWK)" class="form-control m-2" id="sizePrice" name="sizePrice[]" required /></div></div><button onclick="add_meal_size_row()" type="button" class="btn btn-sm btn-success m-2 text-light"><i class="fas fa-plus"></i> More </button>');
}
//change option
function removeSizes(){
  $("#all_meal_size_options").html('');
  $("#all_meal_size_options").show();

}




//EDIT MEAL
//ROW STUFF ADDONS
function eadd_row(){
  $rowno=$("#meals_container div").length;
  $rowno=$rowno+1;
  $("#meals_container div:last").after("<div id='rowMeals"+$rowno+"'><input type='text' placeholder='Name' class='form-control m-2' id='eaddonName' name='eaddonName[]' required /><input type='text' onkeypress='return isNumberKey(event)' placeholder='Price(MWK)' class='form-control m-2' id='addonPrice' name='eaddonPrice[]' required />                  <button onclick=edelete_row('rowMeals"+$rowno+"') type='button' class='btn btn-sm btn-danger m-2 text-light'><i class='fas fa-times'></i></button></div>");
   if($rowno === 1){
      $("#dx").html('Normal');
      $('input[name="meal_add_on"]').val(1);
   }else{
      $("#dx").html('Multiple');
     $('input[name="meal_add_on"]').val(2);
   }
 
 }

function edelete_row(rowno){
 
 $('#'+rowno).remove();
 $rowno=$("#meals_container div").length;
 if($rowno === 1){
    $('input[name="meal_add_on"]').val(1);
    $("#dx").html('Normal');
 }else{
    $('input[name="meal_add_on"]').val(2);
    $("#dx").html('Multiple');
 }
}
//open edit meal page
function toeditMeal(id){
 
  startPreloader();
  $("#content").load("pages/edit_meal.php",{id:id});
  $("#page_title1").html('Edit Meal');
  $("#page_title2").html('Edit Meal');
  $("#btn_to_add").hide();
}

//ROW STUFF MEAL SIZES
function esadd_row(){
  $rowno=$("#smeals_container div").length;
  $rowno=$rowno+1;
  $("#smeals_container div:last").after("<div id='srowMeals"+$rowno+"'><input type='text' placeholder='Name' class='form-control m-2' id='esizeName' name='esizeName[]' required /><input type='text' onkeypress='return isNumberKey(event)' placeholder='Price(MWK)' class='form-control m-2' id='esizePrice' name='esizePrice[]' required />                  <button onclick=esdelete_row('srowMeals"+$rowno+"') type='button' class='btn btn-sm btn-danger m-2 text-light'><i class='fas fa-times'></i></button></div>");
   if($rowno === 1){
      $("#sdx").html('Normal');
      $('input[name="meal_size"]').val(1);
   }else{
      $("#sdx").html('Multiple');
     $('input[name="meal_size"]').val(2);
   }
 
 }

function esdelete_row(rowno){
 $('#'+rowno).remove();
 $rowno=$("#smeals_container div").length;
 if($rowno === 1){
    $('input[name="meal_size"]').val(1);
    $("#sdx").html('Normal');
 }else{
    $('input[name="meal_size"]').val(2);
    $("#sdx").html('Multiple');
 }
}


//open edit meal page
function toeditMeal(id){
 
  startPreloader();
  $("#content").load("pages/edit_meal.php",{id:id});
  $("#page_title1").html('Edit Meal');
  $("#page_title2").html('Edit Meal');
  $("#btn_to_add").hide();
}

//edit meal
function editMeal(){
$("#addDriverForm").on('submit',function(e){
  $("#addRestaurantResponse").html('');
    var meal_name = $("#emeal_name").val();
    var meal_price = $("#emeal_price").val();
    var prep_mins = $("#eprep_mins").val();
    var delivery_fee = $("#edelivery_fee").val();
    var meal_id = $("#meal_id").val();
    var eavailability = $("#eavailability").val();
      

    if(delivery_fee !== '' && prep_mins !== '' && meal_name !== '' && meal_price !== '' && meal_id !== '' && eavailability !== ''){
      
//       var fd = new FormData();
//       var files = $('#emeal_picture')[0].files[0];
//       fd.append('emeal_name',meal_name);
//       fd.append('emeal_price',meal_price);
//       fd.append('eprep_mins',prep_mins);
//       fd.append('edelivery_fee',delivery_fee);
//       fd.append('emeal_id',meal_id);
//       fd.append('eavailability',eavailability);
//      fd.append('emeal_picture',files);
     
     var form_data = new FormData(this); //Creates new FormData object
     
      $("#btn_save_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
       $.ajax({ //make ajax request to cart_process.php
          url: 'process/meal_manager.php',
          type: 'post',
          data : form_data,
          contentType: false,
          cache: false,
          processData:false,
          success: function(dataResult){ //on Ajax success
           console.log(dataResult);
         $("#addRestaurantResponse").html('');
             $("#addRestaurantResponse").fadeIn();
            $("#btn_save_restaurant").html('<i class="fas fa-save"></i> Save');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#addRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "meals";
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
              },
       });
     
    }else{
      $("#addRestaurantResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
       setTimeout(function(){
                  $("#addRestaurantResponse").fadeOut();
              },1500);
    }
   e.preventDefault();
   e.stopImmediatePropagation();
});
 
}

//delete meal
function deleteMeal(del_meal){
  if(del_meal !== ''){
   $("#ebtn_delete_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
     $.ajax({ //make ajax request to cart_process.php
          url: "process/meal_manager.php",
             type: "POST",
            data: {
                del_meal: del_meal
            },
            success : function(dataResult){ //on Ajax success
             $("#deleteRestaurantResponse").fadeIn();
            $("#ebtn_delete_restaurant").html('<i class="fas fa-trash"></i> Delete');
            var data = JSON.parse(dataResult);
            if(data.code == 1){
               $("#deleteRestaurantResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
               setTimeout(function(){
                 window.location = "meals";
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
         window.location = "meals";
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
    var cnpass = $("#cnpass").val();
    var pass_id = $("#pass_id").val();
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

//profile edit
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

//to add restaurant information
function toAddRestInfo(){
     startPreloader();
  $("#content").load("pages/add_rest_info.php");
  $("#page_title1").html('Add Restaurant Info.');
  $("#page_title2").html('Add Restaurant Info.');
}

//to add restaurant coordinates
function toAddRestCoordinates(){
     startPreloader();
  $("#content").load("pages/add_rest_coordinates.php");
  $("#page_title1").html('Add Restaurant Coordinates');
  $("#page_title2").html('Add Restaurant Coordinates');
}

//check if location was added
function checkRestLocation(){
   var uidCheck  = $("#uid").val();
    if(uidCheck !=''){
        //start preloader
		startPreloader();
        $.ajax({
            url:'process/check_location.php',
            method:"POST",  
            data:{
                uidCheck:uidCheck
                
            },  
            dataType:"text",  
            success:function(dataresult){ 
                //remove preloader
                preloader.off();
      	         closeNav();
                var data = JSON.parse(dataresult);
               if(data.code == 1){
                   $("#confirmAdd").modal('toggle');
                   $("#dataRequests").html(data.msg);
                    $("#notify").html('<i class="text-light" data-toggle="modal" data-target="#confirmAdd"><span class="fas fa-bell"></span> ('+data.count+')</i>');
               }
            }  
        });
    }
}
//dismiss warning modal
function dismissModal(){
     $("#confirmAdd").modal('toggle');
}
//add restaurant location
function addRestInfo(){
    $("#addRestLocationForm").on('submit',function(e){
       var form_data = $(this).serialize();
        var rest_id = $("#rest_id").val();
        var pac_input = $("#pac-input").val();
        var latitude = $("#latitude").val();
        var longtude = $("#longtude").val();
        var place_id = $("#place_id").val();
       $("#addLocationResponse").html('');
        if(rest_id !== '' && pac_input !== '' && latitude !== '' && longtude !== '' && latitude !== '' && place_id !== '' ){

          $("#btn_location_google").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
           $.ajax({ //make ajax request to cart_process.php
              url: "process/location_manager.php",
                  type: "POST",
                  //dataType:"json", //expect json value from server
                  data: form_data
              }).done(function(dataResult){ //on Ajax success
                 
                 $("#addLocationResponse").fadeIn();
                $("#btn_location_google").html('<i class="fas fa-save"></i> Save');
                var data = JSON.parse(dataResult);
                if(data.code == 1){
                   $("#addLocationResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
                   setTimeout(function(){
                     window.location = "restaurant_info";
                   },1000);
                }else if(data.code == 2){
                   $("#addLocationResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
                  setTimeout(function(){
                      $("#addLocationResponse").fadeOut();
                  },1500);
                }else{
                  $("#addLocationResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
                   setTimeout(function(){
                      $("#addLocationResponse").fadeOut();
                  },1500);
                }

           });

        }else{
          $("#addLocationResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
           setTimeout(function(){
                      $("#addLocationResponse").fadeOut();
                  },1500);
        }
       e.preventDefault();
    });
}
//edit restaurant information
function editRestInfo(){
    $("#editRestInfoForm").on('submit',function(e){
       var form_data = $(this).serialize();
        var rest_id = $("#rest_id").val();
        var rest_name = $("#rest_name").val();
        var city_id = $("#city_id").val();
        var postal_location = $("#postal_location").val();
     
       $("#editRestaurantInfoResponse").html('');
        if(rest_id !== '' && rest_name !== '' && city_id !== '' && postal_location !== ''){

          $("#btn_save_restaurant").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
           $.ajax({ //make ajax request to cart_process.php
              url: "process/location_manager.php",
                  type: "POST",
                  //dataType:"json", //expect json value from server
                  data: form_data
              }).done(function(dataResult){ //on Ajax success
                 $("#editRestaurantInfoResponse").fadeIn();
                $("#btn_save_restaurant").html('<i class="fas fa-save"></i> Save');
                var data = JSON.parse(dataResult);
                if(data.code == 1){
                   $("#editRestaurantInfoResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
                   setTimeout(function(){
                     window.location = "restaurant_info";
                   },1000);
                }else if(data.code == 2){
                   $("#editRestaurantInfoResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
                  setTimeout(function(){
                      $("#editRestaurantInfoResponse").fadeOut();
                  },1500);
                }else{
                  $("#editRestaurantInfoResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
                   setTimeout(function(){
                      $("#editRestaurantInfoResponse").fadeOut();
                  },1500);
                }

           });

        }else{
          $("#editRestaurantInfoResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
           setTimeout(function(){
                      $("#editRestaurantInfoResponse").fadeOut();
                  },1500);
        }
       e.preventDefault();
    });
}

//manual coordinates
function saveCoordinates(){
   $("#addCoordinatesForm").on('submit',function(e){
       var form_data = $(this).serialize();
        var rest_id = $("#rest_id").val();
        var longtude = $("#longtude").val();
        var latitude = $("#latitude").val();
        var place_id = $("#place_id").val();
        var location = $("#location").val();
     
       $("#addRestaurantCoordResponse").html('');
        if(rest_id !== '' && longtude !== '' && latitude !== '' && place_id !== '' && location !== ''){

          $("#btn_coordinates").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
           $.ajax({ //make ajax request to cart_process.php
              url: "process/location_manager.php",
                  type: "POST",
                  //dataType:"json", //expect json value from server
                  data: form_data
              }).done(function(dataResult){ //on Ajax success
                 $("#addRestaurantCoordResponse").fadeIn();
                $("#btn_coordinates").html('<i class="fas fa-save"></i> Save');
                var data = JSON.parse(dataResult);
                if(data.code == 1){
                   $("#addRestaurantCoordResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
                   setTimeout(function(){
                     window.location = "restaurant_info";
                   },1000);
                }else if(data.code == 2){
                   $("#addRestaurantCoordResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
                  setTimeout(function(){
                      $("#addRestaurantCoordResponse").fadeOut();
                  },1500);
                }else{
                  $("#addRestaurantCoordResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
                   setTimeout(function(){
                      $("#addRestaurantCoordResponse").fadeOut();
                  },1500);
                }

           });

        }else{
          $("#addRestaurantCoordResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
           setTimeout(function(){
                      $("#addRestaurantCoordResponse").fadeOut();
                  },1500);
        }
       e.preventDefault();
    });
}


//assign to orders
function toViewOrder(id){
    startPreloader();
  $("#page_title1").html('View Order');
  $("#page_title2").html('View Order');
  $("#content").load("pages/view_order.php",{id:id});

}

//assign driver to an order
function assignDriver(){
     $("#assignDriverForm").on('submit',function(e){
       var form_data = $(this).serialize();
        var driver_assign_id = $("#driver_assign_id").val();
        var assigner = $("#assigner").val();
        var order = $("#order").val();
       $("#assignDriverResponse").html('');
        if(driver_assign_id !== '' && assigner !=='' && order !==''){

          $("#assignDriverBtn").html('<span class="spinner-border spinner-border-sm text-light" role="status" aria-hidden="true"></span> Processing...');
           $.ajax({ //make ajax request to cart_process.php
              url: "process/driver_assign_manager.php",
                  type: "POST",
                  //dataType:"json", //expect json value from server
                  data: form_data
              }).done(function(dataResult){ //on Ajax success
            console.log(dataResult);
                 $("#assignDriverResponse").fadeIn();
                $("#assignDriverBtn").html('<i class="fas fa-save"></i> Save');
                var data = JSON.parse(dataResult);
                if(data.code == 1){
                   $("#assignDriverResponse").html('<p class="alert alert-success text-center">'+data.msg+'</p>');
                   setTimeout(function(){
                     window.location = "orders";
                   },1000);
                }else if(data.code == 2){
                   $("#assignDriverResponse").html('<p class="alert alert-danger text-center">'+data.msg+'</p>');
                  setTimeout(function(){
                      $("#assignDriverResponse").fadeOut();
                  },1500);
                }else{
                  $("#assignDriverResponse").html('<p class="alert alert-danger text-center">Unknown error occured try again later!</p>');
                   setTimeout(function(){
                      $("#assignDriverResponse").fadeOut();
                  },1500);
                }

           });

        }else{
          $("#assignDriverResponse").html('<p class="alert alert-danger text-center">All fields are required</p>');
           setTimeout(function(){
                      $("#assignDriverResponse").fadeOut();
                  },1500);
        }
       e.preventDefault();
    });
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
