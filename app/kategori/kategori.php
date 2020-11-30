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
  <title>Kategori</title>
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
      <div class='card'>
        <h3 class='card-header'>
          Daftar Kategori
        </h3>
        <div class='card-body'>
          <p><b>Konten Utama</b></p><br>
          <p>
            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fugit nihil dolor perspiciatis tempore! Neque
            reiciendis quaerat officiis amet, exercitationem quae rerum repellendus provident inventore architecto illo,
            cupiditate nostrum odit dolores!
            Nemo laborum eaque sed, possimus culpa suscipit accusantium adipisci distinctio deserunt unde libero
            excepturi quod rem? Deleniti explicabo itaque nostrum doloribus. Voluptate iusto libero odit facere quas
            voluptates tempora atque.
            Dolores assumenda ipsa ex reiciendis laboriosam accusamus quibusdam molestias, ab autem, mollitia, fuga sed
            necessitatibus ipsam sit quo aliquam ut porro fugiat! Inventore, quasi reprehenderit quibusdam in placeat
            earum repellat!
            Qui at aliquid velit illo, unde minus fugiat earum in id quidem quod recusandae similique? Consectetur
            debitis asperiores atque, id ducimus nostrum magni, itaque ullam, ipsam quisquam architecto incidunt
            facilis.
            Nemo impedit obcaecati repellendus iusto, earum possimus, quasi odio placeat nulla explicabo neque.
            Doloremque quibusdam similique placeat exercitationem aspernatur provident doloribus sit numquam! Dolorem
            recusandae eos enim, ullam earum nisi.
            Atque quas nobis doloribus quo quaerat ipsa veniam iure, natus porro culpa quos explicabo doloremque
            nesciunt in iste fugit molestias ad cum sint sapiente voluptates assumenda voluptatum. Accusamus, non
            veniam?
            At, placeat provident voluptate excepturi incidunt consectetur. Consectetur excepturi labore possimus quidem
            amet officia quas corrupti nobis, veniam dolore, eos qui, illum maiores est! Pariatur maiores facere sunt
            voluptate quos!
            Amet delectus voluptatum temporibus saepe deleniti? Illo doloremque quisquam voluptatibus harum consequatur
            quas molestias inventore maiores, vitae iste mollitia sed ut minima ipsum eveniet id, culpa nostrum
            temporibus commodi nihil?
            Veniam, consectetur illo aperiam dolorum et commodi voluptas animi distinctio beatae esse debitis iste fuga
            quod voluptatem reprehenderit labore pariatur. Voluptatum quibusdam fugit nemo ex nam reiciendis vel
            voluptas iusto.
            Est, fugit architecto doloribus optio commodi tenetur quos, minus sed perspiciatis nobis delectus
            consectetur modi nostrum, repellat fuga inventore? Cumque rerum omnis praesentium voluptatum, doloribus
            soluta voluptatem voluptates quis nihil.
          </p>
        </div>
      </div>

    </div>
    <footer class="footer">
      <h5>&copy; Copyright 2020 User</h5>
    </footer>
  </div>

</body>

</html>