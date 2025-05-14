<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password_input = $_POST['password'];

    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        if ($user && password_verify($password_input, $user['password'])) {
            $_SESSION['username'] = $user['username'];
            header("Location: todo.php");
            exit();
        } else {
            echo "Login gagal. <a href='index.php'>Coba lagi</a>";
        }
    } else {
        echo "Query error: " . mysqli_error($conn);
    }
}
?>

