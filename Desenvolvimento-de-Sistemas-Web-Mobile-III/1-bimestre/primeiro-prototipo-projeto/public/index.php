<?php
require __DIR__ . "/../src/bootstrap.php";
require_login();
?>

<?php view('header', ['title' => 'Dashboard']) ?>

<nav>
    <ul>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="catalog.php">Catálogo</a></li>
    </ul>
</nav>
<p>Bem-vindo, <?= current_user() ?> <a href="logout.php">Logout</a></p>

<?php view('footer') ?>
