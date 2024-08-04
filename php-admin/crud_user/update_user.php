<?php




if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["fname"]) && isset($_POST["lname"]) && isset($_POST["email"]) && isset($_POST["mobile"]) && isset($_POST["city"]) && isset($_POST["street"]) && isset($_POST["building_num"])) {
    $fname = $_POST["fname"];
    $lname = $_POST["lname"];
    $email = $_POST["email"];
    $mobile = $_POST["mobile"];
    $city = $_POST["city"];
    $street = $_POST["street"];
    $building_num = $_POST["building_num"];

    $stmt3 = $conn->prepare("UPDATE users SET user_fname=:firstn,user_lname=:lastn,user_email=:email,user_mobile=:mobile WHERE user_id = :id ");
    $stmt3->bindParam(":firstn", $fname);
    $stmt3->bindParam(":lastn", $lname);
    $stmt3->bindParam(":email", $email);
    $stmt3->bindParam(":mobile", $mobile);
    $stmt3->bindParam(":id", $user['user_id']);
    $stmt3->execute();

    $stmt4 = $conn->prepare("UPDATE address SET city=:ci,street=:st,building_num=:bu WHERE user_id = :id ");
    $stmt4->bindParam(":ci", $city);
    $stmt4->bindParam(":st", $street);
    $stmt4->bindParam(":bu", $building_num);
    $stmt4->bindParam(":id", $user['user_id']);
    $stmt4->execute();



}




if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["user_id"])) {
    $userid = $_POST['user_id'];

    // Fetch product details
    $stmt = $conn->prepare("SELECT user_id, user_fname, user_lname, user_email, user_mobile FROM users WHERE user_id = :id");
    $stmt->bindParam(":id", $userid);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    $stmt2 = $conn->prepare("SELECT city, street, building_num FROM address WHERE user_id = :id");
    $stmt2->bindParam(":id", $userid);
    $stmt2->execute();
    $address = $stmt2->fetch(PDO::FETCH_ASSOC);


}

?>

<!-- Modal -->
<!-- Edit Form Modal Start -->
<div class="modal fade" id="editForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editFormLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="col-12 grid-margin stretch-card" id="form">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title fw-bold text-center">Add User</h4>
                            <form class="forms-sample" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post"
                                enctype="multipart/form-data" class="forms-sample">

                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="fname" placeholder="First Name"
                                            value="<?php echo htmlspecialchars($user['user_fname']); ?>" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="lname" placeholder="Last Name"
                                            value="<?php echo htmlspecialchars($user['user_lname']); ?>" required>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <input type="email" class="form-control" name="email" placeholder="Email"
                                        value="<?php echo htmlspecialchars($user['user_email']); ?>" required>
                                </div>



                                <div class="form-group">
                                    <input type="text" class="form-control" name="mobile" placeholder="Phone Number"
                                        value="<?php echo htmlspecialchars($user['user_mobile']); ?>" required>
                                </div>
                                <!-- address start -->

                                <div class="form-group">
                                    <input type="text" class="form-control" name="city" placeholder="City"
                                        value="<?php echo htmlspecialchars($address['city']); ?>" required>
                                </div>

                                <div class="form-row">

                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="street" placeholder="Street Name"
                                            value="<?php echo htmlspecialchars($address['street']); ?>" required>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <input type="text" class="form-control" name="building_num"
                                            placeholder="Building Number"
                                            value="<?php echo htmlspecialchars($address['building_num']); ?>" required>
                                    </div>

                                </div>
                                <!-- address end -->

                                <button type="submit" class="btn btn-gradient-primary me-2"> edit User </button>
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
    // Refresh the page
    function refONClick() {
        setTimeout(function () {
            location.reload();
        }, 1000);
    }; 
</script>