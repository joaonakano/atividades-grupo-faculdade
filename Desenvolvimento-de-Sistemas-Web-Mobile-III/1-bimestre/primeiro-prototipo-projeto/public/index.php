<?php
require __DIR__ . "/../src/bootstrap.php";
require_login();
?>

<?php view('header', ['title' => 'Dashboard']) ?>

<link rel="stylesheet" href="css/register_login.css">

<div class="container-principal">
    <div class="container-principal-sub">
        <nav>
            <p>Bem-vindo, <?= current_user() ?>!</p>

            <ul>
                <li><a href="logout.php">Logout</a></li>
                <li><a href="catalog.php">Catálogo</a></li>
                <li><a href="product_register.php">Cadastrar Jogo</a></li>
            </ul>
        </nav>
    </div>
</div>

<?php view('footer') ?>
