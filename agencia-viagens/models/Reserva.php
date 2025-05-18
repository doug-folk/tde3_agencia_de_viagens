<?php
namespace Models;

class Reserva {
    private $id;
    private $idViagem;
    private $idCliente;
    private $dataReserva;
    private $poltronasReservadas;

    // Getters
    public function getId(): int {
        return $this->id;
    }

    public function getIdViagem(): int {
        return $this->idViagem;
    }

    public function getIdCliente(): int {
        return $this->idCliente;
    }

    public function getDataReserva(): string {
        return $this->dataReserva;
    }

    public function getPoltronasReservadas(): int {
        return $this->poltronasReservadas;
    }

    // Setters com validações
    public function setId(int $id): self {
        $this->id = $id;
        return $this;
    }
    
    public function setIdViagem(int $idViagem): self {
        if ($idViagem <= 0) {
            throw new \InvalidArgumentException("ID da viagem inválido");
        }
        $this->idViagem = $idViagem;
        return $this;
    }
    
    public function setIdCliente(int $idCliente): self {
        if ($idCliente <= 0) {
            throw new \InvalidArgumentException("ID do cliente inválido");
        }
        $this->idCliente = $idCliente;
        return $this;
    }
    
    public function setDataReserva(string $dataReserva): self {
        if (!strtotime($dataReserva)) {
            throw new \InvalidArgumentException("Formato de data inválido");
        }
        $this->dataReserva = $dataReserva;
        return $this;
    }
    
    public function setPoltronasReservadas(int $poltronasReservadas): self {
        if ($poltronasReservadas <= 0) {
            throw new \InvalidArgumentException("Número de poltronas deve ser positivo");
        }
        $this->poltronasReservadas = $poltronasReservadas;
        return $this;
    }
}