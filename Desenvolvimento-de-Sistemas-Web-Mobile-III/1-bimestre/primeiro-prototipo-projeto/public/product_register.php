<?php
require __DIR__ . "/../src/bootstrap.php";
require __DIR__ . "/../src/product_register.php";
?>

<?php view('header', ['title' => 'Cadastro de Jogo']); ?>

<nav>
    <ul>
        <li><a href="logout.php">Logout</a></li>
        <li><a href="catalog.php">Catálogo</a></li>
        <li><a href="product_register.php">Cadastrar Jogo</a></li>
    </ul>
</nav>
<main>
    <h1>Cadastro de Jogo</h1>
    <form method="POST">
        <div>
            <label for="title">Título: </label>
            <input type="text" name="title" id="title" value="<?= $inputs['title'] ?? ''?>">
            <small><?= $errors['title'] ?? '' ?></small>
        </div>

        <div>
            <label for="price">Preço: </label>
            <input type="number" name="price" id="price" step="any" min="0" value="<?= $inputs['price'] ?? ''?>">
            <small><?= $errors['price'] ?? '' ?></small>
        </div>
        
        <button type="submit">Cadastrar</button>
    </form>
</main>

<?php view('footer'); ?>