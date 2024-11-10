<?php
include 'config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]); PERBAIKICODE INI 
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password']) && $user['verified']) {
        $_SESSION['user_id'] = $user['id'];
        header("Location: index.php");
    } else {
        $error = "Invalid credentials or email not verified.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login - Reminder App</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <form action="login.php" method="post">
        <h2>Login</h2>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Login</button>
        <p>Don't have an account? <a href="register.php">Register here</a>.</p>
        <?php if (isset($error)) echo "<p style='color: red;'>$error</p>"; ?>
    </form>
</body>
</html>