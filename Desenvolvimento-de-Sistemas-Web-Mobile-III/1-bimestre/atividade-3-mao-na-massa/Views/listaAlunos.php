<?php
    include "../Models/cadastroAlunos.php";

    /* Cria-se um objeto com a classe CadastroAlunos que irá intermediar o cadastro e recuperação dos dados */
    $cadastroAlunos = new CadastroAlunos();
    /* Pegam-se os alunos do session e armazenam-lhes dentro do objeto */
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
    <div class="container-alunos">
        <nav>
            <ul>
                <li><a class="item-alunos" href="./viewCadastroAlunos.php">Cadastro de Alunos</a></li>
                <li><a class="item-alunos" href="../index.php">Home</a></li>
            </ul>
        </nav>
    </div>
    <main>
        <?php
        /* Listagem dos Alunos */
            $cadastroAlunos->listarAlunos();
        ?>
    </main>
</body>
</html>