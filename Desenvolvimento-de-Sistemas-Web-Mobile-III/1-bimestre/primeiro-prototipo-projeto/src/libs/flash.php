<?php

const FLASH = "FLASH_MESSAGES";

const FLASH_ERROR = "error";
const FLASH_WARNING = "warning";
const FLASH_INFO = "info";
const FLASH_SUCCESS = "success";

function create_flash_message(string $name, string $message, string $type): void {
    // Remove a mensagem existente
    if (isset($_SESSION[FLASH][$name])) {
        unset($_SESSION[FLASH][$name]);
    }

    // Adiciona a mensagem ao session
    $_SESSION[FLASH][$name] = ['message' => $message, 'type' => $type];
}

function format_flash_message(array $flash_message): string {
    return sprintf('<div class="alert alert-%s">%s</div>',
        $flash_message['type'],
        $flash_message['message']
    );
}

function display_flash_message(string $name): void {
    if (!isset($_SESSION[FLASH][$name])) {
        return;
    }

    // Armazenando a mensagem rápida em uma váriavel
    $flash_message = $_SESSION[FLASH][$name];

    // Removendo qualquer informação dessa mensagem do session
    unset($_SESSION[FLASH][$name]);

    // Exibindo a mensagem rápida na página
    echo format_flash_message($flash_message);
}

function display_all_flash_messages(): void {
    if (!isset($_SESSION[FLASH])) {
        return;
    }

    // Armazenando todas as mensagens disponíveis em uma variável
    $flash_messages = $_SESSION[FLASH];

    // Removendo as informações do session
    unset($_SESSION[FLASH]);

    // Exibindo todas as mensagens rápidas na página
    foreach ($flash_messages as $flash_message) {
        echo format_flash_message($flash_message);
    }
}

// Centralizando as funções em um método flash
function flash($name = '', $message = '', $type = ''): void {
    // Cria uma mensagem
    if ($name !== '' && $message !== '' && $type !== '') {
        create_flash_message($name, $message, $type);
    // Mostra uma mensagem existente
    } else if ($name !== '' && $message === '' && $type === '') {
        display_flash_message($name);
    // Mostra todas as mensagens
    } else if ($name === '' && $message === '' && $type === '') {
        display_all_flash_messages();
    }
}