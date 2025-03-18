<?php
    session_start();

    class Produto {
        private $nome;
        private $preco;
        private $quantidade;

        public function __construct($nome, $preco, $quantidade) {
            $this->nome = $nome;
            $this->preco = $preco;
            $this->quantidade = $quantidade;
        }

        public function setNome($novoNome) {
            $this->nome = $novoNome;
        }

        public function setPreco($novoPreco) {
            $this->preco = $novoPreco;
        }

        public function setQuantidade($novaQtd) {
            $this->quantidade = $novaQtd;
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

        public function aplicarDesconto($percentual) {
            $novoPreco = $this->getPreco() * (100 - $percentual);
            $this->setPreco($novoPreco);
        }
    }

    class Estoque {
        private $estoque;
        private $valorEstoque;

        public function __construct() {
            $this->estoque = [];
            $this->valorEstoque = 0;
        }

        public function setEstoque($dadosProduto) {
            $nomeProduto = $dadosProduto["nome"];
            $precoProduto = $dadosProduto["preco"];
            $qtdProduto = $dadosProduto["quantidade"];

            if (isset($this->estoque[$nomeProduto])) {
                $this->estoque[$nomeProduto]->setQuantidade(
                    $this->estoque[$nomeProduto]->getQuantidade() + $qtdProduto
                );
            } else {
                $produto = new Produto($nomeProduto, $precoProduto, $qtdProduto);
                $this->estoque[$nomeProduto] = $produto;
            }
        }

        public function getEstoque() {
            foreach ($this->estoque as $produto) {
                echo "<p>Nome Produto: " . $produto->getNome() . "<br>Quantidade: " . $produto->getQuantidade() . "<br>Preço: R$" . $produto->getPreco() . "</p>";
            }
        }

        public function setValorEstoque($novoValor) {
            $this->valorEstoque = $novoValor;
        }

        private function calcularEstoque() {
            $valorEstoque = 0;
            foreach ($this->estoque as $produto) {
                $valorEstoque += $produto->getPreco() * $produto->getQuantidade();
            }
            $this->setValorEstoque($valorEstoque);
        }

        public function getValorEstoque() {
            $this->calcularEstoque();
            return $this->valorEstoque;
        }

        public function clearEstoque() {
            $this->estoque = [];
            $this->valorEstoque = 0;
        }
    }

    if (!isset($_SESSION["estoque"])) {
        $estoque = new Estoque();
    } else {
        $estoque = $_SESSION["estoque"];
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["apagarEstoque"])) {
            unset($_SESSION["estoque"]);
            header("Location: index.php");
            exit;
        }

        $nome = filter_var($_POST["nomeProduto"], FILTER_SANITIZE_STRING);
        $qtd = filter_var($_POST["qtdProduto"], FILTER_SANITIZE_NUMBER_INT);
        $preco = filter_var($_POST["precoProduto"], FILTER_SANITIZE_NUMBER_FLOAT);

        $nome = trim($nome);
        $qtd = trim($qtd);
        $preco = trim($preco);

        $dadosProduto = [
            "nome" => $nome,
            "preco" => $preco,
            "quantidade" => $qtd
        ];

        $estoque->setEstoque($dadosProduto);
        $_SESSION["estoque"] = $estoque;
        
        $estoque->getEstoque();
        echo "<b>Valor total do estoque:</b> R$" . $estoque->getValorEstoque();
    }
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mao na Massa - 4</title>
</head>
<body>
    <hr>
    <h1>Adicionar Produtos:</h1>
    <form method="POST">
        <p>Insira o Nome do Produto:<br>
        <input type="text" name="nomeProduto" maxlength="50" required>
        </p>
        
        <p>Insira a Quantidade do Produto:<br>
            <input type="number" name="qtdProduto" min="0" required>
        </p>

        <p>Insira o Preço do Produto:<br>
            <input type="number" name="precoProduto" min="0" step="0.5" required>    
        </p>

        <input type="submit" value="Enviar">
        <input type="reset" value="Limpar">
        <input type="submit" value="Apagar Estoque" name="apagarEstoque">
    </form>
</body>
</html>