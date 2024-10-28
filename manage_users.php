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
    <title>Manage Users - Reminder App</title>
    <link rel="stylesheet" href="../assets/css/styles.css">
</head>
<body>
    <h1>Manage Users</h1>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Status</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($users as $user): ?>
        <tr>
            <td><?php echo htmlspecialchars($user['name']); ?></td>
            <td><?php echo htmlspecialchars($user['email']); ?></td>
            <td><?php echo $user['verified'] ? 'Verified' : 'Not Verified'; ?></td>
            <td>
                <a href="delete_user.php?id=<?php echo $user['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
    <a href="admin.php">Back to Admin Dashboard</a>
</body>
</html>
