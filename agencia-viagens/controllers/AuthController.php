<?php
namespace Controllers;

use Daos\UsuarioDAO;
use Models\Usuario;

class AuthController {
    public function login() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
            $senha = $_POST['senha'] ?? '';

            $usuarioDAO = new UsuarioDAO();
            $usuario = $usuarioDAO->buscarPorEmail($email);
    
            if ($usuario && $usuario->verificarSenha($senha)) {
                $_SESSION['usuario'] = $usuario;
                header('Location: /' . $usuario->getTipo());
                exit;
            }

            $_SESSION['flash'] = 'Credenciais inválidas';
            header('Location: /auth/login');
            exit;
        }

        require 'views/auth/login.php';
    }

    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                // Validação simples: senhas devem coincidir
                if ($_POST['senha'] !== $_POST['confirmar_senha']) {
                    throw new \Exception("As senhas não coincidem");
                }
    
                $usuario = new Usuario();
                $usuario->setNome($_POST['nome'])
                       ->setEmail($_POST['email'])
                       ->setSenha($_POST['senha'])  // Já faz hash automaticamente
                       ->setTipo('cliente');
    
                $usuarioDAO = new UsuarioDAO();
                if ($usuarioDAO->criar($usuario)) {
                    $_SESSION['flash'] = 'Registro realizado! Faça login.';

                    header('Location: /auth/login');
                    exit;
                } else {
                    throw new \Exception("Erro ao registrar usuário, tente novamente.");
                }
            } catch (\Exception $e) {
                // Adicione isto para manter os dados do form em caso de erro (novo)
                $_SESSION['form_data'] = $_POST;
                $_SESSION['flash'] = $e->getMessage();
                header('Location: /auth/register');  // Redireciona de volta ao form
                exit;
            }
        }
    
        require 'views/auth/register.php';
    }

    public function logout() {
        session_destroy();
        header('Location: /auth/login');
        exit;
    }
}