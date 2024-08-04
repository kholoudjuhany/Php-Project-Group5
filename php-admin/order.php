<?php include ("connection/connect.php"); ?>


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

      <!-- Contant Start -->
      <div class="content-wrapper">

        <!-- Page Header Star -->
        <?php include './include/pageHeader.php'; ?>
        <!-- Page Header End -->


        <!-- Content Here ......  -->
        <!-- static start  -->
        <div class="row">
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Weekly Sales <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">$ 15,0000</h2>
                <h6 class="card-text">Increased by 60%</h6>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Weekly Orders <i
                    class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">45,6334</h2>
                <h6 class="card-text">Decreased by 10%</h6>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Visitors Online <i class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5">95,5741</h2>
                <h6 class="card-text">Increased by 5%</h6>
              </div>
            </div>
          </div>
        </div>
        <!-- static end  -->

        <!-- table  Orders start  -->
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
      <!-- table Orders end -->

      </div>
      <!-- Contant End -->


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