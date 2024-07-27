<?php
session_start();
require 'config.php';

if ($_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$result = $conn->query("SELECT * FROM employees");

?>

<!DOCTYPE html>
<html>
<head>
    <title>View Employees</title>
</head>
<body>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Position</th>
            <th>Department</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= $row['id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['position'] ?></td>
                <td><?= $row['department'] ?></td>
                <td>
                    <a href="update_employee.php?id=<?= $row['id'] ?>">Update</a>
                    <a href="delete_employee.php?id=<?= $row['id'] ?>">Delete</a>
                </td>
            </tr>
        <?php endwhile; ?>
    </table>
</body>
</html>
