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
        $query = "SELECT * FROM tb_kategori";
        // Eksekusi query untuk menarik data
        $execQuery = mysqli_query($db, $query) or die('Eksekusi Perintah Query Gagal: ' . mysqli_error($db)); // Menampilkan pesan error jika query gagal dieksekusi
        $no = 1; // Untuk No urutan pada table
        ?>

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
                  <!-- Cek jika data tersedia dalam database -->
                  <?php if (mysqli_num_rows($execQuery) != 0) : ?>
                    <!-- Menampilkan semua data yg ditarik dari database -->
                    <?php while ($data = mysqli_fetch_assoc($execQuery)) : ?>
                      <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $data['nama_kat']; ?></td>
                        <td><?php echo $data['deskripsi_kat']; ?></td>
                        <td style="font-size: 0.8rem;">
                          <a class="btn-biru" href="<?php echo BASE_URL . "app/kategori/edit-kategori.php?page=kategori&id_kat=$data[id_kat]"; ?>">Edit</a>
                          <a class="btn-merah" onClick="return confirm('Aksi ini akan menghapus data kategori secara permanen!')" href="<?php echo BASE_URL . "app/kategori/proses-hapus-kategori.php?id_kat=$data[id_kat]"; ?>">Hapus</a>
                        </td>
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

    <footer class="footer">
      <h5>&copy; Copyright 2020 User</h5>
    </footer>
  </div>

</body>

</html>