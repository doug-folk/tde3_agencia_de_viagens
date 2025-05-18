<?php include __DIR__ . '/../partials/header.php'; ?>

<div class="auth-container">
    <h1>Criar Conta</h1>

    <?php include __DIR__ . '/../partials/flash.php'; ?>

    <form method="POST" action="/auth/register">
        <div class="form-group">
            <label for="nome">Nome Completo:</label>
            <input type="text" id="nome" name="nome" required 
                   value="<?= htmlspecialchars($_SESSION['form_data']['nome'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required
                   value="<?= htmlspecialchars($_SESSION['form_data']['email'] ?? '') ?>">
        </div>

        <div class="form-group">
            <label for="senha">Senha (mínimo 8 caracteres):</label>
            <input type="password" id="senha" name="senha" required minlength="8">
        </div>

        <div class="form-group">
            <label for="confirmar_senha">Confirmar Senha:</label>
            <input type="password" id="confirmar_senha" name="confirmar_senha" required minlength="8">
        </div>

        <button type="submit" class="btn btn-primary">Registrar</button>
    </form>

    <div class="auth-links">
        Já tem conta? <a href="/auth/login">Faça login</a>
    </div>
</div>

<?php 
unset($_SESSION['form_data']); // Limpa os dados do form após uso
include __DIR__ . '/../partials/footer.php'; 
?>