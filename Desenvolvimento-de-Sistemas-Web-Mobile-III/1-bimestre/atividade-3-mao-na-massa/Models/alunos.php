<?php

    class Aluno {
        private $nome;
        private $curso;
        private $ra;

        public function __construct($nome, $curso, $ra) {
            $this->nome = $nome;
            $this->curso = $curso;
            $this->ra = $ra;
        }
        
        public function getNome() {
            return $this->nome;
        }

        public function getCurso() {
            return $this->curso;
        }
        
        public function getRa() {
            return $this->ra;
        }
    }
