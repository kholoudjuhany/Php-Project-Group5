<?php

// session_start();

// $host = 'localhost';
// $dbname = 'pet_stuff';
// $username = 'root';
// $password = '';

// $conn = new mysqli($host, $username, $password, $dbname);

// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST') {

//     $first_name = $_POST['firstName'] ?? '';
//     $last_name = $_POST['lastName'] ?? '';
//     $email = $_POST['email'] ?? '';
//     $password = $_POST['password'] ?? '';
//     $mobile = $_POST['mobile'] ?? '';
//     $city = $_POST['city'] ?? '';
//     $street = $_POST['street'] ?? '';
//     $building_number = $_POST['building_number'] ?? '';

    
//     $stmt_user = $conn->prepare('INSERT INTO users (user_fname, user_lname, user_email, user_password, user_mobile) VALUES (?, ?, ?, ?, ?)');
//     $stmt_user->bind_param('sssss', $first_name, $last_name, $email, $password, $mobile);

//     if ($stmt_user->execute()) {
//         $user_id = $stmt_user->insert_id;

//         $stmt_address = $conn->prepare('INSERT INTO address (user_id, city, street, building_no) VALUES (?, ?, ?, ?)');
//         $stmt_address->bind_param('isss', $user_id, $city, $street, $building_number);

//         if ($stmt_address->execute()) {
//             header("Location: ./LoginForm.php");
//             exit();
//         } else {
//             echo "Error: " . $stmt_address->error;
//         }

//         $stmt_address->close();
//         } else {
//             echo "Error: " . $stmt_user->error;
//         }

//         $stmt_user->close();
//     }

// $conn->close();

?>


<?php

session_start();

$host = 'localhost';
$dbname = 'pet_stuff';
$username = 'root';
$password = '';

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
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

    // Hash the password
    // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        // Begin transaction
        $conn->beginTransaction();

        // Insert user data
        $stmt_user = $conn->prepare('INSERT INTO users (user_fname, user_lname, user_email, user_password, user_mobile) VALUES (?, ?, ?, ?, ?)');
        $stmt_user->execute([$first_name, $last_name, $email, $password, $mobile]);
        $user_id = $conn->lastInsertId();

        // Insert address data
        $stmt_address = $conn->prepare('INSERT INTO address ( city, street, building_num,user_id) VALUES (?, ?, ?, ?)');
        $stmt_address->execute([ $city, $street, $building_number, $user_id]);

        // Commit transaction
        $conn->commit();

        // header("Location: ./LoginForm.php");
        header("Location: ../landingPage/landingPage.php");
        exit();
    } catch (PDOException $e) {
        // Rollback transaction if something fails
        $conn->rollBack();
        echo "Error: " . $e->getMessage();
    }
}

$conn = null;

?>





