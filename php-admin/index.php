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
        <?php
        include 'connection/connect.php';
        $stmt_users = $conn->prepare('SELECT COUNT(*) as count_user FROM users;');
        $stmt_users->execute();
        $usersboard = $stmt_users->fetch(PDO::FETCH_ASSOC);
        $user_count = $usersboard['count_user'];

        $stmt_category = $conn->prepare('SELECT COUNT(*) as category_count FROM categories');
        $stmt_category->execute();
        $categoryboard = $stmt_category->fetch(PDO::FETCH_ASSOC);
        $category_count = $categoryboard['category_count'];

        $stmt_product = $conn->prepare("SELECT COUNT(*) as product_count FROM products");
        $stmt_product->execute();
        $count = $stmt_product->fetch(PDO::FETCH_ASSOC);

        // Fetch daily purchases data
        $stmt_purchases = $conn->prepare("SELECT DATE(order_date) as date, COUNT(*) as total_purchases 
                                          FROM orders 
                                          GROUP BY DATE(order_date) 
                                          ORDER BY DATE(order_date) DESC");
        $stmt_purchases->execute();
        $purchases_data = $stmt_purchases->fetchAll(PDO::FETCH_ASSOC);
        ?>
        <div class="row">
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total Users <i class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5"><?php echo $user_count; ?> </h2>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total Category <i class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5"><?php echo $category_count; ?></h2>
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-success card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total Products <i class="mdi mdi-diamond mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5"><?php echo $count['product_count'] ?></h2>
              </div>
            </div>
          </div>
        </div>
        <!-- static end  -->

        <!-- Chart Start -->
        <div class="col-lg-12 grid-margin stretch-card">
          <div class="card">
            <div class="card-body">
              <h4 class="card-title">Daily Purchases Chart</h4>
              <div>
                <canvas id="myChart"></canvas>
              </div>
            </div>
          </div>
        </div>
        <!-- Chart End -->

        <!-- Contant End -->
        <!-- Footer Start -->
        <?php include './include/footer.php'; ?>
        <!-- Footer End -->
      </div>
      <!-- Main Page End -->
    </div>
    <!-- Container Page End -->
  </div>

  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script>
    const ctx = document.getElementById('myChart');
    const purchasesData = <?php echo json_encode($purchases_data); ?>;
    const labels = purchasesData.map(data => data.date);
    const data = purchasesData.map(data => data.total_purchases);

    new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Number of Purchases',
          data: data,
          backgroundColor: 'rgba(75, 192, 192, 0.2)',
          borderColor: 'rgba(75, 192, 192, 1)',
          borderWidth: 1
        }]
      },
      options: {
        scales: {
          x: {
            beginAtZero: true
          },
          y: {
            beginAtZero: true
          }
        }
      }
    });
  </script>

  <!-- Bottom Start -->
  <?php include './include/bottom.php'; ?>
  <!-- Bottom End -->
</div>