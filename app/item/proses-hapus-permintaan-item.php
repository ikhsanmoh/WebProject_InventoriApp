<?php
// Memanggil file config
include "../../config/config.php";

// Cek id permintaan item yg akan di hapus
if (!isset($_GET['id_permintaan_item'])) {
  // Kembali ke halaman permintaan item
  header('Location: ' . BASE_URL . 'app/item/permintaan-item.php?page=permintaan-item');
  die();
}

// Menyimpan id permintaan item yg akan dihapus kedalam variabel
$id_permintaan = $_GET['id_permintaan_item'];

// Menyiapkan Perintah Query untuk menghapus data
$query = "DELETE FROM tb_permintaan_item WHERE id_permintaan = '$id_permintaan'";
// Eksekusi Perintah Query
$execQuery = mysqli_query($db, $query) or die('Kesalahan pada Perintah Query: ' . mysqli_error($db)); // Jika Query gagal di eksekusi maka akan tampil pesan Error

// Kembali ke halaman permintaan item dengan pesan sukses
header('Location: ' . BASE_URL . 'app/item/permintaan-item.php?page=permintaan-item&status=hapus_sukses');
