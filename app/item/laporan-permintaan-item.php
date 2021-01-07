<?php
// Memanggil file config
include "../../config/config.php";
// include autoloader dari library pdf maker
require_once '../../libs/dompdf/autoload.inc.php';
// reference the Dompdf namespace
use Dompdf\Dompdf;

// Deklarasi dan inisiasi var yg dibutuhkan pada pembuatan laporan
$isiLaporan = '';

// Cek jika current user datang melalui halaman report
if (!isset($_POST['btn_laporan'])) {
  // Mengarahkan User ke halaman Dasboard
  header('Location: ' . BASE_URL . 'app/auth/login.php');
  die();
}

// Mengambil Tanggal Sekarang (Zona Jakarta)
ini_set('date.timezone', 'Asia/Jakarta');
$tgl = date('d-m-Y');

// Menyiapkan perintah query untuk menarik data dari database
$query = "SELECT 
    a.*, b.nama_supplier, b.nama_item, b.stok 
  FROM 
    tb_permintaan_item a INNER JOIN tb_item b ON a.id_item = b.id_item
";
// Eksekusi query
$execQuery = mysqli_query($db, $query);

// Mengisi style laporan
$isiLaporan .= '
  <style>
    * {
      font-family: Arial, Helvetica, sans-serif;
    }
    hr {
      margin: 15px 0 50px 0;
    }
    table {
      margin: auto;
    }
    table,
    table th,
    table td {
      border: 1px solid black; border-collapse: collapse; padding: 7px;
      text-align: center;
    }
  </style>
';

// Mengisi judul laporan
$isiLaporan .= '
  <center>
    <h1>Laporan Permintaan Item</h1>
  </center>
  <hr>
';

// isi tanggal laporan
$isiLaporan .= "<p>Dicetak pada tanggal : $tgl</p>";

// cek jika ada data permintaan item tersedia
if (mysqli_num_rows($execQuery) <= 0) {
  // Mengisi laporan dengan sebuah keterangan
  $isiLaporan .= '<center><h3>Tidak ada data tersedia!</h3></center>';
} else {
  // Mengisi tabel
  $isiLaporan .= '
    <table>
      <thead>
        <tr>
          <th>Tanggal</th>
          <th>Supplier</th>
          <th>Produk</th>
          <th>Stok</th>
          <th>Jumlah Permintaan</th>
          <th>Ketarangan</th>
        </tr>
      </thead>
      <tbody>
  ';
  // Mengisi laporan dengan data permintaan item
  while ($data = mysqli_fetch_assoc($execQuery)) {
    $isiLaporan .= "
      <tr>
        <td style='width: 120px'>$data[tanggal]</td>
        <td>$data[nama_supplier]</td>
        <td>$data[nama_item]</td>
        <td>$data[stok]</td>
        <td>$data[jumlah]</td>
        <td>$data[keterangan]</td>
      </tr>
    ";
  }
  $isiLaporan .= '</tbody></table>';
}

// instasiasi(memanggil) library pdf maker
$dompdf = new Dompdf();
// Seting ukuran dan orientasi laporan
$dompdf->setPaper('A4', 'potrait');
// Membuat halaman laporan
$dompdf->loadHtml($isiLaporan);
// Render html ke pdf
$dompdf->render();
// Menampilakan hasil laporan
$dompdf->stream('laporan_pemesanan.pdf', ['Attachment' => 0]);
