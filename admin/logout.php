<?php
session_start();
                
        setcookie("ppkcookie1", "", time() - 360000, "/");
        setcookie("ppkcookie2", "", time() - 360000, "/");
        unset($_SESSION["admin"]);
        header("Location:login");
   

?>