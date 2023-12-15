<?php
require_once 'database.php';  
require_once 'user.php';

$database = new Database('localhost', 'root', '', 'jobeasy');  
$db = $database->getConnection();

$user = new User($db);


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user->username = $_POST['name'];
    $user->email = $_POST['email'];
    $user->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $user->role_name = "Candidate";

    if ($user->create()) {
        echo "User registered successfully!";
        header("");
    } else {
        echo "Unable to register user.";
    }
}
?>

<!DOCTYPE html>

<html lang="en" dir="ltr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title> Registration or Sign Up form in HTML CSS | CodingLab </title>
  <link rel="stylesheet" href="styles/registerstyle.css">
</head>

<body>
<div class="wrapper">
    <h2>Registration</h2>
<form action="register.php" method="POST">
    <div class="input-box">
        <input type="text" name="name" placeholder="Enter your name" required>
    </div>
    <div class="input-box">
        <input type="text" name="email" placeholder="Enter your email" required>
    </div>
    <div class="input-box">
        <input type="password" name="password" placeholder="Create password" required>
    </div>
    <div class="input-box">
        <input type="password" name="confirmPassword" placeholder="Confirm password" required>
    </div>
    <div class="policy">
        <input type="checkbox">
        <h3>I accept all terms & condition</h3>
    </div>
    <div class="input-box button">
        <input type="Submit" value="Register Now">
    </div>
    <div class="text">
        <h3>Already have an account? <a href="login.php">Login
        </div>
</body>
</html>