<?php
class Router {

    public function run() {
        // Pega a URL após o /public
        $url = $_GET['url'] ?? '';
        $url = trim($url, '/');
        $url = explode('/', $url);

        // Controller
        $controllerName = !empty($url[0]) ? ucfirst($url[0]) . 'Controller' : 'HomeController';

        // Método
        $method = $url[1] ?? 'index';

        // Parâmetro (opcional)
        $param = $url[2] ?? null;

        // Caminho até o controller
        $controllerPath = "../app/controllers/{$controllerName}.php";

        // Verifica se o arquivo existe
        if (!file_exists($controllerPath)) {
            die("Controller não encontrado: $controllerName");
        }

        require_once $controllerPath;

        $controller = new $controllerName();

        if ($param) {
            $controller->$method($param);
        } else {
            $controller->$method();
        }
    }
}
