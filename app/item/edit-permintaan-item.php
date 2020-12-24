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
// menyimpan id_item kedalam variabel
$id_permintaan = $_GET['id_permintaan_item'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="<?php echo BASE_URL . "css/style.css"; ?>">
  <title>Form Permintaan Item</title>
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
        // Menyiapkan perintah query untuk menarik data permintaan yg akan diedit dari database
        $query = "SELECT a.*, b.nama_item FROM tb_permintaan_item a INNER JOIN tb_item b ON a.id_item = b.id_item WHERE id_permintaan = '$id_permintaan'";
        // Eksekusi query
        $execQuery = mysqli_query($db, $query) or die('Terjadi kesalahan pada Query: ' . mysqli_error($db)); // Jika terjadi kesalahan pada query maka akan menampilkan pesan Error
        // Cek jika id permintaan yang akan diedit tersedia dalam database
        if (mysqli_num_rows($execQuery) == 0) {
          // Kembali ke halaman Item
          header('Location: ' . BASE_URL . 'app/item/permintaan-item.php?page=item-permintaan');
          die();
        }
        // Menarik data hasil Eksekusi Query
        $data = mysqli_fetch_assoc($execQuery);
        ?>

        <h1>Item</h1>
        <hr class="garis-hor">
        <div class='card' style="width: 70%; margin:auto;">
          <h3 class='card-header'>
            Edit Permintaan Item
          </h3>
          <div class='card-body'>
            <form action="proses-update-permintaan-item.php" method="POST">
              <input type="hidden" name="id_permintaan_item" value="<?php echo $id_permintaan; ?>">
              <table class="table">
                <tr>
                  <td><label for="item">Produk</label></td>
                  <td><input type="text" name="" id="item" value="<?php echo $data['nama_item']; ?>" disabled></td>
                </tr> 
                <tr>
                  <td><label for="jml">Jumlah Permintaan<span style="color:red;">*</span></label></td>
                  <td><input type="number" name="jumlah_permintaan_item" id="jml" min="1" max="999" value="<?php echo $data['jumlah']; ?>" required></td>
                </tr>
                <tr>
                  <td><label for="ket">Keterangan</label></td>
                  <td><textarea name="keterangan" id="ket" cols="30" rows="5" maxlength="100" placeholder="stok menipis, permintaan pasar yang tinggi, dll.."><?php echo $data['keterangan']; ?></textarea></td>
                </tr>
                <tr>
                  <td></td>
                  <td style="text-align: right;">
                    <a class="btn-merah" style="font-size: 0.85rem;" href="<?php echo BASE_URL . "app/item/permintaan-item.php?page=permintaan-item"; ?>">Batal</a>
                    <input class="btn-biru" type="submit" name="update_permintaan_item" value="Simpan">
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