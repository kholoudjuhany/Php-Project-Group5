<?php include "connection/connect.php";
$stmt_order = $conn->prepare("SELECT orders.*, users.user_fname FROM orders , users where orders.user_id = users.user_id ;");
$stmt_order->execute();
$order = $stmt_order->fetchAll(PDO::FETCH_ASSOC);

$stmt_count_order = $conn->prepare('SELECT COUNT(*) as total_order  FROM orders;');
$stmt_count_order->execute();
$order_count = $stmt_count_order->fetch(PDO::FETCH_ASSOC);

$stmt_Total_amount = $conn->prepare('SELECT SUM(order_total_amount) as amount FROM orders;');
$stmt_Total_amount->execute();
$total_amount = $stmt_Total_amount->fetch(PDO::FETCH_ASSOC);


$stmt_daily_amount = $conn->prepare("SELECT SUM(order_total_amount) as daily_amount FROM orders WHERE order_date = CURRENT_DATE();");
$stmt_daily_amount->execute();
$daily_amount = $stmt_daily_amount->fetch(PDO::FETCH_ASSOC);
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
                <h4 class="font-weight-normal mb-3">Total Orders <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5"><?php echo $order_count['total_order'] ?></h2>

              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total Amount <i
                    class="mdi mdi-bookmark-outline mdi-24px float-right"></i></h4>
                <h2 class="mb-5"><?php echo $total_amount['amount']; ?></h2>

              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Daily Total Amount <i
                    class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5"><?php echo $daily_amount['daily_amount']; ?></h2>

              </div>
            </div>
          </div>
        </div>
        <!-- static end  -->

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
                              <button type="button" class="btn btn-outline-info view-details" data-bs-toggle="modal"
                                data-bs-target="#orderDetailsModal"
                                data-order-id="<?php echo htmlspecialchars($orders['order_id']); ?>">
                                <i class="mdi mdi-table-edit"></i>
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
        </div>
        <!-- table Orders end -->

        <!-- Modal Start -->
        <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsModalLabel"
          aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel">Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <!-- Order details will be loaded here via AJAX -->
              </div>
            </div>
          </div>
        </div>
        <!-- Modal End -->

      </div>
      <!-- Content End -->

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

<!-- AJAX Script -->
<script>
  document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.view-details').forEach(function (button) {
      button.addEventListener('click', function () {
        var orderId = this.getAttribute('data-order-id');
        var modalBody = document.querySelector('#orderDetailsModal .modal-body');
        modalBody.innerHTML = ''; // Clear previous content

        fetch('order_details.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
          },
          body: 'orderyid=' + orderId
        })
          .then(response => response.text())
          .then(data => {
            modalBody.innerHTML = data;

            // Add delete functionality
            modalBody.querySelectorAll('form').forEach(function (form) {
              form.addEventListener('submit', function (event) {
                event.preventDefault();
                fetch('order_details.php', {
                  method: 'POST',
                  headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                  },
                  body: new URLSearchParams(new FormData(form))
                })
                  .then(response => response.text())
                  .then(data => {
                    modalBody.innerHTML = data;
                  })
                  .catch(error => console.error('Error:', error));
              });
            });
          })
          .catch(error => console.error('Error:', error));
      });
    });
  });
</script>