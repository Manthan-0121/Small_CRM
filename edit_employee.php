<?php
include("./includes/header.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $hdn_emp_id = mysqli_real_escape_string($conn, $_POST["hdn_emp_id"]);
    $txt_fname = mysqli_real_escape_string($conn, $_POST["txt_fname"]);
    $txt_lname = mysqli_real_escape_string($conn, $_POST["txt_lname"]);
    $txt_email = mysqli_real_escape_string($conn, $_POST["txt_email"]);
    $txt_mobile_no = mysqli_real_escape_string($conn, $_POST["txt_mobile_no"]);
    $ddl_gender = mysqli_real_escape_string($conn, $_POST["ddl_gender"]);
    $ddl_department = mysqli_real_escape_string($conn, $_POST["ddl_department"]);
    $ddl_position = mysqli_real_escape_string($conn, $_POST["ddl_position"]);
    $txt_experience = mysqli_real_escape_string($conn, $_POST["txt_experience"]);
    $hdn_old_emp_img = mysqli_real_escape_string($conn, $_POST["hdn_old_img"]);

    $allowed_extensions = array("jpg", "jpeg", "png", "gif");
    $filename = $_FILES['fu_emp_img']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);
    if ($_FILES['fu_emp_img']['name'] == null) {
        $img_name = $hdn_old_emp_img;
    } else {
        $renamefile = uniqid() . "_" . $txt_fname . "_" . $txt_lname . "." . $ext;
        $fullpath = "assets/img/emp_imges/" . $renamefile;
        move_uploaded_file($_FILES['fu_emp_img']['tmp_name'], $fullpath);
        $img_name = $renamefile;
    }

    $updtsql = "UPDATE `tbl_employee` SET `emloyee_img`='$img_name',`first_name`='$txt_fname',`last_name`='$txt_lname',`email`='$txt_email',`mobile_no`='$txt_mobile_no',`gender`='$ddl_gender',`department_id`='$ddl_department',`employee_position_id`='$ddl_position',`experience_in_year`='$txt_experience' WHERE id = '$hdn_emp_id'";

    if(mysqli_query($conn, $updtsql)){
        ?>
        <script>
            alert('Employee details updated');
            window.location.href = "employees.php";
        </script>;
        <?php
    }else{
        echo "<script>alert('Some thing is wrong')</script>";
    }
}
$id = mysqli_real_escape_string($conn, $_GET['id']);
if (isset($_GET['id']) != null) {
    $sqlemp = "SELECT tbl_employee.*, tbl_department.*, tbl_employee_position.*,tbl_employee.id AS emp_id, tbl_department.id AS dep_id, tbl_employee_position.id AS position_id FROM tbl_employee JOIN tbl_department ON tbl_employee.department_id = tbl_department.id JOIN tbl_employee_position ON tbl_employee.employee_position_id = tbl_employee_position.id WHERE tbl_employee.id = $id";

    $result = mysqli_query($conn, $sqlemp);
    if (mysqli_num_rows($result) > 0) {
        $rowsingle = mysqli_fetch_array($result);
    ?>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Edit Employee</h4>
                    </div>
                    <div class="card-body">
                        <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                            <input type="hidden" id="hdn_emp_id" name="hdn_emp_id" value="<?php echo $id; ?>">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>First Name</label>
                                        <input type="text" name="txt_fname" class="form-control" required value="<?php echo $rowsingle['first_name']; ?>">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Last Name</label>
                                        <input type="text" name="txt_lname" class="form-control" required value="<?php echo $rowsingle['last_name']; ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Email</label>
                                        <input type="email" name="txt_email" id="txt_email" class="form-control" required value="<?php echo $rowsingle['email']; ?>">
                                        <div class="" id="err_email_feedback">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Mobile No</label>
                                        <input type="number" name="txt_mobile_no" id="txt_mobile_no" class="form-control" required value="<?php echo $rowsingle['mobile_no']; ?>">
                                        <div class="" id="err_mobile_feedback">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Gender</label>
                                        <select class="form-control" id="ddl_gender" name="ddl_gender" required>
                                            <option value="">Select Gender</option>
                                            <option value="M" <?php if ($rowsingle['gender'] == "M") {
                                                                    echo "selected";
                                                                } ?>>Male</option>
                                            <option value="F" <?php if ($rowsingle['gender'] == "F") {
                                                                    echo "selected";
                                                                } ?>>Female</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Experience (Total Years)</label>
                                        <input type="number" class="form-control" name="txt_experience" value="0" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Department</label>
                                        <select class="form-control" id="ddl_department" name="ddl_department" required>
                                            <option>Select Department</option>
                                            <?php
                                            $seldepartsql = "SELECT `id`, `department_name` FROM `tbl_department` WHERE department_status = '1'";
                                            $res = mysqli_query($conn, $seldepartsql);
                                            while ($row = mysqli_fetch_assoc($res)) {
                                            ?>
                                                <option value="<?php echo $row['id']; ?>" <?php if ($rowsingle['dep_id'] == $row['id']) {
                                                                                                echo "selected";
                                                                                            } ?>><?php echo $row['department_name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Position</label>
                                        <select class="form-control" id="ddl_position" name="ddl_position" required>
                                            <option>Select Position</option>
                                            <?php
                                            $selpossql = "SELECT `id`, `position_name` FROM `tbl_employee_position` WHERE 1";
                                            $resposition = mysqli_query($conn, $selpossql);
                                            while ($rowposition = mysqli_fetch_assoc($resposition)) {
                                            ?>
                                                <option value="<?php echo $rowposition['id']; ?>" <?php if ($rowsingle['position_id'] == $rowposition['id']) {
                                                                                                        echo "selected";
                                                                                                    } ?>><?php echo $rowposition['position_name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Passport Size Image</label>
                                        <input type="file" class="form-control" id="fu_emp_img" name="fu_emp_img">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <img class="border p-1" src="<?php echo BASE_URL . 'assets/img/emp_imges/' . $rowsingle['emloyee_img']; ?>" alt="" width="100">
                                    <input type="hidden" name="hdn_old_img" value="<?php echo $rowsingle['emloyee_img']; ?>">
                                </div>
                            </div>
                            <button class="btn btn-primary mr-1" id="btn_edt_emp" type="submit">Update</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        </div>

    <?php
    } else {
    ?>
        <script>
            alert('Employee not found');
            window.location.href = "employees.php";
        </script>;
    <?php
    }
} else {
    ?>
    <script>
        window.location.href = "employees.php";
    </script>;
<?php
}
include("./includes/footer.php");
?>

<script>
    $(document).ready(function() {

        $('#ddl_department').on('change', function() {
            var ddl_department_id = $(this).val();
            $.ajax({
                url: './ajax_files/ddl_sel_posi.php',
                type: 'POST',
                data: {
                    ddl_department_id: ddl_department_id
                },
                success: function(response) {
                    $('#ddl_position').html(response);
                }
            });
        });

        $('#txt_email').keyup(function() {
            var txt_email = $(this).val();
            var hdn_emp_id = $('#hdn_emp_id').val();

            // console.log(txt_email);
            $.ajax({
                url: "./ajax_files/chk_email.php",
                type: 'POST',
                data: {
                    txt_email: txt_email,
                    hdn_emp_id: hdn_emp_id
                },
                success: function(response) {
                    if (response == 1) {
                        $('#txt_email').addClass('is-invalid');
                        $('#err_email_feedback').addClass('invalid-feedback');
                        $('#err_email_feedback').html('Email already exist');
                        $('#btn_add_emp').attr("disabled", true)
                    } else {
                        $('#txt_email').removeClass('is-invalid');
                        $('#txt_email').addClass('is-valid');
                        $('#btn_add_emp').attr("disabled", false)
                    }
                }
            });
        });

        $('#txt_mobile_no').keyup(function() {
            var txt_mobile_no = $(this).val();
            var hdn_emp_id = $('#hdn_emp_id').val();
            $.ajax({
                url: "./ajax_files/chk_mobile.php",
                type: 'POST',
                data: {
                    txt_mobile: txt_mobile_no,
                    hdn_emp_id: hdn_emp_id
                },
                success: function(response) {
                    if (response == 1) {
                        $('#txt_mobile_no').addClass('is-invalid');
                        $('#err_mobile_feedback').addClass('invalid-feedback');
                        $('#err_mobile_feedback').html('Mobile Number already exist');
                        $('#btn_add_emp').attr("disabled", true)
                    } else {
                        $('#txt_mobile_no').removeClass('is-invalid');
                        $('#txt_mobile_no').addClass('is-valid');
                        $('#btn_add_emp').attr("disabled", false)
                    }
                }
            });
        });
    });
</script>