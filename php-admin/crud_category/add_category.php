<?php
include("../connection/connect.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $catName = $_POST['catName'];
    
    // Handling file upload
    if (isset($_FILES['catImage']) && $_FILES['catImage']['error'] === UPLOAD_ERR_OK) {
        // Ensure directory exists or create it
        $uploadDir = '../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Define the path to save the uploaded file
        $uploadFile = $uploadDir . basename($_FILES['catImage']['name']);
        
        // Move the uploaded file to the server directory
        if (move_uploaded_file($_FILES['catImage']['tmp_name'], $uploadFile)) {
            $catImage = basename($_FILES['catImage']['name']);
        } else {
            echo "Failed to upload file.";
            exit();
        }
    } else {
        $catImage = null; // or set a default image if applicable
    }
    
    try {
        // Prepare the SQL statement
        $stmt = $conn->prepare("INSERT INTO `categories` (`cat_name`, `cat_image`, `admin_id`) VALUES (:catName, :catImage, 1)");

        // Bind the parameters
        $stmt->bindParam(':catName', $catName);
        $stmt->bindParam(':catImage', $catImage);

        // Execute the statement
        $stmt->execute();

        // Redirect to another page after successful insert
        header("Location: ../category.php");
        exit();
    } catch (PDOException $e) {
        // Error message
        echo "Error: " . $e->getMessage();
    }
}
?>