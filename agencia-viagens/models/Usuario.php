<?php
namespace Models;

class Usuario {
    private $id;
    private $nome;
    private $email;
    private $senha;
    private $tipo;

    // Getters
    public function getId() { return $this->id; }
    public function getNome() { return $this->nome; }
    public function getEmail() { return $this->email; }
    public function getSenha() { return $this->senha; }
    public function getTipo() { return $this->tipo; }

    // Setters
    public function setId($id) { $this->id = $id; return $this; }
    public function setNome($nome) { 
        if (empty(trim($nome))) {
            throw new \InvalidArgumentException("Nome não pode ser vazio");
        }
        $this->nome = $nome; 
        return $this; 
    }
    public function setEmail($email) { 
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \InvalidArgumentException("Email inválido");
        }
        $this->email = $email; 
        return $this; 
    }
    public function setSenha($senha) { 
        $this->senha = password_hash($senha, PASSWORD_BCRYPT); 
        return $this; 
    }
    public function setTipo($tipo) { 
        if (!in_array($tipo, ['admin', 'cliente'])) {
            throw new \InvalidArgumentException("Tipo de usuário inválido");
        }
        $this->tipo = $tipo; 
        return $this; 
    }
    
    public function setHashSenha($hash) {
        $this->senha = $hash;
        return $this;
    }
    

    public function verificarSenha($senha) {
        return password_verify($senha, $this->senha);
    }
}