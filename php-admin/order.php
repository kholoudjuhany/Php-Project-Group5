<?php include ("connection/connect.php");
$stmt_order = $conn->prepare("SELECT * FROM orders;");
$stmt_order->execute();
$order = $stmt_order->fetchAll(PDO::FETCH_ASSOC);
?>

<!-- Top Start -->
<?php include './include/top.php'; ?>
<!-- Top End -->

<div class="container-scroller">

  <!-- Pre Start -->
  <?php include './include/premium.php'; ?>
  <!-- Pre End -->

  <!-- top nav-bar Start -->
  <?php include './include/nav.php'; ?>
  <!-- top nav-bar End -->

  <!-- Container Page Start -->
  <div class="container-fluid page-body-wrapper">
    <!-- Aside Start -->
    <?php include './include/aside.php'; ?>
    <!-- Aside End -->

    <!-- Main Page Start -->
    <div class="main-panel">

      <!-- Content Start -->
      <div class="content-wrapper">

        <!-- Page Header Start -->
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
                    class="mdi mdi-bookmark-outline mdi-24px float-right"></i></h4>
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
        <?php include "order_details.php"; ?>

        <!-- table Orders start  -->
        <div class="grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Orders</h4>
              <p class="card-description">Manage your orders</p>
              <div class="container mt-4">
                <div class="table-responsive">
                  <div class="table-wrapper" style="max-height: 400px; overflow: auto;">
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>Order ID</th>
                          <th>Order Date</th>
                          <th>Total Amount</th>
                          <th>User ID</th>
                          <th class="text-right">Operation</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php foreach ($order as $orders): ?>
                          <tr>
                            <td><?php echo htmlspecialchars($orders['order_id']); ?></td>
                            <td><?php echo htmlspecialchars($orders['order_date']); ?></td>
                            <td class="description-cell"><?php echo htmlspecialchars($orders['order_total_amount']); ?>
                            </td>
                            <td><?php echo htmlspecialchars($orders['user_id']); ?></td>
                            <td class="text-right">
                              <form action="order.php" method="post">
                                <input type="hidden" name="orderyid"
                                  value="<?php echo htmlspecialchars($orders['order_id']); ?>">
                                <button type="submit" class="btn btn-outline-info" data-bs-toggle="modal"
                                  data-bs-target="#show-pell">
                                  <i class="mdi mdi-table-edit"></i>
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
      <!-- Content End -->

      <!-- Modal Start -->
      <div class="modal fade" id="show-pell" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <?php include "order_details.php"; ?>
            </div>
          </div>
        </div>
      </div>
      <!-- Modal End -->

      <!-- Footer Start -->
      <?php include './include/footer.php'; ?>
      <!-- Footer End -->
    </div>
    <!-- Main Page End -->
  </div>
  <!-- Container Page End -->
</div>

<!-- bottom Start -->
<?php include './include/bottom.php'; ?>
<!-- bottom End -->