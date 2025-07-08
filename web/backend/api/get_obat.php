<?php
header('Content-Type: application/json');
include '../includes/koneksi.php';

$result = pg_query($conn, "SELECT * FROM obat ORDER BY id DESC");
$data = [];

while ($row = pg_fetch_assoc($result)) {
  $data[] = $row;
}
echo json_encode($data);
