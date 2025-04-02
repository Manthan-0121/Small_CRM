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
                            <tr>
                                <td>
                                    1
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
                                    <a href="#" class="btn btn-primary" type="button">
                                        <i class="fa-solid fa-pen-to-square"></i> 
                                    </a>
                                    <a href="#" class="btn btn-danger" type="button">
                                        <i class="fa-solid fa-trash"></i> 
                                    </a>
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
                            <input type="text" class="form-control" placeholder="Section Name" name="txt_section_name" required>
                        </div>  
                    </div>
                    <button type="button" id="btn_add" class="btn btn-primary waves-effect">Add</button>
                </form>
            </div>
        </div>
    </div>
</div>