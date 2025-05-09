<?php
session_start();

// Cek apakah user sudah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}

// Koneksi ke database
require 'config.php';

$username = $_SESSION['username'];
// Ambil data todo berdasarkan username
$result = mysqli_query($conn, "SELECT * FROM todo WHERE username='$username'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>To Do List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>To Do List</h2>
    </div>
    <div class="mb-3">
        <p>Nama: <strong>Agustinus Kevin</strong> | NIM: <strong>235314029</strong></p>
        <img src="img\IMG_3004.JPG" width="150" class="rounded">
    </div>

    <form method="POST" action="tambah.php" class="mb-4 d-flex gap-2">
        <input type="text" name="task" placeholder="Tugas baru" class="form-control" required>
        <input type="submit" value="Tambah" class="btn btn-primary">
    </form>

    <ul class="list-group">
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span style="<?= $row['selesai'] ? 'text-decoration: line-through; color: gray;' : '' ?>">
                    <?= $row['isi']?>
                </span>
                <div>
                    <?php if (!$row['selesai']) { ?>
                        <a href="selesai_isi.php?id=<?= $row['id'] ?>" class="btn btn-success btn-sm me-1">Selesai</a>
                    <?php } ?>
                    <a href="hapus_isi.php?id=<?= $row['id'] ?>" class="btn btn-danger btn-sm">Hapus</a>
                </div>
            </li>
        <?php } ?>
    </ul>
</div>
</body>
</html>
