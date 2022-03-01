	<form id="resetForm1" enctype="multipart/form-data" action="" method="post">
        <div class="login-form">	
            <div class="login-logo">									
                <a href="../index.php"><img src="../images/orderlogo.png" alt=""></a>
            </div>
            <div id="reset1Response"></div>

            <div class="form-group">
                <input type="text" class="video-form" name="reset_email" id="reset_email" placeholder="Enter Email " required />							
            </div>
           
            <button id="reset1" onclick="sendResetEmail()" type="submit" class="login-btn btn-link text-light">Next</button>
            <div class="forgot-password">
                <a  href="login">Back to Login</a>
                <p>Not an admin? <a href="../index.php"><span style="color:#ffa803;">- Home</span></a></p>
            </div>										
        </div>	
    </form>