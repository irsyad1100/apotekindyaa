<?php
require_once '../includes/koneksi.php';

$nama = $_POST['nama'] ?? '';
$harga = $_POST['harga'] ?? 0;
$deskripsi = $_POST['deskripsi'] ?? '';
$manfaat = $_POST['manfaat'] ?? '';

$gambarPath = '';
if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
    $uploadDir = '../uploads/';
    if (!is_dir($uploadDir)) mkdir($uploadDir);
    
    $fileName = uniqid() . '_' . basename($_FILES['gambar']['name']);
    $targetPath = $uploadDir . $fileName;

    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
        $gambarPath = 'uploads/' . $fileName;
    }
}

$stmt = $pdo->prepare("INSERT INTO obat (nama, harga, gambar, deskripsi, manfaat) VALUES (?, ?, ?, ?, ?)");
$stmt->execute([$nama, $harga, $gambarPath, $deskripsi, $manfaat]);

header("Location: kelola_obat.php");
exit;
?>
