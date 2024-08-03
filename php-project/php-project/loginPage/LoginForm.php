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
        <form id="loginForm" action="login.php" method="POST">
            <div id="loginMessage" class="messageDiv" style="display:none;"></div>
            <div class="input-group">
                <!-- <label for="loginEmail">Email:</label> -->
                <input type="email" name="email" id="loginEmail" placeholder="Email" required>
                <span class="error-message" id="loginEmailError">Please use a valid email</span>
            </div>
            <div class="input-group">
                <!-- <label for="loginPassword">Password:</label> -->
                <input type="password" name="password" id="loginPassword" placeholder="Password" required>
                <span class="error-message" id="loginPasswordError">Please fill this field as it is required</span>
            </div>
            <button  type="submit" class="btn" id="submitLogin" ><b>Login</b></button>
        </form>
        
        <p class="links">Don't have an account? <a href="./SignForm.php" id="createAccountButton">Create Account</a></p>
    </div>
<script src="login.js"></script>
</body>
</html>
