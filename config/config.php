<?php
// Membuat variabel/constant untuk menyimpan basis rute localhost atau hostingan website
define("BASE_URL", "http://localhost:8888/WebProject_InventoriApp/"); // Lokasi folder aplikasi

// Untuk Koneksi Database
$host = 'localhost:8889'; // nama server
$user = 'root'; //username
$pass = 'root'; // password
$dbname = 'webInventory'; // nama database

// Menjalankan koneksi dengan database
$db = new mysqli($host, $user, $pass, $dbname);

// Cek jika koneksi ke Database Gagal
if (!$db) {
  // Menampilkan pesan error karena gagal melakukan koneksi
  die("Gagal Terhubung Dengan Database" . mysqli_connect_error());
}

// Cek jika session sudah berjalan
if (!isset($_SESSION)) {
  // Menjalankan Session
  session_start();
}
