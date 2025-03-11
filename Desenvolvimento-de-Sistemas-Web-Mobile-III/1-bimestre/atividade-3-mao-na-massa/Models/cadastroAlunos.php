<?php

class CadastroAlunos {
    private $alunos = [];

    public function cadastrarAluno($nome, $curso, $ra) {
        $aluno = new Aluno($nome, $curso, $ra);
        $this->alunos[$ra] = $aluno;
    }

    public function listarAlunos() {
        foreach ($this->alunos as $aluno) {
            echo $aluno->getNome() . "</br>";
        }
    }
}