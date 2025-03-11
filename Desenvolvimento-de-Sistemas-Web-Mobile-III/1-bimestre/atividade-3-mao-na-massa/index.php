<?php
    session_start();
    include("./Models/connection.php");
    include("./Controllers/functions.php");
    $user_data = check_login($con);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Portal de Alunos</title>
</head>
<body>
    <a href="logout.php">Logout</a>
    <h1>Essa é a Página Principal</h1>
    <p>Olá, usuário do RA <?php echo $user_data["user_ra"] ?>.</p>
    <nav>
        <ul>
            <li><a href="./Views/viewCadastroAlunos.php">Cadastro de Alunos</a></li>
            <li><a href="./Views/listaAlunos.php">Lista de Alunos</a></li>
        </ul>
    </nav>
</body>
</html>