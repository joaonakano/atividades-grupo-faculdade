<?php
    include "../Models/cadastroAlunos.php";
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Alunos - Portal de Alunos</title>
    <link rel="stylesheet" href="teste.css">
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <h1>Página de Cadastro</h1>
    <div>
        <nav>
            <ul>
                <li><a href="./listaAlunos.php">Listagem de Alunos</a></li>
                <li><a href="../index.php">Home</a></li>
            </ul>
        </nav>
    </div>
    <div class="container-universal">
        <div class="container-universal-dentro">
            <form method="POST">
                <label>Insira o RA do Aluno:</label><br>
                <div class="input-message">
                <input type="text" name="ra-aluno" value="<?php echo $postback["ra-aluno"]; ?>" required>
                <span style="color: red"><?php echo $messages["ra-aluno"]; ?></span><br>
                </div>

                <label>Insira o Nome do Aluno:</label><br>
                <div class="input-message">
                    <input type="text" name="nome-aluno" value="<?php echo $postback["nome-aluno"]; ?>" required>
                    <span style="color: red"><?php echo $messages["nome-aluno"]; ?></span><br>
                </div>

                <label>Insira o Curso do Aluno:</label><br>
                <div class="input-message">
                    <select name="curso-aluno">
                        <option value=""></option>
                        <option value="engsoft" <?php echo $postback["curso-aluno"] === "engsoft" ? "selected" : ""; ?>>Engenharia de Software</option>
                        <option value="med" <?php echo $postback["curso-aluno"] === "med" ? "selected" : ""; ?>>Medicina</option>
                        <option value="psico" <?php echo $postback["curso-aluno"] === "psico" ? "selected" : ""; ?>>Psicologia</option>
                        <option value="engmec" <?php echo $postback["curso-aluno"] === "engmec" ? "selected" : ""; ?>>Engenharia Mecânica</option>
                    </select>
                    <span style="color: red"><?php echo $messages["curso-aluno"]; ?></span>
                </div>
                <br>
                <input type="submit" name="submit" value="Enviar">
                <br>
            </form>
        </div>
    </div>
</body>
</html>