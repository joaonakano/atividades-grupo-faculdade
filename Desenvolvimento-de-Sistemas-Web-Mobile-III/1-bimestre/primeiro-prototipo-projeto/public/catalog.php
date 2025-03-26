<?php
require __DIR__ . "/../src/bootstrap.php";
require __DIR__ . "/../src/catalog.php";
?>

<?php view('header', ['title' => 'CATÁLOGO RETRO TV']) ?>
<link rel="stylesheet" href="css/catalog.css">

<nav>
    <ul>
        <li><a href="logout.php">SAIR</a></li>
        <li><a href="catalog.php">CATÁLOGO</a></li>
        <li><a href="product_register.php">ADICIONAR</a></li>
    </ul>
</nav>

<main>
    <div class="catalog-container">
        <div class="vhs-time"><?= date('H:i:s') ?></div>
        <?= getProdutos() ?>
        <div class="catalog-footer">
            CATÁLOGO RETRO © <?= date('Y') ?> - CANAL 3
        </div>
    </div>
</main>

<script>
// Atualizar relógio CRT
function updateCRTTime() {
    const now = new Date();
    document.querySelector('.vhs-time').textContent = now.toLocaleTimeString();
    
    // Efeito de flicker aleatório
    if(Math.random() > 0.95) {
        document.querySelector('.catalog-container').style.animation = 'crt-flicker 0.5s';
        setTimeout(() => {
            document.querySelector('.catalog-container').style.animation = '';
        }, 500);
    }
}
setInterval(updateCRTTime, 1000);

// Efeito de sintonização CRT
const items = document.querySelectorAll('.catalog-item');
items.forEach(item => {
    item.addEventListener('mouseenter', () => {
        if(Math.random() > 0.8) {
            item.style.animation = 'crt-flicker 0.3s';
            setTimeout(() => {
                item.style.animation = '';
            }, 300);
        }
    });
});
</script>

<?php view('footer') ?>