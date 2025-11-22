<?php
session_start();

require "../app/core/Conexao.php";
require "../app/models/Login.php";
require "../app/controllers/LoginController.php";
require "../app/controllers/IndexController.php";
require "../app/config.php";

use App\Controllers\IndexController;
use App\Controllers\LoginController;

// cria a conexão
$conn = Conexao::conectar();

// pega o parâmetro
$param = $_GET["param"] ?? "index";
$param = explode("/", $param);

$controller = $param[0] ?? "index";
$metodo = $param[1] ?? "index";

// 🔒 PROTEÇÃO: se não estiver logado e tentar acessar qualquer coisa que não seja login:
// Se não estiver logado, manda para o login
if (!isset($_SESSION["ecoomercepainel"]) && $controller !== "login") {
    header("Location: " . "/E-Coomerce-Painel/public/login");

    exit;
} 


// controlador de login
if ($controller === "login") {

    $login = new LoginController($conn);

    if ($metodo === "index") {
        $login->index();
    } elseif ($metodo === "entrar") {
        $login->entrar();
    } elseif ($metodo === "sair") {
        $login->sair();
    }

    exit;
}

// controlador principal
$index = new IndexController($conn);
$index->index();
