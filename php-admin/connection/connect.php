<?php
//connect.php
$dsn = "mysql:host=localhost;dbname=pet_stuff";
$user = "root";
$password = "";
$option = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES UTF8" //for arbic
);
try {
    $conn = new PDO($dsn, $user, $password, $option);
    $conn->setAttribute(PDO::ATTR_ERRMODE , PDO::ERRMODE_EXCEPTION);
    // echo"success conction to database ";
} catch (PDOException $e) {
    echo "the erorr: " . $e->getMessage();
}
 
// echo <<<"navBar"
// This is $user
// navBar;