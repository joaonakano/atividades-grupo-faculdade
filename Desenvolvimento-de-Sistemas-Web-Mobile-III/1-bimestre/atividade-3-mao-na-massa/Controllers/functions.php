<?php

/* Valida se o usuário está Logado/Em Sessão e pega as informações do Banco de Dados para login automático */
function check_login($con) {
    if (isset($_SESSION["user_id"])) {
        $id = $_SESSION["user_id"];
        $query = "select * from users where user_id = '$id' limit 1";
        $result = mysqli_query($con, $query);     
        if ($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data; 
        }
    }

    // redireciona para a pagina de login se nao encontrar uma sessão
    header("Location: ./login.php");
    die;
}

/* Gerador de números aleatórios, utilizado para a criação dos IDs dos usuários a serem inseridos no Banco de Dados */
function numero_aleatorio($tamanho) {
    $text = "";
    if ($tamanho < 5) {
        $tamanho = 5;
    }

    $len = rand(4, $tamanho);
    for ($i = 0; $i < $len; $i++) {
        $text .= rand(0, 9);
    }

    return $text;
}