<?php
// Memanggil file config
include "config/config.php";

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
  <title>Dashboard</title>
</head>

<body>

  <div class="container">
    <div class="header">
      <h3>InventoriApp</h3>
    </div>
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

    <div class="main-content" style="text-align: center;">

      <h1 style="text-align: left;">Dashboard</h1>
      <hr class="garis-hor">

      <div class="box-baris">
        <div class="box-kolom" style="width: 49.60%;">
          <div class="card">
            <div class="card-body" style="border-radius: 5px;">
              <center>
                <h2>Produk</h2><br>
                <h3 style="color: #455757;">20</h3>
              </center>
            </div>
          </div>
        </div>

        <div class="box-kolom" style="width: 48.82%;">
          <div class="card">
            <div class="card-body" style="border-radius: 5px;">
              <center>
                <h2>Kategori</h2><br>
                <h3 style="color: #455757;">5</h3>
              </center>
            </div>
          </div>
        </div>
      </div>

      <div class="box-baris">
        <div class="box-kolom">
          <div class="card">
            <div class="card-header" style="text-align: left;">Daftar Produk Terbaru</div>
            <div class="card-body">
              <div style="width: 98%; margin: auto;">

                <?php
                // Menyiapkan perintah query untuk menarik data dari database
                $query = "SELECT * FROM tb_item JOIN tb_kategori ON tb_item.id_kat = tb_kategori.id_kat ORDER BY id_item DESC"; // Data yg ditarik berasal dari 2 tabel yang di Gabungkan/Join
                // Eksekusi query untuk menarik data
                $execQuery = mysqli_query($db, $query) or die('Eksekusi Perintah Query Gagal: ' . mysqli_error($db)); // Menampilkan pesan error jika query gagal dieksekusi
                $no = 1; // Untuk No urutan pada table
                ?>

                <table class="table-strip" style="width: 100%; text-align: center;">
                  <thead>
                    <th>#</th>
                    <th>Nama Produk</th>
                    <th>Kategori</th>
                    <th>Stok</th>
                  </thead>
                  <tbody>
                    <!-- Cek jika data tersedia dalam database -->
                    <?php if (mysqli_num_rows($execQuery) != 0) : ?>
                      <!-- Menampilkan semua data yg ditarik dari database -->
                      <?php while ($data = mysqli_fetch_assoc($execQuery)) : ?>
                        <tr>
                          <td><?php echo $no++; ?></td>
                          <td><?php echo $data['nama_item']; ?></td>
                          <td><?php echo $data['nama_kat']; ?></td>
                          <td><?php echo $data['stok']; ?></td>
                        </tr>
                      <?php endwhile; ?>
                    <?php else : ?>
                      <!-- Menampilkan Tabel Kosong -->
                      <tr>
                        <td colspan="4">
                          <center>Data Kosong!</center>
                        </td>
                      </tr>
                    <?php endif ?>
                  </tbody>
                </table>
              </div>
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