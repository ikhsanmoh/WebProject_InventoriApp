<?php
// Memanggil file config
include "../../config/config.php";

// Cek jika tombol simpan pada form tambah item sudah di klik
if (!isset($_POST['tambah_item'])) {
  // Kembali ke halaman form tambah item
  header('Location:' . BASE_URL . 'app/item/tambah-item.php?page=item');
  die();
}

// Menyimpan data POST yang dikirim dari form tambah item kedalam variabel
$nama_item = $_POST['nama_item'];
$kat_item = $_POST['kategori_item'] == '0' ? '-' : $_POST['kategori_item']; // Jika kategori dikosongkan maka var diisi dgn string "-"
$hrg = $_POST['harga_item'];
$jml = $_POST['jumlah_item'];

// Menyiapkan Perintah Query untuk menyimpan data
$query = "INSERT INTO tb_item (nama_item, id_kat, harga, stok) VALUES ('$nama_item', '$kat_item', '$hrg', '$jml')";
// Eksekusi Perintah Query untuk menyimpan data kedalam database
$execQuery = mysqli_query($db, $query) or die('Kesalahan pada Perintah Query: ' . mysqli_error($db)); // Jika Query gagal di eksekusi maka akan tampil pesan Error

// Kembali ke halaman item dengan pesan sukses
header('Location: ' . BASE_URL . 'app/item/item.php?page=item&status=tambah_sukses');
