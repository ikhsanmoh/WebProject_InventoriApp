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
  <title>Stok</title>
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

      <h1>Stok</h1>
      <hr class="garis-hor">
      <div class='card'>
        <h3 class='card-header'>
          Daftar Stok Produk
        </h3>
        <div class='card-body'>
          <div style="width: 98%; margin: auto;">
            <table class="table-strip" style="width: 100%; text-align: center;">
              <thead>
                <th>#</th>
                <th>Nama Produk</th>
                <th>Kategori</th>
                <th>Stok</th>
              </thead>
              <tbody>
                <tr>
                  <td>1</td>
                  <td>Produk 1</td>
                  <td>Kat 1</td>
                  <td>200</td>
                </tr>
                <tr>
                  <td>2</td>
                  <td>Produk 2</td>
                  <td>Kat 2</td>
                  <td>50</td>
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