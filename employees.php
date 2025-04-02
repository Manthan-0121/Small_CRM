<?php
include("./includes/header.php");

?>

<a href="add_employee.php" type="button" class="mb-4 btn btn-primary">Add Employee</a>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Manage Employee</h4>
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
                                <th>Name</th>
                                <th>Department</th>
                                <th>Position</th>
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
                                    <button class="btn btn-success" type="button" data-toggle="modal"
                                        data-target=".bd-example-modal-lg">
                                        <i class="fa-solid fa-eye"></i>
                                    </button>
                                    <a href="#" class="btn btn-primary" type="button">
                                        <i class="fa-solid fa-pen-to-square"></i>
                                    </a>
                                    <button class="btn btn-danger" type="button" data-toggle="modal"
                                        data-target=".bd-example-modal-lg">
                                        <i class="fa-solid fa-user-minus"></i>
                                    </button>
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

<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="myLargeModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Content goes here....
            </div>
        </div>
    </div>
</div>