<?php

$inputs = [];
$errors = [];

if (is_post_request()) {
    $fields = [
        'username' => 'string | required | alphanumeric | between: 3, 25 | unique: users, username',
        'email' => 'email | required | email | unique: users, email',
        'password' => 'string | required | secure',
        'password2' => 'string | required | same: password',
        'agree' => 'string | required',
    ];
    
    $messages = [
        'email' => [
            'email' => 'O email não é um endereço válido'
        ],
        'password' => [
            'secure' => 'A senha deve estar entre 8 e 64 caracteres e conter pelo menos 1 número, uma letra maiúscula, uma letra minúscula e um caractere especial'
        ],
        'password2' => [
            'required' => 'Por gentileza, insira a senha novamente',
            'same' => 'As senhas não são iguais'
        ],
        'agree' => [
            'required' => 'Você precisa aceitar os termos de uso para se registrar'
        ]
    ];
    
    [$inputs, $errors] = filter($_POST, $fields, $messages);

    if ($errors) {
        redirect_with('register.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

    if (register_user($inputs['email'], $inputs['username'], $inputs['password'])) {
        redirect_with_message(
            'login.php',
            'Sua conta foi criada com sucesso. Realize o login'
        );
    }

} else if (is_get_request()) {
    [$inputs, $errors] = session_flash('inputs', 'errors');
}