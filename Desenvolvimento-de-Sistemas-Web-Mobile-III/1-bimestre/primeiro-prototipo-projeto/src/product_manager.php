<?php

function create_product(string $title, $price, string $publisher, string $genre, string $description, $image = ''): bool {
    $sql = 'INSERT INTO games(title, price, publisher, genre, description, filename)
            VALUES (:title, :price, :publisher, :genre, :description, :filename)';

    $statement = db()->prepare($sql);

    $statement->bindValue(':title', $title, PDO::PARAM_STR);
    $statement->bindValue(':price', $price, PDO::PARAM_STR);
    $statement->bindValue(':publisher', $publisher, PDO::PARAM_STR);
    $statement->bindValue(':genre', $genre, PDO::PARAM_STR);
    $statement->bindValue(':description', $description, PDO::PARAM_STR);
    $statement->bindValue(':filename', $image, PDO::PARAM_STR);

    return $statement->execute();
}