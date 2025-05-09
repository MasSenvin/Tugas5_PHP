<?php
require 'config.php';
$id = $_GET['id'];
mysqli_query($conn, "UPDATE todo SET selesai = 1 WHERE id = $id");
header("Location: todo.php");
?>
