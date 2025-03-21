<?php
    session_start();
    include("./Models/connection.php");
    include("./Controllers/functions.php");

    /* Valida a conexão com o Banco de Dados e as credenciais do usuário */
    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Portal de Alunos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-titulo">
        <a class="item-titulo" id="home-logout" href="logout.php">Logout</a>
        <h1 class="item-titulo"> | Essa é a Página Principal</h1> 
    </div>

    <hr>

    <div class="container-alunos">
        <p>Olá, Usuário do RA <?php echo $user_data["user_ra"] ?>.</p>
        <nav>
            <ul>
                <li><a class="item-alunos" href="./Views/viewCadastroAlunos.php">Cadastro de Alunos</a></li>
                <li><a class="item-alunos" href="./Views/listaAlunos.php">Lista de Alunos</a></li>
            </ul>
        </nav>
    </div>

</body>
</html>