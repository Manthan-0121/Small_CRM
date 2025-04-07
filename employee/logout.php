<?php
    include("../includes/config.php");

    unset($_SESSION["emp_id"]);
    header("Location:".BASE_URL."employee/login.php");
?>