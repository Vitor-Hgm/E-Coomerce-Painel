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
        $param = $_GET["param"] ?? "index/index";
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

        $controller->$method();
    }
}
