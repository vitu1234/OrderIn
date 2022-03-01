<?php
session_start();
                
        setcookie("meal_detail", "", time() - 360000, "/");
        setcookie("view_restaurant", "", time() - 360000, "/");
        unset($_SESSION["user"]);
        header("Location:index");
   

?>