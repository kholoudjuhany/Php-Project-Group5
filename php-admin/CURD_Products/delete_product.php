<?php
include("../connection/connect.php");

if ($_SERVER['REQUEST_METHOD'] == "POST" && isset($_POST["productId"])) {
    $catId = $_POST['productId'];

    try {
        // Prepare the SQL statement to delete the category
        $stmt = $conn->prepare("DELETE FROM `products` WHERE product_id = :productId");
        // Bind the parameters
        $stmt->bindParam(':productId', $catId);
        // Execute the statement
        $stmt->execute();

        // Redirect to the category page after deletion
        header("Location: ../products.php");
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