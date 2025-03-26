<?php

session_start();

// PDO e MySQL
require_once __DIR__ . "/../config/database.php";
require_once __DIR__ . "/libs/connection.php";

// Bibliotecas
require_once __DIR__ . "/libs/helpers.php";

// Filtros, Utilitarios ou Validações
require_once __DIR__ . "/libs/flash.php";
require_once __DIR__ . "/libs/sanitization.php";
require_once __DIR__ . "/libs/validation.php";
require_once __DIR__ . "/libs/filter.php";

// Registro de Usuários
require_once __DIR__ . "/auth.php";

// Registro de Produtos
require_once __DIR__ . "/product_manager.php";

// Leitura de Produtos
require_once __DIR__ . "/catalog.php";