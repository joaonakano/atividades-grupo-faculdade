<?php

$inputs = [];
$errors = [];

if (is_post_request()) {
    [$inputs, $errors] = filter($_POST, [
        'title' => 'string | required | unique: games, title',
        'price' => 'float | min: 0 | number | required',
        'publisher' => 'string | required',
        'genre' => 'string | required',
        'description' => 'string | required'
    ]);

    $inputs['image'] = $_FILES['image'];

    if ($inputs['image']['type'] != '' || $inputs['image']['type'] != null) {
        /* Estrutura da $FILES
        $_FILES['image'] = [
            name => image.jpg,
            full_path => image.jpg,
            type => image/jpg,
            tmp_name => C:\xampp\php11B6.tmp,
            error => 0,
            size => 183232]
        */

        // Se o tipo de imagem for diferente de JPG, JPEG ou PNG, retornar um erro
        if (!is_valid_image_type($inputs['image']['type'])) {
            $errors['image'] = "Não é um tipo válido";
        }
        
        // Se não houverem erros de imagem, armazenar a imagem no servidor local, na pasta public/uploads
        if (!$errors['image']) {
            archive_image_to_folder($inputs['image'], 'uploads/');
        }
    } else {
        $inputs['image']['name'] = 'notavailable.png';
    }
 
    if ($errors) {
        redirect_with('product_register.php', [
            'inputs' => $inputs,
            'errors' => $errors
        ]);
    }

    if (create_product($inputs['title'], $inputs['price'], $inputs['publisher'], $inputs['genre'], $inputs['description'], $inputs['image']['name'])) {
        redirect_with_message(
            'index.php',
            'Produto cadastrado com sucesso!'
        );
    }
    
} else if (is_get_request()) {
    [$inputs, $errors] = session_flash('inputs', 'errors');
}