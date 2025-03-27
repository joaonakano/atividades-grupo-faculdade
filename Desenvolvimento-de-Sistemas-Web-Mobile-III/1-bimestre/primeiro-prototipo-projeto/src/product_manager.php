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

function get_product_by_id($id) {
    $sql = 'SELECT * from games
            WHERE id=:id';

    $statement = db()->prepare($sql);    

    $statement->bindValue(':id', $id, PDO::PARAM_STR);
    $statement->execute();

    $result = $statement->fetch(PDO::FETCH_ASSOC);
    return $result;
}

function update_product(string $old_title, string $title, $price, string $publisher, string $genre, string $description, $image = ''): bool {
    $sql = 'UPDATE games
            SET title=:title, price=:price, publisher=:publisher, genre=:genre, description=:description, filename=:filename
            WHERE title=:old_title';

    $statement = db()->prepare($sql);

    $statement->bindValue(':title', $title, PDO::PARAM_STR);
    $statement->bindValue(':price', $price, PDO::PARAM_STR);
    $statement->bindValue(':publisher', $publisher, PDO::PARAM_STR);
    $statement->bindValue(':genre', $genre, PDO::PARAM_STR);
    $statement->bindValue(':description', $description, PDO::PARAM_STR);
    $statement->bindValue(':filename', $image, PDO::PARAM_STR);
    $statement->bindValue(':old_title', $old_title, PDO::PARAM_STR);
    
    return $statement->execute();
}

function fetch_all_products() {
    $sql = "SELECT * FROM games";
    $statement = db()->prepare($sql);
    $statement->execute();
    $produtos = $statement->fetchAll(PDO::FETCH_ASSOC);
    return $produtos;
}