<?php
namespace Controllers;

use Daos\ViagemDAO;
use Models\Viagem;

class AdminController {
    public function listarViagens() {
        $viagemDAO = new ViagemDAO();
        $viagens = $viagemDAO->listarTodos();
        require 'views/admin/viagens.php';
    }

    public function criarViagem() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $viagem = new Viagem();
                $viagem->setDestino($_POST['destino'])
                       ->setEmbarque($_POST['embarque'])
                       ->setHorario($_POST['horario'], true)
                       ->setPoltronas($_POST['poltronas'])
                       ->setPoltronasDisponiveis($_POST['poltronas'])
                       ->setPreco($_POST['preco']);

                $viagemDAO = new ViagemDAO();
                if ($viagemDAO->criar($viagem)) {
                    $_SESSION['flash'] = 'Viagem cadastrada com sucesso!';
                    header('Location: /admin/viagens');
                    exit;
                }
            } catch (\Exception $e) {
                $_SESSION['flash'] = $e->getMessage();
                $_SESSION['form_data'] = $_POST;
                header('Location: /admin/viagens/criar');
                exit;
            }
        }

        $viagem = new Viagem();

        $formData = $_SESSION['form_data'] ?? [];
        unset($_SESSION['form_data']);
        require 'views/admin/form-viagem.php';
    }

public function editarViagem() {
    if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['flash'] = 'ID inválido ou não informado';
        header('Location: /admin/viagens');
        exit;
    }

    $id = (int) $_GET['id'];
    $viagemDAO = new ViagemDAO();
    $viagem = $viagemDAO->buscarPorId($id);

    if (!$viagem) {
        $_SESSION['flash'] = 'Viagem não encontrada';
        header('Location: /admin/viagens');
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        try {
            $novaQtdPoltronas = (int) $_POST['poltronas'];
            $poltronasReservadas = $viagem->getPoltronas() - $viagem->getPoltronasDisponiveis();
    
            // Corrige caso a nova quantidade seja menor que as poltronas já reservadas
            if ($novaQtdPoltronas < $poltronasReservadas) {
                $_SESSION['flash'] = "Não é possível definir {$novaQtdPoltronas} poltronas: já existem {$poltronasReservadas} reservadas.";
                header("Location: /admin/viagens/editar?id={$viagem->getId()}");
                exit;
            }
    
            $novasDisponiveis = $novaQtdPoltronas - $poltronasReservadas;
    
            $viagem->setDestino($_POST['destino'])
                   ->setEmbarque($_POST['embarque'])
                   ->setHorario($_POST['horario'], true)
                   ->setPoltronas($novaQtdPoltronas)
                   ->setPoltronasDisponiveis($novasDisponiveis)
                   ->setPreco($_POST['preco']);
    
            if ($viagemDAO->atualizar($viagem)) {
                $_SESSION['flash'] = 'Viagem atualizada com sucesso!';
                header('Location: /admin/viagens');
                exit;
            }
        } catch (\Exception $e) {
            $_SESSION['flash'] = $e->getMessage();
            header("Location: /admin/viagens/editar?id={$viagem->getId()}");
            exit;
        }
    }
    

    require 'views/admin/form-viagem.php';
}


public function excluirViagem() {
    if (empty($_GET['id']) || !is_numeric($_GET['id'])) {
        $_SESSION['flash'] = 'ID inválido ou não informado';
        header('Location: /admin/viagens');
        exit;
    }

    $id = (int) $_GET['id'];

    $reservaDAO = new \Daos\ReservaDAO();
    $reservas = $reservaDAO->buscarPorViagem($id);

    if (!empty($reservas)) {
        $_SESSION['flash'] = 'Não é possível excluir esta viagem pois existem reservas vinculadas.';
        header('Location: /admin/viagens');
        exit;
    }

    $viagemDAO = new \Daos\ViagemDAO();

    if ($viagemDAO->excluir($id)) {
        $_SESSION['flash'] = 'Viagem excluída com sucesso!';
    } else {
        $_SESSION['flash'] = 'Erro ao excluir a viagem.';
    }

    header('Location: /admin/viagens');
    exit;
}

}