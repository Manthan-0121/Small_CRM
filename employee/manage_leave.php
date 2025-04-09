<?php
include("./includes/header.php");

?>

<button type="button" class="mb-4 btn btn-primary" data-toggle="modal" data-target="#exampleModal">Apply For Leave</button>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Manage Leaves Application</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <!-- <table class="table table-striped" id="table-1"> -->
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Leave Category</th>
                                <th>Start Date (DD-MM-YYYY)</th>
                                <th>End Date (DD-MM-YYYY)</th>
                                <th>Total Day</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selsql = "SELECT tbl_leave_category.type AS leave_cat_name, tbl_leave_info.leave_start_date AS leave_start_date, tbl_leave_info.leave_end_date AS leave_end_date, tbl_leave_info.leave_status AS Leave_status  FROM tbl_leave_info JOIN tbl_leave_category ON tbl_leave_info.leave_category_id = tbl_leave_category.id WHERE tbl_leave_info.employee_id = '" . $_SESSION['emp_id'] . "'";
                            $res = mysqli_query($conn, $selsql);
                            $sqn = 1;
                            while ($row = mysqli_fetch_assoc($res)) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $sqn++; ?>
                                    </td>
                                    <td><?php echo $row["leave_cat_name"] ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($row["leave_start_date"])); ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($row["leave_end_date"])); ?></td>
                                    <td>
                                        <?php
                                        $date1 = new DateTime($row["leave_start_date"]);
                                        $date2 = new DateTime($row["leave_end_date"]);
                                        $days  = $date2->diff($date1)->format('%a');

                                        if ($date1 == $date2) {
                                            echo '1 Day';
                                        } else {
                                            echo ++$days . " Days";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($row['Leave_status'] == "1") {
                                            echo "<span class=\"badge badge-success\">Approved</span>";
                                        } elseif ($row['Leave_status'] == "2") {
                                            echo "<span class=\"badge badge-light\">Pending</span>";
                                        } elseif ($row['Leave_status'] == "3") {
                                            echo "<span class=\"badge badge-warning\">Cancel</span>";
                                        } else {
                                            echo "<span class=\"badge badge-danger\">Rejected</span>";
                                        }
                                        ?>
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
                <h5 class="modal-title" id="formModal">Leave Application</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_form" enctype="multipart/form-data">
                    <input type="hidden" name="data_emp_id" id="data_emp_id" value="<?php echo $_SESSION['emp_id']; ?>">
                    <div class="form-group">
                        <div class="pretty p-default p-curve p-toggle">
                            <input type="checkbox" />
                            <div class="state p-success p-on">
                                <label>Paid</label>
                            </div>
                            <div class="state p-danger p-off">
                                <label>Unpaid </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Title</label>
                        <div class="input-group">
                            <input type="text" class="form-control" id="txt_leave_title" name="txt_leave_title" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <div class="input-group">
                            <select class="custom-select" name="ddl_lv_category" required>
                                <option value="">Select Category</option>
                                <?php
                                $sellvcatsql = "SELECT * FROM tbl_leave_category WHERE status = '1'";
                                $reslvcat = mysqli_query($conn, $sellvcatsql);
                                while ($rowlvcat = mysqli_fetch_assoc($reslvcat)) {
                                ?>
                                    <option value="<?php echo $rowlvcat['id']; ?>"><?php echo $rowlvcat['type']; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Description</label>
                        <textarea class="form-control" name="txt_description" required></textarea>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <dic class="col-6">
                                <label>Start Date</label>
                                <div class="input-group">
                                    <input type="date" class="form-control" id="dt_start_date" name="dt_start_date" required>
                                </div>
                            </dic>
                            <dic class="col-6">
                                <label>Total Day</label>
                                <div class="input-group">
                                    <input type="number" class="form-control" min="0.5" max="6" step="0.5" id="tot_day" name="dt_end_date" required>

                                </div>
                            </dic>
                        </div>
                    </div>
                    <button type="submit" id="btn_add" class="btn btn-primary waves-effect">Apply</button>
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
                url: '../ajax_files/emp_apply_leave.php',
                data: $('#add_form').serialize(),
                success: function(data) {
                    if (data == 1) {
                        alert('Leave applied succedd');
                        location.reload();
                    } else {
                        alert('Leave not applied');
                    }
                }
            });
            return false;
        });

        
        $('#dt_start_date').change(function() {
            var dt_start_date = $(this).val();
            var data_emp_id = $('#data_emp_id').val();
            $.ajax({
                type: "post",
                url: '../ajax_files/chk_leave_date.php',
                data: {dt_start_date:dt_start_date,data_emp_id:data_emp_id},
                success: function(data){
                    if(data == 1){
                        console.log("date already exist");
                    }else{
                        console.log("date not exist");
                    }
                }
            });
        });

        // $('#tot_day').keyup(function() {
        //     var tot_day = $(this).val();
        //     var start_date = $('#dt_start_date').val();
        //     var old_date = new Date(start_date);
        //     var new_date = new Date(old_date);
        //     new_date.setDate(new_date.getDate() + tot_day);

        //     var dd = new_date.getDate();
        //     var mm = new_date.getMonth() + 1;
        //     var y = new_date.getFullYear();
        //     console.log(mm + '/' + dd + '/' + y);

        //     // if(tot_day <= 1.5){

        //     //     console.log()
        //     // }
        // });
    });
</script>