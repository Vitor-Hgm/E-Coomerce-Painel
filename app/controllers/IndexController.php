<?php
    require "../../config/Conexao.php";
    require "../models/Usuario.php";

class IndexController
{
    private string $pageTitle;

    public function __construct()
    {
        // Proteção de rota: qualquer controller do painel exige login
        if (!isset($_SESSION["ecoomercepainel"])) {
            header("Location: /login/index");
            exit;
        }

        // Propriedade encapsulada
        $this->pageTitle = "Dashboard";
    }

    public function index()
    {
        // Conteúdo que será exibido na view
        $content = "Bem-vindo ao Painel Administrativo!";

        // Renderiza a view
        require "../app/views/index/index.php";
    }
}


