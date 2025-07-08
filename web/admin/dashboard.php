<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: ../login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Dashboard Admin - INDYAPHARMA</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 text-gray-800">

  <!-- Navbar -->
  <nav class="bg-white shadow p-4 flex justify-between items-center">
    <h1 class="text-xl font-bold text-blue-600">INDYAPHARMA Admin</h1>
    <a href="../logout.php" class="text-red-500 hover:underline">Logout</a>
  </nav>

  <!-- Layout -->
  <div class="flex min-h-screen">
    
    <!-- Sidebar -->
    <aside class="w-64 bg-white shadow-md p-6">
      <h2 class="text-lg font-semibold mb-4">Menu</h2>
      <ul class="space-y-2">
        <li><a href="dashboard.php" class="block hover:text-blue-600 font-medium">🏠 Dashboard</a></li>
        <li><a href="kelola_obat.php" class="block hover:text-blue-600">💊 Kelola Obat</a></li>
        <li><a href="kelola_artikel.php" class="block hover:text-blue-600">📰 Kelola Artikel</a></li>
        <li><a href="kelola_mitra.php" class="block hover:text-blue-600">🤝 Kelola Mitra</a></li>
        <li><a href="kontak_masuk.php" class="block hover:text-blue-600">📨 Pesan Kontak</a></li>
      </ul>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 p-10">
      <h2 class="text-2xl font-bold mb-4">Selamat Datang, Admin!</h2>
      <p class="text-gray-700 mb-6">Gunakan menu di sebelah kiri untuk mengelola konten website INDYAPHARMA.</p>

      <!-- Statistik Dummy -->
      <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white p-4 rounded shadow">
          <h3 class="text-lg font-semibold text-blue-500">Total Produk</h3>
          <p class="text-2xl mt-2">0</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
          <h3 class="text-lg font-semibold text-green-500">Total Artikel</h3>
          <p class="text-2xl mt-2">0</p>
        </div>
        <div class="bg-white p-4 rounded shadow">
          <h3 class="text-lg font-semibold text-purple-500">Mitra Terdaftar</h3>
          <p class="text-2xl mt-2">0</p>
        </div>
      </div>
    </main>

  </div>

</body>
</html>
