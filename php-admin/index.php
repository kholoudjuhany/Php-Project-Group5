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
        $stmt_users = $conn->prepare('SELECT COUNT(*) as count_user  FROM users;');
        $stmt_users-> execute();
        $usersboard = $stmt_users->fetch(PDO::FETCH_ASSOC);
        $user_count = $usersboard['count_user'];

        $stmt_category = $conn->prepare('SELECT COUNT(*) as category_count FROM categories');
        $stmt_category-> execute();
        $categoryboard = $stmt_category-> fetch(PDO::FETCH_ASSOC);
        $category_count = $categoryboard ['category_count'];

        $stmt_product = $conn->prepare("SELECT COUNT(*) product_count FROM `products`");
        $stmt_product->execute();
        $count = $stmt_product->fetch(PDO::FETCH_ASSOC);

        ?>

        <div class="row">
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-danger card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total Users <i
                    class="mdi mdi-chart-line mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5"><?php echo $user_count; ?> </h2>
            
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
            <div class="card bg-gradient-info card-img-holder text-white">
              <div class="card-body">
                <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                <h4 class="font-weight-normal mb-3">Total category <i
                    class="mdi mdi-bookmark-outline mdi-24px float-right"></i>
                </h4>
                <h2 class="mb-5"><?php echo  $category_count; ?></h2>
                
              </div>
            </div>
          </div>
          <div class="col-md-4 stretch-card grid-margin">
                <div class="card bg-gradient-success card-img-holder text-white">
                  <div class="card-body">
                    <img src="assets/images/dashboard/circle.svg" class="card-img-absolute" alt="circle-image" />
                    <h4 class="font-weight-normal mb-3">Total products <i class="mdi mdi-diamond mdi-24px float-right"></i>
                    </h4>
                    <h2 class="mb-5"><?php echo  $count ['product_count']?></h2>
                    
                  </div>
                </div>
              </div>
        </div>
        <!-- static end  -->



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