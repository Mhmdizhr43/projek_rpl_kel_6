<?php
include 'config.php';

if (isset($_GET['email']) && isset($_GET['code'])) {
    $email = $_GET['email'];
    $verification_code = $_GET['code'];

    $stmt = $conn->prepare("UPDATE users SET verified = 1 WHERE email = ? AND verified = 0");
    if ($stmt->execute([$email])) {
        echo "Your email has been verified! <a href='login.php'>Login here</a>";
    } else {
        echo "Invalid or expired verification link.";
    }
} else {
    echo "Invalid verification request.";
}
?>
