<?php
include("../includes/config.php");
if (isset($_POST['edt_txt_department_name']) && isset($_POST['uid'])) {

    $id = mysqli_real_escape_string($conn, $_POST['uid']);
    $txt_department_name = mysqli_real_escape_string($conn, $_POST['edt_txt_department_name']);
    $dep_status = mysqli_real_escape_string($conn, $_POST['status']);

    $updtquery = "UPDATE `tbl_department` SET `department_name`='$txt_department_name', `department_status`='$dep_status' WHERE id = $id";
    if (mysqli_query($conn, $updtquery)) {
        echo 1;
    }
}