<?php
include("../includes/config.php");
    if(isset( $_POST["ddl_department"]) && $_POST["txt_position_name"]){
        $dep_id = mysqli_real_escape_string($conn, $_POST["ddl_department"]);
        $posi_name = mysqli_real_escape_string($conn, $_POST["txt_position_name"]);
        
        $inssql = "INSERT INTO tbl_employee_position(`department_id`, `position_name`) VALUES ('$dep_id','$posi_name')";
        if(mysqli_query($conn, $inssql)){
            echo 1;
        }else{
            echo 0;
        }
    }
?>