<?php include __DIR__ . '../../partials/header.php'; ?>

<h1><?= isset($viagem) && $viagem->getId() ? 'Editar' : 'Criar' ?> Viagem</h1>

<?php include __DIR__ . '../../partials/flash.php'; ?>

<form method="POST" action="<?= (isset($viagem) && $viagem->getId()) ? "/admin/viagens/editar?id={$viagem->getId()}" : "/admin/viagens/criar" ?>">
    <div class="form-group">
        <label for="destino">Destino:</label>
        <input type="text" id="destino" name="destino" 
               value="<?= htmlspecialchars($viagem->getDestino() ?? $formData['destino'] ?? '') ?>" 
               required>
    </div>

    <div class="form-group">
        <label for="embarque">Local de Embarque:</label>
        <input type="text" id="embarque" name="embarque"
               value="<?= htmlspecialchars($viagem->getEmbarque() ?? $formData['embarque'] ?? '') ?>" 
               required>
    </div>

    <div class="form-group">
        <label for="horario">Horário:</label>
        <input type="datetime-local" id="horario" name="horario"
               value="<?= isset($viagem) ? date('Y-m-d\TH:i', strtotime($viagem->getHorario())) : ($formData['horario'] ?? '') ?>" 
               required>
    </div>

    <div class="form-group">
        <label for="poltronas">Número de Poltronas:</label>
        <input type="number" id="poltronas" name="poltronas"
               value="<?= $viagem->getPoltronas() ?? $formData['poltronas'] ?? '' ?>" 
               min="1" max="1000" required>
    </div>

    <div class="form-group">
    <label for="preco">Preço (R$):</label>
    <input type="number" step="0.01" min="0" id="preco" name="preco"
           value="<?= htmlspecialchars($viagem->getPreco() ?? $formData['preco'] ?? '') ?>"
           required>
    </div>


    <button type="submit" class="btn btn-primary">Salvar</button>
    <a href="/admin/viagens" class="btn">Cancelar</a>
</form>

<?php include __DIR__ .  '../../partials/footer.php'; ?>