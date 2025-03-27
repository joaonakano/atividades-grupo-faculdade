<?php 

const DEFAULT_VALIDATION_ERRORS = [
    'required' => '%s é obrigatório',
    'email' => '%s não é um endereço de email válido',
    'min' => '%s deve conter pelo menos %s caracteres',
    'max' => '%s deve conter até %s caracteres',
    'between' => '%s deve estar entre %d e %d caracteres',
    'same' => '%s deve igual a %s',
    'alphanumeric' => '%s deve conter apenas letras e números',
    'secure' => '%s deve estar entre 8 e 64 caracteres e conter pelo menos 1 número, uma letra maiúscula, uma letra minúscula e um caractere especial',
    'unique' => '%s já existe',
    'number' => '%s não é um número válido'
];

function validate(array $data, array $fields, array $messages = []): array {
    $split = fn($str, $separator) => array_map('trim', explode($separator, $str));
    
    // Filtra um array apenas com as mensagens para todos os campos
    $rule_messages = array_filter($messages, fn($message) => is_string($message));

    // Configurando mensagens customizadas
    $validation_errors = array_merge(DEFAULT_VALIDATION_ERRORS, $rule_messages);

    $errors = [];

    foreach ($fields as $field => $option) {
        // Pega as regras de validação (uma string) e converte em um Array usando como separador o '|'
        $rules = $split($option, '|');

        // Para cada regra da lista de regras, a devida validação é aplicada
        foreach ($rules as $rule) {
            $params = [];

            // Se a regra conter :, significa que ela tem um valor personalizado
            if (strpos($rule, ":")) {
                // Desestruturação da Lista pelo separador ':' para atribuir os valores, exemplo [$rule, $params] = ['between', '3,255']
                [$rule_name, $param_str] = $split($rule, ':');
                // Coleta-se o valor da segunda variavel através do separador ',' e armazena em um array, exemplo $params = ['3', '255']
                $params = $split($param_str, ',');
            } else {
                // Caso contrario, só remover os espaços
                $rule_name = trim($rule);
            }

            // Cria uma função variável que recebe o prefixo is_ seguida do nome da regra, exemplo is_between
            $fn = 'is_' . $rule_name;

            // Verifica se a função variável pode ser chamada pelo is_callable
            if (is_callable($fn)) {
                // Executa a função variável e armazena o retorno
                $pass = $fn($data, $field, ...$params);
                // Se não for possível executar ou houver algum erro,
                // adiciona à lista de Erros o campo que está errado e a mensagem, respectivamente.
                // Exemplo: $errors["email" => "Email não é valido"]
                if (!$pass) {
                    $errors[$field] = sprintf(
                        // Se a mensagem customizada para certo campo existe,
                        // exemplo: $messages["email"]["required" => "Email precisa ser valido"]
                        // Usa-a como mensagem de erro, caso contrario, usa o padrao
                        $messages[$field][$rule_name] ?? $validation_errors[$rule_name],
                        $field,
                        ...$params
                    );
                }
            }
        }
    }

    return $errors;
}

function is_required(array $data, string $field): bool {
    return isset($data[$field]) && trim($data[$field]) !== '';
}

function is_email(array $data, string $field): bool {
    if (empty($data[$field])) {
        return true;
    }
    
    return filter_var($data[$field], FILTER_VALIDATE_EMAIL);
}

function is_min(array $data, string $field, int $min): bool {
    if (!isset($data[$field])) {
        return true;
    }

    return mb_strlen($data[$field]) >= $min;
}

function is_max(array $data, string $field, int $max): bool {
    if (!isset($data[$field])) {
        return true;
    }

    return mb_strlen($data[$field]) <= $max;
}

function is_between(array $data, string $field, int $min, int $max): bool {
    if (!isset($data[$field])) {
        return true;
    }

    $len = mb_strlen($data[$field]);
    return $len >= $min && $len <= $max;
}

function is_alphanumeric(array $data, string $field): bool {
    if (!isset($data[$field])) {
        return true;
    }

    return ctype_alnum($data[$field]);
}

function is_same(array $data, string $field, string $other): bool {
    if (isset($data[$field], $data[$other])) {
        return $data[$field] === $data[$other];
    }

    if (!isset($data[$field]) && !isset($data[$other])) {
        return true;
    }

    return false;
}

function is_secure(array $data, string $field): bool {
    if (!isset($data[$field])) {
        return false;
    }

    $pattern = "#.*^(?=.{8,64})(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).*$#";
    return preg_match($pattern, $data[$field]);
}

function is_unique(array $data, string $field, string $table, string $column, string $excludeField = null, string $excludeValue = null): bool {
    if (!isset($data[$field])) {
        return true;
    }
        
    $sql = "SELECT $column FROM $table WHERE $column = :value";
    $params = [":value" => $data[$field]];

    if ($excludeField && $excludeValue) {
        $sql .= " AND $excludeField != :exclude";
        $params[":exclude"] = $excludeValue;
    }

    $stmt = db()->prepare($sql);
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    $stmt->execute();

    return $stmt->fetchColumn() === false;
}

function is_number(array $data, string $field): bool {
    if (!isset($data[$field])) {
        return true;
    }

    return is_numeric($data[$field]) && preg_match('/^\d+(\.\d+)?$/', $data[$field]);
}

function is_valid_image_type(string $type): bool {
    if (!isset($type)) {
        return true;
    }

    $valid_types = ['image/jpg', 'image/jpeg', 'image/png'];
    if (!in_array($type, $valid_types)) {
        return false;
    }

    return true;
}