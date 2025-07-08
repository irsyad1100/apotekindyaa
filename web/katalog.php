<?php
require_once 'includes/koneksi.php';
$query = $pdo->query("SELECT * FROM obat ORDER BY id DESC");
?>

<?php include 'includes/header.php'; ?>

<div class="bg-gray-50 text-gray-800 min-h-screen py-12 px-4">
  <div class="max-w-7xl mx-auto">
    <h1 class="text-3xl font-extrabold text-center text-slate-700 mb-8"> Katalog Produk</h1>

    <!-- Search Bar -->
    <div class="mb-8 text-center">
      <input type="text" id="search" placeholder="Cari nama obat..." 
             class="w-full max-w-md px-4 py-2 border border-slate-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-teal-500 text-sm mx-auto" />
    </div>

    <!-- Daftar Produk -->
    <div id="katalog-list" class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
      <?php while($obat = $query->fetch()): ?>
        <div class="bg-white rounded-xl border border-slate-200 shadow hover:shadow-md transition filter-item">
          <img src="<?= htmlspecialchars($obat['gambar'] ?? '') ?>"
               alt="<?= htmlspecialchars($obat['nama'] ?? '') ?>"
               class="w-full h-48 object-contain bg-slate-100 rounded-t-xl p-4" />
          <div class="p-4">
            <h3 class="text-lg font-bold text-teal-700"><?= htmlspecialchars($obat['nama'] ?? 'Tanpa Nama') ?></h3>
            <p class="text-sm text-gray-600">Rp <?= number_format($obat['harga'] ?? 0, 0, ',', '.') ?></p>
            <p class="text-sm mt-2"><span class="font-medium">Manfaat:</span> <?= htmlspecialchars($obat['manfaat'] ?? '-') ?></p>
            <p class="text-sm mt-1 text-gray-700"><?= htmlspecialchars($obat['deskripsi'] ?? '-') ?></p>
            <a href="https://wa.me/085339475550?text=Halo%20saya%20ingin%20beli%20obat%20<?= urlencode($obat['nama'] ?? '') ?>" 
               class="inline-block mt-4 bg-emerald-500 hover:bg-emerald-600 text-white px-4 py-2 rounded text-sm shadow transition">
               Checkout via WhatsApp
            </a>
          </div>
        </div>
      <?php endwhile; ?>
    </div>

    <!-- Tombol Kembali -->
    <div class="mt-12 text-center">
      <a href="index.php" class="inline-block bg-slate-700 hover:bg-slate-800 text-white px-6 py-2 rounded shadow-sm text-sm transition">
        ← Kembali ke Beranda
      </a>
    </div>
  </div>
</div>

<script src="js/katalog.js"></script>

<?php include 'includes/footer.php'; ?>
