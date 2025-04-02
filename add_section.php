<?php
include("./includes/header.php");

?>

<a href="manage_section.php" type="button" class="mb-4 btn btn-primary">Back</a>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h4>Add new Section</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Content</label>
                    <textarea class="summernote-simple"></textarea>
                </div>
                <div class="form-group">
                    <label>Image</label>
                    <input type="file" class="form-control">
                </div>
                <button class="btn btn-primary mr-1" type="submit">Submit</button>
            </div>
        </div>
    </div>
</div>

<?php
include("./includes/footer.php");
?>