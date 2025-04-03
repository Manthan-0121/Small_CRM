<?php
    include("../includes/config.php");

    if(isset($_POST["id"])){
        $id = mysqli_real_escape_string($conn, $_POST["id"]);

        $delsql = "DELETE FROM `tbl_department` WHERE id = $id";
        if(mysqli_query($conn,$delsql)){
            echo 1;
        }
    }
?>