<?php
require_once 'includes/koneksi.php';

$id = $_GET['id'] ?? null;
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Artikel - INDYAPHARMA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800 min-h-screen">
  <?php include 'includes/header.php'; ?>

  <div class="container mx-auto px-4 py-12">
    <?php if ($id): ?>
      <?php
        $stmt = $pdo->prepare("SELECT * FROM artikel WHERE id = ?");
        $stmt->execute([$id]);
        $artikel = $stmt->fetch();

        if (!$artikel): ?>
          <h1 class='text-center text-red-500 text-xl'>Artikel tidak ditemukan.</h1>
        <?php else: ?>
          <!-- Detail Artikel -->
          <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl font-extrabold text-slate-800 mb-2"><?= htmlspecialchars($artikel['judul']) ?></h1>
            <p class="text-sm text-gray-500 mb-4"><?= date('d M Y', strtotime($artikel['tanggal'])) ?></p>
            <?php if (!empty($artikel['gambar'])): ?>
              <img src="<?= htmlspecialchars($artikel['gambar']) ?>" alt="Gambar Artikel" class="w-full h-64 object-cover rounded-lg mb-6 shadow">
            <?php endif; ?>
            <div class="prose max-w-none text-justify text-base text-gray-700">
              <?= nl2br(htmlspecialchars($artikel['isi'])) ?>
            </div>
            <div class="mt-10 text-center">
              <a href="artikel.php" class="bg-amber-500 text-white px-6 py-2 rounded hover:bg-amber-600 transition">← Kembali ke Daftar Artikel</a>
            </div>
          </div>
        <?php endif; ?>

    <?php else: ?>
      <!-- Daftar Artikel -->
      <h1 class="text-3xl font-bold text-center text-amber-600 mb-10">Artikel Kesehatan</h1>
      <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php
          $query = $pdo->query("SELECT * FROM artikel ORDER BY tanggal DESC");
          while ($artikel = $query->fetch()):
        ?>
        <div class="bg-white border border-slate-200 rounded-lg shadow-sm hover:shadow-md transition p-4">
          <?php if (!empty($artikel['gambar'])): ?>
            <img src="<?= htmlspecialchars($artikel['gambar']) ?>" alt="Gambar" class="w-full h-40 object-cover rounded mb-3">
          <?php endif; ?>
          <h2 class="text-lg font-semibold text-slate-800 mb-1"><?= htmlspecialchars($artikel['judul']) ?></h2>
          <p class="text-xs text-gray-500 mb-2"><?= date('d M Y', strtotime($artikel['tanggal'])) ?></p>
          <p class="text-sm text-gray-700"><?= nl2br(htmlspecialchars(substr($artikel['isi'], 0, 120))) ?>...</p>
          <a href="artikel.php?id=<?= $artikel['id'] ?>" class="text-amber-600 text-sm mt-2 inline-block hover:underline">Lihat Selengkapnya</a>
        </div>
        <?php endwhile; ?>
      </div>

      <div class="text-center mt-12">
        <a href="index.php" class="bg-slate-700 text-white px-6 py-2 rounded hover:bg-slate-800 transition">← Kembali ke Beranda</a>
      </div>
    <?php endif; ?>
  </div>

  <?php include 'includes/footer.php'; ?>
</body>
</html>
