<?php
session_start();
require 'config.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$id = $_GET['id'];
$result = $conn->query("SELECT * FROM employees WHERE id = $id");
$employee = $result->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $position = $_POST['position'];
    $department = $_POST['department'];

    $stmt = $conn->prepare("UPDATE employees SET name = ?, email = ?, position = ?, department = ? WHERE id = ?");
    $stmt->bind_param("ssssi", $name, $email, $position, $department, $id);

    if ($stmt->execute()) {
        header("Location: view_employees.php");
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
    <title>Update Employee</title>
</head>
<body>
    <form action="" method="POST">
        <label>Name:</label>
        <input type="text" name="name" value="<?= $employee['name'] ?>" required>
        <label>Email:</label>
        <input type="email" name="email" value="<?= $employee['email'] ?>" required>
        <label>Position:</label>
        <input type="text" name="position" value="<?= $employee['position'] ?>" required>
        <label>Department:</label>
        <input type="text" name="department" value="<?= $employee['department'] ?>" required>
        <button type="submit">Update Employee</button>
    </form>
</body>
</html>
