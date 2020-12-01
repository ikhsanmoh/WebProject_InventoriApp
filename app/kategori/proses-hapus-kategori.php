<?php
// Memanggil file config
include "../../config/config.php";

// Cek id kategori yg akan di hapus
if (!isset($_GET['id_kat'])) {
  // Kembali ke halaman Kategori
  header('Location: ' . BASE_URL . 'app/kategori/kategori.php?page=kategori');
  die();
}

// Menyimpan id kategori yg akan dihapus kedalam variabel
$id_kat = $_GET['id_kat'];

// Menyiapkan Perintah Query untuk menghapus data
$query = "DELETE FROM tb_kategori WHERE id_kat = '$id_kat'";
// Eksekusi Perintah Query untuk menghapus data dalam database
$execQuery = mysqli_query($db, $query) or die('Kesalahan pada Perintah Query: ' . mysqli_error($db)); // Jika Query gagal di eksekusi maka akan tampil pesan Error

// Kembali ke halaman kategori dengan pesan sukses
header('Location: ' . BASE_URL . 'app/kategori/kategori.php?page=kategori&status=hapus_sukses');
