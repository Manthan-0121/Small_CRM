<?php
include("./includes/config.php");
    if(isset($_SESSION['u_id']) == null){
        header('Location: '.BASE_URL.'login.php');
        exit();
    }
?>