<?php
    include "../Models/cadastroAlunos.php";
    $cadastroAlunos = new CadastroAlunos();
    $cadastroAlunos->getAlunosPeloSession();
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listagem - Portal de Alunos</title>
    <link rel="stylesheet" href="teste.css">
</head>
<body>
    <h1>Página de Listagem</h1>
    <div>
        <nav>
            <ul>
                <li><a href="./viewCadastroAlunos.php">Cadastro de Alunos</a></li>
                <li><a href="../index.php">Home</a></li>
            </ul>
        </nav>
    </div>
    <main>
        <?php
            $cadastroAlunos->listarAlunos();
        ?>
    </main>
</body>
</html>