<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/header.css">
    <title><?= $title ?? "Home" ?></title>
</head>
<header>
<nav>
    <ul>
        <li><a href="logout.php">Sair</a></li>
        <li><a href="catalog.php">Catálogo</a></li>
        <li><a href="product_register.php">Adicionar</a></li>
    </ul>
</nav>

</header>
<body>
<main>
<?php flash() ?>