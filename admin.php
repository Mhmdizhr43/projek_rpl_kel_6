<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM users");
$stmt->execute();
$users = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard - Reminder App</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Admin Dashboard</h1>
    <a href="manage_users.php">Manage Users</a>
    <a href="../logout.php">Logout</a>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['name']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td><?php echo $user['verified'] ? 'Verified' : 'Not Verified'; ?></td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
