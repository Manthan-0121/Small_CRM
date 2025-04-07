<?php
include("./includes/header.php");

?>

<a href="add_employee.php" type="button" class="mb-4 btn btn-primary">Add Employee</a>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Manage Employee</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Img</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Position</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selsql = "SELECT tbl_employee.id AS emp_id, tbl_employee.first_name AS emp_fname,tbl_employee.last_name AS emp_lname, tbl_employee.emloyee_img AS emp_img, tbl_department.department_name AS dep_name, tbl_employee_position.position_name AS position_name FROM tbl_employee JOIN tbl_department ON tbl_employee.department_id = tbl_department.id JOIN tbl_employee_position ON tbl_employee.employee_position_id = tbl_employee_position.id;";

                            $res = mysqli_query($conn, $selsql);
                            $sq_no = 1;
                            while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                                <tr>
                                    <td><?php echo $sq_no++; ?></td>
                                    <td class="align-middle">
                                        <img alt="image" src="<?php echo BASE_URL . 'assets/img/emp_imges/' . $row['emp_img']; ?>" width="55">
                                    </td>
                                    <td><?php echo $row['emp_fname'] . " " . $row['emp_lname']; ?></td>
                                    <td><?php echo $row['dep_name']; ?></td>
                                    <td><?php echo $row['position_name']; ?></td>
                                    <td>
                                        <a class="btn btn-success" href="info_emp.php?id=<?php echo $row['emp_id']; ?>">
                                            <i class="fa-solid fa-eye"></i>
                                        </a>
                                        <a href="edit_employee.php?id=<?php echo $row['emp_id']; ?>" class="btn btn-primary" type="button">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("./includes/footer.php");
?>