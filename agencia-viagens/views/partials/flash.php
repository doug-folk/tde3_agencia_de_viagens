<?php if (isset($_SESSION['flash'])): ?>
    <div class="flash <?= strpos($_SESSION['flash'], 'Erro') !== false ? 'error' : 'success' ?>">
        <?= htmlspecialchars($_SESSION['flash']) ?>
    </div>
    <?php unset($_SESSION['flash']); ?>
<?php endif; ?>
