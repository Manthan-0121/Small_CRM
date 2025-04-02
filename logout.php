<?php
    include("./includes/config.php");

    unset($_SESSION["u_id"]);
    header("Location:".BASE_URL."login.php");
?>