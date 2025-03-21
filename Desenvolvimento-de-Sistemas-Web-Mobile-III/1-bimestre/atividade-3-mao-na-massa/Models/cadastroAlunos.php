<?php
include "../Models/alunos.php";
session_start();

/* Array que armazena mensagens de erro a serem exibidas no formulário */
$messages = [
    "ra-aluno" => "*",
    "nome-aluno" => "*",
    "curso-aluno" => "*"
];

/* Array que armazena as informações já validadas e formatadas do formulário */
$postback = [
    "ra-aluno" => "",
    "nome-aluno" => "",
    "curso-aluno" => ""
];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    /* Validadores do Campo RA do Aluno */
    $raAluno = $_POST["ra-aluno"];
    $postback["ra-aluno"] = filter_var($raAluno, FILTER_SANITIZE_NUMBER_INT);
    $postback["ra-aluno"] = trim($postback["ra-aluno"]);

    /* Valida se o RA é um número correto para ser tratado adequadamente */
    if (empty($postback["ra-aluno"]) || !is_numeric($postback["ra-aluno"]) || strlen($postback["ra-aluno"]) < 10 || strlen($postback["ra-aluno"]) > 20) {
        $messages["ra-aluno"] = "Insira um número de RA válido!";
    };

    /* Validadores do Campo Nome do Aluno */
    $nomeAluno = $_POST["nome-aluno"];

    /* Filtragem e remoção de espaços em branco no fim e no começo da string */
    $postback["nome-aluno"] = filter_var($nomeAluno, FILTER_SANITIZE_STRING);
    $postback["nome-aluno"] = trim($postback["nome-aluno"]);

    /* Valida se o usuário não enviou nada no campo de Nome, se sim, adiciona uma mensagem para ser exibida de erro */
    if (empty($postback["nome-aluno"])) {
        $messages["nome-aluno"] = "Insira um nome de Aluno válido!";
    };

    /* Validadores do Campo Curso do Aluno */
    $cursoAluno = $_POST["curso-aluno"];

    /* Valida se o curso escolhido está dentro das opções corretas */
    if (in_array($cursoAluno, ["engsoft", "med", "psico", "engmec"], TRUE)) {
        $postback["curso-aluno"] = $cursoAluno;
    } else {
        $messages["curso-aluno"] = "Um curso válido é obrigatório!";
    }

    /* Armazena-se a contagem das mensagens de erro do formulário */
    $array = array_count_values($messages);
    /* Se a contagem for diferente da quantidade de campos validos, o sistema não printa as informações do aluno */
    if (array_key_exists("*", $array) && $array["*"] == 3) {
        $aluno = new CadastroAlunos();
        $aluno->cadastrarAluno($postback["nome-aluno"], $postback["curso-aluno"], $postback["ra-aluno"]);
        header("Location: ../index.php");
        exit;
    }
}


class CadastroAlunos {
    private $alunos = [];

    public function cadastrarAluno($nome, $curso, $ra) {
        /* Cria-se um aluno com a classe Aluno */
        $aluno = new Aluno($nome, $curso, $ra);

        /* Adiciona esse objeto recém criado em um array dentro do SESSION */
        $_SESSION['alunos'][$ra] = serialize($aluno);
    }

    public function listarAlunos() {
        /* Percorre a lista de alunos dessa mesma classe e exibe os dados devidos */
        foreach($this->alunos as $aluno) {
            echo "<p>", $aluno->getNome(), " ", $aluno->getRa(), " ", $aluno->getCurso(), "</p>";
        }
    }
    
    public function getAlunosPeloSession() {
        /* Se o session estiver com objetos, armazena-se cada objeto dentro de um array da mesma classe para serem utilizados em outros métodos */
        if (isset($_SESSION['alunos'])) {
            foreach ($_SESSION['alunos'] as $ra => $alunoData) {
                $this->alunos[$ra] = unserialize($alunoData);
            }
        }
    }

}