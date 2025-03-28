<?php

function view(string $filename, array $data = []) {
    // Cria uma variável para ser usada em outras PHP com uma chave e valor informados no parâmetro DATA
    foreach ($data as $key => $value) {
        $$key = $value;
    }

    // Comando para fixar o conteúdo de uma página PHP específica através do nome informado no parâmetro
    require_once __DIR__ . '/../inc/' . $filename . '.php';
}

function is_post_request(): bool {
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'POST';
}

function is_get_request() {
    return strtoupper($_SERVER['REQUEST_METHOD']) === 'GET';
}

function error_class(array $errors, string $field): string {
    return isset($errors[$field]) ? 'error' : '';
}


function redirect_to(string $url): void {
    header('Location: ' . $url);
    exit;
}

function redirect_with(string $url, array $items): void {
    foreach ($items as $key => $value) {
        $_SESSION[$key] = $value;
    }

    redirect_to($url);
}

function redirect_with_message(string $url, string $message, string $type = FLASH_SUCCESS) {
    flash('flash_' . uniqid(), $message, $type);
    redirect_to($url);
}

function session_flash(...$keys): array {
    $data = [];
    foreach ($keys as $key) {
        if (isset($_SESSION[$key])) {
            $data[] = $_SESSION[$key];
            unset($_SESSION[$key]);
        } else {
            $data[] = [];
        }
    }
    return $data;
}

function archive_image_to_folder(array $data, string $target_directory) {
    $target_file = $target_directory . basename($data['name']);
    move_uploaded_file($data['tmp_name'], $target_file);
}