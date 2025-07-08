<?php
require_once '../includes/koneksi.php';

// Proses hapus pesan
if (isset($_POST['hapus_id'])) {
  $stmt = $pdo->prepare("DELETE FROM pesan_kontak WHERE id = ?");
  $stmt->execute([$_POST['hapus_id']]);
  header('Location: kontak_masuk.php');
  exit;
}

// Ambil data pesan
$query = $pdo->query("SELECT * FROM pesan_kontak ORDER BY tanggal DESC");
$pesan_list = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kontak Masuk - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans min-h-screen">

  <div class="max-w-6xl mx-auto px-4 py-8">

    <!-- Judul & Tombol -->
    <div class="flex justify-between items-center mb-6">
      <h1 class="text-3xl font-bold text-blue-700">📩 Kontak Masuk</h1>
      <a href="dashboard.php" class="bg-gray-300 hover:bg-gray-400 text-sm px-4 py-2 rounded shadow">← Kembali ke Dashboard</a>
    </div>

    <?php if (empty($pesan_list)): ?>
      <div class="bg-yellow-100 text-yellow-800 p-4 rounded shadow text-center">
        Belum ada pesan yang masuk.
      </div>
    <?php else: ?>
      <!-- Tabel Pesan -->
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white rounded shadow text-sm">
          <thead class="bg-blue-100 text-gray-700">
            <tr>
              <th class="p-3 text-left">Nama</th>
              <th class="p-3">Email</th>
              <th class="p-3">Telepon</th>
              <th class="p-3">Pesan</th>
              <th class="p-3">Tanggal</th>
              <th class="p-3">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($pesan_list as $p): ?>
              <tr class="border-b hover:bg-gray-50">
                <td class="p-3 font-semibold"><?= htmlspecialchars($p['nama']) ?></td>
                <td class="p-3 text-sm text-blue-600"><?= htmlspecialchars($p['email']) ?></td>
                <td class="p-3 text-sm"><?= htmlspecialchars($p['telepon']) ?></td>
                <td class="p-3 text-sm whitespace-pre-line"><?= nl2br(htmlspecialchars($p['pesan'])) ?></td>
                <td class="p-3 text-xs text-gray-500"><?= date('d-m-Y H:i', strtotime($p['tanggal'])) ?></td>
                <td class="p-3 text-sm">
                  <form method="POST" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')">
                    <input type="hidden" name="hapus_id" value="<?= $p['id'] ?>">
                    <button type="submit" class="text-red-600 hover:underline">🗑️ Hapus</button>
                  </form>
                </td>
              </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
      </div>
    <?php endif; ?>
    
  </div>
</body>
</html>
