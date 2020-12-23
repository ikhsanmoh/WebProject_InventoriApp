<?php
// Memanggil file config
include "../../config/config.php";

// Cek jika form item keluar sudah di submit
if (!isset($_POST['item_keluar'])) {
  // Kembali ke halaman Item Keluar
  header('Location: ' . BASE_URL . 'app/item/item-keluar.php?page=item-keluar');
  die();
}

// Menyimpan id item yg akan dikurangi kedalam variabel
$id_item = $_POST['id_item'];
$jml = $_POST['jumlah_item'];

// Menyiapkan query untuk menarik data stok dari item yang dipilih
$query = "SELECT stok FROM tb_item WHERE id_item = '$id_item'";
// Eksekusi Perintah Query
$execQuery = mysqli_query($db, $query) or die('Kesalahan pada Perintah Query: ' . mysqli_error($db)); // Jika Query gagal di eksekusi maka akan tampil pesan Error
// Menarik data stok
$data = mysqli_fetch_assoc($execQuery);

$stok = 0;
// Cek selisih jumlah item yang ingin dikurangi dengan data stok item dari database 
if ($jml < $data['stok']) {
  // Mengurangi stok item yang tersedia
  $stok = $data['stok'] - $jml;
}

// Menyiapkan Perintah Query untuk mengupdate data stok item
$query = "UPDATE tb_item SET stok = '$stok' WHERE id_item = '$id_item'";
// Eksekusi Perintah Query
$execQuery = mysqli_query($db, $query) or die('Kesalahan pada Perintah Query: ' . mysqli_error($db)); // Jika Query gagal di eksekusi maka akan tampil pesan Error

// Kembali ke halaman item dengan pesan sukses
header('Location: ' . BASE_URL . 'app/item/item.php?page=item&status=pengurangan_sukses');
