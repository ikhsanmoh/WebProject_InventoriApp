<?php
// Memanggil file config
include "../../config/config.php";

// Cek jika tombol simpan pada form tambah item sudah di klik
if (!isset($_POST['tambah_item'])) {
  // Kembali ke halaman form tambah item
  header('Location:' . BASE_URL . 'app/item/item-masuk.php?page=item-masuk');
  die();
}

// Menyimpan data POST yang dikirim dari form tambah item kedalam variabel
$tgl = date('Y-m-d', strtotime($_POST['tanggal']));
$nama_supplier = $_POST['nama_supplier'];
$nama_item = $_POST['nama_item'];
$kat_item = $_POST['kategori_item'] == '0' ? '-' : $_POST['kategori_item']; // Jika kategori dikosongkan maka var diisi dgn string "-"
$hrg_beli = $_POST['harga_beli'];
$hrg_jual = $_POST['harga_jual'];
$jml = $_POST['jumlah_item'];

// Merubah nama barang yang diinput menjadi huruf kecil bersambung
$nama_item_hurufkecil_bersambung = str_replace(' ', '', strtolower($nama_item));
// Menyiapkan perintah query untuk mengecek kesamaan nama barang inputan dengan nama barang yang tersedia dalam database
$query = "SELECT id_item, nama_item, stok FROM tb_item WHERE REPLACE(LOWER(nama_item), ' ', '') = '$nama_item_hurufkecil_bersambung'";
// Eksekusi Perintah Query untuk mengecek kesamaan nama barang
$execQuery = mysqli_query($db, $query) OR die('Kesalahan pada perintah Query: '.mysqli_error($db));

// Cek jika nama barang yang di input sudah tersedia dalam database
if (mysqli_num_rows($execQuery) > 0) {
  // Menarik data barang dari database
  $data = mysqli_fetch_assoc($execQuery);

  // Menambah data stok barang dengan jumlah barang yang diinput
  $jml += $data['stok'];

  // Menyiapkan perintah query untuk pembaharuan stok barang dalam database
  $query = "UPDATE tb_item SET stok = '$jml' WHERE id_item = '$data[id_item]'";
  // Eksekusi Perintah query untuk memperbaharui stok barang
  $execQuery = mysqli_query($db, $query) OR die('Kesalahan pada perintah query: ' .mysqli_error($db));
} else {
  // Menyiapkan Perintah Query untuk menyimpan data barang inputan
  $query = "INSERT INTO tb_item (nama_supplier, nama_item, id_kat, harga_beli, harga_jual, stok, tanggal) VALUES ('$nama_supplier', '$nama_item', '$kat_item', '$hrg_beli', '$hrg_jual', '$jml', '$tgl')";
  // Eksekusi Perintah Query untuk menyimpan data barang kedalam database
  $execQuery = mysqli_query($db, $query) or die('Kesalahan pada Perintah Query: ' . mysqli_error($db)); // Jika Query gagal di eksekusi maka akan tampil pesan Error
}

// Kembali ke halaman item dengan pesan sukses
header('Location: ' . BASE_URL . 'app/item/item.php?page=item&status=tambah_sukses');
