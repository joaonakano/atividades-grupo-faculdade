<?php
require __DIR__ . "/../src/bootstrap.php";
require __DIR__ . "/../src/product_register.php";
require_login();
?>

<?php view('header', ['title' => 'Cadastro de Jogo']); ?>

<link rel="stylesheet" href="css/product_register.css">
<main>
    <h1>Cadastro de Jogo</h1>
    <form method="POST" enctype="multipart/form-data">
        <div>
            <label for="title">Insira o Título:</label>
            <input type="text" name="title" id="title" value="<?= $inputs['title'] ?? ''?>">
            <small><?= $errors['title'] ?? '' ?></small>
        </div>

        <div>
            <label for="price">Insira o Preço:</label>
            <input type="number" name="price" id="price" step="any" min="0" value="<?= $inputs['price'] ?? ''?>">
            <small><?= $errors['price'] ?? '' ?></small>
        </div>
        
        <div>
            <label for="publisher">Insira a Distribuidora:</label>
            <input type="text" name="publisher" id="publisher" value="<?= $inputs['publisher'] ?? '' ?>">
            <small><?= $errors['publisher'] ?? '' ?></small>
        </div>
        
        <div>
            <label for="genre">Insira o Gênero:</label>
            <input type="text" name="genre" id="genre" value="<?= $inputs['genre'] ?? '' ?>">
            <small><?= $errors['genre'] ?? '' ?></small>
        </div>

        <div>
            <label for="description">Insira a Descrição:</label>
            <input type="text" name="description" id="description" value="<?= $inputs['description'] ?? '' ?>">
            <small><?= $errors['description'] ?? '' ?></small>
        </div>
        
        <div>
            <label for="image">Insira uma Imagem:</label>
            <input type="file" name="image" id="image" value="<?= $inputs['image'] ?? '' ?>">
            <small><?= $errors['image'] ?? '' ?></small>
        </div>
        
        <button type="submit">Cadastrar</button>
    </form>
</main>

<?php view('footer'); ?>