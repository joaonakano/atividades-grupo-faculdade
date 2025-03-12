<?php

$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "login_db";

/* Tentativa de conexão com o Banco de Dados */
if (!$con = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname)) {
    die("Ocorreu um erro ao conectar ao Banco de Dados!");
}