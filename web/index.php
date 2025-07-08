<?php include 'includes/header.php'; ?>

<section class="container mx-auto px-4 py-16 text-center">
  <h1 class="text-4xl font-extrabold text-slate-800 mb-4">
    Selamat Datang di <span class="text-teal-600">INDYAPHARMA</span>
  </h1>
  <p class="text-gray-600 max-w-2xl mx-auto text-base mb-12">
    INDYAPHARMA adalah apotek modern yang menyediakan berbagai obat dan informasi kesehatan terpercaya untuk Anda dan keluarga.
  </p>

  <div class="grid gap-6 md:grid-cols-3">
    <!-- Katalog Produk -->
    <div class="bg-white border border-slate-200 hover:shadow-md transition rounded-xl p-6">
      <h2 class="text-xl font-semibold text-teal-700 mb-2">Katalog Produk</h2>
      <p class="text-sm text-gray-700">Lihat berbagai jenis obat lengkap dengan deskripsi dan harga.</p>
      <a href="katalog.php" class="inline-block mt-4 bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded text-sm transition">Lihat Katalog</a>
    </div>

    <!-- Artikel Kesehatan -->
    <div class="bg-white border border-slate-200 hover:shadow-md transition rounded-xl p-6">
      <h2 class="text-xl font-semibold text-amber-600 mb-2">Artikel Kesehatan</h2>
      <p class="text-sm text-gray-700">Wawasan dan tips bermanfaat tentang kesehatan langsung dari para ahli.</p>
      <a href="artikel.php" class="inline-block mt-4 bg-amber-500 hover:bg-amber-600 text-white px-4 py-2 rounded text-sm transition">Baca Artikel</a>
    </div>

    <!-- Kemitraan -->
    <div class="bg-white border border-slate-200 hover:shadow-md transition rounded-xl p-6">
      <h2 class="text-xl font-semibold text-slate-800 mb-2">Kemitraan</h2>
      <p class="text-sm text-gray-700">Bergabunglah sebagai mitra kami dan kembangkan apotek digital bersama INDYAPHARMA.</p>
      <a href="kemitraan.php" class="inline-block mt-4 bg-slate-700 hover:bg-slate-800 text-white px-4 py-2 rounded text-sm transition">Gabung Mitra</a>
    </div>
  </div>
</section>

<?php include 'includes/footer.php'; ?>
