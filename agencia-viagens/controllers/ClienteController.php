<?php
namespace Controllers;

use Daos\ReservaDAO;
use Daos\ViagemDAO;
use Models\Reserva;

class ClienteController {
    public function listarViagens() {
        $viagemDAO = new ViagemDAO();
        $viagens = $viagemDAO->listarTodos();
        require 'views/cliente/viagens.php';
    }

    public function reservarViagem() {
        if (!isset($_SESSION['usuario']) || $_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /auth/login');
            exit;
        }

        try {
            $reserva = new Reserva();
            $reserva->setIdViagem($_POST['id_viagem'])
                   ->setIdCliente($_SESSION['usuario']->getId())
                   ->setPoltronasReservadas($_POST['poltronas']);

            $reservaDAO = new ReservaDAO();
            if ($reservaDAO->criar($reserva)) {
                // Atualiza poltronas disponíveis
                $viagemDAO = new ViagemDAO();
                $viagem = $viagemDAO->buscarPorId($_POST['id_viagem']);
                $viagem->setPoltronasDisponiveis(
                    $viagem->getPoltronasDisponiveis() - $_POST['poltronas']
                );
                $viagemDAO->atualizar($viagem);

                $_SESSION['flash'] = 'Reserva realizada com sucesso!';
                header('Location: /cliente/minhas-reservas');
                exit;
            }
        } catch (\Exception $e) {
            $_SESSION['flash'] = $e->getMessage();
            header('Location: /cliente/viagens');
            exit;
        }
    }

    public function minhasReservas() {
        if (!isset($_SESSION['usuario'])) {
            header('Location: /auth/login');
            exit;
        }

        $reservaDAO = new ReservaDAO();
        $reservas = $reservaDAO->listarPorCliente($_SESSION['usuario']->getId());
        require 'views/cliente/minhas-reservas.php';
    }
}