<?php
session_start();
require 'config.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$stmt = $conn->prepare("DELETE FROM employees WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: view_employees.php");
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
?>
