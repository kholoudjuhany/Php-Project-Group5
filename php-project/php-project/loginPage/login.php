<?php

session_start();

$host = 'localhost';
$dbname = 'pet_stuff';
$username = 'root';
$password = '';

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $upassword = $_POST['password'];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid email format.';
            exit();
        }

        // Validate password length (adjust as needed)
        if (strlen($upassword) < 6) {
            echo 'Password must be at least 6 characters long.';
            exit();
        }

        try {
            // Prepare and execute the statement
            $stmt = $pdo->prepare('SELECT user_id, user_email, user_password, user_permission FROM users WHERE user_email = :email');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if user exists and verify password
            if ($user && password_verify($upassword, $user['user_password'])) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['user_email'];
                $_SESSION['user_permission'] = $user['user_permission'];

                if ($user['user_permission'] == 1) {
                    header("Location: ./LoginForm.php");
                } else {
                    header("Location: ../landingPage/landingPage.php");
                }
                exit(); // Ensure no further code is executed
            } else {
                echo 'Wrong email or password.';
            }
        } catch (PDOException $e) {
            // Handle error
            echo 'Error: ' . $e->getMessage();
        }
    } else {
        echo 'Email and password are required.';
    }
} else {
    echo 'Invalid request method.';
}

?>
