<?php
include("../includes/config.php");
if (isset($_POST["txt_mobile"])) {
    $txt_mobile = mysqli_real_escape_string($conn, $_POST["txt_mobile"]);
    $hdn_emp_id = mysqli_real_escape_string($conn, $_POST["hdn_emp_id"]);

    $query = "SELECT * FROM tbl_employee WHERE mobile_no = '$txt_mobile'";

    if (isset($hdn_emp_id) != null) {
        $query .= "AND id = '$hdn_emp_id'";
    }

    $result = mysqli_query($conn, $query);
    if (mysqli_num_rows($result) > 1) {
        echo 1;
    } else {
        echo $query;
    }
}
