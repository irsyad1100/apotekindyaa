<?php
session_start();
header('Content-Type: application/json');
include '../includes/koneksi.php';

if (!isset($_SESSION['admin'])) {
  http_response_code(401);
  echo json_encode(["error" => "Unauthorized"]);
  exit;
}

$id = $_POST['id'];
pg_query_params($conn, "DELETE FROM obat WHERE id = $1", [$id]);
echo json_encode(["success" => true]);
