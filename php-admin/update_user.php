<?php
include("./connection/connect.php");

// Handle form submission for updating user and address
$user = [];
$address = [];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
    $userid = $_POST['user_id'];

    try {
        // Fetch user details
        $stmt = $conn->prepare("SELECT user_id, user_fname, user_lname, user_email, user_mobile FROM users WHERE user_id = :id");
        $stmt->bindParam(":id", $userid);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        // Fetch address details
        $stmt2 = $conn->prepare("SELECT city, street, building_num FROM `address` WHERE user_id = :id limit 1");
        $stmt2->bindParam(":id", $userid);
        $stmt2->execute();
        $address = $stmt2->fetch(PDO::FETCH_ASSOC);

        // Check if data is retrieved successfully
        // if (!$user || !$address) {
        //     throw new Exception("User or address data not found.");
        // }

        // Update user and address details
        if (isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["mobile"]) && isset($_POST["city"]) && isset($_POST["street"]) && isset($_POST["building_num"])) {
            $fname = $_POST["fname"];
            $lname = $_POST["lname"];
            $email = $_POST["email"];
            $mobile = $_POST["mobile"];
            $city = $_POST["city"];
            $street = $_POST["street"];
            $building_num = $_POST["building_num"];

            // Update user details
            $stmt3 = $conn->prepare("UPDATE users SET user_fname = :firstn, user_lname = :lastn, user_email = :email, user_mobile = :mobile WHERE user_id = :id");
            $stmt3->bindParam(":firstn", $fname);
            $stmt3->bindParam(":lastn", $lname);
            $stmt3->bindParam(":email", $email);
            $stmt3->bindParam(":mobile", $mobile);
            $stmt3->bindParam(":id", $userid);
            $stmt3->execute();

            // Update address details
            $stmt4 = $conn->prepare("UPDATE address SET city = :ci, street = :st, building_num = :bu WHERE user_id = :id");
            $stmt4->bindParam(":ci", $city);
            $stmt4->bindParam(":st", $street);
            $stmt4->bindParam(":bu", $building_num);
            $stmt4->bindParam(":id", $userid);
            $stmt4->execute();

            // Optional: Redirect to avoid re-submission
            header("Location:user.php ");
            exit();
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
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

            <!-- Contant Start -->
            <div class="content-wrapper">

                <!-- Page Header Star -->
                <?php include './include/pageHeaderUsers.php'; ?>
                <!-- Page Header End -->


                <!-- Content Here ......  -->


                <!-- edit user start -->
                <div class="col-12 grid-margin stretch-card" id="form">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title fw-bold text-center">Edit User</h4>
                            <form class="forms-sample" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="user_id" value="<?php echo htmlspecialchars($userid); ?>">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="fname" placeholder="First Name" value="<?php echo htmlspecialchars(isset($user['user_fname']) ? $user['user_fname'] : ''); ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="lname" placeholder="Last Name" value="<?php echo htmlspecialchars(isset($user['user_lname']) ? $user['user_lname'] : ''); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email" value="<?php echo htmlspecialchars(isset($user['user_email']) ? $user['user_email'] : ''); ?>" required>
                                </div>

                                <div class="form-group">
                                    <input type="text" class="form-control" name="mobile" placeholder="Phone Number" value="<?php echo htmlspecialchars(isset($user['user_mobile']) ? $user['user_mobile'] : ''); ?>" required>
                                </div>

                                <!-- Address fields -->
                                <div class="form-group">
                                    <input type="text" class="form-control" name="city" placeholder="City" value="<?php echo htmlspecialchars(isset($address['city']) ? $address['city'] : ''); ?>" required>
                                </div>

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="street" placeholder="Street Name" value="<?php echo htmlspecialchars(isset($address['street']) ? $address['street'] : ''); ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="building_num" placeholder="Building Number" value="<?php echo htmlspecialchars(isset($address['building_num']) ? $address['building_num'] : ''); ?>" required>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-gradient-primary me-2">Edit User</button>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- edit user end -->



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