<?php
// Memanggil file config
include "../../config/config.php";

// Cek jika tombol simpan pada form edit kategori sudah di klik
if (!isset($_POST['update_kategori'])) {
  // Kembali ke halaman form edit kategori
  header('Location:' . BASE_URL . 'app/kategori/edit-kategori.php?page=kategori');
  die();
}

// Menyimpan data POST yang dikirim dari form edit kategori kedalam variabel
$id_kat = $_POST['id_kategori'];
$nama_kat = $_POST['nama_kategori'];
$desk_kat = !empty($_POST['deskripsi_kategori']) ? $_POST['deskripsi_kategori'] : "-"; // Jika form desk dikosongkan maka var diisi dgn string "-"

// Menyiapkan Perintah Query untuk menyimpan data
$query = "UPDATE tb_kategori SET nama_kat = '$nama_kat', deskripsi_kat = '$desk_kat' WHERE id_kat = '$id_kat'";
// Eksekusi Perintah Query untuk menyimpan data kedalam database
$execQuery = mysqli_query($db, $query) or die('Kesalahan pada Perintah Query: ' . mysqli_error($db)); // Jika Query gagal di eksekusi maka akan tampil pesan Error

// Kembali ke halaman kategori dengan pesan sukses
header('Location: ' . BASE_URL . 'app/kategori/kategori.php?page=kategori&status=update_sukses');
