<?php
include("../includes/config.php");
    if(isset($_POST["txt_email"])){
        $txt_email = mysqli_real_escape_string($conn,$_POST["txt_email"]);
        $hdn_emp_id = mysqli_real_escape_string($conn,$_POST["hdn_emp_id"]);

        $query = "SELECT * FROM tbl_employee WHERE email = '$txt_email'";
        if(isset($hdn_emp_id) != null){
            $query .= "AND id = '$hdn_emp_id'";
        }

        $result = mysqli_query($conn,$query);
        if(mysqli_num_rows($result)> 1){
            echo 1;
        }else{
            echo $query;
        }
    }
?>