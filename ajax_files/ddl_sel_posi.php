<?php
include("../includes/config.php");
    if(isset( $_POST["ddl_department_id"] )){
        $depid = mysqli_real_escape_string($conn, $_POST["ddl_department_id"]);
        $selpostionsql = "SELECT `id`, `position_name` FROM `tbl_employee_position` WHERE department_id = '$depid' AND status = '1'";
        if($res = mysqli_query($conn, $selpostionsql)){
            if(mysqli_num_rows($res) > 0){
                while($row = mysqli_fetch_array($res)){
                    echo "<option value='".$row['id']."'>".$row['position_name']."</option>";
                }
            }else{
                echo "<option>Not Found</option>";
            }
            
        }
    }
?>