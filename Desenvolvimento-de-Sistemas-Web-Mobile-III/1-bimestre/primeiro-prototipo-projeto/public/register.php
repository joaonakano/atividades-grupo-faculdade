<?php
require __DIR__ . "/../src/bootstrap.php";
require __DIR__ . "/../src/register.php";
if (is_user_logged_in()) {
    redirect_to("index.php");
}

?>

<head>
    <title>Registro</title>
</head>

<link rel="stylesheet" href="css/register_login.css">

<div class="container-principal">
    <form action="register.php" method="post">
        <div class="caixa-win">
            <h1>Registro</h1>
        </div>
        <div class="container-principal-sub">
            
            <div class="item-principal-sub">
                <label for="username">Insira um Nome de Usuário:</label>    
                <input type="text" name="username" id="username" value="<?= $inputs['username'] ?? '' ?>" class="<?= error_class($errors, 'username') ?>">
                <small><?= $errors['username'] ?? '' ?></small>
            </div>

            <div class="item-principal-sub">
                <label for="email">Insira um Email:</label>    
                <input type="email" name="email" id="email" value="<?= $inputs['email'] ?? '' ?>" class="<?= error_class($errors, 'email') ?>">
                <small><?= $errors['email'] ?? '' ?></small>
            </div>

            <div class="item-principal-sub">
                <label for="password">Insira uma Senha:</label>    
                <input type="password" name="password" id="password" value="<?= $inputs['password'] ?? ''?>" class="<?= error_class($errors, 'password') ?>">
                <small><?= $errors['password'] ?? '' ?></small>
            </div>

            <div class="item-principal-sub">
                <label for="password2">Confirme a Senha:</label>    
                <input type="password" name="password2" id="password2" value="<?= $inputs['password2'] ?? '' ?>" class="<?= error_class($errors, 'password2') ?>">
                <small><?= $errors['password2'] ?? '' ?></small>
            </div>

            <div>
                <label for="agree">
                    <input type="checkbox" name="agree" id="agree" value="checked" <?= $inputs['agree'] ?? '' ?> /> Eu aceito os
                    <a href="#" title="termo de uso">termos de uso</a>
                </label>
            </div>

            <div class="erro-sub">
                <small><?= $errors['agree'] ?? '' ?></small>
            </div>

            <button type="submit">Registrar</button>
            <footer>Já é um usuário? <a href="login.php">Clique aqui</a></footer>
        </div>
    </form>
</div>


<?php view('footer') ?>