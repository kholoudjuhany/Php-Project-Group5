<?php


if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["productId"]) && !empty($_FILES['img']['name'][0])) {
    $productId = $_POST["productId"];
    $uploadDir = 'uploads/'; // Ensure this directory is writable and correctly set

    foreach ($_FILES['img']['name'] as $key => $name) {
        $tmpName = $_FILES['img']['tmp_name'][$key];
        $uploadFile = $uploadDir . basename($name);

        // Validate file upload
        if (move_uploaded_file($tmpName, $uploadFile)) {
            try {
                // Insert image info into the database
                $stmt = $conn->prepare("INSERT INTO product_images (pro_image, product_id) VALUES (:pro_image, :product_id)");
                $stmt->bindParam(':pro_image', $name);
                $stmt->bindParam(':product_id', $productId);
                $stmt->execute();
            } catch (PDOException $e) {
                // Handle potential database errors
                echo "Database error: " . $e->getMessage();
            }
        } else {
            // Handle file upload errors
            echo "Failed to upload file: " . htmlspecialchars($name);
        }
    }
    // Redirect to the products page or display a success message
    // header("Location: products.php");
    exit();
}
?>




    <!-- Modal -->
    <!-- Edit Form Modal Start -->
    <div class="modal fade" id="addImageForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="addImageForm" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editFormLabel">add image Product Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="col-12 grid-margin stretch-card">
                        <div class="card">
                            <div class="card-body">


                                <form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" class="forms-sample">
                                    <input type="hidden" name="productId" value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                    <div class="form-group">
                                        <label for="productImage">Product Image</label>
                                        <input type="file" id="productImage" name="img[]" class="file-upload-default" multiple>
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info" disabled placeholder="Upload Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-gradient-primary" type="button">Upload</button>
                                            </span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-gradient-primary me-2">Submit</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Form Modal End -->
    <script>
        document.querySelector('.file-upload-browse').addEventListener('click', function() {
            document.querySelector('.file-upload-default').click();
        });

        document.querySelector('.file-upload-default').addEventListener('change', function() {
            var fileName = this.value.split('\\').pop();
            document.querySelector('.file-upload-info').value = fileName;
        });
    </script>