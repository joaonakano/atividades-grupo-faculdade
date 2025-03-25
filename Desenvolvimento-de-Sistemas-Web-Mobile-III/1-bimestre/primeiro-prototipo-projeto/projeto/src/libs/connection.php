<?php

// Conectando ao Banco de Dados pelo PDO
function db(): PDO {
    // Variável estática para armazenar o banco de dados apenas uma vez e permanecer com ele, senão, faz uma nova conexão
    static $pdo;

    if (!$pdo) {
        $pdo = new PDO(
            sprintf("mysql:host=%s;dbname=%s;charset=UTF8", DB_HOST, DB_NAME),
            DB_USER,
            DB_PASSWORD,
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
        );
    }

    return $pdo;
}