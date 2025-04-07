<?php
include("./includes/header.php");

?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Manage Leave Application</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Employee Name</th>
                                <th>Leave Title</th>
                                <th>Leave Type</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                                <th>Total Days</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $selleaveinfosql = "SELECT tbl_employee.first_name AS emp_fname, tbl_employee.last_name AS emp_lname, tbl_leave_category.type AS leave_category_type, tbl_leave_info.leave_start_date AS leave_start_date, tbl_leave_info.leave_end_date AS leave_end_date, tbl_leave_info.leave_status AS leave_status, tbl_leave_info.leave_title AS leave_title, tbl_leave_info.id AS leave_id FROM tbl_leave_info JOIN tbl_employee ON tbl_leave_info.employee_id = tbl_employee.id JOIN tbl_leave_category ON tbl_leave_info.leave_category_id = tbl_leave_category.id";

                            $selleaveinfores = mysqli_query($conn, $selleaveinfosql);
                            $sqno = 1;
                            while ($selleaveinforow = mysqli_fetch_array($selleaveinfores)) {
                            ?>
                                <tr>
                                    <td>
                                        <?php echo $sqno++; ?>
                                    </td>
                                    <td><?php echo $selleaveinforow['emp_fname'] . " " . $selleaveinforow['emp_lname']; ?></td>
                                    <td><?php echo $selleaveinforow['leave_title']; ?></td>
                                    <td><?php echo $selleaveinforow['leave_category_type']; ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($selleaveinforow["leave_start_date"])); ?></td>
                                    <td><?php echo date("d-m-Y", strtotime($selleaveinforow["leave_end_date"])); ?></td>
                                    <td>
                                        <?php
                                        $date1 = new DateTime($selleaveinforow["leave_start_date"]);
                                        $date2 = new DateTime($selleaveinforow["leave_end_date"]);
                                        $days  = $date2->diff($date1)->format('%a');

                                        if ($date1 == $date2) {
                                            echo '1 Day';
                                        } else {
                                            echo $days . " Days";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($selleaveinforow['leave_status'] == "1") {
                                            echo "<span class=\"badge badge-success\">Approved</span>";
                                        } elseif ($selleaveinforow['leave_status'] == "2") {
                                            echo "<span class=\"badge badge-light\">Pending</span>";
                                        } else {
                                            echo "<span class=\"badge badge-danger\">Rejected</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="updt_leave_dtl.php?lv_id=<?php echo $selleaveinforow['leave_id']?>" class="btn btn-primary">
                                            <i class="fa-solid fa-pen-to-square"></i>
                                        </a>
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