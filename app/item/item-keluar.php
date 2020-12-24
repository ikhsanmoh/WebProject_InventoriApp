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
  <title>Item Keluar</title>
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
        // Menyiapkan printah query untuk menarik data barang
        $query = "SELECT id_item, nama_item FROM tb_item";
        // Eksekusi Query
        $execQuery = mysqli_query($db, $query) or die('Terjadi kesalahan pada perintah query: ' . mysqli_error($db)); // Menampilkan pesan error jika eksekusi gagal

        // Mengambil Tanggal Sekarang (Zona Jakarta)
        ini_set('date.timezone', 'Asia/Jakarta');
        $tgl = date('d-m-Y');
        ?>

        <h1>Item</h1>
        <hr class="garis-hor">
        <div class='card' style="width: 70%; margin:auto;">
          <h3 class='card-header'>
            Item Keluar
          </h3>
          <div class='card-body'>
            <form action="proses-item-keluar.php" method="POST">
              <table class="table">
                <tr>
                  <td><label for="tgl">Tanggal <span style="color:red;">*</span></label></td>
                  <td><input type="text" name="tanggal" id="tgl" value="<?php echo $tgl; ?>" readonly></td>
                </tr>
                <tr>
                  <td><label for="item">Barang <span style="color:red;">*</span></label></td>
                  <td>
                    <select name="id_item" id="item" required>
                      <option value="" selected>--Pilih--</option>
                      <!-- Cek jika  data item tersedia dalam database -->
                      <?php if (mysqli_num_rows($execQuery) != 0) : ?>
                        <!-- Menarik semua data item -->
                        <?php while ($data = mysqli_fetch_assoc($execQuery)) : ?>
                          <option value="<?php echo $data['id_item']; ?>"><?php echo $data['nama_item']; ?></option>
                        <?php endwhile; ?>
                      <?php endif; ?>
                    </select>
                  </td>
                </tr>
                <tr>
                  <td><label for="jml">Jumlah <span style="color:red;">*</span></label></td>
                  <td><input type="number" name="jumlah_item" id="jml" min="1" max="999" required></td>
                </tr>
                <tr>
                  <td><label for="ket">Keterangan</label></td>
                  <td><textarea name="keterangan" id="ket" cols="30" rows="3" placeholder="rusak, hilang, dll..."></textarea></td>
                </tr>
                <tr>
                  <td></td>
                  <td style="text-align: right;">
                    <input class="btn-merah" type="reset" value="Reset">
                    <input class="btn-biru" type="submit" name="item_keluar" value="Submit">
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