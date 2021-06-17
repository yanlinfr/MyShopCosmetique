<?php
define('HOST', 'localhost'); 
define('USER', 'vincent'); 
define('PASSWORD', 'root'); 
define('DATABASE', 'my_shop'); 

session_start();

function DB()
{
    try {
        $db = new PDO('mysql:host=' . HOST . ';dbname=' . DATABASE . '', USER, PASSWORD);
        return $db;
    } catch (PDOException $e) {
        return "Error!: " . $e->getMessage();
        die();
    }
}
if (!empty($_POST['btnRegister'])) {
    if ($_POST['email'] == "") {
        $register_error_message = 'Email field is required!';
    } else if ($_POST['username'] == "") {
        $register_error_message = 'Username field is required!';
    } else if ($_POST['password'] == "") {
        $register_error_message = 'Password field is required!';
    } else if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
        $register_error_message = 'Invalid email address!';
    }
}
if (isset($_POST["email"]) && isset($_POST["username"]) &&  isset($_POST["password"])) {

    $email = $_POST["email"];
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_BCRYPT);
    $sql = "INSERT into users (email, username, password, admin) VALUES ('$email','$username', '$password', '0')";
    if (DB()->query($sql)) {
        $_SESSION["username"] = $_POST["username"];
        $_SESSION["admin"] = 0;
        header("location:index.php");
    } else {
        echo "erreur";
    }
}
?>
