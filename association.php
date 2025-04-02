<?php
include("./includes/header.php");

?>

<button type="button" class="mb-4 btn btn-primary" data-toggle="modal" data-target="#exampleModal">Add Accociation</button>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Association</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped" id="table-1">
                        <thead>
                            <tr>
                                <th class="text-center">
                                    #
                                </th>
                                <th>Section Icon</th>
                                <th>Section Name</th>
                                <th>Status</th>
                                <th>Due Date</th>
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
                                        <i class="fa-solid fa-pen-to-square"></i> Edit Section
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="formModal"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="formModal">Add New Accociation Section</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="add_form" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Section Name</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Section Name" name="txt_section_name" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Image</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="fu_img" required>
                        </div>
                    </div>
                    <button type="button" id="btn_add" class="btn btn-primary waves-effect">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>