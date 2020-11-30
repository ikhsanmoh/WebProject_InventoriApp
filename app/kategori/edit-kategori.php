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
  <title>Edit Kategori</title>
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
      <div class='card' style="width: 70%; margin:auto;">
        <h3 class='card-header'>
          Edit Kategori
        </h3>
        <div class='card-body'>
          <form action="#">
            <input type="hidden" name="id_kategori" value="">
            <table class="table">
              <tr>
                <td><label for="nm_kat">Nama Kategori</label></td>
                <td><input type="text" name="nama_kategori" id="nm_kat"></td>
              </tr>
              <tr>
                <td><label for="desk">Deskripsi</label></td>
                <td><textarea name="deskripsi_kategori" id="desk" cols="10" rows="5"></textarea></td>
              </tr>
              <tr>
                <td></td>
                <td style="text-align: right;">
                  <input class="btn-merah" type="reset" value="Batal">
                  <input class="btn-biru" type="submit" value="Simpan">
                </td>
              </tr>
            </table>
          </form>
        </div>
      </div>

    </div>
    <footer class="footer">
      <h5>&copy; Copyright 2020 User</h5>
    </footer>
  </div>

</body>

</html>