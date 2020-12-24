<?php
// Memanggil file config
include "../../config/config.php";

// Cek jika tombol simpan pada form edit item sudah di klik
if (!isset($_POST['update_permintaan_item'])) {
  // Kembali ke halaman form edit item
  header('Location:' . BASE_URL . 'app/item/edit-permintaan-item.php?page=permintaan-item');
  die();
}

// Menyimpan data POST yang dikirim dari form edit permintaan item kedalam variabel
$id_permintaan = $_POST['id_permintaan_item'];
$jml = $_POST['jumlah_permintaan_item'];
$ket = !empty($_POST['keterangan']) ? $_POST['keterangan'] : '-';

// Menyiapkan Perintah Query untuk menyimpan data
$query = "UPDATE tb_permintaan_item SET jumlah = '$jml', keterangan = '$ket' WHERE id_permintaan = '$id_permintaan'";
// Eksekusi Perintah Query
$execQuery = mysqli_query($db, $query) or die('Kesalahan pada Perintah Query: ' . mysqli_error($db)); // Jika Query gagal di eksekusi maka akan tampil pesan Error

// Kembali ke halaman permintaan item dengan pesan sukses
header('Location: ' . BASE_URL . 'app/item/permintaan-item.php?page=permintaan-item&status=update_sukses');
