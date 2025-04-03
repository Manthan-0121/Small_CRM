<?php
include("../includes/config.php");
    if(isset($_POST["value"])){
        $value = mysqli_real_escape_string($conn,$_POST["value"]);

        $query = "SELECT * FROM tbl_department WHERE department_name = '$value'";

        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result)> 0){
            echo 1;
        }else{
            echo $query;
        }
    }
?>