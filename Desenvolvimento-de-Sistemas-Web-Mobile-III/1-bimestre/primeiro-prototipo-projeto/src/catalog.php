<?php

$pdo = db();
$sql = "SELECT * FROM games";
$statement = $pdo->query($sql);
$produtos = $statement->fetchAll(PDO::FETCH_ASSOC);

if (!function_exists('getProdutos')) {
    function getProdutos() {
        global $produtos;
        
        if (empty($produtos)) {
            return '<p>Nenhum produto cadastrado</p>';
        }
        
        $output = '';
        foreach ($produtos as $produto) {
            $output .= sprintf(
                '<div class="catalog-item">
                    <div class="product-image">
                        <img src="%s" alt="%s">
                    </div>
                    <div class="product-info">
                        <h2>%s</h2>
                        <p class="price">Preço: R$ %s</p>
                        <p class="genre">Gênero: %s</p>
                        <p class="publisher">Editora: %s</p>
                        <p class="description">%s</p>
                    </div>
                </div>',
                // Image path (assuming images are in /uploads/)
                !empty($produto['filename']) ? 'uploads/' . htmlspecialchars($produto['filename']) : 'images/default-game.jpg',
                // Alt text for image
                htmlspecialchars($produto['title']),
                // Product details
                htmlspecialchars($produto['title']),
                htmlspecialchars($produto['price']),
                htmlspecialchars($produto['genre']),
                htmlspecialchars($produto['publisher']),
                htmlspecialchars($produto['description'])
            );
        }
        return $output;
    }
}