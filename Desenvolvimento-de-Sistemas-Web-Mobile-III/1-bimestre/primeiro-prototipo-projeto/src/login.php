<?php

$inputs = [];
$errors = [];

if (is_post_request()) {
    [$inputs, $errors] = filter($_POST, [
        'username' => 'string | required',
        'password' => 'string | required'
    ]);

    // Se não for inserido usuario ou senha, retorna à página Login com o determinado erro
    if ($errors) {
        redirect_with('login.php', ['errors' => $errors, 'inputs' => $inputs]);
    }

    // Se o login falhar
    if (!login($inputs['username'], $inputs['password'])) {
        $errors['login'] = 'Usuário e/ou Senha incorreto(s)!';

        redirect_with('login.php', [
            'errors' => $errors,
            'inputs' => $inputs
        ]);
    }

    // Se o login for bem-sucedido
    redirect_to('index.php');

} else if (is_get_request()) {
    [$errors, $inputs] = session_flash('errors', 'inputs');
}