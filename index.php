<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h3 class="text-center mb-3">Login</h3>
                <form method="POST" action="login.php" class="form-box">
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" name="username" id="username" class="form-input" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" id="password" class="form-input" required>
                    </div>
                    <button type="submit" class="btn-login">Login</button>
                </form>
                <p class="text-center mt-3">
                    Belum punya akun? <a href="register.php">Daftar</a>
                </p>
            </div>
        </div>
    </div>
</body>
</html>
