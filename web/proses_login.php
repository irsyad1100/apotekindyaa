<?php
session_start();

// Username dan password statis (bisa sambungkan ke DB nanti)
$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

// Contoh validasi sederhana
if ($username === 'admin' && $password === 'admin123') {
    $_SESSION['admin_logged_in'] = true;
    header("Location: admin/dashboard.php");
    exit;
} else {
    header("Location: login.php?error=1");
    exit;
}
