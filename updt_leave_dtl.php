<?php
include("./includes/header.php");
if (isset($_GET['lv_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['lv_id']);
    $selinfosingle = "SELECT tbl_employee.id AS emp_id, tbl_employee.first_name AS emp_fname, tbl_employee.last_name AS emp_lname, tbl_leave_category.type AS leave_category_type, tbl_leave_info.leave_start_date AS leave_start_date, tbl_leave_info.leave_end_date AS leave_end_date, tbl_leave_info.leave_status AS leave_status, tbl_leave_info.leave_title AS leave_title, tbl_leave_info.id AS leave_id, tbl_leave_info.leave_reason AS leave_reason FROM tbl_leave_info JOIN tbl_employee ON tbl_leave_info.employee_id = tbl_employee.id JOIN tbl_leave_category ON tbl_leave_info.leave_category_id = tbl_leave_category.id WHERE tbl_leave_info.id = $id";
    $resinfosingle = mysqli_query($conn, $selinfosingle);
    if (mysqli_num_rows($resinfosingle) == 0) {
?>
        <script>
            window.location.href = "employees.php";
        </script>
    <?php
    } else {
        $rowinfosingle = mysqli_fetch_array($resinfosingle);
    ?><a href="leave_manage.php" class="mb-4 btn btn-primary">Back</a>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Leave Applicatiom Details</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php $_SERVER['PHP_SELF']?>" method="POST">
                            <input type="hidden" name="emp_id" value="<?php echo $rowinfosingle['emp_id'];?>">
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Employee Name</label>
                                        <input type="text" class="form-control" readonly value="<?php echo $rowinfosingle['emp_fname'] . ' ' . $rowinfosingle['emp_lname']; ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Leave Title</label>
                                        <input type="text" class="form-control" readonly value="<?php echo $rowinfosingle['leave_title'];
                                                                                                ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Leave Type</label>
                                        <input type="text" class="form-control" readonly value="<?php echo $rowinfosingle['leave_category_type']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Start Date</label>
                                        <input type="text" class="form-control" readonly value="<?php echo date("d-m-Y", strtotime($rowinfosingle["leave_start_date"])); ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>End Date</label>
                                        <input type="text" class="form-control" readonly value="<?php echo date("d-m-Y", strtotime($rowinfosingle["leave_end_date"])); ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Total Days</label>
                                        <input type="text" class="form-control" readonly value="<?php
                                                                                                $date1 = new DateTime($rowinfosingle["leave_start_date"]);
                                                                                                $date2 = new DateTime($rowinfosingle["leave_end_date"]);
                                                                                                $days  = $date2->diff($date1)->format('%a');

                                                                                                if ($date1 == $date2) {
                                                                                                    echo '1 Day';
                                                                                                } else {
                                                                                                    echo $days . " Days";
                                                                                                }
                                                                                                ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="form-group">
                                        <label>Reason</label>
                                        <input type="text" class="form-control" readonly value="<?php echo $rowinfosingle['leave_reason']; ?>">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Current Leave Status</label>
                                        <!-- <input type="text" class="form-control" readonly value=""> -->
                                        <div>
                                            <?php if ($rowinfosingle['leave_status'] == "1") {
                                                echo "<span class=\"badge badge-success\">Approved</span>";
                                            } elseif ($rowinfosingle['leave_status'] == "2") {
                                                echo "<span class=\"badge badge-light\">Pending</span>";
                                            } elseif ($rowinfosingle['leave_status'] == "3") {
                                                echo "<span class=\"badge badge-warning\">Cancel </span>";
                                            } else {
                                                echo "<span class=\"badge badge-danger\">Rejected</span>";
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Leave Status</label>
                                        <select class="form-control" name="ddl_lv_status" required>
                                            <option value="1" <?php if($rowinfosingle['leave_status'] == '1'){ echo "Selected";}?>>Approved</option>
                                            <option value="0" <?php if($rowinfosingle['leave_status'] == '0'){ echo "Selected";}?>>Rejected</option>
                                            <option value="3" <?php if($rowinfosingle['leave_status'] == '3'){ echo "Selected";}?>>Canceled</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="form-group">
                                        <label>Paid Leave</label>
                                        <select class="form-control" name="ddl_paid_leave">
                                            <option value="No" selected>No</option>
                                            <option value="Yes">Yes</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-1" required>
                                    <Label>‎ </Label>
                                    <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                        Update
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    <?php
    }
} else {
    ?>
    <script>
        window.location.href = "employees.php";
    </script>
<?php
}
include("./includes/footer.php");
?>

<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $lv_id = mysqli_real_escape_string($conn, $_GET['lv_id']);
    $lv_status = mysqli_real_escape_string($conn,$_POST['ddl_lv_status']);
    $paid_leave = mysqli_real_escape_string($conn,$_POST['ddl_paid_leave']);
    $emp_id = mysqli_real_escape_string($conn,$_POST['emp_id']);

    $updtlvinfosql = "UPDATE `tbl_leave_info` SET `leave_status`='$lv_status' WHERE id = $lv_id";
    if(mysqli_query($conn, $updtlvinfosql)){
        if($paid_leave == "Yes"){
            $pdlvsql = "INSERT INTO `tbl_paid_leave`(`employee_id`, `leave_info_id`) VALUES ('$emp_id','$lv_id')";
            mysqli_query($conn, $pdlvsql);
        }
        ?>
        <script>
            window.location.href = "leave_manage.php";
        </script>
        <?php
    }
}
?>