<?php
include("../connection/connect.php");
// fix404 isset for all item and try catch
if ($_SERVER["REQUEST_METHOD"] == "POST" ){
    // Retrieve form data
    if (isset($_POST["fname"]))
    {  $fname = $_POST['fname'];}
    
    if (isset($_POST["lname"]))
    {  $lname = $_POST['lname'];}

    if (isset($_POST["email"]))
    {  $email = $_POST['email'];}


    if (isset($_POST["password"]))
    {  $password = $_POST['password'];}

    if (isset($_POST["mobile"]))
    {  $mobile = $_POST['mobile'];}
}
    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO `users` (`user_fname`, `user_lname`, `user_email`,`user_password`,`user_mobile`,`address_id`)
         VALUES (:fname, :lname,:email,:pass,:mobile,1)");

        // Bind the parameters
        $stmt->bindParam(':fname', $fname);
        $stmt->bindParam(':lname', $lname);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $password);
        $stmt->bindParam(':mobile', $mobile);
       

        // Execute the statement
        $stmt->execute();

        // Redirect to another page after successful insert
        header("Location: ../user.php");
        exit();
    } catch (PDOException $e) {
        // Error message
        echo "Error: " . $e->getMessage();
    }

?>