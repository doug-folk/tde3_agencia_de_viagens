<?php
namespace Models;

class Viagem {
    private $id;
    private $destino;
    private $embarque;
    private $horario;
    private $poltronas;
    private $poltronasDisponiveis;
    private $preco;

    // Getters
    public function getId() { return $this->id; }
    public function getDestino() { return $this->destino; }
    public function getEmbarque() { return $this->embarque; }
    public function getHorario() { return $this->horario; }
    public function getPoltronas() { return $this->poltronas; }
    public function getPoltronasDisponiveis() { return $this->poltronasDisponiveis; }
    public function getPreco() { return $this->preco; }

    // Setters com validações
    public function setId($id) { $this->id = $id; return $this; }
    
    public function setDestino($destino) {
        if (empty(trim($destino))) {
            throw new \InvalidArgumentException("Destino não pode ser vazio");
        }
        $this->destino = $destino;
        return $this;
    }
    
    public function setEmbarque($embarque) {
        if (empty(trim($embarque))) {
            throw new \InvalidArgumentException("Local de embarque não pode ser vazio");
        }
        $this->embarque = $embarque;
        return $this;
    }
    
    public function setHorario($horario, $validarDataPassada = false) {
        if (empty($horario)) {
            throw new \InvalidArgumentException("Horário não pode ser vazio");
        }
        
        if ($validarDataPassada) {
            $agora = new \DateTime();
            $dataHorario = new \DateTime($horario);
            if ($dataHorario < $agora) {
                throw new \InvalidArgumentException("Horário não pode ser no passado");
            }
        }
    
        $this->horario = $horario;
        return $this;
    }
    


    
    public function setPoltronas($poltronas) {
        if (!is_numeric($poltronas) || $poltronas <= 0) {
            throw new \InvalidArgumentException("Número de poltronas deve ser positivo");
        }
        $this->poltronas = (int)$poltronas;
        return $this;
    }
    
    public function setPoltronasDisponiveis($poltronasDisponiveis) {
        if (!is_numeric($poltronasDisponiveis) || $poltronasDisponiveis < 0) {
            throw new \InvalidArgumentException("Poltronas disponíveis deve ser positivo");
        }
        $this->poltronasDisponiveis = (int)$poltronasDisponiveis;
        return $this;
    }


    public function setPreco($preco) {
        if (!is_numeric($preco) || $preco < 0) {
            throw new Exception("Preço inválido.");
        }
        $this->preco = $preco;
        return $this;
    }

}