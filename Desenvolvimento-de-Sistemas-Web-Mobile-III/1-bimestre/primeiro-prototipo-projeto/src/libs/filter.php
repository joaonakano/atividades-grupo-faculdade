<?php

function filter(array $data, array $fields, array $messages=[]): array {
    // Arrays que armazenam as regras de Filtragem e Validação dos inputs
    $sanitization_rules = [];
    $validation_rules = [];

    // Para cada input, verifica a seguinte estrutura: ["name" => "string | required | max: 255"]
    // e reparte a primeira string como uma regra de filtro
    // e as ultimas strings como regras de validação
    // Exemplo:
    // $sanitization_rules = ['name' => 'string']
    // $validation_rules = ['name' => 'required | max: 255']
    foreach ($fields as $field => $rules) {
        if (strpos($rules, '|')) {
            [$sanitization_rules[$field], $validation_rules[$field]] = explode('|', $rules, 2);
        } else {
            $sanitization_rules[$field] = $rules;
        }
    }

    $inputs = sanitize($data, $sanitization_rules);
    $errors = validate($inputs, $validation_rules, $messages);

    return [$inputs, $errors];
}