<?php
namespace Daos;

use Config\Database;
use Models\Viagem;
use PDO;

class ViagemDAO {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function criar(Viagem $viagem) {
        $stmt = $this->conn->prepare(
            "INSERT INTO viagens 
            (destino, embarque, horario, poltronas, poltronas_disponiveis, preco) 
            VALUES (:destino, :embarque, :horario, :poltronas, :poltronas_disponiveis, :preco)"
        );
        
        return $stmt->execute([
            ':destino' => $viagem->getDestino(),
            ':embarque' => $viagem->getEmbarque(),
            ':horario' => $viagem->getHorario(),
            ':poltronas' => $viagem->getPoltronas(),
            ':poltronas_disponiveis' => $viagem->getPoltronasDisponiveis(),
            ':preco' => $viagem->getPreco()
        ]);
    }

    public function listarTodos() {
        $stmt = $this->conn->query("SELECT * FROM viagens ORDER BY horario");
        $viagens = [];
        
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $viagem = new Viagem();
            $viagem->setId($row['id'])
                  ->setDestino($row['destino'])
                  ->setEmbarque($row['embarque'])
                  ->setHorario($row['horario'])
                  ->setPoltronas($row['poltronas'])
                  ->setPoltronasDisponiveis($row['poltronas_disponiveis'])
                  ->setPreco($row['preco']);
            $viagens[] = $viagem;
        }
        
        return $viagens;
    }

    public function buscarPorId($id) {
        $stmt = $this->conn->prepare("SELECT * FROM viagens WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $viagem = new Viagem();
            $viagem->setId($row['id'])
                  ->setDestino($row['destino'])
                  ->setEmbarque($row['embarque'])
                  ->setHorario($row['horario'])
                  ->setPoltronas($row['poltronas'])
                  ->setPoltronasDisponiveis($row['poltronas_disponiveis'])
                  ->setPreco($row['preco']);
            return $viagem;
        }
        return null;
    }

    public function atualizar(Viagem $viagem) {
        $stmt = $this->conn->prepare(
            "UPDATE viagens SET
            destino = :destino,
            embarque = :embarque,
            horario = :horario,
            poltronas = :poltronas,
            poltronas_disponiveis = :poltronas_disponiveis,
            preco = :preco
            WHERE id = :id"
        );
        
        return $stmt->execute([
            ':destino' => $viagem->getDestino(),
            ':embarque' => $viagem->getEmbarque(),
            ':horario' => $viagem->getHorario(),
            ':poltronas' => $viagem->getPoltronas(),
            ':poltronas_disponiveis' => $viagem->getPoltronasDisponiveis(),
            ':preco' => $viagem->getPreco(),
            ':id' => $viagem->getId()
        ]);
    }

    public function excluir($id) {
        $stmt = $this->conn->prepare("DELETE FROM viagens WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        return $stmt->execute();
    }
}