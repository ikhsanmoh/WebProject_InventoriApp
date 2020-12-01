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

// Cek id item yg akan diedit 
if (!isset($_GET['id_item'])) {
  // Kembali ke halaman Item
  header('Location: ' . BASE_URL . 'app/item/item.php?page=item');
  die();
}

// digunakan untuk menentukan aktivasi menu pada nav menu
$page = isset($_GET['page']) ? $_GET['page'] : false;
// menyimpan id_item kedalam variabel
$id_item = $_GET['id_item'];

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo BASE_URL . "css/style.css"; ?>">
  <title>Edit Item</title>
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
        <li class="<?php echo $page == 'kategori' ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "app/kategori/kategori.php?page=kategori"; ?>">kategori</a></li>
        <li class="<?php echo $page == 'item' ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "app/item/item.php?page=item"; ?>">Item</a></li>
        <li class="<?php echo $page == 'stok' ? 'active' : '' ?>"><a href="<?php echo BASE_URL . "app/stok/stok.php?page=stok"; ?>">Stok</a></li>
        <li><a href="<?php echo BASE_URL . 'app/auth/proses-logout.php?logout=1'; ?>">Logout</a></li>
      </ul>
      <!-- </nav> -->
    </div>

    <div class="main-content">

      <?php
      // Menyiapkan perintah query untuk menarik data item yg akan diedit dari database
      $queryItem = "SELECT * FROM tb_item WHERE id_item = '$id_item'";
      // Eksekusi query
      $execQueryItem = mysqli_query($db, $queryItem) or die('Terjadi kesalahan pada Query: ' . mysqli_error($db)); // Jika terjadi kesalahan pada query maka akan menampilkan pesan Error
      // Cek jika id item yang akan diedit tersedia dalam database
      if (mysqli_num_rows($execQueryItem) == 0) {
        // Kembali ke halaman Item
        header('Location: ' . BASE_URL . 'app/item/item.php?page=item');
        die();
      }
      // Menarik data hasil Eksekusi Query
      $dataItem = mysqli_fetch_assoc($execQueryItem);

      // Menyiapkan printah query untuk menarik data kategori
      $queryKategori = "SELECT * FROM tb_kategori";
      // Eksekusi Query
      $execQueryKategori = mysqli_query($db, $queryKategori) or die('Terjadi kesalahan pada perintah query: ' . mysqli_error($db)); // Menampilkan pesan error jika eksekusi gagal
      ?>

      <h1>Item</h1>
      <hr class="garis-hor">
      <div class='card' style="width: 70%; margin:auto;">
        <h3 class='card-header'>
          Edit Item
        </h3>
        <div class='card-body'>
          <form action="proses-update-item.php" method="POST">
            <input type="hidden" name="id_item" value="<?php echo $id_item ?>">
            <table class="table">
              <tr>
                <td><label for="nm">Nama Barang</label></td>
                <td><input type="text" name="nama_item" id="nm" value="<?php echo $dataItem['nama_item']; ?>" required></td>
              </tr>
              <tr>
                <td><label for="kat">Kategori</label></td>
                <td>
                  <select name="kategori_item" id="kat" required>
                    <option value="">--Pilih--</option>
                    <?php if (mysqli_num_rows($execQueryKategori) != 0) : ?>
                      <?php while ($dataKategori = mysqli_fetch_assoc($execQueryKategori)) : ?>
                        <option value="<?php echo $dataKategori['id_kat']; ?>"><?php echo $dataKategori['nama_kat']; ?></option>
                      <?php endwhile; ?>
                    <?php endif; ?>
                  </select>
                </td>
              </tr>
              <tr>
                <td><label for="hrg">Harga</label></td>
                <td><input type="number" name="harga_item" id="hrg" value="<?php echo $dataItem['harga']; ?>" required></td>
              </tr>
              <tr>
                <td></td>
                <td style="text-align: right;">
                  <a class="btn-merah" style="font-size: 0.85rem;" href="<?php echo BASE_URL . "app/item/item.php?page=item"; ?>">Batal</a>
                  <input class="btn-biru" type="submit" name="update_item" value="Simpan">
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