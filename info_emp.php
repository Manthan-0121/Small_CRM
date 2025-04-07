<?php
include("./includes/header.php");
if (isset($_GET['id'])) {
    $id = mysqli_real_escape_string($conn, $_GET['id']);
    $selinfosingle = "SELECT tbl_employee.*, tbl_department.*, tbl_employee_position.* FROM tbl_employee JOIN tbl_department ON tbl_employee.department_id = tbl_department.id JOIN tbl_employee_position ON tbl_employee.employee_position_id = tbl_employee_position.id WHERE tbl_employee.id = $id";
    $resinfosingle = mysqli_query($conn, $selinfosingle);
    if (mysqli_num_rows($resinfosingle) == 0) {
?>
        <script>
            window.location.href = "employees.php";
        </script>
    <?php
    } else {
        $rowinfosingle = mysqli_fetch_array($resinfosingle);
    ?><a href="employees.php" class="mb-4 btn btn-primary">Back</a>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Show Employee Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text" class="form-control" readonly value="<?php echo $rowinfosingle['first_name']; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text" class="form-control" readonly value="<?php echo $rowinfosingle['last_name']; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Joined Date (DD-MM-YYYY)</label>
                                    <input type="text" class="form-control" readonly value="<?php echo date("d-m-Y", strtotime($rowinfosingle['joining_date'])); ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" class="form-control" readonly value="<?php echo $rowinfosingle['email']; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Mobile</label>
                                    <input type="text" class="form-control" readonly value="<?php echo $rowinfosingle['mobile_no']; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Department</label>
                                    <input type="text" class="form-control" readonly value="<?php echo $rowinfosingle['department_name']; ?>">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Position</label>
                                    <input type="text" class="form-control" readonly value="<?php echo $rowinfosingle['position_name']; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Experience</label>
                                    <input type="text" class="form-control" readonly value="<?php echo $rowinfosingle['experience_in_year']; ?>">
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label>Employee Image</label>
                                    <img class="border p-1" src="<?php echo BASE_URL . 'assets/img/emp_imges/' . $rowinfosingle['emloyee_img']; ?>" alt="" width="100">
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