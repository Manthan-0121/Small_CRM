<?php
include("./includes/header.php");

?>

<button type="button" class="mb-4 btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Leave Category</button>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Manage Leave Category</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Category Name</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selsql = "SELECT * FROM tbl_leave_category";
                            $res = mysqli_query($conn, $selsql);
                            $sqn = 1;
                            while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $sqn++; ?>
                                    </td>
                                    <td><?php echo $row["type"] ?></td>
                                    <td>
                                        <?php
                                        if ($row['status'] == "1") {
                                            echo "<span class=\"badge badge-success\">Active</span>";
                                        } else {
                                            echo "<span class=\"badge badge-danger\">Inactive</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button class="btn btn-primary edit-btn" data-id="<?php echo $row['id'] ?>" data-type="<?php echo htmlspecialchars($row['type']) ?>" data-status="<?php echo $row['status'] ?>">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
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
                <h5 class="modal-title" id="formModal">Add New Leave Category</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Category Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="txt_leave_category" name="txt_leave_category" required>
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
                            <input type="text" class="form-control" id="edt_txt_leave_category" placeholder="Section Name" name="edt_txt_leave_category" required>
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
                url: './ajax_files/add_leave_category.php',
                data: $('#add_form').serialize(),
                success: function(data) {
                    if (data == 1) {
                        alert('Leave Category Created Success');
                        location.reload();
                    } else {
                        alert('Leave Category Not Created');
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.edit-btn', function() {
            const id = $(this).data('id');
            const type = $(this).data('type');
            const status = $(this).data('status');

            $('#edit-id').val(id);
            $('#edt_txt_leave_category').val(type);
            $('#exampleModal2').modal('show');
            $('#edt_status').val(status);
        });

        $("#edt_add_form").submit(function(event) {
            $.ajax({
                type: 'post',
                url: './ajax_files/updt_leave_category.php',
                data: $('#edt_add_form').serialize(),
                success: function(data) {
                    if (data == 1) {
                        alert('Leave Category Updated Success');
                        location.reload();
                    } else {
                        alert('Leave Category Not Updated');
                    }
                }
            });
            return false;
        });
    });
</script>