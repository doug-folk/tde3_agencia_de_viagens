<?php include __DIR__ . '../../partials/header.php'; ?>

<h2>Minhas Reservas</h2>

<?php include __DIR__ .'../../partials/flash.php'; ?>

<table>
    <thead>
        <tr>
            <th>Destino</th>
            <th>Embarque</th>
            <th>Horário</th>
            <th>Poltronas</th>
            <th>Data da Reserva</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($reservas as $reserva): ?>
        <tr>
            <td><?= htmlspecialchars($reserva['destino']) ?></td>
            <td><?= htmlspecialchars($reserva['embarque']) ?></td>
            <td><?= date('d/m/Y H:i', strtotime($reserva['horario'])) ?></td>
            <td><?= $reserva['poltronas_reservadas'] ?></td>
            <td><?= date('d/m/Y H:i', strtotime($reserva['data_reserva'])) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include __DIR__ . '../../partials/footer.php'; ?>