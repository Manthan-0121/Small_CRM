<?php
include("../includes/config.php");
if (isset($_POST["dt_start_date"])) {
    $dt_start_date = mysqli_real_escape_string($conn, $_POST["dt_start_date"]);
    $data_emp_id = mysqli_real_escape_string($conn, $_POST["data_emp_id"]);

    $query = "SELECT `id` FROM `tbl_leave_info` WHERE leave_start_date = '$dt_start_date' OR leave_end_date = '$dt_start_date' AND employee_id = '$data_emp_id' AND leave_status = '2' OR leave_status = '1'";

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 0) {
        echo 1;
    } else {
        echo $query;
    }
}
