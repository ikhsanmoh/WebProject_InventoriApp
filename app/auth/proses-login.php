<?php
// Memanggil file config
include "../../config/config.php";

// Cek jika tombol login sudah di klik
if (!isset($_POST['login'])) {
  // Kembali ke halaman Login
  header('Location: ' . BASE_URL . 'app/auth/login.php');
  die();
}

// Menyimpan data yg dikirim dari halaman login ke dalam variabel
$username = $_POST['username'];
$pass = $_POST['password'];

// Menyiapkan perintah query untuk mengecek username
$query = "SELECT * FROM tb_users WHERE username = '$username'";
// Eksekusi Query
$execQuery = mysqli_query($db, $query);
// Menarik hasil data yg di dapat dari eksekusi query
$data = mysqli_fetch_assoc($execQuery);

// Validasi Username
if (mysqli_num_rows($execQuery) < 1) {
  // Kembali ke halaman login dengan status kesalahan Username
  header('Location: ' . BASE_URL . 'app/auth/login.php?status=err_usernm');
  die();
}

// Validasi Password
if ($pass != $data['pass']) {
  // Kembali ke halaman login dengan status kesalahan Password
  header('Location: ' . BASE_URL . 'app/auth/login.php?status=err_pass');
  die();
}

// Men-Set Session untuk Username (Agar aplikasi tidak menolak user setelah login)
$_SESSION['username'] = $data['username'];
// Men-Set Session untuk Nama USer (Agar Nama User dapat di tampilkan pada Panel Aplikasi)
$_SESSION['nama_user'] = $data['nama'];
// Mengarahkan User ke halaman utama Aplikasi
header('Location: ' . BASE_URL . 'index.php');
die();
