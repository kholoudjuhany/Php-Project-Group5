<?php
// ob_start();

include ("connection/connect.php");


// Fetch categories for display
$stmt = $conn->prepare("SELECT products.product_id, products.pro_name, products.pro_desc, products.pro_price, products.pro_qty, products.pro_create_date,
 products.pro_discount, products.cat_id , categories.cat_name FROM products , categories
 WHERE products.cat_id =categories.cat_id ");

$stmt->execute();
$products = $stmt->fetchAll(PDO::FETCH_ASSOC);


?>
<?php
$stmt = $conn->prepare("SELECT COUNT(*) as count FROM `products` WHERE 1");

$stmt->execute();
$count = $stmt->fetch(PDO::FETCH_ASSOC);


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

    <style>
      .description-cell {
        max-width: 200px;

        word-wrap: break-word;
        white-space: normal;
        overflow: hidden;
        text-overflow: ellipsis;
      }

      .description-cell {
        max-height: 100px;
        overflow-y: auto;
      }
    </style>
    <!-- Main Page Start -->
    <div class="main-panel">

      <!-- Contant Start -->
      <div class="content-wrapper">

        <!-- Page Header Star -->
        <?php include './include/pageHeaderProducts.php'; ?>
        <!-- Page Header End -->


        <!-- Content Here ......  -->

        <!-- static start  -->
        <div class="row">
          <div class="col-md-12 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">product count <i
                    class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5"><?php echo $count['count']; ?></h2>

              </div>
            </div>
          </div>


        </div>
        <!-- static end  -->

        <!-- add form modal start -->
        <button type="button" class="btn" style="background-color: #9a55ff; color:white;margin-bottom: 50px;" data-bs-toggle="modal"
          data-bs-target="#staticBackdrop">
          + Add product
        </button>
        <!-- Modal -->
        <!-- Add Product Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
          aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="staticBackdropLabel">Add Product</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="col-12 grid-margin stretch-card">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title">Add Product Form</h4>
                      <p class="card-description">Fill in the details to add a new product</p>
                      <form action="CURD_Products/add_product.php" method="post" enctype="multipart/form-data"
                        class="forms-sample">
                        <div class="form-group">
                          <label for="productName">Product Name</label>
                          <input type="text" class="form-control" id="productName" name="productName"
                            placeholder="Product Name" required>
                        </div>
                        <div class="form-group">
                          <label for="productPrice">Product Price</label>
                          <input type="number" class="form-control" id="productPrice" name="productPrice"
                            placeholder="Product Price" required>
                        </div>
                        <div class="form-group">
                          <label for="productQty">Product Quantity</label>
                          <input type="number" class="form-control" id="productQty" name="productQty"
                            placeholder="Product Quantity" required>
                        </div>
                        <div class="form-group">
                          <label for="categoryId">Category</label>
                          <select class="form-control" id="categoryId" name="categoryId" required>
                            <?php
                            include ("../connection/connect.php");
                            $stmt = $conn->prepare("SELECT `cat_id`, `cat_name` FROM `categories`");
                            $stmt->execute();
                            $categories = $stmt->fetchAll(PDO::FETCH_ASSOC);
                            foreach ($categories as $category): ?>
                              <option value="<?php echo htmlspecialchars($category['cat_id']); ?>">
                                <?php echo htmlspecialchars($category['cat_name']); ?>
                              </option>
                            <?php endforeach; ?>
                          </select>
                        </div>

                        <div class="form-group">
                          <label for="productDiscount">Discount</label>
                          <input type="number" class="form-control" id="productDiscount" name="productDiscount"
                            placeholder="Discount">
                        </div>
                        <div class="form-group">
                          <label for="productDescription">Description</label>
                          <textarea class="form-control" id="productDescription" name="productDescription" rows="4"
                            required></textarea>
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
        <!-- add form modal end -->



        <!-- product table start -->
        <div class="grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Products</h4>
              <p class="card-description">Manage your Products</p>
              <div class="container mt-4">

                <div class="table-responsive">
                  <div class="table-wrapper" style="max-height: 400px; overflow: auto;">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <!-- <th>Image</th> -->
                          <th>ID</th>
                          <th>Name</th>
                          <th>Description</th>
                          <th>Price</th>
                          <th>Quantity</th>
                          <th>Discount</th>
                          <th>Category</th>
                          <th class="text-right">Operation</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($products as $product): ?>
                          <tr>
                            <!-- <td>
                        <?php if (!empty($product['pro_image'])): ?>
                          <img src="path/to/images/<?php echo htmlspecialchars($product['pro_image']); ?>" alt="Product Image" style="width: 100px; height: auto;">
                        <?php else: ?>
                          No Image
                        <?php endif; ?>
                      </td> -->
                            <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                            <td><?php echo htmlspecialchars($product['pro_name']); ?></td>
                            <td class="description-cell"><?php echo htmlspecialchars($product['pro_desc']); ?></td>
                            <td><?php echo htmlspecialchars($product['pro_price']); ?></td>
                            <td><?php echo htmlspecialchars($product['pro_qty']); ?></td>
                            <td><?php echo htmlspecialchars($product['pro_discount']); ?></td>
                            <td><?php echo htmlspecialchars($product['cat_name']); ?></td>
                            <td class="text-right">
                              <form action="CURD_Products/delete_product.php" method="post"
                                style="display: inline-block;">
                                <input type="hidden" name="productId"
                                  value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                <input type="hidden" name="action" value="delete">
                                <button type="submit" class="btn btn-outline-danger">
                                  <i class="mdi mdi-delete-forever"></i>
                                </button>
                              </form>
                              <form action="CURD_Products/update_product.php" method="post"
                                style="display: inline-block;">
                                <input type="hidden" name="productId"
                                  value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                <input type="hidden" name="catId"
                                  value="<?php echo htmlspecialchars($product['cat_id']); ?>">
                                <button type="button" class="btn btn-outline-info" data-bs-toggle="modal"
                                  data-bs-target="#editForm">
                                  <i class="mdi mdi-table-edit"></i>
                                </button>
                              </form>
                              <form action="" method="post" style="display: inline-block;">
                                <input type="hidden" name="productId"
                                  value="<?php echo htmlspecialchars($product['product_id']); ?>">
                                <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal"
                                  data-bs-target="#addImageForm">
                                  <i class="mdi mdi-image-multiplemdi mdi-file-image"></i>
                                </button>
                              </form>

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
        </div>
        <!-- product table end -->

      </div>
      <!-- Contant End -->

      <!-- include add image modal start -->
      <?php include "CURD_Products/add_image_product.php" ?>
      <!-- include  add image modal end -->

      <!-- include edit modal start -->
      <?php include "CURD_Products/update_product.php"; ?>
      <!-- include edit modal end -->

      <!-- Footer Star -->
      <?php include './include/footer.php'; ?>
      <!-- Footer End -->


      <!-- partial -->
    </div>
    <!-- Main Page End -->

  </div>
  <!-- Container Page End -->


</div>

<!-- bottom Start -->
<?php include './include/bottom.php'; ?>
<!-- bottom End -->