<?php
session_start();
require 'vendor/autoload.php';
include 'config.php';

use vendor\PHPMailer\src\PHPMailer;
use vendor\PHPMailer\src\Exception;

// Pastikan pengguna sudah login
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Fungsi untuk mengirim email
function sendReminderEmail($to, $subject, $body) {
    $mail = new PHPMailer(true);
    try {
        // Pengaturan server SMTP
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'muhizhar43@gmail.com'; // Ganti dengan email Anda
        $mail->Password   = 'briqjlvltehcruak';     // Ganti dengan password aplikasi email
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
        $mail->Port       = 465;

        // Pengaturan pengirim dan penerima
        $mail->setFrom('muhizhar43@gmail.com', 'Izhar');
        $mail->addAddress($to);
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $body;

        $mail->send();
    } catch (Exception $e) {
        echo "Email could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

// Proses form untuk menambahkan jadwal
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $date_time = $_POST['date_time'];
    $user_id = $_SESSION['user_id'];
    $email = $_POST['email']; // Ambil email dari form

    // Simpan data jadwal ke database
    $stmt = $conn->prepare("INSERT INTO schedules (user_id, title, description, date_time, email) VALUES (?, ?, ?, ?, ?)");
    if ($stmt->execute([$user_id, $title, $description, $date_time, $email])) {
        // Kirim email pengingat setelah jadwal berhasil ditambahkan
        $subject = "Pengingat: $title";
        $body = "Halo, ini adalah pengingat untuk jadwal: $title. Deskripsi: $description. Waktu: $date_time.";
        sendReminderEmail($email, $subject, $body);

        header("Location: index.php");
    } else {
        echo "Failed to add schedule. Try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Tambahkan Pengingat - Web Pengingat</title>
    <link rel="stylesheet" href="assets/css/styles.css">
</head>
<body>
    <form action="add_schedule.php" method="post">
        <h2>Tambahkan Pengingat</h2>
        <input type="text" name="title" placeholder="Judul Jadwal" required>
        <textarea name="description" placeholder="Deskripsi" required></textarea>
        <input type="datetime-local" name="date_time" required>
        <input type="email" name="email" placeholder="Masukkan email" required>
        <button type="submit">Tambahkan Jadwal</button>
    </form>
</body>
</html>
