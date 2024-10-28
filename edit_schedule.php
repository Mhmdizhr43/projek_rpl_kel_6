<?php
session_start();
include 'config.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

if (isset($_GET['id'])) {
    $schedule_id = $_GET['id'];
    $stmt = $conn->prepare("SELECT * FROM schedules WHERE id = ? AND user_id = ?");
    $stmt->execute([$schedule_id, $_SESSION['user_id']]);
    $schedule = $stmt->fetch();

    if (!$schedule) {
        echo "Schedule not found!";
        exit;
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $title = $_POST['title'];
        $description = $_POST['description'];
        $date_time = $_POST['date_time'];

        $stmt = $conn->prepare("UPDATE schedules SET title = ?, description = ?, date_time = ? WHERE id = ?");
        if ($stmt->execute([$title, $description, $date_time, $schedule_id])) {
            header("Location: index.php");
        } else {
            echo "Failed to update schedule. Try again.";
        }
    }
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Jadwal - Web Pengingat</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <form action="edit_schedule.php?id=<?php echo $schedule['id']; ?>" method="post">
        <h2>Edit Jadwal</h2>
        <input type="text" name="title" value="<?php echo htmlspecialchars($schedule['title']); ?>" required>
        <textarea name="description" required><?php echo htmlspecialchars($schedule['description']); ?></textarea>
        <input type="datetime-local" name="date_time" value="<?php echo date('Y-m-d\TH:i', strtotime($schedule['date_time'])); ?>" required>
        <div class="input-group">
        <label for="email">Email Pengingat</label>
        <input type="email" name="email" id="email" placeholder="Enter your email" required>
        </div>
        <button type="submit">Update Jadwal</button>
    </form>
</body>
</html>
