<?php
// Memanggil file config
include "../../config/config.php";

// Cek jika sudah login
if (!isset($_SESSION['username'])) {
  // Mengarahkan User ke halaman login
  header('Location: ' . BASE_URL . 'app/auth/login.php');
  die();
}

// Menyimpan Nama User kedalam variabel
$nama_user = $_SESSION['nama_user'];

// Digunakan untuk menentukan aktivasi menu pada nav menu
$page = isset($_GET['page']) ? $_GET['page'] : false;
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo BASE_URL . "css/style.css"; ?>">
  <title>Kategori</title>
</head>

<body>

  <div class="container">
    <div class="header">
      <h3>InventoriApp</h3>
    </div>

    <div class="flex-container">
      <div class="sidebar">
        <div class="user-panel">
          <?php
          // Cek jika nama user tersedia
          if (isset($nama_user)) {
            // Menampilkan Nama User
            echo $nama_user;
          } else {
            // Menampilkan Text Default
            echo 'User';
          }
          ?>
        </div>
        <ul>
          <li class="<?php echo !$page ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "index.php"; ?>">Dasboard</a></li>
          <li class="<?php echo $page == 'kategori' ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "app/kategori/kategori.php?page=kategori"; ?>">Kategori</a></li>
          <li class="<?php echo $page == 'item' ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "app/item/item.php?page=item"; ?>">Kelola Item</a></li>
          <li class="<?php echo $page == 'item-masuk' ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "app/item/item-masuk.php?page=item-masuk"; ?>">Item Masuk</a></li>
          <li class="<?php echo $page == 'item-keluar' ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "app/item/item-keluar.php?page=item-keluar"; ?>">Item Keluar</a></li>
          <li class="<?php echo $page == 'permintaan-item' ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "app/item/permintaan-item.php?page=permintaan-item"; ?>">Permintaan Item</a></li>
          <li><a href="<?php echo BASE_URL . 'app/auth/proses-logout.php?logout=1'; ?>">Logout</a></li>
        </ul>
      </div>
      <div class="main-content">

        <?php
        // Menyiapkan perintah query untuk menarik data dari database
        $query = "SELECT a.*, b.nama_supplier, b.nama_item, b.stok FROM tb_permintaan_item a INNER JOIN tb_item b ON a.id_item = b.id_item";
        // Eksekusi query untuk menarik data
        $execQuery = mysqli_query($db, $query) or die('Eksekusi Perintah Query Gagal: ' . mysqli_error($db)); // Menampilkan pesan error jika query gagal dieksekusi
        
        // Deklarasi dan inisiasi var btn - digunakan untuk menentukan suatu tombol tampil atau tidak
        $btn = false;
        if (mysqli_num_rows($execQuery) != 0 ) {
          $btn = true;
        }

        $no = 1; // Untuk No urutan pada table
        ?>

        <h1>Kategori</h1>
        <hr class="garis-hor">
        <div class='card'>
          <h3 class='card-header'>
            Daftar Permintaan Item
          </h3>
          <div class='card-body'>
            <div style="width: 98%; margin: auto;">
              <div>
                <a class="btn-hijau" style="float:left;" href="<?php echo BASE_URL . "app/item/tambah-permintaan-item.php?page=permintaan-item"; ?>">Tambah Permintaan Item</a>
                <?php if($btn): ?>
                  <form style="float: right;" action="<?php echo BASE_URL . "app/item/laporan-permintaan-item.php";?>" method="POST" target='_BLANK'>
                    <input class="btn-biru" type="submit" name="btn_laporan" value="Print">
                  </form>
                <?php endif; ?>
              </div><br><br><br>
              <table class="table-strip" style="width: 100%; text-align: center;">
                <thead>
                  <th>#</th>
                  <th>Tanggal Pengajuan</th>
                  <th>Supplier</th>
                  <th>Produk</th>
                  <th>Stok</th>
                  <th>Jumlah Permintaan</th>
                  <th>Keterangan</th>
                  <th>Aksi</th>
                </thead>
                <tbody>
                  <!-- Cek jika data tersedia dalam database -->
                  <?php if (mysqli_num_rows($execQuery) != 0) : ?>
                    <!-- Menampilkan semua data yg ditarik dari database -->
                    <?php while ($data = mysqli_fetch_assoc($execQuery)) : ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['tanggal']; ?></td>
                        <td><?php echo $data['nama_supplier']; ?></td>
                        <td><?php echo $data['nama_item']; ?></td>
                        <td><?php echo $data['stok']; ?></td>
                        <td><?php echo $data['jumlah']; ?></td>
                        <td><?php echo $data['keterangan']; ?></td>
                        <td style="font-size: 0.8rem;">
                          <a class="btn-biru" href="<?php echo BASE_URL . "app/item/edit-permintaan-item.php?page=permintaan-item&id_permintaan_item=$data[id_permintaan]"; ?>">Edit</a>
                          <a class="btn-merah" onClick="return confirm('Aksi ini akan menghapus data permintaan secara permanen!')" href="<?php echo BASE_URL . "app/item/proses-hapus-permintaan-item.php?id_permintaan_item=$data[id_permintaan]"; ?>">Hapus</a>
                        </td>
                      </tr>
                    <?php endwhile; ?>
                  <?php else : ?>
                    <!-- Menampilkan Tabel Kosong -->
                    <tr>
                      <td colspan="8">
                        <center>Data Kosong!</center>
                      </td>
                    </tr>
                  <?php endif ?>
                </tbody>
                </tbody>
              </table>
            </div>
          </div>
        </div>

      </div>
    </div>

    <footer class="footer">
      <h5>&copy; Copyright 2020 User</h5>
    </footer>
  </div>

</body>

</html>