<?php
include("./includes/header.php");

?>

<button type="button" class="mb-4 btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Position</button>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Manage Positions</h4>
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
                                <th>Positions</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selemposisql = "SELECT tbl_employee_position.id AS emppoid, tbl_employee_position.department_id AS emppodpid, tbl_employee_position.position_name AS empponame, tbl_employee_position.status AS emppostatus, tbl_department.id AS dpid, tbl_department.department_name AS dpname FROM tbl_employee_position LEFT JOIN tbl_department ON tbl_employee_position.department_id = tbl_department.id";

                            $res = mysqli_query($conn, $selemposisql);
                            $sqn = 1;
                            while ($row = mysqli_fetch_array($res)) {
                            ?>
                                <tr>
                                    <td><?php echo $sqn++ ?></td>
                                    <td><?php echo $row['dpname'] ?></td>
                                    <td><?php echo $row['empponame'] ?></td>
                                    <td>
                                        <?php
                                        if ($row['emppostatus'] == "1") {
                                            echo "<span class=\"badge badge-success\">Active</span>";
                                        } else {
                                            echo "<span class=\"badge badge-danger\">Inactive</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <button href="#" class="btn btn-primary edit-btn" data-eid="<?php echo $row['emppoid'];?>" data-old_dp_id="<?php echo $row['emppodpid']; ?>" data-position_name="<?php echo $row['empponame']; ?>" data-old_po_status="<?php echo $row['emppostatus'] ?>">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </button>
                                        <!-- <a href="#" class="btn btn-danger" type="button">
                                            <i class="fa-solid fa-trash"></i>
                                        </a> -->
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
                <h5 class="modal-title" id="formModal">Add New Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Select Departments</label>
                        <div class="input-group">
                            <select class="form-control" name="ddl_department" required>
                                <option value="">Select Department</option>
                                <?php
                                $seldep = "SELECT * FROM tbl_department WHERE department_status = '1'";
                                $res = mysqli_query($conn, $seldep);
                                while ($row = mysqli_fetch_array($res)) {
                                ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['department_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter Position Name" name="txt_position_name" required>
                        </div>
                    </div>
                    <button type="submit" id="btn_add" class="btn btn-primary waves-effect">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="edt_position" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Edit Position</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="edt_add_form" enctype="multipart/form-data">
                    <input type="hidden" name="uid" id="edit-id">
                    <div class="form-group">
                        <label>Select Departments</label>
                        <div class="input-group">
                            <select class="form-control" name="edt_ddl_department" id="ddl_id" required>
                                <option value="">Select Department</option>
                                <?php
                                $seldep = "SELECT * FROM tbl_department WHERE department_status = '1'";
                                $res = mysqli_query($conn, $seldep);
                                while ($row = mysqli_fetch_array($res)) {
                                ?>
                                    <option value="<?php echo $row['id'] ?>"><?php echo $row['department_name'] ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Position</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Enter Position Name" id="posi_name" name="edt_txt_position_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <div class="form-group">
                            <select name="edt_status" id="edt_status" class="form-control">
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
                url: './ajax_files/add_position.php',
                data: $('#add_form').serialize(),
                success: function(data) {
                    if (data == 1) {
                        alert('Position Created Success');
                        location.reload();
                    } else {
                        alert('Position Not Created');
                    }
                }
            });
            return false;
        });

        $(document).on('click', '.edit-btn', function() {
            const eid = $(this).data('eid');
            const old_dp_id = $(this).data('old_dp_id');
            const position_name = $(this).data('position_name');
            const old_po_status = $(this).data('old_po_status');


            $('#edit-id').val(eid);
            $('#ddl_id').val(old_dp_id);
            $('#posi_name').val(position_name);
            $('#edt_status').val(old_po_status);
            $('#edt_position').modal('show');
        });

        $("#edt_add_form").submit(function(event) {
            $.ajax({
                type: 'post',
                url: './ajax_files/updt_position.php',
                data: $('#edt_add_form').serialize(),
                success: function(data) {
                    if (data == 1) {
                        alert('Position Updated Success');
                        location.reload();
                    } else {
                        alert('Position Not Updated');
                    }
                }
            });
            return false;
        });
    });
</script>