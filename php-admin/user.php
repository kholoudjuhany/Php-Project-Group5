<?php
include ("connection/connect.php");
try {
  // Fetch categories for display
  $stmt = $conn->prepare("SELECT `user_id`, `user_fname`, `user_lname`,`user_email`,`user_mobile`,`user_permission`FROM `users`");
  $stmt->execute();
  $users = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
  echo "Error: " . $e->getMessage();
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

      <!-- Contant Start -->
      <div class="content-wrapper">

        <!-- Page Header Star -->
        <?php include './include/pageHeaderUsers.php'; ?>
        <!-- Page Header End -->


        <!-- Content Here ......  -->
        <!-- static start  -->
        <div class="row">
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

        <!-- Modal  add user start -->
        <!-- Button trigger modal -->
        <button type="button" class="btn" style="background-color: #9a55ff; color:white; margin-bottom: 50px;  "
          data-bs-toggle="modal" data-bs-target="#addUser">
          + Add User
        </button>

        <div class="modal fade" id="addUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
          aria-labelledby="addUserLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg">
            <div class="modal-content">
              <div class="modal-header">
                <!-- <h5 class="modal-title" id="staticBackdropLabel">Add user</h5> -->
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <div class="col-12 grid-margin stretch-card" id="form">
                  <div class="card">
                    <div class="card-body">
                      <h4 class="card-title fw-bold text-center">Add User</h4>
                      <form class="forms-sample" action="crud_user/add_user.php" method="post"
                        enctype="multipart/form-data">

                        <div class="form-row">
                          <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="fname" placeholder="First Name" required>
                          </div>
                          <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="lname" placeholder="Last Name" required>
                          </div>
                        </div>
                        <div class="form-group">
                          <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="form-group">
                          <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="form-group">
                          <input type="text" class="form-control" name="mobile" placeholder="Phone Number" required>
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
        <!-- Modal add user end -->


        <!-- user table start -->
        <div class="card">
          <div class="card-body">
            <h4 class="card-title">users</h4>
            <p class="card-description">Manage your users</p>
            <div class="container mt-4">

              <div class="table-responsive">
                <div class="table-wrapper" style="max-height: 400px; overflow: auto;">
                  <table class="table table-striped">
                    <thead>
                      <tr>
                        <th>ID</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                        <th>Permission</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php foreach ($users as $user): ?>
                        <tr>
                          <td><?php echo htmlspecialchars($user['user_id']); ?></td>

                          <td><?php echo htmlspecialchars($user['user_fname']); ?></td>
                          <td><?php echo htmlspecialchars($user['user_lname']); ?></td>
                          <td><?php echo htmlspecialchars($user['user_email']); ?></td>
                          <td><?php echo htmlspecialchars($user['user_mobile']); ?></td>
                          <td><?php echo htmlspecialchars($user['user_permission']); ?></td>
                          <td class="text-left">
                            <form action="crud_user/delete_user.php" method="post" style="display: inline-block;">
                              <input type="hidden" name="userId"
                                value="<?php echo htmlspecialchars($user['user_id']); ?>">
                              <input type="hidden" name="action" value="delete">
                              <button type="submit" class="btn btn-outline-danger">
                                <i class="mdi mdi-delete-forever"></i>
                              </button>

                            </form>

                            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editModal">
                              <a href="user.php?edit=<?php echo htmlspecialchars($user['user_id']); ?> "
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
        <!-- user table end -->

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