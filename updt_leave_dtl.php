<?php
include("./includes/header.php");
if (isset($_GET['lv_id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['lv_id']);
    $selinfosingle = "SELECT tbl_employee.first_name AS emp_fname, tbl_employee.last_name AS emp_lname, tbl_leave_category.type AS leave_category_type, tbl_leave_info.leave_start_date AS leave_start_date, tbl_leave_info.leave_end_date AS leave_end_date, tbl_leave_info.leave_status AS leave_statusm, tbl_leave_info.leave_title AS leave_title, tbl_leave_info.id AS leave_id FROM tbl_leave_info JOIN tbl_employee ON tbl_leave_info.employee_id = tbl_employee.id JOIN tbl_leave_category ON tbl_leave_info.leave_category_id = tbl_leave_category.id WHERE tbl_leave_info.id = $id";
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
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Employee Name</label>
                                    <input type="text" class="form-control" readonly  value="<?php //echo //$rowinfosingle['first_name']; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Leave Title</label>
                                    <input type="text" class="form-control" readonly value="<?php //echo //$rowinfosingle['last_name']; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Leave Type</label>
                                    <input type="text" class="form-control" readonly value="<?php //echo date("d-m-Y", strtotime($rowinfosingle['joining_date'])); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Start Date</label>
                                    <input type="text" class="form-control" readonly value="<?php //echo $rowinfosingle['email']; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>End Date</label>
                                    <input type="text" class="form-control" readonly  value="<?php //echo $rowinfosingle['mobile_no']; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Total Days</label>
                                    <input type="text" class="form-control" readonly value="<?php //echo $rowinfosingle['department_name']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-8">
                                <div class="form-group">
                                    <label>Reason</label>
                                    <input type="text" class="form-control" readonly  value="<?php //echo $rowinfosingle['position_name']; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Current Leave Status</label>
                                    <input type="text" class="form-control" readonly  value="<?php //echo $rowinfosingle['position_name']; ?>">
                                </div>
                            </div>
                        </div>
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