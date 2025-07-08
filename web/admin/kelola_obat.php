<?php
require_once '../includes/koneksi.php';


// === Proses Tambah/Update ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? null;
  $nama = $_POST['nama'] ?? '';
  $harga = $_POST['harga'] ?? 0;
  $deskripsi = $_POST['deskripsi'] ?? '';
  $manfaat = $_POST['manfaat'] ?? '';
  $gambarPath = '';

  if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] === 0) {
    $uploadDir = '../uploads/';
    $fileName = uniqid() . '_' . basename($_FILES['gambar']['name']);
    $targetPath = $uploadDir . $fileName;
    if (move_uploaded_file($_FILES['gambar']['tmp_name'], $targetPath)) {
      $gambarPath = 'uploads/' . $fileName;
    }
  }

  if ($id) {
    if ($gambarPath) {
      $stmt = $pdo->prepare("UPDATE obat SET nama=?, harga=?, gambar=?, deskripsi=?, manfaat=? WHERE id=?");
      $stmt->execute([$nama, $harga, $gambarPath, $deskripsi, $manfaat, $id]);
    } else {
      $stmt = $pdo->prepare("UPDATE obat SET nama=?, harga=?, deskripsi=?, manfaat=? WHERE id=?");
      $stmt->execute([$nama, $harga, $deskripsi, $manfaat, $id]);
    }
  } else {
    $stmt = $pdo->prepare("INSERT INTO obat (nama, harga, gambar, deskripsi, manfaat) VALUES (?, ?, ?, ?, ?)");
    $stmt->execute([$nama, $harga, $gambarPath, $deskripsi, $manfaat]);
  }

  header("Location: kelola_obat.php");
  exit;
}

// === Proses Hapus ===
if (isset($_GET['hapus'])) {
  $stmt = $pdo->prepare("DELETE FROM obat WHERE id = ?");
  $stmt->execute([$_GET['hapus']]);
  header("Location: kelola_obat.php");
  exit;
}

// === Ambil data untuk edit
$editData = null;
if (isset($_GET['edit'])) {
  $stmt = $pdo->prepare("SELECT * FROM obat WHERE id = ?");
  $stmt->execute([$_GET['edit']]);
  $editData = $stmt->fetch();
}

$query = $pdo->query("SELECT * FROM obat ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Obat - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans text-gray-800 p-6">

  <div class="max-w-7xl mx-auto">
    <h1 class="text-3xl font-extrabold text-blue-700 mb-8 text-center">🩺 Kelola Obat - INDYAPHARMA</h1>

<!-- Tombol Kembali -->
<div class="mb-6 text-center">
  <a href="dashboard.php" class="inline-block bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition">
    ← Kembali ke Dashboard
  </a>
</div>
    
    <!-- Form Tambah/Edit -->
    <div class="bg-white p-6 rounded shadow mb-10">
      <h2 class="text-xl font-semibold mb-4"><?= $editData ? 'Edit Obat' : 'Tambah Obat' ?></h2>
      <form action="kelola_obat.php" method="POST" enctype="multipart/form-data" class="space-y-4">
        <?php if ($editData): ?>
          <input type="hidden" name="id" value="<?= $editData['id'] ?>">
        <?php endif; ?>
        <input type="text" name="nama" placeholder="Nama Obat" value="<?= htmlspecialchars($editData['nama'] ?? '') ?>" required class="w-full border p-3 rounded text-sm">
        <input type="number" name="harga" placeholder="Harga" value="<?= $editData['harga'] ?? '' ?>" required class="w-full border p-3 rounded text-sm">
        <input type="file" name="gambar" class="w-full border p-3 rounded text-sm">
        <textarea name="deskripsi" placeholder="Deskripsi" required class="w-full border p-3 rounded text-sm"><?= htmlspecialchars($editData['deskripsi'] ?? '') ?></textarea>
        <textarea name="manfaat" placeholder="Manfaat" required class="w-full border p-3 rounded text-sm"><?= htmlspecialchars($editData['manfaat'] ?? '') ?></textarea>
        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded hover:bg-blue-700 transition"><?= $editData ? 'Update Obat' : 'Simpan Obat' ?></button>
      </form>
    </div>

    <!-- Daftar Obat -->
    <div class="overflow-x-auto">
      <table class="w-full text-sm bg-white rounded shadow">
        <thead class="bg-blue-100">
          <tr class="text-left">
            <th class="p-3">Nama</th>
            <th class="p-3">Harga</th>
            <th class="p-3">Gambar</th>
            <th class="p-3">Deskripsi</th>
            <th class="p-3">Manfaat</th>
            <th class="p-3">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while($obat = $query->fetch()): ?>
            <tr class="border-b hover:bg-gray-50">
              <td class="p-3 font-medium"><?= htmlspecialchars($obat['nama']) ?></td>
              <td class="p-3">Rp <?= number_format($obat['harga'], 0, ',', '.') ?></td>
              <td class="p-3">
                <?php if (!empty($obat['gambar'])): ?>
                  <img src="<?= htmlspecialchars($obat['gambar']) ?>" alt="gambar" class="w-20 h-20 object-cover rounded">
                <?php else: ?>
                  <span class="text-gray-400 italic">-</span>
                <?php endif; ?>
              </td>
              <td class="p-3"><?= htmlspecialchars($obat['deskripsi']) ?></td>
              <td class="p-3"><?= htmlspecialchars($obat['manfaat']) ?></td>
              <td class="p-3 space-x-2">
                <a href="kelola_obat.php?edit=<?= $obat['id'] ?>" class="text-blue-600 hover:underline">Edit</a>
                <a href="kelola_obat.php?hapus=<?= $obat['id'] ?>" onclick="return confirm('Hapus obat ini?')" class="text-red-600 hover:underline">Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>
  </div>

</body>
</html>
