<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$stmt = $conn->prepare("SELECT * FROM schedules WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$schedules = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard - Web Pengingat</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <h1>Welcome to the Dashboard</h1>
    <a href="add_schedule.php">Tambahkan Jadwal</a>
    <a href="logout.php">Logout</a>
    <table>
        <tr>
            <th>Nama kapal</th>
            <th>Nama orang</th>
            <th>Tanggal</th>
            <th>Date & Time</th>
            <th>Actions</th>
        </tr>
        <?php foreach ($schedules as $schedule): ?>
        <tr>
            <td><?php echo htmlspecialchars($schedule['title']); ?></td>
            <td><?php echo htmlspecialchars($schedule['date_time']); ?></td>
            <td>
                <a href="view_schedule.php?id=<?php echo $schedule['id']; ?>">Lihat</a>
                <a href="edit_schedule.php?id=<?php echo $schedule['id']; ?>">Edit</a>
                <a href="delete_schedule.php?id=<?php echo $schedule['id']; ?>">Hapus</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
