<?php
require __DIR__ . "/../src/bootstrap.php";
require __DIR__ . "/../src/catalog.php";
?>

<?php view('header', ['title' => 'Catálogo']) ?>

<nav>
    <ul>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="catalog.php">Catálogo</a></li>
        <li><a href="product_register.php">Cadastrar Jogo</a></li>
    </ul>
</nav>

<?php view('footer') ?>