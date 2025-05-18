<?php include __DIR__ .'../../partials/header.php'; ?>

<h2>Viagens Disponíveis</h2>

<?php include __DIR__ . '../../partials/flash.php'; ?>

<table>
    <thead>
        <tr>
            <th>Destino</th>
            <th>Embarque</th>
            <th>Horário</th>
            <th>Preço R$</th>
            <th>Poltronas Disponíveis</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($viagens as $viagem): ?>
        <tr>
            <td><?= htmlspecialchars($viagem->getDestino()) ?></td>
            <td><?= htmlspecialchars($viagem->getEmbarque()) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($viagem->getHorario())) ?></td>
            <td><?= number_format($viagem->getPreco(), 2, ',', '.') ?></td>
            <td><?= $viagem->getPoltronasDisponiveis() ?></td>
            <td>
                <?php if ($viagem->getPoltronasDisponiveis() > 0): ?>
                <form method="POST" action="/cliente/reservar" style="display: inline;">
                    <input type="hidden" name="id_viagem" value="<?= $viagem->getId() ?>">
                    <input type="number" name="poltronas" min="1" 
                           max="<?= $viagem->getPoltronasDisponiveis() ?>" 
                           value="1" style="width: 50px;">
                    <button type="submit" class="btn">Reservar</button>
                </form>
                <?php else: ?>
                Esgotado
                <?php endif; ?>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '../../partials/footer.php'; ?>