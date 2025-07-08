<?php
require_once '../includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? 0;

  // Hapus dari database
  $stmt = $pdo->prepare("DELETE FROM obat WHERE id = ?");
  $stmt->execute([$id]);
}

header("Location: kelola_obat.php");
exit;
