<?php

$inputs = [];
$errors = [];

if (is_post_request()) {
    [$inputs, $errors] = filter($_POST, [
        'id' => 'number | required',
        'title' => 'string | required | unique: games, title, id, ' . ($_POST['id'] ?? ''),
        'price' => 'float | min: 0 | number | required',
        'publisher' => 'string | required',
        'genre' => 'string | required',
        'description' => 'string | required'
    ]);

    $inputs['image'] = $_FILES['image'];

    if ($inputs['image']['type'] != '' || $inputs['image']['type'] != null) {
        // Se o tipo de imagem for diferente de JPG, JPEG ou PNG, retornar um erro
        if (!is_valid_image_type($inputs['image']['type'])) {
            $errors['image'] = "Não é um tipo válido";
        }
    } else {
        $inputs['image']['name'] = null;
    }

    if ($errors) {
        redirect_with('product_edit.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

    // Se não houverem erros de imagem, armazenar a imagem no servidor local, na pasta public/uploads
    if (!$errors['image']) {
        archive_image_to_folder($inputs['image'], 'uploads/');
    }

    if (update_product($inputs['id'], $inputs['title'], $inputs['price'], $inputs['publisher'], $inputs['genre'], $inputs['description'], $inputs['image']['name'])) {
        redirect_with_message(
            'index.php',
            'Produto atualizado com sucesso!'
        );
    }

} elseif(is_get_request()) {
    [$inputs, $errors] = session_flash('inputs', 'errors');
    if (empty($inputs)) {

        if (empty($_GET)) {
            redirect_to('catalog.php');
        }

        $product = get_product_by_id($_GET['id']);

        if ($product == null) {
            redirect_to('catalog.php');
        }

        $inputs = [
            'old_title' => $product['title'],
            'title' => $product['title'],
            'price' => $product['price'],
            'publisher' => $product['publisher'],
            'genre' => $product['genre'],
            'description' => $product['description']
        ];
    }
}