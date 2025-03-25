
<?php
require __DIR__ . "/../src/bootstrap.php";
require_login();
?>

<?php view('header', ['title' => 'Dashboard']) ?>

<p>Bem-vindo, ao nosso Catalogo de Jogos <br><?= current_user() ?> <br><a href="logout.php">Logout</a></p>

<main>
    <h1>Catálogo de Jogos</h1>

    <div class="game-list">
        <div class="game-item">
            <img src="../images/crash_jogo_ps1.jpg" alt="Crash Bandicoot">
            <h2>Crash Bandicoot</h2>
            <p>Preço: R$ 5</p>
            <button>Editar</button>
            <button>Excluir</button>
        </div>
        <!-- Adicione mais jogos aqui -->
    </div>
</main>

<?php view('footer') ?>