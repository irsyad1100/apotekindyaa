<?php
require_once '../includes/koneksi.php';

// Update status mitra
if (isset($_POST['id'], $_POST['status']) && !isset($_POST['edit_id'])) {
  $stmt = $pdo->prepare("UPDATE mitra SET status = ? WHERE id = ?");
  $stmt->execute([$_POST['status'], $_POST['id']]);
  header('Location: kelola_mitra.php');
  exit;
}

// Hapus mitra
if (isset($_POST['hapus_id'])) {
  $stmt = $pdo->prepare("DELETE FROM mitra WHERE id = ?");
  $stmt->execute([$_POST['hapus_id']]);
  header('Location: kelola_mitra.php');
  exit;
}

// Edit data mitra
if (isset($_POST['edit_id'])) {
  $stmt = $pdo->prepare("UPDATE mitra SET nama = ?, email = ?, apotek = ?, kota = ?, pesan = ?, status = ? WHERE id = ?");
  $stmt->execute([
    $_POST['nama'], $_POST['email'], $_POST['apotek'], $_POST['kota'],
    $_POST['pesan'], $_POST['status'], $_POST['edit_id']
  ]);
  header('Location: kelola_mitra.php');
  exit;
}

// Ambil data semua mitra
$query = $pdo->query("SELECT * FROM mitra ORDER BY tanggal DESC");
$mitras = $query->fetchAll();
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Mitra - Admin</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 font-sans p-6">

  <!-- Header -->
  <div class="flex justify-between items-center mb-6">
    <h1 class="text-3xl font-bold text-blue-700">🧑‍🤝‍🧑 Kelola Mitra</h1>
    <a href="dashboard.php" class="bg-gray-300 hover:bg-gray-400 text-sm px-4 py-2 rounded shadow">← Kembali ke Dashboard</a>
  </div>

  <!-- Tabel Mitra -->
  <div class="overflow-x-auto">
    <table class="min-w-full bg-white rounded shadow text-sm">
      <thead class="bg-blue-100 text-gray-700">
        <tr>
          <th class="p-3 text-left">Nama</th>
          <th class="p-3">Email</th>
          <th class="p-3">Apotek</th>
          <th class="p-3">Kota</th>
          <th class="p-3">Pesan</th>
          <th class="p-3">Status</th>
          <th class="p-3">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($mitras as $m): ?>
          <tr class="border-b hover:bg-gray-50 align-top">
            <form method="POST">
              <td class="p-2"><input type="text" name="nama" value="<?= htmlspecialchars($m['nama']) ?>" class="w-full border rounded p-1 text-xs"></td>
              <td class="p-2"><input type="email" name="email" value="<?= htmlspecialchars($m['email']) ?>" class="w-full border rounded p-1 text-xs"></td>
              <td class="p-2"><input type="text" name="apotek" value="<?= htmlspecialchars($m['apotek']) ?>" class="w-full border rounded p-1 text-xs"></td>
              <td class="p-2"><input type="text" name="kota" value="<?= htmlspecialchars($m['kota']) ?>" class="w-full border rounded p-1 text-xs"></td>
              <td class="p-2"><textarea name="pesan" rows="2" class="w-full border rounded p-1 text-xs"><?= htmlspecialchars($m['pesan']) ?></textarea></td>
              <td class="p-2 font-semibold">
                <select name="status" class="border rounded px-2 py-1 text-xs w-full
                  <?= $m['status'] === 'diterima' ? 'text-green-600' : ($m['status'] === 'ditolak' ? 'text-red-600' : 'text-yellow-600') ?>">
                  <option value="pending" <?= $m['status'] === 'pending' ? 'selected' : '' ?>>pending</option>
                  <option value="diterima" <?= $m['status'] === 'diterima' ? 'selected' : '' ?>>diterima</option>
                  <option value="ditolak" <?= $m['status'] === 'ditolak' ? 'selected' : '' ?>>ditolak</option>
                </select>
              </td>
              <td class="p-2 flex flex-col gap-1">
                <input type="hidden" name="edit_id" value="<?= $m['id'] ?>">
                <button type="submit" class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600 text-xs">💾 Simpan</button>
            </form>

            <form method="POST" onsubmit="return confirm('Yakin ingin menghapus mitra ini?')">
              <input type="hidden" name="hapus_id" value="<?= $m['id'] ?>">
              <button type="submit" class="text-red-600 hover:underline text-xs">🗑️ Hapus</button>
            </form>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>

</body>
</html>
