<?php

include("../includes/config.php");
if (isset($_POST["txt_department_name"])) {
    $txt_department_name = mysqli_real_escape_string($conn, $_POST["txt_department_name"]);

    $inssql = "INSERT INTO tbl_department(department_name) VALUES ('$txt_department_name')";
    if (mysqli_query($conn, $inssql)) {
        echo 1;
    }else{
        echo 2;
    }
}
