<?php
namespace Daos;

use Config\Database;
use Models\Reserva;
use PDO;

class ReservaDAO {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function criar(Reserva $reserva) {
        $stmt = $this->conn->prepare(
            "INSERT INTO reservas 
            (id_viagem, id_cliente, poltronas_reservadas) 
            VALUES (:id_viagem, :id_cliente, :poltronas_reservadas)"
        );
        
        return $stmt->execute([
            ':id_viagem' => $reserva->getIdViagem(),
            ':id_cliente' => $reserva->getIdCliente(),
            ':poltronas_reservadas' => $reserva->getPoltronasReservadas()
        ]);
    }

    public function listarPorCliente($idCliente) {
        $stmt = $this->conn->prepare(
            "SELECT r.*, v.destino, v.embarque, v.horario 
             FROM reservas r
             JOIN viagens v ON r.id_viagem = v.id
             WHERE r.id_cliente = :id_cliente
             ORDER BY r.data_reserva DESC"
        );
        $stmt->bindParam(':id_cliente', $idCliente, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function buscarPorViagem($idViagem) {
        $stmt = $this->conn->prepare("SELECT * FROM reservas WHERE id_viagem = :id_viagem");
        $stmt->bindValue(':id_viagem', $idViagem, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
}