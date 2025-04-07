<?php
include("../includes/config.php");
if (isset($_POST['edt_txt_leave_category']) && isset($_POST['uid'])) {

    $id = mysqli_real_escape_string($conn, $_POST['uid']);
    $edt_txt_leave_category = mysqli_real_escape_string($conn, $_POST['edt_txt_leave_category']);
    $lv_cat_status = mysqli_real_escape_string($conn, $_POST['status']);

    $updtquery = "UPDATE `tbl_leave_category` SET `type`='$edt_txt_leave_category', `status`='$lv_cat_status' WHERE id = $id";
    if (mysqli_query($conn, $updtquery)) {
        echo 1;
    }
}