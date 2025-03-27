<?php

if (!function_exists('getProdutos')) {
    function getProdutos() {
        global $produtos;

        $produtos = fetch_all_products();
        
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
                        <div>
                            <h2>%s</h2>
                            <p class="price">Preço: R$ %s</p>
                            <p class="genre">Gênero: %s</p>
                            <p class="publisher">Editora: %s</p>
                            <p class="description">%s</p>
                        </div>
                        <div class="product-actions">
                            <button class="action-btn" title="Editar" onclick="window.location.href=\'product_edit.php?id=%d\'">✏️</button>
                            <button class="action-btn" title="Deletar" onclick="confirmarExclusao(%d)">❌</button>
                        </div>
                    </div>
                </div>',
                
                !empty($produto['filename']) ? 'uploads/' . htmlspecialchars($produto['filename']) : 'images/default-game.jpg',
                htmlspecialchars($produto['title']),
                htmlspecialchars($produto['title']),
                htmlspecialchars($produto['price']),
                htmlspecialchars($produto['genre']),
                htmlspecialchars($produto['publisher']),
                htmlspecialchars($produto['description']),
                htmlspecialchars($produto['id']), // Botao editar
                $produto['id']  // ID para o botão de deletar
            );
        }
        return $output;
    }
}

# <button class="action-btn" title="Editar" onclick="editarProduto(%d)">✏️</button>