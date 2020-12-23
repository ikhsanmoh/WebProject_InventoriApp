<?php
// Memanggil file config
include "../../config/config.php";

// Cek jika tombol simpan pada form edit item sudah di klik
if (!isset($_POST['update_item'])) {
  // Kembali ke halaman form edit item
  header('Location:' . BASE_URL . 'app/item/edit-item.php?page=item');
  die();
}

// Menyimpan data POST yang dikirim dari form edit item kedalam variabel
$id_item = $_POST['id_item'];
$nama_supp = $_POST['nama_supplier'];
$nama_item = $_POST['nama_item'];
$kat_item = $_POST['kategori_item'] == '0' ? '-' : $_POST['kategori_item']; // Jika kategori dikosongkan maka var diisi dgn string "-"
$hrg_beli = $_POST['harga_beli'];
$hrg_jual = $_POST['harga_jual'];

// Menyiapkan Perintah Query untuk menyimpan data
$query = "UPDATE tb_item SET nama_supplier = '$nama_supp', nama_item = '$nama_item', id_kat = '$kat_item', harga_beli = '$hrg_beli', harga_jual = '$hrg_jual' WHERE id_item = '$id_item'";
// Eksekusi Perintah Query untuk menyimpan data kedalam database
$execQuery = mysqli_query($db, $query) or die('Kesalahan pada Perintah Query: ' . mysqli_error($db)); // Jika Query gagal di eksekusi maka akan tampil pesan Error

// Kembali ke halaman item dengan pesan sukses
header('Location: ' . BASE_URL . 'app/item/item.php?page=item&status=update_sukses');
