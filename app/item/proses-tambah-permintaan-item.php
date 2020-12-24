<?php
// Memanggil file config
include "../../config/config.php";

// Cek jika tombol simpan pada form tambah item sudah di klik
if (!isset($_POST['tambah_permintaan_item'])) {
  // Kembali ke halaman form tambah item
  header('Location:' . BASE_URL . 'app/item/tambah-permintaan-item.php?page=permintaan-item');
  die();
}

// Menyimpan data POST yang dikirim dari form tambah item kedalam variabel
$tgl = date('Y-m-d', strtotime($_POST['tanggal']));
$id_item = $_POST['id_item'];
$jml = $_POST['jumlah_permintaan_item'];
$ket = !empty($_POST['keterangan']) ? $_POST['keterangan'] : '-';

// Menyiapkan perintah query untuk menambah data permintaan dalam database
$query = "INSERT INTO tb_permintaan_item (id_item, jumlah, keterangan, tanggal) VALUES ('$id_item', '$jml', '$ket', '$tgl')";
// Eksekusi Perintah query
$execQuery = mysqli_query($db, $query) OR die('Kesalahan pada perintah query: ' .mysqli_error($db));

// Kembali ke halaman permintaan barang dengan pesan sukses
header('Location: ' . BASE_URL . 'app/item/permintaan-item.php?page=permintaan-item&status=tambah_sukses');
