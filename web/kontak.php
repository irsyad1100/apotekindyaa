<?php
require_once 'includes/koneksi.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $nama = $_POST['nama'] ?? '';
  $email = $_POST['email'] ?? '';
  $telepon = $_POST['telepon'] ?? '';
  $pesan = $_POST['pesan'] ?? '';

  $stmt = $pdo->prepare("INSERT INTO pesan_kontak (nama, email, telepon, pesan) VALUES (?, ?, ?, ?)");
  $stmt->execute([$nama, $email, $telepon, $pesan]);

  header('Location: kontak.php?success=1');
  exit;
}
?>

<?php include 'includes/header.php'; ?>

<div class="bg-gray-50 text-gray-800 min-h-screen py-10">
  <div class="container mx-auto px-4">
    <h1 class="text-3xl font-bold text-center text-slate-800 mb-8"> Hubungi Kami</h1>

    <?php if (isset($_GET['success'])): ?>
      <div class="max-w-xl mx-auto bg-green-100 border-l-4 border-green-500 text-green-800 p-4 mb-6 rounded shadow-sm">
        ✅ Terima kasih! Pesan Anda telah dikirim dan akan segera kami tanggapi.
      </div>
    <?php endif; ?>

    <form method="POST" class="bg-white p-6 rounded-lg shadow-md max-w-xl mx-auto space-y-4 border border-slate-200">
      <input type="text" name="nama" placeholder="Nama Lengkap" required class="w-full border border-slate-300 p-3 rounded text-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
      <input type="email" name="email" placeholder="Email Aktif" required class="w-full border border-slate-300 p-3 rounded text-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
      <input type="text" name="telepon" placeholder="Nomor Telepon" class="w-full border border-slate-300 p-3 rounded text-sm focus:outline-none focus:ring-2 focus:ring-teal-500">
      <textarea name="pesan" placeholder="Tulis pesan Anda di sini..." rows="5" required class="w-full border border-slate-300 p-3 rounded text-sm focus:outline-none focus:ring-2 focus:ring-teal-500"></textarea>
      <button type="submit" class="bg-teal-600 hover:bg-teal-700 text-white font-semibold px-6 py-2 rounded shadow transition">Kirim Pesan</button>
    </form>

    <div class="text-center mt-10">
      <a href="index.php" class="text-sm text-slate-600 hover:text-teal-600 underline transition">← Kembali ke Beranda</a>
    </div>
  </div>
</div>

<?php include 'includes/footer.php'; ?>
