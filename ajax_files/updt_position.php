<?php
include("../includes/config.php");
if (isset($_POST['uid']) && isset($_POST['edt_ddl_department']) && isset($_POST['edt_txt_position_name']) && isset($_POST['edt_status'])) {

    $uid = mysqli_real_escape_string($conn, $_POST['uid']);
    $edt_ddl_department_id = mysqli_real_escape_string($conn, $_POST['edt_ddl_department']);
    $edt_txt_position_name = mysqli_real_escape_string($conn, $_POST['edt_txt_position_name']);
    $edt_status = mysqli_real_escape_string($conn, $_POST['edt_status']);

    $updtquery = "UPDATE `tbl_employee_position` SET `department_id`='$edt_ddl_department_id',`position_name`='$edt_txt_position_name',`status`='$edt_status' WHERE id = '$uid'";
    if (mysqli_query($conn, $updtquery)) {
        echo 1;
    }
}