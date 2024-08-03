<?php

$host = 'localhost';
$dbname = 'pet_stuff';
$username = 'root';
$password = '';

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$email = $_GET['email'] ?? '';

if ($email) {
    $stmt = $conn->prepare('SELECT COUNT(*) FROM users WHERE user_email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $stmt->bind_result($count);
    $stmt->fetch();
    $stmt->close();

    echo json_encode(['exists' => $count > 0]);
}

$conn->close();



?>
