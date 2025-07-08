<?php
require_once '../includes/koneksi.php';

// === Tambah / Edit Artikel ===
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $id = $_POST['id'] ?? null;
  $judul = $_POST['judul'] ?? '';
  $isi = $_POST['isi'] ?? '';
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
      $stmt = $pdo->prepare("UPDATE artikel SET judul=?, isi=?, gambar=? WHERE id=?");
      $stmt->execute([$judul, $isi, $gambarPath, $id]);
    } else {
      $stmt = $pdo->prepare("UPDATE artikel SET judul=?, isi=? WHERE id=?");
      $stmt->execute([$judul, $isi, $id]);
    }
  } else {
    $stmt = $pdo->prepare("INSERT INTO artikel (judul, isi, gambar) VALUES (?, ?, ?)");
    $stmt->execute([$judul, $isi, $gambarPath]);
  }

  header("Location: kelola_artikel.php");
  exit;
}

// === Hapus Artikel
if (isset($_GET['hapus'])) {
  $stmt = $pdo->prepare("DELETE FROM artikel WHERE id=?");
  $stmt->execute([$_GET['hapus']]);
  header("Location: kelola_artikel.php");
  exit;
}

// === Ambil data artikel
$editData = null;
if (isset($_GET['edit'])) {
  $stmt = $pdo->prepare("SELECT * FROM artikel WHERE id=?");
  $stmt->execute([$_GET['edit']]);
  $editData = $stmt->fetch();
}

$query = $pdo->query("SELECT * FROM artikel ORDER BY id DESC");
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Artikel</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen font-sans">

  <div class="max-w-6xl mx-auto px-4 py-8">

    <!-- Header dan Tombol -->
    <div class="flex justify-between items-center mb-8">
      <h1 class="text-3xl font-bold text-blue-700">📰 Kelola Artikel</h1>
      <a href="dashboard.php" class="text-sm bg-gray-300 px-4 py-2 rounded hover:bg-gray-400 shadow">← Kembali ke Dashboard</a>
    </div>

    <!-- Form Tambah / Edit -->
    <div class="bg-white p-6 rounded shadow mb-10">
      <h2 class="text-xl font-semibold mb-4"><?= $editData ? '✏️ Edit Artikel' : ' Tambah Artikel' ?></h2>
      <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <?php if ($editData): ?>
          <input type="hidden" name="id" value="<?= $editData['id'] ?>">
        <?php endif; ?>
        <input type="text" name="judul" placeholder="Judul artikel" value="<?= htmlspecialchars($editData['judul'] ?? '') ?>" required class="w-full border p-3 rounded text-sm">
        <textarea name="isi" placeholder="Isi artikel" required class="w-full border p-3 rounded text-sm" rows="5"><?= htmlspecialchars($editData['isi'] ?? '') ?></textarea>
        <input type="file" name="gambar" class="w-full border p-2 rounded text-sm">
        <button class="bg-blue-600 text-white px-5 py-2 rounded hover:bg-blue-700 transition"><?= $editData ? '💾 Update' : '📥 Simpan' ?></button>
      </form>
    </div>

    <!-- Daftar Artikel -->
    <div class="overflow-x-auto">
      <table class="w-full bg-white rounded shadow text-sm">
        <thead class="bg-blue-100 text-gray-700">
          <tr>
            <th class="p-3 text-left">Judul</th>
            <th class="p-3 text-left">Gambar</th>
            <th class="p-3 text-left">Tanggal</th>
            <th class="p-3 text-left">Aksi</th>
          </tr>
        </thead>
        <tbody>
          <?php while($a = $query->fetch()): ?>
            <tr class="border-b hover:bg-gray-50">
              <td class="p-3 font-medium text-gray-800"><?= htmlspecialchars($a['judul']) ?></td>
              <td class="p-3">
                <?php if (!empty($a['gambar'])): ?>
                  <img src="<?= htmlspecialchars($a['gambar']) ?>" alt="Gambar Artikel" class="w-16 h-16 object-cover rounded">
                <?php else: ?>
                  <span class="text-gray-400 italic">Tidak ada gambar</span>
                <?php endif; ?>
              </td>
              <td class="p-3 text-sm text-gray-500"><?= $a['tanggal'] ?></td>
              <td class="p-3 space-x-2">
                <a href="?edit=<?= $a['id'] ?>" class="text-blue-600 hover:underline text-sm">✏️ Edit</a>
                <a href="?hapus=<?= $a['id'] ?>" onclick="return confirm('Hapus artikel ini?')" class="text-red-600 hover:underline text-sm">🗑️ Hapus</a>
              </td>
            </tr>
          <?php endwhile; ?>
        </tbody>
      </table>
    </div>

  </div>

</body>
</html>
