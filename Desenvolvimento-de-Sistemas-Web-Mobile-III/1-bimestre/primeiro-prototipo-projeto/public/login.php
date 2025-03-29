<?php
require __DIR__ . "/../src/bootstrap.php";
require __DIR__ . "/../src/login.php";

if (is_user_logged_in()) {
    // Se o usuario estiver conectado, leva-lo à página Home
    redirect_to("index.php");
}

?>

<head>
    <title>Login</title>
</head>

<?php if (isset($errors['login'])) : ?>
    <div class="alert alert-error">
        <?= $errors['login'] ?>
    </div>
<?php endif ?>

<link rel="stylesheet" href="css/register_login.css">

<div class="container-principal">
    <form action="login.php" method="post">
        <div class="caixa-win">
            <h1>Login</h1>
        </div>
        <div class="container-principal-sub">

            <div class="item-principal-sub">
                <label for="username">Insira um Nome de Usuário:</label>
                <input type="text" name="username" id="username" value="<?= $inputs['username'] ?? '' ?>">
                <small><?= $errors['login'] ?? '' ?></small>
            </div>

            <div class="item-principal-sub">
                <label for="password">Insira uma Senha:</label>
                <input type="password" name="password" id="password">
                <small><?= $errors['password'] ?? '' ?></small>
            </div>

            <button type="submit">Login</button>   
            <footer><a href="register.php">Registre-se</a></footer>
        </div>

    </form>
</div>

<?php view('footer') ?>
