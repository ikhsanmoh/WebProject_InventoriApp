<?php
// Memanggil file config
include "../../config/config.php";
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
    <form action="../../index.php" method="post">
      Username : <input type="text" name="usernm" id="usernm" required><br><br>
      Password : <input type="password" name="pass" id="pass" required><br>

      <div class="card-login-act">
        <input type="reset" value="Reset" value="reset">
        <input type="submit" value="Login" name="login">
      </div>
    </form>
  </div>
</body>

</html>