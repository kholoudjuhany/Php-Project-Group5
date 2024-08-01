<?php
include("../connection/connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["catId"])) {
    $catId = $_POST['catId'];

    try {
        // Prepare the SQL statement to delete the category
        $stmt = $conn->prepare("DELETE FROM `categories` WHERE `cat_id` = :catId");
        // Bind the parameters
        $stmt->bindParam(':catId', $catId);
        // Execute the statement
        $stmt->execute();

        // Redirect to the category page after deletion
        header("Location: ../category.php");
        exit();
    } catch (PDOException $e) {
        // Error message
        echo "Error: " . $e->getMessage();
    }
} else {
    // If the request method is not POST or catId is not set
    echo "Invalid request.";
}
?>