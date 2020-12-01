<?php
// Memanggil file config
include "../../config/config.php";

// Cek jika sudah login
if (isset($_SESSION['username'])) {
  // Mengarahkan User ke halaman utama aplikasi
  header('Location: ' . BASE_URL . 'index.php');
  die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <link rel="stylesheet" href="../../css/style.css">
</head>

<body>
  <div class="card-login">
    <h1>Login</h1><br>
    <form action="proses-login.php" method="POST">
      <table class="table" style="text-align: left;">
        <tr>
          <td><label for="usernm">Username</label></td>
          <td><input type="text" name="username" id="usernm" required></td>
        </tr>
        <tr>
          <td><label for="pass">Password</label></td>
          <td><input type="password" name="password" id="pass" minlength="4" maxlength="12" required></td>
        </tr>
      </table>
      <div class="card-login-act">
        <input class="btn-putih" type="reset" value="Reset" name="reset">
        <input class="btn-biru" type="submit" value="Login" name="login">
      </div>
      <?php if (isset($_GET['status'])) : ?>
        <div class="card-login-pesan">
          <?php if ($_GET['status'] == 'err_usernm') : ?>
            Username Salah!
          <?php elseif ($_GET['status'] == 'err_pass') : ?>
            Password Salah!
          <?php endif; ?>
        </div>
      <?php endif; ?>
    </form>
  </div>
</body>

</html>