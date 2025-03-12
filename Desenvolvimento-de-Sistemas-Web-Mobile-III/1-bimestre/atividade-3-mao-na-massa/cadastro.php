<?php
    include("./Controllers/functions.php");
    include("./Models/connection.php");

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // algo foi postado
        $ra = $_POST["ra"];
        $senha = $_POST["senha"];

        if (!empty($ra) && !empty($senha) && is_numeric($ra)) {
            $user_id = numero_aleatorio(20);
            $query = "insert into users (user_id, user_ra, senha) values ('$user_id', '$ra', '$senha')";

            mysqli_query($con, $query);
            header("Location: ./login.php");
            die;
        } else {
            echo "Insira uma informação válida!";
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro - Portal de Alunos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container-universal">
        <div class="container-universal-dentro">
            <form method="POST">
                <label>Insira o RA:</label><br>
                <input type="text" name="ra"><br>
                <label>Insira a Senha:</label><br>
                <input type="password" name="senha">
                <br>
                <input type="submit" value="Cadastrar">
                <br>
                <a href="login.php">Login</a>
            </form>
        </div>
    </div>
</body>
</html>