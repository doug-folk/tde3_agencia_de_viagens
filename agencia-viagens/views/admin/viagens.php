<?php include __DIR__ . '../../partials/header.php'; ?>

<h2>Gerenciar Viagens</h2>

<?php include __DIR__ . '../../partials/flash.php'; ?>

<a href="/admin/viagens/criar" class="btn btn-primary">Nova Viagem</a>

<table>
    <thead>
        <tr>
            <th>Destino</th>
            <th>Embarque</th>
            <th>Horário</th>
            <th>Poltronas</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($viagens as $viagem): ?>
        <tr>
            <td><?= htmlspecialchars($viagem->getDestino()) ?></td>
            <td><?= htmlspecialchars($viagem->getEmbarque()) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($viagem->getHorario())) ?></td>
            <td><?= $viagem->getPoltronasDisponiveis() ?> / <?= $viagem->getPoltronas() ?></td>
            <td>
                <a href="/admin/viagens/editar?id=<?= $viagem->getId() ?>" class="btn">Editar</a>
                <a href="/admin/viagens/excluir?id=<?= $viagem->getId() ?>" 
                   class="btn" 
                   onclick="return confirm('Tem certeza?')">Excluir</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ .'../../partials/footer.php'; ?>