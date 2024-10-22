<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $schedule_id = $_GET['id'];
    $stmt = $conn->prepare("DELETE FROM schedules WHERE id = ? AND user_id = ?");
    if ($stmt->execute([$schedule_id, $_SESSION['user_id']])) {
        header("Location: index.php");
    } else {
        echo "Failed to delete schedule.";
    }
} else {
    echo "Invalid request.";
}
?>
