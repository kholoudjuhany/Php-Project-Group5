<?php
include ("connection/connect.php");

try {
    // Fetch categories for display
    $stmt = $conn->prepare("SELECT `cat_id`, `cat_name`, `cat_image` FROM `categories`");
    $stmt->execute();
    $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    if (isset($_POST["catId"]) && isset($_POST["action"])) {
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
?>



<!-- Top Start -->
<?php include './include/top.php'; ?>
<!-- Top End -->


<div class="container-scroller">

    <!-- Pre Start -->
    <?php include './include/premium.php'; ?>
    <!-- Pre End -->

    <!-- top nav-bar Star -->
    <?php include './include/nav.php'; ?>
    <!-- top nav-bar End -->


    <!-- Container Page Start -->
    <div class="container-fluid page-body-wrapper">
        <!-- Aside Star -->
        <?php include './include/aside.php'; ?>
        <!-- Aside End -->


        <!-- Main Page Start -->
        <div class="main-panel">

            <!-- Content Start -->
            <div class="content-wrapper">

                <!-- Page Header Start -->
                <?php include './include/pageHeaderCategory.php'; ?>
                <!-- Page Header End -->

                <!-- Content Here ........-->

                <!-- static start  -->
                <div class="row">
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Weekly Orders <i
                                        class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5">45,6334</h2>
                                <h6 class="card-text">Decreased by 10%</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Weekly Orders <i
                                        class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5">45,6334</h2>
                                <h6 class="card-text">Decreased by 10%</h6>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 stretch-card grid-margin">
                        <div class="card bg-gradient-info card-img-holder text-white">
                            <div class="card-body">
                                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute"
                                    alt="circle-image" />
                                <h4 class="font-weight-normal mb-3">Weekly Orders <i
                                        class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                                </h4>
                                <h2 class="mb-5">45,6334</h2>
                                <h6 class="card-text">Decreased by 10%</h6>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- static end  -->


                <!-- Modal  add category start -->
                <!-- Button trigger modal -->
                <button type="button" class="btn" style="background-color: #9a55ff; color:white; margin-bottom: 50px;  "
                    data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    + Add category
                </button>

                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <!-- <h5 class="modal-title" id="staticBackdropLabel">Add category</h5> -->
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="col-12 grid-margin stretch-card" id="form">
                                    <div class="card">
                                        <div class="card-body">
                                            <h4 class="card-title fw-bold text-center">Add Category</h4>
                                            <form class="forms-sample" action="crud_category/add_category.php"
                                                method="post" enctype="multipart/form-data">
                                                <div class="form-group">

                                                    <input type="text" class="form-control" name="catName"
                                                        placeholder="Category Name" required>
                                                </div>
                                                <div class="form-group">

                                                    <input type="file" name="catImage" class="file-upload-default"
                                                        required>
                                                    <div class="input-group col-xs-12">
                                                        <input type="text" class="form-control file-upload-info"
                                                            disabled placeholder="Upload Image">
                                                        <span class="input-group-append">
                                                            <button class="file-upload-browse btn btn-gradient-primary"
                                                                type="button">Upload</button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <button type="submit"
                                                    class="btn btn-gradient-primary me-2">Submit</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- Modal add category end -->



             

                <!-- Product Edit Form -->
                <?php if (isset($_GET['edit'])): ?>
                    <?php
                    $catId = $_GET['edit'];
                    $stmt = $conn->prepare("SELECT `cat_id`, `cat_name`, `cat_image` FROM `categories` WHERE `cat_id` = :catId");
                    $stmt->bindParam(':catId', $catId);
                    $stmt->execute();
                    $category = $stmt->fetch(PDO::FETCH_ASSOC);
                    ?>

                  
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">Edit Category</h4>
                                <p class="card-description">Update category details</p>
                                <form class="forms-sample" action="category.php" method="post"
                                    enctype="multipart/form-data">
                                    <input type="hidden" name="catId"
                                        value="<?php echo htmlspecialchars($category['cat_id']); ?>">
                                    <input type="hidden" name="action" value="update">
                                    <div class="form-group">
                                        <label for="exampleInputName1">Category Name</label>
                                        <input type="text" class="form-control" name="catName" placeholder="Category Name"
                                            value="<?php echo htmlspecialchars($category['cat_name']); ?>" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="imageInput">Category Image</label>
                                        <!-- <input type="file" name="catImage" class="file-upload-default1" id="imageInput" > -->
                                        <div class="input-group col-xs-12">
                                            <input type="text" class="form-control file-upload-info1 file-upload-default1" 
                                                value="<?php echo htmlspecialchars($category['cat_image']); ?>" disabled
                                                placeholder="Upload Image">
                                            <span class="input-group-append">
                                                <button class="file-upload-browse btn btn-gradient-primary" 
                                                    type="button">Upload</button>
                                            </span>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-gradient-primary me-2">Update</button>
                                </form>
                            </div>
                        </div>
                    


                <?php endif; ?>
                <!-- End Product Edit Form -->

                <!-- Product Table  start -->
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Categories</h4>
                        <p class="card-description">Manage your categories</p>
                        <div class="container mt-4">

                            <div class="table-responsive">
                                <div class="table-wrapper" style="max-height: 400px; overflow: auto;">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Image</th>
                                                <th>Name</th>
                                                <th>Operation</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($categories as $category): ?>
                                                <tr>
                                                    <td><?php echo htmlspecialchars($category['cat_id']); ?></td>
                                                    <td class="py-1">
                                                        <img src="uploads/<?php echo htmlspecialchars($category['cat_image']); ?>"
                                                            alt="category image" width="100" />
                                                    </td>
                                                    <td><?php echo htmlspecialchars($category['cat_name']); ?></td>
                                                    <td class="text-right">
                                                        <form action="crud_category/delete_category.php" method="post"
                                                            style="display: inline-block;">
                                                            <input type="hidden" name="catId"
                                                                value="<?php echo htmlspecialchars($category['cat_id']); ?>">
                                                            <input type="hidden" name="action" value="delete">
                                                            <button type="submit" class="btn btn-outline-danger">
                                                                <i class="mdi mdi-delete-forever"></i>
                                                            </button>

                                                        </form>

                                                        <button type="button" class="btn"
                                                            data-bs-toggle="modal" data-bs-target="#editModal">
                                                              <a href="category.php?edit=<?php echo htmlspecialchars($category['cat_id']); ?> "
                                                            class="btn btn-outline-info">
                                                            <i class="mdi mdi-table-edit"></i>
                                                        </a>
                                                        </button>
                                                      

                                                    </td>
                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--  Product Table End -->
            </div>

            <!-- Content End -->



            <!-- Footer Star -->
            <?php include './include/footer.php'; ?>
            <!-- Footer End -->


            <!-- partial -->
        </div>
        <!-- Main Page End -->

    </div>
    <!-- Container Page End -->


</div>



<!-- uploads script to open start -->
<script>

    document.querySelector('.file-upload-browse').addEventListener('click', function () {
        document.querySelector('.file-upload-default').click();
    });

    document.querySelector('.file-upload-default').addEventListener('change', function () {
        var fileName = this.value.split('\\').pop();
        document.querySelector('.file-upload-info').value = fileName;
    });

    document.querySelector('.file-upload-browse1').addEventListener('click', function () {
        document.querySelector('.file-upload-default1').click();
    });

    document.querySelector('.file-upload-default1').addEventListener('change', function () {
        var fileName = this.value.split('\\').pop();
        document.querySelector('.file-upload-info1').value = fileName;
    });
</script>
<!-- uploads script to open end -->

<!-- bottom Start -->
<?php include './include/bottom.php'; ?>
<!-- bottom End -->