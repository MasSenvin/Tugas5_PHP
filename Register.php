<?php
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (username, password) VALUES ('$username', '$password')";
    $result = mysqli_query($conn, $sql);

    if ($result) {
        echo "Registrasi berhasil. <a href='index.php'>Login sekarang</a>";
    } else {
        echo "Gagal mendaftar: " . mysqli_error($conn);
    }
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <h3 class="text-center mb-3">Register</h3>
            <form method="POST" action="register.php" class="p-3 bg-white rounded shadow">
                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100">Daftar</button>
            </form>
        </div>
    </div>
</div>
</body>
</html>
