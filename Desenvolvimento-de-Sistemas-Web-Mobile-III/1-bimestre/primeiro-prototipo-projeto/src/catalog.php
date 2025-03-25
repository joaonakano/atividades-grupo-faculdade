<?php

$inputs = [];
$errors = [];

if (is_post_request()) {
    [$inputs, $errors] = filter($_POST, [
        'title' => 'string | required | unique: games, title',
        'price' => 'float | min: 0 | number | required'
    ]);

    if ($errors) {
        redirect_with('catalog.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

    if (set_produto($inputs['title'], $inputs['price'])) {
        redirect_with_message(
            'index.php',
            'Produto cadastrado com sucesso!'
        );
    }
    
} else if (is_get_request()) {
    [$inputs, $errors] = session_flash('inputs', 'errors');
}