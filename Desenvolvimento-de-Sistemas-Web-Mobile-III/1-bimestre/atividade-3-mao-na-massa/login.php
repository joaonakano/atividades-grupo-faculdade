<?php

session_start();
include("./Controllers/functions.php");
include("./Models/connection.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ra = $_POST["ra"];
    $senha = $_POST["senha"];

    if (!empty($ra) && !empty($senha) && is_numeric($ra)) {
        $query = "select * from users where user_ra = '$ra' limit 1";
        $result = mysqli_query($con, $query);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);
                if ($user_data['senha'] === $senha) {
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: ./index.php");
                    die;
                }
            }
        }

        echo "RA ou Senha incorreta!";
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
    <title>Login - Portal de Alunos</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <form method="POST">
        <label>Insira o RA:</label><br>
        <input type="text" name="ra"><br>
        <label>Insira a Senha:</label><br>
        <input type="password" name="senha">
        <br>
        <input type="submit" value="Login">
        <br>
        <a href="cadastro.php">Cadastre-se</a>
    </form>
</body>
</html>