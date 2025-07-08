<?php
session_start();
if (isset($_SESSION['admin_logged_in'])) {
    header("Location: admin/dashboard.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Login Admin - INDYAPHARMA</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-blue-50 min-h-screen">

  <?php include 'includes/header-login.php'; ?>

  <div class="flex items-center justify-center pt-10">
    <form action="proses_login.php" method="POST" class="bg-white p-8 shadow-lg rounded w-full max-w-sm space-y-4">
      <h2 class="text-2xl font-bold text-blue-600 text-center">Login Admin</h2>
      <input name="username" type="text" placeholder="Username" required class="w-full border px-4 py-2 rounded" />
      <input name="password" type="password" placeholder="Password" required class="w-full border px-4 py-2 rounded" />
      <button type="submit" class="bg-blue-600 text-white w-full py-2 rounded hover:bg-blue-700">Login</button>
      <?php if (isset($_GET['error'])): ?>
        <p class="text-red-500 text-sm text-center">Login gagal! Coba lagi.</p>
      <?php endif; ?>
    </form>
  </div>

</body>
</html>
