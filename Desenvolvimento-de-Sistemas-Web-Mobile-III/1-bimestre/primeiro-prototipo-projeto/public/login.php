<?php
require __DIR__ . "/../src/bootstrap.php";
require __DIR__ . "/../src/login.php";

if (is_user_logged_in()) {
    // Se o usuario estiver conectado, leva-lo à página Home
    redirect_to("index.php");
}

?>

<?php view("header", ['title' => 'Login']) ?>

<?php if (isset($errors['login'])) : ?>
    <div class="alert alert-error">
        <?= $errors['login'] ?>
    </div>
<?php endif ?>

<form action="login.php" method="post">
    <h1>Login</h1>
    
    <div>
        <label for="username">Insira um Nome de Usuário:</label>
        <input type="text" name="username" id="username" value="<?= $inputs['username'] ?? '' ?>">
        <small><?= $errors['login'] ?? '' ?></small>
    </div>
    
    <div>
        <label for="password">Insira uma Senha:</label>
        <input type="password" name="password" id="password">
        <small><?= $errors['password'] ?? '' ?></small>
    </div>
    
    <section>
        <button type="submit">Login</button>    
        <a href="register.php">Registre-se</a>
    </section>
</form>

<?php view('footer') ?>
