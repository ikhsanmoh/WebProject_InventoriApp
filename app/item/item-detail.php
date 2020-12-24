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

// Digunakan untuk menentukan aktivasi menu pada nav menu
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
  <title>Detail Item</title>
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
        // Menyiapkan perintah query untuk menarik data item yg akan diedit dari database
        $queryItem = "SELECT * FROM tb_item LEFT JOIN tb_kategori ON tb_item.id_kat = tb_kategori.id_kat WHERE id_item = '$id_item'";
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
        ?>

        <h1>Item</h1>
        <hr class="garis-hor">
        <div class='card' style="width: 70%; margin:auto;">
          <h3 class='card-header'>
            Detail Item
          </h3>
          <div class='card-body'>
            <form action="proses-tambah-item.php" method="POST">
              <table class="table">
                <tr>
                  <td>Tanggal Masuk<span style="float: right;">:</span></td>
                  <td><?php echo date('d-m-Y', strtotime($dataItem['tanggal'])); ?></td>
                </tr>
                <tr>
                  <td>Supplier<span style="float: right;">:</span></td>
                  <td><?php echo $dataItem['nama_supplier']; ?></td>
                </tr>
                <tr>
                  <td>Barang<span style="float: right;">:</span></td>
                  <td><?php echo $dataItem['nama_item']; ?></td>
                </tr>
                <tr>
                  <td>Kategori<span style="float: right;">:</span></td>
                  <td><?php echo !empty($dataItem['nama_kat']) ? $dataItem['nama_kat'] : '-'; ?></td>
                </tr>
                <tr>
                  <td>Harga Beli<span style="float: right;">:</span></td>
                  <td><?php echo $dataItem['harga_beli']; ?></td>
                </tr>
                <tr>
                  <td>Harga Jual<span style="float: right;">:</span></td>
                  <td><?php echo $dataItem['harga_jual']; ?></td>
                </tr>
                <tr>
                  <td>Stok<span style="float: right;">:</span></td>
                  <td><?php echo $dataItem['stok']; ?></td>
                </tr>
                <tr>
                  <td></td>
                  <td style="text-align: right;">
                    <a class="btn-merah" style="font-size: 0.85rem;" href="<?php echo BASE_URL . "app/item/item.php?page=item"; ?>">Kembali</a>
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