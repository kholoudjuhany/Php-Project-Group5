
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <script src="login.js" defer></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
   
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="style.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="../style/navbarStyle.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

</head>
<body>

<nav class="navbar1">
  <div class="container1">

    

    <div class="navbar1-menu" id="open-navbar1">
  
      <button class="navbar1-toggler" data-toggle="open-navbar1">
        <span></span>
        <span></span>
        <span></span>
      </button>
      
      <a href="../landingPage/landingPage.php">
        <img src="../images/logo.png" alt="logo" width="50%">
      </a>
    
      <ul class="navbar1-nav">
        <li ><a href="../landingPage/landingPage.php">Home</a></li>
        <li class="navbar1-dropdown">
          <a href="../category/category.php" class="dropdown-toggler" data-dropdown="my-dropdown-id">
            Categories 
          </a>
          
        </li>
        <li class="navbar1-dropdown">
          <a href="../landingPage/landingPage.php#services_n" class="dropdown-toggler" data-dropdown="blog">
          Services 
          </a>
          


        </li>
        <!-- fix404 add link and name -->
        <li><a href="../landingPage/landingPage.php#faq_n">FAQ</a></li> 
        <li><a href="../landingPage/landingPage.php#aboutus_n">About</a></li> 
        <li><a href="../landingPage/landingPage.php#footerf">Contact</a></li>
        <li><a href="../loginPage/LoginForm.php">Login/Signup</a></li>
       <li> 
        <a href="../cart/cart2.php" class="toggle-cart-btn"  >
       
        
          <i class="fa-solid fa-cart-shopping fa-lg "></i>
     
      </a>
      </li>
        <!-- fix404 add link and name -->
      </ul>
    </div>
  </div>
</nav>




    <div class="container0" id="login">
        <h1 class="form-title0">Login</h1>
        <form id="loginForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="POST">
            <div id="loginMessage" class="messageDiv0" style="display:none;"></div>
            <div class="input-group0">
                <input type="email" name="email" id="loginEmail" placeholder="Email" >
                <span class="error-message0" id="loginEmailError">Please use a valid email</span>
            </div>
            <div class="input-group0">
                <input type="password" name="password" id="loginPassword" placeholder="Password" >
                <span class="error-message0" id="loginPasswordError">Please fill this field as it is required</span>
            </div>
            <button type="submit" class="btn0"><b>Login</b></button>
        </form>
        <p class="links0">Don't have an account? <a href="./SignForm.php" id="createAccountButton">Create Account</a></p>
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