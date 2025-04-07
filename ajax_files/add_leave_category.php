<?php

include("../includes/config.php");
if (isset($_POST["txt_leave_category"])) {
    $txt_leave_category = mysqli_real_escape_string($conn, $_POST["txt_leave_category"]);

    $inssql = "INSERT INTO tbl_leave_category(type) VALUES ('$txt_leave_category')";
    if (mysqli_query($conn, $inssql)) {
        echo 1;
    }else{
        echo 2;
    }   
}
