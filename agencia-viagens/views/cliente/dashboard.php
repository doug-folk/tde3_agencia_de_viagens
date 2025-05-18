<?php include __DIR__ . '../../partials/header.php'; ?>

<h2>Área do Cliente</h2>

<p>Bem-vindo, <?= htmlspecialchars($_SESSION['usuario']->getNome()) ?>!</p>

<?php include __DIR__ . '../../partials/footer.php'; ?>