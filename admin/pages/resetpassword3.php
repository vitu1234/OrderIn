<?php
  if(isset($_POST['email']) && !empty($_POST['email'])){
    $email = addslashes($_POST['email']);
?>

<form id="resetForm3" enctype="multipart/form-data" action="" method="post">
        <div class="login-form">	
            <div class="login-logo">									
                <a href="../index.php"><img src="../images/orderlogo.png" alt=""></a>
            </div>
            <div id="reset3Response"></div>

            <div class="form-group">
                <input type="password" class="video-form" name="pass1" id="pass1" placeholder="New Password" required />							
            </div>
           <div class="form-group">
                <input type="password" class="video-form" name="pass2" id="pass2" placeholder="Confirm Password" required />							
            </div>
           <input type="hidden" name="remail" id="remail" value="<?=$email?>" required/>
           
            <button id="reset3Btn" onclick="resetFinish()" type="submit" class="login-btn btn-link text-light">Finish</button>
            <div class="forgot-password">
                <a  href="login">Back to Login</a>
                <p>Not an admin? <a href="../index.php"><span style="color:#ffa803;">- Home</span></a></p>
            </div>										
        </div>	
    </form>
<?php
  }
?>