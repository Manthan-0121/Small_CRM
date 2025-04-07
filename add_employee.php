<?php
include("./includes/header.php");
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $txt_fname = mysqli_real_escape_string($conn, $_POST["txt_fname"]);
    $txt_lname = mysqli_real_escape_string($conn, $_POST["txt_lname"]);
    $txt_email = mysqli_real_escape_string($conn, $_POST["txt_email"]);
    $txt_mobile_no = mysqli_real_escape_string($conn, $_POST["txt_mobile_no"]);
    $ddl_gender = mysqli_real_escape_string($conn, $_POST["ddl_gender"]);
    $txt_pwd = md5(mysqli_real_escape_string($conn, $_POST["txt_pwd"]));
    $ddl_department = mysqli_real_escape_string($conn, $_POST["ddl_department"]);
    $ddl_position = mysqli_real_escape_string($conn, $_POST["ddl_position"]);
    $txt_experience = mysqli_real_escape_string($conn, $_POST["txt_experience"]);
    $current_date = date("Y-m-d");
    
    $allowed_extensions = array("jpg","jpeg","png","gif");
    $filename = $_FILES['fu_emp_img']['name'];
    $ext = pathinfo($filename, PATHINFO_EXTENSION);

    

    if (!in_array($ext, $allowed_extensions)) {
        echo "<script>alert('Invalid format. Only jpg / jpeg / png / gif format allowed')</script>";
    }else{

        $renamefile = uniqid()."_".$txt_fname."_".$txt_lname.".".$ext;
        $fullpath = "assets/img/emp_imges/".$renamefile;
        
        // echo '<script>alert("'.$fullpath.'")</script>';

        if(move_uploaded_file($_FILES['fu_emp_img']['tmp_name'],$fullpath)){


            $inssql = "INSERT INTO `tbl_employee`(`emloyee_img`, `first_name`, `last_name`, `email`, `mobile_no`, `gender`, `department_id`, `pwd`, `employee_position_id`, `joining_date`, `experience_in_year`) VALUES ('$renamefile','$txt_fname','$txt_lname','$txt_email','$txt_mobile_no','$ddl_gender','$ddl_department','$txt_pwd','$ddl_position','$current_date','$txt_experience')";

            if(mysqli_query($conn, $inssql)){
                ?>
                <script>
                    alert('New Employee added');
                    window.location.href = "employees.php";
                </script>;
                <?php
            }else{
                echo "<script>alert('Some thing is wrong')</script>";
            }
        }

    }

}
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Add New Employee</h4>
            </div>
            <div class="card-body">
                <form action="<?php $_SERVER['PHP_SELF'] ?>" method="post" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>First Name</label>
                                <input type="text" name="txt_fname" class="form-control" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Last Name</label>
                                <input type="text" name="txt_lname" class="form-control" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="txt_email" id="txt_email" class="form-control" required>
                                <div class="" id="err_email_feedback">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Mobile No</label>
                                <input type="number" name="txt_mobile_no" id="txt_mobile_no" class="form-control" required>
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
                                    <option value="M">Male</option>
                                    <option value="F">Female</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Password</label>
                                <input type="text" name="txt_pwd" class="form-control" required>
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
                                        <option value="<?php echo $row['id']; ?>"><?php echo $row['department_name']; ?></option>
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
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Experience (Total Years)</label>
                                <input type="number" class="form-control" name="txt_experience" value="0" required>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Passport Size Image</label>
                                <input type="file" class="form-control" id="fu_emp_img" name="fu_emp_img" required>
                            </div>
                        </div>
                    </div>
                    <button class="btn btn-primary mr-1" id="btn_add_emp" type="submit">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<?php
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

            // console.log(txt_email);
            $.ajax({
                url: "./ajax_files/chk_email.php",
                type: 'POST',
                data: {
                    txt_email: txt_email
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

            // console.log(txt_email);
            $.ajax({
                url: "./ajax_files/chk_mobile.php",
                type: 'POST',
                data: {
                    txt_mobile: txt_mobile_no
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