<?php

/* Desloga o usuário da sessão e redireciona para a página de Login */
session_start();
if (isset($_SESSION['user_id'])) {
    unset($_SESSION['user_id']);
}

header("Location: ./login.php");