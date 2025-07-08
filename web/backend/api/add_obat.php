<?php
session_start();
header('Content-Type: application/json');
include '../includes/koneksi.php';

if (!isset($_SESSION['admin'])) {
  http_response_code(401);
  echo json_encode(["error" => "Unauthorized"]);
  exit;
}

$nama = $_POST['nama'];
$harga = $_POST['harga'];
$pengertian = $_POST['pengertian'];
$kegunaan = $_POST['kegunaan'];

$gambar = $_FILES['gambar']['name'];
$tmp = $_FILES['gambar']['tmp_name'];
move_uploaded_file($tmp, "../uploads/$gambar");

$query = "INSERT INTO obat (nama, harga, gambar, pengertian, kegunaan) VALUES ($1, $2, $3, $4, $5)";
pg_query_params($conn, $query, [$nama, $harga, $gambar, $pengertian, $kegunaan]);

echo json_encode(["success" => true, "message" => "Obat ditambahkan"]);
