<?php

function set_produto($title, $price): bool {
    $sql = 'INSERT INTO games(title, price)
            VALUES (:title, :price)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':title', $title, PDO::PARAM_STR);
    $statement->bindValue(':price', $price, PDO::PARAM_STR);

    return $statement->execute();
}