<?php

session_start();

$host = 'localhost';
$dbname = 'pet_stuff';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $first_name = $_POST['firstName'] ?? '';
    $last_name = $_POST['lastName'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $city = $_POST['city'] ?? '';
    $street = $_POST['street'] ?? '';
    $building_number = $_POST['building_number'] ?? '';

    
    $stmt_user = $conn->prepare('INSERT INTO users (user_fname, user_lname, user_email, user_password, user_mobile) VALUES (?, ?, ?, ?, ?)');
    $stmt_user->bind_param('sssss', $first_name, $last_name, $email, $password, $mobile);

    if ($stmt_user->execute()) {
        $user_id = $stmt_user->insert_id;

        $stmt_address = $conn->prepare('INSERT INTO address (user_id, city, street, building_no) VALUES (?, ?, ?, ?)');
        $stmt_address->bind_param('isss', $user_id, $city, $street, $building_number);

        if ($stmt_address->execute()) {
            header("Location: ./LoginForm.php");
            exit();
        } else {
            echo "Error: " . $stmt_address->error;
        }

        $stmt_address->close();
        } else {
            echo "Error: " . $stmt_user->error;
        }

        $stmt_user->close();
    }

$conn->close();

?>





