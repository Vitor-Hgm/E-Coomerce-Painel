<?php
session_start();

require __DIR__ . "/../vendor/autoload.php";
require __DIR__ . "/../app/config.php";

use app\Core\Conexao;
use app\Core\Router;

// criar conexão
$conn = Conexao::conectar();

// pegar o controller da URL
$param = $_GET["param"] ?? "index/index";
$paramExplode = explode("/", $param);
$controller = $paramExplode[0] ?? "index";

// proteção de login
if (!isset($_SESSION["ecoomercepainel"]) && $controller !== "login") {
    header("Location: /E-Coomerce-Painel/public/login/index");
    exit;
}

// iniciar router
$router = new Router($conn);
$router->run();
