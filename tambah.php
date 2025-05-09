<?php
session_start();
require 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_SESSION['username']; // ambil dari session
    $task = $_POST['task'];            // ambil dari input form

    $sql = "INSERT INTO todo (username, isi, selesai) VALUES (?, ?, 0)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $username, $task);

    if ($stmt->execute()) {
        header("Location: todo.php");
    } else {
        echo "Gagal menambahkan tugas: " . $conn->error;
    }
}
?>

