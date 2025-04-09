<?php
include("./includes/header.php");

?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Manage Leave Application</h4>
            </div>
            <div class="form-group col-3 mt-4">
                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search" name="txt_search" aria-label="">
                        <div class="input-group-append">
                            <button class="btn btn-primary" type="submit" name="btn_search">Search</button>
                        </div>
                    </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center"><button type="submit" class="btn btn-default" name="btn_sqn">#</button></th>
                                <th><button type="submit" class="btn btn-default" name="btn_emp_name">Employee Name</button></th>
                                <th><button type="submit" class="btn btn-default" name="btn_title">Title</button></th>
                                <th><button type="submit" class="btn btn-default" name="btn_leave_type">Leave Type</button></th>
                                <th><button type="submit" class="btn btn-default" name="btn_start_date">Start Date</button></th>
                                <th><button type="submit" class="btn btn-default" name="btn_end_date">End Date</button></th>
                                <th>Total Days</th>
                                <th><button type="submit" class="btn btn-default" name="btn_status">Status</button></th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            $limit = 5;
                            if (isset($_GET['page'])) {
                                $page = mysqli_real_escape_string($conn, $_GET['page']);
                            } else {
                                $page = 1;
                            }
                            $offset = ($page - 1) * $limit;

                            $selleaveinfosql = "SELECT tbl_employee.first_name AS emp_fname, tbl_employee.last_name AS emp_lname, tbl_leave_category.type AS leave_category_type, tbl_leave_info.leave_start_date AS leave_start_date, tbl_leave_info.leave_end_date AS leave_end_date, tbl_leave_info.leave_status AS leave_status, tbl_leave_info.leave_title AS leave_title, tbl_leave_info.id AS leave_id FROM tbl_leave_info JOIN tbl_employee ON tbl_leave_info.employee_id = tbl_employee.id JOIN tbl_leave_category ON tbl_leave_info.leave_category_id = tbl_leave_category.id";

                            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                                if (isset($_POST['btn_search'])) {
                                    $txt_search = mysqli_real_escape_string($conn, $_POST['txt_search']);
                                    $selleaveinfosql .= " WHERE tbl_employee.first_name LIKE '%" . $txt_search . "%' OR tbl_employee.last_name LIKE '%" . $txt_search . "%'";
                                } elseif (isset($_POST["btn_emp_name"])) {
                                    $selleaveinfosql .= " ORDER BY tbl_employee.first_name ASC";
                                } elseif (isset($_POST["btn_title"])) {
                                    $selleaveinfosql .= " ORDER BY tbl_leave_category.type ASC";
                                } elseif (isset($_POST["btn_leave_type"])) {
                                    $selleaveinfosql .= " ORDER BY tbl_leave_info.leave_title ASC";
                                } elseif (isset($_POST["btn_start_date"])) {
                                    $selleaveinfosql .= " ORDER BY tbl_leave_info.leave_start_date ASC";
                                } elseif (isset($_POST["btn_end_date"])) {
                                    $selleaveinfosql .= " ORDER BY tbl_leave_info.leave_end_date ASC";
                                } elseif (isset($_POST["btn_status"])) {
                                    $selleaveinfosql .= " ORDER BY tbl_leave_info.leave_status ASC";
                                } elseif (isset($_POST["btn_sqn"])) {
                                    $selleaveinfosql .= "";
                                }
                            }
                            $pgres = mysqli_query($conn, $selleaveinfosql);
                            $total_record = mysqli_num_rows($pgres);
                            $total_page = ceil($total_record / $limit);

                            $selleaveinfosql .= " LIMIT $offset,$limit";

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
                                            echo ++$days . " Days";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php
                                        if ($selleaveinforow['leave_status'] == "1") {
                                            echo "<span class=\"badge badge-success\">Approved</span>";
                                        } elseif ($selleaveinforow['leave_status'] == "2") {
                                            echo "<span class=\"badge badge-light\">Pending</span>";
                                        } elseif ($selleaveinforow['leave_status'] == "3") {
                                            echo "<span class=\"badge badge-warning\">Cancel </span>";
                                        } else {
                                            echo "<span class=\"badge badge-danger\">Rejected</span>";
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <a href="updt_leave_dtl.php?lv_id=<?php echo $selleaveinforow['leave_id'] ?>" class="btn btn-primary">
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
                    <ul class="pagination">
                        <?php
                        for ($i = 1; $i <= $total_page; $i++) {
                            if ($i == $page) {
                                $active = "active";
                            } else {
                                $active = "";
                            }
                        ?>
                            <li class="page-item <?php echo $active; ?>"><a class="page-link" href="leave_manage.php?page=<?php echo $i; ?>"><?php echo $i ?></a></li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include("./includes/footer.php");
?>