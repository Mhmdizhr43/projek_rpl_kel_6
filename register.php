<?php
session_start();
include 'config.php';

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

    // Cek apakah email sudah terdaftar
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute([$email]);
    if ($stmt->rowCount() > 0) {
        $error = "Email sudah terdaftar. Silakan gunakan email lain.";
    } else {
        // Masukkan data pengguna baru ke database dan tandai sebagai verified
        $stmt = $conn->prepare("INSERT INTO users (name, email, password, verified) VALUES (?, ?, ?, 1)");
        if ($stmt->execute([$name, $email, $password])) {
            $_SESSION['user_id'] = $conn->lastInsertId();
            $_SESSION['name'] = $name;
            header("Location: index.php");
        } else {
            $error = "Pendaftaran gagal. Silakan coba lagi.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Register - Reminder App</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <form action="register.php" method="post">
        <h2>Register</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <input type="text" name="name" placeholder="Full Name" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="password" placeholder="Password" required>
        <button type="submit">Register</button>
        <p>Sudah punya akun? <a href="login.php">Login di sini</a></p>
    </form>
</body>
</html>
