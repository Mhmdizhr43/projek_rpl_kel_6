<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
// tes
if (isset($_GET['id'])) {
    $schedule_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM schedules WHERE id = ? AND user_id = ?");
    $stmt->execute([$schedule_id, $_SESSION['user_id']]);
    $schedule = $stmt->fetch();

    if (!$schedule) {
        echo "Schedule not found!";
        exit;
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View Schedule - Reminder App</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <h2><?php echo htmlspecialchars($schedule['title']); ?></h2>
    <p><strong>Date & Time:</strong> <?php echo htmlspecialchars($schedule['date_time']); ?></p>
    <p><strong>Description:</strong> <?php echo nl2br(htmlspecialchars($schedule['description'])); ?></p>
    <a href="index.php">Back to Dashboard</a>
</body>
</html>
