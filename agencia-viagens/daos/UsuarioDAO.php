<?php
namespace Daos;

use Config\Database;
use Models\Usuario;
use PDO;

class UsuarioDAO {
    private $conn;

    public function __construct() {
        $db = Database::getInstance();
        $this->conn = $db->getConnection();
    }

    public function buscarPorEmail($email) {
        $stmt = $this->conn->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        
        if ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $usuario = new Usuario();
            $usuario->setId($row['id'])
                   ->setNome($row['nome'])
                   ->setEmail($row['email'])
                   ->setHashSenha($row['senha'])
                   ->setTipo($row['tipo']);
            return $usuario;
        }
        return null;
    }

    public function criar(Usuario $usuario) {
        $stmt = $this->conn->prepare(
            "INSERT INTO usuarios (nome, email, senha, tipo) 
             VALUES (:nome, :email, :senha, :tipo)"
        );
        
        return $stmt->execute([
            ':nome' => $usuario->getNome(),
            ':email' => $usuario->getEmail(),
            ':senha' => $usuario->getSenha(),
            ':tipo' => $usuario->getTipo()
        ]);
    }
}