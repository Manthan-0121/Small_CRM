<?php
include("./includes/header.php");

?>

<a href="add_section.php" type="button" class="mb-4 btn btn-primary">Add Section</a>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Manage Section</h4>
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
                                <th>Containt</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    1
                                </td>
                                <td class="align-middle">
                                    <img alt="image" src="assets/img/users/user-5.png" width="35">
                                </td>
                                <td>About Company</td>
                                <td>
                                    <div class="pretty p-switch p-fill">
                                        <input type="checkbox" />
                                        <div class="state p-success">
                                            <label>Enable</label>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <a href="manage_section.php" class="btn btn-primary" type="button">
                                        <i class="fa-solid fa-pen-to-square"></i> Edit
                                    </a>
                                    <div class="dropdown d-inline">
                                        <div class="dropdown-menu">

                                            <a class="dropdown-item has-icon" href="#"><i class="far fa-file"></i> </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
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