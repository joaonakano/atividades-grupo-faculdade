<?php
require __DIR__ . "/../src/bootstrap.php";
?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Catálogo de Jogos</title>
    <link rel="stylesheet" href="css/catalog.css">
</head>

<body>
    <header>
        <nav>
            <ul>
                <li><a href="login.php">Login</a></li>
                <img src="../images/pngtree-retro-pixel-diamond-icon-vector-png-image_15470082.png" alt="Logo">
                <li><a href="register.php">Registro</a></li>
            </ul>
        </nav>
    </header>

    <main>
        
        <div class="gif-container">
            
            <img src="../images/cool_gif7.gif" alt="Cool GIF 7">
            <h1>Catálogo de Jogos</h1>
            <img src="../images/cool_gif7.gif" alt="Cool GIF 7">
       
        </div>
        <div class="game-list">
           
            <div class="game-item">
                <img src="../images/crash_jogo_ps1.jpg" alt="Crash Bandicoot">
                <h2>Crash Bandicoot</h2>
                <p>Preço: R$ 5</p>
                <button>Editar</button>
                <button>Excluir</button>
            </div>
            
        </div>
    </main>

  
    <?php view('footer') ?>
    
</body>

</html>