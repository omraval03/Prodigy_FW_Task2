<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

echo "Welcome, " . $_SESSION['username'] . "!<br>";
echo '<a href="logout.php">Logout</a><br>';
echo '<a href="add_employee.php">Add Employee</a><br>';
echo '<a href="view_employees.php">View Employees</a><br>';
?>
