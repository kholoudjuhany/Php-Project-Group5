
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="login.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container" id="login">
        <h1 class="form-title">Login</h1>
        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <div id="loginMessage" class="messageDiv" style="display:none;"></div>
            <div class="input-group">
                <input type="email" name="email" id="loginEmail" placeholder="Email" >
                <span class="error-message" id="loginEmailError">Please use a valid email</span>
            </div>
            <div class="input-group">
                <input type="password" name="password" id="loginPassword" placeholder="Password" >
                <span class="error-message" id="loginPasswordError">Please fill this field as it is required</span>
            </div>
            <button type="submit" class="btn"><b>Login</b></button>
        </form>
        <p class="links">Don't have an account? <a href="./SignForm.php" id="createAccountButton">Create Account</a></p>
    </div>
    <script src="login.js?v=<?php echo time();?>"></script>
    <script src="jquery-3.3.1.min.js"></script>
</body>
</html>
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
    // Log the error and display a user-friendly message
    error_log("Connection failed: " . $e->getMessage());
    die("Database connection error. Please try again later.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $password = $_POST['password'];

        // Validate email format
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo 'Invalid email format.';
            exit();
        }

        // Validate password length (adjust as needed)
        // if (strlen($password) < 6) {
        //     echo 'Password must be at least 6 characters long.';
        //     exit();
        // }

        try {
            // Prepare and execute the statement
            $stmt = $pdo->prepare('SELECT user_id, user_email, user_password, user_permission FROM users WHERE user_email = :email');
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC);

            // Check if user exists and verify password
            if ($password == $user['user_password']) {
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['email'] = $user['user_email'];
                $_SESSION['user_permission'] = $user['user_permission'];

                if ($user['user_permission'] == 1) {
                    header("Location: ../../../php-admin/index.php");
                } else {
                    header("Location: ../landingPage/landingPage.php");
                }
                exit(); // Ensure no further code is executed
            } else {
              echo '<script>
              Swal.fire({
                        icon: "error",
                         title: "Oops...",
                         text: "Invalid Email OR Password!",
                        });
              </script>';
            }
        } catch (PDOException $e) {
            // Log the error and display a user-friendly message
            error_log('Error: ' . $e->getMessage());
            echo 'An error occurred. Please try again later.';
        }
    } else {
        echo 'Email and password are required.';
    }
}
?>