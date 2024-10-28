<<<<<<< HEAD
<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt->execute([$user_id])) {
        header("Location: manage_users.php");
    } else {
        echo "Failed to delete user.";
    }
} else {
    echo "Invalid request.";
}
?>
=======
<?php
session_start();
include '../config.php';

if (!isset($_SESSION['admin_id'])) {
    header("Location: ../login.php");
    exit;
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    
    $stmt = $conn->prepare("DELETE FROM users WHERE id = ?");
    if ($stmt->execute([$user_id])) {
        header("Location: manage_users.php");
    } else {
        echo "Failed to delete user.";
    }
} else {
    echo "Invalid request.";
}
?>
>>>>>>> f2db96f3b3e034b8b74bd4eaebc61c62bd8b6c39
