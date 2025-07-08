<?php
session_start();
header('Content-Type: application/json');
include '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
  http_response_code(405);
  echo json_encode(["error" => "Metode tidak valid"]);
  exit;
}

$username = $_POST['username'] ?? '';
$password = $_POST['password'] ?? '';

$query = "SELECT * FROM admin WHERE username = $1";
$result = pg_query_params($conn, $query, [$username]);

if ($row = pg_fetch_assoc($result)) {
  if ($password === $row['password']) {
    $_SESSION['admin'] = $row['username'];
    echo json_encode(["success" => true]);
  } else {
    echo json_encode(["error" => "Password salah"]);
  }
} else {
  echo json_encode(["error" => "Username tidak ditemukan"]);
}
?>
