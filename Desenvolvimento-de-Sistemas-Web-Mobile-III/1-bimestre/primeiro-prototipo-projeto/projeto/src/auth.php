<?php

function register_user(string $email, string $username, string $password): bool {
    // Criando a Query
    $sql = 'INSERT INTO users(username, email, password)
            VALUES(:username, :email, :password)';
    
    // Variável que armazenará as modificações da Query antes da execução
    $statement = db()->prepare($sql);

    // Formatando a Query com os argumentos da função
    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->bindValue(':email', $email, PDO::PARAM_STR);
    $statement->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);

    // Executando a Query
    return $statement->execute();
}
