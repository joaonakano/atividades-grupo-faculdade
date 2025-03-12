<?php
include "./produto.php";

class Estoque {
    public $listaProdutos = [];

    public function adicionarProduto($dadosProduto) {
        $nomeProduto = $dadosProduto["nome"];
        $precoProduto = $dadosProduto["preco"];
        $quantidadeProduto = $dadosProduto["quantidade"];

        $produto = new Produto($nomeProduto, $precoProduto, $quantidadeProduto);
        $this->listaProdutos[$nomeProduto] = $produto;
    }

    public function listarProdutos() {
        foreach ($this->listaProdutos as $produto) {
            echo "<p>", $produto->getNome(), " ", $produto->getPreco(), " ", $produto->getQuantidade(), "</p>";
        }
    }
}