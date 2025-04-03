<?php
include("./includes/header.php");

?>

<button type="button" class="mb-4 btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Departments</button>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Manage Departments</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Departments Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selsql = "SELECT * FROM tbl_department";
                            $res = mysqli_query($conn, $selsql);
                            $sqn = 1;
                            while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $sqn++; ?>
                                    </td>
                                    <td><?php echo $row["department_name"] ?></td>
                                    <td>
                                        <?php
                                        if ($row['department_status'] == "1") {
                                            echo "<span class=\"badge badge-success\">Active</span>";
                                        } else {
                                            echo "<span class=\"badge badge-danger\">Inactive</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary edit-btn" data-id="<?php echo $row['id'] ?>" data-department_name="<?php echo htmlspecialchars($row['department_name']) ?>" data-status="<?php echo $row['department_status'] ?>">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <!-- <button class="btn btn-danger btn_del" data-id="<?php echo $row['id'] ?>">
                                            <i class="fa-solid fa-trash"></i>
                                        </button> -->
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add New Departments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Departments</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="txt_department_name" placeholder="Enter Department Name" name="txt_department_name" required>
                            <div class="invalid-feedback">
                                Department already exist
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="btn_add" class="btn btn-primary waves-effect">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Edit Departments</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edt_add_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Departments</label>
                        <div class="input-group">
                            <input type="hidden" name="uid" id="edit-id">
                            <input type="text" class="form-control" id="edt_txt_department_name" placeholder="Section Name" name="edt_txt_department_name" required>
                            <div class="invalid-feedback">
                                Department already exist
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="form-group">
                            <select name="status" id="edt_status" class="form-control">
                                <option value="1">Active</option>
                                <option value="0">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <button type="submit" id="edt_btn_add" class="btn btn-primary waves-effect">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#add_form").submit(function(event) {
            $.ajax({
                type: 'post',
                url: './ajax_files/add_departments.php',
                data: $('#add_form').serialize(),
                success: function(data) {
                    if (data == 1) {
                        alert('Department Created Success');
                        location.reload();
                    } else {
                        alert('Department Not Created');
                    }
                }
            });
            return false;
        });

        $("#edt_add_form").submit(function(event) {
            $.ajax({
                type: 'post',
                url: './ajax_files/updt_departments.php',
                data: $('#edt_add_form').serialize(),
                success: function(data) {
                    if (data == 1) {
                        alert('Department Updated Success');
                        location.reload();
                    } else {
                        alert('Department Not Updated');
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.edit-btn', function() {
            const id = $(this).data('id');
            const name = $(this).data('department_name');
            const status = $(this).data('status');

            $('#edit-id').val(id);
            $('#edt_txt_department_name').val(name);
            $('#exampleModal2').modal('show');
            $('#edt_status').val(status);
        });

        $("#txt_department_name").keyup(function() {
            var txt_department_name = $('#txt_department_name').val();
            $.ajax({
                url: './ajax_files/chk_department.php',
                type: "POST",
                data: "value=" + txt_department_name,
                cache: true,
                success: function(response) {
                    console.log(response);
                    if (response == 1) {
                        $('#txt_department_name').addClass("is-invalid");
                        $('#btn_add').attr("disabled", true);
                    } else {
                        $('#txt_department_name').removeClass("is-invalid");
                        $('#btn_add').removeAttr("disabled", false);
                    }
                }
            });
        });

        $(document).on('click', '.btn_del', function() {
            const id = $(this).data('id');
            if (confirm('Are you sure you want to delete this recipient?')) {
                $.ajax({
                    url: './ajax_files/delete_departments.php',
                    type: 'POST',
                    data: {id},
                    success: function(res) {
                        if (res == 1) {
                            alert('Department Deleted Success');
                            location.reload();
                        } else {
                            alert(res);
                        }
                    }
                });
            }
        });
    });
</script>