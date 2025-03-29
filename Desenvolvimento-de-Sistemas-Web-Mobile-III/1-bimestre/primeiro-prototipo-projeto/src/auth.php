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

function find_user_by_username(string $username) {
    $sql = 'SELECT username, password
            FROM users
            WHERE username=:username';

    $statement = db()->prepare($sql);
    $statement->bindValue(':username', $username, PDO::PARAM_STR);
    $statement->execute();

    return $statement->fetch(PDO::FETCH_ASSOC);
}

function login(string $username, string $password): bool {
    $user = find_user_by_username($username);

    // Se o usuário existir e a senha corresponder ao HASH do banco de dados, salva a session com id e nome de usuario
    if ($user && password_verify($password, $user['password'])) {
        // Impede ataques de sessão continua
        session_regenerate_id();

        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user['id'];

        return true;
    }

    return false;
}

function logout(): void {
    // Se o usuario estiver logado, tirar as informações do session e redirecionar ao login
    if (is_user_logged_in()) {
        unset($_SESSION['username'], $_SESSION['user_id']);
        session_destroy();
        redirect_to('login.php');
    }
    redirect_to('login.php');
}

function current_user() {
    // Se o usuario estiver logado, retornar o nome dele dentro do session
    if (is_user_logged_in()) {
        return $_SESSION['username'];
    }
    return null;
}

function is_user_logged_in(): bool {
    // Verifica se existe usuario conectado no session
    return isset($_SESSION['username']);
}

function require_login(): void {
    // Se o usuario nao estiver logado em alguma pagina restrita, direcionar para a pagina de login
    if (!is_user_logged_in()) {
        redirect_to('login.php');
    }
}
