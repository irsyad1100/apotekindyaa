<!-- includes/header.php -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>INDYAPHARMA</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="font-sans text-slate-800 bg-gray-50">

<!-- Navbar -->
<nav class="bg-white shadow-sm sticky top-0 z-50 border-b border-gray-200">
  <div class="container mx-auto px-4 py-4 flex justify-between items-center">

    <!-- Logo dan Nama -->
    <div class="flex items-center space-x-2">
      <img src="https://cdn-icons-png.flaticon.com/512/4320/4320337.png" alt="Logo Apotek" class="w-8 h-8">
      <span class="text-2xl font-bold text-teal-600 tracking-wide">INDYAPHARMA</span>
    </div>

    <!-- Navigasi Menu -->
    <ul class="hidden md:flex space-x-6 font-medium text-sm">
      <li><a href="index.php" class="text-slate-700 hover:text-teal-600 transition">Home</a></li>
      <li><a href="kemitraan.php" class="text-slate-700 hover:text-amber-600 transition">Kemitraan</a></li>
      <li><a href="katalog.php" class="text-slate-700 hover:text-teal-600 transition">Katalog Produk</a></li>
      <li><a href="artikel.php" class="text-slate-700 hover:text-amber-600 transition">Artikel</a></li>
      <li><a href="kontak.php" class="text-slate-700 hover:text-teal-600 transition">Kontak Kami</a></li>
    </ul>

    <!-- Tombol Admin -->
    <div class="space-x-2">
      <a href="login.php" class="bg-teal-600 hover:bg-teal-700 text-white px-4 py-2 rounded shadow text-sm transition">
        Admin
      </a>
    </div>

  </div>
</nav>
