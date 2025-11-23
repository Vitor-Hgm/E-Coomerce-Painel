<?php

namespace app\Core;

class Router
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function run()
    {
        // 👇 ROTA PADRÃO É O LOGIN
        $param = $_GET["param"] ?? "login/index";

        $param = explode("/", trim($param, "/"));

        $controllerName = ucfirst($param[0]) . "Controller";
        $method = $param[1] ?? "index";

        $namespace = "app\\Controllers\\" . $controllerName;

        if (!class_exists($namespace)) {
            die("Controller <b>$controllerName</b> não encontrado.");
        }

        $controller = new $namespace($this->db);

        if (!method_exists($controller, $method)) {
            die("Método <b>$method</b> não existe em <b>$controllerName</b>.");
        }

        // 🔒 PROTEÇÃO: BLOQUEIA TODAS AS ROTAS SEM LOGIN
        if ($controllerName !== "LoginController") {

            if (!isset($_SESSION["ecoomercepainel"])) {
                // SEM BASE_URL — usamos caminho FIXO
                header("Location: /E-Coomerce-Painel/public/login");
                exit;
            }
        }

        // EXECUTA O CONTROLLER
        $controller->$method();
    }
}
