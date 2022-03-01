<?php
  if(isset($_POST['email']) && !empty($_POST['email'])){
    $email = addslashes($_POST['email']);
?>

<form id="resetForm2" enctype="multipart/form-data" action="" method="post">
        <div class="login-form">	
            <div class="login-logo">									
                <a href="index"><img src="images/orderlogo.png" alt=""></a>
            </div>
            <div id="reset2Response"></div>

            <div class="form-group">
                <input type="text" class="video-form" name="code" id="code" placeholder="Enter Code" required />							
            </div>
           
         <input type="hidden" name="cemail" id="cemail" value="<?=$email?>" required/>
           
            <button id="reset2Btn" type="submit" onclick="checkCode()" class="login-btn btn-link text-light">Next</button>
         	<div class="forgot-password">
                <a  href="signin">Back to Login</a>
                <p>Browser places? <a href="index"><span style="color:#ffa803;">- Home</span></a></p>
            </div>										
        </div>	
    </form>
<?php
   }
?>
   