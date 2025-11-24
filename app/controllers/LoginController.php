<?php

namespace app\Controllers;

use app\Models\Login;

class LoginController
{
    private $model;

    public function __construct($db)
    {
        $this->model = new Login($db);
    }

    public function index()
    {
        require __DIR__ . '/../views/index/login.php';
    }

    public function entrar()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $email  = $_POST['email'] ?? "";
            $senha  = $_POST['senha'] ?? "";

            $usuario = $this->model->autenticar($email, $senha);

            if ($usuario) {

                // Salva o usuário logado, inclusive o ROLE
                $_SESSION["ecoomercepainel"] = $usuario;

                // Redireciona para o dashboard
                header("Location: /E-Coomerce-Painel/public/index");
                exit;

            } else {

                $erro = "E-mail ou senha incorretos.";
                require __DIR__ . '/../views/index/login.php';
            }

        } else {
            $this->index();
        }
    }

    public function sair()
    {
        session_destroy();
        header("Location: /E-Coomerce-Painel/public/login");
        exit;
    }
}
