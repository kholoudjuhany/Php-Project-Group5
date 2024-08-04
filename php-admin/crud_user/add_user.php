<?php
include ("../connection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    if (isset($_POST["fname"])) {
        $fname = $_POST['fname'];
    }

    if (isset($_POST["lname"])) {
        $lname = $_POST['lname'];
    }

    if (isset($_POST["email"])) {
        $email = $_POST['email'];
    }

    if (isset($_POST["password"])) {
        $password = $_POST['password'];
    }

    if (isset($_POST["mobile"])) {
        $mobile = $_POST['mobile'];
    }
    // address start 
    if (isset($_POST["city"])) {
        $city = $_POST['city'];
    }

    if (isset($_POST["street"])) {
        $street = $_POST['street'];
    }

    if (isset($_POST["building_num"])) {
        $building_num = $_POST['building_num'];
    }
    // address end 

}
try {

    // !user insert start 
    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO `users` (`user_fname`, `user_lname`, `user_email`,`user_password`,`user_mobile`)
         VALUES (:fname, :lname,:email,:pass,:mobile)");

    // Bind the parameters
    $stmt->bindParam(':fname', $fname);
    $stmt->bindParam(':lname', $lname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':pass', $password);
    $stmt->bindParam(':mobile', $mobile);
    $stmt->execute();
    //! user insert end 

    // Retrieve user_id
    $stmt2 = $conn->prepare("SELECT `user_id` FROM `users` WHERE user_email = :email");
    $stmt2->bindParam(':email', $email);
    $stmt2->execute();

    // Fetch the result
    $user = $stmt2->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        // Proceed with address insertion
        $stmt3 = $conn->prepare("INSERT INTO `address` (`city`, `street`, `building_num`, `user_id`)
        VALUES (:city, :street, :building_num, :user_id)");

        // Bind the parameters
        $stmt3->bindParam(':city', $city);
        $stmt3->bindParam(':street', $street);
        $stmt3->bindParam(':building_num', $building_num);
        $stmt3->bindParam(':user_id', $user['user_id']);

        // Execute the statement
        $stmt3->execute();
    } else {
        echo "User not found.";
    }

    // Redirect to another page after successful insert
    header("Location: ../user.php");
    exit();
} catch (PDOException $e) {
    // Error message
    echo "Error: " . $e->getMessage();
}

?>