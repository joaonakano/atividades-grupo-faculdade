<?php

require __DIR__ . '/../src/bootstrap.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    //prepare evita SQL injection, passando placeholders e depois substituindo para o valor real
    $sql = db()->prepare("DELETE FROM games WHERE id = :id");
    $sql->bindValue(':id', $id, PDO::PARAM_INT);
    $sql->execute();

    // Redireciona de volta para o catálogo
    header('Location: catalog.php');
    exit;
}