<?php
// Start output buffering
// ob_start();
// include("connection/connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["catId"])) {
        $catId = $_POST['catId'];
        $action = $_POST['action'];

        if ($action == "update") {
            $catName = $_POST['catName'];
            $catImage = $_FILES['catImage']['name'];
            $targetDir = "uploads/";
            $targetFile = $targetDir . basename($catImage);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));
            
            if ($catImage) {
                // Validate image file type and size
                $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');
                if (in_array($imageFileType, $allowedTypes) && $_FILES['catImage']['size'] <= 5000000) {
                    if (move_uploaded_file($_FILES['catImage']['tmp_name'], $targetFile)) {
                        // File uploaded successfully
                    } else {
                        echo "Error uploading the file.";
                        exit();
                    }
                } else {
                    echo "Invalid file type or size.";
                    exit();
                }
            } else {
                // Retrieve the existing image if no new image is uploaded
                $stmt = $conn->prepare("SELECT `cat_image` FROM `categories` WHERE `cat_id` = :catId");
                $stmt->bindParam(':catId', $catId);
                $stmt->execute();
                $category = $stmt->fetch(PDO::FETCH_ASSOC);
                $catImage = $category['cat_image'];
            }

            try {
                $stmt = $conn->prepare("UPDATE `categories` SET `cat_name` = :catName, `cat_image` = :catImage WHERE `cat_id` = :catId");
                $stmt->bindParam(':catName', $catName);
                $stmt->bindParam(':catImage', $catImage);
                $stmt->bindParam(':catId', $catId);
                $stmt->execute();
                header("Location: category.php");
                exit();
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }
    }
}

$stmt = $conn->prepare("SELECT `cat_id`, `cat_name`, `cat_image` FROM `categories`");
$stmt->execute();
$categories = $stmt->fetchAll(PDO::FETCH_ASSOC);

// End output buffering and flush the output
ob_end_flush();
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
                            <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post"
                                enctype="multipart/form-data">
                                <input type="hidden" name="catId" id="editCatId">
                                <input type="hidden" name="action" value="update">
                                <div class="form-group">
                                    <label for="editCatName">Category Name</label>
                                    <input type="text" class="form-control" name="catName" id="editCatName"
                                        placeholder="Category Name" required>
                                </div>
                                <div class="form-group">
                                    <label for="imageInput">Category Image</label>
                                    <input type="file" name="catImage" id="fileUploadDefault">
                                    <div class="input-group col-xs-12">
                                        <input type="text" id="fileUploadInfo" class="fileUploadInfo form-control" disabled
                                            placeholder="Upload Image">
                                        <span class="input-group-append">
                                            <button id="fileUploadBrowse" class="fileUploadBrowse btn btn-gradient-primary" type="button">Upload</button>
                                        </span>
                                    </div>
                                    <!-- <img id="imagePreview" src="" alt="Image Preview" style="max-width: 100px; margin-top: 10px;"> -->
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
    document.getElementById('fileUploadBrowse').addEventListener('click', function() {
        document.getElementById('fileUploadDefault').click();
    });

    document.getElementById('fileUploadDefault').addEventListener('change', function() {
        var fileName = this.value.split('\\').pop();
        document.getElementById('fileUploadInfo').value = fileName;

        // Show image preview
        var file = this.files[0];
        var preview = document.getElementById('imagePreview');
        if (file) {
            var reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    function populateEditForm(catId, catName, catImage) {
        document.getElementById('editCatId').value = catId;
        document.getElementById('editCatName').value = catName;

        // Display existing image
        var preview = document.getElementById('imagePreview');
        if (catImage) {
            preview.src = 'uploads/' + catImage;
        } else {
            preview.src = ''; // Or set a default placeholder image
        }
    }
</script>