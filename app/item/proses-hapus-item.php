<?php
// Memanggil file config
include "../../config/config.php";

// Cek id item yg akan di hapus
if (!isset($_GET['id_item'])) {
  // Kembali ke halaman Kategori
  header('Location: ' . BASE_URL . 'app/item/item.php?page=item');
  die();
}

// Menyimpan id item yg akan dihapus kedalam variabel
$id_item = $_GET['id_item'];

// Menyiapkan Perintah Query untuk menghapus data
$query = "DELETE FROM tb_item WHERE id_item = '$id_item'";
// Eksekusi Perintah Query untuk menghapus data dalam database
$execQuery = mysqli_query($db, $query) or die('Kesalahan pada Perintah Query: ' . mysqli_error($db)); // Jika Query gagal di eksekusi maka akan tampil pesan Error

// Kembali ke halaman item dengan pesan sukses
header('Location: ' . BASE_URL . 'app/item/item.php?page=item&status=hapus_sukses');
