<?php
include('database/connexion.php');

class UserLogin {
    private $conn;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function loginUser($email, $password) {
        $sql = "SELECT * FROM users WHERE email=?";
        $stmt = $this->conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                session_start();
                $_SESSION['email'] = $email;
                $_SESSION['role_name'] = $row['role_name'];
               if ($row['role_name'] == "admin") {
                header("location: dashboard/dashboard.php");
               }else{
                header("Location: index.php");
               }
            } else {
                $error = "Wrong password";
                header("Location: login.php?error=$error");
                exit();
            }
        } else {
            $error = "User not found";
            header("Location: login.php?error=$error");
            exit();
        }
    }
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $userLogin = new UserLogin($conn);
    $userLogin->loginUser($email, $password);
}
?>

<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form | CodingLab</title>
    <link rel="stylesheet" href="styles/loginstyle.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" />
</head>

<body>
    <div class="container">
        <div class="wrapper">
            <div class="title"><span>Login Form</span></div>
            <h1></h1>
            <form action="" method="POST">
                <div class="row">
                    <i class="fas fa-user"></i>
                    <input type="text" name="email" placeholder="Email or Phone" required>
                </div>
                <div class="row">
                    <i class="fas fa-lock"></i>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="pass"><a href="#">Forgot password?</a></div>
                <div class="row button">
                    <input type="submit" name="submit" value="Login">
                </div>
                <span style="color:red;"></span>
                <div class="signup-link">Not a member? <a href="register.php">Signup now</a></div>
            </form>
        </div>
    </div>
</body>

</html>
