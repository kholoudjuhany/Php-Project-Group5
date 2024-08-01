<?php
include("connection/connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["catId"])) {
        $catId = $_POST['catId'];
        $action = $_POST['action'];

        if ($action == "update") {
            // Fetch the updated data
            $catName = $_POST['catName'];
            $catImage = $_FILES['catImage']['name'];

            // Check if a new image is uploaded
            if ($catImage) {
                // Handle image upload
                move_uploaded_file($_FILES['catImage']['tmp_name'], "uploads/" . $catImage);
            } else {
                // Keep the existing image if no new image is uploaded
                $stmt = $conn->prepare("SELECT `cat_image` FROM `categories` WHERE `cat_id` = :catId");
                $stmt->bindParam(':catId', $catId);
                $stmt->execute();
                $category = $stmt->fetch(PDO::FETCH_ASSOC);
                $catImage = $category['cat_image'];
            }

            try {
                // Prepare the SQL statement to update the category
                $stmt = $conn->prepare("UPDATE `categories` SET `cat_name` = :catName, `cat_image` = :catImage WHERE `cat_id` = :catId");
                // Bind the parameters
                $stmt->bindParam(':catName', $catName);
                $stmt->bindParam(':catImage', $catImage);
                $stmt->bindParam(':catId', $catId);
                // Execute the statement
                $stmt->execute();

                // Redirect to the category page after updating
                header("Location: category.php");
                exit();
            } catch (PDOException $e) {
                // Error message
                echo "Error: " . $e->getMessage();
            }
        }
    }
}

// Fetch categories for display
$stmt = $conn->prepare("SELECT `cat_id`, `cat_name`, `cat_image` FROM `categories`");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Edit Category Modal -->
<div class="modal fade" id="editFormCat" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 grid-margin stretch-card" id="form">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Edit Category</h4>
                            <p class="card-description">Update category details</p>
                            <form class="forms-sample" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post"
                                enctype="multipart/form-data">
                                <input type="hidden" name="catId" id="editCatId">
                                <input type="hidden" name="action" value="update">
                                <div class="form-group">
                                    <label for="exampleInputName">Category Name</label>
                                    <input type="text" class="form-control" name="catName" id="editCatName"
                                        placeholder="Category Name" value="" required>
                                </div>
                                <div class="form-group">
                                    <label for="imageInput">Category Image</label>
                                    <input type="file" name="catImage" class="file-upload-default" id="imageInput">
                                    <div class="input-group col-xs-12">
                                        <input type="text" class="form-control file-upload-info" disabled
                                            placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                        </span>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.querySelector('.file-upload-browse').addEventListener('click', function () {
    document.querySelector('.file-upload-default').click();
});

document.querySelector('.file-upload-default').addEventListener('change', function () {
    var fileName = this.value.split('\\').pop();
    document.querySelector('.file-upload-info').value = fileName;
});

function populateEditForm(catId, catName, catImage) {
    document.getElementById('editCatId').value = catId;
    document.getElementById('editCatName').value = catName;
    document.querySelector('.file-upload-info').value = catImage;
}
</script>
