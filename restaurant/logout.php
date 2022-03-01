<?php
session_start();
                
        setcookie("product", "", time() - 360000, "/");
        unset($_SESSION["restaurant"]);
        header("Location:login");
   

?>