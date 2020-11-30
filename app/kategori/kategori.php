<?php
include "../../config/config.php";

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
    <div class="sidebar">
      <div class="user-panel">
        User
      </div>
      <!-- <nav class="navbar"> -->
      <ul>
        <li class="<?php echo !$page ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "index.php"; ?>">Dasboard</a></li>
        <li class="<?php echo $page == 'kategori' ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "app/kategori/kategori.php?page=kategori"; ?>">Kategori</a></li>
        <li class="<?php echo $page == 'item' ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "app/item/item.php?page=item"; ?>">Item</a></li>
        <li class="<?php echo $page == 'stok' ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "app/stok/stok.php?page=stok"; ?>">Stok</a></li>
        <li><a href="#">Logout</a></li>
      </ul>
      <!-- </nav> -->
    </div>

    <div class="main-content">

      <h1>Kategori</h1>
      <hr class="garis-hor">
      <div class='card'>
        <h3 class='card-header'>
          Daftar Kategori
        </h3>
        <div class='card-body'>
          <div style="width: 98%; margin: auto;">
            <a class="btn-hijau" href="<?php echo BASE_URL . "app/kategori/tambah-kategori.php?page=kategori"; ?>">Tambah Kategori</a><br><br>
            <table class="table-strip" style="width: 100%; text-align: center;">
              <thead>
                <th>#</th>
                <th>Nama</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Kategori 1</td>
                  <td>Ini adalah Kategori satu</td>
                  <td style="font-size: 0.8rem;">
                    <a class="btn-merah" href="<?php echo BASE_URL . "app/kategori/hapus-kategori.php"; ?>">Hapus</a>
                    <a class="btn-biru" href="<?php echo BASE_URL . "app/kategori/edit-kategori.php?page=kategori"; ?>">Edit</a>
                  </td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Kategori 2</td>
                  <td>Ini adalah Kategori 2</td>
                  <td style="font-size: 0.8rem;">
                    <a class="btn-merah" href="<?php echo BASE_URL . "app/kategori/hapus-kategori.php"; ?>">Hapus</a>
                    <a class="btn-biru" href="<?php echo BASE_URL . "app/kategori/edit-kategori.php?page=kategori"; ?>">Edit</a>
                  </td>
                </tr>
              </tbody>
            </table>
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