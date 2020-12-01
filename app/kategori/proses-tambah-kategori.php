<?php
include "../../config/config.php";

// Cek jika tombol simpan pada form tambah kategori sudah di klik
if (!isset($_POST['tambah_kategori'])) {
  // Kembali ke halaman form tambah kategori
  header('Location:' . BASE_URL . '/app/kategori/tambah-kategori.php?page=kategori');
  die();
}

// Menyimpan data POST yang dikirim dari form tambah kategori kedalam variabel
$nama_kat = $_POST['nama_kategori'];
$desk_kat = !empty($_POST['deskripsi_kategori']) ? $_POST['deskripsi_kategori'] : "-"; // Jika form desk dikosongkan maka var diisi dgn string "-"

// Menyiapkan Perintah Query untuk menyimpan data
$query = "INSERT INTO tb_kategori (nama_kat, deskripsi_kat) VALUES ('$nama_kat', '$desk_kat')";
// Eksekusi Perintah Query untuk menyimpan data kedalam database
$execQuery = mysqli_query($db, $query) or die('Kesalahan pada Perintah Query: ' . mysqli_error($db)); // Jika Query gagal di eksekusi maka akan tampil pesan Error

// Kembali ke halaman kategori dengan pesan sukses
header('Location: ' . BASE_URL . 'app/kategori/kategori.php?page=kategori&status=tambah_sukses');
