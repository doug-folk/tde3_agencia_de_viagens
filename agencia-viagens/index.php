<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


require_once __DIR__ . '/autoload.php';
require_once __DIR__ . '/config/Database.php'; 

session_start();

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

// Rotas públicas
switch ($path) {
    case '/auth/login':
        (new Controllers\AuthController())->login();
        break;
    case '/auth/register':
        (new Controllers\AuthController())->register();
        break;
    case '/auth/logout':
        session_destroy();
        header('Location: /auth/login');
        break;
    default:
        // Rotas protegidas
        if (!isset($_SESSION['usuario'])) {
            header('Location: /auth/login');
            exit;
        }
        
        if ($_SESSION['usuario']->getTipo() === 'admin') {
            switch ($path) {
                case '/admin':
                    require 'views/admin/dashboard.php';
                    break;
                case '/admin/viagens':
                    (new Controllers\AdminController())->listarViagens();
                    break;
                case '/admin/viagens/criar':
                    (new Controllers\AdminController())->criarViagem();
                    break;
                case '/admin/viagens/editar':
                    (new Controllers\AdminController())->editarViagem();
                    break;
                case '/admin/viagens/excluir':
                    (new Controllers\AdminController())->excluirViagem();
                    break;
                default:
                    header('Location: /admin');
            }
        } else {
            switch ($path) {
                case '/cliente':
                    require 'views/cliente/dashboard.php';
                    break;
                case '/cliente/viagens':
                    (new Controllers\ClienteController())->listarViagens();
                    break;
                case '/cliente/reservar':
                    (new Controllers\ClienteController())->reservarViagem();
                    break;
                case '/cliente/minhas-reservas':
                    (new Controllers\ClienteController())->minhasReservas();
                    break;
                default:
                    header('Location: /cliente');
            }
        }
}