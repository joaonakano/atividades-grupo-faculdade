<?php
const FILTERS = [
    'string' => FILTER_SANITIZE_STRING,
    'string[]' => [
        'filter' => FILTER_SANITIZE_STRING,
        'flags' => FILTER_REQUIRE_ARRAY
    ],
    'email' => FILTER_SANITIZE_EMAIL,
    'int' => [
        'filter' => FILTER_SANITIZE_NUMBER_INT,
        'flags' => FILTER_REQUIRE_SCALAR
    ],
    'int[]' => [
        'filter' => FILTER_SANITIZE_NUMBER_INT,
        'flags' => FILTER_REQUIRE_ARRAY
    ],
    'float' => [
        'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
        'flags' => FILTER_FLAG_ALLOW_FRACTION
    ],
    'float[]' => [
        'filter' => FILTER_SANITIZE_NUMBER_FLOAT,
        'flags' => FILTER_REQUIRE_ARRAY
    ],
    'url' => FILTER_SANITIZE_URL,
];

// Função que remove espaços somente de strings
function array_trim(array $items) {
    return array_map(function($item) {
        if(is_string($item)) {
            return trim($item);
        } elseif (is_array($item)) {
            return array_trim($item);
        } else {
            return $item;
        }
    }, $items);
}

// Função capaz de remover os caracteres indesejados dos inputs com base em regras específicas
function sanitize(array $inputs, array $fields = [], int $default_filter = FILTER_SANITIZE_STRING, array $filters = FILTERS, bool $trim = true): array {
    # Se for definida uma lista de filtros para cada input da lista de inputs, devemos tratar em um array_map
    if ($fields) {
        $options = array_map(fn($field) => $filters[$field], $fields);
        $data = filter_var_array($inputs, $options);
    # Senão, apenas um filtro será utilizado em toda a lista de inputs
    } else {
        $data = filter_var_array($inputs, $default_filter);
    }

    # Se caso o parâmetro trim for true, ele remove os espaços das strings da lista de inputs, senão, retorna com os espaços
    return $trim ? array_trim($data) : $data;
}