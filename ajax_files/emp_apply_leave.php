<?php
include("../includes/config.php");
    if(isset($_POST['txt_leave_title']) != null && isset($_POST['ddl_lv_category']) != null && isset($_POST['txt_description']) != null && isset($_POST['dt_end_date']) != null && isset( $_POST['dt_start_date']) != null){
        $txt_leave_title = mysqli_real_escape_string($conn, $_POST['txt_leave_title']);
        $ddl_lv_category = mysqli_real_escape_string($conn, $_POST['ddl_lv_category']);
        $txt_description = mysqli_real_escape_string($conn, $_POST['txt_description']);
        $dt_end_date = mysqli_real_escape_string($conn, $_POST['dt_end_date']);
        $dt_start_date = mysqli_real_escape_string($conn, $_POST['dt_start_date']);
        $data_emp_id = mysqli_real_escape_string($conn, $_POST['data_emp_id']);

        $insleavesql = "INSERT INTO `tbl_leave_info`(`leave_category_id`, `employee_id`, `leave_reason`, `leave_start_date`, `leave_end_date`, `leave_title`) VALUES ('$ddl_lv_category','$data_emp_id','$txt_description','$dt_start_date','$dt_end_date','$txt_leave_title')";

        if(mysqli_query($conn, $insleavesql)){
            echo 1;
        }
    } 
?>