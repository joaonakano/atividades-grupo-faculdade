<?php

class Produto {
    private $nome;
    private $preco;
    private $quantidade;

    public function __construct($nome, $preco, $quantidade) {
        $this->nome = $nome;
        $this->preco = $preco;
        $this->quantidade = $quantidade;
    }

    public function aplicarDesconto($percentual) {
        $novoPreco = $this->preco * (100 - $percentual);
        $this->setPreco($novoPreco);
    }
    
    private function setQuantidade($quantidade) {
        $this->quantidade = $quantidade;
    }

    private function setPreco($preco) {
        $this->preco = $preco;
    }

    public function getNome() {
        return $this->nome;
    }

    public function getPreco() {
        return $this->preco;
    }

    public function getQuantidade() {
        return $this->quantidade;
    }
}
