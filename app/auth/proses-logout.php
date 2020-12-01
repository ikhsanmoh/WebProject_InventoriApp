<?php
// Memanggil file config
include "../../config/config.php";

// Cek jika tombol logout belum diklik
if ($_GET['logout'] != 1) {
  // Mengarahkan User ke hamalan utama aplikasi
  header('Location: ' . BASE_URL . 'index.php');
  die();
}
// Menghapus seluruh session yang sudah dibuat (Session User)
session_destroy();
// Mengarahkan User ke halaman Login
header('Location: ' . BASE_URL . 'app/auth/login.php');
die();
