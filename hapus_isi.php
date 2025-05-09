<?php
require 'config.php';
$id = $_GET['id'];
mysqli_query($conn, "DELETE FROM todo WHERE id = $id");
header("Location: todo.php");
?>
