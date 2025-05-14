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

// ===== PAGINATION =====
$limit = 5; // Jumlah item per halaman
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$start = ($page - 1) * $limit;

// Hitung total data untuk user
$countResult = mysqli_query($conn, "SELECT COUNT(*) AS total FROM todo WHERE username='$username'");
$countRow = mysqli_fetch_assoc($countResult);
$totalTasks = $countRow['total'];
$totalPages = ceil($totalTasks / $limit);

// Ambil data dengan limit
$result = mysqli_query($conn, "SELECT * FROM todo WHERE username='$username' ORDER BY id DESC LIMIT $start, $limit");
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
        <img src="img/IMG_3004.JPG" width="150" class="rounded">
    </div>

    <form method="POST" action="tambah.php" class="mb-4 d-flex gap-2">
        <input type="text" name="task" placeholder="Tugas baru" class="form-control" required>
        <input type="submit" value="Tambah" class="btn btn-primary">
    </form>

    <ul class="list-group mb-4">
        <?php while($row = mysqli_fetch_assoc($result)) { ?>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <span style="<?= $row['selesai'] ? 'text-decoration: line-through; color: gray;' : '' ?>">
                    <?= htmlspecialchars($row['isi']) ?>
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

    <!-- PAGINATION LINKS -->
    <nav>
        <ul class="pagination justify-content-center">
            <?php if ($page > 1): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page - 1 ?>">Sebelumnya</a>
                </li>
            <?php endif; ?>
            <?php for ($i = 1; $i <= $totalPages; $i++): ?>
                <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                    <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                </li>
            <?php endfor; ?>
            <?php if ($page < $totalPages): ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?= $page + 1 ?>">Berikutnya</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
</body>
</html>
