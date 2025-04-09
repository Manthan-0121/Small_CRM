<?php
include("../includes/config.php");
    if(isset($_SESSION['emp_id']) == null){
        header('Location: '.BASE_URL.'employee/login.php');
        exit();
    }

?>