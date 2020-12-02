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
  <title>Tambah Kategori</title>
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
          <li class="<?php echo $page == 'item' ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "app/item/item.php?page=item"; ?>">Item</a></li>
          <li class="<?php echo $page == 'stok' ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "app/stok/stok.php?page=stok"; ?>">Stok</a></li>
          <li><a href="<?php echo BASE_URL . 'app/auth/proses-logout.php?logout=1'; ?>">Logout</a></li>
        </ul>
      </div>
      <div class="main-content">

        <h1>Kategori</h1>
        <hr class="garis-hor">
        <div class='card' style="width: 70%; margin:auto;">
          <h3 class='card-header'>
            Tambah Kategori
          </h3>
          <div class='card-body'>
            <form action="proses-tambah-kategori.php" method="POST">
              <table class="table">
                <tr>
                  <td><label for="nm_kat">Nama Kategori</label></td>
                  <td><input type="text" name="nama_kategori" id="nm_kat" required></td>
                </tr>
                <tr>
                  <td><label for="desk">Deskripsi</label></td>
                  <td><textarea name="deskripsi_kategori" id="desk" cols="10" rows="5"></textarea></td>
                </tr>
                <tr>
                  <td></td>
                  <td style="text-align: right;">
                    <a class="btn-merah" style="font-size: 0.85rem;" href="<?php echo BASE_URL . "app/kategori/kategori.php?page=kategori"; ?>">Batal</a>
                    <input class="btn-biru" type="submit" name="tambah_kategori" value="Simpan">
                  </td>
                </tr>
              </table>
            </form>
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