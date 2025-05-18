<?php include __DIR__ .'/../partials/header.php'; ?>

<h1>Login</h1>

<?php include __DIR__ . '/../partials/flash.php'; ?>

<form method="POST">
    <div class="form-group">
        <label>Email:</label>
        <input type="email" name="email" required>
    </div>
    
    <div class="form-group">
        <label>Senha:</label>
        <input type="password" name="senha" required>
    </div>
    
    <button type="submit" class="btn btn-primary">Entrar</button>
</form>

<p>Não tem conta? <a href="/auth/register">Registre-se</a></p>

<?php include __DIR__ . '/../partials/footer.php'; ?>