<?php
require_once 'includes/koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'] ?? '';
  $email = $_POST['email'] ?? '';
  $apotek = $_POST['apotek'] ?? '';
  $kota = $_POST['kota'] ?? '';
  $pesan = $_POST['pesan'] ?? '';

  $stmt = $pdo->prepare("INSERT INTO mitra (nama, email, apotek, kota, pesan) VALUES (?, ?, ?, ?, ?)");
  $stmt->execute([$nama, $email, $apotek, $kota, $pesan]);

  header('Location: kemitraan.php?success=1');
  exit;
}

$query = $pdo->query("SELECT * FROM mitra WHERE status = 'diterima' ORDER BY tanggal DESC");
$mitra_list = $query->fetchAll();
?>

<?php include 'includes/header.php'; ?>

<div class="bg-gray-50 text-gray-800 min-h-screen font-sans">
  <div class="container mx-auto px-4 py-12">
    <h1 class="text-3xl font-extrabold text-center text-teal-700 mb-8">Kemitraan INDYAPHARMA</h1>

    <?php if (isset($_GET['success'])): ?>
      <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded shadow max-w-2xl mx-auto">
        ✅ Terima kasih! Permintaan kemitraan Anda telah dikirim dan akan diproses oleh tim kami.
      </div>
    <?php endif; ?>

    <!-- Form Pendaftaran Mitra -->
    <form method="POST" class="bg-white p-6 rounded shadow-md max-w-2xl mx-auto mb-12 space-y-4">
      <input type="text" name="nama" placeholder="Nama Lengkap" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
      <input type="email" name="email" placeholder="Email" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
      <input type="text" name="apotek" placeholder="Nama Apotek" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
      <input type="text" name="kota" placeholder="Kota" required class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm">
      <textarea name="pesan" placeholder="Pesan Tambahan (Opsional)" rows="4" class="w-full border border-gray-300 p-2 rounded focus:outline-none focus:ring-2 focus:ring-blue-300 text-sm"></textarea>
      <button type="submit" class="bg-gradient-to-r from-blue-600 to-emerald-500 text-white px-6 py-2 rounded shadow hover:opacity-90 transition text-sm font-semibold">
        Kirim Permohonan
      </button>
    </form>

    <!-- Daftar Mitra -->
    <h2 class="text-2xl font-semibold text-center text-blue-700 mb-6">Mitra Resmi INDYAPHARMA</h2>
    <?php if (empty($mitra_list)): ?>
      <p class="text-center text-gray-600 italic">Belum ada mitra yang ditampilkan.</p>
    <?php else: ?>
      <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        <?php foreach ($mitra_list as $mitra): ?>
          <div class="bg-white p-5 rounded-lg border border-blue-100 shadow hover:shadow-md transition">
            <h3 class="text-lg font-bold text-blue-700 mb-1"><?= htmlspecialchars($mitra['apotek']) ?></h3>
            <p class="text-sm text-gray-600 mb-1">oleh <strong><?= htmlspecialchars($mitra['nama']) ?></strong> – <?= htmlspecialchars($mitra['kota']) ?></p>
            <?php if (!empty($mitra['pesan'])): ?>
              <p class="text-sm text-gray-700 italic">"<?= nl2br(htmlspecialchars($mitra['pesan'])) ?>"</p>
            <?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
