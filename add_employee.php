<?php
include("./includes/header.php");

?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Add New Employee</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>First Name</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Last Name</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" id="txt_email" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Mobile No</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Gender</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Password</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Department</label>
                            <select class="form-control" id="ddl_department" required>
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
                            <select class="form-control" id="ddl_position" name="ddl_position">
                                <option>Select Position</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <div class="form-group">
                            <label>Experience (Total Years)</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label>Passport Size Image</label>
                            <input type="file" class="form-control">
                        </div>
                    </div>
                </div>
                <button class="btn btn-primary mr-1" type="submit">Add</button>
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

        $('#txt_email').keyup(function(){
            var txt_email = $(this).val();

            $.ajax({
                url: "",
            });
        });
        
    });
</script>