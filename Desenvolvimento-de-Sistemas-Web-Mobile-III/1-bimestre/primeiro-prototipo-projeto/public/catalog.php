<?php
require __DIR__ . "/../src/bootstrap.php";
require __DIR__ . "/../src/catalog.php";
?>

<?php view('header', ['title' => 'Catálogo - Windows 95']) ?>
<link rel="stylesheet" href="css/catalog.css">




<div class="catalog-container">
    
    <div class="window-content">
        <?= getProdutos() ?>
        
        <div class="catalog-footer">
        © 2004 Todos os direitos reservados. <?= date('Y') ?>
        </div>
    </div>
</div>



<?php view('footer') ?>