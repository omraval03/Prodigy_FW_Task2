<?php
session_start();
require 'config.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];

    $stmt = $conn->prepare("INSERT INTO employees (name, email, position, department) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $name, $email, $position, $department);

    if ($stmt->execute()) {
        echo "Employee added successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Employee</title>
</head>
<body>
    <form action="" method="POST">
        <label>Name:</label>
        <input type="text" name="name" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Position:</label>
        <input type="text" name="position" required>
        <label>Department:</label>
        <input type="text" name="department" required>
        <button type="submit">Add Employee</button>
    </form>
</body>
</html>
